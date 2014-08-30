<?php

/*
 * This has the connection to the mysql database.
 */
class DB    {
    private $con;
    private $dbName;
  
    //This is the constructor
    function __construct() {
        $this->con = mysqli_connect('localhost','root','', 'Hackin14');
        if (mysqli_connect_errno())  {
            die('Could not Connect to the DataBase.');
        }
        /*mysqli_select_db('eclub', $this->con);*/
        $this->dbName = 'Hackin14';
    }
    
    function __destruct()   {
        mysqli_close($this->con);
    }
    
    public function escapeString($str)  {
        return mysqli_real_escape_string($this->con, $str);
    }
    
    public function freeResults($result)   {
        if(is_a($result, 'mysqli_result'))  {
            @mysqli_free_result($result);
        }
    }
    
    public function name() {
        return $this->dbName;
    }
    
    public function reconnect() {
        //This closes the current connection and reconnects. Avoiding Resource unavailable error for now.
        mysqli_close($this->con);
        $this->con = mysqli_connect('localhost', 'deltax13_admin', '12eclub34', 'deltax13_eclub') or die('Could not connect to DB.');
        if(mysqli_connect_errno($this->con))  {
            die('Could not Connect to the DataBase.');
        }
    }
	
	public function rollback()	{
		$this->query("ROLLBACK");
	}
	
	public function commit()	{
		$this->query("COMMIT");
	}
	
	public function startTransaction()	{
		$this->query("START TRANSACTION");
	}
    
    public function result($query)  {
        $result =  mysqli_fetch_object($query);
        return $result;
    }
    
    public function numRows($query)  {
        return mysqli_num_rows($query);
    }
    
    public function query($sqlQuery) {
        /**
         * This function is used to perform mysql_query() (or) mysqli_query() on the open Connection.
         */
        if($query = mysqli_query($this->con, $sqlQuery))    {
            return $query;
        } else {
             die('SQL Error : '. mysqli_error($this->con).'<br />'.$sqlQuery);
        }
    }
    
}
?>
