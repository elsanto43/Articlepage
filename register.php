
<?php
/**

 */
require_once 'backend/determ.php';
require_once 'backend/doregister.php';
require_once 'backend/PasswordHash.Class.php';
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
      $roleid		=$_SESSION['INGRESO']["role"];
      if ($roleid == "3"){

				echo    "<script type=\"text/javascript\">
						window.location=./admin/admin.php\"
						</script>";

			}elseif ($roleid == "2"){
				echo    "<script type=\"text/javascript\">
						window.location=./account.php\";
						</script>";

			}elseif ($roleid == "1"){
				echo    "<script type=\"text/javascript\">
						window.location=./account.php\";
						</script>";
			}


      
    }
  }
	       ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register new account</p>
      
      

      <form id="registerform" name="registerform" action="" method="post">

      
        <div class="input-group mb-3">
          <input type="text" name="nombre" id="nombre"<?php if(!empty($_POST['nombre'])){echo 'value="'. $_POST['nombre'].'"';} ?> class="form-control" placeholder="Name" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="email" name="correo" id="correo" <?php if(!empty($_POST['correo'])){echo 'value="'. $_POST['correo'].'"';} ?> class="form-control" placeholder="Email" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="contra" id="contra" <?php if(!empty($_POST['contra'])){echo 'value="'. $_POST['contra'].'"';} ?> class="form-control" placeholder="Password" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirm_contra" id="confirm_contra" <?php if(!empty($_POST['confirm_contra'])){echo 'value="'. $_POST['confirm_contra'].'"';} ?> class="form-control" placeholder="Confirm password" >
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          
        </div>
        
        <?php
          //Se la realiza la validacion de las variable globales
          if(!empty($_POST['nombre']) && !empty($_POST['contra']) && !empty($_POST['correo'])){
            $iniciar=new Register($_POST['nombre'],$_POST['correo'],$_POST['contra']);

            $iniciar->Registrar();

            if (strlen($iniciar->MostrarMsg()) > 0) {
                echo $iniciar->MostrarMsg();
            }else {
              //Muestra el mesaje de error al usuario
              
            }
            
            
          }
		  ?>
        
        <div class="row">
         <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
           /.col -->
          <div class="col-7">
            <button type="submit" class="btn btn-primary btn-block">Create account</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- 
      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      /.social-auth-links -->

      <p class="mb-1">
        <a href="login.php">I already have an account</a>
      </p>
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


<script>
$(document).ready(function() {
  
  $('#registerform').validate({
    rules: {
      nombre: {
        required: true,
        minlength: 3
      },
      contra: {
        required: true,
        minlength: 5
      },
      confirm_contra: {
        required: true,
        minlength: 5,
        equalTo: "#contra"
      },
      correo: {
        required: true,
        email: true
      },
    },

    messages: {
      nombre: {
        required: "Please enter your name",
        minlength: "Your name must be at least 3 characters long"
      },
      correo: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      contra: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      confirm_contra: {
        required: "Please repeat your password",
        equalTo: "Please enter the same password as above"
      },
    },
    errorElement: 'label',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
