<?php

$mysql_hostname = "localhost";
$mysql_user = "ppgcm1";
$mysql_password = "inscppgcmbd";
$mysql_database = "ppgcm1";

$conn = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
        or die("Opps something went wrong");

mysql_select_db($mysql_database, $conn)
        or die("Opps something went wrong");

//mysql_query("SET NAMES 'utf8'", $bd);
?>
