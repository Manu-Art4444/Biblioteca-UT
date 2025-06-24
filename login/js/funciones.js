function toogleCheck(){
	$('#cambio').bootstrapToggle('toggle');
}
$(function() {
	verLogin();
  	$('[data-toggle="tooltip"]').tooltip({trigger:"manual"});
});
$("#frmLogin").on("submit", function(event){
	event.preventDefault();
	var usuario = $("#usuario").val();
	var contra1 = $("#contra1").val();
	var cambio  = $("#cambio").prop('checked');
	$.ajax({
		url: "verificar_login.php",
		type: "POST",
		dataType : 'json',
		encode : true,
		data: {usuario:usuario,contra1:contra1,cambio:cambio},
		success: function(data){
			switch (data[0].res){
				case "correcto":
					window.location.replace("../inicio/");
				break;
				case "regs":
					$("#usuario").val(data[0].user);
					$("#contra1").val("12345");
					$("#frmLogin").trigger("submit");
				break;
				case "error":
					$("#contra1").val("");
					 alertify.message('<i class="fas fa-user-times"></i> Usuario o contraseña incorrectos');
					$("#contra1").focus();
					// swal("Error de Autentificación", "Por favor verifica tu nombre de usuario y contraseña, e intentalo de nuevo.");
				break;
				case "errorperfil":
					$("#contra1").val("");
					swal("Error en el perfil de usuario", "El perfil al que tu cuenta de usuario esta vinculado, no existe o por el momento se encuentra desahabilitado, favor de intentarlo mas tarde.");
				break;
				case "pvez":
					verCambio(data[0].val);
					$("#btnContinuar").hide();
					swal("Cambio de Contraseña", "Por seguridad, es necesario que cambies la contraseña otorgada por el administrador, se recomienda utilizar la contraseña de tu correo de UCLAM (@uclam.mx).");				break;
				case "cambio":
					$("#btnContinuar").show();
					verCambio(data[0].val);
					break;
				default:
					 alertify.message('<i class="fas fa-exclamation-triangle"></i> Ha ocurrido un error');
				break;
			}
		},
		error: function(xhr, status){
			swal("Error de llamada AJAX 1", xhr.responseText, "error");
		}
	});
});
$("#frmCambio").on("submit", function(event){
	event.preventDefault();
	var claveid = $("#claveid").val();
	var pass    = $("#pass").val();
	$.ajax({
		url: "actualizar.php",
		type: "POST",
		dataType : 'html',
		data: {claveid:claveid,pass:pass},
		success: function(data){
			window.location.replace("../inicio/");
		},
		error: function(xhr, status){
			swal("Error de llamada AJAX 2", xhr.responseText, "error");
		}
	});
});
function verLogin(){
	destroySesion();
	$("#iUser").removeClass("iSuccess");
	$("#iUser").removeClass("iDanger");
	$('#lblTitulo').html("INICIO DE SESIÓN");
	$('#frmCambio').hide();
	$('#frmLogin').show();
	$('#usuario').val("");
	$('#contra1').val("");
	$('#cambio').prop("disabled", false);
	$('#cambio').parent().removeClass("disabled");
	$('#cambio').bootstrapToggle('off');
	$("#btnLogin").prop("disabled", true);
	$("#usuario").focus();
}
function verCambio(s_clave){
	$('#lblTitulo').html("CAMBIO DE CONTRASEÑA");
	$('#frmLogin').hide();
	$('#frmCambio').show();
	$('#claveid').val(s_clave);
	$('#pass').val("");
	$('#repass').val("");
	$("#btnActualizar").prop('disabled', true);
	$("#pass").css({"background":"rgba(255, 255, 255, 1)" });
	$("#repass").css({"background":"rgba(255, 255, 255, 1)" });
	$('#pass').tooltip('hide');
	$("#pass").focus();
}

