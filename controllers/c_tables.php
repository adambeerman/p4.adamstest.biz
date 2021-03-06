<?php
class tables_controller extends base_controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

        //Select the tables that this user has authored
        $q = "SELECT *
                FROM income_tables
                WHERE user_id = ".$this->user->user_id."
                ORDER BY modified ASC";

        # Query the database
        $user_tables = DB::instance(DB_NAME)->select_rows($q);

        #Pass to view
        $this->template->content = View::instance('v_tables_index');
        $this->template->title   = $this->user->first_name."'s Tables";


        # Pass data to the View
        $this->template->content->user_tables = $user_tables;

        # Load JS files relevant to adding tables via form
        $client_files_body = Array(
            "/js/jquery-2.0.2.js",
            "/js/jquery.form.js",
            "/js/tables_add.js"
        );

        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;
        //

    } # End of Method

    public function view($table_id = NULL) {

        //This function displays a neater view of the finalized table (for printing)

        //Verify that this user is the owner of the table they wish to view
        # Determine who the owner of the table is
        $q = "SELECT user_id".
            " FROM income_tables".
            " WHERE income_table_id = ".$table_id;
        $verify = DB::instance(DB_NAME)->select_row($q);

        if($verify['user_id'] == $this->user->user_id){

            //Select the table information from the table the user has selected
            $q1 = "SELECT *
                    FROM income_tables
                    WHERE income_table_id = ".$table_id;

            # Query the database
            $table_info = DB::instance(DB_NAME)->select_row($q1);

            //Select the table entries from the table the user has selected
            $q2 = "SELECT category, idx, name, value".
                " FROM table_entries".
                " WHERE income_table_id = ".$table_id;

            # Query the database
            $entry_info = DB::instance(DB_NAME)->select_rows($q2);

            # Setup view
            $this->template->content = View::instance('v_tables_view');
            $this->template->title   = "View - ".$table_info['name'];

            # Pass data to the view
            $this->template->content->table_id = $table_id;
            $this->template->content->table_info = $table_info;
            $this->template->content->entry_info = $entry_info;

        } #end of if()

        // If the user did not have access to the information
        else {
            //Select the tables that this user has authored
            $q1 = "SELECT *
                FROM income_tables
                WHERE user_id = ".$this->user->user_id."
                ORDER BY modified ASC";


            # Query the database
            $user_tables = DB::instance(DB_NAME)->select_rows($q1);

            #Pass
            $this->template->content = View::instance('v_tables_index');
            $this->template->title   = $this->user->first_name."'s Tables";

            # Pass data to the View
            $this->template->content->user_tables = $user_tables;
            $this->template->content->message = "You do not have appropriate permissions ".
                "to view that income statement";

        } # end of if/else

        # Include the accounting & income javascript files
        $client_files_body = Array(
            '/js/jquery-2.0.2.js',
            '/js/accounting.js',
            '/js/tables_view.js'
        );

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;

    } # End of Method

    public function edit($table_id = NULL) {

        //Verify that the user has permission:
        $q = "SELECT user_id".
            " FROM income_tables".
            " WHERE income_table_id = ".$table_id;
        $verify = DB::instance(DB_NAME)->select_row($q);

        if($verify['user_id'] == $this->user->user_id){
            //Select the table information from the table the user has selected
            $q = "SELECT *
                FROM income_tables
                WHERE income_table_id = ".$table_id;

            # Query the database
            $table_info = DB::instance(DB_NAME)->select_rows($q);


            //Select the table entries from the table the user has selected
            $q2 = "SELECT category, idx, name, value, table_entry_id".
                " FROM table_entries".
                " WHERE income_table_id = ".$table_id;

            $entry_info = DB::instance(DB_NAME)->select_rows($q2);

            # Setup view
            $this->template->content = View::instance('v_tables_edit');
            $this->template->title   = "Edit - ".$table_info[0]['name'];



            # Pass data to the view
            $this->template->content->table_id = $table_id;
            $this->template->content->table_info = $table_info;
            $this->template->content->entry_info = $entry_info;
            $this->template->content->toggleMode = "view";

        }
        else {
            //Select the tables that this user has authored
            $q = "SELECT *
                FROM income_tables
                WHERE user_id = ".$this->user->user_id."
                ORDER BY modified ASC";


            # Query the database
            $user_tables = DB::instance(DB_NAME)->select_rows($q);

            #Pass
            $this->template->content = View::instance('v_tables_index');
            $this->template->title   = $this->user->first_name."'s Tables";

            # Pass data to the View
            $this->template->content->user_tables = $user_tables;
            $this->template->content->message = "You do not have appropriate permissions ".
                "to edit that income statement";

        }

        //Load relevant JS files
        $client_files_body = Array(
            '/js/jquery-2.0.2.js',
            '/js/jquery.form.js',
            '/js/accounting.js',
            '/js/tables_edit.js');

        # Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Render template
        echo $this->template;

    } # End of Method

    public function delete($table_id = NULL) {

        //THIS FUNCTION DELETES A TABLE
        # Determine who the owner of the table is
        $q = "SELECT user_id".
            " FROM income_tables".
            " WHERE income_table_id = ".$table_id;

        $verify = DB::instance(DB_NAME)->select_row($q);

        if($verify['user_id'] == $this->user->user_id){

            # Delte the incoe table that matches the table id
            $where_condition = "WHERE income_tables.income_table_id = ".$table_id;

            # Delete desired entry from the posts table
            DB::instance(DB_NAME)->delete('income_tables', $where_condition);

        }
        Router::redirect('/tables/index/');

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


        /* -----------------------------------------------
        # Need to populate the initial entries so that when the "edit" page is opened,
        # there will be blank spaces for each of the new entries
        -------------------------------------------------- */
        $categoryList = Array('revenue', 'cos', 'opex', 'otherex');

        foreach($categoryList as $cat) {
            $DBdata = Array(
                "created" => Time::now(),
                "modified" => Time::now(),
                # Use the table id just created
                "income_table_id" => $data['id'],
                "category" => $cat,
                "idx" => 0,
                "value" => 0,
                "name" => ""
            );

            # Insert into the users_users table
            DB::instance(DB_NAME)->insert('table_entries', $DBdata);
        }

        // Send $data back to the view through AJAX
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

                # Generate the information that needs to be updated
                $DBdata = Array(
                    "modified" => Time::now(),
                    #strip commas and dollar signs from the value saved
                    "value" => floatval(str_replace(array(',','$'), '' , $item)),
                    "name" => $_POST[$formName.'Name'][$i]
                );

                # Generation the where condition, where the income_table_id matches
                # and where the category matches the formName
                $where_condition = "WHERE table_entries.income_table_id = ".$_POST['income_table_id'].
                    " AND table_entries.category = '".$formName.
                    "' AND table_entries.idx = ".$i;

                # Insert into the users_users table
                DB::instance(DB_NAME)->update_row('table_entries', $DBdata, $where_condition);

                //Update the income_table so that the database knows it was just modified
                # Information to update
                $DBdata = Array (
                    "modified" => Time::now()
                );

                $where_condition2 = "WHERE income_tables.income_table_id = ".$_POST['income_table_id'];

                DB::instance(DB_NAME)->update_row('income_tables',$DBdata,$where_condition2);
            }

            #if there is no an entry for this index, then create it
            else {

                # Information to insert into the table
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
        }

        #update timestamp
        $data['modified'] = Time::display(Time::now());

        #Pass JSON data to Javascript
        echo json_encode($data);

    } # End of Method



    public function delete_entry($entryID = NULL){

        //This function will accept the $entry ID and then remove it from the database
        # Still need to figure out how to re-allocate the other entries

        # Find the $tableID
        $q = "SELECT income_table_id, idx, category".
            " FROM table_entries".
            " WHERE table_entry_id = ".$entryID;

        $entryTable = DB::instance(DB_NAME)->select_row($q);

        $q1 = "SELECT user_id".
            " FROM income_tables".
            " WHERE income_table_id = ".$entryTable['income_table_id'];

        $entryOwner = DB::instance(DB_NAME)->select_row($q1);

        if($entryOwner['user_id'] == $this->user->user_id){

            // Next step should be to re-position the remaining entries so that there are no blank indexed values

            # determine the index of the deleted row.
            # if there is an entry in the same category with a higher index, shift those indexes down by 1
            $q = "SELECT *".
                " FROM table_entries".
                " WHERE".
                " table_entries.income_table_id = ".$entryTable['income_table_id'].
                " AND table_entries.category = '".$entryTable['category']."'".
                " ORDER BY idx ASC";

            # Run the query
            $entries = DB::instance(DB_NAME)->select_rows($q);


            # For any entries with a higher index, need to shift those each down by 1
            foreach($entries as $entry){
                if($entry['idx']>$entryTable['idx']){

                    # Shift desired index down by 1
                    $data = Array('idx' => $entry['idx']-1);

                    #Select the entry that matches the current table_entry_id
                    $where_condition2 = "WHERE table_entries.table_entry_id = ".$entry['table_entry_id'];

                    #Database call to update the index values
                    DB::instance(DB_NAME)->update_row('table_entries', $data, $where_condition2);
                }
            }

            # Delete the matching entries
            $where_condition = "WHERE table_entries.table_entry_id = ".$entryID;

            # Delete desired entry from the posts table
            DB::instance(DB_NAME)->delete('table_entries', $where_condition);
        }

        Router::redirect('/tables/edit/'.$entryTable['income_table_id']);

    } # end of delete_entry method
} # eoc
