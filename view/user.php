<?php

  require_once("../session.php");
  
  require_once("../class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $str = $userRow['user_name'];

  $str = ucfirst($str);

  /*if(isset($_POST['btnSalvar'])){

    $uname      = $_POST['txtUsuario'];
    $campoSenha   = $_POST['txtSenha'];
    $campoNovaSenha = $_POST['txtNovaSenha'];


    if($campoSenha == $campoNovaSenha){
      try {
          $pdo = new PDO('mysql:host=localhost;dbname=u633448963_login', "root", "");
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $campoSenha = password_hash($campoSenha, PASSWORD_DEFAULT);
           
          $stmt = $pdo->prepare('UPDATE users SET user_pass = :campoSenha WHERE user_name = :uname');
          $stmt->execute(array(
            ':campoSenha' => $campoSenha,
            //':campoNovaSenha' => $campoNovaSenha,
            ':uname' => $uname
          ));
             
          echo $stmt->rowCount(); 
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }else{
      echo "Senhas não batem!";
    }
  }*/

?>


<form action="" method="post">

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
            	<?php if(($userRow['user_tipo'] == 'A')){ ?>
             		 <img class="profile-user-img img-responsive img-circle" src="dist/img/avatar5.png" alt="User profile picture">
             	<?php } ?>

             	<?php if(($userRow['user_tipo'] == 'U')){ ?>
             		 <img class="profile-user-img img-responsive img-circle" src="dist/img/avatar04.png" alt="User profile picture">
             	<?php } ?>

              <h3 class="profile-username text-center"><?php print($str); ?></h3>

              <p class="text-muted text-center">
                
                <?php if(($userRow['user_tipo'] == 'A')){ ?>
                  Administrador

                <?php } ?> 

                <?php if(($userRow['user_tipo'] == 'U')){ ?>
                  Usuário

                <?php } ?> 

              </p>
                <br>
                
            <div class="box-header with-border">
              <h3 class="box-title">Email:</h3>
              <br/>
              <?php print($userRow['user_email']); ?>
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
      	  		<input type="text" class="form-control input-sm" name="descricao" id="descricao" placeholder="" value="<?php if(isset($obj_cat))  echo $obj_cat['desc_categoria']; ?>" />
       	 	</div>
          </div>

            <br>
            <br>
            <br>

       	  <div class="form-group" id="sucesso">
       	 	 <div class="col-xs-3">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i> Nova Senha</label>
      	  		<input type="text" class="form-control input-sm" name="descricao" id="descricao" placeholder="" value="<?php if(isset($obj_cat))  echo $obj_cat['desc_categoria']; ?>" />
       	 	</div>
       	  </div>
          
            <br>
            <br>
            <br>
                       
             <div class="form-group" id="sucesso">
       	 	 <div class="col-xs-3">
              <label class="" for="inputSuccess" id="label"><i class="" id="icone"></i> Repetir Nova Senha</label>
      	  		<input type="text" class="form-control input-sm" name="descricao" id="descricao" placeholder="" value="<?php if(isset($obj_cat))  echo $obj_cat['desc_categoria']; ?>" />
       	 	</div>
       	  </div>
            
          <br>
          <br>
          <div class="row">

          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="salvar" id="salvar" title="salvar" onClick="validarExclusao('salvar', <?php if(isset($obj_cat)) echo $obj_cat['id_categoria']; else echo '0'; ?>)">
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
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    </form>
    <!-- /.content -->
