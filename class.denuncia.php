<?php

require_once('dbconfig.php');

class DENUNCIA
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($udata, $lat, $long, $categoria)
	{
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO denuncias(data_den, latitude, longitude, cat_den) 
		                                               VALUES(:udata, :ulat, :ulon, :ucat)");
												  
			$stmt->bindparam(":udata", $udata);
			$stmt->bindparam(":ulat", $lat);
            $stmt->bindparam(":ulon", $long);
            $stmt->bindparam(":ucat", $categoria);
            
			$stmt->execute();	
			
            
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
    
    
    public function retornaLoc(){
        try {
                

                $stmt = $this->conn->query("select * from denuncias");
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                /*echo "'<pre>";
                print_r($rows) . "</pre>";*/
            
                return $rows;
              }
            
              catch(Exception $error) {
                  echo '<p>', $error->getMessage(), '</p>';
              }
    }

}
?>