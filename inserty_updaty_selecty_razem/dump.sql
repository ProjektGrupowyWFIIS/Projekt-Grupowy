--
-- PostgreSQL database dump
--

-- Dumped from database version 10.7
-- Dumped by pg_dump version 10.7

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
-- Name: attributes; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA attributes;


ALTER SCHEMA attributes OWNER TO postgres;

--
-- Name: categories; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA categories;


ALTER SCHEMA categories OWNER TO postgres;

--
-- Name: energy_resources; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA energy_resources;


ALTER SCHEMA energy_resources OWNER TO postgres;

--
-- Name: factors; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA factors;


ALTER SCHEMA factors OWNER TO postgres;

--
-- Name: files; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA files;


ALTER SCHEMA files OWNER TO postgres;

--
-- Name: resources; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA resources;


ALTER SCHEMA resources OWNER TO postgres;

--
-- Name: units; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA units;


ALTER SCHEMA units OWNER TO postgres;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: attribute_name; Type: DOMAIN; Schema: attributes; Owner: postgres
--

CREATE DOMAIN attributes.attribute_name AS character varying(30);


ALTER DOMAIN attributes.attribute_name OWNER TO postgres;

--
-- Name: attribute_type; Type: TYPE; Schema: attributes; Owner: postgres
--

CREATE TYPE attributes.attribute_type AS ENUM (
    'free',
    'enum'
);


ALTER TYPE attributes.attribute_type OWNER TO postgres;

--
-- Name: attribute_value; Type: DOMAIN; Schema: attributes; Owner: postgres
--

CREATE DOMAIN attributes.attribute_value AS character varying(200);


ALTER DOMAIN attributes.attribute_value OWNER TO postgres;

--
-- Name: resource_name; Type: DOMAIN; Schema: energy_resources; Owner: postgres
--

CREATE DOMAIN energy_resources.resource_name AS character varying(200);


ALTER DOMAIN energy_resources.resource_name OWNER TO postgres;

--
-- Name: file_types; Type: TYPE; Schema: files; Owner: postgres
--

CREATE TYPE files.file_types AS ENUM (
    'pdf',
    'xls',
    'csv',
    'doc',
    'txt',
    'png',
    'jpg'
);


ALTER TYPE files.file_types OWNER TO postgres;

--
-- Name: resource_name; Type: DOMAIN; Schema: resources; Owner: postgres
--

CREATE DOMAIN resources.resource_name AS character varying(200);


ALTER DOMAIN resources.resource_name OWNER TO postgres;

--
-- Name: ratio_domain; Type: DOMAIN; Schema: units; Owner: postgres
--

CREATE DOMAIN units.ratio_domain AS double precision
	CONSTRAINT ratio_ge_0 CHECK ((VALUE >= (0)::double precision));


ALTER DOMAIN units.ratio_domain OWNER TO postgres;

--
-- Name: ratio_nz_domain; Type: DOMAIN; Schema: units; Owner: postgres
--

CREATE DOMAIN units.ratio_nz_domain AS double precision
	CONSTRAINT ratio_gt_0 CHECK ((VALUE > (0)::double precision));


ALTER DOMAIN units.ratio_nz_domain OWNER TO postgres;

--
-- Name: uncertainty; Type: DOMAIN; Schema: units; Owner: postgres
--

CREATE DOMAIN units.uncertainty AS double precision
	CONSTRAINT unc_interval CHECK (((VALUE >= (0)::double precision) AND (VALUE <= (100)::double precision)));


ALTER DOMAIN units.uncertainty OWNER TO postgres;

--
-- Name: unit_domain; Type: DOMAIN; Schema: units; Owner: postgres
--

CREATE DOMAIN units.unit_domain AS character varying(10);


ALTER DOMAIN units.unit_domain OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: attribute_enums; Type: TABLE; Schema: attributes; Owner: postgres
--

CREATE TABLE attributes.attribute_enums (
    attribute_id integer NOT NULL,
    attribute_value_pl attributes.attribute_value NOT NULL,
    attribute_value_eng attributes.attribute_value NOT NULL,
    attribute_value_description_pl text DEFAULT ''::text NOT NULL,
    attribute_value_description_eng text DEFAULT ''::text NOT NULL
);


ALTER TABLE attributes.attribute_enums OWNER TO postgres;

--
-- Name: attributes; Type: TABLE; Schema: attributes; Owner: postgres
--

CREATE TABLE attributes.attributes (
    attribute_id integer NOT NULL,
    type_id attributes.attribute_type NOT NULL,
    attribute_name_pl attributes.attribute_name NOT NULL,
    attribute_name_eng attributes.attribute_name NOT NULL,
    attribute_description_pl text DEFAULT ''::text NOT NULL,
    attribute_description_eng text DEFAULT ''::text NOT NULL
);


ALTER TABLE attributes.attributes OWNER TO postgres;

--
-- Name: attributes_attribute_id_seq; Type: SEQUENCE; Schema: attributes; Owner: postgres
--

CREATE SEQUENCE attributes.attributes_attribute_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE attributes.attributes_attribute_id_seq OWNER TO postgres;

--
-- Name: attributes_attribute_id_seq; Type: SEQUENCE OWNED BY; Schema: attributes; Owner: postgres
--

ALTER SEQUENCE attributes.attributes_attribute_id_seq OWNED BY attributes.attributes.attribute_id;


--
-- Name: mandatory_attributes; Type: TABLE; Schema: attributes; Owner: postgres
--

