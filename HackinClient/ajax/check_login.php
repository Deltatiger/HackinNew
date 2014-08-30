<?php


	//This page is used to check the login of the user.
	include_once '../includes/config.php';
	
	$loginStat = false;
	$username = "";
	
	if (isset($_POST['login']))	{
		$uName = clean($_POST['uname']);
		$uPass = clean($_POST['upass']);
		//We have to login via a restcall
		$loginRestCall = new RestCall('localhost/HackinNew/HackinServer/signin.php', array('username' => $uName, 'password' => $uPass));
		$data = $loginRestCall->makeRestCall();
		echo $data;
	}

?>