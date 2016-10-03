<?php

require_once('../dbconfig.php');

    class DenunciaImg {	

        private $conn;

        public function __construct() {
            
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runQuery($sql) {
            
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function registrar($uimg) {
        
            try {
            

                $stmt = $this->conn->prepare("INSERT INTO denuncia_img(deni_img) VALUES (:uimg)");

                $stmt->bindparam(":uimg", $uimg);

                $stmt->execute();	

                return $stmt;	
            }
            catch(PDOException $e) {
            
                echo $e->getMessage();
            }				
        }

        
        public function listar(){
            
            try {
                

                $stmt = $this->conn->query("select * from denuncia_img order by idden_img");
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                /*echo "'<pre>";
                print_r($rows) . "</pre>";*/
                return $rows;
              }
            
              catch(Exception $error) {
                  echo '<p>', $error->getMessage(), '</p>';
              }
        }
        
         public function listarUnico($id){
            
            try {
                
                $sql = "select * from denuncia_img";
                
                if($id != 0) {
                    
                    $sql .= " where idden_img = " . $id;
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
        
        public function deletar($id) {
            
            try {

                  $stmt = $this->conn->prepare('DELETE FROM denuncia_img WHERE idden_img = :id');
                  $stmt->bindParam(':id', $id); 
                  $stmt->execute();

                  //echo $stmt->rowCount(); 
                }
            
                catch(PDOException $e) {
                  echo 'Error: ' . $e->getMessage();
                }
        }
        
        
    }

?>