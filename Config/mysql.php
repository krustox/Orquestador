<?php 
$dbhost ="localhost";
$dbusuario ="root";
$dbpassword ="";
$dbport = 3306;
$db="user_orquestador";

function verify($user,$sesion,$ip,$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host){
	$user = str_replace("ldap ", "", $user);
	$conecta = new mysqli($dbhost, $dbusuario, $dbpassword,$db,$dbport);
	if($conecta->connect_error){echo $conecta->connect_error;}else{
		$result = $conecta->query("SELECT count(*) FROM usuario WHERE nombre = '$user';");
		$row = $result->fetch_array(MYSQLI_NUM);
		if($row[0]>1){
			if($conecta->query("DELETE FROM usuario WHERE nombre = '$user' ;") == TRUE){
				escribir("login", "Cerró Sesión: (TODAS) ".$_SESSION['u']." ".$_SESSION['nombre']." ". $session . " ldap");
				$_SESSION['u'] = null;
				$_SESSION['nombre'] = null;
				$_SESSION['ip'] = null;
				session_unset();
				session_destroy();
				header("Location: http://$host/Orquestador/index.php");
			}else{
				echo $conecta->error;
			}
		}else if($row[0]<1){
			$_SESSION['u'] = null;
			$_SESSION['nombre'] = null;
			$_SESSION['ip'] = null;
			session_unset();
			session_destroy();
			header("Location: http://$host/Orquestador/index.php");
		}else if($row[0]==1){
			$result = $conecta->query("SELECT sesion_id FROM usuario WHERE nombre = '$user';");
			$row = $result->fetch_array(MYSQLI_NUM);
			if($row[0] != $sesion){
				$_SESSION['u'] = null;
				$_SESSION['nombre'] = null;
				$_SESSION['ip'] = null;
				session_unset();
				session_destroy();
				header("Location: http://$host/Orquestador/index.php");
			}
		}
	}
}
?>