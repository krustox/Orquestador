<?php
include('Plugin/PHPExcel/Classes/PHPExcel.php');
include('Config/connection.php');
include('Functions/Function.php');
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
ini_set('memory_limit',-1);

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("WiseVisionCorp");

$query ="SELECT concat(\"servicio_id\",',servicio') as ide,\"servicio_nombre\" as Servicio,'' as Tipo,''as Subservicio,'' as Site,'' as Componente, '' as Subcomponente, '' as Elemento,
'' as Variable,
\"servicio_severidad\" as Severidad,\"servicio_para\" as Para,\"servicio_cc\" as Copia,\"servicio_marchablanca\" as Marcha_Blanca, \"servicio_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"servicio\"
UNION
SELECT concat(\"servicio_id\",',tipo') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,''as Subservicio,'' as Site,'' as Componente, '' as Subcomponente, '' as Elemento,
'' as Variable,
\"tipo_severidad\" as Severidad,\"tipo_para\" as Para,\"tipo_cc\" as Copia, \"tipo_marchablanca\" as Marcha_Blanca, \"tipo_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"tipo\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"tipo_servicio\" = \"servicio_id\"
UNION
(SELECT concat(\"subservicio_id\",',subservicio') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"subservicio_nombre\" as Subservicio,'' as Site, '' as Componente, '' as Subcomponente, '' as Elemento, '' as Variable,
\"subservicio_severidad\" as Severidad,\"subservicio_para\" as Para,\"subservicio_cc\" as Copia,\"subservicio_marchablanca\" as Marcha_Blanca, \"subservicio_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"subservicio\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"subservicio_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\")
UNION
(SELECT concat(\"site_id\",',site') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"subservicio_nombre\" as Subservicio,\"site_nombre\" as Site,
 '' as Componente, '' as Subcomponente, '' as Elemento,'' as Variable, 
\"site_severidad\" as Severidad,\"site_para\" as Para,\"site_cc\" as Copia,\"site_marchablanca\" as Marcha_Blanca, \"site_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"site\"
INNER JOIN \"orquestador\".\"subservicio\"
ON \"site_subservicio\" = \"subservicio_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"subservicio_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"tipo_servicio\" = \"servicio_id\"
)
UNION
(SELECT concat(\"componente_id\",',componente') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"subservicio_nombre\" as Subservicio,\"site_nombre\" as Site,
 \"componente_nombre\" as Componente, '' as Subcomponente, '' as Elemento,'' as Variable, 
\"componente_severidad\" as Severidad,\"componente_para\" as Para,\"componente_cc\" as Copia,\"componente_marchablanca\" as Marcha_Blanca, \"componente_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"componente\"
INNER JOIN \"orquestador\".\"site\"
ON \"componente_site\" = \"site_id\"
INNER JOIN \"orquestador\".\"subservicio\"
ON \"site_subservicio\" = \"subservicio_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"subservicio_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"tipo_servicio\" = \"servicio_id\"
)
UNION
(SELECT concat(\"subcomponente_id\",',subcomponente') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"subservicio_nombre\" as Subservicio,\"site_nombre\" as Site,
 \"componente_nombre\" as Componente, \"subcomponente_nombre\" as Subcomponente, '' as Elemento,'' as Variable, 
\"subcomponente_severidad\" as Severidad,\"subcomponente_para\" as Para,\"subcomponente_cc\" as Copia,\"subcomponente_marchablanca\" as Marcha_Blanca, \"subcomponente_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"subcomponente\"
INNER JOIN \"orquestador\".\"componente\"
ON \"subcomponente_componente\" = \"componente_id\"
INNER JOIN \"orquestador\".\"site\"
ON \"componente_site\" = \"site_id\"
INNER JOIN \"orquestador\".\"subservicio\"
ON \"site_subservicio\" = \"subservicio_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"subservicio_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"tipo_servicio\" = \"servicio_id\"
)
UNION
(SELECT concat(\"elemento_id\",',elemento') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"subservicio_nombre\" as Subservicio,\"site_nombre\" as Site,
 \"componente_nombre\" as Componente, \"subcomponente_nombre\" as Subcomponente, \"elemento_nombre\" as Elemento,'' as Variable, 
\"elemento_severidad\" as Severidad,\"elemento_para\" as Para,\"elemento_cc\" as Copia,\"elemento_marchablanca\" as Marcha_Blanca, \"elemento_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"elemento\"
INNER JOIN \"orquestador\".\"subcomponente\"
ON \"elemento_subcomponente\" = \"subcomponente_id\"
INNER JOIN \"orquestador\".\"componente\"
ON \"subcomponente_componente\" = \"componente_id\"
INNER JOIN \"orquestador\".\"site\"
ON \"componente_site\" = \"site_id\"
INNER JOIN \"orquestador\".\"subservicio\"
ON \"site_subservicio\" = \"subservicio_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"subservicio_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"tipo_servicio\" = \"servicio_id\"
)
UNION
(SELECT concat(\"variable_id\",',variable') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"subservicio_nombre\" as Subservicio,\"site_nombre\" as Site,
 \"componente_nombre\" as Componente, \"subcomponente_nombre\" as Subcomponente, \"elemento_nombre\" as Elemento,\"variable_nombre\" as Variable, 
\"variable_severidad\" as Severidad,\"variable_para\" as Para,\"variable_cc\" as Copia,\"variable_marchablanca\" as Marcha_Blanca, \"variable_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"variable\"
INNER JOIN \"orquestador\".\"elemento\"
ON \"variable_elemento\" = \"elemento_id\"
INNER JOIN \"orquestador\".\"subcomponente\"
ON \"elemento_subcomponente\" = \"subcomponente_id\"
INNER JOIN \"orquestador\".\"componente\"
ON \"subcomponente_componente\" = \"componente_id\"
INNER JOIN \"orquestador\".\"site\"
ON \"componente_site\" = \"site_id\"
INNER JOIN \"orquestador\".\"subservicio\"
ON \"site_subservicio\" = \"subservicio_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"subservicio_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"tipo_servicio\" = \"servicio_id\"
)
UNION
(SELECT concat(\"agrupacion_id\",',agrupacion') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo, \"agrupacion_nombre\" as Agrupacion, 
'' as Segmento, '' as Producto, '' as Transaccion, '' as Operacion,'' as Variable, 
\"agrupacion_severidad\" as Severidad,\"agrupacion_para\" as Para,\"agrupacion_cc\" as Copia,\"agrupacion_marchablanca\" as Marcha_Blanca, \"agrupacion_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"agrupacion\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"agrupacion_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\"
)
UNION
(SELECT concat(\"segmento_id\",',segmento') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,  \"agrupacion_nombre\" as Agrupacion,
\"segmento_nombre\" as Segmento, '' as Producto, '' as Transaccion, '' as Operacion,'' as Variable,
\"segmento_severidad\" as Severidad,\"segmento_para\" as Para,\"segmento_cc\" as Copia,\"segmento_marchablanca\" as Marcha_Blanca, \"segmento_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"segmento\"
INNER JOIN \"orquestador\".\"agrupacion\"
ON \"segmento_agrupacion\" = \"agrupacion_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"agrupacion_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\")
UNION
(SELECT concat(\"producto_id\",',producto') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"agrupacion_nombre\" as Agrupacion, 
\"segmento_nombre\" as Segmento, \"producto_nombre\" as Producto, '' as Transaccion, '' as Operacion,'' as Variable, 
\"producto_severidad\" as Severidad,\"producto_para\" as Para,\"producto_cc\" as Copia,\"producto_marchablanca\" as Marcha_Blanca, \"producto_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"producto\"
INNER JOIN \"orquestador\".\"segmento\"
ON \"producto_segmento\" = \"segmento_id\"
INNER JOIN \"orquestador\".\"agrupacion\"
ON \"segmento_agrupacion\" = \"agrupacion_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"agrupacion_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\")
UNION
(SELECT concat(\"transaccion_id\",',transaccion') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"agrupacion_nombre\" as Agrupacion, 
\"segmento_nombre\" as Segmento, \"producto_nombre\" as Producto, \"transaccion_nombre\" as Transaccion, '' as Operacion,'' as Variable,
\"transaccion_severidad\" as Severidad,\"transaccion_para\" as Para,\"transaccion_cc\" as Copia,\"transaccion_marchablanca\" as Marcha_Blanca, \"transaccion_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"transaccion\"
INNER JOIN \"orquestador\".\"producto\"
ON \"transaccion_producto\" = \"producto_id\"
INNER JOIN \"orquestador\".\"segmento\"
ON \"producto_segmento\" = \"segmento_id\"
INNER JOIN \"orquestador\".\"agrupacion\"
ON \"segmento_agrupacion\" = \"agrupacion_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"agrupacion_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\")
UNION
(SELECT concat(\"operacion_id\",',operacion') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"agrupacion_nombre\" as Agrupacion, 
\"segmento_nombre\" as Segmento, \"producto_nombre\" as Producto, \"transaccion_nombre\" as Transaccion, \"operacion_nombre\" as Operacion,'' as Variable, 
\"operacion_severidad\" as Severidad,\"operacion_para\" as Para,\"operacion_cc\" as Copia,\"operacion_marchablanca\" as Marcha_Blanca, \"operacion_marchablancatxt\" as Marcha_Blanca 
FROM \"orquestador\".\"operacion\"
INNER JOIN \"orquestador\".\"transaccion\"
ON \"operacion_transaccion\" = \"transaccion_id\"
INNER JOIN \"orquestador\".\"producto\"
ON \"transaccion_producto\" = \"producto_id\"
INNER JOIN \"orquestador\".\"segmento\"
ON \"producto_segmento\" = \"segmento_id\"
INNER JOIN \"orquestador\".\"agrupacion\"
ON \"segmento_agrupacion\" = \"agrupacion_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"agrupacion_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\")
UNION
(SELECT concat(\"variable_eu_id\",',variable_eu') as ide,\"servicio_nombre\" as Servicio,\"tipo_nombre\" as Tipo,\"agrupacion_nombre\" as Agrupacion,
\"segmento_nombre\" as Segmento, \"producto_nombre\" as Producto, \"transaccion_nombre\" as Transaccion, \"operacion_nombre\" as Operacion,
\"variable_eu_nombre\" as Variable,
\"variable_eu_severidad\" as Severidad,\"variable_eu_para\" as Para,\"variable_eu_cc\" as Copia,\"variable_eu_marchablanca\" as Marcha_Blanca, \"variable_eu_marchablancatxt\" as Marcha_Blanca
FROM \"orquestador\".\"variable_eu\"
INNER JOIN \"orquestador\".\"operacion\"
ON \"operacion_id\" = \"variable_eu_operacion\"
INNER JOIN \"orquestador\".\"transaccion\"
ON \"operacion_transaccion\" = \"transaccion_id\"
INNER JOIN \"orquestador\".\"producto\"
ON \"transaccion_producto\" = \"producto_id\"
INNER JOIN \"orquestador\".\"segmento\"
ON \"producto_segmento\" = \"segmento_id\"
INNER JOIN \"orquestador\".\"agrupacion\"
ON \"segmento_agrupacion\" = \"agrupacion_id\"
INNER JOIN \"orquestador\".\"tipo\"
ON \"agrupacion_tipo\" = \"tipo_id\"
INNER JOIN \"orquestador\".\"servicio\"
ON \"servicio_id\" = \"tipo_servicio\")
";
$data=LeerDatosDB($conn_string,"","",$query);

	$objPHPExcel->createSheet(0);
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Data Orquestador");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,1,"Servicio");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,1,"Tipo de Servicio");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,1,"Subservicio / Agrupacion");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,1,"Site / Segmento");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,1,"Componente / Producto");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,1,"Subcomponente / Transaccion");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,1,"Elemento / Operacion");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,1,"Variable");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,1,"Severidad");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,1,"Para");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,1,"Copia");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11,1,"Marcha Blanca");
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12,1,"Marcha Blanca Correo");
	
	$row = 2;
	$datar_len = sizeof($data);
	while ($row <= $datar_len+1){
		$column=1;
		$datac_len = sizeof($data[$row-2]);
		while ($column < $datac_len){
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column-1,$row,$data[$row-2][$column]);
			$column = $column + 1;
		}
		$row = $row + 1;
	}
	$objPHPExcel->removeSheetByIndex(1);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
$objWriter->save('data'.getdate()[0].'.xlsx');
exit;
?>