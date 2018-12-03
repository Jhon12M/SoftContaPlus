--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: admon_bitacoraauditoria; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_bitacoraauditoria (
    codigo integer NOT NULL,
    fechahora timestamp without time zone NOT NULL,
    usuario character varying(10) NOT NULL,
    suceso character varying(1) NOT NULL,
    detalle character varying(3000),
    registroanterior character varying(3000),
    codopcion integer,
    sesion character varying(100)
);


ALTER TABLE public.admon_bitacoraauditoria OWNER TO galo;

--
-- Name: TABLE admon_bitacoraauditoria; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_bitacoraauditoria IS 'Registra todos los sucesos de auditoría dependiendo del nivel de auditoría configurado para cada sistema de informacion.';


--
-- Name: COLUMN admon_bitacoraauditoria.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.codigo IS 'Consecutivo identificador de registro. Llave primaria.';


--
-- Name: COLUMN admon_bitacoraauditoria.fechahora; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.fechahora IS 'Fecha y hora de registro del suceso en la bitácora de auditoría.';


--
-- Name: COLUMN admon_bitacoraauditoria.usuario; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.usuario IS 'Nombre del usuario que generó el susceso que se registra en la bitácora. Llave foránea con usuarios.codusuario';


--
-- Name: COLUMN admon_bitacoraauditoria.suceso; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.suceso IS 'Tipo de suceso que se registra en la bitácora: 1: Acceso exitoso. 2: Acceso fallido. 3: Inserción 4: Modificación. 5: Eliminación. 6: Consulta, 7: Salida del sistema';


--
-- Name: COLUMN admon_bitacoraauditoria.detalle; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.detalle IS 'Datos correspondientes al nuevo registro generado en la base de datos. Válido para los sucesos 3 y 4.';


--
-- Name: COLUMN admon_bitacoraauditoria.registroanterior; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.registroanterior IS 'Datos correspondientes al registro anterior. Válido para los sucesos 4 y 5.';


--
-- Name: COLUMN admon_bitacoraauditoria.codopcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.codopcion IS 'Código de la opción del sistema de información desde donde se generó el susceso. Llave foánea con opciones.codigo';


--
-- Name: COLUMN admon_bitacoraauditoria.sesion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_bitacoraauditoria.sesion IS 'Número de la sesión del usuario que genera el rastro de auditoria.';


--
-- Name: admon_empresas; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_empresas (
    nit character varying(15) NOT NULL,
    razonsocial character varying(100) NOT NULL,
    direccion character varying(100),
    telefono character varying(10),
    email character varying(100),
    codcontacto integer,
    url character varying(100)
);


ALTER TABLE public.admon_empresas OWNER TO galo;

--
-- Name: TABLE admon_empresas; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_empresas IS 'Contiene información de las empresas a las cuales hace referencia el sistema de información.';


--
-- Name: COLUMN admon_empresas.nit; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.nit IS 'Número del Nit de la empresa';


--
-- Name: COLUMN admon_empresas.razonsocial; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.razonsocial IS 'Nombre o razón social de la empresa';


--
-- Name: COLUMN admon_empresas.direccion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.direccion IS 'Dirección donde funciona la empresa, incluido el nombre de la ciudad';


--
-- Name: COLUMN admon_empresas.telefono; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.telefono IS 'Teléfono de contacto de la empresa.';


--
-- Name: COLUMN admon_empresas.email; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.email IS 'Correo electrónico de contacto de la empresa.';


--
-- Name: COLUMN admon_empresas.codcontacto; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.codcontacto IS 'Código del contacto que se tiene en la empresa. Llave foranea con personas.codigo';


--
-- Name: COLUMN admon_empresas.url; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresas.url IS 'URL o dirección de la página web de la empresa.';


--
-- Name: admon_empresassi; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_empresassi (
    codigo integer NOT NULL,
    nit character varying(15) NOT NULL,
    codsi integer NOT NULL,
    fechainicio date,
    fechafin date
);


ALTER TABLE public.admon_empresassi OWNER TO galo;

--
-- Name: TABLE admon_empresassi; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_empresassi IS 'Registra los sistemas de información a los que tiene derecho de acceder las empresas.';


--
-- Name: COLUMN admon_empresassi.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresassi.codigo IS 'Consecutivo identificador de registro. Llave primaria.';


