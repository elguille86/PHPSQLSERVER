$(document).ready(function () {

	$('#BtnSaveUser').click(function() {
		texto = $(this).val(); $(this).val("Validando....."); $(this).attr('disabled','disabled');
		var ido = "#"+$(this).attr('id');
		$('#idmensaje1').removeClass("exito alerta").html('');
		//$(this).removeAttr("disabled"); 
        $.post("class/ControllerUser.class.php",{ nombres : $('#nombre_new').val(), nivel : $('#permiso_new').val(), id : $('#log_new').val(), pdw : $('#pwd_new').val(), token : $('#acttoken').val(), typec : '1', rand:Math.random() } ,                
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
	}); 
}); 	
function limpia(){$('#nombre_new').val('');$('#pwd_new').val('');$('#log_new').val('');$('#permiso_new').get(0).selectedIndex = 0;}