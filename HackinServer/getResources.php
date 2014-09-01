<?php
	include_once 'includes/config.php';
	
	if(!$authSession->isLoggedIn())	{
		die(json_encode(array('login' => false)));
	}
	
	//Setup the details for jsonReply.
	$jsonRawData = array(
		'count' 	=> 		0,
		'content'	=>		array()
	);
	
	//We get the resources of the user.
	$userId = $authSession->getUserId();
	$sql = "SELECT `resource_name`, `resource_quantity`, `PricePerUnit` FROM ".PLAYER_RESOURCE.", ".RESOURCE_DETAIL." WHERE `user_id` = '{$userId}' AND ".PLAYER_RESOURCE.".`resource_id` = ".RESOURCE_DETAIL.".`resource_id`";
	$query = $db->query($sql);
	
	if($db->numRows($query)	{
		$count = 0;
		while($row = $db->result($query))	{
			$jsonRawData['content'][$count] = array(
				'name'				=> 	$row->resource_name,
				'qty'				=>  $row->resource_quantity,
				'price_per_unit'	=>  $row->PricePerUnit
			);
		}
		$count++;
		$jsonRawData['content'] = $content;
	}
	
	echo json_encode($jsonRawData);
?>