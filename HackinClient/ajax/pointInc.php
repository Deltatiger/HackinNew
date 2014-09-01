<?php
	
	include_once '../includes/config.php';
	
	if($authHandler->get('auth_token') == NULL)	{
		die(json_encode(array('success' => false, 'message' => 'Login authentication failed')));
	}
	
	//Send a rest call to increement the points.
	$pointIncCaller = new RestCall('localhost/HackinNew/HackinServer/resourceInc.php', array('auth_token' => $authHandler->get('auth_token')));
	$data = $pointIncCaller->makeRestCall();
	
	echo $data;
?>