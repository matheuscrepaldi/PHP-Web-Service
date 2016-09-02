<?php

require_once('../model/model_categorias.php');


?>

<script>
var x=document.getElementById("demo");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="O seu navegador não suporta Geolocalização.";}
  }
function showPosition(position)
  {
  x.innerHTML="Latitude: " + position.coords.latitude +
  "<br>Longitude: " + position.coords.longitude; 
  }
</script>


<div>

<form method="post" action="../controller/controller_denuncias.php">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Consultar denúncia<p id="demo"></p></h3>
        </div>
        <div class="box-body">
          
          <br />
       
          
           <div class="form-group">
            <div class="col-xs-2"> 
                <label>Data</label>
      	  		<input type="date" class="form-control" name="data" placeholder="Data" value="" />
       	 	</div>
       	  </div>

       	  	<br />
			<br />
               <br />
            
       	  <div class="form-group">
       	  	<div class="col-xs-4"> 
      	  		  <label>Categoria</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                
                <?php 
                    
                    $categoria = new Categoria();

                    $resultado = $categoria->listar();
                    
                    foreach($resultado as $registro) {

                        echo "<option>" .$registro['desc_categoria']. "</option>";
                    }

                  
                  
                    
          
                  ?>    
                </select>
       	 	</div>
       	  </div>

       	  <br />
       	  <br />
            <br />

       	  <div class="form-group">
       	 	 <div class="col-xs-6">
                 <label>Descrição</label>
      	  		<textarea class="form-control" rows="3" placeholder=""></textarea>
       	 	</div>
       	  </div>

          <br />        
          <br />
          <br /> 
            <br />
            
          <div class="row">
          <!--<div class="col-xs-12 text-center">
          <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Salvar
          </button>
          </div>-->
          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="btn-salvar" onclick="getLocation()">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" title="Cancelar">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

        </div>

            </div>
            </div>
          </div>
      
      
        </div>
	</form>

          </div>

       

