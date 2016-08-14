
    
<script language="JavaScript">
    
	
	function validarBotao(botao){
		
		 document.form_cat.operacao.value = botao;
		 document.form_cat.submit();
	}


	
  $(document).ready(function(){

    $("#descricao").click(function(){

      $("#sucesso").toggleClass('form-group');
    })
    
    $("#descricao").blur(function(){
     if($(this).val() == "") {

            
        $("#sucesso").removeClass('form-group has-success');
        $("#sucesso").addClass('form-group has-error');
        $("#icone").removeClass('fa fa-check');
        $("#icone").addClass('fa fa-times-circle-o');
        bootbox.alert("O campo Descrição deve ser preenchido!");
          
        
      }

      else {
    
        $("#sucesso").removeClass('form-group has-error');
        $("#sucesso").addClass('form-group has-success');
        $("#icone").removeClass('fa fa-times-circle-o');  
        $("#icone").addClass('fa fa-check');  
      }

    });
})


  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#output').css({ 'display':'block' });
  };

</script>   


<form action="controller/controller_categorias.php" method="post" name="form_cat" id="form_cat" enctype="multipart/form-data">
    
    <input name="operacao" type="hidden" id="operacao" value="nula">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categorias
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Cadastrar Categoria</h3>
        </div>
        <div class="box-body">

       	  <div class="form-group" id="sucesso">
       	 	 <div class="col-xs-6">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i></label>
      	  		<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" />
       	 	</div>
       	  </div>
          
            <br>
            <br>
            <br>
            <br>

           <div class="form-group">
            <div class="col-xs-6">
                  <label for="exampleInputFile">Adicionar Imagem</label>
                  <input type="file" id="exampleInputFile" name="arquivo" title ="Escolher Arquivo" accept="image/*" onchange="loadFile(event)">
                    
                      <img id="output" src="#" alt="" class="margin" style="display:none; max-width: 160px; max-height: 160px; border: none;"/>
                   
            </div>
           </div>

          <br />
          <div class="row">

          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="salvar" onClick="validarBotao('salvar')">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" name="cancelar" onClick="validarBotao('cancelar')">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

        </div>

            </div>
            </div>
          </div>
            </div>
	</form>
