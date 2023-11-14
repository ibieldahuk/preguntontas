-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2023 a las 20:43:04
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

create database if not exists preguntonta;

use preguntonta;

CREATE TABLE `usuario` (
                           `id` int(11) PRIMARY KEY AUTO_INCREMENT,
                           `nombre` varchar(50) NOT NULL,
                           `apellido` varchar(50) NOT NULL,
                           `fechaNac` date NOT NULL,
                           `genero` varchar(20) NOT NULL,
                           `email` varchar(50) NOT NULL,
                           `usuario` varchar(50) DEFAULT NULL,
                           `contraseña` varchar(50) DEFAULT NULL,
                           `fotoPerfil` varchar(250) NOT NULL,
                           `record` int(11) DEFAULT 0,
                           `puntosTotales` int(11) DEFAULT 0,
						   `qtyPreguntas` int(11) DEFAULT 0,
						   `qtyCorrectas` int(11) DEFAULT 0,
						   `shareCorrecta` Float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `fechaNac`, `genero`, `email`, `usuario`, `contraseña`, `fotoPerfil`, `record`, `puntosTotales`) VALUES
    (1, 'admin', 'admin', '2003-03-20', 'Mascuino', 'admin@test.com', 'admin', '1234', '', 0, 0),
    (2, 'editor', 'editor', '2000-10-10', 'Femenino', 'editor@test.com', 'editor', '1234', '', 0, 0);

CREATE TABLE repetida (
    id_usuario INT(4),
    id_preguntaRepetida INT(4)
);

CREATE TABLE preguntas_sugerida (
    id INT(4) PRIMARY KEY AUTO_INCREMENT,
    pregunta varchar(150),
	respuesta varchar(100),
	opcion1 varchar(100),
	opcion2 varchar(100),
	opcion3 varchar(100),
	categoria varchar(50)
);

CREATE TABLE preguntas (
    ID INT(4) PRIMARY KEY AUTO_INCREMENT,
    pregunta VARCHAR(200),
    categoria VARCHAR(20),
    qty INT(4),
    correctas INT(4),
    sharecorrecta FLOAT,
	reportada BOOLEAN DEFAULT FALSE
);

