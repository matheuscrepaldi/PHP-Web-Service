<?php


print_r($_POST); exit;

/*    if(isset($_POST['operacao']))  header("Location: ../index2.php?page=view/relatorio");
        exit;*/


    if(isset($_POST['operacao']) and $_POST['operacao'] == 'cancelar'){

        header("Location: ../index2.php?page=view/relatorio");
        exit;
    }

    if(isset($_POST['operacao']) and $_POST['operacao'] == 'buscar'){

        header("Location: ../index2.php?page=view/relatorio");
        exit;
    }



?>