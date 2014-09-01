<?php

	/*
	 * This contains all the common functions.
	 */

	function generateRandString($length)	{
		//This generates a random string of $length charecters long
		$randomString = '';
		$range = str_split('abcdefghijklmnopqrstuvwxyz1234567890<>?:"{}!@#$%^&*()_+', '1');
		for($i = 0; $i < $length; $i++)	{
			$randomString .= $range[array_rand($range)];
		}
		return $randomString;
	}

	function clean($strToClean)	{
		global $db;
		return $db->escapeString(trim($strToClean));
	}
	
	function getUnusedCountry($username)	{
		//This is used to get a country for the new user.
		global $db;
		
		//Query the userid first since it wont have been set by $authSession yet.
		$sql = "SELECT `user_id` FROM ".USER_DETAIL." WHERE `user_name` = '{$username}'";
		$query = $db->query($sql);
		if($db->numRows($query))	{
			$userId = $db->result($query)->user_id;
			$db->freeResults($query);
			
			//Get a free country. Lets make this a single query
			$sql = "UPDATE ".COUNTRIES." AS mCountry, (SELECT `country` FROM ".COUNTRIES." WHERE `user_id` <=> NULL ORDER BY RAND() LIMIT 1) AS tCountry SET `mCountry`.`user_id` = '{$userId}' WHERE `mCountry`.`country` = `tCountry`.`country`";
			$query = $db->query($sql);
			if($query)	{
				$sql = "SELECT `country` FROM ".COUNTRIES." WHERE `user_id` = '{$userId}'";
				$query = $db->query($sql);
				$result = $db->result($query);
				$db->freeResults($query);
				return $result->country;
			} else {
				return NULL;
			}
			
		}
	}
?>
