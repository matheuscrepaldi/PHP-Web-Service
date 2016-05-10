<?php
	$nome   = $_POST['nome'];
	$email  = $_POST['email'];
	$login  = $_POST['login'];
	$senha  = MD5($_POST['senha']);

	//Validar se nome foi informado
	if($nome == "" || $nome == null){
		echo"<script language='javascript' type='text/javascript'>alert('O Nome deve ser preenchido');window.location.href='cadastro.html';</script>";
		die();
	}

	//Validar se email foi informado
	if($email == "" || $email == null){
		echo"<script language='javascript' type='text/javascript'>alert('O E-mail deve ser preenchido');window.location.href='cadastro.html';</script>";
		die();
	}
	
	//Validar se login foi informado
    if($login == "" || $login == null){
        echo"<script language='javascript' type='text/javascript'>alert('O Login deve ser preenchido');window.location.href='cadastro.html';</script>";
		die();
	}

	//Validar se senha foi informada 
	//Obs: como a variavel $senha recebe o conteudo criptografado, ele numca estará vazio, então lemos o que foi informado no campo
	if($_POST['senha'] == "" || $_POST['senha'] == null){
		echo"<script language='javascript' type='text/javascript'>alert('A senha deve ser informada');window.location.href='cadastro.html';</script>";
		die();
	}
	
	//Se não houve nenhum aviso
	$connect = mysql_connect('mysql.hostinger.com.br','u633448963_admin','123456');
	$db = mysql_select_db('u633448963_login');
	
	// Verifica se login ou email já existe
	$query_select = "SELECT login FROM usuarios WHERE login = '$login' or email = '$email' ";
	$select = mysql_query($query_select,$connect);
	$array = mysql_fetch_array($select);
	$logarray = $array['login'];		
	
	//Se existir dispara aviso
	if($logarray == $login){
		echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='cadastro.html';</script>";
		die();
	}else{
		//Se não existir cria
		$query = "INSERT INTO usuarios (nome,email,login,senha) VALUES ('$nome','$email','$login','$senha')";
		$insert = mysql_query($query,$connect);
		 
		if($insert){
			echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='login.html'</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='cadastro.html'</script>";
		}
	}
?>