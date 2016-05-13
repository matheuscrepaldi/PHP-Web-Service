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
	$upass = strip_tags($_POST['txt_upass']);
	$uname = strip_tags($_POST['txt_uname']);

	if($upass=="")	{
		$error[] = "Digite uma senha!";
	}

	else if(strlen($upass) < 6){
		$error[] = "A senha deve possuir no mínimo 6 caracteres!";	
	}
	elseif (strlen($uname=="")) {
		$error[] = "Preencha o nome de usuario!";
	}

	else
	{
		try
		{
			$stmt = $user->runQuery("UPDATE user_pass FROM users WHERE user_name=:uname");
			$stmt->execute(array(':uname'=>$uname, ':upass'=>$upass));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
		

			if($user->register($uname,$upass)){	
				$user->redirect('index.php?joined');
			}
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redefinir senha</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Redefinir senha.</h2><hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Senha alterada com sucesso <a href='index.php'>Entrar</a> aqui
                 </div>
                 <?php
			}
			?>

			<div class="form-group">
            	<input type="text" class="form-control" name="txt_uname" placeholder="Usuário" />
            </div>

            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Senha" />
            </div>

            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Digite novamente" />
            </div>

            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Enviar
                </button>
            </div>
            <br />
            <label>Já possui uma conta? <a href="index.php">Entrar</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>