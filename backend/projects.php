<?php 

//importando datos para
//conectarse
require_once 'config.php';
/**
* clase para crear nuevo proyecto
*/

class Project{

	//campos que alamcenan los valores 

	private $nombre       ="";
	private $descripcion ="";
	private $clase;
	private $tipo ;
	private $cantidad;
	public $mensaje     ="";

    /**
     * [constructor recibe argumentos]
     * @param [type] $Mail    [ingresar correo]
     * @param [type] $Pasword [Ingresar contraseña]
     */
	function __construct($nombre_,$descripcion_,$clase_,$tipo_,$cantidad_){
		$this->nombre=$nombre_;
		$this->descripcion=$descripcion_;

		$this->clase= $clase_;
		$this->tipo= $this->tipostr_toNum($tipo_);
		$this->cantidad=$cantidad_;
	}

	
private function clasestr_toNum($mysql, $clasestr){
	$query    = "SELECT id FROM tb_classes WHERE tb_classes.name='".$clasestr."';";
	
	$respos = $mysql->query($query);
	$tmparr = $respos->fetch_assoc();
	return $tmparr['id'];
}
private function tipostr_toNum($tipostr){
	switch ($tipostr) {
		case "Small article":
			return 1;
			break;
		case "Medium article":	
			return 2;
			break;
		case "Large article":
			return 3;
			break;
		case "Very large article":	
			return 4;
			break;
	}
}

/**
 * [Metdo devuelve true o false para ingresar
 * a la sesccion de pagina de administracion
 * ]
 */
public function newProject(){
    //chekeamos los datos, y insertamos el nuevo proyecto si esta todo OK, sino devolvemos mensaje de error.
	$this->mensaje="";
	$IDusr		=$_SESSION['INGRESO']["Id"];
	
	$numarts = userF::get_numarticles($IDusr);
	$confi=new Datos_conexion();
	$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
	
	if ($numarts >= $this->cantidad) {
	//Determinamos si la conexion a la bd es correcto.
		if($mysql->connect_errno){
			exit;
		}else{
			$strclase = $this->clasestr_toNum($mysql, $this->clase);
			$tmpdate = date('d/m/Y');
			$query    = "INSERT into tb_projects (`id`, `user_id`, `name`, `date`, `description`,
							`num_articles`, `type`, `class`, `state`) 
							VALUES (NULL, '".$IDusr."', '".$this->nombre."', '".$tmpdate."', '".$this->descripcion."',
									'".$this->cantidad."', ".$this->tipo.", '". $strclase."', '1');";
			
			$mysql->query($query);

			$idnew= ($mysql->insert_id);
			$mysql->close();
			
			
			
			//si todo esta ok, lo redirecciona a viewproject.php
			echo    "<script type=\"text/javascript\">
								window.location=./../viewproject.php?id='".$idnew."'\"
								</script>";
		}
	}else{
		$this->mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>You do not have enough articles. <a style=""href="buy-entrys.php" class="">Buy more</a><br><br></div>';
	}
		
	
}

public function MostrarMsg(){
	return $this->mensaje;
}



}

class viewproject{
	
	public function printViewProject($projectid, $IDusr){

        $confi=new Datos_conexion();
        $mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
        
        //Determinamos si la conexion a la bd es correcto.
        if($mysql->connect_errno){
            
            exit;
        }else{	
			
                //esi es un usuario, listamos solamente sus proyectos.
			$query    = "SELECT * FROM tb_projects WHERE tb_projects.id=".$projectid.";";

			$respos = $mysql->query($query);
			
			$liststr  = "";
			$tmpstr = "";
			$roleid = $this->get_role($IDusr,$mysql);
			$arr = $respos->fetch_assoc();
			if (($arr['user_id'] == $IDusr) || ($roleid > 1)){
				$tmpstr =  $arr['class'];
				$printstr = '<div class="row">
							<div class="col-sm-6">
							
							<div class="form-group">
								<label for="Name">Project Name</label>
								<input name="name" type="text" id="name" value="'.$arr['name'].'" class="form-control" disabled="">
							</div>
							<div class="form-group">
								<label for="date">Date of creation</label>
								<input name="date" type="text" id="name" value="'.$arr['date'].'" class="form-control" disabled="">
							</div>
							<div class="form-group">
								<label for="Description">Project Description</label>
								<textarea name="description" id="description" class="form-control" rows="5" disabled="">'.$arr['description'].'</textarea>
							</div>
							</div>

							<div class="col-sm-6">
							<div class="form-group">
								<label for="inputStatus">Type</label>
								<select name="type" class="form-control select2bs4" style="width: 100%;" disabled="">
									<option selected="selected">'.$this->getType($arr['type']).'</option>
								</select>
							</div>
							<div class="form-group">
								<label for="inputStatus">Class</label>
								<select name="class" disabled="" class="form-control select2bs4" style="width: 100%;">
									<option selected="selected">'.$this->get_class_name($tmpstr, $mysql).'</option>
								</select>
							</div>
							<div class="form-group">
								<label for="inputStatus">Number of articles</label>
								<select name="numberart" disabled="" class="form-control select2bs4" style="width: 100%;">
									<option selected>'.$arr['num_articles'] .'</option>
								</select>
							</div>
							<div class="form-group">
								<label>Status: </label> '.$this->get_status_app($arr['state']).'
								
							</div>
							
							</div>
							
						</div>';
				return $printstr;
			}else{
				echo    "<script type=\"text/javascript\">
						window.location=./../account.php\"
						</script>";

			}
			
        }

}

private function get_class_name($clasestr, $mysql){
	$query    = "SELECT name FROM tb_classes WHERE tb_classes.id='".$clasestr."';";
	
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
private function get_role($id, $mysql) {
	
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

public static function getType($type){
	switch ($type){
		case '1':
			return "Small article";
			break;
		case '2':
			return "Medium article";
			break;
		case '3':
			return "Large article";
			break;
		case '4':
			return "Very large article";
			break;
	}
}
}


 ?>




