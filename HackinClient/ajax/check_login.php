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
		$data = $loginRestCall->makeRestCall();	//This is a JSON Data by itself. No further encoding required.
		$jsonData = json_decode($data);
		//Check the data to update our local DB.
		if($jsonData->login == true)	{
			//Check and update the data.
			$authHandler->set('auth_token', $jsonData->authToken);
			$authHandler->set('team_name', $jsonData->username);
			$authHandler->set('team_country', $jsonData->teamCountry);
		}
		echo $data;
	} else if (isset($_POST['checkLogin'])) {
		//This is used to check the login status.
		$rawData = array('login' => false);
		if($authHandler->get('auth_token') != '')	{
			$rawData['login'] = true;
		}
		
		echo json_encode($rawData);
	}

?>