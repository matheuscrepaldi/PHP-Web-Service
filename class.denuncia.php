<?php

require_once('dbconfig.php');
require_once('class.user.php');

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
    
     public function selectDinamico($sql){
        try {
                
                //echo "to aqui";
                $stmt = $this->conn->query($sql);
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                return $rows;
              }
            
              catch(Exception $error) {
                  echo '<p>', $error->getMessage(), '</p>';
              }
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
    
    public function inserir($udesc, $ucat, $lat, $long, $end, $cid)
	{
		try
		{
			//$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO denuncias(desc_den, data_den, cat_den, latitude, longitude, rua_den, cidade_den, user_den) VALUES(:udesc, now(), :ucat, :ulat, :ulong, :uend, :ucid, 0)");
												  
			$stmt->bindparam(":udesc", $udesc);
            $stmt->bindparam(":ucat", $ucat);
            $stmt->bindparam(":ulat", $lat);
            $stmt->bindparam(":ulong", $long);
            $stmt->bindparam(":uend", $end);
            $stmt->bindparam(":ucid", $cid);
            
			$stmt->execute();	
			
            
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
    
    
    
    
    
    public function retornaLoc($user_id){
        try {
                

                $stmt = $this->conn->query("select id_den, DATE_FORMAT(data_den, '%d/%m/%Y') data_den, status_den,cat_den,latitude, longitude, rua_den, num_den, cidade_den, categorias.*  from denuncias  left join categorias on (cat_den = id_categoria) left join users on (user_den = user_id) where user_id = ". $user_id ." order by id_den");
                
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
    
     public function retornaUmaCidade($cidade){
        try {
                

                $stmt = $this->conn->query("select id_den, cidade_den from denuncias where cidade_den = '". $cidade ."' group by cidade_den order by cidade_den ");
            
                //print_r($stmt); exit;
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                
                //print_r($rows);
            
                return $rows;
              }
            
              catch(Exception $error) {
                  echo '<p>', $error->getMessage(), '</p>';
              }
    }
    
     public function retornaCidade(){
        try {
                

                $stmt = $this->conn->query("select id_den, cidade_den from denuncias group by cidade_den order by cidade_den ");
            
                
                
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