CREATE TABLE attributes.mandatory_attributes (
    cat_id integer NOT NULL,
    attribute_id integer NOT NULL
);


ALTER TABLE attributes.mandatory_attributes OWNER TO postgres;

--
-- Name: categories; Type: TABLE; Schema: categories; Owner: postgres
--

CREATE TABLE categories.categories (
    cat_id integer NOT NULL,
    cat_name_pl character varying(80) NOT NULL,
    cat_name_eng character varying(80) NOT NULL,
    cat_description_pl text DEFAULT ''::text NOT NULL,
    cat_description_eng text DEFAULT ''::text NOT NULL
);


ALTER TABLE categories.categories OWNER TO postgres;

--
-- Name: categories_cat_id_seq; Type: SEQUENCE; Schema: categories; Owner: postgres
--

CREATE SEQUENCE categories.categories_cat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categories.categories_cat_id_seq OWNER TO postgres;

--
-- Name: categories_cat_id_seq; Type: SEQUENCE OWNED BY; Schema: categories; Owner: postgres
--

ALTER SEQUENCE categories.categories_cat_id_seq OWNED BY categories.categories.cat_id;


--
-- Name: hierarchy_of_categories; Type: TABLE; Schema: categories; Owner: postgres
--

CREATE TABLE categories.hierarchy_of_categories (
    cat_id integer NOT NULL,
    parent_id integer NOT NULL
);


ALTER TABLE categories.hierarchy_of_categories OWNER TO postgres;

--
-- Name: energy_resources; Type: TABLE; Schema: energy_resources; Owner: postgres
--

CREATE TABLE energy_resources.energy_resources (
    resource_id integer NOT NULL,
    resource_name_pl resources.resource_name NOT NULL,
    resource_name_eng resources.resource_name NOT NULL,
    gus_id character(3) NOT NULL,
    resource_description_pl text DEFAULT ''::text NOT NULL,
    resource_description_eng text DEFAULT ''::text NOT NULL
);


ALTER TABLE energy_resources.energy_resources OWNER TO postgres;

--
-- Name: energy_resources_resource_id_seq; Type: SEQUENCE; Schema: energy_resources; Owner: postgres
--

CREATE SEQUENCE energy_resources.energy_resources_resource_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE energy_resources.energy_resources_resource_id_seq OWNER TO postgres;

--
-- Name: energy_resources_resource_id_seq; Type: SEQUENCE OWNED BY; Schema: energy_resources; Owner: postgres
--

ALTER SEQUENCE energy_resources.energy_resources_resource_id_seq OWNED BY energy_resources.energy_resources.resource_id;


--
-- Name: factors; Type: TABLE; Schema: energy_resources; Owner: postgres
--

CREATE TABLE energy_resources.factors (
    resource_id integer NOT NULL,
    factor_id character varying(10) NOT NULL,
    source_id integer NOT NULL,
    resource_unit_id integer NOT NULL,
    factor_unit_id integer NOT NULL,
    factor units.ratio_domain NOT NULL,
    uncertainty units.uncertainty
);


ALTER TABLE energy_resources.factors OWNER TO postgres;

--
-- Name: resources_attributes; Type: TABLE; Schema: energy_resources; Owner: postgres
--

CREATE TABLE energy_resources.resources_attributes (
    resource_id integer NOT NULL,
    attribute_id integer NOT NULL,
    attribute_value attributes.attribute_value NOT NULL
);


ALTER TABLE energy_resources.resources_attributes OWNER TO postgres;

--
-- Name: resources_categories; Type: TABLE; Schema: energy_resources; Owner: postgres
--

CREATE TABLE energy_resources.resources_categories (
    resource_id integer NOT NULL,
    cat_id integer NOT NULL
);


ALTER TABLE energy_resources.resources_categories OWNER TO postgres;

--
-- Name: factor_names; Type: TABLE; Schema: factors; Owner: postgres
--

CREATE TABLE factors.factor_names (
    factor_id character varying(10) NOT NULL,
    factor_name_pl character varying(30) NOT NULL,
    factor_name_eng character varying(30) NOT NULL,
    factor_description_pl text DEFAULT ''::text NOT NULL,
    factor_description_eng text DEFAULT ''::text NOT NULL
);


ALTER TABLE factors.factor_names OWNER TO postgres;

--
-- Name: mandatory_factors; Type: TABLE; Schema: factors; Owner: postgres
--

CREATE TABLE factors.mandatory_factors (
    cat_id integer NOT NULL,
    factor_id character varying(10) NOT NULL
);


ALTER TABLE factors.mandatory_factors OWNER TO postgres;

--
-- Name: sources; Type: TABLE; Schema: factors; Owner: postgres
--

CREATE TABLE factors.sources (
    source_id integer NOT NULL,
    source_date date NOT NULL,
    source_description text,
    doi character varying(100),
    bibtex text,
    file_id integer
);


ALTER TABLE factors.sources OWNER TO postgres;

--
-- Name: sources_source_id_seq; Type: SEQUENCE; Schema: factors; Owner: postgres
--

CREATE SEQUENCE factors.sources_source_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE factors.sources_source_id_seq OWNER TO postgres;

--
-- Name: sources_source_id_seq; Type: SEQUENCE OWNED BY; Schema: factors; Owner: postgres
--

ALTER SEQUENCE factors.sources_source_id_seq OWNED BY factors.sources.source_id;


--
-- Name: files; Type: TABLE; Schema: files; Owner: postgres
--

