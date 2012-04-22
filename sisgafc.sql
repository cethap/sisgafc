--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'Standard public schema';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: dependencia; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE dependencia (
    id character varying(15) NOT NULL,
    nombre character varying(30) NOT NULL,
    descripcion text NOT NULL
);


ALTER TABLE public.dependencia OWNER TO unoraya;

--
-- Name: electrico; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE electrico (
    id_elemento character varying(15) NOT NULL,
    voltaje character varying(20) NOT NULL,
    amperaje character varying(15) NOT NULL,
    omnios character varying(15) NOT NULL
);


ALTER TABLE public.electrico OWNER TO unoraya;

--
-- Name: electronico; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE electronico (
    id_elemento character varying NOT NULL,
    serie character varying NOT NULL,
    especialidad text NOT NULL
);


ALTER TABLE public.electronico OWNER TO unoraya;

--
-- Name: elemento; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE elemento (
    id character varying(15) NOT NULL,
    marca character varying(30) NOT NULL,
    descripcion character varying(30) NOT NULL,
    tipo character varying(30)
);


ALTER TABLE public.elemento OWNER TO unoraya;

--
-- Name: entrada; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE entrada (
    id character varying(15) NOT NULL,
    entrada character varying(15) NOT NULL,
    fecha date NOT NULL
);


ALTER TABLE public.entrada OWNER TO unoraya;

--
-- Name: lista_orden; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE lista_orden (
    id_orden character varying(15) NOT NULL,
    id_elemento character varying(15) NOT NULL,
    medida character varying(15) NOT NULL,
    cantidad character varying(15) NOT NULL,
    valor_unitario character varying(15) NOT NULL,
    descuento character varying(5) NOT NULL
);


ALTER TABLE public.lista_orden OWNER TO unoraya;

--
-- Name: lista_remision; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE lista_remision (
    id_remision character varying(15) NOT NULL,
    id_elemento character varying(15) NOT NULL,
    cantidad_pendiente character varying(15),
    estado_remision character varying(10)
);


ALTER TABLE public.lista_remision OWNER TO unoraya;

--
-- Name: lista_salida; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE lista_salida (
    id_salida character varying(15) NOT NULL,
    id_elemento character varying(15) NOT NULL,
    cantidad character varying(10) NOT NULL
);


ALTER TABLE public.lista_salida OWNER TO unoraya;

--
-- Name: login; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE "login" (
    id_staff character varying(15) NOT NULL,
    estado character(1) NOT NULL,
    pass character varying(30) NOT NULL,
    usuario character varying(25) NOT NULL
);


ALTER TABLE public."login" OWNER TO unoraya;

--
-- Name: maquina; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE maquina (
    id_elemento character varying(15) NOT NULL,
    serie character varying(15) NOT NULL,
    fuente_energia character varying(30) NOT NULL,
    movimiento character varying(30) NOT NULL,
    bastidor character varying(30) NOT NULL
);


ALTER TABLE public.maquina OWNER TO unoraya;

--
-- Name: orden_compra_id_orden_seq; Type: SEQUENCE; Schema: public; Owner: unoraya
--

CREATE SEQUENCE orden_compra_id_orden_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.orden_compra_id_orden_seq OWNER TO unoraya;

--
-- Name: orden_compra_id_orden_seq; Type: SEQUENCE SET; Schema: public; Owner: unoraya
--

SELECT pg_catalog.setval('orden_compra_id_orden_seq', 1, false);


--
-- Name: ordencompra; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE ordencompra (
    id character varying(15) NOT NULL,
    id_proveedor character varying(15) NOT NULL,
    fecha date NOT NULL,
    tipo_pago character varying(20) NOT NULL
);


ALTER TABLE public.ordencompra OWNER TO unoraya;

--
-- Name: proveedor; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE proveedor (
    nit character varying(15) NOT NULL,
    razon_social character varying(30) NOT NULL,
    representante character varying(30) NOT NULL,
    direccion character varying(60) NOT NULL,
    telefono character varying(15) NOT NULL,
    movil character varying(15) NOT NULL,
    fax character varying(15) NOT NULL,
    mail character varying(50) NOT NULL,
    web character varying(30) NOT NULL,
    id character varying(15) NOT NULL
);


ALTER TABLE public.proveedor OWNER TO unoraya;

--
-- Name: remision; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE remision (
    id character varying(15) NOT NULL,
    id_orden character varying(15) NOT NULL
);


ALTER TABLE public.remision OWNER TO unoraya;

--
-- Name: salida; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE salida (
    id character varying NOT NULL,
    id_staff character varying NOT NULL,
    id_dependencia character varying NOT NULL,
    fecha date NOT NULL
);


