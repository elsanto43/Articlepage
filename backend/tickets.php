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
                    $tickettext = $_POST["ticket"];
                    
                    if (strlen($tickettext) > 0){
				
						$tmpdate = date('d/m/Y h:m:s');
						$query    = "INSERT into tb_tickets (`id`, `user_id`, `state`, `ticket`, `date`) 
										VALUES (NULL, '$IDusr', '0', '$tickettext', '$tmpdate');";
						
						$mysql->query($query);

						$idnew= ($mysql->insert_id);
						$mysql->close();
                    }
                    header("location: ./../account.php?k=4");	//ya tiene un proyecto pendiente
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