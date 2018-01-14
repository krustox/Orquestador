<?php
session_start();
include('../Config/connection.php');
include('../Config/mysql.php');
include('../Functions/Function.php');
include('../Functions/Archivo.php');
if(isset($_SESSION['u'])){
	verify($_SESSION['u'], session_id(), getRealIP(),$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);
include('../success.php');
$query = "SELECT * FROM \"orquestador\".\"usuario\" ";
$data=LeerDatosDB($conn_string,"","",$query);
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('../head.php');?>
	<body>
		<div id="wrapper">
			<?php include('../header.php');?>
			<div id="container">
				<h2>Crear Usuario</h2>
				<div id="users" class="formularios">
					<form action="newusuario.php" method="post">
							<label>Nombre</label>
							<input type="text" id="nombre" name="nombre" />
							<label>Correo</label>
							<input type="email" id="email" name="email" />
							<label>Contraseña</label>
							<input type="password" id="contrasena" name="contrasena" />
							<input type="submit" value="Crear Usuario" />
					</form>
					<a href="../tabla.php">Regresar</a>
				</div>
				<div id="usuarios" name="usuarios">
					<table id="table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Correo</th>
								<th>Acción</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Nombre</th>
								<th>Correo</th>
								<th>Acción</th>
							</tr>
						</tfoot>
						<tbody>
							<?php EscribirDatosHTML($data, "tabla3") ?>			
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