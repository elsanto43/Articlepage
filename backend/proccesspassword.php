<?php 
    session_start();
    require_once 'PasswordHash.Class.php';
    require_once 'utils.php';
    require_once 'config.php';
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
                
               
                $confi=new Datos_conexion();
                $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
                //Determinamos si la conexion a la bd es correcto.
                if(!$mysql){
                    return 0;
                }else{
                    $oldpasswd = $_POST["oldpassword"];
                    $newpassword = $_POST["newpassword"];
                    $newpassword2 = $_POST["newpassword2"];
                    
                    if (strlen($newpassword) > 5){
                        if ($newpassword == $newpassword2){
                            if (userF::checkpassword($IDusr, $oldpasswd) == true) {
                                //consulta SQL para vereficar si existe tal correo del
                                //usario que introdujo 
                                $passwd = Password::hashp($newpassword);
                                $query    = "UPDATE
                                                tb_users SET
                                                tb_users.password='$passwd' 
                                                WHERE tb_users.id='$IDusr';";
                                $mysql->query($query); //seteamos el id de proyecto pendiente en la data del usuario
                            
                            }
                        }
                    }
                    header("location: ./../account.php?k=3");	//ya tiene un proyecto pendiente
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