INSERT INTO preguntas (pregunta, categoria, qty, correctas, sharecorrecta) VALUES
    ("¿Quién es el heroe que protege a Ciudad Gotica?", "Entretenimiento", 1, 1, 1),
    ("¿Cómo se llamaba el barco del pirata Jack Sparrow en ""Piratas del Caribe""?", "Entretenimiento", 1, 1, 1),
    ("¿Cuál es la comida preferida de Garfield?", "Entretenimiento", 1, 1, 1),
    ("¿En que parte de Estados unidos vive la familia soprano?", "Entretenimiento", 1, 1, 1),
    ("¿Qué superpoder tiene Lex Luthor, el archienemigo de Superman?", "Entretenimiento", 1, 1, 1),
    ("¿En que cancha esta filmada la escena de futbol de ""El Secreto ded sus Ojos""?", "Entretenimiento", 1, 1, 1),
    ("Apu de Los Simpsons ¿Es vegetariano?", "Entretenimiento", 1, 1, 1),
    ("¿En que pais se desarrolla ""La novicia rebelde""?", "Entretenimiento", 1, 1, 1),
    ("¿Con que pelicula Jennifer Lawrence gano el Oscar?", "Entretenimiento", 1, 1, 1),
    ("¿Cómo se llama el hermano de Michael Scofield en la serie ""Prision Break""?", "Entretenimiento", 1, 1, 1),
    ("¿Qué ciudad fue elegida como sede de los juegos olimpicos 2020?", "Deporte", 1, 1, 1),
    ("El tenista Rafael Nadal ¿Es diestro?", "Deporte", 1, 1, 1),
    ("¿Qué nombre recibe la colchoneta donde se practica Judo?", "Deporte", 1, 1, 1),
    ("En la pesca deportiva ¿A que pez se lo conoce como ""Flecha de plata""?", "Deporte", 1, 1, 1),
    ("¿En que provincia Argentina nacio el golfista Angel Cabrera?", "Deporte", 1, 1, 1),
    ("¿Qué animal fue seleccionado como mascota del mundial de futbol Rusia 2018?", "Deporte", 1, 1, 1),
    ("¿Se permiten golpes de codo en kick-boxing?", "Deporte", 1, 1, 1),
    ("¿En que pais se invento el paddle?", "Deporte", 1, 1, 1),
    ("¿Qué altura tienen los trampolines olimpicos?", "Deporte", 1, 1, 1),
    ("¿Cuántas medallas de oro tuvo Argentina en Rio 2016?", "Deporte", 1, 1, 1),
    ("¿Qué animal puede sobrevivir mas tiempo sin agua?", "Naturaleza", 1, 1, 1),
    ("¿Las hormigas tienen reinas, como las abejas?", "Naturaleza", 1, 1, 1),
    ("Los tibres blancos tienen ojos azules ¿De que color los tienen el resto?", "Naturaleza", 1, 1, 1),
    ("Los koalas se alimentan de las hojas y corteza de un solo arbol ¿De cual?", "Naturaleza", 1, 1, 1),
    ("¿Quién fue el primer hombre que realizo un vuelo espacial?", "Naturaleza", 1, 1, 1),
    ("¿En que lugar del cuerpo tienen las moscas sus 15.000 papilas gustativas?", "Naturaleza", 1, 1, 1),
    ("¿En que momento del dia suelen registrarse las temperaturas mas bajas?", "Naturaleza", 1, 1, 1),
    ("¿De que color es la piel de los osos polares debajo del pelo?", "Naturaleza", 1, 1, 1),
    ("¿Las ballenas ponen huevos?", "Naturaleza", 1, 1, 1),
    ("¿Cuántas patas tiene un cien pies?", "Naturaleza", 1, 1, 1),
    ("¿Dónde nacio Barack Obama?", "Geografia", 1, 1, 1),
    ("Si hago rafting en el rio Atuel ¿En que provincia estoy?", "Geografia", 1, 1, 1),
    ("¿Qué pais asiatico es conocido como ""La tierra del elefante blanco""?", "Geografia", 1, 1, 1),
    ("¿La ruptura de que galciar es admirado por miles de turistar?", "Geografia", 1, 1, 1),
    ("¿En que pais esta la caverna mas profunda del mundo?", "Geografia", 1, 1, 1),
    ("¿A que pais pertenece la turistica isla margarita?", "Geografia", 1, 1, 1),
    ("¿Cómo se llamo el huracan que devasto Nueva Orleans en el siglo XXI?", "Geografia", 1, 1, 1),
    ("Indonesia ¿Esta formado por mas de 10.000 islas?", "Geografia", 1, 1, 1),
    ("¿Qué provincia es la capital nacional del poncho?", "Geografia", 1, 1, 1),
    ("Una vez disuelta la Union Sovietica ¿Cuál paso a ser el pais mas extenso del mundo?", "Geografia", 1, 1, 1);

CREATE TABLE respuestas (
    ID INT(4) PRIMARY KEY AUTO_INCREMENT,
    ID_preguntas INT(2),
    opcion VARCHAR(40),
    opcioncorrecta VARCHAR(2)
);

