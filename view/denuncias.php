<?php

//require_once('../model/model_categorias.php');

?>


<div>

<form method="post">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Consultar denúncia</h3>
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
       	  	<div class="col-xs-6"> 
      	  		  <label>Categoria</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected"></option>
                
                <?php /*
                  
                    $categoria = new Categoria();
                    
                    while($cat = $categoria->listar()) {
                    
                   
                        echo "<option>". $cat['desc_categoria'] ."</option>";
                 //<option disabled="disabled">California (disabled)</option>
          
                 }*/ ?>    
                </select>
       	 	</div>
       	  </div>

       	  <br />
       	  <br />
            <br />

       	  <div class="form-group">
       	 	 <div class="col-xs-6">
                 <label>Descrição</label>
      	  		<input type="text" class="form-control" name="descricao" placeholder="" />
       	 	</div>
       	  </div>

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
          		<button type="submit" class="btn btn-default btn-lrg" name="btn-salvar">
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

       

