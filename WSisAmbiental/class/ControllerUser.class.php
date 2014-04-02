<?php session_start(); 
require_once("Controller.class.php"); 
$obj_funciones = new cls_funciones;
 /*
if(empty($_SESSION['id_sisambiental'])){ session_destroy();
	header("Location: ".$obj_funciones->mi_hosting()."salir.php" );
}	*/
require_once("conexion.class.php");
$secion_token = $_SESSION['acttoken'];

$nombres =  $obj_funciones->ExistePost($obj_funciones->scape($_POST['nombres']));
$nivel = 	$obj_funciones->ExistePost($obj_funciones->scape($_POST['nivel']));
$idlogin = 	$obj_funciones->ExistePost($obj_funciones->scape($_POST['id']));
$idpwd = 	$obj_funciones->ExistePost($obj_funciones->scape($_POST['pdw']));
$typec = 	$obj_funciones->ExistePost($obj_funciones->scape($_POST['typec']));
$token = 	$obj_funciones->ExistePost($_POST['token']);

// echo $nombres." - ".$nivel." - ".$idlogin." - ".$idpwd." - ".$typec." - ".$token;
// zona de Conexion de la Base de Datos

 
function f_InsertaUsser($usuario,$clave,$nombre,$nvel ){
	$con = new DBManager;
	$SQL1 = " exec S_InseUser '".$usuario."','".$clave."','".$nombre."','".$nvel."'";
	return  $con->conectar()->query($SQL1);
}

function NuevoUsuario( $usuario,$clave,$nombre,$nvel ) 
{
	if($nvel =='N000'){
		$imprime1 = $mensaje  =  "Debe Seleccionar un Modulo"; /// Error ya esiste
		$clase1  =  "error";
		return array ($mensaje, $clase1, $imprime1);
	}
	$ov = new cls_funciones;
	$valiUsusrio = $ov->EsBlanco($usuario,'Usuario');
	if($valiUsusrio!="true"){
			$imprime1 = $mensaje  =  $valiUsusrio; /// Error ya esiste
		$clase1  =  "error";
		return array ($mensaje, $clase1, $imprime1);
	
	}
	$valiUsusrio = $ov->EsBlanco($nombre,'Nombre');
	if($valiUsusrio!="true"){
			$imprime1 = $mensaje  =  $valiUsusrio; /// Error ya esiste
		$clase1  =  "error";
		return array ($mensaje, $clase1, $imprime1);
	
	}
	$valiUsusrio = $ov->EsBlanco($clave,'Clave ');
	if($valiUsusrio!="true"){
			$imprime1 = $mensaje  =  $valiUsusrio; /// Error ya esiste
		$clase1  =  "error";
		return array ($mensaje, $clase1, $imprime1);
	
	}

	
	$usuario 	= $ov->scape($usuario);
	$clave 		= $ov->scape($clave);
	$nombre 	= $ov->scape($nombre);
	$resultado = f_InsertaUsser($usuario,$clave,$nombre,$nvel );
	$canta =  $resultado->rowCount();
	foreach ($resultado as $valor) {
		$imprime1 = $mensaje  =  $valor[0]; /// Error ya esiste
		$clase1  =  $valor[1]; ///  error
	}
	if($canta == '1')
	{
		$clase1  =  "exito";
		$imprime1 =$mensaje  =  "[:D El usuario fue Registrado en la Base de Datos.";
		//$imprime1 = 'SysAReg.php?opm=MsgText';
		
	}
 	return array ($mensaje, $clase1, $imprime1);
}
  
  list ($mensaje, $clase, $imprime) = NuevoUsuario( $idlogin,$idpwd,$nombres,$nivel   );
/*
 if(isset($secion_token)  && isset($token) && $token  = $secion_token){
	switch($typec)
	{
		case '1': 
			list ($mensaje, $clase, $imprime) = NuevoUsuario( $idlogin,$idpwd,$nombres,$nivel   );
		break;
	} 
 
}else{
		$mensaje = "Error : de archivo no usar caracteres especiales Ñ, ñ ....";
		$imprime = "ok"; 
		$clase = "error"; 
} 
 */
$_SESSION['mensaje'] = $mensaje;
$_SESSION['clsmensaje'] = $clase;
echo trim($imprime);  
?>