<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
 $username = $_POST['username'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 
 require_once('../class.user.php');
 
 $usuario = new USER();
 
 
 if($usuario->register($username,$email,$password)){
 echo "Successfully Registered";
 }else{
 echo "Could not register";
 
 }
 }else{
echo 'error';
}


?>