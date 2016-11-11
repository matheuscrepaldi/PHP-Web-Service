<?php

    //ini_set('magic_quotes_runtime', 0);
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
     

     require_once('../class.denuncia.php');
    
     $denuncia = new DENUNCIA();

      $res = array(); 

      $resultado = $denuncia->retornaDenuncia($_POST['id']);

      foreach($resultado as $registro) { 

       
          $teste = array_push($res, array("id_den" => $registro['id_den'], "latitude" => $registro['latitude'], "longitude" => $registro['longitude'], "rua_den" => $registro['rua_den'], "num_den" => $registro['num_den'], "desc_categoria" => $registro['desc_categoria'], "desc_den" => $registro['desc_den'], "cidade_den" => $registro['cidade_den'], "status_den" => $registro['status_den']));     

      }    


      echo json_encode($res);

 }

else{
    echo 'error';
}

 
 ?>