<?php

    require_once("../class.denuncia.php");

    $denuncia = new DENUNCIA();

//print_r($endereco); exit;

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

$registro = $denuncia->register($_POST['data'], $latitude, $longitude, $_POST['categoria']);
header("Location: ../index2.php?page=view/denuncias"); 

/*echo 'latitude: ' . $latitude;
echo 'longitude: ' . $longitude;*/
?>

