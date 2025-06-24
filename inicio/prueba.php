<?php 
include("../conexion/conexion.php");
include("../conexion/conexionGoogleDrive.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$folderID = "1Tt_Y2pqsHYqirJeHPJx_PVP4v6ljZnKU";

$optParams2 = array(
  'q' => "'".$folderID."' in parents",
  "orderBy" => "title"
);
$resultsArchivosCarpeta = $service->files->listFiles($optParams2);

if(count($resultsArchivosCarpeta)>0){
  $hayPapeleria = true;
  foreach ($resultsArchivosCarpeta as $archivo) {
    $tipo = $archivo->mimeType;
    $nombre = $archivo->title;
    $thumbnailLink = $archivo->thumbnailLink;
    $click_prev = $archivo->embedLink;
    $fileExtension = $archivo->fileExtension;
    echo $nombre."<br>";
  }
}else{
  $hayPapeleria = false;
  echo "no hay";
}