<?php
	/*
	 * This is used to authenticate a user based on the auth token that he has.
	 */
	 
	class AuthSession	{
		private $authToken;
		private $isValidToken;
		private $userIp = NULL;	//Do we need to store this ?
		private $userId = NULL;
	
		public function __construct($authToken)	{
			//this is used to check the auth token from the user via CURL
			global $db;
			
			//This is the case for a signup 
			if($authToken == NULL || $authToken == '')	{
				$this->isValidToken = false;
				$this->authToken = NULL;
				return;
			}
			
			//Clean the authToken just in case
			$authToken = clean($authToken);
			
			$sql = "SELECT `user_id`, `log_time`, `log_ip` FROM ".AUTH_DETAIL." WHERE `auth_token` = '{$authToken}'";
			$query = $db->query($sql);
			
			if($db->numRows($query) > 0)	{
				//Check the login time and IP.
				$userCurrentIp = $_SERVER['REMOTE_ADDR'];
				$result = $db->result($query);
				if($result->log_ip == $userCurrentIp)	{
					//A Valid session it is.
					$this->userIp = $result->user_id;
					$this->authToken = $authToken;
					$this->userId = $result->user_id;
				} 
				$db->freeResults($query);
			}
		}
		
		private static function deAuthenticateToken($authToken)	{
			//this is used to delete the authToken
			global $db;
			
			$sql = "DELETE FROM ".AUTH_DETAIL." WHERE `auth_token` = '{$this->authToken}'";
			$query = $db->query($sql);
			if($query)	{
				$this->authToken = false;
				$this->isValidToken = false;
				$this->userIp = NULL;
				$this->userId = NULL;
			}
			
			return $query;
		}
		
		public static function createAuthToken($username, $password)	{
			//this is used to create and send an authentication token for the users.
			global $db;
			
			//Check the user details.
			$usernameClean = strtolower(clean($username));
			$passwordClean = sha1(clean($password));
			$sql = "SELECT `user_id` FROM ".USER_DETAIL." WHERE LOWER(`user_name`) = '{$usernameClean}' AND `user_pass` = '{$passwordClean}'";
			$query = $db->query($sql);
			if($db->numRows($query) == 1)	{
				//First check if an auth token already exists for that user
				$userDetails = $db->result($query);
				$db->freeResults($query);
				//Check the db
				$sql = "SELECT * FROM ".AUTH_DETAIL." WHERE `user_id` = '{$userDetails->user_id}'";
				$query = $db->query($sql);
				if($db->numRows($query))	{	//Already the token exists for the user.
					$result = $db->result($query);
					$db->freeResults($query);
					return $result->auth_token;
				}
				
				//We have some valid entries. Create a new authToken.
				$authToken = sha1(generateRandString(10));
				//Check if it exists in the db.
				$sql = "SELECT * FROM ".AUTH_DETAIL." WHERE `auth_token` = '{$authToken}'";
				$query1 = $db->query($sql);
				do	{
					$query1 = $db->query($sql);
					if($db->numRows($query1) > 0)	{
						$authToken = sha1(generateRandString(10));
						echo $sql;
					} else {
						break;
					}
				} while(true);
				$result = $db->result($query);
				$db->freeResults($query);
				$cTime = time();
				$userIP = $_SERVER['REMOTE_ADDR'];
				//Add it to the db.
				$sql = "INSERT INTO ".AUTH_DETAIL." VALUES ('{$authToken}', '{$result->user_id}', '{$cTime}', '{$userIP}')";
				$query = $db->query($sql);
				if($query)	{
					return $authToken;
				} else {	//Some sort of error. Let them try again.
					return -2;
				}
			} else {
				//Invalid login credentials.
				return -1;
			}
		}
		
		public function isLoggedIn()	{
			//This is used to return the login status of the user.
			return ($this->userId != NULL);
		}
		
		//Some getter functions
		public function getAuthToken()	{
			return $this->authToken;
		}
		
		public function getUserId()		{
			return $this->userId;
		}
		
		public function getUserIp()	{
			return $this->userIp;
		}
	}
?>