<?php
 
require_once ('../class.user.php');

$user = new USER();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['senha'])) {
 
    // recebendo os parametros do POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
 
    // verifica se o usuario existe
    if ($user->doLogin($name, $email, $senha)) {
        // usuario ja existe
        $response["error"] = TRUE;
        $response["error_msg"] = "Usuário existente com o email " . $email;
        echo json_encode($response);
    } else {
        // criar novo usuario
        $usuario = $user->register($name, $email, $senha);
        if ($user) {
            // usuario inserido com sucesso
            $response["error"] = FALSE;
            $response["uid"] = $usuario["user_id"];
            $response["user"]["name"] = $usuario["user_name"];
            $response["user"]["email"] = $usuario["user_email"];
            //$response["user"]["created_at"] = $usuario["created_at"];
           // $response["user"]["updated_at"] = $usuario["updated_at"];
            echo json_encode($response);
        } else {
            // falha ao inserir usuario
            $response["error"] = TRUE;
            $response["error_msg"] = "Erro desconhecido ao registrar!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or senha) is missing!";
    echo json_encode($response);
}
?>