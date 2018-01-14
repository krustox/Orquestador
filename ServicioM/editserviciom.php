<?php  
session_start();
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');

$nombre = "";
$nombreant = "";
$tmp = 0;

if(isset($_POST['nombre'])){
	if($_POST['nombre'] != ""){
		$nombre = $_POST['nombre'];
	}
}
if(isset($_POST['nombreant'])){
	if($_POST['nombreant'] != ""){
		$nombreant = $_POST['nombreant'];
	}
}

if($nombreant != ""){
	$query = "SELECT count(*) FROM \"SERVICIOS_MONITOREO\".\"Servicio_Monitoreado\" WHERE \"Servicio_Monitoreado\" = '$nombreant' ";
	
	echo $query;
$conn_resource = db2_connect($conn_string, '', '');
		if ($conn_resource) {
		 	$resp = db2_prepare($conn_resource, $query);
			 if($resp){
			 	$result = db2_exec($conn_resource, $query);
				 if ($result) {
				 	$row = db2_fetch_array($result);
					if($row[0] == 1){
						$query= "UPDATE \"SERVICIOS_MONITOREO\".\"Servicio_Monitoreado\" SET \"Servicio_Monitoreado\" = '$nombre' WHERE \"Servicio_Monitoreado\" = '$nombreant' ";
						$resp = db2_prepare($conn_resource, $query);
			 			if($resp){
			 				$result = db2_exec($conn_resource, $query);
				 			if ($result) {
				 				escribir("Update", $_SESSION['u'] ." ". $query);
					 			$tmp = 1;
				 			}else{
				 				escribir("Err_update", $_SESSION['u'] ." ". $query);
				 				echo db2_stmt_errormsg();
				 			}
			 			}
					}
				}
			}
		}
}


if($tmp == 0){
	$extra = "crear_servicio.php?ok=0";
	header("Location: http://$host/orquestador/ServicioM/".$extra);
}else{
	$extra = "crear_servicio.php?ok=1";
	header("Location: http://$host/orquestador/ServicioM/".$extra);
}



?>