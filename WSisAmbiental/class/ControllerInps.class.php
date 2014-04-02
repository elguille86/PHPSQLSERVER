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
$cent = 	$obj_funciones->ExistePost($obj_funciones->scape($_POST['cent']));
$typec = 	$obj_funciones->ExistePost($obj_funciones->scape($_POST['typec']));
$token = 	$obj_funciones->ExistePost($_POST['token']);

// echo $nombres." - ".$nivel." - ".$idlogin." - ".$idpwd." - ".$typec." - ".$token;
// zona de Conexion de la Base de Datos

 
function f_InsertaInspec($nombres,$cent){
	$con = new DBManager;
	$SQL1 = " exec S_GrabaInspetor '".$nombres."','".$cent."'";
	return  $con->conectar()->query($SQL1);
}

function NuevoInspeccion( $nombres,$cent  ) 
{
	if($cent == 0 ){
		$imprime1 = $mensaje  =  "Debe Seleccionar un Centro"; /// Error ya esiste
		$clase1  =  "error";
		return array ($mensaje, $clase1, $imprime1);
	}
	$ov = new cls_funciones;
	$valiUsusrio = $ov->EsBlanco($nombres,'Nombre');
	if($valiUsusrio!="true"){
			$imprime1 = $mensaje  =  $valiUsusrio; /// Error ya esiste
		$clase1  =  "error";
		return array ($mensaje, $clase1, $imprime1);
	
	}
 
	$nombres 	= $ov->scape($nombres);
	$cent 		= $ov->scape($cent);
 
	$resultado = f_InsertaInspec($nombres,$cent  );
	$canta =  $resultado->rowCount();
	foreach ($resultado as $valor) {
		$imprime1 = $mensaje  =  $valor[0]; /// Error ya esiste
		$clase1  =  $valor[1]; ///  error
	}
	if($canta == '1')
	{
		$clase1  =  "exito";
		$mensaje  =  "[:D Dato Registrado en la Base de Datos.";
		$imprime1 = 'SysAReg.php?opm=MsgText';
		
	}
 	return array ($mensaje, $clase1, $imprime1);
}
  
  list ($mensaje, $clase, $imprime) = NuevoInspeccion( $nombres,$cent   );
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