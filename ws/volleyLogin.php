<?php
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 $username = $_POST['username'];
 $email = $_POST['username'];
 $password = $_POST['password'];
 
 require_once('../class.user.php');
 
 
 $usuario = new USER();
 
 
 if($usuario->doLogin($username,$email,$password)){
 echo "Login efetuado";
 }else{
 echo "nao foi possivel logar";
 
 }
 }else{
echo 'error';
}

 
 ?>