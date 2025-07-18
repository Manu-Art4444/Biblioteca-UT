<?php
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.
include"combos.php";



$sColorCaja = $_SESSION["s_ColorCaja"];
?>

<div class="col-xs-12">
  <label for="buscadorPrestados">Busqueda Rapida:</label>
<div class="search-container">
  <input type="text" id="buscadorPrestados" class="form-control" placeholder="Título, Autores, Editorial, ISBN, Edición, Módulo, Clasificación..." />
</div>
<br>
</div>

<div class="col-xs-12">
  
<br>
<div class="table-responsive">
  <table id="example2" class="table table-condensed table-bordered table-striped">
    <thead>
      <tr class="info">
        <th>#</th>
        <th>Ver</th>
        <th>Titulo</th>
        <th>Autores</th>
        <th>Editorial</th>
        <th>Modulo</th>
        <th>Clasificacion</th>
        <td class="hidden">Año de Publicacion</td>
        <td class="hidden">Lugar de Publicacion</td>
        <td class="hidden">ISBN</td>
        <td class="hidden">Edicion</td>
        <td class="hidden">Condicion_Libro</td>
        <td class="hidden">Numero de Identificacion</td>
        <th class="hidden">Observaciones</th>
        <th class="hidden">id_modulo</th>
        <th class="hidden">id_clasificacion</th>
      </tr>
      <style>


    #example2_filter {
      display: none;
    }
    /* Tamaño busqueda */
  #buscadorPrestados {
    width:100%;  
    height: 35px; 
    font-size: 14px;  
  }
  </style>
    </thead>
    <tbody>
      <?php 
      $consulta=$conexion->query("SELECT
                                  l.*, me.modulo,
                                  cl.clasificacion, p.id_prestamo
                                FROM
                                  biblioteca_libros AS l
                                  inner join modulo_estante AS me on l.id_modulo=me.id_modulo
                                  inner join biblioteca_clasificacion_libros AS cl on l.id_clasificacion=cl.id_clasificacion
                                  inner join biblioteca_prestamos AS p ON p.id_libro = l.id_libro AND p.vigente = 1
                                ORDER BY activo DESC, titulo ASC") or die (mysqli_error());
      $n=1;
      while ($row=mysqli_fetch_array($consulta))
      {
        $activo =($row["activo"]==1)?"<i class='fa fa-check-square-o' aria-hidden='true'></i>":"<i class='fa fa-square-o' aria-hidden='true'></i>"; 
        $stu    =($row["activo"]==1)?"activo":"inactivo"; 
        $tBtn   = ($row["activo"]==1)?"checked":""; 
        $aBtn   = ($row["activo"]==1)?" ":"disabled";
      ?> 
        <tr id="tr-<?php echo $row[0]; ?>">
          <td class="text-center mN <?php echo $stu; ?>"><?php echo $n; ?></td>
          <td class="centrar"> 
            <button onclick="terminarPrestamo(<?php echo $row["id_prestamo"]; ?>);" <?php echo $aBtn; ?> class="mB btn btn-success btn-sm" type="button">
              <i class="fas fa-check" aria-hidden="true"></i>
            </button>
          </td>
          <td class="mN <?php echo $stu; ?>"><?php echo $row["titulo"]; ?></td>
          <td class="mN <?php echo $stu; ?>"><?php echo $row["autores"]; ?></td>
          <td class="mN <?php echo $stu; ?>"><?php echo $row["editorial_libro"]; ?></td>
          <td class="mN <?php echo $stu; ?>"><?php echo $row["modulo"]; ?></td>
          <td class="mN <?php echo $stu; ?>"><?php echo $row["clasificacion"]; ?></td>
          <td class="hidden"><?php echo $row["anio_publicacion"]; ?></td>
          <td class="hidden"><?php echo $row["lugar_publicacion"]; ?></td>
          <td class="hidden"><?php echo $row["isbn"]; ?></td>
          <td class="hidden"><?php echo $row["edicion"]; ?></td>
          <td class="hidden"><?php echo $row["condicion_libro"]; ?></td>
          <td class="hidden"><?php echo $row["numero_identificacion"]; ?></td>
          <td class="hidden"><?php echo $row["observaciones"]; ?></td>
          <td class="hidden"><?php echo $row["id_modulo"]; ?></td>
          <td class="hidden"><?php echo $row["id_clasificacion"]; ?></td>
        </tr>
      <?php 
      ++$n;
      }
      ?>
    </tbody>
  </table>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // Activar DataTables con lenguaje en español
    var table = $('#example2').DataTable({
      "language": {
        "url": "../plugins/datatables/langauge/Spanish.json"
      }
    });


    
    $('#buscadorPrestados').on('keyup', function() {
      table.search(this.value).draw();
    });

    
  });
</script>

