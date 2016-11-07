<?php

  //session_start();
  
  require_once("session.php");
  
  require_once("class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

   // echo $userRow['user_tipo'];
  $str = $userRow['user_name'];

  $str = ucfirst($str);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VcPrefeito | Home</title>
    
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <script type="text/javascript">
    
      function changePage(url) {
        if(url == ''){ 
            return; 
        }
         $.post( url , function( data ) {
            $( "#localAtualizar" ).html( data );
          });

      }
        
        function changePageParam(url, params) {
          params = params || '';

          if(url == ''){ 
            return; 
          }

          $.post( url + params , function( data ) {
            $( "#localAtualizar" ).html( data );
          });
        }

      // redirect to page
      var page =  "<?php  if(isset($_GET['page'])) echo $_GET['page']; ?>";
      var id =  "<?php  if(isset($_GET['id'])) echo $_GET['id']; ?>";
        var alerta =  "<?php  if(isset($_GET['alerta'])) echo $_GET['alerta']; ?>";

      if(page != '' && id != ''){
        changePage(page + '.php?id=' + id);
      }
      else if(page != ''){
          if(alerta != '') alert(alerta);
        changePage(page + '.php');
      }
    </script>


</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.php" class="logo">

      <span class="logo-mini"><b>VP</b></span>

      <span class="logo-lg"><b>Vc</b>Prefeito</span>
    </a>


    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
    
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!--DEFINE A IMAGEM DE ACORDO COM O TIPO DE USUÁRIO-->
            <?php if(($userRow['user_tipo'] == 'A')){ ?>
               <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
               &nbsp;<?php echo $str; ?>&nbsp;<span class="caret"></span></a>
            <?php } ?> 

            <?php if(($userRow['user_tipo'] == 'U')){ ?>
               <img src="dist/img/avatar04.png" class="user-image" alt="User Image">
               &nbsp;<?php echo $str; ?>&nbsp;<span class="caret"></span></a>
            <?php } ?>
             
            </a>

            <ul class="dropdown-menu">

              <li class="user-header">
                <?php if(($userRow['user_tipo'] == 'A')){ ?>
                   <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php } ?>

                <?php if(($userRow['user_tipo'] == 'U')){ ?>
                  <img src="dist/img/avatar04.png" class="img-circle" alt="User Image">
                <?php } ?>

                <p>
                  &nbsp;<?php echo $str;?>
                  <small>

                    <?php if(($userRow['user_tipo'] == 'A')){ ?>
                       Administrador
                    <?php } ?> 

                   <?php if(($userRow['user_tipo'] == 'U')){ ?>
                      Usuário
                   <?php } ?>

                  </small>
                </p>
              </li>      

              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" onClick="changePage('view/user.php');" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php?logout=true" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>

  <aside class="main-sidebar">

    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">

        <?php if(($userRow['user_tipo'] == 'A')){ ?>
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        <?php } ?>

        <?php if(($userRow['user_tipo'] == 'U')){ ?>
          <img src="dist/img/avatar04.png" class="img-circle" alt="User Image">
        <?php } ?>

        </div>
        <div class="pull-left info">
          <p> &nbsp;<?php echo $str; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a><br/>
        </div>
      </div>

      <form action="#" method="get" class="sidebar-form">
      </form>
      <!-- BARRA LATERAL -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
          
 <?php       if($userRow['user_tipo'] == 'A')  { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-edit"></i> <span>Cadastros</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onClick="changePage('view/denuncias.php');"><i class="fa fa-circle-o"></i>Denúncias</a></li>
            <li><a href="#" onClick="changePage('view/categorias.php');"><i class="fa fa-circle-o"></i>Categorias</a></li>
            
          </ul>
        </li>
<?php } 
          
      if(($userRow['user_tipo'] == 'A') or ($userRow['user_tipo'] == 'U'))  { ?>       
           <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-table"></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onClick="changePage('view/denuncias.php');"><i class="fa fa-circle-o"></i> Consultar</a></li>  
            
            <li><a href="#" onClick="changePage('view/relatorio.php');"><i class="fa fa-circle-o"></i> Relatório</a></li>
          </ul>
        </li>
   <?php }  
          
           if($userRow['user_tipo'] == 'A')  { ?>       
           <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-gears"></i> <span>Administração</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onClick="changePage('');"><i class="fa fa-circle-o"></i>Configurações</a></li>           
          </ul>
        </li>
   <?php } ?> 
          
      </ul>
      </section>
      </aside>
  
  <style>
.Flexible-container {
    position: relative;
    padding-bottom: 51.5%;
    padding-top: 30px;
    height: 0;
    width: auto;
    overflow: auto;
}

.Flexible-container iframe,   
.Flexible-container object,  
.Flexible-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height: 100%;
 	height:calc(100% - 0px);
}
	</style>

<div class="content-wrapper">
        
    <div class="row">
        <div class="col-md-12">
  			<div  class="Flexible-container">
                
              <div id="localAtualizar">
                  <iframe src="geoloc.php"></iframe> 
              </div>
                
  			</div>
        </div>
            
    </div>
          
</div>
        
   
     

        
    <div class="clearfix visible-sm-block"></div>

</div>

<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>

<script src="plugins/fastclick/fastclick.js"></script>

<script src="dist/js/app.min.js"></script>

<script src="plugins/sparkline/jquery.sparkline.min.js"></script>

<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="plugins/chartjs/Chart.min.js"></script>

<script src="dist/js/demo.js"></script>
<script src="bootbox.min.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"></script>


</body>
</html>
