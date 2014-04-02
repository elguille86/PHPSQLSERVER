<?php session_start();
require_once('Controller.class.php'); 
$obj_funciones = new cls_funciones;
$user_name 	= $obj_funciones->scape($_POST['user_name']);	
$pass 		= $obj_funciones->scape($_POST['password']);
 
if(!isset($user_name )){ 
	session_destroy();
 	header("Location: ".$obj_funciones->mi_hosting() );
	return;
} 
 

$result = $obj_funciones->f_valid_user($user_name, $pass);
 
 if($result!=null){
 	foreach ($result as $valor) {
        $respuesta =  $valor[cant];
    }
 } 
 
switch($respuesta){
	case '1':
	$_SESSION['id_sisambiental'] = $user_name ;
		echo "SysAReg.php"; break;
	case '0':
		session_destroy();
		echo "Error no coninside el usuario y/o clave ";break;
	default:
		session_destroy();
		echo "Error Intento de vulneral el Sistema ";break;
}	  
 
?>