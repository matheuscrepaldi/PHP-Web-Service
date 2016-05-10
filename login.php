<?php
    $login = $_POST['login'];
    $entrar = $_POST['entrar'];
    $senha = md5($_POST['senha']);
	
	$connect = mysql_connect('mysql.hostinger.com.br','u633448963_admin','123456');
	$db = mysql_select_db('u633448963_login');

        if (isset($entrar)) {
				$query_select = "SELECT nome FROM usuarios WHERE login = '$login' or email = '$login' ";
				$select = mysql_query($query_select,$connect);
				$array = mysql_fetch_array($select);
				$nome = $array['nome'];
				
                if (mysql_num_rows($select)<=0){
                    echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.html';</script>";
                    die();
                }else{	
                    setcookie("login",$login);
					setcookie("nome",$nome);
                    header("Location:main.php");
                }
        }
?>