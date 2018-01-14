<?php  
session_start();
include('../Config/connection.php');
include('../Functions/Archivo.php');
include('../Functions/Function.php');

$tabla = "";
$servicio = "";
$tipo = "";
$subservicio = "";
$site = "";
$componente = "";
$subcomponente = "";
$servidor = "";
$variable = "";
$agrupacion = "";
$segmento = "";
$producto = "";
$transaccion = "";
$operacion = "";
$variable_eu = "";
$marchatxt = "";

if(isset($_POST['servicio'])){
	if($_POST['servicio'] != " "){
		$servicio = explode(",",$_POST['servicio'])[1];
		$tabla = "servicio";
	}
}
if(isset($_POST['tipo'])){
	if($_POST['tipo'] != " "){
		$tipo =explode(",",$_POST['tipo'])[1];
		$tabla = "tipo";
	}
}
if(isset($_POST['subservicio'])){
	if($_POST['subservicio'] != " "){
		$subservicio =explode(",",$_POST['subservicio'])[1];
		$tabla = "subservicio";
	}
}

if(isset($_POST['site'])){
	if($_POST['site'] != " "){
		$site =explode(",",$_POST['site'])[1];
		$tabla = "site";
	}
}
if(isset($_POST['componente'])){
	if($_POST['componente'] != " "){
		$componente =explode(",",$_POST['componente'])[1];
		$tabla = "componente";
	}
}
if(isset($_POST['subcomponente'])){
	if($_POST['subcomponente'] != " "){
		$subcomponente =explode(",",$_POST['subcomponente'])[1];
		$tabla = "subcomponente";
	}
}

if(isset($_POST['servidor'])){
	if($_POST['servidor'] != " "){
		$servidor =explode(",",$_POST['servidor'])[1];
		$tabla = "elemento";
	}
}

if(isset($_POST['variableinfra'])){
	if($_POST['variableinfra'] != " "){
		if(isset($_POST['variable'])){
			$variable = $_POST['variableinfra'] . " ". $_POST['variable'];
		}else{
			$variable = $_POST['variableinfra'];
		}
		$tabla = "variable";
	}
}

if(isset($_POST['agrupacion'])){
	if($_POST['agrupacion'] != " "){
		$agrupacion =explode(",",$_POST['agrupacion'])[1];
		$tabla = "agrupacion";
	}
}

if(isset($_POST['segmento'])){
	if($_POST['segmento'] != " "){
		$segmento =explode(",",$_POST['segmento'])[1];
		$tabla = "segmento";
	}
}

if(isset($_POST['producto'])){
	if($_POST['producto'] != " "){
		$producto =explode(",",$_POST['producto'])[1];
		$tabla = "producto";
	}
}

if(isset($_POST['transaccion'])){
	if($_POST['transaccion'] != " "){
		$transaccion =explode(",",$_POST['transaccion'])[1];
		$tabla = "transaccion";
	}
}

if(isset($_POST['operacion'])){
	if($_POST['operacion'] != " "){
		$operacion =explode(",",$_POST['operacion'])[1];
		$tabla = "operacion";
	}
}
if(isset($_POST['variableeu'])){
	if($_POST['variableeu'] != " "){
		if(isset($_POST['variableu'])){
			$variable_eu = $_POST['variableeu'] . " ". $_POST['variableu'];
		}else{
			$variable_eu = $_POST['variableeu'];
		}
		$tabla = "variable_eu";
	}
}

if(isset($_POST['severidad'])){
	$severidad = $_POST['severidad'];
}
if(isset($_POST['para'])){
	$para = $_POST['para'];
}
if(isset($_POST['cc'])){
	$cc = $_POST['cc'];
}
$marcha = "0";
if(isset($_POST['marcha'])){
	$marcha = "1";
	if(isset($_POST['marchatxt'])){
		$marchatxt = $_POST['marchatxt'];
	}
}
$val = array();
$camp = array();

if($tipo != ""){
	if($tipo == "Infraestructura"){
		$val = [$servicio,$tipo,$subservicio,$site,$componente,$subcomponente,$servidor,$variable];
		$camp = ["servicio","tipo","subservicio","site","componente","subcomponente","elemento","variable"];
	}else{
		$val = [$servicio,$tipo,$agrupacion,$segmento,$producto,$transaccion,$operacion,$variable_eu];
		$camp = ["servicio","tipo","agrupacion","segmento","producto","transaccion","operacion","variable_eu"];
	}
}
escribir("tabla", $_SESSION['u'] . "$tabla;$servicio;$tipo;$subservicio");
$tmp = Exists("servicio", $conn_string, $servicio,$severidad,"");
if($tmp == 0){
	if($tabla == "servicio"){
		$tmp = insert("servicio", $conn_string,"$servicio;$severidad;$para;$cc;$marcha;$marchatxt");
		escribir("insertar", $_SESSION['u'] . " $servicio;$severidad;$para;$cc;$marcha;$marchatxt");
	}else{
		$ant = insert("servicio", $conn_string,"$servicio;$severidad; ; ;0; ");
	}
}else{$ant = $tmp; $tmp = 0;}
$i = 1;
$val_len = sizeof($val);
while($i<$val_len){
	if($val[$i] != ""){
		echo $camp[$i]." ".$val[$i] ;
		$tmp = Exists($camp[$i], $conn_string, $val[$i], $severidad,$camp[$i-1].",".$ant);
		if($tmp == 0){
			if($tabla == $camp[$i]){
				$tmp = insert($camp[$i], $conn_string,"$val[$i];$severidad;$para;$cc;$marcha;$marchatxt;$ant");
				escribir("insertar", $_SESSION['u'] . " ". $camp[$i] ." $val[$i];$severidad;$para;$cc;$marcha;$marchatxt;$ant");
				break;
			}else{
				$ant = insert($camp[$i], $conn_string,"$val[$i];$severidad; ; ;0; ;$ant ");
				$tmp = 0;
			}
		}else{$ant = $tmp; $tmp = 0;}
	}
	$i = $i + 1;
}

if($tmp == 0){
	$extra = "tabla.php?ok=0";
	header("Location: http://$host/orquestador/".$extra);
}else{
	$extra = "tabla.php?ok=1";
	header("Location: http://$host/orquestador/".$extra);
}

?>

