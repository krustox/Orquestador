<?php
session_start();
include('../Config/connection.php');
include('../Config/mysql.php');
include('../Functions/Function.php');
include('../Functions/Archivo.php');
if(isset($_SESSION['u'])){
	verify($_SESSION['u'], session_id(), getRealIP(),$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);

include('../success.php');

$query = "SELECT * FROM \"SERVICIOS_MONITOREO\".\"Servicio_Monitoreado\" ";
$data=LeerDatosDB($conn_string,"","",$query);
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('../head.php');?>
	<body>
		<div id="wrapper">
			<?php include('../header.php');?>
			<div id="container">
				<h2>Crear Servicio Monitoreado</h2>
				<div id="users" class="formularios">
					<form action="newserviciom.php" method="post">
							<label>Nombre del Servicio</label>
							<input type="text" id="nombre" name="nombre" />
							<input type="submit" value="Crear Servicio" />
					</form>
					<a href="../tabla.php">Regresar</a>
				</div>
				<div id="serviciom" name="serviciom">
					<table id="table">
						<thead>
							<tr>
								<th>Nombre del Servicio Monitoreado</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nombre del Servicio Monitoreado</th>
								<th>Acción</th>
							</tr>
						</tfoot>
						<tbody>
							<?php EscribirDatosHTML($data, "tabla2") ?>			
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php include('../footer.php');?>
	</body>
</html>
<?php 
}else{
	header("Location: http://$host/orquestador/");	
}
?>