CREATE TABLE files.files (
    file_id integer NOT NULL,
    file_name character varying(256) NOT NULL,
    file_type files.file_types NOT NULL,
    hdd_file_path character varying(1024) NOT NULL,
    folder_id integer NOT NULL
);


ALTER TABLE files.files OWNER TO postgres;

--
-- Name: files_file_id_seq; Type: SEQUENCE; Schema: files; Owner: postgres
--

CREATE SEQUENCE files.files_file_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE files.files_file_id_seq OWNER TO postgres;

--
-- Name: files_file_id_seq; Type: SEQUENCE OWNED BY; Schema: files; Owner: postgres
--

ALTER SEQUENCE files.files_file_id_seq OWNED BY files.files.file_id;


--
-- Name: folders; Type: TABLE; Schema: files; Owner: postgres
--

CREATE TABLE files.folders (
    folder_id integer NOT NULL,
    folder_name character varying(256) NOT NULL,
    folder_description_pl text DEFAULT ''::text NOT NULL,
    folder_description_eng text DEFAULT ''::text NOT NULL,
    parent_folder_id integer
);


ALTER TABLE files.folders OWNER TO postgres;

--
-- Name: folders_folder_id_seq; Type: SEQUENCE; Schema: files; Owner: postgres
--

CREATE SEQUENCE files.folders_folder_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE files.folders_folder_id_seq OWNER TO postgres;

--
-- Name: folders_folder_id_seq; Type: SEQUENCE OWNED BY; Schema: files; Owner: postgres
--

ALTER SEQUENCE files.folders_folder_id_seq OWNED BY files.folders.folder_id;


--
-- Name: factors; Type: TABLE; Schema: resources; Owner: postgres
--

CREATE TABLE resources.factors (
    resource_id integer NOT NULL,
    factor_id character varying(10) NOT NULL,
    source_id integer NOT NULL,
    resource_unit_1_id integer NOT NULL,
    resource_unit_2_id integer,
    factor_unit_id integer NOT NULL,
    factor units.ratio_domain NOT NULL,
    uncertainty units.uncertainty
);


ALTER TABLE resources.factors OWNER TO postgres;

--
-- Name: resources; Type: TABLE; Schema: resources; Owner: postgres
--

CREATE TABLE resources.resources (
    resource_id integer NOT NULL,
    resource_name_pl resources.resource_name NOT NULL,
    resource_name_eng resources.resource_name NOT NULL,
    resource_description_pl text DEFAULT ''::text NOT NULL,
    resource_description_eng text DEFAULT ''::text NOT NULL
);


ALTER TABLE resources.resources OWNER TO postgres;

--
-- Name: resources_attributes; Type: TABLE; Schema: resources; Owner: postgres
--

CREATE TABLE resources.resources_attributes (
    resource_id integer NOT NULL,
    attribute_id integer NOT NULL,
    attribute_value attributes.attribute_value NOT NULL
);


ALTER TABLE resources.resources_attributes OWNER TO postgres;

--
-- Name: resources_categories; Type: TABLE; Schema: resources; Owner: postgres
--

CREATE TABLE resources.resources_categories (
    resource_id integer NOT NULL,
    cat_id integer NOT NULL
);


ALTER TABLE resources.resources_categories OWNER TO postgres;

--
-- Name: resources_resource_id_seq; Type: SEQUENCE; Schema: resources; Owner: postgres
--

CREATE SEQUENCE resources.resources_resource_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE resources.resources_resource_id_seq OWNER TO postgres;

--
-- Name: resources_resource_id_seq; Type: SEQUENCE OWNED BY; Schema: resources; Owner: postgres
--

ALTER SEQUENCE resources.resources_resource_id_seq OWNED BY resources.resources.resource_id;


--
-- Name: quantities; Type: TABLE; Schema: units; Owner: postgres
--

CREATE TABLE units.quantities (
    quantity_id integer NOT NULL,
    quantity_name_pl character varying(30) NOT NULL,
    quantity_name_eng character varying(30) NOT NULL,
    base_unit_id integer
);


ALTER TABLE units.quantities OWNER TO postgres;

--
-- Name: quantities_quantity_id_seq; Type: SEQUENCE; Schema: units; Owner: postgres
--

CREATE SEQUENCE units.quantities_quantity_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE units.quantities_quantity_id_seq OWNER TO postgres;

--
-- Name: quantities_quantity_id_seq; Type: SEQUENCE OWNED BY; Schema: units; Owner: postgres
--

ALTER SEQUENCE units.quantities_quantity_id_seq OWNED BY units.quantities.quantity_id;


--
-- Name: source_unit_names; Type: TABLE; Schema: units; Owner: postgres
--

CREATE TABLE units.source_unit_names (
    unit_variant units.unit_domain NOT NULL,
    unit_canonical_id integer NOT NULL
);


ALTER TABLE units.source_unit_names OWNER TO postgres;

--
-- Name: units; Type: TABLE; Schema: units; Owner: postgres
--

CREATE TABLE units.units (
    unit_id integer NOT NULL,
    unit units.unit_domain NOT NULL,
    unit_full_name_pl character varying(80) NOT NULL,
    unit_full_name_eng character varying(80) NOT NULL,
    ratio units.ratio_nz_domain NOT NULL,
    quantity_id integer NOT NULL
);


ALTER TABLE units.units OWNER TO postgres;

--
-- Name: units_unit_id_seq; Type: SEQUENCE; Schema: units; Owner: postgres
--

