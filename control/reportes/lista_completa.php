<?php

	$id_usuario= $_SESSION["s_clave"];


require_once('../../plugins/ezpdf/class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../../plugins/ezpdf/fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);

//se manda llamar la conexion
include("../../conexion/conexion.php");

//verifico inicio de sesion
include("../../sesiones/verificar_sesion.php");
$conn=$conexion;


$queEmp = "SELECT
            id,
            nombre,
            descripcion,
            fecha,
            hora,
            activo
          FROM
            perfiles
            ORDER BY nombre";

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

$ixx = 0;
while($datatmp = mysql_fetch_assoc($resEmp)) {
        $ixx = $ixx+1;
        $data[] = array_merge($datatmp, array('num'=>$ixx));
}

$titles = array(
                                'num'=>'<b>No</b>',
                                'nombre'=>'<b>Perfil</b>',
                                'descripcion'=>'<b>Descripcion</b>',
								
                        );
$options = array(
                                'shadeCol'=>array(0.5,0.5,0.5),
                                'xOrientation'=>'center',
                                'width'=>500
                        );

$txttit = "<b>                            LISTA COMPLETA DE PERFILES</b>\n";
$pdf->setColor(0.3,0.3,0.3);
$pdf->ezImage("../../images/encabezado.jpg", 0, 500, 'none', 'left');
$pdf->ezText($txttit, 15);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n");
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();

?>