--
-- Name: COLUMN admon_empresassi.nit; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresassi.nit IS 'Nit correspndiente a la empresa que hace uso del sistema de información. llave foránea con empresas.nit';


--
-- Name: COLUMN admon_empresassi.codsi; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresassi.codsi IS 'Código del sistema de información que hace uso la empresa. Llave foránea con si.codigo';


--
-- Name: COLUMN admon_empresassi.fechainicio; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresassi.fechainicio IS 'Fecha de inicio del uso del sistema de información por parte de la empresa.';


--
-- Name: COLUMN admon_empresassi.fechafin; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_empresassi.fechafin IS 'Fecha de finalización del derecho de acceso al sistema de información por parte de la empresa.';


--
-- Name: admon_opciones; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_opciones (
    codigo integer NOT NULL,
    opcion character varying(50) NOT NULL,
    descripcion character varying(2500),
    ruta character varying(250),
    padre integer,
    codsi integer NOT NULL
);


ALTER TABLE public.admon_opciones OWNER TO galo;

--
-- Name: TABLE admon_opciones; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_opciones IS 'Almacena las opciones para cada menú del sistema de información.';


--
-- Name: COLUMN admon_opciones.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_opciones.codigo IS 'Código de la opción. Consecutivo. llave primaria.';


--
-- Name: COLUMN admon_opciones.opcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_opciones.opcion IS 'Nombre de la opción';


--
-- Name: COLUMN admon_opciones.descripcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_opciones.descripcion IS 'Descripción de la opción.';


--
-- Name: COLUMN admon_opciones.ruta; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_opciones.ruta IS 'Ruta donde está almacenado el programa correspondiente a la opción.';


--
-- Name: COLUMN admon_opciones.padre; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_opciones.padre IS 'Código de la opción a la cual se suscribe este atributo (Cuando este código se refiere a un menú)';


--
-- Name: COLUMN admon_opciones.codsi; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_opciones.codsi IS 'Código del sistema de información al que se suscribe la opción.';


--
-- Name: admon_personas; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_personas (
    codigo integer NOT NULL,
    numide character varying(15),
    nombres character varying(50) NOT NULL,
    apellidos character varying(50) NOT NULL,
    email character varying(100),
    fecha_nacimiento date,
    movil character varying(10)
);


ALTER TABLE public.admon_personas OWNER TO galo;

--
-- Name: COLUMN admon_personas.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.codigo IS 'Código de la persona.';


--
-- Name: COLUMN admon_personas.numide; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.numide IS 'Número de identificación de la persona';


--
-- Name: COLUMN admon_personas.nombres; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.nombres IS 'Nombres de la persona';


--
-- Name: COLUMN admon_personas.apellidos; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.apellidos IS 'Apellidos de la persona.';


--
-- Name: COLUMN admon_personas.email; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.email IS 'Correo electrónico de la persona.';


--
-- Name: COLUMN admon_personas.fecha_nacimiento; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.fecha_nacimiento IS 'Fecha de nacimiento de la persona.';


--
-- Name: COLUMN admon_personas.movil; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_personas.movil IS 'Número de celular de la persona';


--
-- Name: admon_registrospqr; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_registrospqr (
    codigo integer NOT NULL,
    fechahora date NOT NULL,
    asunto character varying(250) NOT NULL,
    descripcion character varying(2500) NOT NULL,
    estado character varying(1) NOT NULL,
    tipo character varying(1) NOT NULL,
    usuario character varying(10) NOT NULL,
    codopcion integer NOT NULL,
    archivo character varying(250) NOT NULL,
    so character varying(50) NOT NULL,
    navegador character varying(50) NOT NULL,
    respuesta character varying(250),
    fecha_respuesta date
);


ALTER TABLE public.admon_registrospqr OWNER TO galo;

--
-- Name: TABLE admon_registrospqr; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_registrospqr IS 'Almacena las pqrs dadas en el sistema de información';


--
-- Name: COLUMN admon_registrospqr.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.codigo IS 'Consecutivo identificador de registro. Llave primaria.';


--
-- Name: COLUMN admon_registrospqr.fechahora; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.fechahora IS 'Fecha y hora en que se hace el registro.';


