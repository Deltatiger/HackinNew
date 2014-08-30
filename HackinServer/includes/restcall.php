<?php
	/*
	 * This class is used to make rest calls from the client to the different files on the server.
	 */
	
	class RestCall	{
		
		//This class holds all the details required to make the rest call.
		private $url = "";
		private $postVarData = "";
		
		public function __construct($url, $postVars)	{
			//This gets the various data and sets up the stuff.
			$this->url = $url;
			//We have to first check if the CURL is to a valid page or not.
			//TODO: Implement the valid page check here
			if(!is_array($postVars))	{
				return null;
			}
			
			$this->postVarData = "";
			foreach($postVars as $key => $value)	{
				$keyClean = rawurlencode($key);
				$valueClean = rawurlencode($value);
				$this->postVarData .= "{$keyClean}={$valueClean}&";
			}
			$this->postVarData = substr($this->postVarData, 0, strlen($this->postVarData) - 1);
			//Now this should be a clean link.
		}
		
		public function makeRestCall()	{
			//This is the main workhorse of this class. This creates the CURL and does the work
			//This returns the data from the specified url page.
			
			$ch = curl_init();
			
			if($ch == false)	{
				return -1;
			}
			
			$timeout = 10;	//TODO: Move this to the constants folder.
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postVarData);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			
			$data = curl_exec($ch);
			curl_close($ch);
			
			return $data;
		}
	}
?>