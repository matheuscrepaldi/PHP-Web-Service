<?php

  /*require_once("../session.php");
  
  require_once("../class.user.php");
  require_once("../class.denuncia.php");

  $auth_user = new USER();
  $auth_denuncia = new DENUNCIA();

  $id_denuncia = null;
   
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
				echo "Denúncia gravada!";
			}

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}*/

?>


<div>

<form method="post">
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Realizar denúncia</h3>
        </div>
        <div class="box-body">
          
          <br />
          <br />
          
           <div class="form-group">
            <div class="col-xs-2"> 
      	  		<input type="date" class="form-control" name="data" placeholder="Data" value="<?php if(isset($error)){echo $udata;}?>" />
       	 	</div>
       	  </div>

       	  	<br />
			<br />
       	  <div class="form-group">
       	  	<div class="col-xs-6"> 
      	  		<p align="center"><input type="text" class="form-control" name="assunto" placeholder="Assunto" value="<?php if(isset($error)){echo $uassunto;}?>"/></p>
       	 	</div>
       	  </div>

       	  <br />
       	  <br />

       	  <div class="form-group">
       	 	 <div class="col-xs-6"> 
      	  		<input type="text" class="form-control" name="descricao" placeholder="Descrição" />
       	 	</div>
       	  </div>

          <br />
          <div class="row">
          <!--<div class="col-xs-12 text-center">
          <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Salvar
          </button>
          </div>-->
          <br/>
          
          	<div class="col-xs-12 text-center">
          		<button type="submit" class="btn btn-default btn-lrg" name="btn-salvar">
          			<i class="glyphicon glyphicon-ok"></i>&nbsp; Salvar
          		</button>
         	
	          <button type="button" class="btn btn-default btn-lrg" title="Cancelar">
	          		<i class="glyphicon glyphicon-remove"></i>&nbsp; Cancelar
	          </button>

        </div>

	</form>

          </div>

       

