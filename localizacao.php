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
  var myLatLng; //= {lat: -25.363, lng: 131.044};
  var id =  "<?php echo $locDenuncia; ?>";

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: id
  });

  var marker = new google.maps.Marker({
    position: id,
    map: map,
    title: 'Hello World!'
  });

marker.setMap(map);
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
        
        //ultima tentativa antes de dormir
    function inserirPonto(lat, long) {

        var myLatlng = new google.maps.LatLng(lat,long);
        var mapOptions = {
        zoom: 15,
        center: myLatlng
    }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Hello World!"
    });

    // To add the marker to the map, call setMap();
        marker.setMap(map);

}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUd6nzucTwkmTv7SAk4qF7udfDUa641GY&signed_in=true&callback=initMap"
        async defer>
    </script>
    <?php
      
        require_once("class.denuncia.php");

        $locDenuncia = new DENUNCIA();

        $locDenuncia->retornaLoc();
      
      ?>
      
  </body>
</html>