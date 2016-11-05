<?php

    //ini_set('magic_quotes_runtime', 0);
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
     

     require_once('../class.denuncia.php');
    
     $denuncia = new DENUNCIA();

      $res = array(); 

      $resultado = $denuncia->retornaLocBetween($_POST['latN'],$_POST['latS'],$_POST['lgtN'],$_POST['lgtS']);

      foreach($resultado as $registro) { 

       
          $teste = array_push($res, array("id_den" => $registro['id_den'], "latitude" => $registro['latitude'], "longitude" => $registro['longitude'], "rua_den" => $registro['rua_den'], "num_den" => $registro['num_den']));     

      }    


      echo json_encode($res);

 }

else{
    echo 'error';
}

 
 ?>