<?php
	/*
	 * This is the starting of the main page. This displays everything about the user.
	 */
	
	include_once 'includes/config.php';
	
	$template->setPageTitle('Hackin Index');
	$template->setPage('index');
	
	//We have to load the resources from the server.
	$resourcesRestCall = new RestCall('localhost/HackinNew/HackinServer/getResources.php', array('authToken' => $authHandler->get('auth_token') ) );
	$data = $resourcesRestCall->makeRestCall();
	
	$jsonData = json_decode($data);
	
	
	$template->loadPage();
?>