CREATE SEQUENCE units.units_unit_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE units.units_unit_id_seq OWNER TO postgres;

--
-- Name: units_unit_id_seq; Type: SEQUENCE OWNED BY; Schema: units; Owner: postgres
--

ALTER SEQUENCE units.units_unit_id_seq OWNED BY units.units.unit_id;


--
-- Name: attributes attribute_id; Type: DEFAULT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attributes ALTER COLUMN attribute_id SET DEFAULT nextval('attributes.attributes_attribute_id_seq'::regclass);


--
-- Name: categories cat_id; Type: DEFAULT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.categories ALTER COLUMN cat_id SET DEFAULT nextval('categories.categories_cat_id_seq'::regclass);


--
-- Name: energy_resources resource_id; Type: DEFAULT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.energy_resources ALTER COLUMN resource_id SET DEFAULT nextval('energy_resources.energy_resources_resource_id_seq'::regclass);


--
-- Name: sources source_id; Type: DEFAULT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.sources ALTER COLUMN source_id SET DEFAULT nextval('factors.sources_source_id_seq'::regclass);


--
-- Name: files file_id; Type: DEFAULT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.files ALTER COLUMN file_id SET DEFAULT nextval('files.files_file_id_seq'::regclass);


--
-- Name: folders folder_id; Type: DEFAULT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.folders ALTER COLUMN folder_id SET DEFAULT nextval('files.folders_folder_id_seq'::regclass);


--
-- Name: resources resource_id; Type: DEFAULT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources ALTER COLUMN resource_id SET DEFAULT nextval('resources.resources_resource_id_seq'::regclass);


--
-- Name: quantities quantity_id; Type: DEFAULT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.quantities ALTER COLUMN quantity_id SET DEFAULT nextval('units.quantities_quantity_id_seq'::regclass);


--
-- Name: units unit_id; Type: DEFAULT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.units ALTER COLUMN unit_id SET DEFAULT nextval('units.units_unit_id_seq'::regclass);


--
-- Data for Name: attribute_enums; Type: TABLE DATA; Schema: attributes; Owner: postgres
--

INSERT INTO attributes.attribute_enums VALUES (7, '5000', 'abcd', 'xxxx', 'yzx');
INSERT INTO attributes.attribute_enums VALUES (5, '1234', '4321', 'wwww', 'xxxx');


--
-- Data for Name: attributes; Type: TABLE DATA; Schema: attributes; Owner: postgres
--

INSERT INTO attributes.attributes VALUES (5, 'enum', 'asdsa', 'asdas', 'asdas', 'sads');
INSERT INTO attributes.attributes VALUES (7, 'enum', 'surowiec', 'surowiec', 'surowiec', 'wegiel');
INSERT INTO attributes.attributes VALUES (8, 'free', 'nosnik energii', 'energy resource', 'nosnik energetyczny', 'energy ...');


--
-- Data for Name: mandatory_attributes; Type: TABLE DATA; Schema: attributes; Owner: postgres
--

INSERT INTO attributes.mandatory_attributes VALUES (3, 7);
INSERT INTO attributes.mandatory_attributes VALUES (3, 8);
INSERT INTO attributes.mandatory_attributes VALUES (6, 5);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: categories; Owner: postgres
--

INSERT INTO categories.categories VALUES (2, 'kat2', 'cat2', 'opis2', 'descr2');
INSERT INTO categories.categories VALUES (6, 'rewqrwq', 'rwre', 'qwrweqr', 'werwq');
INSERT INTO categories.categories VALUES (3, '213321', '4214211', '214214', '42142121');
INSERT INTO categories.categories VALUES (4, 'surowiec', 'wegiel', 'brokul', 'ziemniak');


--
-- Data for Name: hierarchy_of_categories; Type: TABLE DATA; Schema: categories; Owner: postgres
--

INSERT INTO categories.hierarchy_of_categories VALUES (3, 6);
INSERT INTO categories.hierarchy_of_categories VALUES (4, 3);
INSERT INTO categories.hierarchy_of_categories VALUES (2, 6);


--
-- Data for Name: energy_resources; Type: TABLE DATA; Schema: energy_resources; Owner: postgres
--

INSERT INTO energy_resources.energy_resources VALUES (5, 'olej napędowy', 'oil ', '064', 'paliwo', 'diesel');
INSERT INTO energy_resources.energy_resources VALUES (6, 'węgiel kamienny EKORET', 'bituminous coal EKORET', '060', 'węgiel kamienny EKORET opis', 'bituminous coal EKORET description');
INSERT INTO energy_resources.energy_resources VALUES (4, 'wegiel kamienny pieklorz', 'coal pieklorz', '050', 'opis pl', 'opis eng');


--
-- Data for Name: factors; Type: TABLE DATA; Schema: energy_resources; Owner: postgres
--

INSERT INTO energy_resources.factors VALUES (5, 'xyz', 1, 14, 14, 2, 1);
INSERT INTO energy_resources.factors VALUES (6, 'wqrewqrewq', 1, 28, 14, 8.5, 12);


--
-- Data for Name: resources_attributes; Type: TABLE DATA; Schema: energy_resources; Owner: postgres
--

INSERT INTO energy_resources.resources_attributes VALUES (6, 7, '2000');
INSERT INTO energy_resources.resources_attributes VALUES (4, 7, '500');
INSERT INTO energy_resources.resources_attributes VALUES (5, 8, '800');


--
-- Data for Name: resources_categories; Type: TABLE DATA; Schema: energy_resources; Owner: postgres
--

