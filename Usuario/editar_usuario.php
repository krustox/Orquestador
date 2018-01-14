<?php
session_start();
include('../Config/connection.php');
include('../Config/mysql.php');
include('../Functions/Function.php');
include('../Functions/Archivo.php');
if(isset($_SESSION['u'])){
	verify($_SESSION['u'], session_id(), getRealIP(),$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);

include('../success.php');

$id = $_GET['id'];
$query = "SELECT * FROM \"orquestador\".\"usuario\" WHERE \"usuario_id\" = $id";
$data = LeerDatosDB($conn_string, "", "", $query);
$nombre = $data[0][1];
$correo = $data[0][2];
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('../head.php');?>
	<body>
		<div id="wrapper">
			<?php include('../header.php');?>
			<div id="container">
				<h2>Editar Usuario</h2>
				<div id="users" class="formularios">
					<form action="editusuario.php" method="post">
							<label>Nombre: <?php echo $nombre;?></label>
							<input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>" />
							<label>Correo: <?php echo $correo;?></label>
							<input type="email" id="email" name="email" value="<?php echo $correo;?>"/>
							<label>Contraseña</label>
							<input type="password" id="contrasena" name="contrasena" />
							<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
							<input type="submit" value="Editar Usuario" />
					</form>
					<a href="crear_usuario.php">Regresar</a>
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