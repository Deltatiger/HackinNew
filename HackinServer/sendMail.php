<?php

	include_once 'includes/config.php';
	
	$senderId = $authSession->getUserId();
	$receiver = rawurldecode($_POST['receiver']);
	$message = rawurldecode($_POST['message']);
	
	$rawData = array(
		'success'			=> false
	);
	
	//Get the senders country name.
	$sql = "SELECT `country` FROM ".COUNTRIES." WHERE `user_id` = '{$senderId}'";
	$query = $db->query($sql);
	$result = $db->result($query);
	$senderCountry = $result->country;
	
	//Get the receiver's mail id.
	$sql = "SELECT `user_id` FROM ".USER_DETAIL.", ".COUNTRIES." WHERE ".USER_DETAIL.".`user_id` = ".COUNTRIES.".`user_id` AND `country` = '{$receiver}'";
	$query = $db->query($sql);
	if($db->numRows($query))	{
		$result = $db->result($query);
		$receiverId = $result->user_id;
		if(Mail::sendMail($senderId, $senderCountry, $receiverId, $message))	{
			//All good.
			$rawData['success'] = true;
		}
	}
	
	echo json_encode($rawData);

?>