INSERT INTO energy_resources.resources_categories VALUES (5, 6);
INSERT INTO energy_resources.resources_categories VALUES (6, 4);
INSERT INTO energy_resources.resources_categories VALUES (4, 4);


--
-- Data for Name: factor_names; Type: TABLE DATA; Schema: factors; Owner: postgres
--

INSERT INTO factors.factor_names VALUES ('wqrewqrewq', 'surowiec', 'wegiel', 'wegiel', 'surowiec');
INSERT INTO factors.factor_names VALUES ('xyz', 'ślad węglowy', 'carbon footprint', 'ślad węglowy opis', 'description for carbon footprint');
INSERT INTO factors.factor_names VALUES ('dasdsa', 'ślad wodny', 'water footprint', 'ślad wodny opis', 'water footprint description');


--
-- Data for Name: mandatory_factors; Type: TABLE DATA; Schema: factors; Owner: postgres
--

INSERT INTO factors.mandatory_factors VALUES (2, 'dasdsa');
INSERT INTO factors.mandatory_factors VALUES (3, 'xyz');
INSERT INTO factors.mandatory_factors VALUES (2, 'wqrewqrewq');


--
-- Data for Name: sources; Type: TABLE DATA; Schema: factors; Owner: postgres
--

INSERT INTO factors.sources VALUES (1, '2018-04-28', 'wwww', 'wwww', 'wwww', 1);
INSERT INTO factors.sources VALUES (4, '2019-05-07', 'zrodlo', '100', '50', NULL);
INSERT INTO factors.sources VALUES (5, '2019-02-08', 'zrodlo2', 'xx', 'ww', NULL);


--
-- Data for Name: files; Type: TABLE DATA; Schema: files; Owner: postgres
--

INSERT INTO files.files VALUES (1, '12321321', 'jpg', '321312', 6);
INSERT INTO files.files VALUES (4, '321321312', 'pdf', '321312312', 11);
INSERT INTO files.files VALUES (3, 'ggfdgdfg', 'png', 'fdgdfgdf', 4);


--
-- Data for Name: folders; Type: TABLE DATA; Schema: files; Owner: postgres
--

INSERT INTO files.folders VALUES (6, '123213', 'werew', 'fasfas', 4);
INSERT INTO files.folders VALUES (9, '412412', '21421', '42121', 4);
INSERT INTO files.folders VALUES (1, '4214124', '412412', '421412412', 9);
INSERT INTO files.folders VALUES (11, 'dsadsad', 'sad12312', '312312', 9);
INSERT INTO files.folders VALUES (12, 'dsafsaf', '143214214', '4214124124', 6);
INSERT INTO files.folders VALUES (4, 'wwww', 'wwww', 'wwww', 9);


--
-- Data for Name: factors; Type: TABLE DATA; Schema: resources; Owner: postgres
--

INSERT INTO resources.factors VALUES (3, 'xyz', 4, 14, 28, 14, 5, 1.5);
INSERT INTO resources.factors VALUES (4, 'xyz', 1, 13, 13, 13, 0.10000000000000001, 0.10000000000000001);
INSERT INTO resources.factors VALUES (5, 'xyz', 4, 36, 36, 36, 10, NULL);


--
-- Data for Name: resources; Type: TABLE DATA; Schema: resources; Owner: postgres
--

INSERT INTO resources.resources VALUES (3, 'brokuł', 'broccoli', 'parametry dla brokułu', 'parameters for broccoli');
INSERT INTO resources.resources VALUES (4, 'marchewka', 'carrot', 'parametry dla marchewki', 'parameters for carrot');
INSERT INTO resources.resources VALUES (5, 'szpinak', 'spinach', 'parametry dla szpinaku', 'parameters for spinach');


--
-- Data for Name: resources_attributes; Type: TABLE DATA; Schema: resources; Owner: postgres
--

INSERT INTO resources.resources_attributes VALUES (3, 7, '100');
INSERT INTO resources.resources_attributes VALUES (4, 7, '1500');
INSERT INTO resources.resources_attributes VALUES (5, 7, '3000');


--
-- Data for Name: resources_categories; Type: TABLE DATA; Schema: resources; Owner: postgres
--

INSERT INTO resources.resources_categories VALUES (3, 4);
INSERT INTO resources.resources_categories VALUES (4, 2);
INSERT INTO resources.resources_categories VALUES (5, 4);


--
-- Data for Name: quantities; Type: TABLE DATA; Schema: units; Owner: postgres
--

INSERT INTO units.quantities VALUES (13, 'masa', 'mass', 13);
INSERT INTO units.quantities VALUES (14, 'energia', 'energy', 14);
INSERT INTO units.quantities VALUES (15, 'odległość', 'distance', 15);
INSERT INTO units.quantities VALUES (16, 'czas', 'time', 16);
INSERT INTO units.quantities VALUES (17, 'objętość', 'volume', 32);


--
-- Data for Name: source_unit_names; Type: TABLE DATA; Schema: units; Owner: postgres
--

INSERT INTO units.source_unit_names VALUES ('m3', 32);
INSERT INTO units.source_unit_names VALUES ('ton', 37);
INSERT INTO units.source_unit_names VALUES ('dem3', 39);


--
-- Data for Name: units; Type: TABLE DATA; Schema: units; Owner: postgres
--

