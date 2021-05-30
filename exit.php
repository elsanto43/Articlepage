<?php 
session_start();
//se destruí la variable global
unset($_SESSION['INGRESO']);
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
				$uri = 'https://';
			}else{
				$uri = 'http://';
			}
		   $uri .= $_SERVER['HTTP_HOST'];

	  session_unset();
        session_destroy();
    header("location: ./login.php");		   
 ?>