ALTER TABLE public.salida OWNER TO unoraya;

--
-- Name: staff_personal; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE staff_personal (
    cedula character varying(15) NOT NULL,
    nombre character varying(30) NOT NULL,
    apellido character varying(30) NOT NULL,
    movil character varying(15),
    telefono character varying(15) NOT NULL,
    e_mail character varying(30) NOT NULL,
    cargo character varying(30) NOT NULL,
    id character varying(15) NOT NULL
);


ALTER TABLE public.staff_personal OWNER TO unoraya;

--
-- Name: store; Type: TABLE; Schema: public; Owner: unoraya; Tablespace: 
--

CREATE TABLE store (
    id_elemento character varying(15),
    cantidad integer
);


ALTER TABLE public.store OWNER TO unoraya;

--
-- Data for Name: dependencia; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY dependencia (id, nombre, descripcion) FROM stdin;
dp-2	talleres	taller
dp-3	contabilidad	contabilidad
dp-1	sistema	sistemas
dp-4	Salones	Salones
dp-5	Rectoria	Rectoria
dp-6	Recursos Humanos	Recursos Humanos
\.


--
-- Data for Name: electrico; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY electrico (id_elemento, voltaje, amperaje, omnios) FROM stdin;
\.


--
-- Data for Name: electronico; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY electronico (id_elemento, serie, especialidad) FROM stdin;
pd-1	6	mac
pd-2	6	mac
pd-3	7	mac
\.


--
-- Data for Name: elemento; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY elemento (id, marca, descripcion, tipo) FROM stdin;
pd-1	apple	computador	electronico
pd-2	mac	iphone	electronico
pd-3	mac	ipad	electronico
pd-4	rinix	sillas	fijo
pd-5	tinix	riza	consumo
\.


--
-- Data for Name: entrada; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY entrada (id, entrada, fecha) FROM stdin;
ent-1	orc-1	2012-03-15
\.


--
-- Data for Name: lista_orden; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY lista_orden (id_orden, id_elemento, medida, cantidad, valor_unitario, descuento) FROM stdin;
orc-1	pd-2	unidad	90	9000	5
orc-1	pd-3	unidad	90	9	5
ent-1	pd-2	unidad	90	9000	5
ent-1	pd-3	unidad	90	9	5
sal-1	pd-3		89		
\.


--
-- Data for Name: lista_remision; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY lista_remision (id_remision, id_elemento, cantidad_pendiente, estado_remision) FROM stdin;
\.


--
-- Data for Name: lista_salida; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY lista_salida (id_salida, id_elemento, cantidad) FROM stdin;
\.


--
-- Data for Name: login; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY "login" (id_staff, estado, pass, usuario) FROM stdin;
ps-01	1	sisgafc	sisgafc_1234
\.


--
-- Data for Name: maquina; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY maquina (id_elemento, serie, fuente_energia, movimiento, bastidor) FROM stdin;
\.


--
-- Data for Name: ordencompra; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY ordencompra (id, id_proveedor, fecha, tipo_pago) FROM stdin;
orc-1	pr-01	2012-03-15	contado
\.


--
-- Data for Name: proveedor; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY proveedor (nit, razon_social, representante, direccion, telefono, movil, fax, mail, web, id) FROM stdin;
pr-01	Palomitas S.A	jairo	(3.426376942737271, -76.52020454406738)	5467898	3112456787	67767676	jairo@palomitas.com	palomitas.com	pv-1
pr-02	Unoraya	Carlos Jimenez	(3.433231098912088, -76.53247833251953)	3275689	3114567898	7686786	carlos@unoraya.com	unoraya.com	pv-2
pr-03	Apple	Steve	(3.4517370745999605, -76.56612396240234)	3245676	3456789987	78998789	steve@apple.com	apple.com	pv-3
\.


--
-- Data for Name: remision; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY remision (id, id_orden) FROM stdin;
\.


--
-- Data for Name: salida; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY salida (id, id_staff, id_dependencia, fecha) FROM stdin;
sal-1	11443567898	dp-3	2012-03-15
\.


--
-- Data for Name: staff_personal; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY staff_personal (cedula, nombre, apellido, movil, telefono, e_mail, cargo, id) FROM stdin;
1144139549	cesar	tapasco	3245678876	32757887	cethap_5@hotmail.com	administrador	ps-01
112345676	Adolfo	Azcarate	3270663	3114567889	almacen	cethapgames@gmail.com	ps-4
11443567898	rafael	lara	3245676	3245678987	lara@hotmail.com	almacenista	ps-2
11234656	ricardo	tapasco	3245678	3113456785	ricardo@gmail.com 	gerente	ps-3
\.


