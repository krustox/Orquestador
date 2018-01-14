use LWP::Simple;
use JSON;
use Data::Dumper;

#variables para consulta Llenar con lo que llega de la alerta
my $servicio ="APPMOBILE PRUEBAS";
my $tipo = "";
my $subservicio = "";my $agrupacion = "";
my $site = "";my $segmento = "";
my $componente = "";my $producto = "";
my $subcomponente = "";my $transaccion = "";
my $elemento = "";my $operacion = "";
my $variable = "";
my $severidad ="5";
my $paraActual = "";
my $ccActual = "";

#preparación de variables url
if($servicio ne ""){$servicio = "&servicio=".$servicio;}
if($tipo ne ""){$tipo = "&tipo=".$tipo;}
if($subservicio ne ""){$subservicio = "&subservicio=".$subservicio;}
if($agrupacion ne ""){$agrupacion = "&agrupacion=".$agrupacion;}
if($site ne ""){$site = "&site=".$site;}
if($segmento ne ""){$segmento = "&segmento=".$segmento;}
if($componente ne ""){$componente = "&componente=".$componente;}
if($producto ne ""){$producto = "&producto=".$producto;}
if($subcomponente ne ""){$subcomponente = "&subcomponente=".$subcomponente;}
if($transaccion ne ""){$transaccion = "&transaccion=".$transaccion;}
if($elemento ne ""){$elemento = "&elemento=".$elemento;}
if($operacion ne ""){$operacion = "&operacion=".$operacion;}
if($variable ne ""){$variable = "&variable=".$variable;}
if($severidad ne ""){$severidad = "&severidad=".$severidad;}


#Consulta REST
my $host = 'VS2K8-MONBDBC01';
#my $host = 'localhost';
my $url = 'http://'.$host.'/ConsultaOrquestador/Api.php?url=destinatarios'.$servicio.$tipo.$subservicio.$site.$componente.$subcomponente.$elemento.
$agrupacion.$segmento.$producto.$transaccion.$operacion.$variable.$severidad;
my $response = get $url;
print "$url\n";
print "$response \n\n";
#Decodificacion de datos
my $text= decode_json($response);

#muestra de datos
#print Dumper($text);
print $text->{'estado'} . "\n";
print $text->{'marcha_blanca'}. "\n";
print $text->{'tabla'}. "\n";
#print $text->{'para'}. "\n";
#print $text->{'cc'}. "\n";

#Convierto en Array para y cc
my @para = split /,/,$text->{'para'};
my @cc = split /,/,$text->{'cc'};
my $para ="";
my $cc ="";

#Concateno los correos agregado '
foreach $correo (@para){
	$para = $para ."'".$correo."',"
}
foreach $correocc (@cc){
	$cc = $cc ."'".$correocc."',"
}

#Quito Caracteres sobrantes
$para =~ s/;//g;
$cc =~ s/;//g;
$para = substr($para,0,-1);
$cc = substr($cc,0,-1);

#Archivo
($seg, $min, $hora, $dia, $mes, $anho, @zape) = localtime(time);
$mes++;
$anho+=1900;
$fecha_actual= "$anho-$mes-$dia $hora:$min:$seg";
if(-e "T:/ac.txt"){
open(Archivo,">>T:/ac.txt");
print Archivo "------------------ \n";
print Archivo $fecha_actual."\n";
print Archivo "url ". $url."\n";
print Archivo "Estado: ".$text->{'estado'} . "\n";
print Archivo "Marcha Blanca: ".$text->{'marcha_blanca'}. "\n";
print Archivo "Tabla: ".$text->{'tabla'}. "\n";
print Archivo "Para: ".$para. "\n";
print Archivo "ParaActual: " . $paraActual."\n";
print Archivo "CC: ".$cc. "\n";
print Archivo "CCActual: " . $ccActual ."\n";
print Archivo "------------------";
close(Archivo);
}else{
open(Archivo,">T:/ac.txt");
print Archivo "------------------ \n";
print Archivo $fecha_actual."\n";
print Archivo "url ". $url."\n";
print Archivo "Estado: ".$text->{'estado'} . "\n";
print Archivo "Marcha Blanca: ".$text->{'marcha_blanca'}. "\n";
print Archivo "Tabla: ".$text->{'tabla'}. "\n";
print Archivo "Para: ".$para. "\n";
print Archivo "ParaActual: " . $paraActual."\n";
print Archivo "CC: ".$cc. "\n";
print Archivo "CCActual: " . $ccActual."\n";
print Archivo "------------------";
close(Archivo);
}
die 'Error getting $url' unless defined $response;
