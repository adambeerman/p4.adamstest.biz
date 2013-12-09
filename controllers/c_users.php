<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
			
	}

    public function signup($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

        # Pass data to the view
        $this->template->content->error = $error;

        # Render template
        echo $this->template;

    } # End of Method

    public function p_signup() {

        # Check for duplicate emails via JS / Ajax, but double check here
        if( !$this->confirm_unique_email($_POST['email']))
            echo "not a unique e-mail";
            //return Router::redirect('/users/login/$error=signup');

        ## Validate that the user has entered a valid login name
        $at_sign = strpos($_POST['email'], '@');

        # Error code 1 indicates invalid login name
        if($at_sign === false) {
            Router::redirect('/users/signup/1');
        }

        ## if the email has already been created, then alert the person signing up
        $email = $_POST['email'];
        $q = "SELECT created FROM users WHERE email = '".$email."'";
        $emailexists = DB::instance(DB_NAME)->select_field($q);

        # Error code 2 indicates that user already exists
        if(isset($emailexists)){
            Router::redirect('/users/signup/2');
        }

        ## Ensure that the user has entered a first name

        # Error code 3 indicates that user needs a first name
        if(strlen($_POST['first_name'])<1){
            Router::redirect('/users/signup/3');
        }

        ## Ensure password is greater than 5 characters
        # Error code 4 indicates that password is too short
        if(strlen($_POST['password'])<6) {
            Router::redirect('/users/signup/4');
        }

        # Give user the default avatar and profile photo
        $_POST['avatar'] = "example.gif";
        $_POST['photo'] = "p_example.gif";


        # Store time stamp data from user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Encrypt the password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        # Insert this user into the database
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

        # Redirect to the login page, and inform them that they have signed up
        # Currently using $error = 2 as the indication that they have signed up
        Router::redirect('/users/login/2');

    } # End of Method

	
} # eoc