INSERT INTO units.units VALUES (14, 'J', 'Dżul', 'Jul', 1, 14);
INSERT INTO units.units VALUES (15, 'km', 'kilometr', 'kilometer', 1, 15);
INSERT INTO units.units VALUES (16, 's', 'sekunda', 'second', 1, 16);
INSERT INTO units.units VALUES (28, 'cal', 'kaloria', 'calorie', 4.1855000000000002, 14);
INSERT INTO units.units VALUES (29, 'kcal', 'kilokaloria', 'kilo-calorie', 4185.5, 14);
INSERT INTO units.units VALUES (32, 'm3', 'metr sześcienny', 'cubic meter', 1, 17);
INSERT INTO units.units VALUES (33, 'kWh', 'kilowatogodzina', 'kilowatt-hour', 3600000, 14);
INSERT INTO units.units VALUES (35, 'm', 'metr', 'meter', 0.001, 15);
INSERT INTO units.units VALUES (36, 'h', 'godzina', 'hour', 3600, 16);
INSERT INTO units.units VALUES (37, 't', 'tona', 'tonne', 1000, 13);
INSERT INTO units.units VALUES (39, 'dem3', 'dekametr sześcienny', 'cubic dekameter', 1000, 17);
INSERT INTO units.units VALUES (13, 'kg', 'kilogram', 'kilogram', 1, 13);


--
-- Name: attributes_attribute_id_seq; Type: SEQUENCE SET; Schema: attributes; Owner: postgres
--

SELECT pg_catalog.setval('attributes.attributes_attribute_id_seq', 9, true);


--
-- Name: categories_cat_id_seq; Type: SEQUENCE SET; Schema: categories; Owner: postgres
--

SELECT pg_catalog.setval('categories.categories_cat_id_seq', 6, true);


--
-- Name: energy_resources_resource_id_seq; Type: SEQUENCE SET; Schema: energy_resources; Owner: postgres
--

SELECT pg_catalog.setval('energy_resources.energy_resources_resource_id_seq', 6, true);


--
-- Name: sources_source_id_seq; Type: SEQUENCE SET; Schema: factors; Owner: postgres
--

SELECT pg_catalog.setval('factors.sources_source_id_seq', 5, true);


--
-- Name: files_file_id_seq; Type: SEQUENCE SET; Schema: files; Owner: postgres
--

SELECT pg_catalog.setval('files.files_file_id_seq', 4, true);


--
-- Name: folders_folder_id_seq; Type: SEQUENCE SET; Schema: files; Owner: postgres
--

SELECT pg_catalog.setval('files.folders_folder_id_seq', 12, true);


--
-- Name: resources_resource_id_seq; Type: SEQUENCE SET; Schema: resources; Owner: postgres
--

SELECT pg_catalog.setval('resources.resources_resource_id_seq', 5, true);


--
-- Name: quantities_quantity_id_seq; Type: SEQUENCE SET; Schema: units; Owner: postgres
--

SELECT pg_catalog.setval('units.quantities_quantity_id_seq', 18, true);


--
-- Name: units_unit_id_seq; Type: SEQUENCE SET; Schema: units; Owner: postgres
--

SELECT pg_catalog.setval('units.units_unit_id_seq', 41, true);


--
-- Name: attributes attributes_attribute_name_eng_key; Type: CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attributes
    ADD CONSTRAINT attributes_attribute_name_eng_key UNIQUE (attribute_name_eng);


--
-- Name: attributes attributes_attribute_name_pl_key; Type: CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attributes
    ADD CONSTRAINT attributes_attribute_name_pl_key UNIQUE (attribute_name_pl);


--
-- Name: attributes attributes_pkey; Type: CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attributes
    ADD CONSTRAINT attributes_pkey PRIMARY KEY (attribute_id);


--
-- Name: mandatory_attributes fk_mandatory; Type: CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.mandatory_attributes
    ADD CONSTRAINT fk_mandatory PRIMARY KEY (cat_id, attribute_id);


--
-- Name: attribute_enums pk_attr_enums; Type: CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attribute_enums
    ADD CONSTRAINT pk_attr_enums PRIMARY KEY (attribute_id, attribute_value_pl);


--
-- Name: attribute_enums unique_attr_enums; Type: CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attribute_enums
    ADD CONSTRAINT unique_attr_enums UNIQUE (attribute_id, attribute_value_eng);


--
-- Name: categories categories_cat_name_eng_key; Type: CONSTRAINT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.categories
    ADD CONSTRAINT categories_cat_name_eng_key UNIQUE (cat_name_eng);


--
-- Name: categories categories_cat_name_pl_key; Type: CONSTRAINT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.categories
    ADD CONSTRAINT categories_cat_name_pl_key UNIQUE (cat_name_pl);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (cat_id);


--
-- Name: hierarchy_of_categories pk_category_hierarchy; Type: CONSTRAINT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.hierarchy_of_categories
    ADD CONSTRAINT pk_category_hierarchy PRIMARY KEY (cat_id, parent_id);


--
-- Name: energy_resources energy_resources_pkey; Type: CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.energy_resources
    ADD CONSTRAINT energy_resources_pkey PRIMARY KEY (resource_id);


--
-- Name: energy_resources energy_resources_resource_name_eng_key; Type: CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.energy_resources
    ADD CONSTRAINT energy_resources_resource_name_eng_key UNIQUE (resource_name_eng);


--
-- Name: energy_resources energy_resources_resource_name_pl_key; Type: CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.energy_resources
    ADD CONSTRAINT energy_resources_resource_name_pl_key UNIQUE (resource_name_pl);


