<?php
    require_once("class.denuncia.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
      <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>

<script src="plugins/fastclick/fastclick.js"></script>

<script src="dist/js/app.min.js"></script>

<script src="plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="plugins/chartjs/Chart.min.js"></script>

<script src="dist/js/demo.js"></script>
<script src="bootbox.min.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
      
      
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
        
    function abrirDenuncia(id){
  
        $.ajax({
          type: "POST",
          url: 'controller/controller_denuncias.php',
          dataType: 'json',    
          data: {operacao : "ConsultaDenuncia", denuncia : id},
          success: function (response) {

            console.log(response);
             var denuncia = response.data[0];
             var status = 'Não Resolvida';
             var imgs = '';
             var caminho_img = '';
              
             if(denuncia.status_den == 'F') status = 'Resolvida';

             $.each(response.img, function (index, value) {
                //console.log(value);
                 caminho_img = value.deni_img.replace("../", "");
                imgs += '<a href="'+ caminho_img +'" target="_blank"><img id="output" src="'+ caminho_img +'" alt="" class="img-rounded" style=" max-width: 160px; max-height: 160px; border: none;"/></a>&nbsp;&nbsp;';

             });
             
             
            bootbox.alert({ message: '<form id="userForm" method="post" class="form-horizontal"> <div class="form-group"><label class="col-xs-4 control-label">Data: </label>  <div class="col-xs-2"><input type="text" class="form-control" name="id" disabled="disabled" value="'+ denuncia.data_den +'" /></div><label class="col-xs-1 control-label">Status: </label><div class="col-xs-3"><input type="text" class="form-control" name="id" disabled="disabled" value="'+ status +'" /></div></div><div class="form-group"><label class="col-xs-4 control-label">Categoria: </label><div class="col-xs-6"><input type="text" class="form-control" name="name" value="'+ denuncia.desc_categoria +'"  disabled="disabled" /></div></div><div class="form-group"><label class="col-xs-4 control-label">Descrição: </label><div class="col-xs-6"><textarea class="form-control" rows="2" id="comment" disabled="disabled" style="resize: none;">'+ denuncia.desc_den +'</textarea></div> </div><div class="form-group"><label class="col-xs-4 control-label">Localização: </label><div class="col-xs-6"><input type="text" class="form-control" name="website" value="'+ denuncia.rua_den + ' / ' + denuncia.cidade_den +'"  disabled="disabled" /></div></div><div class="form-group"><div class="col-xs-2"></div><div class="col-xs-8"><div class="imagem" align="center">'+imgs+'</div></div><div class="col-xs-2"></div></div></form>',
              title: "Denúncia: " + id,               
              size: 'large',
              backdrop: true
            });
        }
        });
      }
        
        
    var labels = '';
    var labelIndex = 0;
    var map;

    
function initMap() {

    var myLatLng; //= {lat: -21.23765, lng: -50.40702};
    
    
    map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: 15
  });
  //var infoWindow = new google.maps.InfoWindow({map: map});
        
    var marker = new google.maps.Marker({
        position: MostraPonto(),
        map: map,
        icon: 'img/marcador.png',
        title: 'Você está aqui.'
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
        
        
        
    function addMarker(location, id) {
        var marker = new google.maps.Marker({
            position: location,
            label: labels[labelIndex++ % labels.length],
            // icon: 'img/'+ img + '.png',
            map: map
        });
        
        marker.addListener('click', function() {
<<<<<<< HEAD
            //window.location.assign("view/relatorio.php");
            abrirDenuncia(id);
=======
            parent.changePage('view/relatorio.php');
            //window.location.assign("view/relatorio.php");
          
>>>>>>> origin/master
        });
    }
        
google.maps.event.addDomListener(window, 'click', initMap);


function handleLocationError(browserHasGeolocation, marker, pos) {
  marker.setPosition(pos);
  marker.setContent(browserHasGeolocation ?
                        'Error: O serviço de geolocalização falhou.' :
                        'Error: O seu navegador não suporta o serviço de geolocalização.');
}
        
        function MostraPonto(){
           
           <?php 
                 $denLoc = new DENUNCIA();

                $resultado = $denLoc->retornaDenuncia();

                foreach($resultado as $result){ ?>
                   var latlng = {lat:  <?php echo $result['latitude']; ?>, lng: <?php echo $result['longitude']; ?>};
                    var id_den = "<?php echo $result['id_den']; ?>";
                    
                    addMarker(latlng, id_den);
            
            <?php    }
            ?>
        }

            
                    
        
        
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUd6nzucTwkmTv7SAk4qF7udfDUa641GY&signed_in=true&callback=initMap"
        async defer>
    </script>
  </body>
</html>