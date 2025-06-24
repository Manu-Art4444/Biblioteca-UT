<?php 
//se manda llamar la conexion
include'../conexion/conexion.php';
//verifico inicio de sesion
include'../sesiones/verificar_sesion.php';
//cargo variables de sesion
include'../sesiones/variables_sesion.php';
include"combos.php";

//Cambio de piel del sistema
$skin="skin-".$sSkin;
$opa="B";
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Biblioteca UT</title>

    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome-5/css/all.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="../dist/css/estilos.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/<?php echo $skin; ?>.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Daterange picker -->
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.css">
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../plugins/bootstrap-toggle/bootstrap-toggle.min.css">
    <!-- ACCIONES MODALES -->
  
    <!-- Scroll Menu -->
    <link href="../plugins/alertaModal/css/sweetalert.css" rel="stylesheet">
    <link href="../plugins/alertifyjs/css/alertify.min.css" rel="stylesheet">
    <link href="../plugins/alertifyjs/css/themes/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Custom functions file -->
    <script src="../plugins/alertaModal/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="../plugins/alertaModal/js/sweetalert.min.js"></script>
    <!-- ACCIONES MODALES -->
  </head>
  <body class="hold-transition <?php echo $skin; ?> sidebar-mini" onload="hvFInpS('#frmAlta', '#btnSubAlta');">
    <div class="wrapper">

      <header class="main-header">
      <?php include"verificacion.php";?>
        <?php  include("../plantilla/headers.php");?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <?php  include("../plantilla/users.php");?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <!-- <li class="header">Opciónes del módulo</li> -->
      <?php 
       include("menu.php");
       include("../plantilla/vertical.php");
       ?>
      </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Registro de libros
            <small class="hidden">Catálogo</small>
          </h1>
          <ol class="breadcrumb hidden">
            <li><a href="../inicio/index.php"><i class="fas fa-dashboard"></i> Panel de control</a></li>
            <li class="active">Catálogo</li>
          </ol>
        </section>

        <!-- Main content -->
       <section class="content">

        <!-- Alerta Modal --> 
           <div class="row"> <!-- Alta de Actividades -->
            <div class="col-xs-12">

              <div class="box box-<?php echo "$sColorCaja";  ?>">
                <div class="box-header">
                  <h3 class="box-title">Registra un Libro</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fas fa-minus"></i></button>

              </div>
                </div><!-- /.box-header -->

          		<form id='frmAlta' method='post' action='guardar.php'>    

	                <div class="box-body">

		              <div class="row">


                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div class="form-group">
    <label for="id_modulo">Modulo </label>
    <select style="width:100%" id="id_modulo" class="select2 form-control ">
      <option value="" disabled selected>Seleccionar...</option>
      <?
        for ($i = 0; $i < $num1; $i++) {
            $id      = mysqli_result($combo1, $i, 'id_modulo');
            $valor = mysqli_result($combo1, $i, 'modulo');
            echo "<option value=\"$id\" >$valor</option>";
        }
        ?>
    </select>
  </div>
</div>

                 <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
    <label for="id_claificacion">Clasificacion </label>
    <select style="width:100%" id="id_clasificacion" class="select2 form-control ">
      <option value="" disabled selected>Seleccionar...</option>
      <?
        for ($i = 0; $i < $num2; $i++) {
            $id      = mysqli_result($combo2, $i, 'id_clasificacion');
            $valor = mysqli_result($combo2, $i, 'clasificacion');
            echo "<option value=\"$id\" >$valor</option>";
        }
        ?>
    </select>
  </div>
