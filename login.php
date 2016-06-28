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
    <title>Log in - VcPrefeito</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  </head>
  <body class="hold-transition login-page">

  	<div class="signin-form">

		<div class="container">
     	
     	<div class="login-logo">
   			 <a href="../../index2.html"><b>Admin</b>LTE</a>
  		</div>

      	<div class="login-box-body">
    		<p class="login-box-msg">Entre para realizar uma denúncia</p>

 			   <form class="form-signin" method="post" id="login-form">
      			<div class="form-group has-feedback">
        			<input type="email" class="form-control" placeholder="Email">
        			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      			</div>

      	<div class="form-group has-feedback">
        	<input type="password" class="form-control" placeholder="Senha">
        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
      	</div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Manter-se conectado
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>Entrar usando Facebook</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="#">Esqueci minha senha</a><br>
    <a href="register.html" class="text-center">Registrar-se</a>

  </div>
 		<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="../../plugins/iCheck/icheck.min.js"></script>	
	<script>
 	 $(function () {
    	$('input').iCheck({
      	checkboxClass: 'icheckbox_square-blue',
      	radioClass: 'iradio_square-blue',
      	increaseArea: '20%' // optional
    	});
  	});

	</script>
 </body>
</html>
