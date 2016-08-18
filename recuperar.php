<?php
	session_start();

	if(isset($_POST['btnSalvar'])){

		$uname 			= strip_tags($_POST['txtUsuario']);
		$campoSenha 	= strip_tags($_POST['txtSenha']);
		$campoNovaSenha = strip_tags($_POST['txtNovaSenha']);


		if($campoSenha == $campoNovaSenha){
			try {
				  $pdo = new PDO('mysql:host=mysql.hostinger.com.br;dbname=u633448963_login', "u633448963_root", "123456");
				  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				   
				  $stmt = $pdo->prepare('UPDATE users SET user_pass = :campoSenha WHERE user_name = :uname');
				  $stmt->execute(array(
				    ':campoSenha' => $campoSenha
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
  <title>VcPrefeito | Recuperar senha</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>Vc</b>Prefeito</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Redefina sua senha</p>

    <form method="post">
      
      <div class="form-group has-feedback">
       	 <input type="text" class="form-control" name="txtUsuario" placeholder="Nome de usuário">
         <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="txtSenha" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="txtNovaSenha" placeholder="Confirmar senha">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="btnSalvar" class="btn btn-primary btn-block btn-flat">Salvar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
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
