<?php

     require_once('../class.user.php');

     $user = new USER();

//controler do perfil
//print_r($_POST); exit;


    if($_POST['operacao'] == 'cancelar'){

        header("Location: ../index2.php");
        //echo "ta dando erro aki";
    }

    else if ($_POST['operacao'] == 'salvar'){
        
        if($_POST['senhaNova'] == $_POST['senhaRepetir']) {
            
           
            $user->alterar($_POST['id'], $_POST['senhaAtual'], $_POST['senhaNova']);
            header("Location: ../index2.php?page=view/user.php");
            
        }
        
        else {
            
            echo "Senhas nao conferem";
        }
    }


?>