--
-- Name: COLUMN admon_registrospqr.asunto; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.asunto IS 'Resumen del PQR';


--
-- Name: COLUMN admon_registrospqr.descripcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.descripcion IS 'Descripción detallada del PQR';


--
-- Name: COLUMN admon_registrospqr.estado; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.estado IS 'Estado de atención del PQR: 1: Por analizar. 2: Analizado no viable. 3: En desarrollo. 4: Atendido';


--
-- Name: COLUMN admon_registrospqr.tipo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.tipo IS 'Tipo de registro: P: Petición, Q: Queja, R: Reclamo';


--
-- Name: COLUMN admon_registrospqr.usuario; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.usuario IS 'Nombre del usuario que hace el PQR. Llave foránea con usuarios.usuario';


--
-- Name: COLUMN admon_registrospqr.codopcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.codopcion IS 'Código de la opción desde donde se hace el registro PQR';


--
-- Name: COLUMN admon_registrospqr.archivo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.archivo IS 'Ruta del archivo desde el cual se genera la PQR';


--
-- Name: COLUMN admon_registrospqr.so; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.so IS 'Sistema operativo donde funciona el navegador desde donde se genera el PQR';


--
-- Name: COLUMN admon_registrospqr.navegador; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.navegador IS 'Navegador desde donde se registra el PQR.';


--
-- Name: COLUMN admon_registrospqr.respuesta; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.respuesta IS 'Respuesta que se da al PQR';


--
-- Name: COLUMN admon_registrospqr.fecha_respuesta; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_registrospqr.fecha_respuesta IS 'Fecha en que se da respuesta al PQR';


--
-- Name: admon_rolles; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_rolles (
    codigo integer NOT NULL,
    roll character varying(100) NOT NULL,
    descripcion character varying(2500)
);


ALTER TABLE public.admon_rolles OWNER TO galo;

--
-- Name: COLUMN admon_rolles.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_rolles.codigo IS 'Código del roll. Consecutivo. Llave primaria';


--
-- Name: COLUMN admon_rolles.roll; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_rolles.roll IS 'Nombre del roll';


--
-- Name: COLUMN admon_rolles.descripcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_rolles.descripcion IS 'Descripción del roll.';


--
-- Name: admon_rollesopciones; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_rollesopciones (
    codigo integer NOT NULL,
    codroll integer NOT NULL,
    codopcion integer NOT NULL
);


ALTER TABLE public.admon_rollesopciones OWNER TO galo;

--
-- Name: TABLE admon_rollesopciones; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_rollesopciones IS 'Almacena los accesos que tiene cada roll.';


--
-- Name: COLUMN admon_rollesopciones.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_rollesopciones.codigo IS 'Consecutivo identificador de registro. Llave primaria.';


--
-- Name: COLUMN admon_rollesopciones.codroll; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_rollesopciones.codroll IS 'Código del roll al cual se le define el acceso a la opción. Llave foránea con rolles.codigo';


--
-- Name: COLUMN admon_rollesopciones.codopcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_rollesopciones.codopcion IS 'Código de la opción a la cual se le pertmite el acceso al roll. Llave foranea con opciones.codigo';


--
-- Name: admon_si; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_si (
    codigo integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion character varying(2500),
    version numeric,
    codnivelauditoria character varying(1),
    css character varying(250) NOT NULL
);


ALTER TABLE public.admon_si OWNER TO galo;

--
-- Name: TABLE admon_si; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON TABLE admon_si IS 'Contiene el registro de los sistemas de información al que se permite el acceso a través del administrador de sistemas de información.';


--
-- Name: COLUMN admon_si.codigo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_si.codigo IS 'Código del sistema de información. Consecutivo. llave primaria';


--
-- Name: COLUMN admon_si.nombre; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_si.nombre IS 'Nombre del sistema de información';


--
-- Name: COLUMN admon_si.descripcion; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_si.descripcion IS 'Descripción del sistema de información';


--
-- Name: COLUMN admon_si.version; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_si.version IS 'Versión del sistema de información';


--
-- Name: COLUMN admon_si.codnivelauditoria; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_si.codnivelauditoria IS 'Código del nivel de auditoría configurado para el sistema de información . 0: Sin nivel de auditoria, 1: Bajo (accesos), 2: Medio (accesos y modificación de información, 3: Alto (incluye consultas)';


