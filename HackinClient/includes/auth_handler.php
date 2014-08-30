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
		
		//This is used to get some stuff
		public function get($key)	{
			if(isset($configData[$key]))	{
				return $configData[$key];
			} else {
				return NULL;
			}
		}
	}
?>