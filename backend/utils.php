<?php
    require_once 'config.php';


class userF {
    private $liststr       ="";

    
    
    public static function hasnewtickets($uid) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		$query    = "SELECT
							*
							FROM
							tb_tickets
							WHERE tb_tickets.state='1' AND tb_tickets.seen='0' AND tb_tickets.user_id='".$uid. "';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                
                $query = "UPDATE tb_tickets SET tb_tickets.seen='1' WHERE tb_tickets.user_id='$uid';";
                $mysql->query($query);
                
                return true;
                
            }else {
                return false;
            }
	 	}
    }
    public static function has_pending_proyect($uid) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		$query    = "SELECT
							tb_users.pendant_project
							FROM
							tb_users
							WHERE tb_users.id='".$uid. "';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row     			= $respuesta->fetch_row();

                return $row[0];
                
            }else {
                return 0;
            }
	 	}
    }
    public static function check_num_published_articles($projectid) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		$query    = "SELECT
							tb_projects.published, tb_projects.num_articles
							FROM
							tb_projects
							WHERE tb_projects.id='".$projectid. "';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row     			= $respuesta->fetch_row();

                $tmparr = explode("-", $row[0]);
                $numpublished = count($tmparr);

                if ($numpublished < $row[1]){
                    return true;
                }else{
                    return false;
                }
            }else {
                return 0;
            }
	 	}
    }
    public static function get_published_articles($projectid) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		$query    = "SELECT
							tb_projects.published
							FROM
							tb_projects
							WHERE tb_projects.id='".$projectid. "';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row     			= $respuesta->fetch_row();

                return $row[0];
                
            }else {
                return 0;
            }
	 	}
    }
    public static function get_text_saved($id, $articleid) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		  $query    = "SELECT
							tb_articles.article
							FROM
							tb_articles
							WHERE tb_articles.id='$articleid' AND tb_articles.user_id='$id';";
	 		 $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
	           if($respuesta->num_rows>0){
                    $row     			= $respuesta->fetch_row();
                    $data              =$row[0];
	           		//return $data;// se retorna el role
	           		return $data;
	           }else {
                    return 0;
			}
	 	}
    }
    public static function get_art_name($id) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		  $query    = "SELECT
							tb_articles.name
							FROM
							tb_articles
							WHERE tb_articles.id='$id';";
	 		 $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
	           if($respuesta->num_rows>0){
                    $row     			= $respuesta->fetch_row();
                    $roleid              =$row[0];
	           		return $roleid;// se retorna el role
	           		
	           }else {
                    return 0;
			}
	 	}
    }
    public static function get_role($id) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		  $query    = "SELECT
							tb_users.role_id
							FROM
							tb_users
							WHERE tb_users.id='$id';";
	 		 $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
	           if($respuesta->num_rows>0){
                    $row     			= $respuesta->fetch_row();
                    $roleid              =$row[0];
	           		return $roleid;// se retorna el role
	           		
	           }else {
                    return 0;
			}
	 	}
    }
    

    public function list_Articles($uid, $selectedid){
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
        if($mysql->connect_errno){
            exit;
        }else{

            $query    = "SELECT * FROM tb_articles WHERE tb_articles.user_id='$uid' AND (tb_articles.state='0' OR tb_articles.state='3');";
            
            $respos = $mysql->query($query);
            $count = 0;
            while ($arr = $respos->fetch_assoc()){
                
                if ($arr['id'] == $selectedid) {
                    $list = $list . "<option selected>" .$arr['id'] ." - " . $arr['name'] . "</option>" ; //id
                }else{
                    $list = $list . "<option>".$arr['id']." - " . $arr['name'] . "</option>"; //id
                }
            }   
        
            return $list;
                    
            
        }

    }

    public function list_Classes($selected){
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
        if($mysql->connect_errno){
            exit;
        }else{

            $query    = "SELECT * FROM tb_classes;";
            
            $respos = $mysql->query($query);

            while ($arr = $respos->fetch_assoc()){
                    
                if ($arr['id'] == $selected) {
                    $list = $list . "<option selected>" . $arr['name'] . "</option>" ; //id
                }else{
                    $list = $list . "<option>" . $arr['name'] . "</option>"; //id
                }
            }   
        
            return $list;
                    
            
        }

    }

    public function showProjectArticles($projectid, $userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
         if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		    $query    = "SELECT
							tb_projects.published
							FROM
							tb_projects
							WHERE tb_projects.id='".$projectid. "';";
	 		    $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
                 $test = "";
	           if($respuesta->num_rows>0){
                    $row     			= $respuesta->fetch_row();
                    $published = $row[0];
                    $role=userF::get_role($userid);
                    if (strlen($published) > 0) {
                        $arrpub = explode("-",$published);
                        $numpublished = count($arrpub);
                        $htmlr = "";
                        for ($i = 0; $i< $numpublished; $i++){
                            $test = $test . "asd" . $arrpub[$i];
                            $htmlr = $htmlr . userF::showPublished($arrpub[$i], $mysql, $projectid, $role);

                        }
                        return $htmlr;
                    }
	           }else {
                    return 0;
			    }
	 	}
    }

    public function show_answers($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
         if(!$mysql){
			return "";
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
            $query    = "SELECT
                        tb_tickets.answer, tb_tickets.adminname
                        FROM
                        tb_tickets
                        WHERE tb_tickets.state='1' AND tb_tickets.user_id='".$userid. "';";
            $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
            $rnhtml = "";
            while ($arr = $respuesta->fetch_assoc()){
                if (strlen($arr['answer']) > 55) {
                    $formatstr = substr($arr['answer'],0,55) . "...";
                }else{
                    $formatstr = $arr['answer'];
                }
                $rnhtml = $rnhtml . '<div>
                <i class="fas fa-envelope bg-primary"></i>

                <div class="timeline-item">
                  <!--<span class="time"><i class="far fa-clock"></i> 12:05</span>-->

                  <h3 class="timeline-header"><a href="#">'.$arr['adminname'].' from Support Team</a> answered your support ticket</h3>

                  <div class="timeline-body">'.$arr['answer'].'
                  </div>
                  <div class="timeline-footer">
                    <a href="#" class="btn btn-primary btn-sm">Read answer</a>
                  </div>
                </div>

                

              </div>';
              
            }
            return $rnhtml;  
	 	}
    }

    public function showProjectArticlesEditor($projectid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
         if(!$mysql){
			return "";
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		    $query    = "SELECT
							tb_projects.published
							FROM
							tb_projects
							WHERE tb_projects.id='".$projectid. "';";
	 		    $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
                 $test = "";
	           if($respuesta->num_rows>0){
                    $row     			= $respuesta->fetch_row();
                    $published = $row[0];
                    if (strlen($published) > 0) {
                        $arrpub = explode("-",$published);
                        $numpublished = count($arrpub);
                        $htmlr = "";
                        for ($i = 0; $i< $numpublished; $i++){
                            $test = $test . "asd" . $arrpub[$i];
                            $state = userF::get_articles_state($arrpub[$i], $mysql);
                            if ($state > 0) {
                                $htmlr = $htmlr . userF::showPublishedEditor($arrpub[$i], $mysql, $projectid);
                            }
                            

                        }
                        return $htmlr;
                    }
	           }else {
                    return "";
			    }
	 	}
    }
    public function showPublishedEditor($id, $mysql,$projectid){
        $query    = "SELECT tb_articles.article, tb_articles.name, tb_articles.state
							FROM
							tb_articles
							WHERE tb_articles.id='$id';";
	 	$respuesta = $mysql->query($query);
        //Aqui determinamos con la instruccion if
        //la consulta generada, si mayor a cero
        //retornamos el valor verdadero
        //por el contrario mesaje de error
        if($respuesta->num_rows>0){
            $row     			= $respuesta->fetch_row();
            $article = $row[0];
            $name = $row[1];
            $state = $row[2];

            $htmlstr = '<div class="card">
            <div class="card-header">
              <h3 class="card-title">'.$name.'</h3>
            
              <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
              </div>
            </div>
            <div class="card-body p-0">
                <div class="card-body">
                    <p>'.$article.'</p>
                </div>
            </div>
            <div class="card-footer">
                    <p>This article is <b>'.userF::get_status_app($state).'</b>. </p>
                </div>
            </div>';
            
          return $htmlstr;
        }else {
            return "";
        }
    }
    public function showPublished($id, $mysql,$projectid, $role){
        $query    = "SELECT tb_articles.article, tb_articles.name, tb_articles.state
							FROM
							tb_articles
							WHERE tb_articles.id='$id';";
	 	$respuesta = $mysql->query($query);
        //Aqui determinamos con la instruccion if
        //la consulta generada, si mayor a cero
        //retornamos el valor verdadero
        //por el contrario mesaje de error
        if($respuesta->num_rows>0){
            $row     			= $respuesta->fetch_row();
            $article = $row[0];
            $name = $row[1];
            $state = $row[2];
            $htmlstr = "";
            if ((($state==2) & ($role==1)) || ($role ==3)){
                $htmlstr = '<div class="card">
                <div class="card-header">
                <h3 class="card-title">'.$name.'</h3>
                
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    
                </div>
                </div>
                <div class="card-body p-0">
                    <div class="card-body">
                        <p>'.$article.'</p>
                    </div>
                </div>';

                if ($state == 1){ //Esta esperando aprovacion del admin,
                    if ($role == 3){
                        $htmlstr = $htmlstr . '<div class="card-footer">
                            <a href="proccessarticle.php?id='.$id.'&action=1&pid='.$projectid.'" style="width:48%; float: left;" class="btn btn-success float-center">Approve article</a>
                            <a href="proccessarticle.php?id='.$id.'&action=2&pid='.$projectid.'" style="width:48%; float: right;" class="btn btn-danger float-center">Deny article</a>
                        </div>
                    </div>';
                    
                    }
                }elseif ($state == 2) { //ya fue aprobado
                    $htmlstr = $htmlstr . '<div class="card-footer">
                        <p>This article is <b>aproved</b>. </p>
                    </div>
                </div>';
                }elseif ($state == 3) { //fue denegados
                    $htmlstr = $htmlstr . '<div class="card-footer">
                        <p>This article is <b>denyed</b>. </p>
                    </div>
                </div>';
                }
            }
          return $htmlstr;
        }else {
            return "";
        }
    }
    public static function remove_article_from_project($articleid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){
            
		}else{
            $query    = "SELECT tb_articles.project_id FROM tb_articles WHERE tb_articles.id='$articleid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                $currproject = $row[0];
            
                $published = "";

                $query    = "SELECT
                        tb_projects.published FROM tb_projects WHERE tb_projects.id='".$currproject. "';";
                $respuesta = $mysql->query($query);
                //Aqui determinamos con la instruccion if
                //la consulta generada, si mayor a cero
                //retornamos el valor verdadero
                //por el contrario mesaje de error
                
                if($respuesta->num_rows>0){
                    $row = $respuesta->fetch_row();
                    $published = $row[0];
                    //ya tenemos la lista de articulos del proyecto.
                    $i = 0;

                    $arrpub = explode("-",$published);
                    $numpublished = count($arrpub);
                    $npublished = "";

                    for ($i = 0; $i< $numpublished; $i++){
                        if ($arrpub[$i] <> $articleid){
                            if ($i==0){
                                $npublished = $arrpub[0];
                            }else{
                                $npublished = $npublished . "-".$arrpub[$i];
                            }
                        }
                    }

                    $query = "UPDATE tb_projects SET tb_projects.published='$npublished' WHERE tb_projects.id='$currproject';";
                    $mysql->query($query);
                    
                }
            }
        }
    }
    public static function check_count_articles($articleid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){
            
		}else{
            $query    = "SELECT tb_articles.project_id FROM tb_articles WHERE tb_articles.id='$articleid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                $currproject = $row[0];
            
                $published = "";

                $query    = "SELECT
                        tb_projects.published, tb_projects.num_articles, tb_projects.editor_id
                        FROM
                        tb_projects
                        WHERE tb_projects.id='".$currproject. "';";
                $respuesta = $mysql->query($query);
                //Aqui determinamos con la instruccion if
                //la consulta generada, si mayor a cero
                //retornamos el valor verdadero
                //por el contrario mesaje de error
                
                if($respuesta->num_rows>0){
                    $row = $respuesta->fetch_row();
                    $published = $row[0];
                    $numarts = $row[1];
                    $editorid = $row[2];
                    //ya tenemos la lista de articulos del proyecto.
                    $i = 0;
                    $everythingok = true;
                    
                    if (strlen($published) >0){
                        $arrpub = explode("-",$published);
                        $numpublished = count($arrpub);
                        if ($numarts <= ($numpublished)) { //solamente hacemos el chequeo si el numero de articulos
                                                        //publicados es el mismo que el requisito del proyecto.
                            
                            for ($i = 0; $i< $numpublished; $i++){
                                if (userF::get_articles_state($arrpub[$i], $mysql) <> 2){
                                    //el estado es denegado o todavia no fue aprobado.
                                    $everythingok = false;
                                    
                                }
                            }
                        }else{  ; $everythingok = false;}
                    }else{  ;$everythingok = false;}
                    
                    if ($everythingok == true) {
                        
                        userF::update_project_state($currproject, 2); 
                        //le sacamos el proyecto al editor. y se lo agregamos al historial.
                        $query = "UPDATE tb_users SET tb_users.pendant_project='0' WHERE tb_users.id='$editorid';";
                        $mysql->query($query);
                    }
                }
            }
        }
    }
    public static function get_article_state($articleid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            return userF::get_articles_state($articleid, $mysql);
        }
    }
    public static function get_email($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.email FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
        }
    }
    public static function get_name($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.name FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
        }
    }
    public static function get_startedom($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.startedon FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
        }
    }
    public static function get_projects_completed($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.finishedprojects FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
        }
    }
    public static function get_skills($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.skills FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
        }
    }
    
    public static function checkpassword($userid, $password){
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $retornar = false;
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.password FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
            
            if (Password::verify($password, $row[0])){
                    $retornar = true;
            }
            }
        }
        return $retornar;
    }
    public static function get_description($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        if(!$mysql){

        }else{
            $query    = "SELECT tb_users.description FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
        }
    }
    

    public static function get_articles_state($articleid, $mysql) {
        $query    = "SELECT tb_articles.state FROM tb_articles WHERE tb_articles.id='$articleid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
    }

    public static function update_project_state($projectid, $state){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
         if(!$mysql){
            
		}else{
            $query = "UPDATE tb_projects SET tb_projects.state='$state' WHERE tb_projects.id='$projectid';";
            $mysql->query($query);
        }
    }

    public static function update_article_state($articleid, $state){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
         if(!$mysql){
            
		}else{
            $query = "UPDATE tb_articles SET tb_articles.state='$state' WHERE tb_articles.id='$articleid';";
            $mysql->query($query);
            $editor = userF::get_article_user($articleid, $mysql);
            if ($state == 2){ // si el articulo fue aprobado, le agregamos x dinero a la billetera del editor.
                userF::add_money_touser($editor, 20, $mysql);
            }
        }
    }

    public static function add_money_touser($userid, $amount, $mysql){

        $currmoney = userF::get_user_money($userid);
        $money = $currmoney + $amount;

        $query = "UPDATE tb_users SET tb_users.money='$money' WHERE tb_users.id='$userid';";
        $mysql->query($query);
    }
    public static function get_numarticles($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $query    = "SELECT tb_users.numarticles FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
    }
    public static function get_ticket_print($ticketid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $query    = "SELECT tb_tickets.ticket, tb_tickets.user_id, tb_tickets.date FROM tb_tickets WHERE tb_tickets.id='$ticketid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                $htmlticket = $row[0] . "<br> <b>User: </b>". userF::get_user_name($row[1], $mysql) . '(UserID: '. $row[1] .'). Date: ' . $row[2];
                return $htmlticket;
            }
    }
    public static function get_user_money($userid){
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $query    = "SELECT tb_users.money FROM tb_users WHERE tb_users.id='$userid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
    }
    public static function get_numarts2_project($projectid) {
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $query    = "SELECT tb_projects.num_articles FROM tb_projects WHERE tb_projects.id='$projectid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
    }
    public static function get_numarts_project($projectid, $mysql) {
        $query    = "SELECT tb_projects.num_articles FROM tb_projects WHERE tb_projects.id='$projectid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
    }

    public static function get_article_user($articleid, $mysql) {
        $query    = "SELECT tb_articles.user_id FROM tb_articles WHERE tb_articles.id='$articleid';";
            $respuesta = $mysql->query($query);
            //Aqui determinamos con la instruccion if
            //la consulta generada, si mayor a cero
            //retornamos el valor verdadero
            //por el contrario mesaje de error
            if($respuesta->num_rows>0){
                $row  = $respuesta->fetch_row();
                return $row[0];
            }
    }
    //******************************************************************************* */
    
    //******************************************************************************* */
    public function list_pending_aprov_Projects(){
        $IDusr		=$_SESSION['INGRESO']["Id"];
        
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $roleid = userF::get_role($IDusr);
        //Determinamos si la conexion a la bd es correcto.
        if($mysql->connect_errno){
            $this->Mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>Error! Server of data not found</div>';
            exit;
        }else{
            if ($roleid == 3){
                //si es un admin mostramos los proyectos pendientes a aprobar
                $query    = "SELECT * FROM tb_projects WHERE tb_projects.ispublished='1' AND tb_projects.state='1';";
            }
                $respos = $mysql->query($query);
                $liststr  = "";
                $tmpstr = "";
                while ($arr = $respos->fetch_assoc()){
                    $tmpstr =  $arr['class'];
                    if (strlen($arr['description']) > 33) {
                        $formatstr = substr($arr['description'],0,33) . "...";
                    }else{
                        $formatstr = $arr['description'];
                    }
                    
                    $liststr = $liststr . "<tr> <td>" . $arr['id'] . //id
                                "</td> <td>" . $arr['name'] .  //name
                                "</td> <td>" . $arr['date'] . //date
                                "</td> <td>" . userF::get_class_name($tmpstr, $mysql) . //class
                                "</td> <td>" . userF::get_status_app($arr['state']) . //status
                                "</td> <td>" . $formatstr . '</td> <td> 
                                <a style="width: 150px;" href="viewpublished.php?id='.$arr['id'].'"><button type="button" class="btn btn-secondary btn-block btn-sm">Show project</button></a>' . "</td></tr>" ;//cerramos el item
                
                }
            
                return $liststr;
                
            
        }

    }
    public function list_Projects(){
        $IDusr		=$_SESSION['INGRESO']["Id"];
        
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $roleid = userF::get_role($IDusr);
        //Determinamos si la conexion a la bd es correcto.
        if($mysql->connect_errno){
            $this->Mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>Error! Server of data not found</div>';
            exit;
        }else{
            if ($roleid == 1){
                //esi es un usuario, listamos solamente sus proyectos.
                $query    = "SELECT * FROM tb_projects WHERE tb_projects.user_id='".$IDusr."';";
                
            }elseif ($roleid == 2){ //ees editor
                $query    = "SELECT * FROM tb_projects WHERE tb_projects.editor_id='0' AND tb_projects.state=1;";
                
            
            }elseif ($roleid == 3){ //ees admin
                $query    = "SELECT * FROM tb_projects;";
                
            }
                $respos = $mysql->query($query);
                $liststr  = "";
                $tmpstr = "";
                while ($arr = $respos->fetch_assoc()){
                    $tmpstr =  $arr['class'];
                    if (strlen($arr['description']) > 22) {
                        $formatstr = substr($arr['description'],0,22) . "...";
                    }else{
                        $formatstr = $arr['description'];
                    }
                    if ($roleid == 3) {
                        $liststr = $liststr . "<tr> <td>" . $arr['id'] . //id
                                    "</td> <td>" . $arr['name'] .  //name
                                    "</td> <td>" . $arr['date'] . //date
                                    "</td> <td>" . userF::get_class_name($tmpstr, $mysql) . //class
                                    "</td> <td>" . $arr['num_articles'] . //date
                                    "</td> <td>" . userF::get_status_app($arr['state']) . //status
                                    "</td> <td>" . $formatstr . '</td> <td> 
                                    <a style="width: 150px;" href="../viewproject.php?id='.$arr['id'].'"><button type="button" class="btn btn-secondary btn-block btn-sm">More info</button></a>' . "</td></tr>" ;//cerramos el item
                    }else{
                        $liststr = $liststr . "<tr> <td>" . $arr['id'] . //id
                                    "</td> <td>" . $arr['name'] .  //name
                                    "</td> <td>" . $arr['date'] . //date
                                    "</td> <td>" . userF::get_class_name($tmpstr, $mysql) . //class
                                    "</td> <td>" . $arr['num_articles'] . //date
                                    "</td> <td>" . userF::get_status_app($arr['state']) . //status
                                    "</td> <td>" . $formatstr . '</td> <td> 
                                    <a style="width: 150px;" href="viewproject.php?id='.$arr['id'].'"><button type="button" class="btn btn-secondary btn-block btn-sm">More info</button></a>' . "</td></tr>" ;//cerramos el item
                    
                    }
                }
            
                return $liststr;
                
            
        }

    }
    public function list_tickets(){
        $IDusr		=$_SESSION['INGRESO']["Id"];
        
        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        $roleid = userF::get_role($IDusr);
        //Determinamos si la conexion a la bd es correcto.
        if($mysql->connect_errno){
            $this->Mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>Error! Server of data not found</div>';
        }else{
            if ($roleid == 3){
                //si es un admin mostramos los proyectos pendientes a aprobar
                $query    = "SELECT * FROM tb_tickets 
                             WHERE tb_tickets.state='0';";
            
                $respos = $mysql->query($query);
                $liststr  = "";
                $formatstr = "";
                while ($arr = $respos->fetch_assoc()){
                    if (strlen($arr['ticket']) > 33) {
                        $formatstr = substr($arr['ticket'],0,33) . "...";
                    }else{
                        $formatstr = $arr['ticket'];
                    }
                    
                    $liststr = $liststr . "<tr> <td>" . $arr['id'] .
                                "</td> <td>" . userF::get_user_name($arr['user_id'], $mysql) . " (ID: " . $arr['user_id'] .")" .//id
                                "</td> <td>" . $arr['date'] .  //state
                                "</td> <td>" . userF::get_statust_app($arr['state']) .
                                "</td> <td>" . $formatstr . '</td> <td> 
                                <a style="width: 150px;" href="answerticket.php?id='.$arr['id'].'"><button type="button" class="btn btn-secondary btn-block btn-sm">Show ticket</button></a>' . "</td></tr>" ;//cerramos el item
                
                   
                }
            
         return $liststr;
                
            }
                
            
        }

    }

    private function get_statust_app($status){
        switch ($status) {
            case 0: 
                
                return '<span class="badge bg-warning">Pending</span>' ;
                break;

            case 1: //approved
                return '<span class="badge bg-success">Answered</span>';
                break;
        }
    }
    private function get_user_name($userid, $mysql){
        $query    = "SELECT name FROM tb_users WHERE tb_users.id='".$userid."';";
            

        $respos = $mysql->query($query);
        $tmparr = $respos->fetch_assoc();
        return $tmparr['name'];
    }
    private function get_class_name($class, $mysql){
        $query    = "SELECT name FROM tb_classes WHERE tb_classes.id='".$class."';";
        $respos = $mysql->query($query);
        $tmparr = $respos->fetch_assoc();
        return $tmparr['name'];  
    }
    private function get_status_app($status){
        switch ($status) {
            case 1: 
                
                return '<span class="badge bg-warning">Pending</span>' ;
                break;

            case 2: //approved
                return '<span class="badge bg-success">Approved</span>';
                break;

            case 3: //denied
                return '<span class="badge bg-danger">Denied</span>';
                break;
        }
    }
	
}





?>