<?php  
 require_once("Rest.php");
 include("Archivo.php");
  
 class Api extends Rest {
	private $_conn = NULL;  
   	private $_metodo;  
   	private $_argumentos;  
   	public function __construct() {  
    	 parent::__construct(); 
		 //echo $this->_conn; 
     	$this->conectarDB();  
   	}  
   private function conectarDB() {
	// echo $this->_conn;
   }  
   private function devolverError($id) {  
     $errores = array(  
       array('estado' => "error", "msg" => "petición no encontrada"),  
       array('estado' => "error", "msg" => "petición no aceptada"),  
       array('estado' => "error", "msg" => "petición sin contenido"),
       array('estado' => "error", "msg" => "respuesta sin datos")
     );  
     return $errores[$id];  
   }  
   public function procesarLLamada() {  
     if (isset($_REQUEST['url'])) {  
       //si por ejemplo pasamos explode('/','////controller///method////args///') el resultado es un array con elem vacios;
       //Array ( [0] => [1] => [2] => [3] => [4] => controller [5] => [6] => [7] => method [8] => [9] => [10] => [11] => args [12] => [13] => [14] => )
       $url = explode('/', trim($_REQUEST['url']));  
       //con array_filter() filtramos elementos de un array pasando función callback, que es opcional.
       //si no le pasamos función callback, los elementos false o vacios del array serán borrados 
       //por lo tanto la entre la anterior función (explode) y esta eliminamos los '/' sobrantes de la URL
       $url = array_filter($url);
       $this->_metodo = strtolower(array_shift($url));  
       $this->_argumentos = $url;  
       $func = $this->_metodo;  
       if ((int) method_exists($this, $func) > 0) {  
         if (count($this->_argumentos) > 0) {  
           call_user_func_array(array($this, $this->_metodo), $this->_argumentos);  
         } else {//si no lo llamamos sin argumentos, al metodo del controlador  
           call_user_func(array($this, $this->_metodo));  
         }  
       }  
       else  
         $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);  
     }  
     $this->mostrarRespuesta($this->convertirJson($this->devolverError(0)), 404);  
   }  
   private function convertirJson($data) {  
     return json_encode($data);  
   }  
   
   private function destinatarios() {  
     /*if ($_SERVER['REQUEST_METHOD'] != "POST") {  
       $this->mostrarRespuesta($this->convertirJson($this->devolverError(1)), 405);  
     } */
     escribir("url", $_SERVER['REQUEST_URI']);
     $mb="NO";
     if (isset($this->datosPeticion['servicio'], $this->datosPeticion['severidad'])) {  
    //el constructor del padre ya se encarga de sanear los datos de entrada  
       $servicio = $this->datosPeticion['servicio'];
	   $table[0]="servicio";
	   $valor[0]=$servicio;
	   if(isset($this->datosPeticion['tipo'])){
	   		$tipo = $this->datosPeticion['tipo'];
		   	$table[1] = "tipo";
			$valor[1] = $tipo;
		   	$j=2;
	   		if($tipo == "Infraestructura"){	
	   			if(isset($this->datosPeticion['subservicio'])){$subservicio = $this->datosPeticion['subservicio'];
	   			$table[$j]="subservicio";$valor[$j] = $subservicio;$j=$j+1;} 
	   			if(isset($this->datosPeticion['site'])){$site = $this->datosPeticion['site'];
				$table[$j]="site";$valor[$j] = $site;$j=$j+1;}
	   			if(isset($this->datosPeticion['componente'])){$componente = $this->datosPeticion['componente']; 
	   			$table[$j]="componente";$valor[$j] = $componente;$j=$j+1;}
	   			if(isset($this->datosPeticion['subcomponente'])){$subcomponente = $this->datosPeticion['subcomponente']; 
	   			$table[$j]="subcomponente";$valor[$j] = $subcomponente;$j=$j+1;}
	   			if(isset($this->datosPeticion['elemento'])){$elemento = $this->datosPeticion['elemento']; 
	   			$table[$j]="elemento";$valor[$j] = $elemento;$j=$j+1;}
	   			if(isset($this->datosPeticion['variable'])){$variable = $this->datosPeticion['variable']; 
	   			$table[$j]="variable";$valor[$j] = $variable;$j=$j+1;}
	   		} else if ($tipo == "Experiencia Usuaria"){
	   			if(isset($this->datosPeticion['agrupacion']) && $this->datosPeticion['agrupacion'] != "N/A" ){$agrupacion = $this->datosPeticion['agrupacion']; 
	   			$table[$j]="agrupacion";$valor[$j] = $agrupacion;$j=$j+1;}
	   			if(isset($this->datosPeticion['segmento']) && $this->datosPeticion['segmento'] != "N/A" && isset($agrupacion)){$segmento = $this->datosPeticion['segmento']; 
	   			$table[$j]="segmento";$valor[$j] = $segmento;$j=$j+1;}
	   			if(isset($this->datosPeticion['producto']) && $this->datosPeticion['producto'] != "N/A" && isset($segmento)){$producto = $this->datosPeticion['producto']; 
	   			$table[$j]="producto";$valor[$j] = $producto;$j=$j+1;}
	   			if(isset($this->datosPeticion['transaccion']) && $this->datosPeticion['transaccion'] != "N/A" && isset($producto)){$transaccion = $this->datosPeticion['transaccion']; 
	   			$table[$j]="transaccion";$valor[$j] = $transaccion;$j=$j+1;}
	   			if(isset($this->datosPeticion['operacion']) && $this->datosPeticion['operacion'] != "N/A" && isset($transaccion)){$operacion = $this->datosPeticion['operacion'];
	   			$table[$j]="operacion";$valor[$j] = $operacion;$j=$j+1;}
	   			if(isset($this->datosPeticion['variable']) && $this->datosPeticion['variable'] != "N/A" && isset($operacion)){$variable_eu = $this->datosPeticion['variable'];
	   			$table[$j]="variable";$valor[$j] = $variable_eu;$j=$j+1;}
	   		}
	   }
       $severidad = $this->datosPeticion['severidad']; 
       if (!empty($servicio) and !empty($severidad)) {  
           //consulta preparada ya hace mysqli_real_escape()
           /*$db_name = 'SERVICI'; 
 			$usr_name = 'db2admin'; 
 			$password = 'da.900619.'; 
 			$hostname = 'localhost'; 
 			$port = 50000;*/ 
			$db_name = 'SERVICIO'; 
 			$usr_name = 'db2inst1'; 
 			$password = 'tivolitivoli'; 
 			$hostname = '167.28.131.172'; 
			$port = 50000;
           $conn_string = "DRIVER={IBM DB2 ODBC DRIVER};DATABASE=$db_name;HOSTNAME=$hostname;PORT=$port;PROTOCOL=TCPIP;UID=$usr_name;PWD=$password;";
		   $host  = $_SERVER['HTTP_HOST'];
 			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$query = "SELECT \"servicio_id\",\"servicio_para\",\"servicio_cc\",\"servicio_marchablanca\",\"servicio_marchablancatxt\"  FROM \"orquestador\".\"servicio\" WHERE 
						\"servicio_nombre\" = '$servicio' AND \"servicio_severidad\" = $severidad";   
     		$conn_resource = db2_connect($conn_string, '', '');  
           if ($conn_resource) {
           		$p="";
           		$c="";
			   	$i=0;
			   	$table_len = sizeof($table);
				//echo $table[6]. " ".$table_len;
           		while ($i < $table_len){
           			if($i != 0){
           				$tmp = $i-1;
						//echo $query;
           				$query = "SELECT \"$table[$i]"."_id\", \"$table[$i]"."_para\", \"$table[$i]"."_cc\",\"$table[$i]"."_marchablanca\", \"$table[$i]"."_$table[$tmp]\",\"$table[$i]"."_marchablancatxt\" 
           				FROM \"orquestador\".\"$table[$i]\" WHERE \"$table[$i]"."_nombre\" = '$valor[$i]' 
								 AND \"$table[$i]"."_severidad\" = $severidad AND \"$table[$i]"."_$table[$tmp]\" = $id";
           			}
					escribir("query",$query);
           			$resp = db2_prepare($conn_resource, $query);
			   		if($resp){
			 			$result = db2_exec($conn_resource, $query );
						if ($result) {
           		  			while ($row = db2_fetch_array($result)) {			
								if($row[3] != 1){
									//echo $row[0];
									if(($row[1] != " " || $row[2] != " ") && ($row[1] != "" || $row[2] != "")){
										$p = $p . $row[1] . ",";
										$c = $c . $row[2] . ",";
										$tablaf = $table[$i];
									}
									$id = $row[0];
								}else{
									$p = $row[5];
									$c = "mperez18@externos.bancoestado.cl,rfadul@externos.bancoestado.cl";
									$tablaf = $table[$i];
									$mb = "SI";
									break;
								}
							}
							if(!isset($id) && $mb !="SI"){
								$p="";
								$c="";
								break;
							}							
						}
				   }
					$i = $i+1;
					if($mb == "SI"){
						break;
					}
				}	
				if($p != "" || $c != ""){
					//$p = substr($p, 0,-1);
					//$c = substr($c, 0,-1);
					$respuesta['estado'] = 'correcto';
					$respuesta['tabla'] = $tablaf ;
					$respuesta['marcha_blanca'] = $mb;
					$respuesta['para']=$p;
					$respuesta['cc']=$c;	
             		$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
             	}else{
             		$respuesta['estado'] = 'No Encontrado';
					$respuesta['tabla'] = "-" ;
					$respuesta['marcha_blanca'] = "-";
					$respuesta['para']="";
					$respuesta['cc']="";
             		$this->mostrarRespuesta($this->convertirJson($respuesta), 200);
             	}
				db2_close($conn_resource);
           	}
		  }    
       }  
     $this->mostrarRespuesta($this->convertirJson($this->devolverError(2)), 400);  
  }    
 }  
 $api = new Api();  
 $api->procesarLLamada();
 
 //http://localhost/ConsultaOrquestador/Api.php?url=destinatarios&servicio=AIC&severidad=5