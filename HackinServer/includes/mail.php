<?php

	/*
	 * This class is used to perform all the operations regarding the mail.
	 */

	class Mail	{
		
		//This is used to send the message to a user.
		public static function sendMail($sender, $senderName, $receiver, $message)	{
			global $db, $notification;
			
			$db->startTransaction();
			$sql = "INSERT INTO ".MAIL." VALUES (NULL, '{$sender}', '{$receiver}', DEFAULT, '{$message}', '0')";
			$query = $db->query($sql);
			if($query)	{
				//Add the notification.
				if($notification->addItem($receiver, "New mail from '{$senderName}'."))	{
					$db->commit();
				} else {
					$db->rollback();
				}
			} else {
				$db->rollback();
			}
		}
	}
?>