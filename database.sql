-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2023 a las 23:37:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `preguntonta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE SCHEMA IF NOT EXISTS preguntonta;
USE preguntonta;

CREATE TABLE `preguntas` (
  `ID` int(2) NOT NULL,
  `pregunta` varchar(100) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `correctas` int(11) DEFAULT NULL,
  `sharecorrecta` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `esSugerida` tinyint(1) DEFAULT 0,
  `estaReportada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`ID`, `pregunta`, `categoria`, `qty`, `correctas`, `sharecorrecta`, `fecha_creacion`, `esSugerida`, `estaReportada`) VALUES
(1, '¿Quién es el heroe que protege a Ciudad Gotica?', 'Entretenimiento', 2, 2, 1, '2023-11-18 17:35:24', 0, 0),
(2, '¿Cómo se llamaba el barco del pirata Jack Sparrow en \"Piratas del Caribe\"?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(3, '¿Cuál es la comida preferida de Garfield?', 'Entretenimiento', 2, 2, 1, '2023-11-18 17:35:24', 0, 0),
(4, '¿En que parte de Estados unidos vive la familia soprano?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(5, '¿Qué superpoder tiene Lex Luthor, el archienemigo de Superman?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(6, '¿En que cancha esta filmada la escena de futbol de \"El Secreto ded sus Ojos\"?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(7, 'Apu de Los Simpsons ¿Es vegetariano?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(8, '¿En que pais se desarrolla \"La novicia rebelde\"?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(9, '¿Con que pelicula Jennifer Lawrence gano el Oscar?', 'Entretenimiento', 2, 2, 1, '2023-11-18 17:35:24', 0, 0),
(10, '¿Cómo se llama el hermano de Michael Scofield en la serie \"Prision Break\"?', 'Entretenimiento', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(11, '¿Qué ciudad fue elegida como sede de los juegos olimpicos 2020?', 'Deporte', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(12, 'El tenista Rafael Nadal ¿Es diestro?', 'Deporte', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(13, '¿Qué nombre recibe la colchoneta donde se practica Judo?', 'Deporte', 2, 2, 1, '2023-11-18 17:35:24', 0, 0),
(14, 'En la pesca deportiva ¿A que pez se lo conoce como \"Flecha de plata\"?', 'Deporte', 2, 2, 1, '2023-11-18 17:35:24', 0, 0),
(15, '¿En que provincia Argentina nacio el golfista Angel Cabrera?', 'Deporte', 2, 1, 1, '2023-11-18 17:35:24', 0, 0),
(16, '¿Qué animal fue seleccionado como mascota del mundial de futbol Rusia 2018?', 'Deporte', 2, 1, 1, '2023-11-18 17:35:24', 0, 0),
(17, '¿Se permiten golpes de codo en kick-boxing?', 'Deporte', 2, 1, 1, '2023-11-18 17:35:24', 0, 0),
(18, '¿En que pais se invento el paddle?', 'Deporte', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(19, '¿Qué altura tienen los trampolines olimpicos?', 'Deporte', 2, 1, 1, '2023-11-18 17:35:24', 0, 0),
(20, '¿Cuántas medallas de oro tuvo Argentina en Rio 2016?', 'Deporte', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(21, '¿Qué animal puede sobrevivir mas tiempo sin agua?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(22, '¿Las hormigas tienen reinas, como las abejas?', 'Naturaleza', 3, 3, 1, '2023-11-18 17:35:24', 0, 0),
(23, 'Los tibres blancos tienen ojos azules ¿De que color los tienen el resto?', 'Naturaleza', 2, 1, 1, '2023-11-18 17:35:24', 0, 0),
(24, 'Los koalas se alimentan de las hojas y corteza de un solo arbol ¿De cual?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(25, '¿Quién fue el primer hombre que realizo un vuelo espacial?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(26, '¿En que lugar del cuerpo tienen las moscas sus 15.000 papilas gustativas?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(27, '¿En que momento del dia suelen registrarse las temperaturas mas bajas?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(28, '¿De que color es la piel de los osos polares debajo del pelo?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(29, '¿Las ballenas ponen huevos?', 'Naturaleza', 2, 2, 1, '2023-11-18 17:35:24', 0, 0),
(30, '¿Cuántas patas tiene un cien pies?', 'Naturaleza', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(31, '¿Dónde nacio Barack Obama?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(32, 'Si hago rafting en el rio Atuel ¿En que provincia estoy?', 'Geografia', 2, 1, 1, '2023-11-18 17:35:24', 0, 0),
(33, '¿Qué pais asiatico es conocido como \"La tierra del elefante blanco\"?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(34, '¿La ruptura de que galciar es admirado por miles de turistar?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(35, '¿En que pais esta la caverna mas profunda del mundo?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(36, '¿A que pais pertenece la turistica isla margarita?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(37, '¿Cómo se llamo el huracan que devasto Nueva Orleans en el siglo XXI?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(38, 'Indonesia ¿Esta formado por mas de 10.000 islas?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(39, '¿Qué provincia es la capital nacional del poncho?', 'Geografia', 1, 1, 1, '2023-11-18 17:35:24', 0, 0),
(40, 'Una vez disuelta la Union Sovietica ¿Cuál paso a ser el pais mas extenso del mundo?', 'Geografia', 2, 2, 1, '2023-11-18 17:35:24', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repetida`
--

CREATE TABLE `repetida` (
  `id_usuario` int(4) DEFAULT NULL,
  `id_preguntaRepetida` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `repetida`
--

INSERT INTO `repetida` (`id_usuario`, `id_preguntaRepetida`) VALUES
(7, 13),
(7, 23),
(7, 17),
(7, 22),
(7, 15),
(7, 16),
(3, 9),
(3, 22),
(3, 32),
(3, 1),
(3, 3),
(3, 29),
(3, 40),
(3, 14),
(3, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `ID` int(2) NOT NULL,
  `ID_preguntas` int(2) DEFAULT NULL,
  `opcion` varchar(40) DEFAULT NULL,
  `opcioncorrecta` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`ID`, `ID_preguntas`, `opcion`, `opcioncorrecta`) VALUES
(1, 1, 'Superman', 'NO'),
(2, 1, 'Batman', 'SI'),
(3, 1, 'Joker', 'NO'),
(4, 1, 'Spiderman', 'NO'),
(5, 2, 'Providence', 'NO'),
(6, 2, 'Holandes Errante', 'NO'),
(7, 2, 'Interceptor', 'NO'),
(8, 2, 'Perla Negra', 'SI'),
(9, 3, 'Lasagna', 'SI'),
(10, 3, 'Chocolate', 'NO'),
(11, 3, 'Manzana', 'NO'),
(12, 3, 'Tarta', 'NO'),
(13, 4, 'New Jersey', 'SI'),
(14, 4, 'California', 'NO'),
(15, 4, 'Florida', 'NO'),
(16, 4, 'Boston', 'NO'),
(17, 5, 'Rayos Laser', 'NO'),
(18, 5, 'Volar', 'NO'),
(19, 5, 'Ninguno', 'SI'),
(20, 5, 'Invisible', 'NO'),
(21, 6, 'Racing', 'NO'),
(22, 6, 'Huracan', 'SI'),
(23, 6, 'Boca', 'NO'),
(24, 6, 'Independiente', 'NO'),
(25, 7, 'VERDADERO', 'SI'),
(26, 7, 'FALSO', 'NO'),
(27, 8, 'Alemania', 'NO'),
(28, 8, 'Inglaterra', 'NO'),
(29, 8, 'Suecia', 'NO'),
(30, 8, 'Austria', 'SI'),
(31, 9, 'El lado luminoso de la vida', 'SI'),
(32, 9, 'Los juegos del hambre', 'NO'),
(33, 9, 'Joy', 'NO'),
(34, 9, 'Pasajeros', 'NO'),
(35, 10, 'Joe Scofield', 'NO'),
(36, 10, 'Lincoln Burrows', 'SI'),
(37, 10, 'Alexandre Mahone', 'NO'),
(38, 10, 'Matt Scofield', 'NO'),
(39, 11, 'Tokio', 'SI'),
(40, 11, 'Manchester', 'NO'),
(41, 11, 'Berlin', 'NO'),
(42, 11, 'Beijing', 'NO'),
(43, 12, 'VERDADERO', 'NO'),
(44, 12, 'FALSO', 'SI'),
(45, 13, 'Kake', 'NO'),
(46, 13, 'Tatami', 'SI'),
(47, 13, 'Randori', 'NO'),
(48, 13, 'Ring', 'NO'),
(49, 14, 'Corvina', 'NO'),
(50, 14, 'Mojarra', 'NO'),
(51, 14, 'Pejerrey', 'SI'),
(52, 14, 'Dorado', 'NO'),
(53, 15, 'Corrientes', 'NO'),
(54, 15, 'San Luis', 'NO'),
(55, 15, 'Salta', 'NO'),
(56, 15, 'Cordoba', 'SI'),
(57, 16, 'Lobo', 'SI'),
(58, 16, 'Leon', 'NO'),
(59, 16, 'Perro', 'NO'),
(60, 16, 'Guepardo', 'NO'),
(61, 17, 'VERDADERO', 'NO'),
(62, 17, 'FALSO', 'SI'),
(63, 18, 'Argentina', 'NO'),
(64, 18, 'Estados Unidos', 'SI'),
(65, 18, 'Mexico', 'NO'),
(66, 18, 'Canada', 'NO'),
(67, 19, '10 metros', 'NO'),
(68, 19, '2 metros', 'NO'),
(69, 19, '3 metros', 'SI'),
(70, 19, '5 metros', 'NO'),
(71, 20, 'Ninguna', 'NO'),
(72, 20, 'Una', 'NO'),
(73, 20, 'Dos', 'NO'),
(74, 20, 'Tres', 'SI'),
(75, 21, 'Rata', 'SI'),
(76, 21, 'Camello', 'NO'),
(77, 21, 'Cucaracha', 'NO'),
(78, 21, 'Perro', 'NO'),
(79, 22, 'VERDADERO', 'SI'),
(80, 22, 'FALSO', 'NO'),
(81, 23, 'Verdes', 'NO'),
(82, 23, 'Amarillos', 'SI'),
(83, 23, 'Marrones', 'NO'),
(84, 23, 'Negros', 'NO'),
(85, 24, 'Araucaria', 'NO'),
(86, 24, 'Ombu', 'NO'),
(87, 24, 'Eucalipto', 'SI'),
(88, 24, 'Pino', 'NO'),
(89, 25, 'Michael Jordan', 'NO'),
(90, 25, 'Robert Aldrin', 'NO'),
(91, 25, 'Neil Amstrong', 'NO'),
(92, 25, 'Yuri Garin', 'SI'),
(93, 26, 'En sus patas', 'SI'),
(94, 26, 'En su cabeza', 'NO'),
(95, 26, 'En su abdomen', 'NO'),
(96, 26, 'En su lengua', 'NO'),
(97, 27, 'Mediodia', 'NO'),
(98, 27, 'Al amanecer', 'SI'),
(99, 27, 'Al anochecer', 'NO'),
(100, 27, 'Medianoche', 'NO'),
(101, 28, 'Amarilla', 'NO'),
(102, 28, 'Rosa', 'NO'),
(103, 28, 'Negra', 'SI'),
(104, 28, 'Blanca', 'NO'),
(105, 29, 'VERDADERO', 'NO'),
(106, 29, 'FALSO', 'SI'),
(107, 30, 'Noventa y ocho', 'NO'),
(108, 30, 'Cien', 'NO'),
(109, 30, 'Cincuenta', 'NO'),
(110, 30, 'Cuarenta y dos', 'SI'),
(111, 31, 'Hawai', 'NO'),
(112, 31, 'California', 'NO'),
(113, 31, 'New york', 'SI'),
(114, 31, 'Texas', 'NO'),
(115, 32, 'Entre Rios', 'NO'),
(116, 32, 'Mendoza', 'SI'),
(117, 32, 'Neuquen', 'NO'),
(118, 32, 'Rio Negro', 'NO'),
(119, 33, 'India', 'NO'),
(120, 33, 'Turquia', 'NO'),
(121, 33, 'Tailandia', 'SI'),
(122, 33, 'Pakistan', 'NO'),
(123, 34, 'Torrecillas', 'NO'),
(124, 34, 'Spegazzini', 'NO'),
(125, 34, 'Upsala', 'NO'),
(126, 34, 'Perito Moreno', 'SI'),
(127, 35, 'Georgia', 'SI'),
(128, 35, 'España', 'NO'),
(129, 35, 'China', 'NO'),
(130, 35, 'Noruega', 'NO'),
(131, 36, 'Colombia', 'NO'),
(132, 36, 'Venezuela', 'SI'),
(133, 36, 'Ecuador', 'NO'),
(134, 36, 'Peru', 'NO'),
(135, 37, 'Santa Rosa', 'NO'),
(136, 37, 'Georgina', 'NO'),
(137, 37, 'Katrina', 'SI'),
(138, 37, 'Alex', 'NO'),
(139, 38, 'VERDADERO', 'SI'),
(140, 38, 'FALSO', 'NO'),
(141, 39, 'San Luis', 'NO'),
(142, 39, 'Salta', 'NO'),
(143, 39, 'Jujuy', 'NO'),
(144, 39, 'Catamarca', 'SI'),
(145, 40, 'Rusia', 'SI'),
(146, 40, 'Canada', 'NO'),
(147, 40, 'China', 'NO'),
(148, 40, 'Japon', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fechaNac` date NOT NULL,
  `pais` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `fotoPerfil` varchar(250) NOT NULL,
  `latitud` double NOT NULL DEFAULT 0,
  `longitud` double NOT NULL DEFAULT 0,
  `record` int(11) DEFAULT 0,
  `puntosTotales` int(11) DEFAULT 0,
  `qtyPreguntas` int(11) NOT NULL DEFAULT 0,
  `qtyCorrectas` int(11) NOT NULL DEFAULT 0,
  `shareCorrecta` float NOT NULL DEFAULT 0,
  `qtyPartidas` int(100) NOT NULL DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `fechaNac`, `pais`, `ciudad`, `genero`, `email`, `usuario`, `contraseña`, `fotoPerfil`, `latitud`, `longitud`, `record`, `puntosTotales`, `qtyPreguntas`, `qtyCorrectas`, `shareCorrecta`, `qtyPartidas`, `fecha_creacion`) VALUES
(1, 'admin', 'admin', '2003-03-20', 'Chile', 'Santiago de Chile', 'Mascuino', 'admin@test.com', 'admin', '1234', '', 0, 0, 0, 0, 0, 0, 0, 0, '2023-11-18 17:33:25'),
(2, 'editor', 'editor', '2000-10-10', 'Argentina', 'San Justo', 'Femenino', 'editor@test.com', 'editor', '1234', '', 0, 0, 0, 0, 0, 0, 0, 0, '2023-11-18 17:33:25'),
(3, 'Guadalupe', 'Fernandez', '2000-06-20', 'Argentina', 'Moron', 'Femenino', 'guadapfernandez@gmail.com', 'guada', '1234', 'public/imagen_124.jpg', 0, 0, 5, 7, 9, 7, 0.777778, 2, '2023-11-18 17:33:25'),
(7, 'maria', 'perez', '1989-12-13', 'Argentina', 'Haedo', 'Femenino', 'guadapfernandez@hotmail.com', 'maria', '123', 'public/fotosPerfil/imagen_92.jpg', -34.6440676, -58.59564279999999, 1, 3, 6, 2, 0.333333, 4, '2023-11-26 19:29:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
