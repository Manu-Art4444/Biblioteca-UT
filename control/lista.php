<?php
require_once __DIR__ . '/../bootstrap.php';   // inicia sesión, carga PDO $db, etc.
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
  $(document).ready(function () {
    const table = $('#example1').DataTable({
      language: {
        url: "../plugins/datatables/langauge/Spanish.json"
      }
    });

    $('#fModulo').on('change', function () {
      const modulo = $(this).val();
      table.column(5).search(modulo || '').draw();
    });

    $('#buscador').on('keyup', function () {
      table.search(this.value).draw();
    });

    $(".select2").select2();

    const $toggles = $('input[data-toggle="toggle"]');
    $toggles.bootstrapToggle('destroy').bootstrapToggle();

    $toggles.on('change', function () {
      const $this = $(this);
      const val = $this.prop('checked') ? 1 : 0;
      const id = $this.data('id');

      $.ajax({
        url: "status.php",
        method: "POST",
        dataType: 'html',
        data: { id, val },
        success: function (data) {
          alertify.dismissAll();

          const $row = $("#tr-" + id);
          const $td = $row.find("td.mN");
          const $a = $row.find("a.mB");
          const $btn = $row.find("button.mB");

          if (data.trim() === "1") {
            alertify.success("Libro activado");
            $td.removeClass("inactivo").addClass("activo");
            $a.removeClass("disabled");
            $btn.prop("disabled", false);
          } else if (data.trim() === "0") {
            alertify.error("Libro deshabilitado");
            $td.removeClass("activo").addClass("inactivo");
            $a.addClass("disabled");
            $btn.prop("disabled", true);
          }
        },
        error: function (xhr) {
          swal("Error de llamada AJAX", xhr.responseText, "error");
        }
      });
    });
  });
</script>
