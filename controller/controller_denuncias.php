<?php

    require_once("../class.denuncia.php");

    $denuncia = new DENUNCIA();

print_r($_REQUEST); exit;

     if($_REQUEST['operacao'] == 'ListarDenuncias'){
      header('Content-type: application/json');
      $denuncias = $denuncia->retornaLoc($_REQUEST['usuario']);

      $data['data'] = $denuncias;
      echo json_encode($data);
      exit;
    }

    if($_POST['operacao'] == 'cancelar'){
        
       header("Location: ../index2.php"); 
        exit;
    }

    if($_POST['operacao'] == 'salvar'){
        
        $rua_correta = $_POST['endereco'];
        $cidade_correta = $_POST['cidade'];
        
        $rua = str_replace(' ',  '+', $_POST['endereco']);
        $numero = $_POST['numero'];
        $cidade = str_replace(' ', '+', $_POST['cidade']);
        $pais = 'BR';

        $url = 'http://maps.google.com.br/maps/api/geocode/json?address=';
        $url .= "$numero+$rua,+$cidade,+$pais&sensor=false";

        //echo $url; exit;

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $conteudo = curl_exec($c);
        curl_close($c);

        $json = json_decode($conteudo, false);

        /*echo "<pre>";
        print_r($conteudo);
        echo "</pre>";*/

        $latitude = $json->results[0]->geometry->location->lat;

        $longitude = $json->results[0]->geometry->location->lng;


        //insere denuncia

        $registro = $denuncia->register($_POST['data'], $latitude, $longitude, $_POST['categoria'], $rua_correta, $numero, $cidade_correta);
        header("Location: ../index2.php?page=view/denuncias"); 
        exit;
        /*echo 'latitude: ' . $latitude;
        echo 'longitude: ' . $longitude;*/
        
    }
?>

