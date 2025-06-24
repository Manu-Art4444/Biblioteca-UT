<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//se manda llamar la conexion
include("../conexion/conexion.php");

//verifico inicio de sesion
include("../sesiones/verificar_sesion.php");

//cargo variables de sesion
include("../sesiones/variables_sesion.php");

header("Location: /control/");

//Cambio de piel del sistema
$skin="skin-".$sSkin;

$op="inicio";

$s_responsable=$_SESSION["s_responsable"];
$s_planeacion=$_SESSION["s_planeacion"];
$s_subdireccion=$_SESSION["s_subdireccion"];
$s_direccion=$_SESSION["s_direccion"];
$s_finanzas=$_SESSION["s_finanzas"];

  // $var=$s_responsable.' '.$s_planeacion.' '.$s_subdireccion.' '.$s_direccion.' '.$s_finanzas;

//En este apartado coloco los numeros de modulos que corresponde cada modulo  a bloquear
//de este modo si los numero cambian se cambian directo de este apartado
// $mPlan=27;
// $mSub=28;
// $mDir=29;
// $mFin=30;
/////////////////////////////////////////////////////////////////////////////////////////////

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UT</title>
<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f39c12"/>
    <meta property="og:url"           content="https://UT.online/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="UT ONLINE" />
    <meta property="og:description"   content="Preparatoria UT ONLINE." />
    <meta property="og:image" content="https://UT.online/colbach/images/logo.jpg" />

    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="./colbach/images/logo.jpg">
    <link rel="apple-touch-startup-image" href="./colbach/images/logo.jpg">
    <link rel="manifest" href="./colbach/manifest.json">
    
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="../plugins/font-awesome-5/css/all.css"> -->
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

  <link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/default.rtl.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- ACCIONES MODALES -->
    <script src="funciones.js"></script>
    <!-- Scroll Menu -->
    <link href="../plugins/alertaModal/css/sweetalert.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Custom functions file -->
    <script src="../plugins/alertaModal/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="../plugins/alertaModal/js/sweetalert.min.js"></script>
    <!-- ACCIONES MODALES -->
    <style>
      .progress-description{
        font-size: 18px;
        font-weight: bold;
      }
      .small-box .inner{
        z-index: 1;
        position: inherit;
      }
      .hv_move:hover, .hv_move i:hover{
        cursor: move !important;
      }
      .sortable { list-style-type: none; margin: 0; padding: 0;}
      .sortable li { display:inline-table; width: 100% }
    </style>
  </head>
  <body class="hold-transition <?php echo $skin; ?> sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <?php $verMod="NO"; ?>
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
 		  <?php 
 		   include("../plantilla/vertical.php");
 		   ?>
      </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header hidden">
          <h1>
            Inicio
            <!-- <small>Inicio</small> -->
          </h1>
          <ol class="breadcrumb">
            
             <li class="active">Inicio <?php echo "$var"; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Acordeon -->


        <div class="panel-group" id="accordion" role="tablist">

          <?php 
            //Realizo la consulta a partir de la cantidad de categorias pendientes
             
            $consulta=$conexion->query("SELECT
                                        DISTINCT(categoria_modulo.categoria),
                                        categoria_modulo.id_CategoriaModulo,
                                        colapsado
                                    FROM
                                      modulo_perfil
                                    INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
                                    INNER JOIN categoria_modulo ON categoria_modulo.id_CategoriaModulo=modulos.id_CategoriaModulo
                                    WHERE
                                      id_perfil = $sIdPerfil
                                    AND modulos.activo=1  and categoria_modulo.id_CategoriaModulo != 10 
                                    ORDER BY
                                    categoria_modulo.orden,categoria_modulo.categoria") or die (mysqli_error());
               
            //Descargamos el arreglo que arroja la consulta
            $n=1;
            while ($row=mysqli_fetch_row($consulta))
            {
              $collsapse="#collapse";
              $heading="heading";
              $varIn=($n==1)?"in":" ";
              $varIn2=($row[2]=="si")?"in":" ";
            ?>

                <div class="panel panel-default ">
                  <div class="panel-heading hidden" role="tab" id="<?php echo "$heading$n"; ?>">
                  <h4 class="panel-title">
                    <a href="<?php echo "$collsapse$n"; ?>" data-toggle="collapse" data-parent="#accordion">
                      <?php echo $row[0]; ?>
                    </a>        
                  </h4>
                  </div>

                  <div id="collapse<?php echo "$n"; ?>" class="panel-collapse collapse <?php echo "$varIn $varIn2"; ?>">
                    <div class="panel-body">
                    <!-- Inicio del primer acordeon!-->
                    <div class="row">
                      <ul class="sortable s<?php echo $n; ?>" style="margin-bottom: 0;">
                    <?php 
                    //Realizo la consulta a partir de la cantidad de categorias pendientes
                    // $consultaOrden=$conexion->query("SELECT orden_modulos FROM usuarios WHERE id = ".$_SESSION["s_clave"]) or die (mysqli_error());
                    // $rowO = mysqli_fetch_row($consultaOrden);
                    // $ordenMod = ($rowO[0]=="")?"0":$rowO[0];
                    $_om = "ORDER BY orden,nombre";
                    $consulta1=$conexion->query("SELECT
                                                modulos.id,
                                                nombre,
                                                carpeta,
                                                orden,
                                                icono,
                                                color
                                              FROM
                                                modulo_perfil
                                              INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
                                              WHERE
                                                modulo_perfil.id_perfil = $sIdPerfil and id_CategoriaModulo = '$row[1]'
                                              AND modulos.activo=1
                                              $_om"
                                              ) or die (mysqli_error());
                       
                    //Descargamos el arreglo que arroja la consulta

                    $n1=1;
                    while ($row1=mysqli_fetch_row($consulta1))
                    {
                      
                      if ($row1[0]==54) { //CONVOCATORIAS Y MONTOS
                        $permiso1 = $conexion->query("SELECT * FROM permisos WHERE id_persona = '".$_SESSION['s_id_persona']."' AND permiso = 'conv_mont'") or die (mysqli_error());
                        if (mysqli_num_rows($permiso1)==0) {
                          continue;
                        }
                      }
                      
                      if ($row1[0]==77) { //CONVOCATORIAS Y MONTOS
                        $permiso1 = $conexion->query("SELECT * FROM permisos WHERE id_persona = '".$_SESSION['s_id_persona']."' AND permiso = 'prog_induccion'") or die (mysqli_error());
                        if (mysqli_num_rows($permiso1)==0) {
                          continue;
                        }
                      }
                      //dentro de este bloque establecemos las variables para el llenado de los modulos
                      //incluyendo los prohibidos
                      switch ($row1[0]) {
                        case $mPlan:
                          $colorMod=($s_planeacion==0)?' ':$row1[5];
                          $linkModulo=($s_planeacion==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;
                        case $mSub:
                          $colorMod=($s_subdireccion==0)?' ':$row1[5];
                          $linkModulo=($s_subdireccion==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;
                        case $mDir:
                          $colorMod=($s_direccion==0)?' ':$row1[5];
                          $linkModulo=($s_direccion==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;
                        case $mFin:
                          $colorMod=($s_finanzas==0)?' ':$row1[5];
                          $linkModulo=($s_finanzas==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;  
                        case 69:
                          $colorMod=$row1[5];
                          $linkModulo='https://api.whatsapp.com/send?phone=528135958302';
                          break;
                        default:
                          $colorMod=$row1[5];
                          $linkModulo='../'.$row1[2];
                          break;
                      }
                     ?>
                        <div class="col-xs-12  col-sm-6 col-md-6 col-lg-3 ">
                          <!-- small box -->
                          <button class="btn btn-success btn-lg" onclick="window.location.href='<?php echo "$linkModulo"; ?>'">Libros</button>
                        </div><!-- ./col -->
                    <?php 
                    }
                     ?>
                     </ul>
                    </div><!-- /.row -->
                    <!--Fin del primer Acordeon!-->
                    </div>        
                  </div>

                </div>          
            <?php 
              $n++;
            }

           ?>


          <?php 


          $permiso_PA = $conexion->query("SELECT * FROM permisos WHERE id_persona = '".$_SESSION['s_id_persona']."' AND permiso = 'pa_mods'") or die (mysqli_error());
          $showPAmods = (mysqli_num_rows($permiso_PA)>0);

          if ($showPAmods) { 
            //Realizo la consulta a partir de la cantidad de categorias pendientes
             
            $consulta=$conexion->query("SELECT
                                        DISTINCT(categoria_modulo.categoria),
                                        categoria_modulo.id_CategoriaModulo,
                                        colapsado
                                    FROM
                                      modulo_perfil
                                    INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
                                    INNER JOIN categoria_modulo ON categoria_modulo.id_CategoriaModulo=modulos.id_CategoriaModulo
                                    WHERE
                                      categoria_modulo.id_CategoriaModulo = 10
                                    AND modulos.activo=1
                                    ORDER BY
                                    categoria_modulo.orden,categoria_modulo.categoria") or die (mysqli_error());
               
            //Descargamos el arreglo que arroja la consulta
            $n=99999;
            while ($row=mysqli_fetch_row($consulta))
            {
              $collsapse="#collapse";
              $heading="heading";
              $varIn=($n==1)?"in":" ";
              $varIn2=($row[2]=="si")?"in":" ";
            ?>

                <div class="panel panel-default ">
                  <div class="panel-heading" role="tab" id="<?php echo "$heading$n"; ?>">
                  <h4 class="panel-title">
                    <a href="<?php echo "$collsapse$n"; ?>" data-toggle="collapse" data-parent="#accordion">
                      <?php echo $row[0]; ?>
                    </a>        
                  </h4>
                  </div>

                  <div id="collapse<?php echo "$n"; ?>" class="panel-collapse collapse <?php echo "$varIn $varIn2"; ?>">
                    <div class="panel-body">
                    <!-- Inicio del primer acordeon!-->
                    <div class="row">
                      <ul class="sortable s<?php echo $n; ?>">
                    <?php 
                    //Realizo la consulta a partir de la cantidad de categorias pendientes
                    // $consultaOrden=$conexion->query("SELECT orden_modulos FROM usuarios WHERE id = ".$_SESSION["s_clave"]) or die (mysqli_error());
                    // $rowO = mysqli_fetch_row($consultaOrden);
                    // $ordenMod = ($rowO[0]=="")?"0":$rowO[0];
                    $_om = "ORDER BY orden,nombre";
                    $consulta1=$conexion->query("SELECT
                                                modulos.id,
                                                nombre,
                                                carpeta,
                                                orden,
                                                icono,
                                                color
                                              FROM
                                                modulo_perfil
                                              INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
                                              WHERE
                                                modulo_perfil.id_perfil = $sIdPerfil and id_CategoriaModulo = 10
                                              AND modulos.activo=1
                                              $_om"
                                              ) or die (mysqli_error());
                       
                    //Descargamos el arreglo que arroja la consulta

                    $n1=1;
                    while ($row1=mysqli_fetch_row($consulta1))
                    {
                      
                      if ($row1[0]==54) { //CONVOCATORIAS Y MONTOS
                        $permiso1 = $conexion->query("SELECT * FROM permisos WHERE id_persona = '".$_SESSION['s_id_persona']."' AND permiso = 'conv_mont'") or die (mysqli_error());
                        if (mysqli_num_rows($permiso1)==0) {
                          continue;
                        }
                      }
                      //dentro de este bloque establecemos las variables para el llenado de los modulos
                      //incluyendo los prohibidos
                      switch ($row1[0]) {
                        case $mPlan:
                          $colorMod=($s_planeacion==0)?' ':$row1[5];
                          $linkModulo=($s_planeacion==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;
                        case $mSub:
                          $colorMod=($s_subdireccion==0)?' ':$row1[5];
                          $linkModulo=($s_subdireccion==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;
                        case $mDir:
                          $colorMod=($s_direccion==0)?' ':$row1[5];
                          $linkModulo=($s_direccion==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;
                        case $mFin:
                          $colorMod=($s_finanzas==0)?' ':$row1[5];
                          $linkModulo=($s_finanzas==0)?'javascript:notStatus(\'noAcceso\')':'../'.$row1[2];
                          break;  
                        case 69:
                          $colorMod=$row1[5];
                          $linkModulo='https://api.whatsapp.com/send?phone=528135958302';
                          break;
                        default:
                          $colorMod=$row1[5];
                          $linkModulo='../'.$row1[2];
                          break;
                      }
                     ?>
                        <div class="col-xs-12  col-sm-6 col-md-6 col-lg-3 ">
                          <!-- small box -->
                          <div onclick="window.location.href='<?php echo "$linkModulo"; ?>'" class="small-box hv-pointer bg-<?php echo "$colorMod"; ?>" title="<?php echo $row1[6]; ?>">
                            <div class="inner">
                              <h3>&nbsp;</h3>
                              <span class="progress-description"><?php echo "$row1[1]"; ?></span>
                            </div>
                            <div class="icon">
                              <i class="<?php echo "$row1[4]"; ?> fa-1x"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">Ingresar al Módulo <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div><!-- ./col -->
                    <?php 
                    }
                     ?>
                     </ul>
                    </div><!-- /.row -->
                    <!--Fin del primer Acordeon!-->
                    </div>        
                  </div>

                </div>          
            <?php 
              $n++;
            }
          }

           ?>

           <?php if (false): ?>
             <div class="panel panel-default ">
                  <div class="panel-heading" role="tab" id="heading9999999">
                  <h4 class="panel-title">
                    <a href="#collapse9999999" data-parent="#accordion">
                      Ayuda
                    </a>        
                  </h4>
                  </div>

                  <div id="collapse9999999" class="  ">
                    <div class="panel-body">

                    </div>
                  </div>
                </div>
              </div>
           <?php endif ?>
         </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer hidden">
        <?php include("../plantilla/footers.php") ?>
      </footer>

       
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>


    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
  <!-- inicio script -->
  <script type="text/javascript">
  
    $(document).ready(function() {
        $('#example1').DataTable( {
            "language": {
               // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                "url": "../plugins/datatables/langauge/Spanish.json"
            }
        } );
    } );

  </script>
    <!-- page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        //   $( ".sortable.s1" ).sortable({ handle: '.hv_move',
        //     update: function (event, ui) {
        //     var order = $(this).sortable('serialize');

        //     // $(document).on("click", "button", function () { //that doesn't work
        //     var r = $(this).sortable("toArray").toString();
        //     var a = $(this).sortable("serialize", {
        //         attribute: "data-id"
        //     });
        //     $.ajax({
        //         url: "actualizarOrden.php",
        //         type: "POST",
        //         dataType : 'json',
        //         encode : true,
        //         data: {orden:r},
        //         success: function(data){
        //           if (data["res"]=="Éxito") {
        //             console.log("Orden actualizado...");
        //           }else{
        //             console.log("Error al actualizar orden...");
        //           }
        //         },
        //         error: function(xhr, status){
        //             swal("Error de llamada AJAX", "", "error");
        //         }
        //     });
        //     // });
        // } }).disableSelection();
      });
    </script>    

<script src="../plugins/alertifyjs/alertify.js"></script>

</body>
</html>