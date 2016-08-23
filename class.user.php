<?php

require_once('dbconfig.php');

class USER
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
	
	public function register($uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) 
		                                               VALUES(:uname, :umail, :upass)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $upass);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	public function alterar($id, $antiga, $nova){
 
        
        try {
            
            
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id=:id ");
			$stmt->execute(array(':id'=>$id));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            
			if($stmt->rowCount() == 1) {
                
				if(password_verify($antiga, $userRow['user_pass'])) {
                    
                    $campoSenha = password_hash($nova, PASSWORD_DEFAULT);

                    $stmt = $this->conn->prepare("UPDATE users SET user_pass = :senha WHERE user_id = :id");

                    $stmt->bindparam(":senha", $campoSenha);
                    $stmt->bindparam(":id", $id);

                    $stmt->execute(); 

                    return $stmt; 
				}
                
				else {
                    
					return false;
				}
			}
            

            }
        
            catch(PDOException $e) {
            
                echo $e->getMessage();
            }     

        }
    
    
     public function listarUnico($id){
            
            try {
                
                $sql = "select * from users";
                
                if($id != 0) {
                    
                    $sql .= " where user_id = " . $id;
                }

                $stmt = $this->conn->query($sql);
                
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);

                /*echo "'<pre>";
                print_r($rows) . "</pre>";*/
                return $rows;
              }
            
              catch(Exception $error) {
                  echo '<p>', $error->getMessage(), '</p>';
              }
        }
	
	
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass, user_tipo FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
                    $_SESSION['user_tipo'] = $userRow['user_tipo'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>