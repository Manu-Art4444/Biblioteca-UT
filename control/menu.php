<?php 
switch ($opa) {
  case 'A':
        $va1="class=\"active\"";
    break;
  case 'B':
        $va2="class=\"active\"";
    break;
  case 'C':
        $va3="class=\"active\"";
    break;
  case 'D':
        $va4="class=\"active\"";
    break;
  case 'F':
        $va5="class=\"active\"";
    break;
  case 'G':
        $va6="class=\"active\"";
    break;
  case 'H':
        $va6="class=\"active\"";
    break;
  case 'I':
        $va6="class=\"active\"";
    break;
}
 ?>
            <li class="active">
              <a href="#">
                <!-- <i class="fas fa-cubes"></i> <span>Libros</span>  -->
                <ul class="treeview-menu">
                  <li <?php echo "$va1"; ?>>
                    <a href="index.php"><i class="fas fa-list" aria-hidden="true"></i> &nbsp; Listado de libros</a>
                  </li>
                  <li <?php echo "$va3"; ?>>
                    <a href="prestamos.php"><i class="fas fa-user-check" aria-hidden="true"></i> &nbsp; Prestamos de libros</a>
                  </li>
                  <li <?php echo "$va2"; ?>>
                    <a href="registro.php"><i class="fas fa-edit" aria-hidden="true"></i> &nbsp; Registro de libros</a>
                  </li>
                </ul>
              </a>
            </li>