<?php
	//This page is used to increment the user resource 
	
	include_once 'includes/config.php';
	
	if(!$authSession->isLoggedIn())	{
		die(json_encode(array('login' => false)));
	}

	//Create the json message also
	$jsonRawData = array(
		'success'  		=> false
	);
	
	//Get the users native resource and increment it
	$userId = $authSession->getUserId();
	$sql = "SELECT `user_resource_id`, `user_resource_add_unit`, `user_last_autoinc` FROM ".USER_DETAIL." WHERE `user_id` = '{$userId}'";
	$query = $db->query($sql);
	if($db->numRows($query))	{
		//We have a hit
		$result = $db->result($query);
		//Now we check the time.
		if($result->user_last_autoinc + 10 <= time())	{
			//A valid time. Lets auto inc.
			$db->startTransaction();
			
			$resourceHandler = new ResourceHandler();
			if ($resourceHandler->addResource($result->user_resource_id, $result->user_resource_add_unit) == true)	{
				$cTime = time();
				$sql = "UPDATE ".USER_DETAIL." SET `user_last_autoinc` = '{$cTime}' WHERE `user_id` = '{$userId}'";
				$query = $db->query($sql);
				if($query)	{
					$db->commit();
					$jsonRawData['success'] = true;
				} else {
					$db->rollback();
				}
			} else {
				$db->rollback();
			}
		}
	}
	
	echo json_encode($jsonRawData);
	
?>