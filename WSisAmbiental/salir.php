<?php session_start(); 
require_once('Class/Controller.class.php'); 
$obj_funciones = new cls_funciones;
//if(isset($_GET['cierra'])){ 
	session_destroy();
	//session_unset();
	header("Location: ".$obj_funciones->mi_hosting() );
	//header("Location: index.php");
//} 
 
 
?>

