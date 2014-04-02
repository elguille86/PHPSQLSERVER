<?php session_start(); 
include_once('class/Controller.class.php');
	$ob = new cls_funciones;
	$re = $ob->f_exite_user($_SESSION['id_sisambiental']);
	$respuesta ='';
 	foreach ($re as $valor) {
        $respuesta =  $valor[cant];
		$usuario =  $valor[use_name];
    }	
	if(!isset($respuesta )  || $respuesta == '0'  ){ 
		session_destroy(); header("Location: ".$ob->mi_hosting() );
	} 
?> 
<!DOCTYPE html>
<html lang="es"> 
<head>
<meta charset='utf-8' /> <meta name='author' content='Guillermo Rodriguez' /><title>:: Login de Sistema::</title><meta name="Copyright" content="DIRESA ;GUILLERMO RODRIGUEZ;Copyright 2012 Lima-Peru" /><link rel="stylesheet" href="css/styles.css" type="text/css"   /><link type="image/x-icon" href="favicon.ico" rel="icon" /><link type="image/x-icon" href="favicon.ico" rel="shortcut icon" ><link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" /><link rel="stylesheet" href="jqwidgets/styles/jqx.energyblue.css" type="text/css" /><link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.css" type="text/css" /><script type="text/javascript" src="js/html5.js"></script><script type="text/javascript" src="js/modernizr-latest.js"></script><script type="text/javascript" src="js/jquery-1.8.3.min.js"></script><script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script><script type="text/javascript" src="jqwidgets/jqxcore.js"></script><script type="text/javascript" src="jqwidgets/jqxdata.js"></script> <script type="text/javascript" src="jqwidgets/jqxbuttons.js"></script><script type="text/javascript" src="jqwidgets/jqxscrollbar.js"></script><script type="text/javascript" src="jqwidgets/jqxmenu.js"></script> <script type="text/javascript" src="jqwidgets/jqxpanel.js"></script><script type="text/javascript" src="jqwidgets/jqxtree.js"></script><script type="text/javascript" src="jqwidgets/jqxexpander.js"></script><script type="text/javascript" src="jqwidgets/jqxgrid.js"></script><script type="text/javascript" src="jqwidgets/jqxgrid.selection.js"></script> <script type="text/javascript" src="jqwidgets/jqxgrid.columnsresize.js"></script><script type="text/javascript" src="jqwidgets/jqxgrid.pager.js"></script> <script type="text/javascript" src="jqwidgets/jqxdropdownlist.js"></script><script type="text/javascript" src="jqwidgets/jqxlistbox.js"></script><script type="text/javascript" src="jqwidgets/jqxgrid.filter.js"></script><script type="text/javascript" src="jqwidgets/jqxwindow.js"></script><script type="text/javascript" src="js/gettheme.js"></script>  
</head>
<?php
    require_once("class/class.principal.php");
    $usu_id=$_SESSION['id_sisambiental']; 
    $obj_funciones = new cls_funciones ;
    $result= $obj_funciones->f_Menu_Sistema($usu_id);
    foreach ($result as $valor) {
        $menuvalores[] = array(
            'id' => utf8_encode($valor[0]),
            'parentid' => utf8_encode($valor[1]),
            'text' => utf8_encode($valor[2]),
            'href' => utf8_encode($valor[3]),
            'icon' => utf8_encode($valor[4])
        );    
    }
?>
<script type="text/javascript">
$(document).ready(function () { var theme = 'energyblue'; var source = { datatype: "json", datafields: [ { name: 'id' },{ name: 'parentid' },{ name: 'text' },{ name: 'href' },{ name: 'icon' } ],id: 'id', localdata: <?php  echo json_encode($menuvalores ); ?> }; var dataAdapter = new $.jqx.dataAdapter(source); dataAdapter.dataBind(); var records = dataAdapter.getRecordsHierarchy(  'id', 'parentid', 'items', [{ name: 'text', map: 'label'  }] ); $('#jqxMenu').jqxMenu({ source: records, height: 30, theme: theme, width: '99.8%' }); $("#jqxMenu").on('itemclick', function (event) { href = dataAdapter.recordids[event.args.id].href;
        if (href!=undefined) document.location = '?opm='+href; 
    }); 
});
</script>
</head>
<body>
<header> <img src="images/front/logo.png" width="62" height="59" id="logdir"  align="middle" style="float: left;" /><div class="ClsSup" > Bienvenido al Sistema de Registro Ambientales  <br> <div style="float: left; width:50%;"> <?php  echo "Usuario : ".$usuario;  ?> </div> <div style="float: left; width:50%; text-align: right;"><a href="salir.php" title="Salir del Sistema" >[ Salir ]</a></div> </div></header><div id='content'><div id='jqxMenu' ></div></div><div id="contesyste"> <?php new cls_principal; ?></div> <div style="display:none">http://www.jqwidgets.com/license/</div><footer> Copyright © Todos los Derechos Reservados - 2013 <br/> Direcci&oacute;n Regional de Salud del Callao<br/> Oficina de Inform&aacute;tica, Telecomunicaciones y Estad&iacute;stica<br/> Unidad de Informatica<br/> Lima - Perú <br/> Desarrollado por : <a href="mailto:g.rodriguez.p@hotmail.com"> Guillermo Rodriguez Pineda</a><br/><br/> </footer> </body></html>