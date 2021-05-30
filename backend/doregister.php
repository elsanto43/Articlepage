<?php 
/**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 */

//importando datos para
//conectarse
require_once 'PasswordHash.Class.php';
require_once 'config.php';
require_once 'determ.php';
/**
* clase para hacer login
* a la seccionde administracion
*/

class Register{

	//campos que alamcenan los valores 
	private $Mail_       ="";
	private $Contrasena_ ="";
	private $Mensaje     ="";
	private $Nombre_usr  ="";
	private $roleid;
    /**
     * [constructor recibe argumentos]
     * @param [type] $Mail    [ingresar correo]
     * @param [type] $Pasword [Ingresar contraseña]
     */
	function __construct($Nombre,$Mail,$Pasword){
		$this->Mail_=$Mail;
		$this->Contrasena_=$Pasword;
        $this->Nombre_usr=$Nombre;
	}

/**
 * [Metdo devuelve true o false para ingresar
 * a la sesccion de pagina de administracion
 * ]
 */
	public function Registrar(){
		//determinamos cada uno de los
		//metodos devueltos
		if($this->ValidarRegistro()==false){
		    $this->Mensaje=$this->Mensaje;	
		}
	}

	/**
	 * Validamos la entrada de correo
	 * electronico
	 * @param [String mail]
	 */
	private function ValidarRegistro(){
		$retornar=false;
		$mailfilter =filter_var($this->Mail_,FILTER_VALIDATE_EMAIL);//filtramos el correo
		//Validamos el formato  de correo electronico utilizando expresiones regulares
		if(preg_match("/[a-zAZ0-9\_\-]+\@[a-zA-Z0-9]+\.[a-zA-Z0-9]/", $mailfilter )==true){
			//intanciando de las clases
			$confi=new Datos_conexion();
			$mysql=new mysqli($confi->host(),$confi->usuario(),$confi->pasword(),$confi->DB());
			//Determinamos si la conexion a la bd es correcto.
			if(!$mysql){
				$this->Mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>Error! Server of data not found</div>';
			}else{
				//consulta SQL para vereficar si existe tal correo 
				$query    = "SELECT
								tb_users.email
								FROM
								tb_users
								WHERE tb_users.email='".$mailfilter."';";
				$respuesta = $mysql->query($query);
					//Aqui determinamos con la instruccion if
					//la consulta generada, si mayor a cero
					//retornamos el valor verdadero
					//por el contrario mesaje de error
				if($respuesta->num_rows>0){
					//asignamos el mail sanitizado  al campo Mail_
                    $this->Mail_=$mailfilter;	
                    $retornar=false;// se retorna un valor verdadero
                    $this->Mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>This email is in use</div>';
                    
				}else { //el email no esta en uso, registramos el usuario.
					$passwdhashed = Password::hashp($this->Contrasena_);
					$tmpdate = date('d/m/Y');
                    $query    = "INSERT INTO tb_users
								(`id`, `role_id`, `name`, `email`, `passwd`,  `startedon`, `recoveryCode`, `pendant_project`) VALUES (NULL, '1', '$this->Nombre_usr', '$mailfilter', '$passwdhashed', '$tmpdate', '0', '0');";
					
                    if ($mysql->query($query) === true) {
						$inicio=new Login($mailfilter,$this->Contrasena_);
						$inicio->Ingresar();
						$idsur              = ($mysql->insert_id);
						//Recuperando el IP del usuario atravez del metodo IPuser()  
						$IpUsr               = $this->IPuser();
						//Recuperando la hora en el que ingreso
						$hora                = time();
						$Contrasena = new PasswordHash(8, FALSE);
						//Recuperamos recuperando los dados para incriptar
						$Clave = $Contrasena->HashPassword($idsur.$IpUsr.$this->Nombre_usr.$hora); 
						//Registrando a la varaible global datos en un arreglo para iniciar session
						$_SESSION['INGRESO'] = array(
							"Id"    =>$idsur,
							"Ip"    =>$IpUsr,
							"Clave" =>$Clave,
							"Nombre"=>$this->Nombre_usr,
							"hora"  =>$hora,
							"role"  => '1'); 
					
						echo    "<script>
							
							  window.location.replace('./account.php'); 
							  </script>";
					}
                }
			}
		}else{

			//Se muestra al usuario el mensaje de error sobre
				//el formato de correo
				$this->Mensaje='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h6><i class="icon fas fa-ban"></i> Error!</h6>Invalid email</div>';
		}
	    return $retornar;
	}

	private function IPuser() {
		$returnar ="";
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		 $returnar=$_SERVER['HTTP_X_FORWARDED_FOR'];}
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		 $returnar=$_SERVER['HTTP_CLIENT_IP'];}
	if(!empty($_SERVER['REMOTE_ADDR'])){
		 $returnar=$_SERVER['REMOTE_ADDR'];}
	return $returnar;
	}
	
	/**
	 * Devuel el mesaje generado
	 * para mostrar al suario
	 */
	public function MostrarMsg(){
		return $this->Mensaje;
	}


}








 ?>




