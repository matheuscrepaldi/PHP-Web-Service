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

        public function update($cod, $desc, $img) {
        
            try {
            


                $stmt = $this->conn->prepare("UPDATE categorias SET desc_categoria = :desc, img_categoria = :img WHERE id_categoria = :cod");

                $stmt->bindparam(":cod", $cod);
                $stmt->bindparam(":desc", $desc);
                $stmt->bindparam(":img", $img);

                $stmt->execute(); 

                return $stmt; 
            }
            catch(PDOException $e) {
            
                echo $e->getMessage();
            }       
        }
        
        public function listar(){
            
            try {
                

                $stmt = $this->conn->query("select * from categorias order by desc_categoria");
                
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
                
                $sql = "select * from categorias";
                
                if($id != 0) {
                    
                    $sql .= " where id_categoria = " . $id;
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

                  $stmt = $this->conn->prepare('DELETE FROM categorias WHERE id_categoria = :id');
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