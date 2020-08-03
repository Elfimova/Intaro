--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;

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
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public."user" (
    name character(255) NOT NULL,
    surname character(255) NOT NULL,
    patronymic character(255) NOT NULL,
    email character(255) NOT NULL,
    phone character(50) NOT NULL,
    email_manager character(255) DEFAULT 'dasha.elfimova@gmail.com'::bpchar NOT NULL,
    date_add timestamp without time zone NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (name, surname, patronymic, email, phone, email_manager, date_add) FROM stdin;
Иван                                                                                                                                                                                                                                                           	Плотников                                                                                                                                                                                                                                                      	Иванович                                                                                                                                                                                                                                                       	1236564@gmail.com                                                                                                                                                                                                                                              	+7(909)122-14-07                                  	dasha.elfimova@gmail.com                                                                                                                                                                                                                                       	2020-08-03 22:33:18.683
\.


--
-- Name: user_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pk PRIMARY KEY (email);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

