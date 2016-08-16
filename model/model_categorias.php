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
    }


?>