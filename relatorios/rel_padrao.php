<?php

require('../class.denuncia.php');
print_r($_GET);
exit;
//echo "to aqui "; exit;

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
            
         
            echo $registro['cidade_den'];
            //echo "entrou";
        }

       
    }



?>

<div class="content">
    <div class="box box-primary">

<table class="table table-hover" width="90%">
  <thead>
    <tr>
      <th>Código</th>
      <th>Data</th>
      <th>Categoria</th>
      <th>Descrição</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
        
    </div>
</div>