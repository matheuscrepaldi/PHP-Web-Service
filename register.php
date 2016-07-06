<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
  $user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
  $uname = strip_tags($_POST['txt_uname']);
  $umail = strip_tags($_POST['txt_umail']);
  $upass = strip_tags($_POST['txt_upass']); 
  
  if($uname=="")  {
    $error[] = "Preencha o nome de usuário."; 
  }
  else if($umail=="") {
    $error[] = "Preencha o email."; 
  }
  else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Digite um email válido!';
  }
  else if($upass=="") {
    $error[] = "Digite uma senha!";
  }
  else if(strlen($upass) < 6){
    $error[] = "A senha deve possuir no mínimo 6 caracteres!";  
  }
  else
  {
    try
    {
      $stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
      $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
        
      if($row['user_name']==$uname) {
        $error[] = "Nome de usuário existente!";
      }
      else if($row['user_email']==$umail) {
        $error[] = "Email já cadastrado!";
      }
      else
      {
        if($user->register($uname,$umail,$upass)){  
          $user->redirect('sign-up.php?joined');
        }
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  } 
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VcPrefeito | Registrar-se</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">

  <div class="register-box-body">
    <p class="login-box-msg">Registrar um novo usuário</p>


    <form action="../../index.html" method="post">
    <?php
      if(isset($error))
      {
        foreach($error as $error)
        {
           ?>
              <div class="alert alert-danger">
                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
              </div>
            <?php
        }
      }
      else if(isset($_GET['joined']))
      {
         ?>
            <div class="alert alert-info">
               <i class="glyphicon glyphicon-log-in"></i> &nbsp; Registrado com sucesso! <a href='login.php'>login</a> here
            </div>
          <?php
       }
      ?>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nome de usuário" value="<?php if(isset($error)){echo $uname;}?>" />
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" value="<?php if(isset($error)){echo $umail;}?>" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OU -</p>
      <a href="fbconfig.php" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
    </div>

    <a href="login.php" class="text-center">Já sou cadastrado</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
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
