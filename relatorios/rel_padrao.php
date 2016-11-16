<?php

    require('../class.denuncia.php');

    
//print_r($_GET);
//exit;

    if(isset($_GET['operacao']) and $_GET['operacao'] == 'cancelar'){

        header("Location: ../index2.php?page=view/relatorio");
        exit;
    }

    if(isset($_GET['buscar']) and $_GET['buscar'] == 'buscar'){
        
                
        $cidade = $_GET['cidade'];
        $bairro = $_GET['bairro'];
        
        $sql = "select id_den, DATE_FORMAT(data_den, '%d/%m/%Y') data_den, cat_den,latitude, longitude, rua_den, num_den, cidade_den, status_den, categorias.*  from denuncias  left join categorias on (cat_den = id_categoria)
        
        WHERE  1 = 1";
        
        if($_GET['di']!= '' and $_GET['df']!= ''){
            
            $sql .= " and DATE(data_den) between date_format(str_to_date('".$_GET['di']."', '%d/%m/%Y'), '%Y-%m-%d') and date_format(str_to_date('".$_GET['df']."', '%d/%m/%Y'), '%Y-%m-%d')";
        }
        
        else if($_GET['di']!= ''){
            
            $sql .= " and DATE(data_den) between date_format(str_to_date('".$_GET['di']."', '%d/%m/%Y'), '%Y-%m-%d') and date_format(str_to_date('".date('d/m/Y')."', '%d/%m/%Y'), '%Y-%m-%d')";
        }
        
         else if($_GET['df']!= ''){
            
          echo "
            <div class='content'>
                <div class='box box-danger'>
                  <div class='callout callout-danger'>
                    <h4>Erro!</h4> <p>Favor informar a data final!</p>
                  </div>
                  </div>
            </div>";
             exit;
        }
        
        if($_GET['categoria'] > 0){
            
            $sql .= " and cat_den = " . $_GET['categoria'];
        }
        
        if($cidade != ''){
            
            $sql .= " and cidade_den = '" . $cidade . "'";
        }
        
        if($bairro != ''){
            
            $sql .= " and bairro_den = '" . $bairro . "'";
        }
        
        if($_GET['radio'] == 'sim'){
            
            $sql .= " and status_den = 'F'";
        }
        
        else if($_GET['radio'] == 'nao'){
            
            $sql .= " and status_den = 'A'";
        }
        
         else if($_GET['radio'] == 'ambossss'){
            
            $sql .= " and (status_den = 'A' or status_den = 'F')";
        }
       
        $sql .= " order by data_den";
        
       //echo $sql; exit;
 
        $denuncia = new DENUNCIA();
        
        
        $resposta = $denuncia->selectDinamico($sql);
        
        //print_r($resposta); exit;
?>

<script>
    
    function abrirDenuncia(id){
  
        $.ajax({
          type: "POST",
          url: 'controller/controller_denuncias.php',
          dataType: 'json',    
          data: {operacao : "ConsultaDenuncia", denuncia : id},
          success: function (response) {

            console.log(response);
             var denuncia = response.data[0];
             var status = 'Não Resolvida';
             if(denuncia.status_den == 'F') status = 'Resolvida'; 
             
            bootbox.alert({ message: '<form id="userForm" method="post" class="form-horizontal"> <div class="form-group"><label class="col-xs-4 control-label">Data: </label>  <div class="col-xs-2"><input type="text" class="form-control" name="id" disabled="disabled" value="'+ denuncia.data_den +'" /></div><label class="col-xs-1 control-label">Status: </label><div class="col-xs-3"><input type="text" class="form-control" name="id" disabled="disabled" value="'+ status +'" /></div></div><div class="form-group"><label class="col-xs-4 control-label">Categoria: </label><div class="col-xs-6"><input type="text" class="form-control" name="name" value="'+ denuncia.desc_categoria +'"  disabled="disabled" /></div></div><div class="form-group"><label class="col-xs-4 control-label">Descrição: </label><div class="col-xs-6"><textarea class="form-control" rows="2" id="comment" disabled="disabled" style="resize: none;">'+ denuncia.desc_den +'</textarea></div> </div><div class="form-group"><label class="col-xs-4 control-label">Localização: </label><div class="col-xs-6"><input type="text" class="form-control" name="website" value="'+ denuncia.rua_den + ' / ' + denuncia.cidade_den +'"  disabled="disabled" /> </div></div><div class="form-group"></div></form>',
              title: "Denúncia: " + id,               
              size: 'large',
              backdrop: true
            });
        }
        });
      }
        
        
    

</script>


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
            
        
            
          echo "<tr onClick='abrirDenuncia(".$registro['id_den'].")' style='cursor: pointer'>
                    
                  <th scope='row'>".$registro['id_den']."</th>
                  <td>".$registro['data_den']."</td>
                  <td>".$registro['rua_den']."</td>
                  <td>".$registro['desc_categoria']."</td>
                  <td>".$registro['cidade_den']."</td>
                  <td>"; 

                if($registro['status_den'] == 'A') echo "<font color='red'>Não Resolvida</font>";
                else echo "<font color='green'>Resolvida</font>";

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