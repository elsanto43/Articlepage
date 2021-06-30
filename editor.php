


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
            if ($roles == "1"){
              header("location: ./account.php");	
            }elseif ($roles == "3"){
              header("location: ./admin/admin.php");	
            }
	       ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project editor </title>

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css">
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
      <div class="btn-group">
        <span class="input-group-text">
          <i class="fas fa-dollar-sign"></i>
        </span>
        <button type="button" class="btn btn-flat btn-default"  ><?php echo userF::get_user_money($IDusr);?></button>
        <a href="buy-entrys.php"  class=""><button type="button" style="height:40px; border-top-left-radius:0px;border-bottom-left-radius:0px;" class="btn btn-info">Add</button></a>
      </div>
      
      <!-- Navbar Search -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="account.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="support.php" class="nav-link">Support</a>
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
      <span class="brand-text font-weight-light">AdminLTE 3 </span>
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
              <a href="account.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                My account
                  
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="projects.php" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                
                <p>Projects</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-edit"></i>
                
                <p><b>Editor</b></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="support.php" class="nav-link">
                <i class="nav-icon fas fa">?</i>
                <p>
                Support
                  
                </p>
              </a>
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
            <h1>Article editor</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <?php $pendant = userF::has_pending_proyect($IDusr);
          if ($pendant <> 0) {?>
          <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Current project</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body p-0">
            
              <!-- /.card-header -->
              <div class="card-body">
                
                <form id="project" action="">
                  <?php 
                          $kale = new viewproject();
                          echo  $kale->printViewProject($pendant,$IDusr) ; 
                          ?>
                  
                  <!--<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>Write a valid password</div>
                  /.row -->
                  
                </form>
              </div>
            
            </div>
            <!-- /.card-body -->
          </div>
          <?php }?>
          <!-- /.card -->
        
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Editor
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" >
              <form action="editor.php" method="GET">
                <?php 
                  
                  if (isset($_GET['edit'])){ 
                    $tmparr = explode(" - ", $_GET['edit']);
                    $selected = $tmparr[0];
                  }else{//No se le dio un article a elegir, entonces
                    $selected = 0;
                  }?>
                  <select onchange="this.form.submit()" name="edit"style="width:100%; float:left;" class="custom-select">
                    <option>Create new article</option>
                    <?php
                     echo userF::list_Articles($IDusr, $selected); ?>
                  </select> 
                  
                    <br>
                <!--<button type="submit" id="saveData" style="width:15%; margin-left:1%;" class="btn btn-primary float-center">Open</button> -->
                <br> 
                
              </form>
              <br>
              <form action="backend/saveeditor.php" method="POST">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-1 col-form-label">Name</label>
                  <div class="col-sm-8">
                    <?php 
                    $artname = "";
                      if($selected > 0) {
                        
                        if (array_key_exists(1,$tmparr)) {
                          $artname = $tmparr[1];
                        }else{
                          $artname = userF::get_art_name($selected);
                        }
                        
                        
                      }
                    ?>
                    <input class="form-control" name="articlename" value="<?php echo $artname; ?>" id="inputName" placeholder="Name">
                  </div>
                </div>
                <input type="hidden" name="selected" value="<?php if($selected > 0) {echo $tmparr[0];} ?>">
                <textarea id="summernote" name="mydata">
                  <?php if (($selected) <> 0) { //Si se le pasa un index de articulo para abrir, de su cuenta se muestra aqui
                      echo userF::get_text_saved($IDusr, $selected);
                    }?>
                </textarea>
                <?php 
                $currproject = userF::has_pending_proyect($IDusr);
                        $published = userF::get_published_articles($currproject);
                        $arrpub = explode('-', $published);
                        $numpub = count($arrpub);
                        $numarts = userF::get_numarts2_project($currproject);?>

                <button name="boton" value="a" type="submit" id="saveData" style="width:48%; float:left;" class="btn btn-primary float-center">Save</button> 
                
                <a href="account.php" style="width:48%; float: right;" class="btn btn-secondary float-center">Cancel</a>
                
                <?php if($numarts > $numpub){ if ($pendant <> 0) { echo '<button name="boton" value="b" type="submit" id="saveData" style="margin-top:14px; width:100%; float:left;" class="btn btn-success float-center">Publish article</button> ';}} ?>
                
                
              </form>
            </div>
            <div class="card-footer">
            <?php if ($pendant <> 0) { 
              echo '<p><B>Remember: </B> Once your article is published, you cannot modify it anymore</p>';
                  if (userF::get_article_state($selected) == 3) {
                      ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
                <h6><i class="icon fas fa-ban"></i> This articled has been denyed!</h6>
                Reason: Because it had ortografy errors. <br>
                Please correct it and re-publish it
              </div>

                      <?php
                      //userF::update_article_state($selected,0);
                  }
              } ?>
            
            </div>
            
          </div>
          
        </div>
        <!-- /.col-->
      </div>

      <?php if ($pendant <> 0) {?> 
       <!-- Si tiene un proyecto pendiente, mostramos los articulos que ya fueron publicados. -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Published articles</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <br>
        <?php echo userF::showProjectArticlesEditor($pendant);?>
      </section>

      <?php }?>
      <!-- ./row -->
      
      <!-- ./row -->
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
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>


  $(function () {
    // Summernote
    $('#summernote').summernote()

  })

  
//$(document).on("click","#saveData", function(){
//      var myData = $('#summernote').summernote('code');
//      document.body.innerHTML += '<form id="dynForm" action="backend/saveeditor.php" method="post"><input type="hidden" name="mydata" value="'+myData+'"></form>';
//      document.getElementById("dynForm").submit();
 
//});
//Este codigo quedo obsoleto, ahora se hace todo desde HTML.

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