--
-- Data for Name: store; Type: TABLE DATA; Schema: public; Owner: unoraya
--

COPY store (id_elemento, cantidad) FROM stdin;
pd-1	0
pd-2	90
pd-3	90
pd-4	0
pd-5	0
\.


--
-- Name: dependencia_id_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT dependencia_id_key UNIQUE (id);


--
-- Name: dependencia_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT dependencia_pkey PRIMARY KEY (id);


--
-- Name: electrico_id_elemento_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY electrico
    ADD CONSTRAINT electrico_id_elemento_key UNIQUE (id_elemento);


--
-- Name: electronico_id_elemento_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY electronico
    ADD CONSTRAINT electronico_id_elemento_key UNIQUE (id_elemento);


--
-- Name: elemento_id_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY elemento
    ADD CONSTRAINT elemento_id_key UNIQUE (id);


--
-- Name: elemento_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY elemento
    ADD CONSTRAINT elemento_pkey PRIMARY KEY (id);


--
-- Name: entrada_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY entrada
    ADD CONSTRAINT entrada_pkey PRIMARY KEY (id);


--
-- Name: login_id_staff_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY "login"
    ADD CONSTRAINT login_id_staff_key UNIQUE (id_staff);


--
-- Name: login_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY "login"
    ADD CONSTRAINT login_pkey PRIMARY KEY (usuario);


--
-- Name: maquina_id_elemento_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY maquina
    ADD CONSTRAINT maquina_id_elemento_key UNIQUE (id_elemento);


--
-- Name: ordencompra_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY ordencompra
    ADD CONSTRAINT ordencompra_pkey PRIMARY KEY (id);


--
-- Name: proveedor_id_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT proveedor_id_key UNIQUE (id);


--
-- Name: proveedor_nit_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT proveedor_nit_key UNIQUE (nit);


--
-- Name: proveedor_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT proveedor_pkey PRIMARY KEY (nit);


--
-- Name: remision_id_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY remision
    ADD CONSTRAINT remision_id_key UNIQUE (id);


--
-- Name: remision_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY remision
    ADD CONSTRAINT remision_pkey PRIMARY KEY (id);


--
-- Name: salida_id_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY salida
    ADD CONSTRAINT salida_id_key UNIQUE (id);


--
-- Name: salida_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY salida
    ADD CONSTRAINT salida_pkey PRIMARY KEY (id);


--
-- Name: staff_personal_cedula_key; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY staff_personal
    ADD CONSTRAINT staff_personal_cedula_key UNIQUE (cedula);


--
-- Name: staff_personal_pkey; Type: CONSTRAINT; Schema: public; Owner: unoraya; Tablespace: 
--

ALTER TABLE ONLY staff_personal
    ADD CONSTRAINT staff_personal_pkey PRIMARY KEY (id);


