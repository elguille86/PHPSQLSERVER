$(document).ready(function(){
	$("#user").focus(); $("#login_form").submit(function(){
		$("#msgbox").removeClass().addClass('messagebox').text('Validado....').fadeIn(1000);
		$.post("class/ajax_login.php",{ user_name:$('#user').val(),password:$('#password').val(),token:$('#token').val(),rand:Math.random() } ,function(data){
		String.prototype.trim = function() { return this.replace(/^\s*|\s*$/g, ''); }
		var resp = data.trim(); if(resp.indexOf("php") >= 0) {$("#msgbox").fadeTo(200,0.1,function(){  $(this).html('Conectandose ....').addClass('messageboxok').fadeTo(900,1, function(){ document.location = resp; }); });  }else { $("#msgbox").fadeTo(200,0.1,function(){  $(this).html(resp).addClass('messageboxerror').fadeTo(900,1); }); }
        }); return false; 
	}); $("#password").blur(function() { $("#login_form").trigger('submit'); });
});
