<?php
include('../Config/mysql.php');
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');
include('../Functions/ldap.php');

session_start();
$user = $_POST['user'];
$contra = $_POST['pass'];
if($contra == ""){
	$contra = "xxx   xxx";
}
if(substr($user, 0,5) != "banco" && $user != "darbelaez@wisevisioncorp.com" && $user != "rfadul@wisevisioncorp.com")
{
	$user = "banco\\".$user;
	//echo $user;
}

if( $user == "banco\jfiguer" || $user == "banco\montivoli" ||
$user == "darbelaez@wisevisioncorp.com" || $user == "rfadul@wisevisioncorp.com" ){

if(strpos($user,"banco") === FALSE ){
	$query = "SELECT * FROM \"orquestador\".\"usuario\" WHERE \"usuario_correo\" = '$user' AND \"usuario_contrasena\" = '$contra' ";
	$data = LeerDatosDB($conn_string, "", "", $query);
	echo $data[0][0];
	$ip = getRealIP();
	if($data[0][0] == 1 || $data[0][0] == 22){
		echo "Login OK";
		$ip = getRealIP();
		$session = session_id();
		$conecta = new mysqli($dbhost, $dbusuario, $dbpassword,$db,$dbport);
		if($conecta->connect_error){echo $conecta->connect_error;}else{
			$result = $conecta->query("SELECT count(*) FROM usuario WHERE nombre = '$user'");
			$row = $result->fetch_array(MYSQLI_NUM);
			if($row[0]>0){
				if($conecta->query("UPDATE usuario SET sesion_id = '$session',ip='$ip' WHERE nombre = '$user';") == TRUE)
					{escribir("login", "Inicio Sesión: (Cierra Sesion preexistente) " . $user." ". $session);}else{echo $conecta->error;}	
			}else{
				if($conecta->query("INSERT INTO usuario (nombre,sesion_id,ip) VALUES ('$user','$session','$ip')") == TRUE)
					{escribir("login", "Inicio Sesión: (Sesion Nueva) " . $data[0][0]." ". $session);}else{echo $conecta->error;}		
			}
		}
		$_SESSION['id']=$data[0][0];
		$_SESSION['u']=$data[0][2];
		$_SESSION['nombre']=$data[0][1];
		$_SESSION['ip']=$ip;
		escribir("login", "Inicio Sesión: " . $data[0][0] . " " . $data[0][1]);
		header("Location: http://$host/orquestador/tabla.php");
	}else{
		//echo $user ." ".$contra;
		header("Location: http://$host/orquestador/index.php?ok=0");
	}
}else{
	if(login($user, $contra)){
		$ip = getRealIP();
		$session = session_id();
		$conecta = new mysqli($dbhost, $dbusuario, $dbpassword,$db,$dbport);
		if($conecta->connect_error){echo $conecta->connect_error;}else{
			$result = $conecta->query("SELECT count(*) FROM usuario WHERE nombre = '$user'");
			$row = $result->fetch_array(MYSQLI_NUM);
			if($row[0]>0){
				if($conecta->query("UPDATE usuario SET sesion_id = '$session',ip='$ip' WHERE nombre = '$user';") == TRUE)
					{escribir("login", "Inicio Sesión: (Cierra Sesion preexistente) " . $user." ". $session . " ldap");}else{echo $conecta->error;}	
			}else{
				if($conecta->query("INSERT INTO usuario (nombre,sesion_id,ip) VALUES ('$user','$session','$ip')") == TRUE)
					{escribir("login", "Inicio Sesión: (Sesion Nueva) " . $user." ". $session . " ldap");}else{echo $conecta->error;}		
			}
		}
		$_SESSION['u'] = 'ldap '.$user;
		$_SESSION['nombre'] = $user;
		$_SESSION['ip'] = $ip;
		//escribir("login", "Inicio Sesión: " . $user . " ldap");
		header("Location: http://$host/orquestador/tabla.php");
	}else{
		echo "Hay un error en la informacion del usuario";
		escribir("login_err", $user . " No pudo ingresar");
		header("Location: http://$host/orquestador/index.php?ok=0");
	}
}
}else{
	//echo "Usuario no autorizado";
	escribir("login_err", $user . " Usuario no Autorizado");
	header("Location: http://$host/orquestador/index.php?ok=1");
}

?>