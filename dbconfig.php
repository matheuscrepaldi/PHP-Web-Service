<?php
class Database
{   
    
    private $host = "localhost";
    private $db_name = "u633448963_login";
    private $username = "root";
    private $password = "";

    /*private $host = "31.220.104.1";
    private $db_name = "u633448963_tcc";
    private $username = "u633448963_root";
    private $password = "123123";*/

    public $conn;
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
?>