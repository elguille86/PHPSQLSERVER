<?php 
require_once("conexion.class.php");
include_once("MisFunciones.php"); 
class cls_funciones  extends  LibreriaFuncinos {
//constructor 
	var $con;
	
	function cls_funciones(){
		$this->con = new DBManager;
	} 

	function f_valid_user($usuario,$clave){
		 $SQL1 = "select count(*) as cant from  TbUsuarios where use_id='$usuario' and use_pwd='$clave' ";
		 return  $this->con->conectar()->query($SQL1);
		//$SQL1 = "select  Cod_nvl as cant ,use_id   from  TbUsuarios";
	}
	
	function f_exite_user($usuario){
		$SQL1 = "exec S_Existe_Usuario '$usuario' ";
		return  $this->con->conectar()->query($SQL1);
	}	

	function f_Menu_Sistema($usuario){
		$SQL1 = "exec sp_listamenu '$usuario' ";
		return  $this->con->conectar()->query($SQL1);
	}
 
 	function f_ListaUsuarios(){
		$SQL1 = "exec S_ListaUsuarios";
		return  $this->con->conectar()->query($SQL1);
	}
 
 	function f_ListaNiveles(){
		$SQL1 = "exec S_ListaNiveles";
		return  $this->con->conectar()->query($SQL1);
	}
	
 
 	function f_ListaCentros(){
		$SQL1 = "exec S_ListaCentos";
		return  $this->con->conectar()->query($SQL1);
	}
 
}
 
?>