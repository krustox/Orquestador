<?php
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');

session_start();

$id = "";
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$tabla = "";
if(isset($_GET['tabla'])){
	$tabla = $_GET['tabla'];
}
$nombre = "";
if(isset($_GET['nombre'])){
	$nombre = $_GET['nombre'];
}

if($nombre != ""){
	$query = "DELETE FROM \"SERVICIOS_MONITOREO\".\"Servicio_Monitoreado\" WHERE \"Servicio_Monitoreado\" = '$nombre'";
}else if($tabla == ""){
	$query = "DELETE FROM \"orquestador\".\"usuario\" WHERE \"usuario_id\" = $id";
}else{
$query = "UPDATE \"orquestador\".\"$tabla\" SET 
\"$tabla"."_para\"='',
\"$tabla"."_cc\"='',
\"$tabla"."_marchablancatxt\"='',
\"$tabla"."_marchablanca\"=0
 WHERE \"$tabla"."_id\"=$id";
//echo $query;
}

if(ejecutarDelete($query, $conn_string)){
	echo "Se eliminó el registro seleccionado";
}else{
	echo "No se pudo eliminar el registro seleccionado";
}
?>