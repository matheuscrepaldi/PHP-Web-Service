<?php
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
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <script type="text/javascript">
    
      function changePage(url) {
        if(url == ''){ return; }
          //$("#localAtualizar").html('<div class="text-center"><img src="images/loading.gif" alt="Carregando"></div>');
         $.post( url , function( data ) {
            $( "#localAtualizar" ).html( data );
          });

      }

      // redirect to page
      var page =  "<?php  if(isset($_GET['page'])) echo $_GET['page']; ?>";
      var id =  "<?php  if(isset($_GET['id'])) echo $_GET['id']; ?>";

      if(page != '' && id != ''){
        changePage(page + '.php?id=' + id);
      }
      else if(page != ''){

        changePage(page + '.php');
      }
    </script>


</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>VP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Vc</b>Prefeito</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
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
              <!-- User image -->
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
              <!-- Menu Footer-->
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

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
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
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
      </form>
      <!-- /.search form -->
      <!-- BARRA LATERAL -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
          
 <?php       if($userRow['user_tipo'] == 'A')  { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Denúncias</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onClick="changePage('denuncias.php');"><i class="fa fa-circle-o"></i> Realizar Denúncia</a></li>
            <li><a href="#" onClick="changePage('view/categorias.php');"><i class="fa fa-circle-o"></i>Categorias</a></li>
            
          </ul>
        </li>
<?php } 
          
      if(($userRow['user_tipo'] == 'A') or ($userRow['user_tipo'] == 'U'))  { ?>       
           <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onClick="changePage('geraRelatorio.php');"><i class="fa fa-circle-o"></i> Consultar</a></li>           
          </ul>
        </li>
   <?php }  
          
           if($userRow['user_tipo'] == 'A')  { ?>       
           <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Administração</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" onClick="changePage('');"><i class="fa fa-circle-o"></i> nao sei ainda</a></li>           
          </ul>
        </li>
   <?php } ?> 
          
      </ul>
      </section>
      </aside>
  
  <style>
   		.Flexible-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
    overflow: hidden;
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
			<div  class="Flexible-container">
          <div id="localAtualizar">
      				<!--<iframe  src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14859.019772468268!2d-50.477355349999996!3d-21.39955165!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1463764622779" width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>-->

              <iframe src="geoloc.html"></iframe>
          </div>
			</div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
   
     

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

       

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar 
  <div class="control-sidebar-bg"></div>-->

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard2.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="bootbox.min.js"></script>


</body>
</html>
