<?php
session_start();
include('../Config/connection.php');
include('../Config/mysql.php');
include('../Functions/Function.php');
include('../Functions/Archivo.php');
if(isset($_SESSION['u'])){
	verify($_SESSION['u'], session_id(), getRealIP(),$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);

include('../success.php');

$nombre = $_GET['nombre'];
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('../head.php');?>
	<body>
		<div id="wrapper">
			<?php include('../header.php');?>
			<div id="container">
				<h2>Editar Servicio Monitoreado</h2>
				<h3><?php echo $nombre;?></h3>
				<div id="users" class="formularios">
					<form action="editserviciom.php" method="post">
							<label>Nombre del Servicio</label>
							<input type="text" id="nombre" name="nombre" />
							<input type="hidden" id="nombreant" name="nombreant" value="<?php echo $nombre; ?>" />
							<input type="submit" value="Editar Servicio" />
					</form>
					<a href="crear_servicio.php">Regresar</a>
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