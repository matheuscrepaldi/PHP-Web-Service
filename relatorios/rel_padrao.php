<?php

require('../class.denuncia.php');

//print_r($_POST); exit;

//echo utf8_encode($_POST['cidade']); exit;


/*    if(isset($_POST['operacao']))  header("Location: ../index2.php?page=view/relatorio");
        exit;*/


    if(isset($_POST['operacao']) and $_POST['operacao'] == 'cancelar'){

        header("Location: ../index2.php?page=view/relatorio");
        exit;
    }

    if(isset($_POST['operacao']) and $_POST['operacao'] == 'buscar'){
        
        $cidade = utf8_encode($_POST['cidade']);
        
        $denuncia = new DENUNCIA();
        
        $cidade = $denuncia->retornaCidade();
        
        foreach($cidade as $registro) {
            
         
            echo $registro['id_den'];
            echo "entrou";
        }

       
    }



?>