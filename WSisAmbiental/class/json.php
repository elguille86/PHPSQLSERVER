<?php session_start(); 
include_once("Controller.class.php");  
$obj_funciones = new cls_funciones;
 
if(empty($_SESSION['id_sisambiental'])){ session_destroy();
	header("Location: ".$obj_funciones->mi_hosting()."salir.php" );
}	 
$typec = $_GET['type'];	
	function ListaUsuario(){
    $obj_vista = new cls_funciones ;
    $i =1;
    $result= $obj_vista->f_ListaUsuarios();
    $ArrayNiveles= $obj_vista->f_ListaNiveles();
      foreach ($result as $valor) {
        $customers1[] = array(
          'nro' => $i,
          'use_id' => $valor[0],
          'pdp' => utf8_encode($valor[1]),
          'use_name' =>  $valor[2],
          'Cod_nvl' => utf8_encode($valor[3]),
          'nivel' =>  $valor[4],
          'codsta' =>  $valor[5],
          'estado' =>  $valor[6],
        );    
        $i=$i+1;
      }		
	  return json_encode($customers1 );
	}
	
	switch($typec)
	{
		case '1': echo  ListaUsuario(); break;
	} 
   
 
?>
  	 