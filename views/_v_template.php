<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="/css/main.css" type="text/css">
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>

<div id='menu'>
    <br>
    <!-- placeholder to be able to capitalize the app name on the home page -->
    <?php $placeholder = APP_NAME ?>
    <a href='/'><strong><span id = "logo"><?php echo strtoupper($placeholder); ?></span></strong></a>
    <br>
    <?=APP_TAGLINE?>
    <br>

    <!-- Menu for users who are logged in -->
    <br>
    <?php if($user): ?>
        <ul>
            <li>
                <a href='/users/profile'>Profile</a>
            </li>
            <li>
                <a href='/statements/personal'>My Sheets</a>
            </li>
            <li>
                <a href='/statements/new'>New Sheet</a>
            </li>
            <li>
                <a href='/statements/edit'>Edit Sheets</a>
            </li>
            <li>
                <a href='/users/logout'>Logout</a>
            </li>
        </ul>
        <br>
        <br>

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
    <br>
    <br>
</div>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>