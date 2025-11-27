-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2025 a las 06:05:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sa_prueba`
--
CREATE DATABASE IF NOT EXISTS `sa_prueba` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sa_prueba`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id_asignatura`, `nombre`) VALUES
(40, 'ADMINISTRACIÓN DE BASE DE DATOS'),
(110, 'ADMINISTRACIÓN DE SERVIDORES (TSU)'),
(6, 'ÁLGEBRA LINEAL'),
(101, 'ANÁLISIS Y DISEÑO DE SOFTWARE (TSU)'),
(98, 'APLICACIONES WEB (TSU)'),
(103, 'APLICACIONES WEB ORIENTADAS A SERVICIOS (TSU)'),
(16, 'ARQUITECTURA DE COMPUTADORAS'),
(34, 'BASE DE DATOS'),
(95, 'BASES DE DATOS (TSU)'),
(104, 'BASES DE DATOS AVANZADAS (TSU)'),
(97, 'CÁLCULO DE VARIAS VARIABLES (TSU)'),
(18, 'CÁLCULO DIFERENCIAL'),
(88, 'CÁLCULO DIFERENCIAL (TSU)'),
(24, 'CÁLCULO INTEGRAL'),
(93, 'CÁLCULO INTEGRAL (TSU)'),
(113, 'CIENCIA DE DATOS (TSU)'),
(87, 'COMUNICACIÓN Y HABILIDADES DIGITALES (TSU)'),
(89, 'CONMUTACIÓN Y ENRUTAMIENTO DE REDES (TSU)'),
(100, 'DESARROLLO DE APLICACIONES MÓVILES (TSU)'),
(43, 'DISEÑO DE INTERFACES'),
(102, 'ECUACIONES DIFERENCIALES (TSU)'),
(14, 'ELECTRICIDAD Y MAGNETISMO'),
(108, 'ELECTRÓNICA DIGITAL (TSU)'),
(33, 'ESCALAMIENTO DE REDES'),
(105, 'ESTÁNDARES Y MÉTRICAS PARA EL DESARROLLO DE SOFTWARE (TSU)'),
(26, 'ESTRUCTURA DE DATOS'),
(99, 'ESTRUCTURA DE DATOS (TSU)'),
(29, 'ÉTICA PROFESIONAL'),
(13, 'FÍSICA'),
(85, 'FÍSICA (TSU)'),
(31, 'FÍSICA PARA INGENIERÍA'),
(12, 'FUNCIONES MATEMÁTICAS'),
(106, 'FUNDAMENTOS DE INTELIGENCIA ARTIFICIAL (TSU)'),
(86, 'FUNDAMENTOS DE PROGRAMACIÓN (TSU)'),
(32, 'FUNDAMENTOS DE PROGRAMACIÓN ORIENTADA A OBJETOS'),
(84, 'FUNDAMENTOS DE REDES (TSU)'),
(83, 'FUNDAMENTOS MATEMÁTICOS (TSU)'),
(45, 'GESTIÓN DE DESARROLLO DE SOFTWARE'),
(9, 'HERRAMIENTAS OFIMÁTICAS'),
(111, 'INFORMÁTICA FORENSE (TSU)'),
(25, 'INGENIERÍA DE SOFTWARE'),
(10, 'INGLÉS I'),
(11, 'INGLÉS II'),
(17, 'INGLÉS III'),
(23, 'INGLÉS IV'),
(46, 'INGLÉS IX'),
(28, 'INGLÉS V'),
(35, 'INGLÉS VI'),
(1, 'INGLES VII'),
(47, 'INTELIGENCIA DE NEGOCIOS'),
(39, 'INTERCONEXIÓN DE REDES'),
(112, 'INTERNET DE LAS COSAS (TSU)'),
(7, 'INTRODUCCIÓN A LA PROGRAMACIÓN'),
(8, 'INTRODUCCIÓN A LAS TECNOLOGÍAS DE INFORMACIÓN'),
(21, 'INTRODUCCIÓN A REDES'),
(2, 'LENGUAJES Y AUTÓMATAS'),
(22, 'MANTENIMIENTO A EQUIPO DE CÓMPUTO'),
(15, 'MATEMÁTICAS BÁSICAS PARA COMPUTACIÓN'),
(30, 'MATEMÁTICAS PARA INGENIERÍA I'),
(36, 'MATEMÁTICAS PARA INGENIERÍA II'),
(19, 'PROBABILIDAD Y ESTADÍSTICA'),
(90, 'PROBABILIDAD Y ESTADÍSTICA (TSU)'),
(20, 'PROGRAMACIÓN'),
(91, 'PROGRAMACIÓN ESTRUCTURADA (TSU)'),
(49, 'PROGRAMACIÓN MÓVIL'),
(38, 'PROGRAMACIÓN ORIENTADA A OBJETOS'),
(96, 'PROGRAMACIÓN ORIENTADA A OBJETOS (TSU)'),
(109, 'PROGRAMACIÓN PARA INTELIGENCIA ARTIFICIAL (TSU)'),
(3, 'PROGRAMACIÓN WEB'),
(5, 'QUÍMICA BÁSICA'),
(27, 'RUTEO Y CONMUTACIÓN'),
(50, 'SEGURIDAD INFORMÁTICA'),
(107, 'SEGURIDAD INFORMÁTICA (TSU)'),
(48, 'SISTEMAS EMBEBIDOS'),
(44, 'SISTEMAS INTELIGENTES'),
(37, 'SISTEMAS OPERATIVOS'),
(92, 'SISTEMAS OPERATIVOS (TSU)'),
(41, 'TECNOLOGÍAS DE VIRTUALIZACIÓN'),
(114, 'TECNOLOGÍAS DISRUPTIVAS (TSU)'),
(42, 'TECNOLOGÍAS Y APLICACIONES EN INTERNET'),
(94, 'TÓPICOS DE CALIDAD PARA EL DISEÑO DE SOFTWARE (TSU)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_asesoria`
--

