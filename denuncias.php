<?php

  require_once("session.php");
  
  require_once("class.user.php");

  require_once("class.denuncia.php");

  $auth_user = new USER();
  $auth_denuncia = new DENUNCIA();
   
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $atualiza = $auth_denuncia->runQuery("SELECT * FROM denuncias WHERE id_denuncia=:id_denuncia");
  $atualiza->execute(array(":id_denuncia"=>$id_denuncia));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $denunciaRow=$atualiza->fetch(PDO::FETCH_ASSOC);

  if(isset($_POST['btn-salvar']))
{
	$udata = strip_tags($_POST['data']);
	$uassunto = strip_tags($_POST['assunto']);
	$udescricao = strip_tags($_POST['descricao']);	
	
	if($udata=="")	{
		$error[] = "Preencha a data.";	
	}
	else if($uassunto=="")	{
		$error[] = "Preencha o assunto.";	
	}
	
	else if($udescricao=="")	{
		$error[] = "Digite a descrição da denúncia.";
	}
	else
	{
		try
		{
			$atualiza = $auth_denuncia->runQuery("SELECT data_denuncia, assunto_denuncia, descricao FROM denuncias WHERE data_denuncia=:udata OR assunto_denuncia=:uassunto OR descricao=:udescricao");
			
			$atualiza->execute(array(':udata'=>$udata, ':uassunto'=>$uassunto, ':udescricao'=>$udescricao));
			$row=$atualiza->fetch(PDO::FETCH_ASSOC);

			if($auth_denuncia->register($udata, $uassunto, $udescricao)){
				echo "Denúncia Gravada.";
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Denúncias</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../../plugins/pace/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">

<form method="post">
<!-- Site wrapper -->
<div>

<!-- Fim barra lateral-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Denúncias
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Realizar denúncia</h3>
        </div>
        <div class="box-body">
          
          <br />
          <br />
          
           <div class="form-group">
            <div class="col-xs-2"> 
      	  		<input type="date" class="form-control" name="data" placeholder="Data" value="<?php if(isset($error)){echo $udata;}?>"/>
       	 	</div>
       	  </div>

       	  	<br />
			<br />
       	  <div class="form-group">
       	  	<div class="col-xs-6"> 
      	  		<p align="center"><input type="text" class="form-control" name="assunto" placeholder="Assunto" value="<?php if(isset($error)){echo $uassunto;}?>" /></p>
       	 	</div>
       	  </div>

       	  <br />
       	  <br />

       	  <div class="form-group">
       	 	 <div class="col-xs-6"> 
      	  		<input type="text" class="form-control" name="descricao" placeholder="Descrição"/>
       	 	</div>
       	  </div>

          <br />
          <div class="row">
        
          <br/>
          <div class="col-xs-12 text-center">
          <button type="submit" class="btn btn-default btn-lrg" name="btn-salvar">
          <i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          </button>

          <button type="button" class="btn btn-default btn-lrg" title="Cancelar">
          <i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
          </button>

          </div>

          </div>
            <div class="ajax-content">
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

</div>
</form>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../../plugins/pace/pace.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });

</script>
</body>
</html>