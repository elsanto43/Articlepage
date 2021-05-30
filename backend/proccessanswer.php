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
                
                if ($roles == 3) {

                    $confi=new Datos_conexion();
                    $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
                    //Determinamos si la conexion a la bd es correcto.
                    if(!$mysql){
                        return 0;
                    }else{
                        $answer = $_POST["mydata"];
                        $admin = $_POST["adminname"];
                        $ticketid = $_POST["boton"];
                        
                        $query    = "UPDATE
                                        tb_tickets SET
                                        tb_tickets.answer='$answer', tb_tickets.state='1', tb_tickets.adminname='$admin'
                                        WHERE tb_tickets.id='$ticketid';";
                        $mysql->query($query); 
                        header("location: ./../admin/tickets.php");	//
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