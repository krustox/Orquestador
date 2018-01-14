<?php
//Hace consulta Select y guarda en un [][]
function LeerDatosDB($conn_string,$esquema,$tabla,$query){
	$conn_resource = db2_connect($conn_string, '', '');
	if ($conn_resource) {
		if($query ==""){
			$query= "Select * from \"$esquema\".\"$tabla\"";
		}
		if ($conn_resource) {
				 	$resp = db2_prepare($conn_resource, $query);
					 if($resp){
					 	$result = db2_exec($conn_resource, $query);
						 if ($result) {
						 	$data = array();
							 $i=0;
						 	while ($row = db2_fetch_array($result)) {
						 		$length = sizeof($row);
								$j=0;
								$data[$i] = array();
								while ( $length > 0){
						 			$length = $length - 1;
						 			$data[$i][$j]= $row[$j];
									$j = $j+1;
								}
								$i=$i+1;
						 	}
						 }else{
						 	echo db2_stmt_errormsg();
						 }
						 return $data;
					 }
		}
	}
}

//Escribe datos en tabla o en <option>....</option>
function EscribirDatosHTML($data, $forma){
	$length = sizeof($data);
	$width = 100/($length+1);
	if($forma == "tabla"){
		$j=0;
		while ($length > 0){
			$length = $length -1;
			$data_sub = $data[$j];
			$datasub_length = sizeof($data_sub);
			$i = 1;
			?><tr><?php
			while ($datasub_length > 1) {
				$datasub_length = $datasub_length-1;
				if(strpos($data_sub[$i], '@')){
					?><td onclick="display(<?php echo "'$data_sub[$i]'"; ?>)" class="text"> <?php
				}else{
					?><td><?php
				}
				$print = "";
				if(strpos($data_sub[$i], '@')){
					$print = str_replace("@externos.bancoestado.cl", "", $data_sub[$i]);
					$print = str_replace("@bancoestado.cl", "", $print);
				}else if($datasub_length == 1){
					if($data_sub[$i] == "" || $data_sub[$i] == " "){$print = "No";}else{$print = $data_sub[$i];}
				}else{
					switch($data_sub[$i]){
						case 2:
							$print = "Informacional";
							break;
						case 3:
							$print = "Minor";
							break;
						case 4:
							$print = "Warning";
							break;
						case 5:
							$print = "Critico";
							break;
						default:
							$print=$data_sub[$i];
							break;
					}
					
				}
				echo $print;
				?></td><?php
				$i = $i+1;
			}
			?>
			<td><?php 
			$editelim = explode(",", $data_sub[0]);
			
			echo "<a href=\"Regla/editar_regla.php?tabla=$editelim[1]&id=$editelim[0]\"\">Editar</a>"." "."<a onclick=\"eliminar($editelim[0],'$editelim[1]')\">Eliminar</a>"; ?></td>
			</tr><?php
			$j=$j+1;
		}
	}else if ($forma == "tabla2"){
		$j=0;
		while ($length > 0 ){
			$length = $length -1;
			$nombre =$data[$j][0];
			?><tr>
				<td>
				<?php echo $nombre; ?> 
				</td>
				<td>
				<?php echo "<a href=\"editar_servicio.php?nombre=$nombre\"\">Editar</a>"." "."<a onclick=\"eliminarServ('$nombre')\">Eliminar</a>"; ?>	
				</td>
			</tr><?php
			$j=$j+1;
		}
	}else if ($forma == "tabla3"){
		$j=0;
		while ($length > 0 ){
			$length = $length -1;
			$id =$data[$j][0];
			$nombre =$data[$j][1];
			$correo =$data[$j][2];
			?><tr>
				<td>
				<?php echo $nombre; ?> 
				</td>
				<td>
				<?php echo $correo; ?> 
				</td>
				<td>
				<?php echo "<a href=\"editar_usuario.php?id=$id\"\">Editar</a>"." "."<a onclick=\"eliminarUser($id)\">Eliminar</a>"; ?>	
				</td>
			</tr><?php
			$j=$j+1;
		}
	}else if ($forma == "opt"){
		$j=0;
		while ($length > 0 ){
			$length = $length -1;
			?><option value="<?php echo $data[$j][1].",".$data[$j][2]; ?>"><?php echo $data[$j][2] . " ----Arbol----"; ?></option><?php
			$j=$j+1;
		}
	}else if ($forma == "opt2"){
		$j=0;
		while ($length > 0 ){
			$length = $length -1;
			
			?><option value="<?php echo $data[$j][0] ; ?>"><?php echo $data[$j][0]; ?></option><?php
			$j=$j+1;
		}
	}else if ($forma == "opt3"){
		$j=0;
		while ($length > 0 ){
			$length = $length -1;
			
			?><option value="<?php echo $data[$j][0].",".$data[$j][0] ; ?>"><?php echo $data[$j][0]; ?></option><?php
			$j=$j+1;
		}
	}
}

//Elimina datos según query enviada
function ejecutarDelete($query, $conn_string){
	$conn_resource = db2_connect($conn_string, '', '');
	if ($conn_resource) {
		$resp = db2_prepare($conn_resource, $query);
		if($resp){
	 		$result = db2_exec($conn_resource, $query	);
			if (!$result) {
				escribir("Eliminar", db2_stmt_errormsg());
				return false;
			}else{
				escribir("Eliminar", $query);
				return true;
			}
    	}
	}
	db2_close($conn_resource);
}

