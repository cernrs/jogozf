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
-- Name: dupla; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dupla (
    id integer NOT NULL,
    id_etapa integer NOT NULL,
    id_jogador1 integer NOT NULL,
    id_jogador2 integer NOT NULL
);


ALTER TABLE public.dupla OWNER TO postgres;

--
-- Name: dupla_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dupla_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dupla_id_seq OWNER TO postgres;

--
-- Name: dupla_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dupla_id_seq OWNED BY public.dupla.id;


--
-- Name: etapa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.etapa (
    id integer NOT NULL,
    mes integer NOT NULL,
    ano integer NOT NULL
);


ALTER TABLE public.etapa OWNER TO postgres;

--
-- Name: etapa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.etapa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.etapa_id_seq OWNER TO postgres;

--
-- Name: etapa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.etapa_id_seq OWNED BY public.etapa.id;


--
-- Name: jogador; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jogador (
    id integer NOT NULL,
    nome character varying(150) NOT NULL,
    pontuacao integer NOT NULL
);


ALTER TABLE public.jogador OWNER TO postgres;

--
-- Name: jogador_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jogador_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jogador_id_seq OWNER TO postgres;

--
-- Name: jogador_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jogador_id_seq OWNED BY public.jogador.id;


--
-- Name: dupla id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dupla ALTER COLUMN id SET DEFAULT nextval('public.dupla_id_seq'::regclass);


--
-- Name: etapa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapa ALTER COLUMN id SET DEFAULT nextval('public.etapa_id_seq'::regclass);


--
-- Name: jogador id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jogador ALTER COLUMN id SET DEFAULT nextval('public.jogador_id_seq'::regclass);


--
-- Data for Name: dupla; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.dupla (id, id_etapa, id_jogador1, id_jogador2) FROM stdin;
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
17	2	17	18
18	2	7	8
19	2	11	12
20	2	25	26
21	2	1	2
22	2	5	6
23	2	19	20
24	2	15	16
25	2	21	33
26	2	23	24
27	2	9	10
28	2	3	4
\.


--
-- Data for Name: etapa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.etapa (id, mes, ano) FROM stdin;
1	6	2019
2	7	2019
\.


--
-- Data for Name: jogador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jogador (id, nome, pontuacao) FROM stdin;
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
30	Fabrizio	210
31	Vera	180
32	Eduardo	200
33	Valmocir	100
4	Paulo	100
\.


--
-- Name: dupla_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.dupla_id_seq', 28, true);


--
-- Name: etapa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.etapa_id_seq', 2, true);


--
-- Name: jogador_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jogador_id_seq', 33, true);


--
-- Name: dupla dupla_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dupla
    ADD CONSTRAINT dupla_pkey PRIMARY KEY (id);


--
-- Name: etapa etapa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.etapa
    ADD CONSTRAINT etapa_pkey PRIMARY KEY (id);


--
-- Name: jogador jogador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jogador
    ADD CONSTRAINT jogador_pkey PRIMARY KEY (id);


--
-- Name: dupla dupla_id_etapa_etapa_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dupla
    ADD CONSTRAINT dupla_id_etapa_etapa_id FOREIGN KEY (id_etapa) REFERENCES public.etapa(id);


--
-- PostgreSQL database dump complete
--

