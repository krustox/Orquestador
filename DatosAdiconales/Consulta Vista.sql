SELECT concat("servicio_id",',servicio') as ide,"servicio_nombre" as Servicio,'' as Tipo,''as Subservicio,'' as Site,'' as Componente, '' as Subcomponente, '' as Elemento,
'' as Variable,
"servicio_severidad" as Severidad,"servicio_para" as Para,"servicio_cc" as Copia,"servicio_marchablanca" as Marcha_Blanca 
FROM "orquestador"."servicio"
UNION
SELECT concat("servicio_id",',tipo') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,''as Subservicio,'' as Site,'' as Componente, '' as Subcomponente, '' as Elemento,
'' as Variable,
"tipo_severidad" as Severidad,"tipo_para" as Para,"tipo_cc" as Copia, "tipo_marchablanca" as Marcha_Blanca
FROM "orquestador"."tipo"
INNER JOIN "orquestador"."servicio"
ON "tipo_servicio" = "servicio_id"
UNION
(SELECT concat("subservicio_id",',subservicio') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"subservicio_nombre" as Subservicio,'' as Site, '' as Componente, '' as Subcomponente, '' as Elemento, '' as Variable,
"subservicio_severidad" as Severidad,"subservicio_para" as Para,"subservicio_cc" as Copia,"subservicio_marchablanca" as Marcha_Blanca 
FROM "orquestador"."subservicio"
INNER JOIN "orquestador"."tipo"
ON "subservicio_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio")
UNION
(SELECT concat("site_id",',site') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"subservicio_nombre" as Subservicio,"site_nombre" as Site,
 '' as Componente, '' as Subcomponente, '' as Elemento,'' as Variable, 
"site_severidad" as Severidad,"site_para" as Para,"site_cc" as Copia,"site_marchablanca" as Marcha_Blanca
FROM "orquestador"."site"
INNER JOIN "orquestador"."subservicio"
ON "site_subservicio" = "subservicio_id"
INNER JOIN "orquestador"."tipo"
ON "subservicio_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "tipo_servicio" = "servicio_id"
)
UNION
(SELECT concat("componente_id",',componente') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"subservicio_nombre" as Subservicio,"site_nombre" as Site,
 "componente_nombre" as Componente, '' as Subcomponente, '' as Elemento,'' as Variable, 
"componente_severidad" as Severidad,"componente_para" as Para,"componente_cc" as Copia,"componente_marchablanca" as Marcha_Blanca
FROM "orquestador"."componente"
INNER JOIN "orquestador"."site"
ON "componente_site" = "site_id"
INNER JOIN "orquestador"."subservicio"
ON "site_subservicio" = "subservicio_id"
INNER JOIN "orquestador"."tipo"
ON "subservicio_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "tipo_servicio" = "servicio_id"
)
UNION
(SELECT concat("subcomponente_id",',subcomponente') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"subservicio_nombre" as Subservicio,"site_nombre" as Site,
 "componente_nombre" as Componente, "subcomponente_nombre" as Subcomponente, '' as Elemento,'' as Variable, 
"subcomponente_severidad" as Severidad,"subcomponente_para" as Para,"subcomponente_cc" as Copia,"subcomponente_marchablanca" as Marcha_Blanca
FROM "orquestador"."subcomponente"
INNER JOIN "orquestador"."componente"
ON "subcomponente_componente" = "componente_id"
INNER JOIN "orquestador"."site"
ON "componente_site" = "site_id"
INNER JOIN "orquestador"."subservicio"
ON "site_subservicio" = "subservicio_id"
INNER JOIN "orquestador"."tipo"
ON "subservicio_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "tipo_servicio" = "servicio_id"
)
UNION
(SELECT concat("elemento_id",',elemento') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"subservicio_nombre" as Subservicio,"site_nombre" as Site,
 "componente_nombre" as Componente, "subcomponente_nombre" as Subcomponente, "elemento_nombre" as Elemento,'' as Variable, 
"elemento_severidad" as Severidad,"elemento_para" as Para,"elemento_cc" as Copia,"elemento_marchablanca" as Marcha_Blanca
FROM "orquestador"."elemento"
INNER JOIN "orquestador"."subcomponente"
ON "elemento_subcomponente" = "subcomponente_id"
INNER JOIN "orquestador"."componente"
ON "subcomponente_componente" = "componente_id"
INNER JOIN "orquestador"."site"
ON "componente_site" = "site_id"
INNER JOIN "orquestador"."subservicio"
ON "site_subservicio" = "subservicio_id"
INNER JOIN "orquestador"."tipo"
ON "subservicio_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "tipo_servicio" = "servicio_id"
)
UNION
(SELECT concat("variable_id",',variable') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"subservicio_nombre" as Subservicio,"site_nombre" as Site,
 "componente_nombre" as Componente, "subcomponente_nombre" as Subcomponente, "elemento_nombre" as Elemento,"variable_nombre" as Variable, 
"variable_severidad" as Severidad,"variable_para" as Para,"variable_cc" as Copia,"variable_marchablanca" as Marcha_Blanca
FROM "orquestador"."variable"
INNER JOIN "orquestador"."elemento"
ON "variable_elemento" = "elemento_id"
INNER JOIN "orquestador"."subcomponente"
ON "elemento_subcomponente" = "subcomponente_id"
INNER JOIN "orquestador"."componente"
ON "subcomponente_componente" = "componente_id"
INNER JOIN "orquestador"."site"
ON "componente_site" = "site_id"
INNER JOIN "orquestador"."subservicio"
ON "site_subservicio" = "subservicio_id"
INNER JOIN "orquestador"."tipo"
ON "subservicio_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "tipo_servicio" = "servicio_id"
)
UNION
(SELECT concat("agrupacion_id",',agrupacion') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo, "agrupacion_nombre" as Agrupacion, 
'' as Segmento, '' as Producto, '' as Transaccion, '' as Operacion,'' as Variable, 
"agrupacion_severidad" as Severidad,"agrupacion_para" as Para,"agrupacion_cc" as Copia,"agrupacion_marchablanca" as Marcha_Blanca 
FROM "orquestador"."agrupacion"
INNER JOIN "orquestador"."tipo"
ON "agrupacion_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio"
)
UNION
(SELECT concat("segmento_id",',segmento') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,  "agrupacion_nombre" as Agrupacion,
"segmento_nombre" as Segmento, '' as Producto, '' as Transaccion, '' as Operacion,'' as Variable,
"segmento_severidad" as Severidad,"segmento_para" as Para,"segmento_cc" as Copia,"segmento_marchablanca" as Marcha_Blanca 
FROM "orquestador"."segmento"
INNER JOIN "orquestador"."agrupacion"
ON "segmento_agrupacion" = "agrupacion_id"
INNER JOIN "orquestador"."tipo"
ON "agrupacion_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio")
UNION
(SELECT concat("producto_id",',producto') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"agrupacion_nombre" as Agrupacion, 
"segmento_nombre" as Segmento, "producto_nombre" as Producto, '' as Transaccion, '' as Operacion,'' as Variable, 
"producto_severidad" as Severidad,"producto_para" as Para,"producto_cc" as Copia,"producto_marchablanca" as Marcha_Blanca 
FROM "orquestador"."producto"
INNER JOIN "orquestador"."segmento"
ON "producto_segmento" = "segmento_id"
INNER JOIN "orquestador"."agrupacion"
ON "segmento_agrupacion" = "agrupacion_id"
INNER JOIN "orquestador"."tipo"
ON "agrupacion_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio")
UNION
(SELECT concat("transaccion_id",',transaccion') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"agrupacion_nombre" as Agrupacion, 
"segmento_nombre" as Segmento, "producto_nombre" as Producto, "transaccion_nombre" as Transaccion, '' as Operacion,'' as Variable,
"transaccion_severidad" as Severidad,"transaccion_para" as Para,"transaccion_cc" as Copia,"transaccion_marchablanca" as Marcha_Blanca 
FROM "orquestador"."transaccion"
INNER JOIN "orquestador"."producto"
ON "transaccion_producto" = "producto_id"
INNER JOIN "orquestador"."segmento"
ON "producto_segmento" = "segmento_id"
INNER JOIN "orquestador"."agrupacion"
ON "segmento_agrupacion" = "agrupacion_id"
INNER JOIN "orquestador"."tipo"
ON "agrupacion_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio")
UNION
(SELECT concat("operacion_id",',operacion') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"agrupacion_nombre" as Agrupacion, 
"segmento_nombre" as Segmento, "producto_nombre" as Producto, "transaccion_nombre" as Transaccion, "operacion_nombre" as Operacion,'' as Variable, 
"operacion_severidad" as Severidad,"operacion_para" as Para,"operacion_cc" as Copia,"operacion_marchablanca" as Marcha_Blanca 
FROM "orquestador"."operacion"
INNER JOIN "orquestador"."transaccion"
ON "operacion_transaccion" = "transaccion_id"
INNER JOIN "orquestador"."producto"
ON "transaccion_producto" = "producto_id"
INNER JOIN "orquestador"."segmento"
ON "producto_segmento" = "segmento_id"
INNER JOIN "orquestador"."agrupacion"
ON "segmento_agrupacion" = "agrupacion_id"
INNER JOIN "orquestador"."tipo"
ON "agrupacion_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio")
UNION
(SELECT concat("variable_eu_id",',variable_eu') as ide,"servicio_nombre" as Servicio,"tipo_nombre" as Tipo,"agrupacion_nombre" as Agrupacion,
"segmento_nombre" as Segmento, "producto_nombre" as Producto, "transaccion_nombre" as Transaccion, "operacion_nombre" as Operacion,
"variable_eu_nombre" as Variable,
"variable_eu_severidad" as Severidad,"variable_eu_para" as Para,"variable_eu_cc" as Copia,"variable_eu_marchablanca" as Marcha_Blanca
FROM "orquestador"."variable_eu"
INNER JOIN "orquestador"."operacion"
ON "operacion_id" = "variable_eu_operacion"
INNER JOIN "orquestador"."transaccion"
ON "operacion_transaccion" = "transaccion_id"
INNER JOIN "orquestador"."producto"
ON "transaccion_producto" = "producto_id"
INNER JOIN "orquestador"."segmento"
ON "producto_segmento" = "segmento_id"
INNER JOIN "orquestador"."agrupacion"
ON "segmento_agrupacion" = "agrupacion_id"
INNER JOIN "orquestador"."tipo"
ON "agrupacion_tipo" = "tipo_id"
INNER JOIN "orquestador"."servicio"
ON "servicio_id" = "tipo_servicio")