--
-- Name: factors pk_factors; Type: CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.factors
    ADD CONSTRAINT pk_factors PRIMARY KEY (resource_id, factor_id, resource_unit_id);


--
-- Name: resources_attributes pk_resattrs; Type: CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.resources_attributes
    ADD CONSTRAINT pk_resattrs PRIMARY KEY (resource_id, attribute_id);


--
-- Name: resources_categories pk_rescat; Type: CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.resources_categories
    ADD CONSTRAINT pk_rescat PRIMARY KEY (resource_id, cat_id);


--
-- Name: factor_names factor_names_factor_name_eng_key; Type: CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.factor_names
    ADD CONSTRAINT factor_names_factor_name_eng_key UNIQUE (factor_name_eng);


--
-- Name: factor_names factor_names_factor_name_pl_key; Type: CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.factor_names
    ADD CONSTRAINT factor_names_factor_name_pl_key UNIQUE (factor_name_pl);


--
-- Name: factor_names factor_names_pkey; Type: CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.factor_names
    ADD CONSTRAINT factor_names_pkey PRIMARY KEY (factor_id);


--
-- Name: mandatory_factors fk_mandatory; Type: CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.mandatory_factors
    ADD CONSTRAINT fk_mandatory PRIMARY KEY (cat_id, factor_id);


--
-- Name: sources sources_doi_key; Type: CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.sources
    ADD CONSTRAINT sources_doi_key UNIQUE (doi);


--
-- Name: sources sources_pkey; Type: CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.sources
    ADD CONSTRAINT sources_pkey PRIMARY KEY (source_id);


--
-- Name: files files_pkey; Type: CONSTRAINT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.files
    ADD CONSTRAINT files_pkey PRIMARY KEY (file_id);


--
-- Name: folders folders_folder_name_key; Type: CONSTRAINT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.folders
    ADD CONSTRAINT folders_folder_name_key UNIQUE (folder_name);


--
-- Name: folders folders_pkey; Type: CONSTRAINT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.folders
    ADD CONSTRAINT folders_pkey PRIMARY KEY (folder_id);


--
-- Name: files unique_file_name; Type: CONSTRAINT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.files
    ADD CONSTRAINT unique_file_name UNIQUE (file_name, folder_id);


--
-- Name: factors pk_factors; Type: CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT pk_factors PRIMARY KEY (resource_id, factor_id, resource_unit_1_id);


--
-- Name: resources_attributes pk_resattrs; Type: CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources_attributes
    ADD CONSTRAINT pk_resattrs PRIMARY KEY (resource_id, attribute_id);


--
-- Name: resources_categories pk_rescat; Type: CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources_categories
    ADD CONSTRAINT pk_rescat PRIMARY KEY (resource_id, cat_id);


--
-- Name: resources resources_pkey; Type: CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources
    ADD CONSTRAINT resources_pkey PRIMARY KEY (resource_id);


--
-- Name: resources resources_resource_name_eng_key; Type: CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources
    ADD CONSTRAINT resources_resource_name_eng_key UNIQUE (resource_name_eng);


--
-- Name: resources resources_resource_name_pl_key; Type: CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources
    ADD CONSTRAINT resources_resource_name_pl_key UNIQUE (resource_name_pl);


--
-- Name: quantities quantities_pkey; Type: CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.quantities
    ADD CONSTRAINT quantities_pkey PRIMARY KEY (quantity_id);


--
-- Name: quantities quantities_quantity_name_eng_key; Type: CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.quantities
    ADD CONSTRAINT quantities_quantity_name_eng_key UNIQUE (quantity_name_eng);


--
-- Name: quantities quantities_quantity_name_pl_key; Type: CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.quantities
    ADD CONSTRAINT quantities_quantity_name_pl_key UNIQUE (quantity_name_pl);


--
-- Name: source_unit_names source_unit_names_pkey; Type: CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.source_unit_names
    ADD CONSTRAINT source_unit_names_pkey PRIMARY KEY (unit_variant);


--
-- Name: units units_pkey; Type: CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.units
    ADD CONSTRAINT units_pkey PRIMARY KEY (unit_id);


--
-- Name: units units_unit_key; Type: CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.units
    ADD CONSTRAINT units_unit_key UNIQUE (unit);


