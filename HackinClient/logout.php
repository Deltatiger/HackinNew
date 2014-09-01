<?php
	include_once 'includes/config.php';
	
	$template->setPageTitle('Logout');
	$template->setPage('logout');
	
	//We logout the user
	$authHandler->logout();
	
	$template->loadPage();
?>