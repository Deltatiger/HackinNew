<?php

	include_once '../includes/config.php';
	
	if($authHandler->get('auth_token') == NULL)	{
		die(json_encode(array('success' => false, 'message' => 'Login authentication failed')));
	}
	
	//Send the request
	$getResource = new RestCall('localhost/HackinNew/HackinServer/getResouce.php', array('auth_token' => $authHandler->get('auth_token')));
	$data = $getResource->makeRestCall();
	$parsedData = json_decode($data);
	$htmlContent = '';
	
	
	$jsonReply = array(
		'success' 		=> true,
		'content'		=> $htmlData
	);
	
	

?>