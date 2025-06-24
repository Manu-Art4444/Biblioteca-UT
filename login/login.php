<?php 
//se manda llamar la conexion
include("../conexion/conexion.php");

//  
// $consulta=$conexion->query("SELECT 
//                         btn_asp
//                    FROM configuracion
//                     LIMIT 1") or die (mysqli_error());
// //Descargamos el arreglo que arroja la consulta
// $row=mysqli_fetch_row($consulta);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar Sesión</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome-5/css/all.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Propio style -->
    <link rel="stylesheet" href="css/AdminLTE.css">
    <link rel="stylesheet" href="css/estilos.css">

    <!-- ACCIONES MODALES -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f39c12"/>
    <meta property="og:url"           content="https://uclam.online/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="UCLAM ONLINE" />
    <meta property="og:description"   content="Preparatoria UCLAM ONLINE." />
    <meta property="og:image" content="https://uclam.online/colbach/images/logo.jpg" />

    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="./colbach/images/logo.jpg">
    <link rel="apple-touch-startup-image" href="./colbach/images/logo.jpg">
    <link rel="manifest" href="./colbach/manifest.json">
  
    <!-- Scroll Menu -->
    <link href="../plugins/sweetalert2-master/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../plugins/alertifyjs/css/alertify.min.css" rel="stylesheet">
    <link href="../plugins/alertifyjs/css/themes/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="../plugins/hover-master/css/hover-min.css" rel="stylesheet">
    <style>
    	.register-page, .login-page {
			  background: #00652E;
			}
			.footer {
		    padding-top: 65px;
		    border-top: none;
			}
			.bordeLogin {
    border-color: #00652E;
  }
    </style>	
  </style>
  </head>
  <body class="hold-transition login-page" >
  	<div class="content-wrapper hidden">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Iniciar sesión
        </h1></section></div>

	<div class="img-bckg">
    
	    <div class="login-box" >
	    	<center><h1 style="font-weight: bold;">Biblioteca UT</h1></center>
			<!-- <img src="../images/logo.png" class="img-responsive avatar"> -->
			<div class="login-box-body bordeLogin ">
			    <div><p class="titulo-login"></p></div>
			    <!-- INICIO DE SESIóN -->
				<form id="frmLogin" hidden action="verificar_login.php" method="post">
				  <div class="form-group logoActivo">
				  	<!-- <div class="input-group"> -->
				    	
				    	<input type="usuario" id="usuario" class="form-control no-espacios" placeholder="Usuario" required>
                      	<!-- <span class="input-group-addon">@uclam.mx</span>
                      	<span class="input-group-addon">
                      		<span id="iUser" class="glyphicon glyphicon-user"></span>
                      	</span> -->
                    <!-- </div> -->
				  </div>
				  <div class="form-group">

				  	<!-- <div class="input-group"> -->
				    <input type="password" id="contra1" class="form-control" placeholder="Contraseña" required>
                      	<!-- <span class="input-group-addon">
                      		<span id="iUser" class="glyphicon glyphicon-lock"></span>
                      	</span>
                      </div> -->
				  </div>
				  <div class="row">
				    <div class="col-sm-8 col-xs-12 hidden">
				      <div class="checkbox m-0">
				        <label>
				          <input id="cambio" data-toggle="toggle" type="checkbox" data-on="Si" data-off="No" data-onstyle="primary">
				          <label style="padding: 0px;" onclick="toogleCheck();">Cambiar contraseña</label>
				        </label>
				      </div>
				    </div>
				    <div class="col-xs-12">
				      <center><button id="btnLogin" type="submit" class="btn btn-success hvr-icon-grow">Ingresar &nbsp;&nbsp;<i class="fas fa-sign-in-alt hvr-icon"></i></button></center>
				    </div>
				  </div>
				</form>

				<!-- CAMBIO DE CONTRA -->
				<form id="frmCambio" hidden action="actualizar.php" method="post">
		          <div class="form-group has-feedback logoActivo">
		            <input type="password" id="pass" class="form-control" placeholder="Colocar la contraseña" required data-toggle="tooltip" data-placement="bottom" title="Ingresa una contraseña diferente a la actual">
		            <input type="hidden" id="claveid" class="form-control">
		            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		          </div>
		          <div class="form-group has-feedback">
		            <input type="password" id="repass" class="form-control" placeholder="Verificar la contraseña" required>
		            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		          </div>
		          <div class="row">
		            <div class="col-xs-12 col-sm-4">
		              <a id="btnRegresar" class="btn btn-danger btn-block btn-flat hvr-icon-grow" onclick="verLogin();"><i class="fas fa-arrow-left hvr-icon" aria-hidden="true"></i> &nbsp;&nbsp;Cancelar</a>
		            </div>
		            <div class="col-xs-12 col-sm-4">
		              <a id="btnContinuar" class="btn btn-primary btn-block btn-flat hvr-icon-grow" onclick="window.location.replace('../inicio/');">Omitir &nbsp;&nbsp;<i class="fas fa-angle-double-right hvr-icon" aria-hidden="true"></i></a>
		            </div>
		            <div class="col-xs-12 col-sm-4">
		              <button type="submit" id="btnActualizar" class="btn btn-success btn-block btn-flat hvr-icon-grow">Actualizar &nbsp;&nbsp;<i class="fa fa-sign-in-alt hvr-icon"></i></button>
		            </div>
		          </div>
		        </form>

			</div><!-- /.login-box-body -->
	    </div><!-- /.login-box -->

	</div> <!-- img-bckg -->

	<div class="footer">
		
		<!-- <div class="row login-box">
	            <div class="col-xs-3 ">
	              <div class="login-logo">
	                <a target="_blank" href="http://itlinares.edu.mx/">
	                    <img src="../images/tec.png" class="img-responsive logox anima" title="Instituto Tecnológico de Linares">
	                 </a>
	              </div>
	            </div>
	             <div class="col-xs-3 ">
	            <div class="login-logo">
	                <a target="_blank" href="http://teclinares.edu.mx/moodle/">
	                    <img src="../images/moodle.png" class="img-responsive logox anima" title="Educación a Distancia">
	                 </a>
	              </div>
	            </div>       
	            <div class="col-xs-3 ">
	            <div class="login-logo">
	                <a target="_blank" href="http://itlinares.edu.mx/sgcitl/">
	                    <img src="../images/gestor.png" class="img-responsive logox anima" title="Sistemas de Descarga de Archivos del SGC">
	                 </a>
	              </div>
	            </div>
	            <div class="col-xs-3 ">
	            <div class="login-logo">
	                <a target="_blank" href="http://mail.tecnm.mx">
	                    <img src="../images/correo.png" class="img-responsive logox anima" title="Mail TECNM">
	                 </a>
	              </div>
	            </div>
	          </div> -->

				<div class="mAsp hidden">
					<h3 style="color:black">¿Eres nuevo? Haz tu pre-registro dando clic sobre el botón&nbsp; <i class="fa fa-hand-point-down"></i></h3>
					<a href="../mAlumnos/registro_inicial.php" style="font-size: 30px" class="btn btn-default btn-lg hvr-icon-grow"><i class="fas fa-users hvr-icon"></i> &nbsp; PRE-REGISTRO - UCLAM ONLINE</a><br>
					<a href="../paAlumnos/registro_inicial.php" style="font-size: 30px" class="btn btn-default btn-lg hvr-icon-grow hidden"><i class="fas fa-users hvr-icon"></i> &nbsp; PRE-REGISTRO - PREPA ABIERTA</a><br>


					<?php if ((date('w')==0&&time()>=strtotime("09:00:00")&&time()<=strtotime("15:00:00"))|| (date('w')!=0&&time()>=strtotime("09:00:00")&&time()<=strtotime("19:00:00")) ): ?>
						<h4 style="color:black; display: inline;">Contáctanos para cualquier duda o aclaración: &nbsp;</h4>
						<button onclick="mandarWapp()" class="btn btn-success btn-lg hvr-icon-grow"><i class="fab fa-whatsapp hvr-icon"></i> &nbsp; WHATSAPP</button>
					<?php endif ?>
				</div>


	    <!-- <hr class="hr-footer"> -->
		<div class="text-footer">
			<p>UNIVERSIDAD TECNOLÓGICA DE LINARES</p>
		</div>
	</div>

