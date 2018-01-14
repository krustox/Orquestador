<?php

/*
$db_name = 'SERVICI'; 
$usr_name = 'db2admin'; 
$password = 'da.900619.'; 
$hostname = 'localhost'; 
$port = 50000;
 */
$db_name = 'SERVICIO'; 
$usr_name = 'db2inst1'; 
$password = 'tivolitivoli'; 
$hostname = '167.28.131.172'; 
$port = 50000;

$conn_string = "DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$db_name;HOSTNAME=$hostname;PORT=$port;PROTOCOL=TCPIP;UID=$usr_name;PWD=$password;";
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

?>