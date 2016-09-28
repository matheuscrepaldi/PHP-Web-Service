<?php

require_once('dbconfig.php');

    class Consulta {	

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

        
        public function listar(){
            
            try {
                

                $stmt = $this->conn->query("select * from denuncias order by id_den");
                
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
                
                $sql = "select * from denuncias";
                
                if($id != 0) {
                    
                    $sql .= " where id_den = " . $id;
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
                
        
    }

?>