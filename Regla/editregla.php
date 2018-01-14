<?php
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');

session_start();

$id = $_POST['id'];
$tabla = $_POST['tabla'];
$para = $_POST['para'];
$cc = $_POST['cc'];
$marcha ="";
$marchatxt="";
if(isset($_POST['marcha'])){
	$marcha = "1";
	if(isset($_POST['marchatxt'])){
		$marchatxt = $_POST['marchatxt'];
	}
}else{
	$marcha = "0";
}

$q_para="";
$q_cc="";
$q_marcha="";
$q_marchatxt="";

$query = "UPDATE \"orquestador\".\"$tabla\" SET ";
if($para != ""){
	$q_para="\"$tabla"."_para\"='$para', ";
}
if($cc != ""){
	$q_cc="\"$tabla"."_cc\"='$cc', ";
}
/*
if ($q_para == "" || $q_cc == ""){
	$marcha = "0";
}
*/

if($marcha == 0){$marchatxt="";}

if($marcha != ""){
	$q_marcha="\"$tabla"."_marchablanca\"=$marcha ";
}
$q_marchatxt="\"$tabla"."_marchablancatxt\"='$marchatxt', ";


$q="WHERE \"$tabla"."_id\"=$id ";
$query = $query . $q_severidad . $q_para . $q_cc . $q_marchatxt . $q_marcha . $q;
echo $query;
if(ejecutarUpdate($query, $conn_string)){
	echo "Se actualizó la regla seleccionada";
	escribir("Actualizacion", $_SESSION['u']. " " .$query);
	$extra = 'tabla.php?ok=1';
}else{
	echo "No se pudo actualizar la regla seleccionada";
	$extra = 'tabla.php?ok=0';
}

header("Location: http://$host/orquestador/".$extra);

?>