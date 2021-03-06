-- <ScriptOptions statementTerminator=";" />
CREATE LARGE TABLESPACE USERSPACE001 IN DATABASE PARTITION GROUP IBMDEFAULTGROUP PAGESIZE 4096 MANAGED BY AUTOMATIC STORAGE USING STOGROUP IBMSTOGROUP AUTORESIZE YES BUFFERPOOL IBMDEFAULTBP OVERHEAD INHERIT TRANSFERRATE INHERIT DROPPED TABLE RECOVERY ON DATA TAG INHERIT;
GRANT USE OF TABLESPACE USERSPACE001 TO PUBLIC WITH GRANT OPTION;
GRANT USE OF TABLESPACE USERSPACE001 TO USER DB2ADMIN WITH GRANT OPTION;
GRANT USE OF TABLESPACE USERSPACE001 TO USER DIEGO WITH GRANT OPTION;
GRANT USE OF TABLESPACE USERSPACE001 TO ROLE SYSDEBUG WITH GRANT OPTION;
GRANT USE OF TABLESPACE USERSPACE001 TO ROLE SYSDEBUGPRIVATE WITH GRANT OPTION;

CREATE TABLE "orquestador"."usuario" ( "usuario_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ), 
"usuario_nombre" VARCHAR(50) NOT NULL, 
"usuario_correo" VARCHAR(50) NOT NULL unique, 
"usuario_contrasena" VARCHAR(50) NOT NULL,
PRIMARY KEY ( "usuario_id" ) ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."usuario" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."usuario" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."usuario" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."usuario" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."usuario" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."usuario" TO USER DIEGO WITH GRANT OPTION;


CREATE TABLE "orquestador"."servicio" ( "servicio_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"servicio_nombre" VARCHAR(100) NOT NULL, 
"servicio_para" VARCHAR(500) NOT NULL, 
"servicio_cc" VARCHAR(500) NOT NULL, 
"servicio_severidad" INTEGER NOT NULL,
"servicio_marchablancatxt" VARCHAR(500),
"servicio_marchablanca" CHAR(1) NOT NULL,PRIMARY KEY ( "servicio_nombre","servicio_severidad" )) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."servicio" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."servicio" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."servicio" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."servicio" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."servicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."servicio" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."tipo" ( "tipo_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"tipo_servicio" INTEGER NOT NULL, 
"tipo_nombre" VARCHAR(100) NOT NULL, 
"tipo_severidad" INTEGER NOT NULL, 
"tipo_para" VARCHAR(500) NOT NULL, 
"tipo_cc" VARCHAR(500) NOT NULL, 
"tipo_marchablancatxt" VARCHAR(500),
"tipo_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "tipo_servicio","tipo_nombre","tipo_severidad"), 
foreign key FK_serv_id("tipo_servicio") 
references "orquestador"."servicio"("servicio_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."tipo" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."tipo" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."tipo" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."tipo" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."tipo" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."tipo" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."subservicio" ( "subservicio_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"subservicio_tipo" INTEGER NOT NULL, 
"subservicio_nombre" VARCHAR(100) NOT NULL, 
"subservicio_severidad" INTEGER NOT NULL, 
"subservicio_para" VARCHAR(500) NOT NULL, 
"subservicio_cc" VARCHAR(500) NOT NULL, 
"subservicio_marchablancatxt" VARCHAR(500),
"subservicio_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "subservicio_tipo","subservicio_nombre","subservicio_severidad"), 
foreign key FK_tipo_id("subservicio_tipo") 
references "orquestador"."tipo"("tipo_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."subservicio" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."subservicio" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."subservicio" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."subservicio" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."subservicio" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."site" ( "site_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"site_subservicio" INTEGER NOT NULL, 
"site_nombre" VARCHAR(100) NOT NULL, 
"site_severidad" INTEGER NOT NULL, 
"site_para" VARCHAR(500) NOT NULL, 
"site_cc" VARCHAR(500) NOT NULL, 
"site_marchablancatxt" VARCHAR(500),
"site_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "site_subservicio","site_nombre","site_severidad"), 
foreign key FK_subserv_id("site_subservicio") 
references "orquestador"."subservicio"("subservicio_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."site" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."site" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."site" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."site" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."site" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."site" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."componente" ( "componente_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"componente_site" INTEGER NOT NULL, 
"componente_nombre" VARCHAR(100) NOT NULL, 
"componente_severidad" INTEGER NOT NULL, 
"componente_para" VARCHAR(500) NOT NULL, 
"componente_cc" VARCHAR(500) NOT NULL, 
"componente_marchablancatxt" VARCHAR(500),
"componente_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "componente_site","componente_nombre","componente_severidad"), 
foreign key FK_site_id("componente_site") 
references "orquestador"."site"("site_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."componente" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."componente" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."componente" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."componente" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."componente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."componente" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."subcomponente" ( "subcomponente_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"subcomponente_componente" INTEGER NOT NULL, 
"subcomponente_nombre" VARCHAR(100) NOT NULL, 
"subcomponente_severidad" INTEGER NOT NULL, 
"subcomponente_para" VARCHAR(500) NOT NULL, 
"subcomponente_cc" VARCHAR(500) NOT NULL, 
"subcomponente_marchablancatxt" VARCHAR(500),
"subcomponente_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "subcomponente_componente","subcomponente_nombre","subcomponente_severidad"), 
foreign key FK_comp_id("subcomponente_componente") 
references "orquestador"."componente"("componente_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."subcomponente" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."subcomponente" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."subcomponente" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."subcomponente" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."subcomponente" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."elemento" ( "elemento_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"elemento_subcomponente" INTEGER NOT NULL, 
"elemento_nombre" VARCHAR(100) NOT NULL, 
"elemento_severidad" INTEGER NOT NULL, 
"elemento_para" VARCHAR(500) NOT NULL, 
"elemento_cc" VARCHAR(500) NOT NULL, 
"elemento_marchablancatxt" VARCHAR(500),
"elemento_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "elemento_subcomponente","elemento_nombre","elemento_severidad"), 
foreign key FK_subcomp_id("elemento_subcomponente") 
references "orquestador"."subcomponente"("subcomponente_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."elemento" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."elemento" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."elemento" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."elemento" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."elemento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."elemento" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."variable" ( "variable_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"variable_elemento" INTEGER NOT NULL, 
"variable_nombre" VARCHAR(100) NOT NULL, 
"variable_severidad" INTEGER NOT NULL, 
"variable_para" VARCHAR(500) NOT NULL, 
"variable_cc" VARCHAR(500) NOT NULL, 
"variable_marchablancatxt" VARCHAR(500),
"variable_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "variable_elemento","variable_nombre","variable_severidad"), 
foreign key FK_elem_id("variable_elemento") 
references "orquestador"."elemento"("elemento_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."variable" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."variable" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."variable" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."variable" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."variable" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."variable" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."agrupacion" ( "agrupacion_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"agrupacion_tipo" INTEGER NOT NULL, 
"agrupacion_nombre" VARCHAR(100) NOT NULL, 
"agrupacion_severidad" INTEGER NOT NULL, 
"agrupacion_para" VARCHAR(500) NOT NULL, 
"agrupacion_cc" VARCHAR(500) NOT NULL,
"agrupacion_marchablancatxt" VARCHAR(500),
"agrupacion_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "agrupacion_tipo","agrupacion_nombre","agrupacion_severidad"), 
foreign key FK_expu_id("agrupacion_tipo") 
references "orquestador"."tipo"("tipo_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."agrupacion" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."agrupacion" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."agrupacion" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."agrupacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."agrupacion" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."segmento" ( "segmento_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"segmento_agrupacion" INTEGER NOT NULL, 
"segmento_nombre" VARCHAR(100) NOT NULL, 
"segmento_severidad" INTEGER NOT NULL, 
"segmento_para" VARCHAR(500) NOT NULL, 
"segmento_cc" VARCHAR(500) NOT NULL, 
"segmento_marchablancatxt" VARCHAR(500),
"segmento_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "segmento_agrupacion","segmento_nombre","segmento_severidad"), 
foreign key FK_agrup_id("segmento_agrupacion") 
references "orquestador"."agrupacion"("agrupacion_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."segmento" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."segmento" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."segmento" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."segmento" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."segmento" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."segmento" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."producto" ( "producto_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"producto_segmento" INTEGER NOT NULL, 
"producto_nombre" VARCHAR(100) NOT NULL, 
"producto_severidad" INTEGER NOT NULL, 
"producto_para" VARCHAR(500) NOT NULL, 
"producto_cc" VARCHAR(500) NOT NULL,
"producto_marchablancatxt" VARCHAR(500),
"producto_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "producto_segmento","producto_nombre","producto_severidad"), 
foreign key FK_segm_id("producto_segmento") 
references "orquestador"."segmento"("segmento_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."producto" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."producto" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."producto" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."producto" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."producto" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."producto" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."transaccion" ( "transaccion_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"transaccion_producto" INTEGER NOT NULL, 
"transaccion_nombre" VARCHAR(100) NOT NULL, 
"transaccion_severidad" INTEGER NOT NULL, 
"transaccion_para" VARCHAR(500) NOT NULL, 
"transaccion_cc" VARCHAR(500) NOT NULL, 
"transaccion_marchablancatxt" VARCHAR(500),
"transaccion_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "transaccion_producto","transaccion_nombre","transaccion_severidad"), 
foreign key FK_prod_id("transaccion_producto") 
references "orquestador"."producto"("producto_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."transaccion" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."transaccion" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."transaccion" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."transaccion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."transaccion" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."operacion" ( "operacion_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"operacion_transaccion" INTEGER NOT NULL, 
"operacion_nombre" VARCHAR(100) NOT NULL, 
"operacion_severidad" INTEGER NOT NULL, 
"operacion_para" VARCHAR(500) NOT NULL, 
"operacion_cc" VARCHAR(500) NOT NULL, 
"operacion_marchablancatxt" VARCHAR(500),
"operacion_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "operacion_transaccion","operacion_nombre","operacion_severidad"), 
foreign key FK_trans_id("operacion_transaccion") 
references "orquestador"."transaccion"("transaccion_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."operacion" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."operacion" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."operacion" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."operacion" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."operacion" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."operacion" TO USER DIEGO WITH GRANT OPTION;

CREATE TABLE "orquestador"."variable_eu" ( "variable_eu_id" INTEGER NOT NULL GENERATED ALWAYS AS IDENTITY ( START WITH 1 INCREMENT BY 1 MINVALUE -2147483648 MAXVALUE 2147483647 CACHE 20 ) unique, 
"variable_eu_operacion" INTEGER NOT NULL, 
"variable_eu_nombre" VARCHAR(100) NOT NULL, 
"variable_eu_severidad" INTEGER NOT NULL, 
"variable_eu_para" VARCHAR(500) NOT NULL, 
"variable_eu_cc" VARCHAR(500) NOT NULL, 
"variable_eu_marchablancatxt" VARCHAR(500),
"variable_eu_marchablanca" CHAR(1) NOT NULL,
PRIMARY KEY ( "variable_eu_operacion","variable_eu_nombre","variable_eu_severidad"), 
foreign key FK_operacion_id("variable_eu_operacion") 
references "orquestador"."operacion"("operacion_id") on delete restrict
 ) IN USERSPACE001;
GRANT ALTER ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT ALTER ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;
GRANT CONTROL ON TABLE "orquestador"."variable_eu" TO PUBLIC;
GRANT CONTROL ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN;
GRANT CONTROL ON TABLE "orquestador"."variable_eu" TO USER DIEGO;
GRANT DELETE ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT DELETE ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INDEX ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT INSERT ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT REFERENCES ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT SELECT ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."variable_eu" TO PUBLIC WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."variable_eu" TO USER DB2ADMIN WITH GRANT OPTION;
GRANT UPDATE ON TABLE "orquestador"."variable_eu" TO USER DIEGO WITH GRANT OPTION;

INSERT INTO "orquestador"."usuario" ("usuario_nombre","usuario_correo","usuario_contrasena") 
VALUES('Diego Arbelaez','darbelaez@wisevisioncorp.com','12345');