<div id="mFirefox" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title" style="font-weight: bold">ATENCIÓN</h3>
      </div>
      <div class="modal-body" style="font-size: 18px">
      	<center><img src="https://www.mozilla.org/media/protocol/img/logos/firefox/browser/logo-word-hor-xs.c87882e8c93c.png" alt=""></center><br>
        <p>Para una mejor experiencia, se recomienda el uso del navegador Mozilla Firefox. <a href="https://www.mozilla.org/es-MX/firefox/new/" target="_blank">Visitar página oficial de Firefox</a>.</p>
        <p>En caso de utilizar Google Chrome u otro navegador, se recomienda utilizar el modo incógnito (o pestaña privada) para mejor compatibilidad.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>

  </div>
</div>

<!-- SCRIPTS -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Custom functions file -->
    <script src="../plugins/alertaModal/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="../plugins/sweetalert2-master/dist/sweetalert2.min.js"></script>
    <script src="../plugins/alertifyjs/alertify.min.js"></script>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="js/funciones.js?v=2"></script>

    <script>
    	<?php 
    	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		    $agent = $_SERVER['HTTP_USER_AGENT'];
		}

		if (strlen(strstr($agent, 'Firefox')) > 0) {
		    $browser = 'firefox';
		}

		if ($browser!="firefox") {?>
			// $("#mFirefox").modal("show");
<?php	}

 ?>
 function mandarWapp(){
 	$.ajax({
 	    url: "../global/obtenerNumeroContacto.php",
 	    type: "POST",
 	    dataType : 'json',
 	    encode : true,
 	    data: {},
 	    success: function(data){
 	        window.open("https://api.whatsapp.com/send?phone=52"+data.telefono,"_blank");
 	    },
 	    error: function(xhr, status){
 	        swal("Ocurrió un error", "Vuelve a internarlo para asignarte un asesor...", "warning");
 	    }
 	});
 }


document.title = 'Iniciar sesión | Biblioteca UT';

    </script>

  </body>
</html>