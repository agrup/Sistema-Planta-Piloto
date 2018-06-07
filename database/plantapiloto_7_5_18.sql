--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.8
-- Dumped by pg_dump version 9.6.8

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: detalle_salidas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.detalle_salidas (
    id integer NOT NULL,
    tipo text,
    id_movimiento integer,
    detalle text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.detalle_salidas OWNER TO postgres;

--
-- Name: detalle_salidas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.detalle_salidas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.detalle_salidas_id_seq OWNER TO postgres;

--
-- Name: detalle_salidas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.detalle_salidas_id_seq OWNED BY public.detalle_salidas.id;


--
-- Name: formulacions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.formulacions (
    id integer NOT NULL,
    "idFormulacion" integer NOT NULL,
    id_producto integer,
    "idIngrediente" integer,
    "cantidadIngrediete" integer,
    estado boolean,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.formulacions OWNER TO postgres;

--
-- Name: formulacions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.formulacions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.formulacions_id_seq OWNER TO postgres;

--
-- Name: formulacions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.formulacions_id_seq OWNED BY public.formulacions.id;


--
-- Name: jornadas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jornadas (
    id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.jornadas OWNER TO postgres;

--
-- Name: jornadas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jornadas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jornadas_id_seq OWNER TO postgres;

--
-- Name: jornadas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jornadas_id_seq OWNED BY public.jornadas.id;


--
-- Name: lotes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lotes (
    id integer NOT NULL,
    producto_id integer NOT NULL,
    "fechaInicio" date,
    "fechaInicioMaduracion" date,
    "fechaFinalizacion" date,
    "fechaVencimiento" date,
    "cantidadElavorada" double precision,
    "cantidadFinal" double precision,
    "tipoTP" boolean,
    asignatura text,
    costounitario double precision,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.lotes OWNER TO postgres;

--
-- Name: lotes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lotes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lotes_id_seq OWNER TO postgres;

--
-- Name: lotes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lotes_id_seq OWNED BY public.lotes.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: movimientos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.movimientos (
    id integer NOT NULL,
    "idLoteConsumidor" integer,
    "idLoteIngrediente" integer,
    fecha timestamp(0) without time zone,
    codigo integer,
    debe double precision,
    haber double precision,
    saldoglobal double precision,
    "saldoLote" double precision,
    tipo integer,
    planificacion_id integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.movimientos OWNER TO postgres;

--
-- Name: movimientos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.movimientos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movimientos_id_seq OWNER TO postgres;

--
-- Name: movimientos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.movimientos_id_seq OWNED BY public.movimientos.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO postgres;

--
-- Name: planificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.planificaciones (
    id integer NOT NULL,
    fecha date,
    "diaSemana" text,
    descripcion text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.planificaciones OWNER TO postgres;

--
-- Name: planificaciones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.planificaciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.planificaciones_id_seq OWNER TO postgres;

--
-- Name: planificaciones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.planificaciones_id_seq OWNED BY public.planificaciones.id;


--
-- Name: planificacions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.planificacions (
    id integer NOT NULL,
    fecha date,
    "diaSemana" text,
    descripcion text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.planificacions OWNER TO postgres;

--
-- Name: planificacions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.planificacions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.planificacions_id_seq OWNER TO postgres;

--
-- Name: planificacions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.planificacions_id_seq OWNED BY public.planificacions.id;


--
-- Name: producto_productoi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.producto_productoi (
    producto_id integer NOT NULL,
    ingrediente_id integer NOT NULL,
    cantidad double precision NOT NULL,
    "cantidadProducto" double precision NOT NULL
);


ALTER TABLE public.producto_productoi OWNER TO postgres;

--
-- Name: productos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.productos (
    id integer NOT NULL,
    nombre text,
    descripcion text,
    "tipoUnidad" text,
    codigo text,
    "alarmaActiva" boolean,
    "alarmaAmarilla" integer,
    "alarmaRoja" integer,
    categoria text,
    estado boolean,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.productos OWNER TO postgres;

--
-- Name: productos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.productos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.productos_id_seq OWNER TO postgres;

--
-- Name: productos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.productos_id_seq OWNED BY public.productos.id;


--
-- Name: proveedors; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.proveedors (
    id integer NOT NULL,
    nombre text,
    telefono text,
    rubro text,
    localidad text,
    provincia text,
    pais text,
    email text,
    cp integer,
    direccion text,
    "nombreContacto" text,
    estado boolean,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.proveedors OWNER TO postgres;

--
-- Name: proveedors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.proveedors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.proveedors_id_seq OWNER TO postgres;

--
-- Name: proveedors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.proveedors_id_seq OWNED BY public.proveedors.id;


--
-- Name: trabajadors; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.trabajadors (
    id integer NOT NULL,
    legajo integer NOT NULL,
    "idPersona" integer,
    sector text,
    puesto text,
    seudonimo text,
    estado boolean,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.trabajadors OWNER TO postgres;

--
-- Name: trabajadors_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.trabajadors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trabajadors_id_seq OWNER TO postgres;

--
-- Name: trabajadors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.trabajadors_id_seq OWNED BY public.trabajadors.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: detalle_salidas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalle_salidas ALTER COLUMN id SET DEFAULT nextval('public.detalle_salidas_id_seq'::regclass);


--
-- Name: formulacions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulacions ALTER COLUMN id SET DEFAULT nextval('public.formulacions_id_seq'::regclass);


--
-- Name: jornadas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jornadas ALTER COLUMN id SET DEFAULT nextval('public.jornadas_id_seq'::regclass);


--
-- Name: lotes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lotes ALTER COLUMN id SET DEFAULT nextval('public.lotes_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: movimientos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos ALTER COLUMN id SET DEFAULT nextval('public.movimientos_id_seq'::regclass);


--
-- Name: planificaciones id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.planificaciones ALTER COLUMN id SET DEFAULT nextval('public.planificaciones_id_seq'::regclass);


--
-- Name: planificacions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.planificacions ALTER COLUMN id SET DEFAULT nextval('public.planificacions_id_seq'::regclass);


--
-- Name: productos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos ALTER COLUMN id SET DEFAULT nextval('public.productos_id_seq'::regclass);


--
-- Name: proveedors id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proveedors ALTER COLUMN id SET DEFAULT nextval('public.proveedors_id_seq'::regclass);


--
-- Name: trabajadors id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trabajadors ALTER COLUMN id SET DEFAULT nextval('public.trabajadors_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: detalle_salidas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.detalle_salidas (id, tipo, id_movimiento, detalle, created_at, updated_at) FROM stdin;
\.


--
-- Name: detalle_salidas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.detalle_salidas_id_seq', 1, false);


--
-- Data for Name: formulacions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.formulacions (id, "idFormulacion", id_producto, "idIngrediente", "cantidadIngrediete", estado, created_at, updated_at) FROM stdin;
\.


--
-- Name: formulacions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.formulacions_id_seq', 1, false);


--
-- Data for Name: jornadas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jornadas (id, created_at, updated_at) FROM stdin;
\.


--
-- Name: jornadas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jornadas_id_seq', 1, false);


--
-- Data for Name: lotes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lotes (id, producto_id, "fechaInicio", "fechaInicioMaduracion", "fechaFinalizacion", "fechaVencimiento", "cantidadElavorada", "cantidadFinal", "tipoTP", asignatura, costounitario, created_at, updated_at) FROM stdin;
1	26	2018-05-06	2018-05-04	2018-05-09	2018-05-10	103	61	t	v1Q5y	111	2018-05-05 23:10:29	2018-05-05 23:10:29
\.


--
-- Name: lotes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lotes_id_seq', 1, true);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
6	2018_05_02_215155_create_detalle_salidas_table	1
83	2018_05_02_220236_create_trabajadores_table	2
387	2014_10_12_000000_create_users_table	6
388	2014_10_12_100000_create_password_resets_table	6
389	2018_05_02_205449_create_productos_table	6
390	2018_05_02_205504_create_lotes_table	6
272	2018_05_02_205512_create_proveedores_table	3
391	2018_05_02_205512_create_proveedors_table	6
392	2018_05_02_215306_create_formulacions_table	6
393	2018_05_02_215334_create_jornadas_table	6
394	2018_05_02_232900_create_movimientos_table	6
395	2018_05_02_235556_create_planificacions_table	6
396	2018_05_02_245155_create_detalle_salidas_table	6
397	2018_05_04_022402_create_trabajadors_table	6
292	2018_05_02_215306_create_formulaciones_table	4
356	2018_05_02_235556_create_planificaciones_table	5
\.


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 397, true);


--
-- Data for Name: movimientos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.movimientos (id, "idLoteConsumidor", "idLoteIngrediente", fecha, codigo, debe, haber, saldoglobal, "saldoLote", tipo, planificacion_id, created_at, updated_at) FROM stdin;
1	34	16	2018-05-10 20:32:25	40	31	31	47	30	1	\N	2018-05-05 23:16:32	2018-05-05 23:16:32
2	19	38	2018-05-02 18:03:19	17	4	22	24	43	1	\N	2018-05-05 23:16:37	2018-05-05 23:16:37
3	40	30	2018-05-09 11:40:19	31	35	16	30	6	1	\N	2018-05-05 23:16:38	2018-05-05 23:16:38
4	9	41	2018-05-10 11:35:29	39	35	5	27	28	1	\N	2018-05-05 23:16:39	2018-05-05 23:16:39
5	11	20	2018-05-05 12:44:02	7	1	37	3	49	1	\N	2018-05-05 23:16:40	2018-05-05 23:16:40
\.


--
-- Name: movimientos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.movimientos_id_seq', 5, true);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_resets (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: planificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.planificaciones (id, fecha, "diaSemana", descripcion, created_at, updated_at) FROM stdin;
\.


--
-- Name: planificaciones_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.planificaciones_id_seq', 1, false);


--
-- Data for Name: planificacions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.planificacions (id, fecha, "diaSemana", descripcion, created_at, updated_at) FROM stdin;
1	2018-05-07	Lunes	Est distinctio aliquid ratione ut.	2018-05-05 23:17:59	2018-05-05 23:17:59
2	2018-05-10	Lunes	Tempore incidunt dolorum quo et.	2018-05-05 23:18:00	2018-05-05 23:18:00
3	2018-05-05	Lunes	Cupiditate non iure quas impedit ea delectus quo commodi.	2018-05-05 23:18:00	2018-05-05 23:18:00
\.


--
-- Name: planificacions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.planificacions_id_seq', 3, true);


--
-- Data for Name: producto_productoi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.producto_productoi (producto_id, ingrediente_id, cantidad, "cantidadProducto") FROM stdin;
2	2	2	10
2	3	3	15
2	1	4	15
1	2	4	15
1	3	4	12
3	5	4	12
3	6	4	12
4	6	4	12
4	5	4	12
4	4	4	12
5	4	4	12
5	2	4	12
\.


--
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.productos (id, nombre, descripcion, "tipoUnidad", codigo, "alarmaActiva", "alarmaAmarilla", "alarmaRoja", categoria, estado, created_at, updated_at) FROM stdin;
1	Dr. Russel Heller PhD	Explicabo doloribus nostrum praesentium voluptatem.	Bk	9q6TY	t	21	\N	\N	\N	2018-05-06 17:25:45	2018-05-06 17:25:45
2	Bennett Ullrich Sr.	Molestiae neque non ad ex qui qui.	U0	8j5zg	t	21	\N	\N	\N	2018-05-06 17:25:47	2018-05-06 17:25:47
3	Tristin Sporer	Eum consectetur rem consequatur repellendus debitis.	Bj	8JMi6	t	21	\N	\N	\N	2018-05-06 17:25:48	2018-05-06 17:25:48
4	Margarita Bins	Quibusdam tenetur deserunt quis non incidunt.	t8	fm7A8	f	21	\N	\N	\N	2018-05-06 17:25:48	2018-05-06 17:25:48
5	Dr. Zackery Bergnaum	Eius numquam numquam nobis eius est in.	K4	EAiaB	t	21	\N	\N	\N	2018-05-06 17:25:49	2018-05-06 17:25:49
6	Mr. Billy Zboncak	Quidem magni autem necessitatibus et.	G8	P9HnC	f	21	\N	\N	f	2018-05-07 03:14:44	2018-05-07 03:14:44
\.


--
-- Name: productos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.productos_id_seq', 6, true);


--
-- Data for Name: proveedors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.proveedors (id, nombre, telefono, rubro, localidad, provincia, pais, email, cp, direccion, "nombreContacto", estado, created_at, updated_at) FROM stdin;
\.


--
-- Name: proveedors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.proveedors_id_seq', 1, false);


--
-- Data for Name: trabajadors; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.trabajadors (id, legajo, "idPersona", sector, puesto, seudonimo, estado, created_at, updated_at) FROM stdin;
\.


--
-- Name: trabajadors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.trabajadors_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: detalle_salidas detalle_salidas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalle_salidas
    ADD CONSTRAINT detalle_salidas_pkey PRIMARY KEY (id);


--
-- Name: formulacions formulacions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.formulacions
    ADD CONSTRAINT formulacions_pkey PRIMARY KEY (id);


--
-- Name: jornadas jornadas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jornadas
    ADD CONSTRAINT jornadas_pkey PRIMARY KEY (id);


--
-- Name: lotes lotes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lotes
    ADD CONSTRAINT lotes_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: movimientos movimientos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.movimientos
    ADD CONSTRAINT movimientos_pkey PRIMARY KEY (id);


--
-- Name: planificaciones planificaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.planificaciones
    ADD CONSTRAINT planificaciones_pkey PRIMARY KEY (id);


--
-- Name: planificacions planificacions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.planificacions
    ADD CONSTRAINT planificacions_pkey PRIMARY KEY (id);


--
-- Name: producto_productoi producto_productoi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.producto_productoi
    ADD CONSTRAINT producto_productoi_pkey PRIMARY KEY (producto_id, ingrediente_id);


--
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id);


--
-- Name: proveedors proveedors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.proveedors
    ADD CONSTRAINT proveedors_pkey PRIMARY KEY (id);


--
-- Name: trabajadors trabajadors_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trabajadors
    ADD CONSTRAINT trabajadors_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- PostgreSQL database dump complete
--

