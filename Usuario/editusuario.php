<?php  
session_start();
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');

$nombre = "";
$correo = "";
$passw = "";
$id = "";
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
if(isset($_POST['id'])){
	if($_POST['id'] != ""){
		$id = $_POST['id'];
	}
}

$query = "";
if($nombre != "" && $correo != "" && $passw != ""){
	
$query= "UPDATE \"orquestador\".\"usuario\" SET \"usuario_nombre\" = '$nombre',\"usuario_correo\" = '$correo',\"usuario_contrasena\" = '$passw'
		WHERE \"usuario_id\" = $id ";

echo $query;
$conn_resource = db2_connect($conn_string, '', '');
		if ($conn_resource) {
		 	$resp = db2_prepare($conn_resource, $query);
			 if($resp){
			 	$result = db2_exec($conn_resource, $query);
				 if ($result) {
				 	escribir("Update", $_SESSION['u'] ." ". $query);
					 $tmp = 1;
				 }else{
				 	escribir("Err_Update", $_SESSION['u'] ." ". $query);
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