DROP TABLE IF EXISTS `bitacora_asesoria`;
CREATE TABLE `bitacora_asesoria` (
  `id_asesoria` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `fecha_realizada` date NOT NULL,
  `retroalimentacion` text DEFAULT NULL,
  `periodo_cuatrimestral` varchar(10) DEFAULT NULL,
  `id_tutor` int(11) NOT NULL,
  `id_asesorado` int(11) DEFAULT NULL,
  `calificacion_estrellas` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora_asesoria`
--

INSERT INTO `bitacora_asesoria` (`id_asesoria`, `id_solicitud`, `fecha_realizada`, `retroalimentacion`, `periodo_cuatrimestral`, `id_tutor`, `id_asesorado`, `calificacion_estrellas`) VALUES
(2, 3, '2025-11-14', 'Explica bien', '0', 10, 9, 5),
(3, 17, '2025-11-22', 'Falta ser más dinámico', 'Septiembre', 13, 9, 4),
(4, 16, '2025-11-27', 'Explica bien', 'Septiembre', 10, 9, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_tutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `fecha`, `hora_inicio`, `hora_fin`, `id_asignatura`, `id_tutor`) VALUES
(10, '2025-11-22', '17:00:00', '18:30:00', 18, 13),
(12, '2025-11-17', '10:00:00', '11:00:00', 24, 13),
(14, '2025-11-17', '07:00:00', '08:00:00', 11, 10),
(15, '2025-11-21', '11:00:00', '11:30:00', 13, 10),
(16, '2025-11-20', '10:04:00', '11:04:00', 31, 10),
(17, '2025-11-27', '13:15:00', '14:15:00', 113, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premio`
--

DROP TABLE IF EXISTS `premio`;
CREATE TABLE `premio` (
  `id_premio` int(11) NOT NULL,
  `nombre_premio` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `estado` enum('pendiente','aceptado','rechazado') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `premio`
--

INSERT INTO `premio` (`id_premio`, `nombre_premio`, `descripcion`, `id_usuario`, `estado`) VALUES
(6, '-2 horas de cecam', 'si tienes horas puedes anularlas', 6, 'aceptado'),
(7, '1 punto', 'En la evidencia que escojas', 12, 'rechazado'),
(9, '-4 horas de cecam', 'anular horas', 6, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recurso`
--

DROP TABLE IF EXISTS `recurso`;
CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `enlace` varchar(150) DEFAULT NULL,
  `asignatura` varchar(50) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recurso`
--

INSERT INTO `recurso` (`id_recurso`, `titulo`, `enlace`, `asignatura`, `id_asignatura`) VALUES
(1, 'Aprende programación', 'https://youtu.be/oHHsLTV7l3E?si=qAjPQp2byRd9mpDz', '3', NULL),
(2, 'Aprende programación', 'https://youtu.be/oHHsLTV7l3E?si=qAjPQp2byRd9mpDz', NULL, 7),
(3, 'Fundamentos de Programación', 'https://www.freecodecamp.org/espanol/learn/javascript-algorithms-and-data-structures', NULL, 86),
(4, 'Fundamentos Matemáticos', 'https://es.khanacademy.org/math/algebra', NULL, 6),
(5, 'Programación Estructurada', 'https://www.youtube.com/playlist?list=PLWtYZ2ejMVJkjOuTCzIk61j7XKfpIR74K', NULL, 26),
(6, 'Aprendiendo cálculo', 'https://es.khanacademy.org/math/differential-calculus', NULL, 88),
(7, 'Estadísticas y probabilidades ', 'https://es.khanacademy.org/math/statistics-probability', NULL, 19),
(8, 'Algo sobre sistemas operativos', 'https://edu.gcfglobal.org/es/topics/sistemas-operativos/', NULL, 37),
(9, 'MySQL', 'https://www.w3schools.com/sql', NULL, 34),
(10, 'POO en java', 'https://www.w3schools.com/', NULL, 38),
(11, 'Calidad del Software', 'https://www.guru99.com/software-testing-introduction-importance.html', NULL, 45),
(12, 'Aplicaciones Web (HTML, CSS, JS)', 'https://www.w3schools.com/html/default.asp', NULL, 98),
(13, 'Desarrollo de Aplicaciones Móviles (Android)', 'https://developer.android.com/courses?hl=es-419', NULL, 98),
(14, 'Estructura de Datos - VisuAlgo', 'https://visualgo.net/en', NULL, 26),
(15, 'Aplicaciones Web orientadas a servicios (APIs, REST)', 'https://www.freecodecamp.org/espanol/news/aprende-a-crear-apis-desde-cero-con-node-js-y-express-curso-desde-cero/?utm_source=chatgpt.com', NULL, 103),
(16, 'BDS avanzadas', 'http://www.webdelprofesor.ula.ve/ingenieria/ibc/bda/s0intro.pdf', NULL, 104),
(17, 'Elements of AI', 'http://www.elementsofai.com/es', NULL, 106),
(18, ' Seguridad Informática', 'https://skillsbuild.org/es/students/course-catalog/cybersecurity', NULL, 50),
(19, 'Data SCience', 'https://skillsbuild.org/es/students/course-catalog/data-science', NULL, 113);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_asesoria`
--

DROP TABLE IF EXISTS `solicitud_asesoria`;
CREATE TABLE `solicitud_asesoria` (
  `id_solicitud` int(11) NOT NULL,
  `estado` enum('Pendiente','Aceptada','Rechazada','Cancelada') NOT NULL DEFAULT 'Pendiente',
  `id_usuario` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud_asesoria`
--

INSERT INTO `solicitud_asesoria` (`id_solicitud`, `estado`, `id_usuario`, `id_horario`, `id_asignatura`) VALUES
(10, 'Cancelada', 9, 12, 24),
(12, 'Rechazada', 11, 15, 13),
(14, 'Cancelada', 9, 15, 13),
(15, 'Cancelada', 9, 12, 24),
(16, 'Aceptada', 9, 16, 31),
(17, 'Aceptada', 9, 12, 24),
(18, 'Cancelada', 59, 14, 11),
(20, 'Cancelada', 11, 17, 113);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `contraseña` varchar(80) NOT NULL,
  `rol` enum('Asesorado','Profesor','Tutor') NOT NULL,
  `area` varchar(50) DEFAULT NULL,
  `areasEnseñanza` varchar(50) DEFAULT NULL,
  `cuatrimestre` int(11) DEFAULT NULL,
  `necesidades` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `correo`, `contraseña`, `rol`, `area`, `areasEnseñanza`, `cuatrimestre`, `necesidades`) VALUES
(6, 'Deny Lizbeth', 'Hernández Rabadán', 'denhz@upemor.edu.mx', '$2y$10$EYCtHdbRlcZNV38EOunXF.7gI1WiXIRefyeHGRQ6OAD410dN.1/z6', 'Profesor', 'Programación', '', 0, ''),
(9, 'Audrey', 'Arrioja Arizpe', 'au@upemor.edu.mx', '$2y$10$FhRVQPVefZWbgLB8IdLORucWkBgp.7Mnp/ULcyvQ3pZxLmA3hvPJi', 'Asesorado', '', '', 7, 'Quimica'),
(10, 'Catherine Aylin', 'Ochoa Rabadan', 'cath@upemor.edu.mx', '$2y$10$1BHc3Lp6J.9pksMs.9IcF.r1VEfpUttRLmGPsztk.oGYs3ii9pOAi', 'Tutor', NULL, 'Fisica', 7, NULL),
(11, 'Arturo', 'Hernández Martínez', 'art@upemor.edu.mx', '$2y$10$8OI4DLpax9cxBouQzB2o2eNfnSKVzY/tQoqegrWOAqlJr3zNeXJaa', 'Asesorado', '', '', 7, 'Ingles'),
(12, 'Roberto Enrique', 'López Díaz', 'robert@upemor.edu.mx', '$2y$10$GSyOeomG1IX83Sot0CpOC.N.MJmyp5XEyz3MpclSnKua017hfPqh6', 'Profesor', 'Programación', '', NULL, ''),
(13, 'Angel', 'Mendoza Rodriguez', 'angmr@upemor.edu.mx', '$2y$10$TEtDjWNJ.VDD.QlQTbKUTueXwaJQBhcFznqxFFF7CK.LicLWetXD2', 'Tutor', '', 'Matemáticas, Física', 7, ''),
(59, 'Yenifer', 'Silva Villanueva', 'yeni18@upemor.edu.mx', '$2y$10$7AP3SRtS8k3yGTXaIT3L0e7jFFaiK6wdHKoAwmA3kPrKBPKPmfkCm', 'Asesorado', NULL, NULL, 4, 'ingles, matemáticas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id_asignatura`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `bitacora_asesoria`
--
ALTER TABLE `bitacora_asesoria`
  ADD PRIMARY KEY (`id_asesoria`),
  ADD UNIQUE KEY `id_solicitud` (`id_solicitud`),
  ADD KEY `id_tutor` (`id_tutor`),
  ADD KEY `id_asesorado` (`id_asesorado`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_tutor` (`id_tutor`),
  ADD KEY `fk_horario_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `premio`
--
ALTER TABLE `premio`
  ADD PRIMARY KEY (`id_premio`),
  ADD KEY `fk_premio_usuario` (`id_usuario`);

--
-- Indices de la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id_recurso`),
  ADD KEY `fk_recurso_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `solicitud_asesoria`
--
ALTER TABLE `solicitud_asesoria`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_asignatura` (`id_asignatura`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `bitacora_asesoria`
--
ALTER TABLE `bitacora_asesoria`
  MODIFY `id_asesoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `premio`
--
ALTER TABLE `premio`
  MODIFY `id_premio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `recurso`
--
ALTER TABLE `recurso`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `solicitud_asesoria`
--
ALTER TABLE `solicitud_asesoria`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_tutor`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `premio`
--
ALTER TABLE `premio`
  ADD CONSTRAINT `fk_premio_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `recurso`
--
ALTER TABLE `recurso`
  ADD CONSTRAINT `fk_recurso_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);

--
-- Filtros para la tabla `solicitud_asesoria`
--
ALTER TABLE `solicitud_asesoria`
  ADD CONSTRAINT `solicitud_asesoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `solicitud_asesoria_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`),
  ADD CONSTRAINT `solicitud_asesoria_ibfk_3` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
