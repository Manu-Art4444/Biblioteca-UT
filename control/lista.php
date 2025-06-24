<?php
include'../conexion/conexion.php';
include'../sesiones/verificar_sesion.php';
include"combos.php";



$sColorCaja = $_SESSION["s_ColorCaja"];
?>

<div class="col-xs-12">
  <label for="buscador">Busqueda Rapida:</label>
<div class="search-container">
  <input type="text" id="buscador" class="form-control" placeholder="Título, Autores, Editorial, ISBN, Edición, Módulo, Clasificación..." />
</div>
<br>
</div>

<div class="col-xs-12">
  
<br>
<div class="table-responsive">
  <table id="example1" class="table table-condensed table-bordered table-striped">
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
        <th>Editar</th>
        <th>Activo</th>
      </tr>
      <style>


    #example1_filter {
      display: none;
    }
    /* Tamaño busqueda */
  #buscador {
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
                                  cl.clasificacion
                                FROM
                                  biblioteca_libros AS l
                                  inner join modulo_estante AS me on l.id_modulo=me.id_modulo
                                  inner join biblioteca_clasificacion_libros AS cl on l.id_clasificacion=cl.id_clasificacion
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
            <button onclick="abrirMVer(<?php echo $row["id_libro"]; ?>);" <?php echo $aBtn; ?> class="mB btn btn-info btn-sm" type="button">
              <i class="fas fa-eye" aria-hidden="true"></i>
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
          <td class="centrar"> 
            <button onclick="abrirMEditar(<?php echo $row["id_libro"]; ?>);" <?php echo $aBtn; ?> class="mB btn btn-<?php echo $sColorCaja; ?> btn-sm" type="button">
              <i class="fas fa-edit" aria-hidden="true"></i>
            </button>
          </td>
          <td class="centrar">
            <input <?php echo $tBtn; ?> data-toggle="toggle" data-id="<?php echo $row[0]; ?>" data-on="Si" data-off="No" type="checkbox" data-size="small">
          </td>
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
    var table = $('#example1').DataTable({
      "language": {
        "url": "../plugins/datatables/langauge/Spanish.json"
      }
    });

    
    $('#fModulo').change(function() {
      var selectedModulo = $(this).val(); 

      if (selectedModulo === "") {
        table.column(5).search('').draw();
      } else {
        table.column(5).search(selectedModulo).draw();
      }
    });

    
    $('#buscador').on('keyup', function() {
      table.search(this.value).draw();
    });

    
    $(".select2").select2();
    
    
    $('input[data-toggle="toggle"]').bootstrapToggle('destroy');
    $('input[data-toggle="toggle"]').bootstrapToggle();

    $('input[data-toggle="toggle"]').change(function() {
      var val = ($(this).prop('checked') == true) ? 1 : 0;
      var id = $(this).attr('data-id');

      $.ajax({
        url: "status.php",
        type: "POST",
        dataType: 'html',
        data: {id:id, val:val},
        success: function(data) {
          alertify.dismissAll();
          if (data.trim() == "1") {
            alertify.success("Libro deshabilitado");
            $("tr#tr-" + id + " td.mN").removeClass("inactivo");
            $("tr#tr-" + id + " td.mN").addClass("activo");
            $("tr#tr-" + id + " a.mB").removeClass("disabled");
            $("tr#tr-" + id + " button.mB").prop("disabled", false);
          } else if (data.trim() == "0") {
            alertify.error("Libro deshabilitado");
            $("tr#tr-" + id + " td.mN").removeClass("activo");
            $("tr#tr-" + id + " td.mN").addClass("inactivo");
            $("tr#tr-" + id + " a.mB").addClass("disabled");
            $("tr#tr-" + id + " button.mB").prop("disabled", true);
          }
        },
        error: function(xhr, status) {
          swal("Error de llamada AJAX", xhr.responseText, "error");
        }
      });
    });
  });
</script>

