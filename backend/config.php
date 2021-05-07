<?php 
/**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 */
/**
 * Clase para realizar conexión
 * a la BD, solo cambiar datos de los
 * campos.
 */
class Datos_conexion {
	private $host_="localhost";
	private $usuario_="root";
	private $pasword_="";
	private $Db_="web_db";
	/**
	 * Devuelve el nombre de hsot
	 * @return [type] [string]
	 */
	public function host(){
		return $this->host_;
	}
	/**
	 * Devuelve el nombre de usuario
	 * @return [type] [string]
	 */
	public function usuario(){
		return $this->usuario_;
	}
	/**
	 * Devuelve la contraseña de acceso
	 * @return [type] [string]
	 */
	public function pasword(){
		return $this->pasword_;
	}
	/**
	 * Devuelve nombre de la base de datos
	 * @return [type] [string]
	 */
	public function DB(){
		return $this->Db_;
	}
}