--
-- Name: COLUMN admon_si.css; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_si.css IS 'Hoja de estilo con la cual se presenta el sistema de información';


--
-- Name: admon_usuarios; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE admon_usuarios (
    usuario character varying(10) NOT NULL,
    clave character varying(100) NOT NULL,
    codpersona integer,
    codroll integer,
    activo boolean DEFAULT true NOT NULL
);


ALTER TABLE public.admon_usuarios OWNER TO galo;

--
-- Name: COLUMN admon_usuarios.usuario; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_usuarios.usuario IS 'Nombre del usuario con la cual se accede al sistema.';


--
-- Name: COLUMN admon_usuarios.clave; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_usuarios.clave IS 'Clave personal con la cual el usuario accede al sistema de información.';


--
-- Name: COLUMN admon_usuarios.codpersona; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_usuarios.codpersona IS 'Código de la persona al cual pertenece la clave de usuario. Llave foranea con personas.nunide';


--
-- Name: COLUMN admon_usuarios.codroll; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_usuarios.codroll IS 'Código del roll que tiene el usuario en el sistema de información. Llave foránea con rolles.codigo';


--
-- Name: COLUMN admon_usuarios.activo; Type: COMMENT; Schema: public; Owner: galo
--

COMMENT ON COLUMN admon_usuarios.activo IS 'Indicador que informa si el usuario está activo o no dentro de la base de datos.';


--
-- Name: sig_departamentos; Type: TABLE; Schema: public; Owner: galo; Tablespace: 
--

CREATE TABLE sig_departamentos (
    coddep character varying(2) NOT NULL,
    departamento character varying(30) NOT NULL
);


ALTER TABLE public.sig_departamentos OWNER TO galo;

--
-- Data for Name: admon_bitacoraauditoria; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_bitacoraauditoria (codigo, fechahora, usuario, suceso, detalle, registroanterior, codopcion, sesion) FROM stdin;
1	2010-12-09 10:34:30	dahsk	2	\N	\N	\N	\N
2	2010-12-09 10:35:58	galo	2	\N	\N	\N	\N
3	2010-12-09 10:44:08	galo	1	\N	\N	\N	sdau50u4dl3vp7r2tsi70ehph8dp8odc
4	2010-12-09 10:44:58	galo	1	\N	\N	\N	\N
5	2010-12-09 10:47:11	galo	1	\N	\N	\N	\N
6	2010-12-09 10:48:17	galo	1	\N	\N	\N	\N
7	2010-12-09 10:50:05	galo	1	\N	\N	\N	7
8	2010-12-09 10:52:52	galo	1	\N	\N	\N	8
9	2010-12-09 10:54:25	galo	2	\N	\N	\N	\N
10	2010-12-09 10:54:33	galo	1	\N	\N	\N	10
11	2010-12-09 10:55:15	galo	1	\N	\N	\N	11
12	2010-12-09 10:57:02	galo	1	\N	\N	\N	12
13	2010-12-09 10:57:05		7	\N	\N	\N	12
14	2010-12-09 11:18:11	galo	1	\N	\N	\N	14
15	2010-12-09 11:44:57	galo	7	\N	\N	\N	14
16	2010-12-09 11:45:06	galo	1	\N	\N	\N	16
17	2010-12-09 12:12:02	galo	7	\N	\N	\N	16
18	2010-12-09 12:12:24	galo	1	\N	\N	\N	18
19	2010-12-09 12:15:07	galo	7	\N	\N	\N	18
20	2010-12-09 12:15:13	pp	2	\N	\N	\N	\N
21	2010-12-09 12:15:20	prueba	2	\N	\N	\N	\N
22	2010-12-09 12:15:26	pp	2	\N	\N	\N	\N
23	2010-12-09 12:15:32	galo	1	\N	\N	\N	23
24	2010-12-09 12:16:17	galo	7	\N	\N	\N	23
25	2010-12-09 12:16:22	pp	1	\N	\N	\N	25
26	2010-12-09 12:38:13	pp	7	\N	\N	\N	25
27	2010-12-09 12:38:17	galo	1	\N	\N	\N	27
28	2010-12-09 12:41:05	galo	7	\N	\N	\N	27
29	2010-12-09 12:41:11	pp	1	\N	\N	\N	29
\.


