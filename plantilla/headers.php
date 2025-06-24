<?php 

//se manda llamar la conexion
include("../conexion/conexion.php");

//cargo variables de sesion
include("../sesiones/variables_sesion.php");

//verifico inicio de sesion
include("../sesiones/verificar_sesion.php");

//incluir funcion mes en español y año
include("../funciones/mesanioEspanol.php");

//incluir funcion calcular edad
include("../funciones/calcularEdad.php");

//Funcion que permite mostrar foto
include("../funciones/mostrarFoto.php");


$edad=CalculaEdad( $_SESSION["s_Edad"] ) ;
//variables de session

//Renombro la variable
$MiembroDesde=nombremes($sMiembro);

//mando llamar funcion con path de fotografia
$Foto=Fotografia($sIdPersona);

$mesActual=date("m");
$diaActual=date("d");
                      //Extraigo la información de la configuracion
                      $consultaY=$conexion->query("SELECT
                                              personas.id,
                                              personas.nombre AS apodo,
                                              personas.nombre
                                            FROM
                                              personas
                                            ORDER BY
                                              apodo") or die (mysqli_error());
                      //Descargamos el arreglo que arroja la consulta
                    
                      // $cont=mysqli_num_rows($consultaY);
                      $cont=0;

if ($verMod <> "NO") {
        $consultaCatM=$conexion->query("SELECT
                  modulos.id_CategoriaModulo,
                  categoria,
                  modulos.nombre,
                  modulos.carpeta,
                  modulos.icono
                FROM
                  modulos
                INNER JOIN categoria_modulo ON modulos.id_CategoriaModulo = categoria_modulo.id_CategoriaModulo
                WHERE
                id = $modAcceso") or die (mysqli_error());
        $rowCatM=mysqli_fetch_row($consultaCatM);

        $consultaModulos=$conexion->query("SELECT
                  modulos.id,
                  modulos.nombre,
                  categoria_modulo.id_CategoriaModulo,
                  categoria_modulo.categoria,
                  modulos.icono,
                  modulos.carpeta
                FROM
                  modulo_perfil
                INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
                INNER JOIN categoria_modulo ON categoria_modulo.id_CategoriaModulo = modulos.id_CategoriaModulo
                WHERE
                  categoria_modulo.id_CategoriaModulo = $rowCatM[0]
                AND
                  modulos.id NOT IN ($modAcceso)
                AND
                  id_perfil = $sIdPerfil") or die (mysqli_error());
        // $rowModulos=mysqli_fetch_row($consultaModulos);

        $consultaContM=$conexion->query("SELECT
                  count(modulos.id)
                FROM
                  modulo_perfil
                INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
                INNER JOIN categoria_modulo ON categoria_modulo.id_CategoriaModulo = modulos.id_CategoriaModulo
                WHERE
                  categoria_modulo.id_CategoriaModulo = $rowCatM[0]
                AND id_perfil = $sIdPerfil") or die (mysqli_error());
        $TotModPerfil=mysqli_fetch_row($consultaContM);

      }
 ?>
       <!-- Logo -->
        <a href="../inicio/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>BUT</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Biblioteca UT</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top hidden" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <i class="fas fa-bars"></i>
          </a>
          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
            <?php 
            if ($cont==0) {
            ?>             
              <!-- <li class="dropdown tasks-menu">
                <a href="../inicio/index.php" class="dropdown-toggle" >
                  <i class="fas fa-tachometer-alt"></i>
                </a>
              </li> -->
 			<?php } ?>
            <?php 
            if ($verMod <> "NO") {
            ?>

              <li class="dropdown tasks-menu">
                <a href="../<?php echo "$rowCatM[3]"; ?>/index.php" class="dropdown-toggle" >
                  <i class="fas <?php echo " $rowCatM[4]"; ?>" data-toggle='tooltip' data-placement="auto" title="<?php echo "$rowCatM[2]"; ?>"></i>
                  <?php // echo "$rowCatM[2]"; ?>
                </a>
              </li>
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-puzzle-piece"></i>
                  <span class="label label-success"><?php echo "$TotModPerfil[0]"; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"><h4 class="cortar"><?php echo "$rowCatM[1] "; ?></h4> </li>
                  <li>
                    <!-- inner menu: contains the actual data -->

                    <ul class="menu">
                      <li><!-- start message -->
                    <?php 
                    while ($rowModulos=mysqli_fetch_row($consultaModulos)){
                      $persoExt=$rowModulos[1];
                     ?>
                      
                        <a href="../<?php echo "$rowModulos[5]"; ?>/index.php">
                          <div class="pull-left">
                            <i class="fas <?php echo "$rowModulos[4]"; ?>"></i>
                          </div>
                          <h4 class="cortar">
                            <?php echo "$persoExt"; ?>
                            <small><i class="fas fa-check"></i> </small>
                          </h4>
                          <p><?php echo ""; ?></p>
                        </a>
                      
                    <?php  
                    }
                    ?>
                    </li><!-- end message -->
                    </ul>

                  </li>
                  <li class="footer"><a href="../<?php echo "$rowCatM[3]"; ?>/index.php"> 
                  <i class="fas <?php echo " | $rowCatM[4]"; ?>" title="<?php echo "$rowCatM[2]"; ?>"></i>
                  <?php echo "$rowCatM[2]"; ?></a></li>
                </ul>
              </li>
        <?php } ?>
              <!-- Tasks: style can be found in dropdown.less -->
            <?php 
            if ($cont!=0) {
            ?>
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-birthday-cake"></i>
                  <span class="label label-warning"><?php echo "$cont"; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Cumpleañeros del <?php echo $diaActual." de ".nombremes1($mesActual); ?></li>
                  <li>
                    <!-- inner menu: contains the actual data -->

                    <ul class="menu">
                      <li><!-- start message -->
                    <?php 
                    while ($rowY=mysqli_fetch_row($consultaY)){
                      $persoExt=$rowY[3]." | ".$rowY[1];
                     ?>
                      

                        <a href="#">
                          <div class="pull-left">
                            <img src="<?php echo Fotografia($rowY[0]);; ?>" class="img-circle" alt="User Image">
                          </div>
                          <h4 class="cortar">
                            <?php echo "$persoExt"; ?>
                              echo "<small><i class='fa fa-briefcase'></i></small> ";
                             ?>
                          </h4>
                          <p><?php echo ""; ?></p>
                        </a>
                      
                    <?php  
                    }
                    ?>
                    </li><!-- end message -->
                    </ul>


                  </li>
                  <li class="footer"><a href="#">Felicidades</a></li>
                </ul>
              </li>
                  <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <!-- <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $Foto; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo "$sNombreCompleto"; ?></span>
                </a>
              </li> -->
              <li class="dropdown tasks-menu">
                <a href="../sesiones/cerrarsesion.php" class="dropdown-toggle" >
                  Cerrar sesión
                </a>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <?php 
                if ($_SESSION["s_perfil"]==200000) {
               ?>
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fas fa-history"></i></a>
              </li>
            <?php } ?>
            </ul>
          </div>

<!-- 
<div class="modal fade" id="frmPrueba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4>Insertar Datos</h4>
          </div>
          
            <div class="modal-body">
              <form method="POST" id="formulario">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="nombre" class="control-label">Nombre de persona</label>
                        <input type="text" id="nombre_persona" name="nombre_persona" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="ap_paterno" class="control-label">Apellido Paterno</label>
                        <input type="text" id="ap_paterno" name="ap_paterno" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="ap_materno" class="control-label">Apellido Materno</label>
                        <input type="text" id="ap_materno" name="ap_materno" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
              <input type="submit" class="btn btn-success" value="Guardar">
            </div>
          </form>
        </div>
      </div>



 -->
      