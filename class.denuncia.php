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
	
	public function register($udata,$uassunto,$udescricao)
	{
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO denuncias(data_denuncia,assunto_denuncia, descricao) 
		                                               VALUES(:udata, :uassunto, :udescricao)");
												  
			$stmt->bindparam(":udata", $udata);
			$stmt->bindparam(":uassunto", $uassunto);
            $stmt->bindparam(":udescricao", $udescricao);
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
    

}
?>