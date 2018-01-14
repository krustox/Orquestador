<?php
    include('../Config/connection.php');

$agrupacion = $_GET['agrupacion'];
$result = array();
$query= "Select * from \"servicios\".\"segmento\" where \"nombre_agrupacion\" = '$agrupacion'";
$conn_resource = db2_connect($conn_string, '', '');
if ($conn_resource) {
	$resp = db2_prepare($conn_resource, $query);
	if($resp){
	 	$result = db2_exec($conn_resource, $query	);
		if ($result) {
			if(!isset($_GET["u"])){
				echo "<option value=\" \" ></option>";
			}
			while ($row = db2_fetch_array($result)) {
				if(isset($_GET["u"])){
					echo "<p onclick=\"producto('$row[1]','$row[2]')\">".$row[2]."</p>";
				}else{
   					echo "<option value=\"".$row[1].",".$row[2]."\">".$row[2]."</option>";
				} 
			}
		}else{
			echo db2_stmt_errormsg();
		}
    }
}
db2_close($conn_resource);
?>