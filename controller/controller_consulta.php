<?php

    require_once('class.denuncia.php');

    $consulta = new DENUNCIA();

    if($_REQUEST['operacao'] == 'ListarDenuncias'){
      header('Content-type: application/json');
      $denuncia = $consulta->retornaLoc();

      $data['data'] = $denuncia;
      echo json_encode($data);
      exit;
    }

?>