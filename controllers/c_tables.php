<?php
class tables_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        // Prove to myself tha the __construct() function was called
        // echo "users_controller construct called<br><br>";
    }

    public function index() {

        //Select the tables that this user has authored
        $q = "SELECT *
                FROM income_tables
                WHERE user_id = ".$this->user->user_id."
                ORDER BY modified ASC";


        # Query the database
        $user_tables = DB::instance(DB_NAME)->select_rows($q);

        #Pass
        $this->template->content = View::instance('v_tables_index');
        $this->template->title   = "User's Table Index";

        # Pass data to the View
        $this->template->content->user_tables = $user_tables;
        //$this->template->content->error = $error;

        # Load JS files relevant to adding tables via form
        $client_files_body = Array(
            "/js/jquery.form.js",
            "/js/tables_add.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;
        //

    } # End of Method

    public function view($table_id = NULL) {

        //If $table_id has been chosen, then need to select a specific table

        # Setup view
        $this->template->content = View::instance('v_tables_view');
        $this->template->title   = "Table Name";

        # Include the accounting & income javascript files
        $client_files_body = Array(
            '/js/accounting.js',
            '/js/income.js'
        );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);


        # Pass data to the view
        $this->template->content->table_id = $table_id;

        # Render template
        echo $this->template;

    } # End of Method

    public function edit($table_id = NULL) {



        //Select the tables that this user has authored
        $q = "SELECT *
                FROM income_tables
                WHERE income_table_id = ".$table_id;

        # Query the database
        $table_info = DB::instance(DB_NAME)->select_rows($q);

        //Load relevant JS files
        $client_files_body = Array(
            '/js/jquery.form.js',
            '/js/accounting.js',
            '/js/income2.js',
            '/js/tables_edit.js'
        );


        # Setup view
        $this->template->content = View::instance('v_tables_edit');
        $this->template->title   = "Edit - ".$table_info[0]['name'];

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Pass data to the view
        $this->template->content->table_id = $table_id;
        $this->template->content->table_info = $table_info;

        # Render template
        echo $this->template;


    } # End of Method

    public function delete($table_id = NULL) {

        //THIS FUNCTION DELETES A TABLE

        //Check if the user is the owner of the table!
        //[INSERT CODE HERE]

        # Configure where condition so that post_id is matched
        $where_condition = "WHERE income_tables.income_table_id = ".$table_id;

        # Delete desired entry from the posts table
        DB::instance(DB_NAME)->delete('income_tables', $where_condition);

        # Reroute user back to his profile page

        Router::redirect('/tables/index');


    } # End of Method

    public function add() {

        //Slow down the function for testing purposes
        sleep(1);

        # Remove Special Characters
        $_POST['name']=htmlspecialchars($_POST['name']);
        $_POST['caption']="";

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();


        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us

        # Data to send to the javascript
        $data = Array();

        $data['id'] = DB::instance(DB_NAME)->insert('income_tables', $_POST);
        $data['name'] = $_POST['name'];
        echo json_encode($data);

    } # End of Method

    public function edit_caption($table_id = NULL) {

        # Remove Special Characters
        $_POST['caption']=htmlspecialchars($_POST['caption']);

        # Unix timestamp to update when the field was modified
        $_POST['modified'] = Time::now();
        //echo $_POST['caption'];

        # Generation the where condition, where the income_table_id matches
        $where_condition = "WHERE income_tables.income_table_id = ".$_POST['income_table_id'];

        //No longer need the income_table_id
        unset($_POST['income_table_id']);

        # Edit the entry in the database
        DB::instance(DB_NAME)->update_row('income_tables', $_POST, $where_condition);

        $data = Array();
        $data['modified'] =  Time::display($_POST['modified']);
        $data['caption'] = $_POST['caption'];
        # Data to send to the javascript

        echo json_encode($data);
    } # End of Method

    public function edit_entries($formName = NULL){

        //Storing form entries in mysql when there is an indeterminate number of entries?

        $data['income_table_id'] = $_POST['income_table_id'];
        $data[$formName] = $_POST[$formName];


        //DATABASE UpdateRows to input into the database
        # This should be called *after* the DATABASE QUERY
        # It is in front for purposes of testing

        $q = "SELECT *".
            " FROM table_entries".
            " WHERE".
                " table_entries.income_table_id = ".$_POST['income_table_id'].
                " AND table_entries.category = '".$formName."'".
            " ORDER BY idx ASC";


        //$data['q']= $q;
        # Run the query
        $entries = DB::instance(DB_NAME)->select_rows($q);

        $data['entries'] = $entries;

        foreach($_POST[$formName] as $i => $item) {

            #Check if the entry already exists

            #if exists, then update row

            if(isset($entries[$i])){

                $data['isset']="YES";
                $DBdata = Array(
                    "modified" => Time::now(),
                    "value" => floatval(preg_replace("/[^0-9,.-]/","",$item)),
                    "name" => $_POST[$formName.'Name'][$i]
                );

                # Generation the where condition, where the income_table_id matches
                $where_condition = "WHERE table_entries.income_table_id = ".$_POST['income_table_id'].
                    " AND table_entries.category = '".$formName.
                    "' AND table_entries.idx = ".$i;

                # Insert into the users_users table
                //DB::instance(DB_NAME)->update_row('income_tables', $_POST, $where_condition);
                DB::instance(DB_NAME)->update_row('table_entries', $DBdata, $where_condition);
            }

            #if there is no an entry for this index, then create it
            else {
                $DBdata = Array(
                    "created" => Time::now(),
                    "modified" => Time::now(),
                    "income_table_id" => $data['income_table_id'],
                    "category" => $formName,
                    "idx" => $i,
                    "value" => floatval(preg_replace("/[^0-9,.-]/","",$item)),
                    "name" => $_POST[$formName.'Name'][$i]
                );

                # Insert into the users_users table
                DB::instance(DB_NAME)->insert('table_entries', $DBdata);
            }
            #else then insert row


        }

        // $data['dbdata'] = $DBdata;





        /*

        //DATABASE QUERY to see what exists
        # Want all entries that match this table ID
        # Also, need the "category" to match the $formName variable
        # order by index to make it easier





        foreach($_POST[$formName] as $i => $item)
        {
            #What is the corresponding name of the the field name?

            $fieldName = $_POST[$formName+'Name'][$i];

            //Generate the where condition -
            # Where index = $i
            # IF that exists, then update
            # ELSE then insert row


        }

       */

        echo json_encode($data);


    } # End of Method

} # eoc
