<?php

    require('../model/model_categorias.php');
    require('../class.denuncia.php');
header('Content-type: text/html; charset=UTF-8');

?>

    
    <script>
        
        $(".dropdown-menu li a").click(function(){
            var selText = $(this).text();
            $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        });
        
        $(function(){
          
        $.fn.datepicker.dates['pt'] = {
            days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
            daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
            daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            today: "Hoje",
            clear: "Limpar",
            format: "dd/mm/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };
          
          $('#d1').datepicker({
            language: 'pt'
          });
          
          $('#d2').datepicker({
              language: 'pt'
          });
            
        });
        
        function validarBotao(botao){
		
		 document.form_rel.operacao.value = botao;
		 document.form_rel.submit();
	}
        function chama_relatorio(){
            di = $('#d1').val();
            df = $('#d2').val();
            categoria = $('#categoria').val();
            cidade = $('#cidade').val();   
            checkSim = $('#checkSim').val(); 
            checkNao = $('#checkNao').val(); 
            checkbox = $('#checkbox').val();
            
            data = '?di=' + di + '&df=' + df + '&categoria=' + categoria + '&cidade=' + cidade + '&checkSim=' + checkbox;
            changePageParam('relatorios/rel_padrao.php', data);
        }
        
        
    </script>



  <!-- =============================================== -->

<form action="relatorios/rel_padrao.php" method="post" name="form_rel" id="form_rel">
    <input name="operacao" type="hidden" id="operacao" value="nula">
  <div class="content"> 
      <div class="box box-primary">
        <div class="box-header with-border">
            <center>
                <h3 class="box-title">Consultar Denúncias</h3>  
            </center>

        </div>
        <div class="box-body">
            <!-- INICIO CONTEUDO-->
            <div class="row">
		      <div class="col-md-12">
                <div class="row">
                    <br>
				    <div class="col-md-4">
				    </div>
                    
                    
                    <div class="col-md-2">
                        <label>Data Inicial</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='date' date-provider="date" class="form-control" id='d1' name="d1"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
				    </div>
                    
                  
				
                    <div class="col-md-2">
					  
                        
                        <label>Data Final</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='date' date-provider="date" class="form-control" id='d2' name="d2"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        

				    </div>
                    
                    <div class="col-md-4">
                    </div>
                    
                    </div>
                  
                  <br>
                  
                    <div id="row">
                        
                        <div class="col-md-4">
                        </div>
                        
                    <!--DivisÃ£o entre os 2 campos-->    
				    <div class="col-md-4">
                       
                                               
                        <!--Categorias Combo Box-->
                        
                        	  <label>Categoria</label>
                <select class="form-control select2" name="categoria" id="categoria" style="width: 100%;">
                  <option selected="selected"></option>
                
                <?php 
                    
                    $categoria = new Categoria();

                    $resultado = $categoria->listar();
                    
                    foreach($resultado as $registro) {  ?>

                    <option value="<?php echo $registro['id_categoria']?>"><?php echo $registro['desc_categoria']?></option>
                    
                                                      
         <?php     }  ?>   
                    
                </select>
                        <!--Fim Combo Box-->
                        
                    <br>
                        
                        <!--Cidades Combo Box-->
                        
                        	  <label>Cidade</label>
                <select class="form-control select2" name="cidade" id="cidade" style="width: 100%;">
                  <option selected="selected"></option>
                
                <?php 
                    
                    
                    
                    $cidade = new DENUNCIA();

                    $resultado = $cidade->retornaCidade();
                    
                    foreach($resultado as $registro) {  ?>

                    <option value="<?php echo $registro['cidade_den']?>"><?php echo $registro['cidade_den']?></option>
                    
                                                      
         <?php     }  ?>   
                    
                </select>
                        <!--Fim Combo Box-->
                        
                        <br>
                        <label>Denúncia resolvida?</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="checkbox" value="sim" id="checkbox"> Sim
                                    &nbsp;
                                    <input class="form-check-input" type="checkbox" name="checkbox"  value="nao" id="checkbox"> Não
                                </label>
                            </div>
                        
                   
				    </div>
                        
                         <div class="col-md-4">
                        </div>
                    
                    
			     </div>
		      </div>
            </div>
            <br>
            <div class="col-xs-12 text-center">
                
          		<button type="button" class="btn btn-default btn-lrg" name="btn-salvar" onClick="chama_relatorio();">
          			<i class="glyphicon glyphicon-search"></i>&nbsp; Buscar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" title="Cancelar" onClick="validarBotao('cancelar')">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

            </div>
            <!-- FIM CONTEUDO-->
        </div>
      </div>
  </div>
</form>


