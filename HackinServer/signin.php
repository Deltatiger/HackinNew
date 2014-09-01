<?php
	/*
	 * This page is used to create a sign in page.
	 * the result is a authToken to be used everywhere.
	 */
	 
	include_once 'includes/config.php';
	
	if(!isset($_POST['username']) && !isset($POST['password']))	{
		die(json_encode(array("login", false)));
	}
	
	//We have to check the details.
	$username = rawurldecode($_POST['username']);
	$password = rawurldecode($_POST['password']);	
	
	//Send it to the auth class to get an auth token
	$authToken = AuthSession::createAuthToken($username, $password);
	$jsonRawData = array(
		"login"		=> false
	);
	
	switch($authToken)	{
		case -1:
			//This is the invalid username & password case.
			$jsonRawData['message'] = 'Invalid username & password Combination.';
			break;
		case -2:
			$jsonRawData['message'] = 'An error occurred. Please try again.';
			break;
		default:
			//This should be a valid auth token.
			$jsonRawData['authToken'] = $authToken;
			$jsonRawData['login'] = true;
			$jsonRawData['username'] = $username;
			//We have to check if he already has a country or not.
			$usernameClean = strtolower($username);
			$sql = "SELECT `country` FROM ".COUNTRIES.", ".USER_DETAIL." WHERE ".COUNTRIES.".`user_id` = ".USER_DETAIL.".`user_id` AND LOWER(".USER_DETAIL.".`user_name`) = '{$usernameClean}'";
			$query = $db->query($sql);
			if($db->numRows($query) > 0)	{
				$result = $db->result($query);
				$db->freeResults($query);
				$jsonRawData['teamCountry'] = $result->country;
			} else {
				$jsonRawData['teamCountry'] = getUnusedCountry($username);
			}
			break;
	}
	 
	//Send the data to the requesting client.
	echo json_encode($jsonRawData);
?>