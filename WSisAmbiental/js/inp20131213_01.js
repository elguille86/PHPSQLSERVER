$(document).ready(function () {

	$('#BtnSaveInspector').click(function() {
		texto = $(this).val(); $(this).val("Validando....."); $(this).attr('disabled','disabled');
		var ido = "#"+$(this).attr('id');
		$('#idmensaje1').removeClass("exito alerta").html('');
 
        $.post("class/ControllerInps.class.php",{ nombres : $('#nombre_new').val(), cent : $('#CS_new').val(), token : $('#acttoken').val(), typec : '1', rand:Math.random() } ,                
          function(data){ 
			  
			  if(data.indexOf("php") >= 0){
				document.location = data.trim(); 
			  }else{		
			  $(ido).removeAttr("disabled"); $(ido).val(texto);
              $('#idmensaje1').addClass("alerta").html(data.trim()); return;
			  } 
			 
        });
	}); 
}); 	
function limpia(){$('#nombre_new').val(''); $('#CS_new').get(0).selectedIndex = 0;}