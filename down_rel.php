<?php
session_start();
$file = $_SESSION['path_to_file'];

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=lista_candidatos.csv");
header("Content-Type: application/txt");
header("Content-Transfer-Encoding: binary");
// read the file from disk
readfile($file);

?>