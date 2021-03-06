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
                        
                        $selected = $_POST['selected'];
                        $currproject = userF::has_pending_proyect($IDusr);
                        $published = userF::get_published_articles($currproject);
                        $arrpub = explode('-', $published);
                        $numpub = count($arrpub);
                        $numarts = userF::get_numarts_project($currproject, $mysql);
                        if ($_POST['boton'] == "a") { //El boton solo guarda el borrador, no publica el articulo
                        //consulta SQL para vereficar si existe tal correo del
                        //usario que introdujo 
                            $selected = $_POST['selected'];
                            if ($selected > 0) {
                                
                                $query    = "UPDATE
                                        tb_articles SET article = '".$_POST['mydata']."'
                                        , name = '".$_POST['articlename']."'
                                        WHERE tb_articles.id='".$selected. "';";

                                        $mysql->query($query);

                                header("location: ./../editor.php?edit=$selected");
                            }else{ //Se crea un nuevo articulo
                                $query = "INSERT INTO tb_articles (`id`, `name`, `user_id`, `article`) 
                                            VALUES (NULL, '".$_POST['articlename']."', '$IDusr', '".$_POST['mydata']."');";
                                $mysql->query($query);
                                $newid = $mysql->insert_id;
                                
                                header("location: ./../editor.php?edit=$newid");
                            }
                            
                           
                           // if($respuesta->num_rows>0){
                             //   $row     			= $respuesta->fetch_row();
                            //    $hasproject              =$row[0];
                                
                            
                        }else{ //boton b, publica el articulo, para ser aprobado por el administrador
                            
                            
                            if ($selected > 0) {
                                
                                
                                $query    = "UPDATE
                                        tb_articles SET state=1, article = '".$_POST['mydata']."'
                                        , name = '".$_POST['articlename']."', project_id='$currproject'
                                        WHERE tb_articles.id='".$selected. "';";

                                $mysql->query($query);

                                if (strlen($published) > 0) {
                                    $published = $published . "-$selected";
                                }else{
                                    $published = $selected;
                                }
                                
                                
                            }else{ //Se crea un nuevo articulo
                                if ($numarts > $numpub) {
                                    $query = "INSERT INTO tb_articles (`id`, `name`, `state`, `project_id`, `user_id`, `article`) 
                                            VALUES (NULL, '".$_POST['articlename']."', '1', '$currproject', '$IDusr', '".$_POST['mydata']."');";
                                    $mysql->query($query);
                                    $newid = $mysql->insert_id;

                                    if ((strlen($published) > 0) & ($published <> '0')) {
                                        $published = $published . "-$newid";
                                    }else{
                                        $published = $newid;
                                    }

                                    
                                }
                                
                            }
                            
                            $query = "UPDATE tb_projects SET tb_projects.ispublished='1', tb_projects.published='$published' WHERE tb_projects.id='$currproject'";
                            $mysql->query($query);

                            //tambien actualizamos la tabla de proyectos, agregandolo a los articulos publicados.
                            
                            
                            
                            header("location: ./../editor.php");
                        }
                    }
                    
                }
            }
        }
    }
?>