//Ejecuta update según query enviada
function ejecutarUpdate($query, $conn_string){
	$conn_resource = db2_connect($conn_string, '', '');
	if ($conn_resource) {
		$resp = db2_prepare($conn_resource, $query);
		if($resp){
	 		$result = db2_exec($conn_resource, $query	);
			if (!$result) {
				escribir("Actualizar", db2_stmt_errormsg());
				return false;
			}else{
				escribir("Actualizar", $query);
				return true;
			}
    	}
	}
	db2_close($conn_resource);
}

//Revisa si un dato existe en una tabla
function Exists($tabla,$conn_string, $valor,$severidad,$tabla_ant){
	$conn_resource = db2_connect($conn_string, '', '');
	if ($conn_resource) {
		$data = "";
		if($tabla_ant != ""){
			$table = explode(",", $tabla_ant);
			$query= "SELECT \"$tabla"."_id\" FROM \"orquestador\".\"$tabla\" WHERE \"$tabla"."_nombre\" = '$valor' 
			AND \"$tabla"."_severidad\" = $severidad AND \"$tabla"."_$table[0]\" = $table[1]";
		}else{
			$query= "SELECT \"$tabla"."_id\" FROM \"orquestador\".\"$tabla\" WHERE \"$tabla"."_nombre\" = '$valor' 
			AND \"$tabla"."_severidad\" = $severidad";
		}
		echo $query;
		if ($conn_resource) {
		 	$resp = db2_prepare($conn_resource, $query);
			 if($resp){
			 	$result = db2_exec($conn_resource, $query);
				 if ($result) {
				 	if($row = db2_fetch_array($result)) {
				 		$data = $row[0];
					}else{
						return 0;
					}
				 }else{
				 	echo db2_stmt_errormsg();
				 }
				 return $data;
			 }
		}
	}
}

//Reliza insert de datos en la tabla valores separado por ;
function insert($tabla,$conn_string,$valores){
	$conn_resource = db2_connect($conn_string, '', '');
	if ($conn_resource) {
		$data = "";
		$valor =  explode(";", $valores);
		if (sizeof($valor) == 7){
			if($tabla == "tipo"){$otro =",\"$tabla"."_servicio\"";$otrov = ",$valor[6]";$val = "servicio,$valor[6]";}
			if($tabla == "subservicio"){$otro =",\"$tabla"."_tipo\"";$otrov = ",$valor[6]";$val = "tipo,$valor[6]";}
			if($tabla == "site"){$otro =",\"$tabla"."_subservicio\"";$otrov = ",$valor[6]";$val = "subservicio,$valor[6]";}
			if($tabla == "componente"){$otro =",\"$tabla"."_site\"";$otrov = ",$valor[6]";$val = "site,$valor[6]";}
			if($tabla == "subcomponente"){$otro =",\"$tabla"."_componente\"";$otrov = ",$valor[6]";$val = "componente,$valor[6]";}
			if($tabla == "elemento"){$otro =",\"$tabla"."_subcomponente\"";$otrov = ",$valor[6]";$val = "subcomponente,$valor[6]";}
			if($tabla == "variable"){$otro =",\"$tabla"."_elemento\"";$otrov = ",$valor[6]";$val = "elemento,$valor[6]";}
			if($tabla == "agrupacion"){$otro =",\"$tabla"."_tipo\"";$otrov = ",$valor[6]";$val = "tipo,$valor[6]";}
			if($tabla == "segmento"){$otro =",\"$tabla"."_agrupacion\"";$otrov = ",$valor[6]";$val = "agrupacion,$valor[6]";}
			if($tabla == "producto"){$otro =",\"$tabla"."_segmento\"";$otrov = ",$valor[6]";$val = "segmento,$valor[6]";}
			if($tabla == "transaccion"){$otro =",\"$tabla"."_producto\"";$otrov = ",$valor[6]";$val = "producto,$valor[6]";}
			if($tabla == "operacion"){$otro =",\"$tabla"."_transaccion\"";$otrov = ",$valor[6]";$val = "transaccion,$valor[6]";}
			if($tabla == "variable_eu"){$otro =",\"$tabla"."_operacion\"";$otrov = ",$valor[6]";$val = "operacion,$valor[6]";}
		}else{
			$otro ="";
			$otrov ="";
			$val = "";
		}
		$query= "INSERT INTO \"orquestador\".\"$tabla\" (\"$tabla"."_nombre\",\"$tabla"."_severidad\",\"$tabla"."_para\",\"$tabla"."_cc\",\"$tabla"."_marchablanca\",\"$tabla"."_marchablancatxt\" $otro ) 
		VALUES ('$valor[0]',$valor[1],'$valor[2]','$valor[3]',$valor[4],'$valor[5]' $otrov ) ";
		echo $query;
		if ($conn_resource) {
		 	$resp = db2_prepare($conn_resource, $query);
			 if($resp){
			 	$result = db2_exec($conn_resource, $query);
				 if ($result) {
				 	escribir("Insertar", $_SESSION['u'] ." ". $query);
				 	$data = Exists($tabla, $conn_string, $valor[0],$valor[1],$val);
				 }else{
				 	echo db2_stmt_errormsg();
				 }
				 return $data;
			 }
		}
	}
}

function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
}

?>
