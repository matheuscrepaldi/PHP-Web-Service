<?php
    
    require_once("model/model_categorias.php");
    
    $locDenuncia = new DENUNCIA();

    $locDenuncia->retornaLoc();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Localização</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
        
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelIndex = 0;

    
function initMap() {

  var myLatLng; //= {lat: -21.23765, lng: -50.40702};

    
  var map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: 15
  });
  //var infoWindow = new google.maps.InfoWindow({map: map});
        
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Você está aqui'
    });
    
    google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng, map);
    });
    
        //addMarker(myLatLng, map);


  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

        marker.setPosition(pos);
      //infoWindow.setContent('Você está aqui.');
        map.setCenter(pos);
        marker.setMap(map);
    }, function() {
      handleLocationError(true, marker, map.getCenter());
    });
  } else {
    handleLocationError(false, marker, map.getCenter());
  }
}
        
        
        
    function addMarker(location, map) {
      var marker = new google.maps.Marker({
          
        position: location,
        label: labels[labelIndex++ % labels.length],
        map: map
      });
}

google.maps.event.addDomListener(window, 'load', initMap);


function handleLocationError(browserHasGeolocation, marker, pos) {
  marker.setPosition(pos);
  marker.setContent(browserHasGeolocation ?
                        'Error: O serviço de geolocalização falhou.' :
                        'Error: O seu navegador não suporta o serviço de geolocalização.');
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUd6nzucTwkmTv7SAk4qF7udfDUa641GY&signed_in=true&callback=initMap"
        async defer>
    </script>
  </body>
</html>