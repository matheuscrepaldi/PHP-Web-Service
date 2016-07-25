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
		$atualiza = $this->conn->prepare($sql);
		return $atualiza;
	}
	
	public function register($udata,$uassunto,$udescricao)
	{
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$atualiza = $this->conn->prepare("INSERT INTO denuncias(data_denuncia,assunto_denuncia) 
		                                               VALUES(:udata, :uassunto)");
												  
			$atualiza->bindparam(":udata", $udata);
			$atualiza->bindparam(":uassunto", $uassunto);									  
				
			$atualiza->execute();	
			
			return $atualiza;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
}
?>