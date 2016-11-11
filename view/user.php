<?php

  require_once("../session.php");
  
  require_once("../class.user.php");



  $auth_user = new USER();
  
  $user_id = $_SESSION['user_session'];

  $obj_user = $auth_user->listarUnico($user_id);


  //print_r($obj_user);

  $str = $obj_user['user_name'];

  $str = ucfirst($str);
  
?>

<script language="JavaScript">
    
	
	function validarBotao(botao){
		
		 document.form_user.operacao.value = botao;
		 document.form_user.submit();
	}
    
    
      $(function(){
          usuario = "<?php echo $user_id; ?>";
        tabela = $('#minhasDenuncias').DataTable({
          "ajax": {
            "url": 'controller/controller_denuncias.php',
            "data": {operacao: "ListarDenuncias", usuario: usuario},
            "type": "POST"
          },
          "language": {
            "url": "plugins/datatables/pt-br.json"
          },
          "columns": [
             
            {"data": "id_den", 
             "width": "5%"},
              {"data": "data_den", 
             "width": "10%"},
            {"data": "rua_den", 
             "width": "30%"}, 
           
               {"data": "cidade_den", 
             "width": "20%"},
              
              {"data": "desc_categoria", 
             "width": "20%"},
              
              {"data": "status_den", 
             "width": "40%"}
              
          ]
        })

      });
    
</script>    


<form action="controller/controller_user.php" method="post" name="form_user" id="form_user">

  <input name="operacao" type="hidden" id="operacao" value="nula">
    <input name="id" type="hidden" id="id" value="<?php echo $user_id;  ?>">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">

    
      <h1>
        Perfil do Usuário
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <br>
            	<?php if(($obj_user['user_tipo'] == 'A')){ ?>
             		 <img class="profile-user-img img-responsive img-circle" src="dist/img/avatar5.png" alt="User profile picture">
             	<?php } ?>

             	<?php if(($obj_user['user_tipo'] == 'U')){ ?>
             		 <img class="profile-user-img img-responsive img-circle" src="dist/img/avatar04.png" alt="User profile picture">
             	<?php } ?>

              <h3 class="profile-username text-center"><?php echo $str; ?></h3>

              <p class="text-muted text-center">
                
                <?php if(($obj_user['user_tipo'] == 'A')){ ?>
                  Administrador

                <?php } ?> 

                <?php if(($obj_user['user_tipo'] == 'U')){ ?>
                  Usuário

                <?php } ?> 

              </p>
                <br>
                
            <div class="box-header with-border">
              <h3 class="box-title">Email:</h3>
              <br/>
              <?php print($obj_user['user_email']); ?>
            </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
         <div class="box box-primary">
        <div class="box-header with-border">
             <h3 class="box-title">Alterar Senha</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                
              </div>
        </div>
        <div class="box-body">

           <div class="form-group" id="">
           <div class="col-xs-3">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i> Senha Atual</label>
      	  		<input type="password" class="form-control input-sm" name="senhaAtual" id="senhaAtual" placeholder="" value="" required />
       	 	</div>
          </div>

            <br>
            <br>
            <br>

       	  <div class="form-group" id="sucesso">
       	 	 <div class="col-xs-3">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i> Nova Senha</label>
      	  		<input type="password" class="form-control input-sm" name="senhaNova" id="senhaNova" placeholder="" value="" required />
       	 	</div>
       	  </div>
          
            <br>
            <br>
            <br>
                       
             <div class="form-group" id="sucesso">
       	 	 <div class="col-xs-3">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i> Repetir Nova Senha</label>
      	  		<input type="password" class="form-control input-sm" name="senhaRepetir" id="senhaRepetir" placeholder="" value="" required />
       	 	</div>
       	  </div>
            
          <br>
          <br>
          <div class="row">

          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="salvar" id="salvar" title="salvar" onClick="validarBotao('salvar')">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" name="cancelar" title="cancelar" onClick="validarBotao('cancelar')">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>
                

        </div>

            </div>
            </div>
          </div>


        </div>
          
          <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Minhas Denúncias</h3>
                </div>
              <!-- tools box -->
              
                    <div class="box-body">
                    <!--Conteudo da tabela-->    
        
                    <div class="box-body pad">
              
                        <table id="minhasDenuncias" class="table table-bordered table-hover">
                          <thead>
                            <tr>  
                                <th>Código</th>
                                <th>Data</th>
                                <th>Endereço</th>
                                <th>Cidade</th>
                                <th>Categoria</th>
                                <th>Status</th>
                            </tr>
                          </thead>
                        </table>
                        </div>
           
                        <!--Fim conteudo-->
                    </div>
                
                </div>
            </div>
              
          </div>

    </section>