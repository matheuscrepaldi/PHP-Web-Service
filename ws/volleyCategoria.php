<?php

    ini_set('magic_quotes_runtime', 0);
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
     

     require_once('../model/model_categorias.php');
    
     $categoria = new Categoria();

      $res = array(); 

      $resultado = $categoria->listar();

      foreach($resultado as $registro) { 

       
          $teste = array_push($res, array("id_categoria" => $registro['id_categoria'], "desc_categoria" => $registro['desc_categoria'], "img_categoria" => "http://192.168.0.103:81/tcc/controller/" . $registro['img_categoria']));     

      }    


      echo json_encode($res);



     
 }

else{
    echo 'error';
}

 
 ?>


