<?php
session_start();
require_once '../backend/PasswordHash.Class.php';
require_once '../backend/utils.php';
//Para redireccionar si es que no se cumple
//el logeo
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
				$uri = 'https://';
			}else{
				$uri = 'http://';
			}
		   $uri .= $_SERVER['HTTP_HOST'];

 if(!empty($_SESSION['INGRESO'])){
  if(count($_SESSION['INGRESO'])>0){
	  	  //Recuperamos datos del arreglo
	  	  $IDusr		=$_SESSION['INGRESO']["Id"];
	  	  $Ipusr		=$_SESSION['INGRESO']["Ip"];
	  	  $Claveusr   =$_SESSION['INGRESO']["Clave"];
	  	  $Nombreusr  =$_SESSION['INGRESO']["Nombre"];
	  	  $HorSesion  =$_SESSION['INGRESO']["hora"];
        
	      //instancia de la clase PHpass
	      $Contrasena = new PasswordHash(8, FALSE);
	      //se uni los datos para verificar
	      $Ccontrase=$IDusr.$Ipusr.$Nombreusr.$HorSesion;
	      if($Contrasena->CheckPassword($Ccontrase, $Claveusr)){
          $roles = userF::get_role($IDusr);
          if ($roles==3){
            
	       ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administration panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Support</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="../exit.php" class="btn btn-danger">Exit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link elevation-4">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $Nombreusr; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../account.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                My account
                  
                </p>
              </a>
            </li>
            <li class="nav-item active">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                <b>Administration</b>
                  
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="tickets.php" class="nav-link">
                <i class="nav-icon fas fa">?</i>
                <p>
                Support
                  
                </p>
              </a>
            </li>
          <li class="nav-item">
            <a href="../exit.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                <span class="left badge badge-danger">Close</span>
              </p>
            </a>
          </li> 
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administration</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Support tickets</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
                  
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body p-0">
              
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Ticket ID</th>
                      <th>Username(UID)</th>
                      <th>Date</th>
                      <th>State</th>
                      <th>Ticket</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo userF::list_tickets(); ?>
                   
                  </tbody>
                </table>
              </div>
              
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Articles pending aprovation</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
                  
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body p-0">
              
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>ID</th>
                      
                      <th>Name</th>
                      <th>Date</th>
                      <th>Class</th>
                      <th>Status</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo userF::list_pending_aprov_Projects(); ?>
                   
                  </tbody>
                </table>
              </div>
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card collapsed-card">
              <div class="card-header">
                <h3 class="card-title">All projects</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
                  
                </div>
              </div>
                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                    <th>ID</th>
                      
                      <th>Name</th>
                      <th>Date</th>
                      <th>Class</th>
                      <th>Status</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php echo userF::list_Projects($roles); ?>
                   <!-- <tr>
                      <td>183</td>
                      <td>11-7-2014</td>
                      <td>Sports</td>
                      <td><span class="badge bg-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>219</td>
                      <td>11-7-2014</td>
                      <td>Videogames</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>657</td>
                      <td>11-7-2014</td>
                      <td>Education</td>
                      <td><span class="badge bg-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>175</td>
                      <td>11-7-2014</td>
                      <td>Sports</td>
                      <td><span class="badge bg-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>-->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
<?php
          }else{
            header("location: ./../account.php");
          }
       }else{
      header("location: ./../login.php");
       }
  }else{
    header("location: ./../login.php");
  }

 }else{
    header("location: ./../login.php");
 }


 /**
 * Returna el IP de usuario
 * @return [string] [devuel la io del usuario]
 */
function IPuser() {
	$returnar ="";
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
     $returnar=$_SERVER['HTTP_X_FORWARDED_FOR'];}
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
     $returnar=$_SERVER['HTTP_CLIENT_IP'];}
if(!empty($_SERVER['REMOTE_ADDR'])){
	 $returnar=$_SERVER['REMOTE_ADDR'];}
return $returnar;
}
?>