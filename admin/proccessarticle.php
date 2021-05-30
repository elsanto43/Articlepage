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
                    if ($_GET['action'] == 1) { //aprobar articulo
                        //actualizamos el estado del articulo
                        userF::update_article_state($_GET['id'],2);
                        //chequeamos si ya se cumplio el numero de articulos del proyecto, para cambiarle el estado.

                         userF::check_count_articles($_GET['id']);

                    }elseif ($_GET['action'] == 2){

                        //actualizamos el estado del articulo
                        
                        userF::update_article_state($_GET['id'],3);
                        //Aqui se deberia redireccionar a una pagina en la que se explique el motivo 
                        //de la desaprovacion del articulo
                    } 
                    
                    header("location: ./viewpublished.php?id=".$_GET['pid']);
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