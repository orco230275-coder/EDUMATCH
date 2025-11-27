

DROP TABLE IF EXISTS `asignatura`;


CREATE TABLE `asignatura` (
  `id_asignatura` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_asignatura`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO asignatura VALUES("40","ADMINISTRACIÓN DE BASE DE DATOS"INSERT INTO asignatura VALUES("110","ADMINISTRACIÓN DE SERVIDORES (TSU)"INSERT INTO asignatura VALUES("6","ÁLGEBRA LINEAL"INSERT INTO asignatura VALUES("101","ANÁLISIS Y DISEÑO DE SOFTWARE (TSU)"INSERT INTO asignatura VALUES("98","APLICACIONES WEB (TSU)"INSERT INTO asignatura VALUES("103","APLICACIONES WEB ORIENTADAS A SERVICIOS (TSU)"INSERT INTO asignatura VALUES("16","ARQUITECTURA DE COMPUTADORAS"INSERT INTO asignatura VALUES("34","BASE DE DATOS"INSERT INTO asignatura VALUES("95","BASES DE DATOS (TSU)"INSERT INTO asignatura VALUES("104","BASES DE DATOS AVANZADAS (TSU)"INSERT INTO asignatura VALUES("97","CÁLCULO DE VARIAS VARIABLES (TSU)"INSERT INTO asignatura VALUES("18","CÁLCULO DIFERENCIAL"INSERT INTO asignatura VALUES("88","CÁLCULO DIFERENCIAL (TSU)"INSERT INTO asignatura VALUES("24","CÁLCULO INTEGRAL"INSERT INTO asignatura VALUES("93","CÁLCULO INTEGRAL (TSU)"INSERT INTO asignatura VALUES("113","CIENCIA DE DATOS (TSU)"INSERT INTO asignatura VALUES("87","COMUNICACIÓN Y HABILIDADES DIGITALES (TSU)"INSERT INTO asignatura VALUES("89","CONMUTACIÓN Y ENRUTAMIENTO DE REDES (TSU)"INSERT INTO asignatura VALUES("100","DESARROLLO DE APLICACIONES MÓVILES (TSU)"INSERT INTO asignatura VALUES("43","DISEÑO DE INTERFACES"INSERT INTO asignatura VALUES("102","ECUACIONES DIFERENCIALES (TSU)"INSERT INTO asignatura VALUES("14","ELECTRICIDAD Y MAGNETISMO"INSERT INTO asignatura VALUES("108","ELECTRÓNICA DIGITAL (TSU)"INSERT INTO asignatura VALUES("33","ESCALAMIENTO DE REDES"INSERT INTO asignatura VALUES("105","ESTÁNDARES Y MÉTRICAS PARA EL DESARROLLO DE SOFTWARE (TSU)"INSERT INTO asignatura VALUES("26","ESTRUCTURA DE DATOS"INSERT INTO asignatura VALUES("99","ESTRUCTURA DE DATOS (TSU)"INSERT INTO asignatura VALUES("29","ÉTICA PROFESIONAL"INSERT INTO asignatura VALUES("13","FÍSICA"INSERT INTO asignatura VALUES("85","FÍSICA (TSU)"INSERT INTO asignatura VALUES("31","FÍSICA PARA INGENIERÍA"INSERT INTO asignatura VALUES("12","FUNCIONES MATEMÁTICAS"INSERT INTO asignatura VALUES("106","FUNDAMENTOS DE INTELIGENCIA ARTIFICIAL (TSU)"INSERT INTO asignatura VALUES("86","FUNDAMENTOS DE PROGRAMACIÓN (TSU)"INSERT INTO asignatura VALUES("32","FUNDAMENTOS DE PROGRAMACIÓN ORIENTADA A OBJETOS"INSERT INTO asignatura VALUES("84","FUNDAMENTOS DE REDES (TSU)"INSERT INTO asignatura VALUES("83","FUNDAMENTOS MATEMÁTICOS (TSU)"INSERT INTO asignatura VALUES("45","GESTIÓN DE DESARROLLO DE SOFTWARE"INSERT INTO asignatura VALUES("9","HERRAMIENTAS OFIMÁTICAS"INSERT INTO asignatura VALUES("111","INFORMÁTICA FORENSE (TSU)"INSERT INTO asignatura VALUES("25","INGENIERÍA DE SOFTWARE"INSERT INTO asignatura VALUES("10","INGLÉS I"INSERT INTO asignatura VALUES("11","INGLÉS II"INSERT INTO asignatura VALUES("17","INGLÉS III"INSERT INTO asignatura VALUES("23","INGLÉS IV"INSERT INTO asignatura VALUES("46","INGLÉS IX"INSERT INTO asignatura VALUES("28","INGLÉS V"INSERT INTO asignatura VALUES("35","INGLÉS VI"INSERT INTO asignatura VALUES("1","INGLES VII"INSERT INTO asignatura VALUES("47","INTELIGENCIA DE NEGOCIOS"INSERT INTO asignatura VALUES("39","INTERCONEXIÓN DE REDES"INSERT INTO asignatura VALUES("112","INTERNET DE LAS COSAS (TSU)"INSERT INTO asignatura VALUES("7","INTRODUCCIÓN A LA PROGRAMACIÓN"INSERT INTO asignatura VALUES("8","INTRODUCCIÓN A LAS TECNOLOGÍAS DE INFORMACIÓN"INSERT INTO asignatura VALUES("21","INTRODUCCIÓN A REDES"INSERT INTO asignatura VALUES("2","LENGUAJES Y AUTÓMATAS"INSERT INTO asignatura VALUES("22","MANTENIMIENTO A EQUIPO DE CÓMPUTO"INSERT INTO asignatura VALUES("15","MATEMÁTICAS BÁSICAS PARA COMPUTACIÓN"INSERT INTO asignatura VALUES("30","MATEMÁTICAS PARA INGENIERÍA I"INSERT INTO asignatura VALUES("36","MATEMÁTICAS PARA INGENIERÍA II"INSERT INTO asignatura VALUES("19","PROBABILIDAD Y ESTADÍSTICA"INSERT INTO asignatura VALUES("90","PROBABILIDAD Y ESTADÍSTICA (TSU)"INSERT INTO asignatura VALUES("20","PROGRAMACIÓN"INSERT INTO asignatura VALUES("91","PROGRAMACIÓN ESTRUCTURADA (TSU)"INSERT INTO asignatura VALUES("49","PROGRAMACIÓN MÓVIL"INSERT INTO asignatura VALUES("38","PROGRAMACIÓN ORIENTADA A OBJETOS"INSERT INTO asignatura VALUES("96","PROGRAMACIÓN ORIENTADA A OBJETOS (TSU)"INSERT INTO asignatura VALUES("109","PROGRAMACIÓN PARA INTELIGENCIA ARTIFICIAL (TSU)"INSERT INTO asignatura VALUES("3","PROGRAMACIÓN WEB"INSERT INTO asignatura VALUES("5","QUÍMICA BÁSICA"INSERT INTO asignatura VALUES("27","RUTEO Y CONMUTACIÓN"INSERT INTO asignatura VALUES("50","SEGURIDAD INFORMÁTICA"INSERT INTO asignatura VALUES("107","SEGURIDAD INFORMÁTICA (TSU)"INSERT INTO asignatura VALUES("48","SISTEMAS EMBEBIDOS"INSERT INTO asignatura VALUES("44","SISTEMAS INTELIGENTES"INSERT INTO asignatura VALUES("37","SISTEMAS OPERATIVOS"INSERT INTO asignatura VALUES("92","SISTEMAS OPERATIVOS (TSU)"INSERT INTO asignatura VALUES("41","TECNOLOGÍAS DE VIRTUALIZACIÓN"INSERT INTO asignatura VALUES("114","TECNOLOGÍAS DISRUPTIVAS (TSU)"INSERT INTO asignatura VALUES("42","TECNOLOGÍAS Y APLICACIONES EN INTERNET"INSERT INTO asignatura VALUES("94","TÓPICOS DE CALIDAD PARA EL DISEÑO DE SOFTWARE (TSU)"




DROP TABLE IF EXISTS `bitacora_asesoria`;


CREATE TABLE `bitacora_asesoria` (
  `id_asesoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitud` int(11) NOT NULL,
  `fecha_realizada` date NOT NULL,
  `retroalimentacion` text DEFAULT NULL,
  `periodo_cuatrimestral` varchar(10) DEFAULT NULL,
  `id_tutor` int(11) NOT NULL,
  `id_asesorado` int(11) DEFAULT NULL,
  `calificacion_estrellas` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_asesoria`),
  UNIQUE KEY `id_solicitud` (`id_solicitud`),
  KEY `id_tutor` (`id_tutor`),
  KEY `id_asesorado` (`id_asesorado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO bitacora_asesoria VALUES("2","3","2025-11-14","Explica bien","0","10","9","5"




DROP TABLE IF EXISTS `horario`;


CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  `id_tutor` int(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `id_tutor` (`id_tutor`),
  KEY `fk_horario_asignatura` (`id_asignatura`),
  CONSTRAINT `fk_horario_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`),
  CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_tutor`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO horario VALUES("10","2025-11-22","17:00:00","18:30:00","18","13"INSERT INTO horario VALUES("12","2025-11-17","10:00:00","11:00:00","24","13"INSERT INTO horario VALUES("14","2025-11-17","07:00:00","08:00:00","11","10"INSERT INTO horario VALUES("15","2025-11-21","11:00:00","11:30:00","13","10"




DROP TABLE IF EXISTS `premio`;


CREATE TABLE `premio` (
  `id_premio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_premio` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_premio`),
  KEY `fk_premio_usuario` (`id_usuario`),
  CONSTRAINT `fk_premio_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO premio VALUES("6","-2 horas de cecam","si tienes horas puedes anularlas","6"INSERT INTO premio VALUES("7","1 punto","En la evidencia que escojas","12"




DROP TABLE IF EXISTS `recurso`;


CREATE TABLE `recurso` (
  `id_recurso` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `enlace` varchar(150) DEFAULT NULL,
  `asignatura` varchar(50) DEFAULT NULL,
  `id_asignatura` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_recurso`),
  KEY `fk_recurso_asignatura` (`id_asignatura`),
  CONSTRAINT `fk_recurso_asignatura` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO recurso VALUES("1","Aprende programación","https://youtu.be/oHHsLTV7l3E?si=qAjPQp2byRd9mpDz","3",NULLINSERT INTO recurso VALUES("2","Aprende programación","https://youtu.be/oHHsLTV7l3E?si=qAjPQp2byRd9mpDz",NULL,"7"INSERT INTO recurso VALUES("3","Fundamentos de Programación","https://www.freecodecamp.org/espanol/learn/javascript-algorithms-and-data-structures",NULL,"86"INSERT INTO recurso VALUES("4","Fundamentos Matemáticos","https://es.khanacademy.org/math/algebra",NULL,"6"INSERT INTO recurso VALUES("5","Programación Estructurada","https://www.youtube.com/playlist?list=PLWtYZ2ejMVJkjOuTCzIk61j7XKfpIR74K",NULL,"26"INSERT INTO recurso VALUES("6","Aprendiendo cálculo","https://es.khanacademy.org/math/differential-calculus",NULL,"88"INSERT INTO recurso VALUES("7","Estadísticas y probabilidades ","https://es.khanacademy.org/math/statistics-probability",NULL,"19"INSERT INTO recurso VALUES("8","Algo sobre sistemas operativos","https://edu.gcfglobal.org/es/topics/sistemas-operativos/",NULL,"37"INSERT INTO recurso VALUES("9","MySQL","https://www.w3schools.com/sql",NULL,"34"INSERT INTO recurso VALUES("10","POO en java","https://www.w3schools.com/",NULL,"38"INSERT INTO recurso VALUES("11","Calidad del Software","https://www.guru99.com/software-testing-introduction-importance.html",NULL,"45"INSERT INTO recurso VALUES("12","Aplicaciones Web (HTML, CSS, JS)","https://www.w3schools.com/html/default.asp",NULL,"98"INSERT INTO recurso VALUES("13","Desarrollo de Aplicaciones Móviles (Android)","https://developer.android.com/courses?hl=es-419",NULL,"98"INSERT INTO recurso VALUES("14","Estructura de Datos - VisuAlgo","https://visualgo.net/en",NULL,"26"INSERT INTO recurso VALUES("15","Aplicaciones Web orientadas a servicios (APIs, REST)","https://www.freecodecamp.org/espanol/news/aprende-a-crear-apis-desde-cero-con-node-js-y-express-curso-desde-cero/?utm_source=chatgpt.com",NULL,"103"INSERT INTO recurso VALUES("16","BDS avanzadas","http://www.webdelprofesor.ula.ve/ingenieria/ibc/bda/s0intro.pdf",NULL,"104"INSERT INTO recurso VALUES("17","Elements of AI","http://www.elementsofai.com/es",NULL,"106"INSERT INTO recurso VALUES("18"," Seguridad Informática","https://skillsbuild.org/es/students/course-catalog/cybersecurity",NULL,"50"INSERT INTO recurso VALUES("19","Data SCience","https://skillsbuild.org/es/students/course-catalog/data-science",NULL,"113"




DROP TABLE IF EXISTS `solicitud_asesoria`;


CREATE TABLE `solicitud_asesoria` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `estado` enum('Pendiente','Aceptada','Rechazada','Cancelada') NOT NULL DEFAULT 'Pendiente',
  `id_usuario` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_horario` (`id_horario`),
  KEY `id_asignatura` (`id_asignatura`),
  CONSTRAINT `solicitud_asesoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `solicitud_asesoria_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`),
  CONSTRAINT `solicitud_asesoria_ibfk_3` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO solicitud_asesoria VALUES("10","Cancelada","9","12","24"INSERT INTO solicitud_asesoria VALUES("12","Pendiente","11","15","13"INSERT INTO solicitud_asesoria VALUES("14","Cancelada","9","15","13"INSERT INTO solicitud_asesoria VALUES("15","Cancelada","9","12","24"




DROP TABLE IF EXISTS `usuario`;


CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `matricula` varchar(80) NOT NULL,
  `contraseña` varchar(80) NOT NULL,
  `rol` enum('Asesorado','Profesor','Tutor') NOT NULL,
  `area` varchar(50) DEFAULT NULL,
  `areasEnseñanza` varchar(50) DEFAULT NULL,
  `cuatrimestre` int(11) DEFAULT NULL,
  `necesidades` text DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuario VALUES("6","Deny Lizbeth","Hernández Rabadán","denhz@upemor.edu.mx","DLHR","$2y$10$EYCtHdbRlcZNV38EOunXF.7gI1WiXIRefyeHGRQ6OAD410dN.1/z6","Profesor","Programación","","0",""INSERT INTO usuario VALUES("9","Audrey","Arrioja Arizpe","au@upemor.edu.mx","AAA1","$2y$10$FhRVQPVefZWbgLB8IdLORucWkBgp.7Mnp/ULcyvQ3pZxLmA3hvPJi","Asesorado","","","7","Quimica"INSERT INTO usuario VALUES("10","Catherine Aylin","Ochoa Rabadan","cath@upemor.edu.mx","ORCA","$2y$10$1BHc3Lp6J.9pksMs.9IcF.r1VEfpUttRLmGPsztk.oGYs3ii9pOAi","Tutor",NULL,"Fisica","7",NULLINSERT INTO usuario VALUES("11","Arturo","Hernández Martínez","art@upemor.edu.mx","AHM1","$2y$10$8OI4DLpax9cxBouQzB2o2eNfnSKVzY/tQoqegrWOAqlJr3zNeXJaa","Asesorado","","","7","Ingles"INSERT INTO usuario VALUES("12","Roberto Enrique","López Díaz","robert@upemor.edu.mx","RELD","$2y$10$GSyOeomG1IX83Sot0CpOC.N.MJmyp5XEyz3MpclSnKua017hfPqh6","Profesor","Programación","",NULL,""INSERT INTO usuario VALUES("13","Angel","Mendoza Rodriguez","angmr@upemor.edu.mx","AMR2","$2y$10$TEtDjWNJ.VDD.QlQTbKUTueXwaJQBhcFznqxFFF7CK.LicLWetXD2","Tutor","","Matemáticas, Física","7",""INSERT INTO usuario VALUES("15","Erick Antonio","Cortina Lazcano","erick@upemor.edu.mx","EACL","$2y$10$lUUdFVzSkcQLYQmbElAcX.VQluFe/CYYH7WuDKA7JceDzVLl1hzHe","Asesorado","","","7","Ingles"