INSERT INTO respuestas (id_preguntas, opcion, opcioncorrecta) VALUES
(1, "Superman", "NO"),
(1, "Batman", "SI"),
(1, "Joker", "NO"),
(1, "Spiderman", "NO"),
(2, "Providence", "NO"),
(2, "Holandes Errante", "NO"),
(2, "Interceptor", "NO"),
(2, "Perla Negra", "SI"),
(3, "Lasagna", "SI"),
(3, "Chocolate", "NO"),
(3, "Manzana", "NO"),
(3, "Tarta", "NO"),
(4, "New Jersey", "SI"),
(4, "California", "NO"),
(4, "Florida", "NO"),
(4, "Boston", "NO"),
(5, "Rayos Laser", "NO"),
(5, "Volar", "NO"),
(5, "Ninguno", "SI"),
(5, "Invisible", "NO"),
(6, "Racing", "NO"),
(6, "Huracan", "SI"),
(6, "Boca", "NO"),
(6, "Independiente", "NO"),
(7, "VERDADERO", "SI"),
(7, "FALSO", "NO"),
(8, "Alemania", "NO"),
(8, "Inglaterra", "NO"),
(8, "Suecia", "NO"),
(8, "Austria", "SI"),
(9, "El lado luminoso de la vida", "SI"),
(9, "Los juegos del hambre", "NO"),
(9, "Joy", "NO"),
(9, "Pasajeros", "NO"),
(10, "Joe Scofield", "NO"),
(10, "Lincoln Burrows", "SI"),
(10, "Alexandre Mahone", "NO"),
(10, "Matt Scofield", "NO"),
(11, "Tokio", "SI"),
(11, "Manchester", "NO"),
(11, "Berlin", "NO"),
(11, "Beijing", "NO"),
(12, "VERDADERO", "NO"),
(12, "FALSO", "SI"),
(13, "Kake", "NO"),
(13, "Tatami", "SI"),
(13, "Randori", "NO"),
(13, "Ring", "NO"),
(14, "Corvina", "NO"),
(14, "Mojarra", "NO"),
(14, "Pejerrey", "SI"),
(14, "Dorado", "NO"),
(15, "Corrientes", "NO"),
(15, "San Luis", "NO"),
(15, "Salta", "NO"),
(15, "Cordoba", "SI"),
(16, "Lobo", "SI"),
(16, "Leon", "NO"),
(16, "Perro", "NO"),
(16, "Guepardo", "NO"),
(17, "VERDADERO", "NO"),
(17, "FALSO", "SI"),
(18, "Argentina", "NO"),
(18, "Estados Unidos", "SI"),
(18, "Mexico", "NO"),
(18, "Canada", "NO"),
(19, "10 metros", "NO"),
(19, "2 metros", "NO"),
(19, "3 metros", "SI"),
(19, "5 metros", "NO"),
(20, "Ninguna", "NO"),
(20, "Una", "NO"),
(20, "Dos", "NO"),
(20, "Tres", "SI"),
(21, "Rata", "SI"),
(21, "Camello", "NO"),
(21, "Cucaracha", "NO"),
(21, "Perro", "NO"),
(22, "VERDADERO", "SI"),
(22, "FALSO", "NO"),
(23, "Verdes", "NO"),
(23, "Amarillos", "SI"),
(23, "Marrones", "NO"),
(23, "Negros", "NO"),
(24, "Araucaria", "NO"),
(24, "Ombu", "NO"),
(24, "Eucalipto", "SI"),
(24, "Pino", "NO"),
(25, "Michael Jordan", "NO"),
(25, "Robert Aldrin", "NO"),
(25, "Neil Amstrong", "NO"),
(25, "Yuri Garin", "SI"),
(26, "En sus patas", "SI"),
(26, "En su cabeza", "NO"),
(26, "En su abdomen", "NO"),
(26, "En su lengua", "NO"),
(27, "Mediodia", "NO"),
(27, "Al amanecer", "SI"),
(27, "Al anochecer", "NO"),
(27, "Medianoche", "NO"),
(28, "Amarilla", "NO"),
(28, "Rosa", "NO"),
(28, "Negra", "SI"),
(28, "Blanca", "NO"),
(29, "VERDADERO", "NO"),
(29, "FALSO", "SI"),
(30, "Noventa y ocho", "NO"),
(30, "Cien", "NO"),
(30, "Cincuenta", "NO"),
(30, "Cuarenta y dos", "SI"),
(31, "Hawai", "NO"),
(31, "California", "NO"),
(31, "New york", "SI"),
(31, "Texas", "NO"),
(32, "Entre Rios", "NO"),
(32, "Mendoza", "SI"),
(32, "Neuquen", "NO"),
(32, "Rio Negro", "NO"),
(33, "India", "NO"),
(33, "Turquia", "NO"),
(33, "Tailandia", "SI"),
(33, "Pakistan", "NO"),
(34, "Torrecillas", "NO"),
(34, "Spegazzini", "NO"),
(34, "Upsala", "NO"),
(34, "Perito Moreno", "SI"),
(35, "Georgia", "SI"),
(35, "España", "NO"),
(35, "China", "NO"),
(35, "Noruega", "NO"),
(36, "Colombia", "NO"),
(36, "Venezuela", "SI"),
(36, "Ecuador", "NO"),
(36, "Peru", "NO"),
(37, "Santa Rosa", "NO"),
(37, "Georgina", "NO"),
(37, "Katrina", "SI"),
(37, "Alex", "NO"),
(38, "VERDADERO", "SI"),
(38, "FALSO", "NO"),
(39, "San Luis", "NO"),
(39, "Salta", "NO"),
(39, "Jujuy", "NO"),
(39, "Catamarca", "SI"),
(40, "Rusia", "SI"),
(40, "Canada", "NO"),
(40, "China", "NO"),
(40, "Japon", "NO");