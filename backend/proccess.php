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
                    //consulta SQL para vereficar si existe tal correo del
                    //usario que introdujo 
                    $query    = "UPDATE
                                    tb_users SET
                                    name = '" . $_GET['name']. "', tb_users.description='" . $_GET['description']. "', tb_users.skills='" . $_GET['skills']. "'
                                    WHERE tb_users.id='".$IDusr. "';";
                    $mysql->query($query); //seteamos el id de proyecto pendiente en la data del usuario
                   
                    header("location: ./../account.php?k=2");	//ya tiene un proyecto pendiente
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