--
-- Data for Name: admon_empresas; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_empresas (nit, razonsocial, direccion, telefono, email, codcontacto, url) FROM stdin;
\.


--
-- Data for Name: admon_empresassi; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_empresassi (codigo, nit, codsi, fechainicio, fechafin) FROM stdin;
\.


--
-- Data for Name: admon_opciones; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_opciones (codigo, opcion, descripcion, ruta, padre, codsi) FROM stdin;
3	Roles	\N	admon/rolles.php	\N	0
4	Usuarios	\N	admon/usuarios.php	\N	0
5	Auditoria	\N	admon/auditoria.php	\N	0
6	PQRs	\N	admon/pqr.php	\N	0
1	Sistemas	Obtiene un listado de los sistemas registrados en el administrador con la posibilidad de configurar sus opciones.	admon/si.php	\N	0
7	Backups	Genera y permite la descarga del backup de la base de datos.	admon/backups.php	\N	0
2	Empresas	Contiene el lista de las empresas que tienen derecho a acceder a los sistemas de informacion.	admon/empresas.php	\N	0
8	Predios	Obtiene la liasta de predios del municipio	impreincod/predios.php	\N	1
9	Departamentos	Obtiene la lista de departamentos	sig/departamentos.php	\N	2
\.


--
-- Data for Name: admon_personas; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_personas (codigo, numide, nombres, apellidos, email, fecha_nacimiento, movil) FROM stdin;
0	\N	Administrador	del Sistema	\N	\N	\N
1	98390288	Galo Fabián	Muñoz Espín	galofabian@hotmail.com	1975-05-06	3128020291
2	1	pp	mora	oo@hotmail.com	1980-12-01	31200000
\.


--
-- Data for Name: admon_registrospqr; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_registrospqr (codigo, fechahora, asunto, descripcion, estado, tipo, usuario, codopcion, archivo, so, navegador, respuesta, fecha_respuesta) FROM stdin;
\.


--
-- Data for Name: admon_rolles; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_rolles (codigo, roll, descripcion) FROM stdin;
1	Auditor	Responsable de la auditoria y las copias de seguridad sobre el sistema de informaión.
0	Administrador del sistema	Administrador de toda la plataforma
2	Alcalde	Alcalde
3	Tesorero	Tesorero
4	Secretario	Secretario
\.


--
-- Data for Name: admon_rollesopciones; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_rollesopciones (codigo, codroll, codopcion) FROM stdin;
1	0	1
2	0	2
3	0	3
4	0	4
5	0	5
6	0	6
7	0	7
8	1	5
9	1	7
10	3	8
11	4	9
\.


--
-- Data for Name: admon_si; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_si (codigo, nombre, descripcion, version, codnivelauditoria, css) FROM stdin;
0	Administrador de sistemas de informacion	\N	\N	\N	estilo.css
1	IMPREINCOD	Sistema de información para el cobro de impuestos municipales.	0.0	2	impreincod.css
2	Sistema de prueba	Sistema de prueba	0.0	0	prueba.css
\.


--
-- Data for Name: admon_usuarios; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY admon_usuarios (usuario, clave, codpersona, codroll, activo) FROM stdin;
admin	1cf0b361bdfa933ca3f54c7ab110daa9	0	0	t
galo	1cf0b361bdfa933ca3f54c7ab110daa9	1	0	t
pp	1cf0b361bdfa933ca3f54c7ab110daa9	2	4	t
\.


--
-- Data for Name: sig_departamentos; Type: TABLE DATA; Schema: public; Owner: galo
--

COPY sig_departamentos (coddep, departamento) FROM stdin;
05	Antioquia
08	Atlántico
09	Barranquilla d.e
11	Santa fe de bogotá d.c.
13	Bolívar
14	Cartagena d.e.
15	Boyaca
17	Caldas
18	Caquetá
19	Cauca
20	Cesar
23	Córdoba
25	Cundinamarca
27	Chocó
41	Huila
44	La guajira
47	Magdalena
48	Santamarta d.e
50	Meta
52	Nariño
54	Norte de santander
63	Quindio
66	Risaralda
68	Santander
70	Sucre
73	Tolima
76	Valle
81	Arauca
85	Casanare
86	Putumayo
88	San andrés
91	Amazonas
94	Guainía
95	Guaviare
97	Vaupés
99	Vichada
0	No definido
\.


