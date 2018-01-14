<?php
session_start();
include('../Config/connection.php');
include('../Config/mysql.php');
include('../Functions/Function.php');
include('../Functions/Archivo.php');
if(isset($_SESSION['u'])){
	verify($_SESSION['u'], session_id(), getRealIP(),$dbhost,$dbusuario,$dbpassword,$db,$dbport,$host);


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
					<form action="newrule.php" method="post">
						<label>Servicio</label>
						<select name="servicio" id="servicio">
							<option value=" ">  </option>
						<?php
						$data=LeerDatosDB($conn_string,"servicios","servicio","");
						EscribirDatosHTML($data, "opt");
						$data = LeerDatosDB($conn_string,"SERVICIOS_MONITOREO","Servicio_Monitoreado","");
						EscribirDatosHTML($data, "opt3");
						?>
						</select>
						<label class="hide" id="tipol">Tipo de Servicio</label>
						<select name="tipo" id="tipo" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="subserviciol">Subservicio</label>
						<select name="subservicio" id="subservicio" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="sitel">Site</label>
						<select name="site" id="site" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="componentel">Componente</label>
						<select name="componente" id="componente" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="subcomponentel">Subcomponente</label>
						<select name="subcomponente" id="subcomponente" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="servidorl" name="servidorl">Servidor</label>
						<select name="servidor" id="servidor" class="hide">
							<option value=" "> </option>
						</select>
						<label class="hide" id="variablel">Variable</label>
						<select name="variableinfra" id="variableinfra" class="hide">
							<option value=" ">  </option>
							<option value="Conexiones Concurrentes">Conexiones Concurrentes</option>
							<option value="Encolamientos">Encolamientos</option>
							<option value="Espacio Disponible en Megabytes">Espacio Disponible en Megabytes</option>
							<option value="Porcentaje de uso de disco">Porcentaje de uso de disco</option>
							<option value="Numero de Conexiones Concurrentes">Numero de Conexiones Concurrentes</option>
							<option value="Numero de Conexiones Encoladas">Numero de Conexiones Encoladas</option>
							<option value="Porcentaje de Memoria disponible memoria">Porcentaje de Memoria disponible memoria</option>
							<option value="Porcentaje de uso de CPU">Porcentaje de uso de CPU</option>
						</select>
						<input type="hidden" name="variable" id="variable" value=""/>
						<label class="hide" id="agrupacionl">Agrupacion</label>
						<select name="agrupacion" id="agrupacion" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="segmentol">Segmento</label>
						<select name="segmento" id="segmento" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="productol">Producto</label>
						<select name="producto" id="producto" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="transaccionl">Transaccion</label>
						<select name="transaccion" id="transaccion" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="operacionl">Operacion</label>
						<select name="operacion" id="operacion" class="hide">
							<option value=" ">  </option>
						</select>
						<label class="hide" id="variableul">Variable</label>
						<select name="variableeu" id="variableeu" class="hide">
							<option value=" ">  </option>
							<option value="Peticiones Sin Completar">Peticiones Sin Completar</option>
							<option value="Respuestas Por Intervalo">Respuestas Por Intervalo</option>
							<option value="Tiempo Promedio de Respuesta (ms)">Tiempo Promedio de Respuesta (ms)</option>
							<option value="Confiabilidad">Confiabilidad</option>
							<option value="Confiabilidad Servicio">Confiabilidad Servicio</option>
							<option value="Disponibilidad">Disponibilidad</option>
							<option value="Disponibilidad ISP">Disponibilidad ISP</option>
							<option value="Disponibilidad Servicio">Disponibilidad Servicio</option>
							<option value="Experiencia Usuaria">Experiencia Usuaria</option>
							<option value="Errores">Errores</option>
							<option value="Punto Verificacion">Punto Verificacion</option>
							<option value="Tiempo de Respuesta">Tiempo de Respuesta</option>
							<option value="Tiempo de Respuesta ISP">Tiempo de Respuesta ISP</option>
							<option value="Tiempo de Respuesta Promedio">Tiempo de Respuesta Promedio</option>
							<option value="Total de Defectos por Interval">Total de Defectos por Interval</option>
							<option value="Total de Defectos por Intervalo">Total de Defectos por Intervalo</option>
							<option value="Total de Transacciones por Int">Total de Transacciones por Int</option>
							<option value="Total de Transacciones por Intervalo">Total de Transacciones por Intervalo</option>
						</select>
						<input type="hidden" name="variableu" id="variableu" value =""/>
						<label>Severidad:</label>
						<select id="severidad" name="severidad">
							<option value=" " class="white"> </option>
							<option value="2" class="info">Informacional</option>
							<option value="3" class="minor">Minor</option>
							<option value="4" class="warning">Warning</option>
							<option value="5" class="critical">Critical</option>
						</select>
						<label>Para:</label>
						<textarea type="text" name="para" id="para"></textarea>
						<label>Copia:</label>
						<textarea type="text" name="cc" id="cc" ></textarea>
						<label>Marcha Blanca</label>
						<div class="slideThree">
							<input type="checkbox" name="marcha" id="marcha"/>
							<label for="marcha"></label>
						</div>
						<label class="hide" id="marchatxtl">Marca Blanca</label>
						<textarea class="hide" name="marchatxt" id="marchatxt" ></textarea>
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