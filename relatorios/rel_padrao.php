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
        $bairro= utf8_encode($_GET['bairro']);
        
        //$sql_data = "SELECT * FROM denuncias WHERE DATE(data_den) = date_format(str_to_date('07/11/2016', '%d/%m/%Y'), '%Y-%m-%d')";
        
        $sql = "select id_den, DATE_FORMAT(data_den, '%d/%m/%Y') data_den, cat_den,latitude, longitude, rua_den, num_den, cidade_den, status_den, categorias.*  from denuncias  left join categorias on (cat_den = id_categoria)
        
        WHERE  1 = 1";
        
        if($_GET['di']!= '' and $_GET['df']!= ''){
            
            $sql .= " and DATE(data_den) between date_format(str_to_date('".$_GET['di']."', '%d/%m/%Y'), '%Y-%m-%d') and date_format(str_to_date('".$_GET['df']."', '%d/%m/%Y'), '%Y-%m-%d')";
        }
        
        else if($_GET['di']!= ''){
            
            $sql .= " and DATE(data_den) between date_format(str_to_date('".$_GET['di']."', '%d/%m/%Y'), '%Y-%m-%d') and date_format(str_to_date('".date('d/m/Y')."', '%d/%m/%Y'), '%Y-%m-%d')";
        }
        
         else if($_GET['df']!= ''){
            
          echo "<div class='callout callout-danger'>
          
          <h4>Erro!</h4>
          
          <p>Favor informar a data final!</p>
                </div>";
             exit;
        }
        
        if($cidade != ''){
            
            $sql .= " and cidade_den = '" . $cidade . "'";
        }
        
        if($bairro != ''){
            
            $sql .= " and bairro_den = '" . $bairro . "'";
        }
       
        $sql .= " order by data_den";
        
       //echo $sql; exit;
 
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
          <th>Localização</th>
          <th>Categoria</th>
          <th>Cidade</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
          <a href="#">
<?php
      
        foreach($resposta as $registro) {
            
         
            //echo $registro['desc_den']
      echo "<tr>
              <th scope='row'>".$registro['id_den']."</th>
              <td>".$registro['data_den']."</td>
              <td>".$registro['rua_den']."</td>
              <td>".$registro['desc_categoria']."</td>
              <td>".$registro['cidade_den']."</td>
              <td>"; 
                
            if($registro['status_den'] == 'A') echo "<font color='red'>Não Resolvido</font>";
            else echo "<font color='green'>Resolvido</font>";
            
            echo "</td>
            </tr>";
        }


?>
          </a>
  </tbody>
</table>
        
    </div>
</div>


<?php } ?>