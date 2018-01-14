<header>
	<h1>Orquestador</h1>
	<?php
	if(isset($_SESSION['u'])){
		
	?>
		<p><?php echo $_SESSION['nombre']; ?></p><a onclick="logout()">Cerrar Sesion</a>
	<?php
	}
	?>
</header>
<nav>
	<ul>
		<?php
	if(isset($_SESSION['u'])){
		if($_SESSION['nombre'] == "Diego Arbelaez" || $_SESSION['nombre'] == "banco\montivoli" || $_SESSION['nombre'] == "banco\\rfadul"){
			?>
		<li><a href="/Orquestador/Usuario/crear_usuario.php"> Usuarios</a></li>
		<li><a href="/Orquestador/tabla.php"> Reglas </a></li>
		<li><a href="/Orquestador/ServicioM/crear_servicio.php"> Servicios Monitoreados</a></li>
		<?php
		}else{
			?>
		<li><a href="/Orquestador/tabla.php"> Reglas </a></li>
		<?php
		}
	}
	?>
	</ul>
</nav>
