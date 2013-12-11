<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        // Prove to myself tha the __construct() function was called
        // echo "users_controller construct called<br><br>";
    }

    public function index() {
        echo "This page needs to show the user's options for viewing their own tables";

        $this->template->content = View::instance('v_tables_index');
        $this->template->title   = "User's Table Index";

        # Pass data to the view
        $this->template->content->error = $error;

        # Render template
        echo $this->template;
        //

    } # End of Method

    public function view($error = NULL) {

        echo "This page needs to show the specific table the user has selected";
        # Setup view
        $this->template->content = View::instance('v_tables_view');
        $this->template->title   = "Table Name";

        # Pass data to the view
        $this->template->content->error = $error;

        # Render template
        echo $this->template;

    } # End of Method


} # eoc
