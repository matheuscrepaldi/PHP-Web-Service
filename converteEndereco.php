<?php

$rua = str_replace(' ',  '+', 'Yuri Gagarin');
$numero = '20';
$cidade = str_replace(' ', '+', 'Aracatuba');
$pais = 'BR';

$url = 'http://maps.google.com.br/maps/api/geocode/json?address=';
$url .= "$numero+$rua,+$cidade,+$pais&sensor=false";

echo $url; exit;

$c = curl_init();
curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$conteudo = curl_exec($c);
curl_close($c);

$json = json_decode($conteudo, false);

//print_r($conteudo);

echo 'latitude: ', $json->results[0]->geometry->location->lat, "\n";
echo 'longitude: ', $json->results[0]->geometry->location->lng;

?>