--
-- Name: admon_bitacoraauditoria_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_bitacoraauditoria
    ADD CONSTRAINT admon_bitacoraauditoria_pkey PRIMARY KEY (codigo);


--
-- Name: admon_empresas_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_empresas
    ADD CONSTRAINT admon_empresas_pkey PRIMARY KEY (nit);


--
-- Name: admon_empresassi_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_empresassi
    ADD CONSTRAINT admon_empresassi_pkey PRIMARY KEY (codigo);


--
-- Name: admon_opciones_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_opciones
    ADD CONSTRAINT admon_opciones_pkey PRIMARY KEY (codigo);


--
-- Name: admon_personas_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_personas
    ADD CONSTRAINT admon_personas_pkey PRIMARY KEY (codigo);


--
-- Name: admon_registrospqr_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_registrospqr
    ADD CONSTRAINT admon_registrospqr_pkey PRIMARY KEY (codigo);


--
-- Name: admon_rolles_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_rolles
    ADD CONSTRAINT admon_rolles_pkey PRIMARY KEY (codigo);


--
-- Name: admon_rollesopciones_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_rollesopciones
    ADD CONSTRAINT admon_rollesopciones_pkey PRIMARY KEY (codigo);


--
-- Name: admon_si_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_si
    ADD CONSTRAINT admon_si_pkey PRIMARY KEY (codigo);


--
-- Name: admon_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY admon_usuarios
    ADD CONSTRAINT admon_usuarios_pkey PRIMARY KEY (usuario);


--
-- Name: sig_departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: galo; Tablespace: 
--

ALTER TABLE ONLY sig_departamentos
    ADD CONSTRAINT sig_departamentos_pkey PRIMARY KEY (coddep);


--
-- Name: admon_bitacoraauditoria_codopcion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_bitacoraauditoria
    ADD CONSTRAINT admon_bitacoraauditoria_codopcion_fkey FOREIGN KEY (codopcion) REFERENCES admon_opciones(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_empresas_codcontacto_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_empresas
    ADD CONSTRAINT admon_empresas_codcontacto_fkey FOREIGN KEY (codcontacto) REFERENCES admon_personas(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_empresassi_codsi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_empresassi
    ADD CONSTRAINT admon_empresassi_codsi_fkey FOREIGN KEY (codsi) REFERENCES admon_si(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_empresassi_nit_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_empresassi
    ADD CONSTRAINT admon_empresassi_nit_fkey FOREIGN KEY (nit) REFERENCES admon_empresas(nit) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_opciones_codsi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_opciones
    ADD CONSTRAINT admon_opciones_codsi_fkey FOREIGN KEY (codsi) REFERENCES admon_si(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_opciones_padre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_opciones
    ADD CONSTRAINT admon_opciones_padre_fkey FOREIGN KEY (padre) REFERENCES admon_opciones(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_registrospqr_codopcion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_registrospqr
    ADD CONSTRAINT admon_registrospqr_codopcion_fkey FOREIGN KEY (codopcion) REFERENCES admon_opciones(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_registrospqr_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_registrospqr
    ADD CONSTRAINT admon_registrospqr_usuario_fkey FOREIGN KEY (usuario) REFERENCES admon_usuarios(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_rollesopciones_codopcion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_rollesopciones
    ADD CONSTRAINT admon_rollesopciones_codopcion_fkey FOREIGN KEY (codopcion) REFERENCES admon_opciones(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_rollesopciones_codroll_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_rollesopciones
    ADD CONSTRAINT admon_rollesopciones_codroll_fkey FOREIGN KEY (codroll) REFERENCES admon_rolles(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_usuarios_codpersona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_usuarios
    ADD CONSTRAINT admon_usuarios_codpersona_fkey FOREIGN KEY (codpersona) REFERENCES admon_personas(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admon_usuarios_codroll_fkey; Type: FK CONSTRAINT; Schema: public; Owner: galo
--

ALTER TABLE ONLY admon_usuarios
    ADD CONSTRAINT admon_usuarios_codroll_fkey FOREIGN KEY (codroll) REFERENCES admon_rolles(codigo) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

