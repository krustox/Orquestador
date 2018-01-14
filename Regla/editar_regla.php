<?php
session_start();
include('../Config/connection.php');
include('../Config/mysql.php');
include('../Functions/Function.php');
include('../Functions/Archivo.php');
if(isset($_SESSION['u'])){
	verify($_SESSION['u'], session_id(), getRealIP(),$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);


$id = $_GET['id'];
$tabla = $_GET['tabla'];
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('../head.php');?>
	<body>
		<div id="wrapper">
			<?php include('../header.php');?>
			<div id="container">
				<h2>Crear Regla</h2>
				<div class="formularios">
					<form action="editregla.php" method="post">
						<?php
							$query = "SELECT \"$tabla"."_severidad\",\"$tabla"."_para\",\"$tabla"."_cc\",\"$tabla"."_marchablanca\",\"$tabla"."_marchablancatxt\" FROM \"orquestador\".\"$tabla\" WHERE \"$tabla"."_id\"=$id "; 
							$data=LeerDatosDB($conn_string, "","", $query);
							switch($data[0][0]){
								case 2: $severidad="Informacional";break;
								case 3: $severidad="Minor";break;
								case 4: $severidad="Warning";break;
								case 5: $severidad="Critico";break;
							}
							$para = $data[0][1];
							$cc = $data[0][2];
							if($data[0][3] == 0){$marcha="No";$marchatxt=$marchatxt=$data[0][4];}else{$marcha="Si";$marchatxt=$data[0][4];};
						?>
						
						<label>Severidad: <b><?php echo $severidad;?></b></label>
						<br />
						<label>Para:</label>
						<textarea type="text" name="para" id="para" ><?php echo $para;?></textarea>
						<label>Copia:</label>
						<textarea type="text" name="cc" id="cc"><?php echo $cc;?></textarea>
						<label>Marcha Blanca:</label>
						<div class="slideThree">
							<input type="checkbox" name="marcha" id="marcha"/>
							<label for="marcha"></label>
						</div>
						<label class="hide" id="marchatxtl">Marcha Blanca:</label>
						<textarea class="hide" name="marchatxt" id="marchatxt"><?php echo $marchatxt;?></textarea>
						<input type="hidden" value="<?php echo $id;?>" id="id" name="id"/>
						<input type="hidden" value="<?php echo $tabla;?>" id="tabla" name="tabla"/>
						<input type="submit" value="Guardar" />
					</form>
					<a href="../tabla.php">Regresar</a>
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