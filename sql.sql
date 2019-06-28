--
-- PostgreSQL database dump
--

-- Dumped from database version 10.9 (Ubuntu 10.9-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.9 (Ubuntu 10.9-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
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
-- Name: duplas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.duplas (
    id integer NOT NULL,
    id_etapa integer,
    id_jogador1 integer,
    id_jogador2 integer
);


ALTER TABLE public.duplas OWNER TO postgres;

--
-- Name: duplas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.duplas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.duplas_id_seq OWNER TO postgres;

--
-- Name: duplas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.duplas_id_seq OWNED BY public.duplas.id;


--
-- Name: etapas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etapas (
    id integer NOT NULL,
    mes integer,
    ano integer
);


ALTER TABLE public.etapas OWNER TO postgres;

--
-- Name: etapas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.etapas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etapas_id_seq OWNER TO postgres;

--
-- Name: etapas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.etapas_id_seq OWNED BY public.etapas.id;


--
-- Name: jogadores; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jogadores (
    id integer NOT NULL,
    nome character varying(255),
    pontuacao integer
);


ALTER TABLE public.jogadores OWNER TO postgres;

--
-- Name: jogadores_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jogadores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jogadores_id_seq OWNER TO postgres;

--
-- Name: jogadores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jogadores_id_seq OWNED BY public.jogadores.id;


--
-- Name: partidas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partidas (
    id integer NOT NULL,
    id_dupla1 integer,
    pontos_dupla1 integer,
    id_dupla2 integer,
    pontos_dupla2 integer,
    id_etapa integer,
    chave character varying(1)
);


ALTER TABLE public.partidas OWNER TO postgres;

--
-- Name: partidas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.partidas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.partidas_id_seq OWNER TO postgres;

--
-- Name: partidas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.partidas_id_seq OWNED BY public.partidas.id;


--
-- Name: duplas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.duplas ALTER COLUMN id SET DEFAULT nextval('public.duplas_id_seq'::regclass);


--
-- Name: etapas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapas ALTER COLUMN id SET DEFAULT nextval('public.etapas_id_seq'::regclass);


--
-- Name: jogadores id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jogadores ALTER COLUMN id SET DEFAULT nextval('public.jogadores_id_seq'::regclass);


--
-- Name: partidas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas ALTER COLUMN id SET DEFAULT nextval('public.partidas_id_seq'::regclass);


--
-- Data for Name: duplas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.duplas (id, id_etapa, id_jogador1, id_jogador2) FROM stdin;
1	1	1	2
2	1	3	4
3	1	5	6
4	1	7	8
5	1	9	10
6	1	11	12
7	1	13	14
8	1	15	16
9	1	17	18
10	1	19	20
11	1	21	22
12	1	23	24
13	1	25	26
14	1	27	28
15	1	29	30
16	1	31	32
\.


--
-- Data for Name: etapas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.etapas (id, mes, ano) FROM stdin;
1	6	2019
\.


--
-- Data for Name: jogadores; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jogadores (id, nome, pontuacao) FROM stdin;
1	Wilda	200
2	Rose	200
3	Heloísa	80
5	Giza	70
6	Rita	70
7	Airton	110
8	Regina	110
9	Ana Alice	80
10	Tininha	80
11	Genecy	50
12	Lena	50
13	Juracy	90
14	Roseane	90
15	Ana Maria G	80
16	Maria Ines	80
17	Carlos Eduardo	280
18	Patrícia	280
19	Helaine	70
20	Marlene	70
21	Diva	140
22	Loka	140
23	Lenir	80
24	Maria do Carmo	80
25	Chuca	40
26	Danilo	40
28	Varlete	30
29	Everton	210
27	Tania	70
103	Everton Catto	1200
30	Fabrizio	210
31	Vera	180
\.


--
-- Data for Name: partidas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partidas (id, id_dupla1, pontos_dupla1, id_dupla2, pontos_dupla2, id_etapa, chave) FROM stdin;
5	11	\N	10	\N	1	A
6	5	\N	10	\N	1	A
7	15	\N	4	\N	1	B
8	15	\N	12	\N	1	B
9	15	\N	14	\N	1	B
10	4	\N	12	\N	1	B
11	4	\N	14	\N	1	B
12	12	\N	14	\N	1	B
13	16	\N	7	\N	1	C
14	16	\N	2	\N	1	C
15	16	\N	6	\N	1	C
16	7	\N	2	\N	1	C
17	7	\N	6	\N	1	C
18	2	\N	6	\N	1	C
19	1	\N	8	\N	1	D
20	1	\N	3	\N	1	D
21	1	\N	13	\N	1	D
22	8	\N	3	\N	1	D
23	8	\N	13	\N	1	D
24	3	\N	13	\N	1	D
1	9	120	11	156	1	A
2	9	454	5	45	1	A
3	9	54	10	544	1	A
4	11	54	5	5	1	A
\.


--
-- Name: duplas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.duplas_id_seq', 16, true);


--
-- Name: etapas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etapas_id_seq', 13, true);


--
-- Name: jogadores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jogadores_id_seq', 103, true);


--
-- Name: partidas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partidas_id_seq', 24, true);


--
-- PostgreSQL database dump complete
--

