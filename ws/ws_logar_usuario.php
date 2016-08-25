<?php

require_once '../class.user.php';

$$user = new USER();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['email']) && isset($_POST['senha'])) {
 
    // recebendo os parametros do POST
    $name = $_POST['email'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
 
    // verifica usuario pelo login e senha
    $usuario = $$user->doLogin($name,$email,$senha);
 
    if ($usuario != false) {
        // achou usuario
        $response["error"] = FALSE;
        $response["uid"] = $usuario["user_id"];
        $response["user"]["name"] = $usuario["user_name"];
        $response["user"]["email"] = $usuario["user_email"];
        //$response["user"]["created_at"] = $usuario["created_at"];
        //$response["user"]["updated_at"] = $usuario["updated_at"];
        echo json_encode($response);
    } else {
        // usuario nao foi encontrado
        $response["error"] = TRUE;
        $response["error_msg"] = "Usuario ou senha incorreto. Por favor, tente novamente!";
        echo json_encode($response);
    }
} else {
    // esta faltando parametros
    $response["error"] = TRUE;
    $response["error_msg"] = "Login ou senha nao foi preenchido!";
    echo json_encode($response);
}
?>