<?php
	/*
	 * This is used to maintain certain game details
	 */
	 
	class AuthHandler	{
		
		private $configData = array();
		
		//This holds all the details from the config table.
		public function __construct()	{
			global $db;
			
			$sql = "SELECT * FROM ".CONFIG;
			$query = $db->query($sql);
			if($db->numRows($query) > 0)	{
				while($result = $db->result($query))	{
					$this->configData[$result->config_name] = $result->config_value;
				}
				$db->freeResults($query);
			}
		}
		
		//This is used to remove all local data about the user.
		public function logout()	{
			global $db;
			$sql = "DELETE FROM ".CONFIG;
			$query = $db->query($sql);
			if($query)	{
				unset($this->configData);
				return true;
			} else {
				return false;
			}
		}
		
		//This is used to get some stuff
		public function get($key)	{
			if(isset($this->configData[$key]))	{
				return $this->configData[$key];
			} else {
				return NULL;
			}
		}
		
		//This is used to set the values during runtime. Also updates the DB.
		public function set($key, $value)	{
			global $db;
		
			$this->configData[$key] = $value;
			$sql = "SELECT * FROM ".CONFIG." WHERE `config_name` = '{$key}'";
			$query = $db->query($sql);
			if($db->numRows($query))	{
				$db->freeResults($query);
				$sql = "UPDATE ".CONFIG." SET `config_value` = '{$value}' WHERE `config_name` = '{$key}'";
				$query = $db->query($sql);
				return $query;
			} else {
				$sql = "INSERT INTO ".CONFIG." VALUES ('{$key}', '{$value}')";
				$query = $db->query($sql);
				return $query;
			}
		}
		
	}
?>