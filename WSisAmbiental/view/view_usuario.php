<?php 
include_once('class/CompoJquery.php'); 
$obj_vista = new cls_funciones ;
$ArrayNiveles= $obj_vista->f_ListaNiveles();
$objQ_vista = new cls_Jquerys;       
?>
<script type="text/javascript">
$(document).ready(function () {
  var theme = 'energyblue';
  var source1 = { datatype: "json", datafields: [ { name: 'nro'}, { name: 'use_id'}, { name: 'pdp'}, { name: 'use_name'}, { name: 'Cod_nvl'}, { name: 'nivel'},{ name: 'codsta'},{ name: 'estado'}, ], url: 'class/json.php?type=1' };
  var dataAdapter = new $.jqx.dataAdapter(source1); <?php  echo $objQ_vista->PaginacionGrid('jqxgrid'); ?>
  $("#jqxgrid").jqxGrid({ theme: theme, source: source1, columnsresize: true, width: 1020, pageable: true, pagerrenderer: pagerrenderer,  pagesize: 800, height: 300, showfilterrow: true, filterable: true,
    columns: [
      { text: 'Nro', datafield: 'nro', width: 30 }, { text: 'Usuario', datafield: 'use_id', width: 140 }, { text: 'Nombre', datafield: 'use_name', width: 300 }, { text: 'Clave', datafield: 'pdp', width: 170 },  { text: 'Modulo', datafield: 'nivel', width: 150 }, { text: 'estado', datafield: 'estado', width: 80 }, { text: 'Editar', columntype: 'button', width: 60 , cellsrenderer: function () { return "Editar"; }, buttonclick: EventoDetalle },{ text: 'Eliminar', columntype: 'button', width: 70 , cellsrenderer: function () { return "Eliminar"; }, buttonclick: EventoEliminar },              
    ]
  });
  $("#BtnRefleshUser").click(function (){ $("#jqxgrid").jqxGrid('updatebounddata'); });
  $("#PopupWindowUser").jqxWindow({ width: 470, height: '55%', resizable: false,  theme: theme,  isModal: true,  autoOpen: false,  modalOpacity: 0.5  }); 
  $("#BtnNewUser").click(function (){ $(".contfor").removeClass('closes'); $('#idmensaje1').removeClass("exito alerta").html(''); limpia(); $("#PopupWindowUser").jqxWindow('show'); });
  $('#PopupWindowUser').on('close', function (event){ $("#jqxgrid").jqxGrid('updatebounddata'); }); 
});       
function EventoDetalle (row) {
  var indice = row; var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', indice);
   
   limpia(); $("#PopupWindowUser").jqxWindow('show');
}
function EventoEliminar (row) {
  var indice = row; var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', indice);
  if(confirm("Desea Eliminar el Siguiente Registro de la Base de Datos ")) {
    $.post("class/ControllerUser.php",{ id : dataRecord.use_id ,typec : '2', token : $('#acttoken').val(),  rand:Math.random() } ,                
      function(data){
        if(data.indexOf("[:D") >= 0){
          //document.location = data.trim(); 
          $(ido).removeAttr("disabled"); $(ido).val(texto);
          limpia(); $(".contfor").addClass("closes");
          $('#idmensaje1').addClass("exito").html(data.trim());
        }else{    
          $(ido).removeAttr("disabled"); $(ido).val(texto);
          $('#idmensaje1').addClass("alerta").html(data.trim()); return;
        }    
    });
  }
}


</script>
<script type="text/javascript" src="js/us20131213_01.js"></script>  
<div class="titulo">Lista de Usuario  </div>
<div class="barrabones"> 
  <input type="button" id="BtnNewUser" name="BtnNewUser" value="Nuevo" />
  <input type="button" id="BtnRefleshUser" name="BtnRefleshUser" value="Actualizar" />
</div>

<div id="jqxgrid"></div> <?php $acttoken = md5( uniqid( rand(),true )); $_SESSION['acttoken'] = $acttoken ;?><input type="hidden" id="acttoken" name="acttoken" value="<?php echo $acttoken ?>" /> 
<div id="PopupWindowUser"><div>Vista Previa </div>
<div style="overflow: hidden;">
<center><b> Nuevo de Usuarios </b></center>
<div style="overflow:scroll; height:95%"> 
<div class="contfor">
<form>
<table class="tbsis" >
<tr><td width="106" >Nombre :  </td><td width="350"><input type="text" name="nombre_new" id="nombre_new" size="45" maxlength='100'/></td></tr>
<tr><td>Modulo : </td><td><select id="permiso_new" name="permiso_new" ><?php foreach($ArrayNiveles as $valor) { echo "<option value='$valor[0]'>$valor[1]</option>"; } ?></select></td></tr>
<tr><td>Usuario : </td><td><input name="log_new"  type="text" id="log_new"  size="20" maxlength='19'   /></td></tr>
<tr><td>Clave : </td><td><input name="pwd_new"  type="password" id="pwd_new"  size="20" maxlength='15'  /> max(15 Caracteres)</td></tr>
<tr><td colspan='2'><div class="barrabones"> <input type="button" id="BtnSaveUser" name="BtnSaveUser" value=" Grabar " /> </div></td></tr>
</table>             
</form> 
</div>
<div id="idmensaje1"></div>
</div> 
</div>
</div> 


