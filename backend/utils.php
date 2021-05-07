<?php
    require_once 'config.php';
class Utils {

    public static function login($id) {
        $_SESSION['id'] = $id;
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }

    public static function getLoggedIn() {
        if(isset($_SESSION['id']))
            return $_SESSION['id'];
        else
            return 0;
    }

}

class userF {
    private $liststr       ="";

    public static function has_pending_proyect($id) {
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
							WHERE tb_users.id='".$id. "';";
	 		    $respuesta = $mysql->query($query);
	 		    //Aqui determinamos con la instruccion if
	 		    //la consulta generada, si mayor a cero
	 		    //retornamos el valor verdadero
	 		    //por el contrario mesaje de error
	           if($respuesta->num_rows>0){
                    $row     			= $respuesta->fetch_row();
                    $hasproject              =$row[0];
                    if ($hasproject <> 0) {
                        return true;
                    
                    }else {
                        return false;
                    }
	           		
	           }else {
                    return 0;
			}
	 	}
    }

    public static function get_text_saved($id) {
        $confi=new Datos_conexion();
	 	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        //Determinamos si la conexion a la bd es correcto.
	 	if(!$mysql){
			return 0;
		}else{
	 		//consulta SQL para vereficar si existe tal correo del
	 		//usario que introdujo 
	 		  $query    = "SELECT
							tb_users.editor_saved
							FROM
							tb_users
							WHERE tb_users.id='".$id. "';";
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
							WHERE tb_users.id='".$id. "';";
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

    public function list_Projects($roleid){
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
                $query    = "SELECT * FROM tb_projects WHERE tb_projects.state='1';";
                
            
            }elseif ($roleid == 3){ //ees admin
                $query    = "SELECT * FROM tb_projects;";
                
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
                    if ($roleid == 3) {
                        $liststr = $liststr . "<tr> <td>" . $arr['id'] . //id
                                    "</td> <td>" . $arr['name'] .  //name
                                    "</td> <td>" . $arr['date'] . //date
                                    "</td> <td>" . userF::get_class_name($tmpstr, $mysql) . //class
                                    "</td> <td>" . userF::get_status_app($arr['state']) . //status
                                    "</td> <td>" . $formatstr . '</td> <td> 
                                    <a style="width: 150px;" href="../viewproject.php?id='.$arr['id'].'"><button type="button" class="btn btn-secondary btn-block btn-sm">More info</button></a>' . "</td></tr>" ;//cerramos el item
                    }else{
                        $liststr = $liststr . "<tr> <td>" . $arr['id'] . //id
                                    "</td> <td>" . $arr['name'] .  //name
                                    "</td> <td>" . $arr['date'] . //date
                                    "</td> <td>" . userF::get_class_name($tmpstr, $mysql) . //class
                                    "</td> <td>" . userF::get_status_app($arr['state']) . //status
                                    "</td> <td>" . $formatstr . '</td> <td> 
                                    <a style="width: 150px;" href="viewproject.php?id='.$arr['id'].'"><button type="button" class="btn btn-secondary btn-block btn-sm">More info</button></a>' . "</td></tr>" ;//cerramos el item
                    
                    }
                }
            
                return $liststr;
                
            
        }

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