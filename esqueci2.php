  <?php

  $para = $_POST['txtEmail'];

  $assunto= "Redefinir ou alterar senha.";

  $email_body = "teste";

  $headers = "From: recuperar@vcprefeito.com.br\n";

  if(!mail($para, $assunto, $email_body, $headers, "-r".$para)){
  	$headers.= "Return-Path: " . $para . "\n";

  	mail($para, $assunto, $email_body, $headers);
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
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Email enviado! <a href='index.php'>Entrar</a> aqui
                 </div>
                 <?php
			}
			?>
            <div class="form-group">
            	<input type="text" class="form-control" name="txtEmail" placeholder="Email para redefinição" />
            </div>

            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btnSubmit">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;Enviar
                </button>
            </div>
            <br />
            <label>Já possui uma conta? <a href="index2.php">Entrar</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>