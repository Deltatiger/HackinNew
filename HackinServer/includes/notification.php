<?php

	/*
	 * This class is used to add notifications for different users.
	 */


	class Notification	{
		//This is used to add a notification for a specified user.
		public function addItem($userid, $message)	{
			global $db;
			
			$sql = "INSERT INTO ".NOTIFICATION." VALUES (NULL, '{$userid}', '{$message}')";
			$query = $db->query($sql);
			return $query;
		}
	}
?>