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
		$error = "Dados incorretos!";
	}	
}

  //login FACEBOOK

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
<body class="hold-transition login-page">
    
    <script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
        FB.api({ method: 'fql.query', query: 'SELECT publish_stream FROM permissions WHERE uid=me()' }, function(resp) {
    for(var key in resp[0]) {
 
        if(resp[0][key] == 1) {
            // usuario possui a permissao
        }
        else {
            // usuario nao possui a permissao, solicitar:
            FB.login(function(response) {
                if (response.authResponse) {
                    // aqui o usuario pode ter aceito ou nao as permissoes no popup
                    // portanto, verificar novamente aqui se o usuario aceitou 
                    // a permissao.  
                    // caso nao tenha aceito pode redireciona-lo para
                    // outra pagina
                     
                }
            }, {scope: 'publish_stream' });
        }
    }
});
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1120295274701582',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.7' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/pt_BR/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
        //console.log(JSON.stringify(response));
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
        
    // verifica permissios aceitas
    function checkPermission()
    {
        FB.api('/me/permissions', function (response) {

            var permissions = [];

            response.data.forEach(function(entry) {
                if(entry.status == 'granted') {
                    permissions.push(entry.permission);
                }
            });

            // verifica permissao
            if(permissions.indexOf('publish_actions') >= 0) {
                // usuario aceitou publish_actions
            }
        });
    }
        
    // chama Login do Facebook com as devidas permissoes
    function callFacebookLogin ()
    {
        FB.login(function(response) {
            if (response.authResponse) {
                // usuario aceitou o app
            }
        }, {
            scope: 'email, publish_actions'
        });
    }
        
        // chupaessa pistola seus fdp.....seraq agora vai? -----------------------
        
   logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        alert('You are logged in &amp; cookie set!');
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };
        
        
</script>

	<div class="login-box">
	<div class="login-logo">
   	 <img src="img/logo.png">
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
            <p><a href="#" onClick="logInWithFacebook()">Log In with the JavaScript SDK</a></p>
            <a href="js-login.php">por favor, conecta</a>
    </div>
           <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
    
</div>
      	<br />
            <label>Não possui uma conta?<a href="sign-up.php"> Registrar-se</a></label>
        <br />
            <label><a href="esqueci.php">Esqueci minha senha!</a></label>

      </form>

    </div>
</div>
	<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>

	<script src="bootstrap/js/bootstrap.min.js"></script>

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