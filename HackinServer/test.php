<?php
	include_once 'includes/config.php';
	
	//This is just a test.
	$restCall = new RestCall("localhost/HackinNew/HInfoServer/signin.php", array('username' => 'delta', 'password' => 'delta2'));
	$data = $restCall->makeRestCall();
	$data = json_decode($data);
	if( $data->login == true)	{
		// Add auth token to local DB.
	} else {
		echo $data->message;
	}
?>