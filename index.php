<?php

	$conexao = mysql_connect("mysql.hostinger.com.br", "u633448963_root", "masterkey") or die ("Erro: " . mysql_error());
	
	$base = mysql_select_db("u633448963_tcc") or die ("Erro: " . mysql_error());
	
	
	$sql = "select * from Usuario";
	
	$res = mysql_query($sql);
	
	$reg = mysql_fetch_array($res);
	
	echo "Nome do usuario: " . $reg['nome_usu'];
	
	

?>