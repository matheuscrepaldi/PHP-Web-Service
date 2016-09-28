<?php
//echo "Lucas";
//print_r($_SESSION); exit;

     require_once('class.denuncia.php');
                 
       $sql = new DENUNCIA();

    if(isset($_GET['id'])) {
      
        
        $obj_cat = $sql->retornaLoc($_GET['id']);
        
         //print_r($obj_cat); exit;
       
    }



?>




<script>
    
 $(function(){
        tabela = $('#tabelaConsulta').DataTable({
          "ajax": {
            "url": 'controller/controller_consulta.php',
            "data": {operacao: "ListarDenuncias"},
            "type": "POST"
          },
          "language": {
            "url": "plugins/datatables/pt-br.json"
          },
          "columns": [
             {
              "data": null,
              "width": "20%",
              "targets": -1,
              "defaultContent": `
                <a class="btn btn-success" id="editarlink"><em class="fa fa-pencil"></em></a>
                <a class="btn btn-danger" id="excluirlink"><em class="fa fa-trash"></em></a>
              `
            },  
            {"data": "id_den", 
             "width": "40%"},
            {"data": "data_den", 
             "width": "40%"}
           
          ]
        })

      });
    
     $("#tabelaConsulta tbody").on('click', '#editarlink', function(){
        data = tabela.row( $(this).parents('TR') ).data();
        validarExclusao('editar', data.id_den);
      });

      $("#tabelaConsulta tbody").on('click', '#excluirlink', function(){
        data = tabela.row( $(this).parents('TR') ).data();
        validarExclusao('excluir', data.id_den)
      });
    
    function validarExclusao(botao, btn){

		 document.form_cat.operacao.value = botao;
     document.form_cat.btn_cons.value = btn; 
		 document.form_cat.submit();
     //bootbox.alert("Cadastro excluído com sucesso!");
	}
</script>  
    



<form action="controller/controller_consulta.php" method="post" name="form_cons" id="form_cons" enctype="multipart/form-data">
    <input name="operacao" type="hidden" id="operacao" value="nula">
    <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Consultar Denúncias
                <small>&nbsp;</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="">
                  <i class="fa fa-plus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              
            <table id="tabelaConsulta" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th><p align="center"><em class="fa fa-cog" style=" width : 10px"></em></p></th>    
                    <th ><p style=" width : 100px">Código</p></th>
                    <th><p  style=" width : 400px">Descrição</p></th>
                  
                </tr>
              </thead>
            </table>
            </div>
          </div>
        </div>
</form>