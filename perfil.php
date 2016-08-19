<?php

  require_once("session.php");
  
  require_once("class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  if(isset($_POST['btnSalvar'])){

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
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VcPrefeito | Perfil</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<form action="" method="post">
<div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    
      <h1>
        Perfil Usuário
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="dist/img/avatar5.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php print($userRow['user_name']); ?></h3>

              <p class="text-muted text-center">
                
                <?php if(($userRow['user_tipo'] == 'A')){ ?>
                  Administrador

                <?php } ?> 

                <?php if(($userRow['user_tipo'] == 'U')){ ?>
                  Usuário

                <?php } ?> 

              </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Email:</h3>
              <br/>
              <?php print($userRow['user_email']); ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
         <div class="nav-tabs-custom">
          <div class="content">

          <h3>
            Editar perfil
          </h3>

            <div class="form-group">
              <div class="col-xs-3"> 
                <input type="text" class="form-control" name="txtUsuario" placeholder="Nome de usuário"/>
              </div>
            </div>

            <br/>
            <br/>

            <div class="form-group">
              <div class="col-xs-3"> 
                <input type="password" class="form-control" name="txtSenha" placeholder="Nova senha" value="<?php if(isset($error)){echo $upass;}?>" />
              </div>
            </div>

            <br/>
            <br/>

            <div class="form-group">
              <div class="col-xs-3"> 
                <input type="password" class="form-control" name="txtNovaSenha" placeholder="Confirmar senha" value="<?php if(isset($error)){echo $upass;}?>" />
              </div>
            </div>

            
            <br/>

            <div class="col-xs-12 text-center">
              <button type="submit" class="btn btn-default btn-lrg" name="Salvar">
                <i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
              </button>
          
            <button type="button" class="btn btn-default btn-lrg" title="Cancelar">
                <i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
            </button>

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
  </div>
  <!-- /.content-wrapper -->
      </div>
    </div>
  </aside>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
