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
	
	if($upass=="")	{
		$error[] = "Digite uma senha!";
	}
	else if(strlen($upass) < 6){
		$error[] = "A senha deve possuir no mínimo 6 caracteres!";	
	}

	if($user->register($upass)){	
		$user->redirect('index.php?joined');	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar-se</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Redefinir senha</h2><hr />
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Instruções para redefinição foram enviadas por email.
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Senha" />
            </div>

             <div class="form-group">
            	<input type="password" class="form-control" name="txt_upass" placeholder="Digite Novamente" />
            </div>

            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Enviar
                </button>
            </div>
            <br />
            <label><a href="index.php">Voltar</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>