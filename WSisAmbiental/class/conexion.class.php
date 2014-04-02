<?php  
require_once('VariableGlobal.php'); 
$obje = new ConfiguracionGlobal ; 

$mi_bd = $obje->G_BaseDatos;
$mi_servidor = $obje->G_Servidor; 
$mi_usuario = $obje->G_Usuario;
$mi_password = $obje->G_Clave;
 
class DBManager extends  ConfiguracionGlobal{
var $conect;
var $BaseDatos;
var $Servidor;
var $Usuario;
var $Clave;
	function DBManager(){
		$this->BaseDatos = $this->G_BaseDatos;
		$this->Servidor = $this->G_Servidor; 
		$this->Usuario = $this->G_Usuario;
		$this->Clave = $this->G_Clave;  
  	}
	
	function conectar(){
		try
		{
			$db = new PDO("sqlsrv:Server=".$this->Servidor." ; Database =".$this->BaseDatos, $this->Usuario, $this->Clave);
        	$db->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY, true);
        	return $db ;			
		} catch( PDOException $e)
		{
			print  "<p><b> [:(] Error : </b> No puede conectarse con la base de datos.</p>\n";
        	exit();
		}
	}
}



?>

 