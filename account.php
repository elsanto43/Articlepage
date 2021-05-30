<?php
session_start();
require_once 'backend/PasswordHash.Class.php';
require_once 'backend/utils.php';
require_once 'backend/projects.php';
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
          
	       ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My account</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
            <?php if ($roles <> 3) { ?>
      <div class="btn-group">
        <span class="input-group-text">
          <i class="fas fa-dollar-sign"></i>
        </span>
        <button type="button" class="btn btn-flat btn-default"><?php echo userF::get_user_money($IDusr);?></button>
        <a href="buy-entrys.php"  class=""><button type="button" style="height:40px; border-top-left-radius:0px;border-bottom-left-radius:0px;" class="btn btn-info">Add</button></a>
      </div>
      <?php }?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="account.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <?php if ($roles ==3){
            echo '<a href="admin/tickets.php" class="nav-link">Support</a>';
        }else{
          echo '<a href="support.php" class="nav-link">Support</a>';
        } ?>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="exit.php" class="btn btn-danger">Exit</a>
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
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="account.php" class="d-block"><?php echo $Nombreusr; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                
                <b>My account</b>
                </p>
              </a>
            </li>
            
            <?php 
            if ($roles == 2) {
                echo '<li class="nav-item">
                <a href="projects.php" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  
                  <p>Projects</p>
                </a>
              </li><li class="nav-item">
                <a href="editor.php" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  
                  <p>Editor</p>
                </a>
              </li><li class="nav-item">
              <a href="support.php" class="nav-link">
                <i class="nav-icon fas fa">?</i>
                <p>
                Support
                  
                </p>
              </a>
            </li>';
            }elseif ($roles == 1) {
                echo '<li class="nav-item">
                <a href="projects.php" class="nav-link">
                  <i class="nav-icon fas fa-book"></i>
                  
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="buy-entrys.php" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                  Buy entrys
                  
                </p>
              </a>
            </li><li class="nav-item">
            <a href="support.php" class="nav-link">
              <i class="nav-icon fas fa">?</i>
              <p>
              Support
                
              </p>
            </a>
          </li>';
            }elseif ($roles == 3){
                echo '<li class="nav-item">
                <a href="admin/admin.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                  Administration
                    
                  </p>
                </a>
              </li><li class="nav-item">
              <a href="admin/tickets.php" class="nav-link">
                <i class="nav-icon fas fa">?</i>
                <p>
                Support
                  
                </p>
              </a>
            </li>';
            }
            
            ?>
            
            
          </li>
          <li class="nav-item">
            <a href="exit.php" class="nav-link">
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
            <h1>My account</h1>
          </div>
          <!-- /.container-fluid <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">My proyects</li>
            </ol>
          </div>-->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
          <?php if (userF::hasnewtickets($IDusr)) {?>

            <div class="card bg-success">
              <div class="card-header">
                <h3 class="card-title"><b>Support ticket answered</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  Your support tickets had been answered. Check on the section: <b> Messages </b>
              </div>
              <a class="btn btn-success" data-card-widget="remove">Nice!</a>  
              <!-- /.card-body -->
            </div>

          <?php }
          if (isset($_GET["k"])){

           ?>
            <div class="card bg-success">
              <div class="card-header">
                <h3 class="card-title"><b><?php if ($_GET["k"] == '3'){

?>Password change<?php }elseif($_GET["k"] == '2'){?>Information changed<?php }elseif($_GET["k"] == '4'){?>Support ticket<?php }?></b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if ($_GET["k"] == '3'){

?>Your password has been changed correctly.<?php }elseif($_GET["k"] == '2'){?>Your new information has been succesfully saved<?php }elseif($_GET["k"] == '4'){?>Your new support ticket has been succesfully sended. We will get in contact, the answer will appear in this page<?php }?>
                
              </div>
              <a class="btn btn-success" data-card-widget="remove">Nice!</a>  
              <!-- /.card-body -->
            </div>
            <?php }?>
        <div class="row">
            
          <div class="col-md-3">
          

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user2-160x160.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $Nombreusr; ?></h3>

                <!--<p class="text-muted text-center">Sports specialist</p>-->

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Projects completed</b> <a class="float-right"><?php echo userF::get_projects_completed($IDusr); ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Started on</b> <a class="float-right"><?php echo userF::get_startedom($IDusr); ?></a>
                  </li>
                  <?php if ($roles == 1) { ?>
                  <li class="list-group-item">
                    <b>Disponible articles</b> <a class="float-right"><?php echo userF::get_numarticles($IDusr); ?></a>
                  </li>
                  <?php } ?>
                  <!--<li class="list-group-item">
                    <b>Disponible articles</b> <a class="float-right">13</a>
                  </li>-->
                </ul>

                <a href="changepassword.php" class="btn btn-primary btn-block"><b>Change password</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!--<li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>-->
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Messages</a></li>
                
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <?php echo userF::show_answers($IDusr);?>
                      <!--
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>

                        

                      </div>
                       END timeline item -->
                      
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="settings">
                    <form action="backend/proccess.php" mehot="GET">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input disabled="" name="name" value="<?php echo userF::get_name($IDusr);; ?>" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input disabled="" name="email" value="<?php echo userF::get_email($IDusr);?>"type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <textarea disabled="" name="description" value="" class="form-control" id="inputExperience" placeholder="Description"><?php echo userF::get_description($IDusr);?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input disabled="" name="skills" value="<?php echo userF::get_skills($IDusr);?>" type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <!--<div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>-->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <a id="edit" style="width:100%;" onclick="unablesettings()" class="btn btn-secondary">Edit</a>
                          <button style="width:100%; display: none;" type="submit" onclick="sendData()" id="save" class="btn btn-primary">Save</button>
                          
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<?php $_GET["k"] = "0";?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
    function unablesettings() {
      document.getElementById('inputName').disabled = false;
      //document.getElementById('inputEmail').disabled = false;
      document.getElementById('inputExperience').disabled = false;
      document.getElementById('inputSkills').disabled = false;
      $("input#inputName").focus();
      document.getElementById('edit').style.display = 'none';
      document.getElementById('save').style.display = 'inline';
      document.getElementById('save').style.width = '100%';
      
    }

    function sendData() {
     // document.getElementById('inputName').disabled = true;
      //document.getElementById('inputEmail').disabled = false;
     // document.getElementById('inputExperience').disabled = true;
     // document.getElementById('inputSkills').disabled = true;
      document.getElementById('edit').style.display = 'inline';
      document.getElementById('save').style.display = 'none';
      document.getElementById('edit').style = 'width: 100%';
      var name = $("input#inputName").val();
      var email = $("input#inputEmail").val();
      var description = $("input#inputExperience").val();
      var skills = $("input#inputSkills").val();
      var dataString = 'name='+ name + '&email=' + email + '&description=' + description + + '&skills=' + skills;
      //alert (dataString);return false;
    }
</script>
</body>
</html>
<?php
        
       }else{
     //Se redicciona si es que no se cumple
  	//Modificar como en la siguiete linea de codigo
  	//si es que esta en un subdirectorio
  	// header("location: ".$uri."/wp-admin"); 
        header("location: ./login.php");
          }
      }else{
        //Se redicciona si es que no se cumple
        //Modificar como en la siguiete linea de codigo
        //si es que esta en un subdirectorio
        // header("location: ".$uri."/wp-admin"); 
        header("location: ./login.php");
      }

    }else{
      //redirecionado si no existe la variable global
      //Modificar como en la siguiete linea de codigo
        //si es que esta en un subdirectorio
        // header("location: ".$uri."/wp-admin");
        header("location: ./login.php");
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