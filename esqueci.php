<!--INICIO DO CODIGO DE RECUPERAÇÃO DE SENHA-->

		<?php  
  
 		  require_once("class.user.php");
		// ISSO É UM EXEMPLO, VOCÊ TERÁ QUE ADAPTAR AO SEU PROJETO, OK?
		if(isset($_POST['recuperar'])){
			
			$email    = utf8_decode (addslashes((strip_tags(trim($_POST['user_email'])))));
				
				 $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_email='user_email' ");

				 try{
				 	$result = $conexao->prepare($stmt);
				 	$result->bindvalue(':user_email', $email, PDO::PARAM_STR);
				 	$result->execute();
				 	$contar = $result->rowCount();

				 	if(contar>0){
				 		foreach ($conexao->query($stmt) as $exibe);

				 		$nomeUser  = $exibe['user_name'];
				 		$emailUser = $exibe['user_email'];
				 		$senhaUser = $exibe['user_password'];

				 		require_once('envia-email/PHPMailer/class.phpmailer.php');
				
						$Email = new PHPMailer();
						$Email->SetLanguage("pt-br");
						$Email->IsSMTP(); // Habilita o SMTP 
						$Email->SMTPAuth = true; //Ativa e-mail autenticado
						$Email->Host = 'mail.vcprefeito.com.br'; // Servidor de envio # verificar qual o host correto com a hospedagem as vezes fica como smtp.
						$Email->Port = '587'; // Porta de envio
						$Email->Username = 'recuperar@vcprefeito.com.br '; //e-mail que será autenticado
						$Email->Password = 'recoverpassword'; // senha do email
						// ativa o envio de e-mails em HTML, se false, desativa.
						$Email->IsHTML(true); 
						// email do remetente da mensagem
						$Email->From = 'contato@wesleydesign.com.br';
						// nome do remetente do email
						$Email->FromName = utf8_decode($email);
						// Endereço de destino do emaail, ou seja, pra onde você quer que a mensagem do formulário vá?
						$Email->AddReplyTo($email, 'VcPrefeito');
						$Email->AddAddress("contato@vcprefeito.com.br"); // para quem será enviada a mensagem
						// informando no email, o assunto da mensagem
						$Email->Subject = "(Recuperação de Senha - contato@vcprefeito.com.br)";
						// Define o texto da mensagem (aceita HTML)
						$Email->Body .= "Seguem os dados para acesso sistema: <br /><br />
										 <strong>Nome:</strong> $nomeUser<br /><br />
										 <strong>E-mail:</strong> $emailUser<br /><br />
										 <strong>Nome:</strong> $senha User<br /><br />";	
						// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
						if(!$Email->Send()){
							echo "<p>A mensagem não foi enviada. </p>";
							echo "Erro: " . $Email->ErrorInfo;
						}else{
							echo "OK";
					
						}

				 		}else{
				 			echo '<strong>Erro ao recuperar!</strong> O email digitado não consta cadastrado em nosso sistema';
				 		}
				 	}
				 }
				
		//SE CLICAR
?>

<!--FIM DO CODIGO DE RECUPERAÇÃO DE SENHA -->


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
    	
        <form action="" method="post" class="form-signin" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Redefinir senha.</h2><hr />
            
            <div class="form-group">
            	<input type="text" class="form-control" name="txt_upass" placeholder="Email para redefinição" />
            </div>

            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<input type="submit" class="button btn btn-primary btn-large" name="recuperar" value="Recuperar Senha">
            </div>
            <br />
            <label>Já possui uma conta? <a href="index.php">Entrar</a></label>
        </form>
       </div>
</div>

</div>
</body>
</html>