--
-- Name: attribute_enums fk_enums_attr; Type: FK CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.attribute_enums
    ADD CONSTRAINT fk_enums_attr FOREIGN KEY (attribute_id) REFERENCES attributes.attributes(attribute_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: mandatory_attributes fk_mandatory_attrs; Type: FK CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.mandatory_attributes
    ADD CONSTRAINT fk_mandatory_attrs FOREIGN KEY (attribute_id) REFERENCES attributes.attributes(attribute_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: mandatory_attributes fk_mandatory_cats; Type: FK CONSTRAINT; Schema: attributes; Owner: postgres
--

ALTER TABLE ONLY attributes.mandatory_attributes
    ADD CONSTRAINT fk_mandatory_cats FOREIGN KEY (cat_id) REFERENCES categories.categories(cat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: hierarchy_of_categories fk_hier_to_cat; Type: FK CONSTRAINT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.hierarchy_of_categories
    ADD CONSTRAINT fk_hier_to_cat FOREIGN KEY (cat_id) REFERENCES categories.categories(cat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: hierarchy_of_categories fk_hier_to_hier; Type: FK CONSTRAINT; Schema: categories; Owner: postgres
--

ALTER TABLE ONLY categories.hierarchy_of_categories
    ADD CONSTRAINT fk_hier_to_hier FOREIGN KEY (parent_id) REFERENCES categories.categories(cat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_factor_unit; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.factors
    ADD CONSTRAINT fk_factor_factor_unit FOREIGN KEY (factor_unit_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_resource_unit; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.factors
    ADD CONSTRAINT fk_factor_resource_unit FOREIGN KEY (resource_unit_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_tofactor_names; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.factors
    ADD CONSTRAINT fk_factor_tofactor_names FOREIGN KEY (factor_id) REFERENCES factors.factor_names(factor_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_tores; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.factors
    ADD CONSTRAINT fk_factor_tores FOREIGN KEY (resource_id) REFERENCES energy_resources.energy_resources(resource_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_tosource; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.factors
    ADD CONSTRAINT fk_factor_tosource FOREIGN KEY (source_id) REFERENCES factors.sources(source_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_attributes fk_resattr_toattr; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.resources_attributes
    ADD CONSTRAINT fk_resattr_toattr FOREIGN KEY (attribute_id) REFERENCES attributes.attributes(attribute_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_attributes fk_resattr_tores; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.resources_attributes
    ADD CONSTRAINT fk_resattr_tores FOREIGN KEY (resource_id) REFERENCES energy_resources.energy_resources(resource_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_categories fk_rescat_tocat; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.resources_categories
    ADD CONSTRAINT fk_rescat_tocat FOREIGN KEY (cat_id) REFERENCES categories.categories(cat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_categories fk_rescat_tores; Type: FK CONSTRAINT; Schema: energy_resources; Owner: postgres
--

ALTER TABLE ONLY energy_resources.resources_categories
    ADD CONSTRAINT fk_rescat_tores FOREIGN KEY (resource_id) REFERENCES energy_resources.energy_resources(resource_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: mandatory_factors fk_mandatory_facts; Type: FK CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.mandatory_factors
    ADD CONSTRAINT fk_mandatory_facts FOREIGN KEY (factor_id) REFERENCES factors.factor_names(factor_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: mandatory_factors fk_mandatory_facts_cats; Type: FK CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.mandatory_factors
    ADD CONSTRAINT fk_mandatory_facts_cats FOREIGN KEY (cat_id) REFERENCES categories.categories(cat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sources fk_sources_files; Type: FK CONSTRAINT; Schema: factors; Owner: postgres
--

ALTER TABLE ONLY factors.sources
    ADD CONSTRAINT fk_sources_files FOREIGN KEY (file_id) REFERENCES files.files(file_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: files fk_file_fold; Type: FK CONSTRAINT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.files
    ADD CONSTRAINT fk_file_fold FOREIGN KEY (folder_id) REFERENCES files.folders(folder_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: folders fk_fold_fold; Type: FK CONSTRAINT; Schema: files; Owner: postgres
--

ALTER TABLE ONLY files.folders
    ADD CONSTRAINT fk_fold_fold FOREIGN KEY (parent_folder_id) REFERENCES files.folders(folder_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_factor_unit; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT fk_factor_factor_unit FOREIGN KEY (factor_unit_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_resource_unit_1; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT fk_factor_resource_unit_1 FOREIGN KEY (resource_unit_1_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_resource_unit_2; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT fk_factor_resource_unit_2 FOREIGN KEY (resource_unit_2_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_tofactor_names; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT fk_factor_tofactor_names FOREIGN KEY (factor_id) REFERENCES factors.factor_names(factor_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_tores; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT fk_factor_tores FOREIGN KEY (resource_id) REFERENCES resources.resources(resource_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: factors fk_factor_tosource; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.factors
    ADD CONSTRAINT fk_factor_tosource FOREIGN KEY (source_id) REFERENCES factors.sources(source_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_attributes fk_resattr_toattr; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources_attributes
    ADD CONSTRAINT fk_resattr_toattr FOREIGN KEY (attribute_id) REFERENCES attributes.attributes(attribute_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_attributes fk_resattr_tores; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources_attributes
    ADD CONSTRAINT fk_resattr_tores FOREIGN KEY (resource_id) REFERENCES resources.resources(resource_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_categories fk_rescat_tocat; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources_categories
    ADD CONSTRAINT fk_rescat_tocat FOREIGN KEY (cat_id) REFERENCES categories.categories(cat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: resources_categories fk_rescat_tores; Type: FK CONSTRAINT; Schema: resources; Owner: postgres
--

ALTER TABLE ONLY resources.resources_categories
    ADD CONSTRAINT fk_rescat_tores FOREIGN KEY (resource_id) REFERENCES resources.resources(resource_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: quantities fk_base_unit; Type: FK CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.quantities
    ADD CONSTRAINT fk_base_unit FOREIGN KEY (base_unit_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE DEFERRABLE INITIALLY DEFERRED;


--
-- Name: source_unit_names fk_canonical_unit; Type: FK CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.source_unit_names
    ADD CONSTRAINT fk_canonical_unit FOREIGN KEY (unit_canonical_id) REFERENCES units.units(unit_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: units fk_quantity; Type: FK CONSTRAINT; Schema: units; Owner: postgres
--

ALTER TABLE ONLY units.units
    ADD CONSTRAINT fk_quantity FOREIGN KEY (quantity_id) REFERENCES units.quantities(quantity_id) ON UPDATE CASCADE ON DELETE CASCADE DEFERRABLE INITIALLY DEFERRED;


--
-- PostgreSQL database dump complete
--

