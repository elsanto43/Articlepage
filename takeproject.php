<?php 
    session_start();
    require_once 'backend/PasswordHash.Class.php';
    require_once 'backend/utils.php';
    require_once 'backend/config.php';
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
                
                if ($roles == 2) {
                    //procesamos la accion de tomar el proyecto.
                    $haspending = userF::has_pending_proyect($IDusr);
                    if ($haspending == true) {
                        header("location: ./account.php");	//ya tiene un proyecto pendiente
                    }else{
                        $confi=new Datos_conexion();
                        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
                        //Determinamos si la conexion a la bd es correcto.
                        if(!$mysql){
                            return 0;
                        }else{
                            //consulta SQL para vereficar si existe tal correo del
                            //usario que introdujo 
                            $query    = "UPDATE
                                            tb_users SET
                                            pendant_project = " . $_GET['id']. "
                                            WHERE tb_users.id='".$IDusr. "';";
                            $mysql->query($query); //seteamos el id de proyecto pendiente en la data del usuario
                            
                            $query =  "UPDATE
                            tb_projects SET
                            editor_id = " . $IDusr. "
                            WHERE tb_projects.id='".$_GET['id']. "';";
                            $mysql->query($query); //el id del editor se modifica en la tabla de proyectos
                            
                            header("location: ./account.php");	//ya tiene un proyecto pendiente
                        }
                    }
                }
            }else{
                header("location: ./exit.php");
            }
        }else{
            header("location: ./login.php");
        } //session > 0
    }else{
        header("location: ./login.php");
    } //!empty session
    
?>