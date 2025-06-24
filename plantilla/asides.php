<?php 
	if ($_SESSION["s_perfil"]==20000) {
 ?>
         <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fas fa-sort-desc"></i> Actividad Reciente</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
 		<div class="container-fluid">
 		<?php 
 			 
			$consulta1=$conexion->query("SELECT
										descripcion,
										fecha,
										hora,
										icono
									FROM
										actividades
									ORDER BY
										id_actividad DESC
									LIMIT 6") or die (mysqli_error());
			$n=1;			   
			while ($row1=mysqli_fetch_row($consulta1)){
			$icono="<i class='$row1[3]'></i>";
 		 ?>
 			<div class="row">
 			<?php echo "$icono"; ?>&nbsp;

 			<?php 
 				echo " - $row1[0] , $row1[1] a las $row1[2]";
 			 ?>
				
 			</div>
 	 		<div class="row">
 				---------------------------------------------
 			</div>	
 		<?php 
 		$n++; 
 		}
 		?>	
 		</div>
        </div>
        <?php } ?>