var valido=false;
$("#repass, #pass").on("keyup", function(e) {
    var pass = $("#pass").val();
    var re_pass=$("#repass").val();
    $("#repass").css({"background":"rgba(255, 255, 255, 1)" });
	$("#pass").css({"background":"rgba(255, 255, 255, 1)" });

    if (pass.trim() == "" || re_pass.trim() == "") {
        $("#btnActualizar").prop('disabled', true);
		$('#pass').tooltip('hide');
    }else{
        if(pass != re_pass)
        {
            $("#repass").css({"background":"rgba(192, 57, 43,.2)" }); //El input se pone rojo
            $("#btnActualizar").prop('disabled', true);
            $('#pass').tooltip('hide');
        }
        else if(pass == re_pass)
        {
            $("#repass").css({"background":"rgba(39, 174, 96,.2)"}); //El input se ponen verde
            //REVISAR CONTRASEÑA DIFERENTE ACTUAL
    		var claveid=$("#claveid").val();
            $.ajax({
				url: "passDif.php",
				type: "POST",
				dataType : 'html',
				data: {claveid:claveid,pass:pass},
				success: function(data){
					if (data.trim() == "0") {
            			$('#pass').tooltip('hide');
						$("#btnActualizar").prop('disabled', false);
					}else{
            			$("#pass").css({"background":"rgba(192, 57, 43,.2)" });
            			$("#repass").css({"background":"rgba(192, 57, 43,.2)" });
            			$("#repass").val("");
						$("#btnActualizar").prop('disabled', true);
            			$('#pass').tooltip('show');
            			$("#pass").focus();
					}
				},
				error: function(xhr, status){
					swal("Error de llamada AJAX 3", xhr.responseText, "error");
				}
			});
        }
    }

});//fin keyup repass

$("#usuario, #contra1").on("keyup input", function(e) {
	var usuario = $("#usuario").val();
	var contra1 =$("#contra1").val();

    if (usuario.trim() != "") {
        $.ajax({
			url: "chekUser.php",
			type: "POST",
			dataType : 'html',
			data: {usuario:usuario},
			success: function(data){
				console.log(data);
				// VERIFICAR QUE EXISTA EL USUARIO ESCRITO
				if (data.trim() == "0") {
					$("#iUser").removeClass("iSuccess");
					// $("#iUser").addClass("iDanger");
				}else{
					// $("#iUser").removeClass("iDanger");
					$("#iUser").addClass("iSuccess");
				}

				// EN CASO DE QUE SEA LA PRIMERA VEZ ACTIVAR TOGGLE
				if (data.trim() == "2") {
					$('#cambio').bootstrapToggle('on');
					$('#cambio').prop("disabled", true);
					$('#cambio').parent().addClass("disabled");
				}else{
					$('#cambio').prop("disabled", false);
					$('#cambio').parent().removeClass("disabled");
				}
			},
			error: function(xhr, status){
				swal("Error de llamada AJAX 4", xhr.responseText, "error");
			}
		});

    	if (contra1.trim() != "") {
	    	$("#btnLogin").prop("disabled", false);
	    }else{
	    	$("#btnLogin").prop("disabled", true);
	    }
    }else{
		$("#iUser").removeClass("iSuccess");
		$("#iUser").removeClass("iDanger");
		$('#cambio').prop("disabled", false);
		$('#cambio').parent().removeClass("disabled");
		$('#cambio').bootstrapToggle('off');
    	$("#btnLogin").prop("disabled", true);
    }

});

function destroySesion(){
	$.ajax({
		url: "../sesiones/cerrarsesion.php",
		type: "POST",
		dataType : 'html',
		data: {},
		success: function(data){
		},
		error: function(xhr, status){
			swal("Error de llamada AJAX 5", xhr.responseText, "error");
		}
	});
}
$( "input.no-espacios" ).each(function( index ) {
  $(this).on({
	  keydown: function(e) {
	    if (e.which === 32)
	      return false;
	  },
	  change: function() {
	    this.value = this.value.replace(/\s/g, "");
	  },
	  input: function() {
	    this.value = this.value.replace(/\s/g, "");
	  }
	});
});
$( "#usuario" ).each(function( index ) {
  	$(this).on({
	  keydown: function(e) {
	  	var value = String.fromCharCode(e.keyCode);
	    if (value.match(/[a-zA-Z0-9]/gi) || (e.which >= 37 && e.which <= 40) || e.which === 13  || e.which === 8 || e.which === 9 || e.which === 32 || e.which === 190 || (e.keyCode >= 96 && e.keyCode <= 105))
	      	return true;
	  	else
	  		return false;
	  },
	  change: function() {
	    this.value = this.value.replace("@uclam.mx", "");
	    this.value = this.value.replace(/[^a-zA-Z0-9.]/gi, "");
	  },
	  input: function(){
	    this.value = this.value.replace("@uclam.mx", "");
	    this.value = this.value.replace(/[^a-zA-Z0-9.]/gi, "");
	  }
	});
});
//AL DAR ENTER
$("#usuario").on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13 && $("#iUser").hasClass("iSuccess")) { 
   	 $("#contra1").focus();
  }
});
$("#contra1").on('keyup', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13 && $(this).val()) {
   	 $("#frmLogin").submit();
  }
});