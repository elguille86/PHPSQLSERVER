<?php session_start(); 
if(isset($_SESSION['id_sisambiental'])){ 
	session_destroy();
}
?>
<!DOCTYPE html> <html lang="es"> <head> <title>:: Login de Sistema::</title> <meta charset="utf-8"> <meta name="Copyright" content="DIRESA ;GUILLERMO RODRIGUEZ;Copyright 2012 Lima-Peru" /><link rel="stylesheet" href="css/stilo.css" type="text/css"   /><link rel="stylesheet" href="css/mensajes.css" type="text/css"   /> <link type="image/x-icon" href="favicon.ico" rel="icon" /><link type="image/x-icon" href="favicon.ico" rel="shortcut icon" /><script src="js/jquery-1.8.3.min.js" type="text/javascript"></script><script src="js/include_login.js"  type="text/javascript"></script> </head> <body>
<?php $token = md5( uniqid( rand(),true )); $_SESSION['token'] = $token ; ?>
<div id="pres_contenido">
	<div id="pres_cabecera"><div id="mi"></div><div id="md"></div><div id="simi"></div><div id="logo"></div></div>
	<div id="pres_manager">
    	<div id="pres_body">
        	<div id="pres_contenidos">
			<form name="login_form" id="login_form" method="post" onSubmit="return false;">
            	<table width="100%" cellpadding="1" cellspacing="2" border="0">                	
                    <tr>
                    	<td width="30%"><label class="lal">Usuario : </label></td>
                        <td width="70%"><input id="user" name="user" type="text" placeholder="Usuario"  maxlength='19' onKeyUp="this.value=this.value.toUpperCase()"  /></td>
                    </tr>
                    <tr>
                    	<td><label class="lal">Contrase&ntilde;a : </label></td>
                        <td><input id="password" name="password" type="password"  placeholder="Clave" maxlength='19'  /></td>
                    </tr>
                    <tr>
                    	<td colspan="2"><div id="Adicional_Sistema" style=" display:block; width:100%"></div></td>
                    </tr>
					<tr>
						<td>	
                            <input name="login" type="submit"  id="login" onClick="validaIngreso()" value="Ingresar"/>
                            <input id="token" name="token" type="hidden" value="<?php echo $token;?>" />   
                        </td>
                        <td align="right">
	                        <input name="endseccion" type="submit"  id="endseccion" onclick="location.href='salir.php';" value="Cerrar"/>
                        </td>
                    </tr>
					<tr>
						<td colspan="2" height="40"><div id="msgbox" ></div> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td colspan="2"> </td></tr>
                </table>
		</form>				
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    <div id="pie"><div id="der"></div> <div id="izq"></div></div>
</div>
<div id="pres_footer"> <div id="tizq">Copyright &copy; Todos los Derechos Reservados - 2013</div>  <div id="tder">DIRESA CALLAO</div> <div id="tder">Lima - Per&uacute;</div></div>
</body></html>