<?php 
    require_once 'config.php';
    require_once 'PasswordHash.Class.php';
    require_once 'utils.php';
    
    session_start();
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
                    
                    $confi=new Datos_conexion();
                    $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
                    //Determinamos si la conexion a la bd es correcto.
                    if(!$mysql){
                        
                    }else{
                        //consulta SQL para vereficar si existe tal correo del
                        //usario que introdujo 
                            $query    = "UPDATE
                                        tb_users SET editor_saved = '".$_POST['mydata']."'
                                        
                                        WHERE tb_users.id='".$IDusr. "';";
                           $mysql->query($query);
                            //Aqui determinamos con la instruccion if
                            //la consulta generada, si mayor a cero
                            //retornamos el valor verdadero
                            //por el contrario mesaje de error
                           // if($respuesta->num_rows>0){
                             //   $row     			= $respuesta->fetch_row();
                            //    $hasproject              =$row[0];
                                
                            
                            //}
                    }
                    header("location: ".$uri . "/editor.php");
                }
            }
        }
    }
?>