<?php

	$conexao = mysqli_connect("mysql.hostinger.com.br", "u633448963_root", "masterkey") or die ("Erro: " . mysqli_error());
	
	$base = mysqli_select_db($conexao, "u633448963_tcc") or die ("Erro: " . mysqli_error());
	
	
	/*$sql = "select * from Usuario";
	
	$res = mysql_query($sql);
	
	$reg = mysql_fetch_array($res);
	
	echo "Nome do usuario: " . $reg['nome_usu'];*/
	
	

?>