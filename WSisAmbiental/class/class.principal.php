<?php class cls_principal{
	function __construct(){
		if(isset($_GET['opm'])){
			$obj = new cls_funciones;
			$tabla = $obj->f_Menu_Sistema($_SESSION['id_sisambiental']);
			switch($_GET['opm']){
				case 'MsgText': $this->Mensaje();break;
				case 'NewUser':  
				 	foreach ($tabla as $filas) {
				        if($filas[value]=='NewUser'){ $this->ViewUsuarioDIRESA();break; }
				    }  
					break;
				case 'NwIspe':  
				 	foreach ($tabla as $filas) {
				        if($filas[value]=='NwIspe'){ $this->ViewInspector();break; }
				    }  
					break;
				default: $this->Error404();break; 
				}
		}else{
			include('view/view_bienvenida.php');			
		}
	}

	function ViewUsuarioDIRESA()
	{
	 	include('view/view_Usuario.php');
	}
	function ViewInspector()
	{
	 	include('view/view_Inspector.php');
	}

	function Error404(){
		echo "<div id='IdContruccion'><center>No Existe la Pagina Solicitada</center></div>";
	} 

	function Mensaje(){
		include('view/view_mensaje.php');
	}
}
?> 