--
-- Name: electrico_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY electrico
    ADD CONSTRAINT electrico_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: electronico_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY electronico
    ADD CONSTRAINT electronico_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: lista_orden_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY lista_orden
    ADD CONSTRAINT lista_orden_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: lista_remision_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY lista_remision
    ADD CONSTRAINT lista_remision_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: lista_remision_id_remision_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY lista_remision
    ADD CONSTRAINT lista_remision_id_remision_fkey FOREIGN KEY (id_remision) REFERENCES remision(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: lista_salida_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY lista_salida
    ADD CONSTRAINT lista_salida_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: lista_salida_id_salida_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY lista_salida
    ADD CONSTRAINT lista_salida_id_salida_fkey FOREIGN KEY (id_salida) REFERENCES salida(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: login_id_staff_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY "login"
    ADD CONSTRAINT login_id_staff_fkey FOREIGN KEY (id_staff) REFERENCES staff_personal(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: maquina_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY maquina
    ADD CONSTRAINT maquina_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: ordencompra_id_proveedor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY ordencompra
    ADD CONSTRAINT ordencompra_id_proveedor_fkey FOREIGN KEY (id_proveedor) REFERENCES proveedor(nit) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: remision_id_orden_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY remision
    ADD CONSTRAINT remision_id_orden_fkey FOREIGN KEY (id_orden) REFERENCES ordencompra(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: salida_id_dependencia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY salida
    ADD CONSTRAINT salida_id_dependencia_fkey FOREIGN KEY (id_dependencia) REFERENCES dependencia(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: store_id_elemento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: unoraya
--

ALTER TABLE ONLY store
    ADD CONSTRAINT store_id_elemento_fkey FOREIGN KEY (id_elemento) REFERENCES elemento(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: dependencia; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE dependencia FROM PUBLIC;
REVOKE ALL ON TABLE dependencia FROM unoraya;
GRANT ALL ON TABLE dependencia TO unoraya;
GRANT ALL ON TABLE dependencia TO unoraya_system;


--
-- Name: electrico; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE electrico FROM PUBLIC;
REVOKE ALL ON TABLE electrico FROM unoraya;
GRANT ALL ON TABLE electrico TO unoraya;
GRANT ALL ON TABLE electrico TO unoraya_system;


--
-- Name: electronico; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE electronico FROM PUBLIC;
REVOKE ALL ON TABLE electronico FROM unoraya;
GRANT ALL ON TABLE electronico TO unoraya;
GRANT ALL ON TABLE electronico TO unoraya_system;


--
-- Name: elemento; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE elemento FROM PUBLIC;
REVOKE ALL ON TABLE elemento FROM unoraya;
GRANT ALL ON TABLE elemento TO unoraya;
GRANT ALL ON TABLE elemento TO unoraya_system;


--
-- Name: entrada; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE entrada FROM PUBLIC;
REVOKE ALL ON TABLE entrada FROM unoraya;
GRANT ALL ON TABLE entrada TO unoraya;
GRANT ALL ON TABLE entrada TO unoraya_system;


--
-- Name: lista_orden; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE lista_orden FROM PUBLIC;
REVOKE ALL ON TABLE lista_orden FROM unoraya;
GRANT ALL ON TABLE lista_orden TO unoraya;
GRANT ALL ON TABLE lista_orden TO unoraya_system;


--
-- Name: lista_remision; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE lista_remision FROM PUBLIC;
REVOKE ALL ON TABLE lista_remision FROM unoraya;
GRANT ALL ON TABLE lista_remision TO unoraya;


--
-- Name: lista_salida; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE lista_salida FROM PUBLIC;
REVOKE ALL ON TABLE lista_salida FROM unoraya;
GRANT ALL ON TABLE lista_salida TO unoraya;
GRANT ALL ON TABLE lista_salida TO unoraya_system;


--
-- Name: login; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE "login" FROM PUBLIC;
REVOKE ALL ON TABLE "login" FROM unoraya;
GRANT ALL ON TABLE "login" TO unoraya;
GRANT ALL ON TABLE "login" TO unoraya_system;


--
-- Name: maquina; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE maquina FROM PUBLIC;
REVOKE ALL ON TABLE maquina FROM unoraya;
GRANT ALL ON TABLE maquina TO unoraya;
GRANT ALL ON TABLE maquina TO unoraya_system;


--
-- Name: orden_compra_id_orden_seq; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE orden_compra_id_orden_seq FROM PUBLIC;
REVOKE ALL ON TABLE orden_compra_id_orden_seq FROM unoraya;
GRANT ALL ON TABLE orden_compra_id_orden_seq TO unoraya;
GRANT ALL ON TABLE orden_compra_id_orden_seq TO unoraya_system;


--
-- Name: ordencompra; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE ordencompra FROM PUBLIC;
REVOKE ALL ON TABLE ordencompra FROM unoraya;
GRANT ALL ON TABLE ordencompra TO unoraya;
GRANT ALL ON TABLE ordencompra TO unoraya_system;


--
-- Name: proveedor; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE proveedor FROM PUBLIC;
REVOKE ALL ON TABLE proveedor FROM unoraya;
GRANT ALL ON TABLE proveedor TO unoraya;
GRANT ALL ON TABLE proveedor TO unoraya_system;


--
-- Name: remision; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE remision FROM PUBLIC;
REVOKE ALL ON TABLE remision FROM unoraya;
GRANT ALL ON TABLE remision TO unoraya;
GRANT ALL ON TABLE remision TO unoraya_sisgafc;
GRANT ALL ON TABLE remision TO unoraya_system;


--
-- Name: salida; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE salida FROM PUBLIC;
REVOKE ALL ON TABLE salida FROM unoraya;
GRANT ALL ON TABLE salida TO unoraya;
GRANT ALL ON TABLE salida TO unoraya_system;


--
-- Name: staff_personal; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE staff_personal FROM PUBLIC;
REVOKE ALL ON TABLE staff_personal FROM unoraya;
GRANT ALL ON TABLE staff_personal TO unoraya;
GRANT ALL ON TABLE staff_personal TO unoraya_system;


--
-- Name: store; Type: ACL; Schema: public; Owner: unoraya
--

REVOKE ALL ON TABLE store FROM PUBLIC;
REVOKE ALL ON TABLE store FROM unoraya;
GRANT ALL ON TABLE store TO unoraya;
GRANT ALL ON TABLE store TO unoraya_system;


--
-- PostgreSQL database dump complete
--

