<?php

/*
 * This is the main file that is included in all the Pages.
 */
	
	//This includes all the constants 
	include_once 'constants.php';
	
	//We invoke the DB first as we need it everywhere else.
    include_once 'mydb.php';
	$db = new DB();
	//Now we include all the table names constants
	include_once 'db_table.php';
	
	//This holds all the general functions.
    include_once 'common_functions.php';
    
	//Now we invoke the session
    include_once 'AuthSession.php';
	
	//This is the RestCall Class.
	include_once 'restcall.php';
	
	//This is the resource Manager
	include_once 'resourceHandler.php';
	
	include_once 'notification.php';
	
	//We create all the objects needed for the working.
	$authSession = new AuthSession( (isset($_POST['auth_token']) ? $_POST['auth_token'] : NULL) );
	$notification = new Notification();
	//If a page wants to check if the user is logged in / having a valid auth then user isLoggedIn or else die
?>