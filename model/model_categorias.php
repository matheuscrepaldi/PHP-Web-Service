<?php

require_once('../dbconfig.php');

    class Categoria {	

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

        public function register($udesc, $uimg) {
        
            try {
            


                $stmt = $this->conn->prepare("INSERT INTO categorias(desc_categoria, img_categoria) VALUES (:udesc, :uimg)");

                $stmt->bindparam(":udesc", $udesc);
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
                

                $stmt = $this->conn->query("select * from categorias limit 10");
                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

                  $stmt = $this->conn->prepare('DELETE FROM categorias WHERE id_categoria = :id');
                  $stmt->bindParam(':id', $id); 
                  $stmt->execute();

                  echo $stmt->rowCount(); 
                }
            
                catch(PDOException $e) {
                  echo 'Error: ' . $e->getMessage();
                }
        }
    }

?>