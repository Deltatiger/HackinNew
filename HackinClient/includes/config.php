<?php

/*
 * This is the main file that is included in all the Pages.
 */
    session_start();
	//This includes all the constants 
	include_once 'constants.php';
	
	//We invoke the DB first as we need it everywhere else.
    include_once 'mydb.php';
	$db = new DB();
	//Now we include all the table names constants
	include_once 'db_table.php';
	
	//This holds all the general functions.
    include_once 'common_functions.php';
    
	//Only the template class is of any use.
    include_once 'template.php';
	
	//Include the overall manager class.
	include_once 'auth_handler.php';
	include_once 'restcall.php';
	
	//We create all the objects needed for the working.
	$authHandler = new AuthHandler();
    $template = new Template();
    
?>
