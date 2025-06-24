<?php 
//se manda llamar la conexion
include("../conexion/conexion.php");
//verifico inicio de sesion
include("../sesiones/verificar_sesion.php");
//cargo variables de sesion
include"../sesiones/variables_sesion.php";

//nombre del perfil
$s_Nombres=$_SESSION["s_NombrePersona"];
$sIdUsuario=$_SESSION["s_id_persona"];
$sGenero=$_SESSION["s_genero"];

             
            $consultax=$conexion->query("SELECT
										modulos.id,
										modulos.nombre,
										modulos.carpeta
									FROM
										modulo_perfil
									INNER JOIN modulos ON modulo_perfil.id_modulo = modulos.id
									WHERE modulo_perfil.id_perfil=$sIdPerfil AND modulos.activo=1 ORDER BY modulos.nombre
									") or die (mysqli_error());



 ?>
          <div class="user-panel hidden">
            <div class="pull-left image">
              <img src="<?php echo Fotografia($sIdUsuario,$sGenero); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p style="text-overflow: ellipsis;overflow: hidden; width: 150px;white-space: nowrap;"><?php echo "$s_Nombres"; ?></p>
              <a href="#"><i class="fas fa-bolt  text-<?php echo "$sColorCaja"; ?>"></i> &nbsp;<?php echo "$sNombrePerfil"; ?></a>
            </div>
          </div>
          <!-- search form -->
          <form action="../inicio/modulos.php" method="post" class="sidebar-form hidden">
            <div class="input-group">
              <!-- <input type="text" name="q" class="form-control" placeholder="Search..."> -->
	                        <select name="modulo" onchange="this.form.submit()" class="select2 form-control buscador" style="max-width: 99%;">
	                          <option selected="selected" value="inicio"> Panel de control</option>
	                     	<?php 
				            $n=1;
				            while ($rowx=mysqli_fetch_row($consultax))
				            {
	
	                      	?>

	                          <option value="<?php echo $rowx[2]; ?>"><?php echo $rowx[1]; ?></option>
	                        
							<?php 
							}
							?>
							 </select>
              <span class="input-group-btn">
                <a href="../inicio/" type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fas fa-tachometer-alt text-<?php echo "$sColorCaja"; ?>"></i></a>
              </span>
            </div>
          </form>
          <!-- /.search form -->