<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- INCLUDE SPECIAL FONT, MAIN.CSS, AND BOOTSTRAP.CSS -->
    <link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/bootstrap.min.css" type = "text/css">
    <link rel="stylesheet" href="/css/main.css" type="text/css">




	<!-- Controller Specific JS/CSS -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/js/jquery-2.0.2.js"></script>
    <script src="/js/jquery.form.js"></script> -->

	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>

<div id='menu'>
    <!-- placeholder to be able to capitalize the app name on the home page -->
    <div id = "logo">
        <h2><a href = "/"><?=APP_NAME?></a></h2>
    </div>


    <!-- Menu for users who are logged in -->
    <div id = "nav">
        <?php if($user): ?>

            <ul>
                <li>
                    <a href='/tables/index'><strong>My Sheets</strong></a>
                </li>
                <?php if(isset($toggleMode)){
                    echo "<li>";
                    echo "HELLO";
                    echo "<a href ='/tables/".$toggleMode."/".$table_id."'>".$toggleMode."</a>";
                    echo "</li>";
                }
                ?>
                <li>
                    <a href='/users/logout'>Logout</a>
                </li>
            </ul>
            <!-- Menu options for users who are not logged in -->
        <?php else: ?>
            <ul>
                <li>
                    <a href='/users/signup'>Sign up</a>
                </li>
                <li>
                    <a href='/users/login'>Log in</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>

    <br><br>
</div>
<div id = "content">
    <?php if(isset($content)) echo $content; ?>
    <?php if(isset($client_files_body)) echo $client_files_body; ?>
</div>




<!-- <script src="/js/main.js"></script> -->


</body>
</html>