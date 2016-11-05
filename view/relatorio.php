<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    
    
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
    </script>

</head>
<body>


  <!-- =============================================== -->


  <div class="content"> 
      <div class="box">
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
				    <div class="col-md-2">
				    </div>
                    
                    <div class="col-md-2">
				    </div>
				
                    <div class="col-md-2">
					  <label>Data Inicial:</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='date' date-provider="date" class="form-control" id='d1' name="data"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <!--Categorias Combo Box-->
                        <br>
                         <label>Categorias:</label>
                        <div class="btn-group"> <a class="btn btn-default dropdown-toggle btn-select2" data-toggle="dropdown" href="#">Selecionar Categoria <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Buracos</a></li>
                                <li><a href="#">Iluminação</a></li>
                                <li><a href="#">Alagamento</a></li>
                                <li><a href="#">Árvore Caida</a></li>
                                <li><a href="#">Lixo</a></li>
                            </ul>
                        </div>
                        <!--Fim Combo Box-->
                        
				    </div>
                    <!--Divisão entre os 2 campos-->    
				    <div class="col-md-2">
                        <label>Data Final:</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='date' date-provider="date" class="form-control" id='d2' name="data"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <!--Check box-->
                        <br><br>
                        <label>Denúncia resolvida?</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"> Sim<br>
                                    <input class="form-check-input" type="checkbox"> Somente resolvidas
                                </label>
                            </div>
                        <!--Fim check box-->
				    </div>
                    
                    <div class="col-md-2">
                    </div>
			     </div>
		      </div>
            </div>
            <br>
            <div class="col-xs-12 text-center">
          		<button type="button" class="btn btn-default btn-lrg" name="btn-salvar" onclick="#">
          			<i class="glyphicon glyphicon-search"></i>&nbsp; Buscar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" title="Cancelar" onclick="#">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

            </div>
            <!-- FIM CONTEUDO-->
        </div>
      </div>
  </div>

<!-- jQuery 2.2.0 -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
