<?php 
include_once('class/CompoJquery.php'); 
$obj_vista = new cls_funciones ;
$ArrayCentos = $obj_vista->f_ListaCentros();
$objQ_vista = new cls_Jquerys;       
?>
<script type="text/javascript">
$(document).ready(function () {
	 var theme = 'energyblue';
   $("#PopupWindowInspe").jqxWindow({ width: 470, height: '45%', resizable: false,  theme: theme,  isModal: true,  autoOpen: false,  modalOpacity: 0.5  }); 
  $("#BtnNewInspector").click(function (){  
   $("#PopupWindowInspe").jqxWindow('show'); 
   });
});
</script>
<script type="text/javascript" src="js/inp20131213_01.js"></script>  
<div class="titulo">Lista de Inspector o Tec.Salud Ambiental  </div>
<div class="barrabones"> 
  <input type="button" id="BtnNewInspector" name="BtnNewInspector" value="Nuevo" />
  <input type="button" id="BtnRefleshInspector" name="BtnRefleshInspector" value="Actualizar" />
</div>


<?php $acttoken = md5( uniqid( rand(),true )); $_SESSION['acttoken'] = $acttoken ;?><input type="hidden" id="acttoken" name="acttoken" value="<?php echo $acttoken ?>" /> 
<div id="PopupWindowInspe"><div>Vista Previa </div>
<div style="overflow: hidden;">
<center><b> Nuevo de Inpector </b></center>
<div style="overflow:scroll; height:95%"> 
<div class="contfor">
<form>
<table class="tbsis" >
<tr><td width="106" >Nombre :  </td><td width="350"><input type="text" name="nombre_new" id="nombre_new" size="45" maxlength='100'/></td></tr>
<tr><td>Centro : </td><td><select id="CS_new" name="CS_new" ><?php foreach($ArrayCentos as $valor) { echo "<option value='$valor[0]'>$valor[1]</option>"; } ?></select></td></tr>
<tr><td colspan='2'><div class="barrabones"> <input type="button" id="BtnSaveInspector" name="BtnSaveInspector" value=" Grabar " /> </div></td></tr>
</table>             
</form> 
</div>
<div id="idmensaje1"></div>
</div> 
</div>
</div> 