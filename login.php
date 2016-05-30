<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
  $login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
  $uname = strip_tags($_POST['txt_uname_email']);
  $umail = strip_tags($_POST['txt_uname_email']);
  $upass = strip_tags($_POST['txt_password']);
    
  if($login->doLogin($uname,$umail,$upass))
  {
    $login->redirect('home.php');
  }
  else
  {
    $error = "Dados Incorretos!";
  } 
}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  </head>
  <body class="hold-transition login-page">
  <form method="POST" action="login.php">
    <div class="login-box">
      <div class="login-logo"><img src="img/logo.png"><br>
      </div><!-- /.login-logo -->
      <div class="login-box-body">

<form action="home.php" method="post">

      <div class="form-group">
          <input type="text" class="form-control" name="txt_uname_email" placeholder="Usuário ou Email" required />
          <span id="check-e"></span>
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="txt_password" placeholder="Senha" />
        </div>
        
        <div class="form-group">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div><!-- /.col -->
        </div>  
        <br>
        <br>
            <label>Não possui uma conta? <a href="sign-up.php">Registre-se</a></label>
            <br>
            <label><a href="esqueci.php">Esqueci minha senha</a></label>

        </form>

        <div class="social-auth-links text-center">
          <p>- OU -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Entrar com o Facebook</a>
        </div>

      </div>

    </div>

    
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' 
        });
      });
    </script>
  </body>
</html>
