<?php  
include_once('VariableGlobal.php'); 

class LibreriaFuncinos extends  ConfiguracionGlobal  
{

	public function mi_hosting() 
	{
		return 'http://'.$_SERVER['SERVER_NAME'].'/'.$this->G_hosting;
	}

	public function mi_key() 
	{
		return $this->G_key;
	}

	function scape($text){
  		if(!get_magic_quotes_gpc()) $text = addslashes($text);
  		return trim($text);
	} 

	public function validateFecha($campo) {
		$partes= explode("-", trim($campo)); 
		if (checkdate ($partes[1],$partes[2],$partes[0])) 
		{ 
			return 'true'; 
		} 
		else 
		{ 
			return "Formato de Fecha Incorrecto : ".$campo; 
		} 
	}
	
    public	function Valida_Year($parametro)
	{
		// Funcion utilizada para validar el dato a ingresar recibido por GET
		$parametro = trim($parametro);
		if( strlen( trim($parametro)) ==4){	return "true";}
		else{	  return "El año debe ser de 4 digitos ";}
	} 

	public function ValidaNumero($valor)
	{
		if(is_int(trim($valor))){
     		//la variable es un numero
     		return "El '".$valor."' no es un numero";
		}else{
     		return "true";
		}
	}

	public function EsBlanco($valor , $NomCampValidar )
	{
		$datos = trim($valor);
		if($datos == "" or $datos == NULL){
			return "Debe ingresar datos en  '".$NomCampValidar."'" ;
		}else { 
			return  "true";
		}
	}

 	public function ValidaComparacion($valor,$refere, $mensaje)
	{
		if( trim($valor) == trim($refere) ){
     		return $mensaje;
		}else{
     		return "true";
		}
	}

	public function ExistePost($valorPost)
	{
		if (empty($valorPost)){
			return ""; //echo "El nombre esta vacío.:.";
		}else{
			return trim($valorPost); 
		}	
	}
 

	public function encrypt($string, $key) 
	{
   		$result = '';
   		for($i=0; $i<strlen($string); $i++) 
   		{
      		$char = substr($string, $i, 1);
      		$keychar = substr($key, ($i % strlen($key))-1, 1);
      		$char = chr(ord($char)+ord($keychar));
      		$result.=$char;
   		}
   		return base64_encode($result);
	}
 
 	public function decrypt($string, $key) 
 	{
   		$result = '';
   		$string = base64_decode($string);
   		for($i=0; $i<strlen($string); $i++) 
   		{
      		$char = substr($string, $i, 1);
      		$keychar = substr($key, ($i % strlen($key))-1, 1);
      		$char = chr(ord($char)-ord($keychar));
      		$result.=$char;
   		}
   		return $result;
	}
 

	public function Fecha_MES($fecha){

		$fechas = explode("-", $fecha);
		$year = $fechas[0];
		$mes = $fechas[1];
		$dia = $fechas[2];		
		$letrames = "";
		switch ($mes){
			case "01": $letrames = "ENERO";  break;
			case "02": $letrames = "FEBRERO"; break;
			case "03": $letrames = "MARZO";  break;
			case "04": $letrames = "ABRIL";  break;
			case "05": $letrames = "MAYO";  break;
			case "06": $letrames = "JUNIO";  break;
			case "07": $letrames = "JULIO";  break;
			case "08": $letrames = "AGOSTO";  break;
			case "09": $letrames = "SETIEMBRE";  break;
			case "10": $letrames = "OCTUBRE";  break;
			case "11": $letrames = "NOVIEMBRE";  break;
			case "12": $letrames = "DICIEMBRE";  break;
		}
		return $letrames;
	}

	public function check_Fechas($start_date, $end_date ) {
    	$start_ts = strtotime($start_date);
    	$end_ts = strtotime($end_date);
    	if($start_ts > $end_ts){
    		return "La Fecha de Inicio es Mayor a la Fecha Final";
    	}
    	else {
			return "true";
    	}
	}

	public function check_Horas($start_date, $end_date ) {
    	$start_ts = strtotime($start_date);
    	$end_ts = strtotime($end_date);
    	if($start_ts > $end_ts){
    		return "La Hora de Inicio es Mayor a la Hora Final";
    	}
    	else {
			return "true";
    	}
	}


}
?>
