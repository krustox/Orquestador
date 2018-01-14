<?php  
session_start();
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');

$nombre = "";
$correo = "";
$passw = "";
$tmp = 0;

if(isset($_POST['nombre'])){
	if($_POST['nombre'] != ""){
		$nombre = $_POST['nombre'];
	}
}
if(isset($_POST['email'])){
	if($_POST['email'] != ""){
		$correo = $_POST['email'];
	}
}
if(isset($_POST['contrasena'])){
	if($_POST['contrasena'] != ""){
		$passw = $_POST['contrasena'];
	}
}

$query = "";
if($nombre != "" && $correo != "" && $passw != ""){
$query= "INSERT INTO \"orquestador\".\"usuario\" (\"usuario"."_nombre\",\"usuario"."_correo\",\"usuario"."_contrasena\")
		VALUES ('$nombre','$correo','$passw') ";

echo $query;
$conn_resource = db2_connect($conn_string, '', '');
		if ($conn_resource) {
		 	$resp = db2_prepare($conn_resource, $query);
			 if($resp){
			 	$result = db2_exec($conn_resource, $query);
				 if ($result) {
				 	escribir("Usuario", $_SESSION['u'] ." ". $query);
					 $tmp = 1;
				 }else{
				 	escribir("Err_Usuario", $_SESSION['u'] ." ". $query);
				 	echo db2_stmt_errormsg();
				 }
			 }
		}
}
		

if($tmp == 0){
	$extra = "crear_usuario.php?ok=0";
	header("Location: http://$host/orquestador/usuario/".$extra);
}else{
	$extra = "crear_usuario.php?ok=1";
	header("Location: http://$host/orquestador/usuario/".$extra);
}



?>