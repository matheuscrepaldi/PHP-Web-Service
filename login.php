<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('index2.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('index2.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}

  //login FACEBOOK
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['code'])){

  // Informe o seu App ID abaixo
  $appId = '1233962869948144';

  // Digite o App Secret do seu aplicativo abaixo:
  $appSecret = '0e6d3ce6463ddc3a3b33d496be1fcda3';

  // Url informada no campo "Site URL"
  $redirectUri = urlencode('http://vcprefeito.com.br/login.php/');

  // Obtém o código da query string
  $code = $_GET['code'];

  // Monta a url para obter o token de acesso e assim obter os dados do usuário
  $token_url = "https://graph.facebook.com/oauth/access_token?"
  . "client_id=" . $appId . "&redirect_uri=" . $redirectUri
  . "&client_secret=" . $appSecret . "&code=" . $code;

  //pega os dados
  $response = @file_get_contents($token_url);
  if($response){
    $params = null;
    parse_str($response, $params);
    if(isset($params['access_token']) && $params['access_token']){
      $graph_url = "https://graph.facebook.com/me?access_token="
      . $params['access_token'];
      $user = json_decode(file_get_contents($graph_url));

  // nesse IF verificamos se veio os dados corretamente
      if(isset($user->email) && $user->email){

  /*
  *Apartir daqui, você já tem acesso aos dados usuario, podendo armazená-los
  *em sessão, cookie ou já pode inserir em seu banco de dados para efetuar
  *autenticação.
  *No meu caso, solicitei todos os dados abaixo e guardei em sessões.
  */

        $_SESSION['email'] = $user->email;
        $_SESSION['nome'] = $user->name;
        $_SESSION['uid_facebook'] = $user->id;
        $_SESSION['user_facebook'] = $user->username;
        $_SESSION['link_facebook'] = $user->link;
      }
    }else{
      echo "Erro de conexão com Facebook";
      exit(0);
    }

  }else{
    echo "Erro de conexão com Facebook";
    exit(0);
  }
}else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['error'])){
  echo 'Permissão não concedida';
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VcPrefeito - Login</title>
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
</head>
<body class="hold-transition login-page">
	<div class="login-box">
	<div class="login-logo">
   	 <img src="/img/logo.png">
  </div>

	<div class="login-box-body">
     
        
       <form class="form-signin" method="post" id="login-form">        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
       	 	<input type="text" class="form-control" name="txt_uname_email" placeholder="Usuário ou Email" required />
        	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
      	  	<input type="password" class="form-control" name="txt_password" placeholder="Senha" />
       	 	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Entrar
            </button>
        </div> 
        <div class="social-auth-links text-center">
      <p>- OU -</p>
      <a href="https://www.facebook.com/dialog/oauth?client_id=1233962869948144&redirect_uri=http://vcprefeito.com.br/login.php&scope=email" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Logar pelo Facebook</a>
    </div>
      	<br />
            <label>Não possui uma conta?<a href="sign-up.php"> Registrar-se</a></label>
      </form>

    </div>
</div>
	<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>

	<script src="../../bootstrap/js/bootstrap.min.js"></script>

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