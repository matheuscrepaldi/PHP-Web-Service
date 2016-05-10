<?php
	$nome_cookie = $_COOKIE['nome'];
	if(isset($login_cookie)){
		echo"Bem-Vindo, $nome_cookie <br>";
		echo"Essas informações <font color='red'>PODEM</font> ser acessadas por você";
	}else{
		echo"Bem-Vindo, convidado <br>";
		echo"Essas informações <font color='red'>NÃO PODEM</font> ser acessadas por você";
		echo"<br><a href='login.html'>Faça Login</a> Para ler o conteúdo";
	}
?>