</div>


                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-6">
                      <div class="form-group">
                          <label for="titulo">Titulo completo del Libro:</label>
                          <input type="text" class="form-control" id="titulo" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                      <div class="col-xs-12 col-sm-5 col-md-5">
                      <div class="form-group">
                          <label for="autores">Autores:</label>
                          <input type="text" class="form-control" id="autores" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                      <div class="form-group">
                          <label for="editorial_libro">Editorial del Libro:</label>
                          <input type="text" class="form-control" id="editorial_libro" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-5 col-md-3">
                      <div class="form-group">
                          <label for="anio_publicacion">Año de Publicacion:</label>
                          <input type="text" class="form-control" id="anio_publicacion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                      <div class="form-group">
                          <label for="lugar_publicacion">Lugar de Publicacion:</label>
                          <input type="text" class="form-control" id="lugar_publicacion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="isbn">ISBN:</label>
                          <input type="text" class="form-control" id="isbn" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-2">
                      <div class="form-group">
                          <label for="edicion">Edicion:</label>
                          <input type="text" class="form-control" id="edicion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="condicion_libro">Condicion del Libro:</label>
                          <input type="text" class="form-control" id="condicion_libro" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="numero_identificacion">Numero de Identificacion:</label>
                          <input type="text" class="form-control" id="numero_identificacion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-9">
                      <div class="form-group">
                          <label for="observaciones">Observaciones:</label>
                          <input type="text" class="form-control" id="observaciones" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>


		              </div><!-- /.row -->

	                </div><!-- /.box-body -->
		            <div class="box-footer">
		              <button id="btnSubAlta" type="submit" class="btn btn-<?php echo "$sColorCaja";  ?> pull-right">Guardar información</button>
		            </div>

              	</form>

              	</div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row --><!-- Alta de Actividades -->

          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <?php include("../plantilla/footers.php") ?>
      </footer>

       
    </div><!-- ./wrapper -->



    <!-- Modal -->
    <div id="mEditar" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Modifica los datos del libro</h3>
          </div>
          <form action="#" method="POST" id="frmEditar">
            <div class="modal-body">
              <div class="row">


<input id="txtId" type="hidden" />


                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
  <div class="form-group">
    <label for="e_modulo">Modulo </label>
    <select style="width:100%" id="e_modulo" class="select2 form-control ">
      <option value="" disabled selected>Seleccionar...</option>
      <?
        for ($i = 0; $i < $num1; $i++) {
            $id      = mysqli_result($combo1, $i, 'id_modulo');
            $valor = mysqli_result($combo1, $i, 'modulo');
            echo "<option value=\"$id\" >$valor</option>";
        }
        ?>
    </select>
  </div>
</div>

                 <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
  <div class="form-group">
    <label for="e_claificacion">Clasificacion </label>
    <select style="width:100%" id="e_clasificacion" class="select2 form-control ">
      <option value="" disabled selected>Seleccionar...</option>
      <?
        for ($i = 0; $i < $num2; $i++) {
            $id      = mysqli_result($combo2, $i, 'id_clasificacion');
            $valor = mysqli_result($combo2, $i, 'clasificacion');
            echo "<option value=\"$id\" >$valor</option>";
        }
        ?>
    </select>
  </div>
</div>


                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-6">
                      <div class="form-group">
                          <label for="e_titulo">Titulo completo del Libro:</label>
                          <input type="text" class="form-control" id="e_titulo" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                      <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="e_autores">Autores:</label>
                          <input type="text" class="form-control" id="e_autores" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                      <div class="form-group">
                          <label for="e_editoria_libro">Editorial del Libro:</label>
                          <input type="text" class="form-control" id="e_editorial_libro" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-2 col-lg-2">
                      <div class="form-group">
                          <label for="e_anio_publicacion">Año de Publicacion:</label>
                          <input type="text" class="form-control" id="e_anio_publicacion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                      <div class="form-group">
                          <label for="e_lugar_de_publicacion">Lugar de Publicacion:</label>
                          <input type="text" class="form-control" id="e_lugar_publicacion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="e_isbn">ISBN:</label>
                          <input type="text" class="form-control" id="e_isbn" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-2">
                      <div class="form-group">
                          <label for="e_edicion">Edicion:</label>
                          <input type="text" class="form-control" id="e_edicion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="e_condicion_libro">Condicion del Libro:</label>
                          <input type="text" class="form-control" id="e_condicion_libro" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                      <div class="form-group">
                          <label for="e_numero_identificacion">Numero de Identificacion:</label>
                          <input type="text" class="form-control" id="e_numero_identificacion" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-9">
                      <div class="form-group">
                          <label for="e_obervaciones">Observaciones:</label>
                          <input type="text" class="form-control" id="e_observaciones" value="" placeholder="Escribir..." autofocus required>
                      </div>
                    </div>
                


              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
              <button id="btnSubEdit" type="submit" class="btn btn-<?php echo "$sColorCaja";  ?> pull-right">Actualizar información</button>
            </div>
          </form>
        </div>

      </div>
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js?v=2"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>


    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>

    <script src="../plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="../plugins/alertifyjs/alertify.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>

    <script src="scripts.js?v=<?php echo date("Y-m-dH:i:s"); ?>"></script>
	<!-- inicio script -->
    <!-- page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

      });
    </script> 
</html>
