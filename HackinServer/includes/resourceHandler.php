<?php

	//This class is used to take care of adding the resources and stuff.
	
	class ResourceHandler	{
		private $userId;
		
		public function __construct($userId = NULL)	{
			//This is used to get and set the user ID.
			global $authSession;
			if($userId != NULL)	{
				$this->userId = $userId;
			} else {
				if(!$authSession->isLoggedIn())	{
					$this->userId = null;
				} else {
					$this->userId = $authSession->getUserId();
				}
			}
		}
		
		public function addResource($resourceId, $qty)	{
			//This is used to add more resources to the player with `$userId`
			global $db;
			//First make sure the resourceId exists.
			$sql = "SELECT `resource_name` FROM ".RESOURCE_DETAIL." WHERE `resource_id` = '{$resourceId}'";
			$query = $db->query($sql);
			if($db->numRows($query))	{
				$db->freeResults($query);
				//Check if this entry exists in the table.
				$sql = "SELECT `resource_quantity` FROM ".PLAYER_RESOURCE." WHERE `user_id` = '{$this->userId}' AND `resource_id` = '{$resourceId}'";
				$query = $db->query($sql);
				if($db->numRows($query))	{
					$db->freeResults($query);
					$sql = "UPDATE ".PLAYER_RESOURCE." SET `resource_quantity` = `resource_quantity` + {$qty} WHERE `resource_id` = '{$resourceId}' AND `user_id` = '{$this->userId}'";
					$query = $db->query($sql);
					return $query;
				} else {
					$sql = "INSERT INTO ".PLAYER_RESOURCE." VALUES ('{$this->userId}', '{$resourceId}', '{$qty}', '-1')";
					$query = $db->query($sql);
					return $query;
				}
			} // No such entry
			return false;
		}
		
		public function reduceResource($resourceId, $qty)	{
			//This removes resources and their entries from the table
			global $db;
			//First make sure the resourceId exists.
			$sql = "SELECT `resource_name` FROM ".RESOURCE_DETAIL." WHERE `resource_id` = '{$resourceId}'";
			$query = $db->query($sql);
			if($db->numRows($query))	{
				$db->freeResults($query);
				//Check if this entry exists in the table.
				$sql = "SELECT `resource_quantity` FROM ".PLAYER_RESOURCE." WHERE `user_id` = '{$this->userId}' AND `resource_id` = '{$resourceId}'";
				$query = $db->query($sql);
				if($db->numRows($query))	{
					$result = $db-result($query);
					$db->freeResults($query);
					//Check if the qty is more than or equal to given remove qty
					if($result->resource_quantity >= $qty)	{
						$sql = "UPDATE ".PLAYER_RESOURCE." SET `resource_quantity` = `resource_quantity` - {$qty} WHERE `resource_id` = '{$resourceId}' AND `user_id` = '{$this->userId}'";
						$query = $db->query($sql);
						return $query;
					} else {
						return -1;
					}
				}
			}
			//No such entry in either of the two tables.
			return 0;
		}
	}

?>