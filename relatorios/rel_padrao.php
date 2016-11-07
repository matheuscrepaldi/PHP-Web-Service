<?php

    require('../class.denuncia.php');

    //print_r($_GET);
    //exit;


    if(isset($_GET['operacao']) and $_GET['operacao'] == 'cancelar'){

        header("Location: ../index2.php?page=view/relatorio");
        exit;
    }

    if(isset($_GET['buscar']) and $_GET['buscar'] == 'buscar'){
        
                
        $cidade = utf8_encode($_GET['cidade']);
        
        $sql = "select id_den, DATE_FORMAT(data_den, '%d/%m/%Y') data_den, cat_den,latitude, longitude, rua_den, num_den, cidade_den, categorias.*  from denuncias  left join categorias on (cat_den = id_categoria) order by data_den";
 
        $denuncia = new DENUNCIA();
        
        $resposta = $denuncia->selectDinamico($sql);
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

<?php
      
        foreach($resposta as $registro) {
            
         
            //echo $registro['desc_den']
      echo "<tr>
              <th scope='row'>".$registro['id_den']."</th>
              <td>".$registro['data_den']."</td>
              <td>".$registro['rua_den']."</td>
              <td>".$registro['cidade_den']."</td>
            </tr>";
        }


?>
   
  </tbody>
</table>
        
    </div>
</div>


<?php } ?>