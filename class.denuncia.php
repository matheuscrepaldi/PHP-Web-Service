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
	
	public function register($udata, $lat, $long, $categoria, $rua, $numero, $cidade)
	{
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO denuncias(data_den, latitude, longitude, cat_den, rua_den, num_den, cidade_den) 
		                                               VALUES(:udata, :ulat, :ulon, :ucat, :urua, :unum, :ucid)");
												  
			$stmt->bindparam(":udata", $udata);
			$stmt->bindparam(":ulat", $lat);
            $stmt->bindparam(":ulon", $long);
            $stmt->bindparam(":ucat", $categoria);
            $stmt->bindparam(":urua", $rua);
            $stmt->bindparam(":unum", $numero);
            $stmt->bindparam(":ucid", $cidade);
            
            
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
                

                $stmt = $this->conn->query("select id_den, DATE_FORMAT(data_den, '%d/%m/%Y') data_den, cat_den,latitude, longitude, rua_den, num_den, cidade_den  from denuncias order by id_den");
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                /*echo "'<pre>";
                print_r($rows) . "</pre>";*/
            
                return $rows;
              }
            
              catch(Exception $error) {
                  echo '<p>', $error->getMessage(), '</p>';
              }
    }
    
    public function retornaLocBetween($latN, $latS, $lgtN, $lgtS){
        try {
                

                $stmt = $this->conn->query("select id_den, DATE_FORMAT(data_den, '%d/%m/%Y') data_den, latitude, longitude, rua_den, num_den, cidade_den  from denuncias 
                 where latitude between " . $latS . " and " . $latN . " AND longitude between ". $lgtS ." and ".$lgtN." 
                 order by id_den");
                
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