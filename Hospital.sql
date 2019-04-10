-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-04-2019 a las 19:39:21
-- Versión del servidor: 5.7.25-0ubuntu0.16.04.2
-- Versión de PHP: 7.0.33-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_hospital`
--

CREATE TABLE `area_hospital` (
  `id_area_hospital` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area_hospital`
--

INSERT INTO `area_hospital` (`id_area_hospital`, `nombre`) VALUES
(1, 'Urgencias'),
(2, 'Hospitalizacion'),
(3, 'Imageneologia'),
(4, 'Consulta general'),
(5, 'Farmacia'),
(6, 'Radiologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cama`
--

CREATE TABLE `cama` (
  `id_cama` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cama`
--

INSERT INTO `cama` (`id_cama`, `estado`) VALUES
(3, 1),
(4, 1),
(9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `H` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `id_paciente`, `id_medico`, `fecha`, `hora`, `H`, `estado`) VALUES
(1, 1, 1, '2019-04-18', '09:30:00', 4, 1),
(2, 1, 1, '2019-04-01', '09:30:00', 4, 1),
(3, 1, 1, '2019-04-11', '09:30:00', 4, 1),
(4, 1, 1, '2019-04-05', '09:00:00', 3, -1),
(5, 1, 1, '2019-04-05', '08:00:00', 1, 0),
(6, 1, NULL, '2019-04-01', '12:30:00', 10, 0),
(11, 1, 3, '2019-04-30', '08:00:00', 1, 1),
(12, 1, 7, '2019-02-13', '08:00:00', 0, 0),
(13, 3, 3, '2019-04-08', '00:00:00', NULL, 1),
(14, 1, 7, '2019-02-06', '14:00:00', 0, 0),
(15, 1, 1, '2019-04-08', '08:00:00', 1, 0),
(16, 1, 1, '2019-04-08', '14:00:00', 13, 0),
(17, 3, 3, '2019-04-05', '08:30:00', 2, 0),
(18, 1, 3, '2019-04-08', '08:00:00', 1, 0),
(19, 1, 3, '2019-04-08', '08:30:00', 2, 0),
(20, 1, 3, '2019-04-05', '15:30:00', 16, 1),
(21, 1, 3, '2019-04-05', '15:30:00', 16, 0),
(22, 1, 3, '2019-04-10', '08:00:00', 1, 0),
(23, 1, 1, '2019-04-08', '09:00:00', 3, 0),
(24, 1, 3, '2019-04-08', '09:30:00', 4, 0),
(25, 1, 3, '2019-04-08', '08:00:00', 1, 0),
(26, 1, 7, '2019-07-11', '10:00:00', 0, 0),
(27, 1, 1, '2019-04-18', '08:30:00', 2, 0),
(28, 1, 1, '2019-04-23', '08:00:00', 1, 0),
(29, 1, 3, '2019-04-23', '08:00:00', 1, 0),
(30, 1, 1, '2019-04-12', '08:00:00', 1, 0),
(31, 1, 1, '2019-04-05', '08:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_estudio`
--

CREATE TABLE `cita_estudio` (
  `id_cita_estudio` int(11) NOT NULL,
  `id_interconsulta` int(11) NOT NULL,
  `id_estudio` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `folio` varchar(50) NOT NULL,
  `img` tinyint(1) NOT NULL COMMENT '1-tiene imagen 0-no tiene img'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cita_estudio`
--

INSERT INTO `cita_estudio` (`id_cita_estudio`, `id_interconsulta`, `id_estudio`, `fecha`, `folio`, `img`) VALUES
(5, 4, 1, '2019-04-03 10:00:00', '2019-04-021', 1),
(6, 4, 4, '2019-04-06 14:30:00', '2019-04-044', 1),
(33, 7, 3, '2019-04-08 12:30:00', '2019-04-08333', 1),
(34, 8, 1, '2019-04-09 11:00:00', '2019-04-0818', 0),
(35, 9, 3, '2019-04-09 12:00:00', '2019-04-0993', 0),
(36, 10, 5, '2019-04-09 03:00:00', '2019-04-09105', 0),
(37, 11, 6, '2019-04-09 05:00:00', '2019-04-09116', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_referencias`
--

CREATE TABLE `datos_referencias` (
  `id_dato` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `datos_referencias`
--

INSERT INTO `datos_referencias` (`id_dato`, `nombre`) VALUES
(1, 'IMSS'),
(2, 'ISSTE'),
(3, 'SEGURO POPULAR'),
(4, 'SEGURO SOCIAL'),
(5, 'SEGURO GENERAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id_especialidad`, `nombre`, `descripcion`, `id_area`) VALUES
(3, 'Traumatologo', 'Persona que se encuentra en el área de urgencias y hospitalización.', 1),
(4, 'General', 'Persona encarga de consultar personas en citas generales.', 4),
(9, 'Imagenologo', 'Persona encargada de los procesos de imagenologia', 3),
(10, 'Radiologo', 'Persona encargada de los procesos de radiologia', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `id_estudio` int(11) NOT NULL COMMENT 'del 1-3 lab del 4-6 radio',
  `tipo` varchar(250) NOT NULL,
  `especificado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`id_estudio`, `tipo`, `especificado`) VALUES
(1, 'Sangre', 'Grupo sanguineo'),
(2, 'Sangre-plaquetas', 'Plaquetas'),
(3, 'Emoglobina', 'Niveles de emoglobina'),
(4, 'Radiografía-Urinario', 'Pielograma intravenoso-Tracto urinario (riñones, uréteres, vejiga)'),
(5, 'Radiografía-Gastrointestinal', 'Radiografías del tracto gastrointestinal superior'),
(6, 'Radiografía-Venografía', 'Venografía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expediente`
--

CREATE TABLE `expediente` (
  `id_expediente` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL,
  `bitacora` varchar(500) NOT NULL,
  `motivo_atencion` varchar(30) NOT NULL,
  `signos_vitales` varchar(100) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `expediente`
--

INSERT INTO `expediente` (`id_expediente`, `fecha_registro`, `hora_registro`, `bitacora`, `motivo_atencion`, `signos_vitales`, `id_cita`, `id_paciente`) VALUES
(1, '2019-04-02', '00:00:10', 'Esta es una bitacora de prueba, aqui el doctor escribira todas las anotaciones que creea necesarias sobre la consulta, esto servida como un historial del paciente, el cual podra ser consultado en futuras citas', 'Le dolia ', '90 79ppm 16rpm 120/80pa', 1, 1),
(2, '2019-04-02', '00:00:10', 'Esta es una bitacora de prueba, aqui el doctor escribira todas las anotaciones que creea necesarias sobre la consulta, esto servida como un historial del paciente, el cual podra ser consultado en futuras citas', 'Le dolia 2', '90 79ppm 16rpm 120/80pa', 1, 1),
(15, '2019-04-07', '17:43:44', 'Esta es una bitÃ¡cora de prueba', 'Le dolÃ­a algo', '10 20 120 49', 2, 1),
(16, '2019-04-08', '03:46:27', 'El paciente llego sintiÃ©ndose muy mal, pero cuando se fue, todo cambio', 'Le dolÃ­a la pierna', '110 20 85', 6, 1),
(17, '2019-04-08', '03:52:39', '->', '->', '->', 3, 1),
(18, '2019-04-08', '03:53:11', '->', '->', '->', 5, 1),
(19, '2019-04-08', '03:55:17', '->', '->', '->', 4, 1),
(20, '2019-04-08', '04:28:47', '->', '->', '->', 12, 1),
(21, '2019-04-08', '09:50:20', '->', '->', '->', 11, 1),
(22, '2019-04-08', '09:51:37', '->', '->', '->', 13, 3),
(23, '2019-04-08', '10:23:22', '->', '->', '->', 17, 3),
(24, '2019-04-08', '11:54:02', '->', '->', '->', 15, 1),
(25, '2019-04-08', '11:54:08', '->', '->', '->', 16, 1),
(26, '2019-04-08', '12:11:53', '->Todo bien', '->saludar', '->ok', 18, 1),
(27, '2019-04-08', '12:44:32', '->', '->', '->', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospitalizacion`
--

CREATE TABLE `hospitalizacion` (
  `id_hospitalizacion` int(11) NOT NULL,
  `id_urgencia` int(11) NOT NULL,
  `id_cama` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date NOT NULL,
  `corta_estancia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hospitalizacion`
--

INSERT INTO `hospitalizacion` (`id_hospitalizacion`, `id_urgencia`, `id_cama`, `fecha_ingreso`, `fecha_egreso`, `corta_estancia`) VALUES
(17, 27, 4, '2019-04-09', '2019-04-14', 1),
(18, 28, 3, '2019-04-09', '2019-04-14', 1),
(19, 29, 3, '2019-04-09', '2019-04-14', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imageneologia`
--

CREATE TABLE `imageneologia` (
  `id_imageneologia` int(11) NOT NULL,
  `id_cita_estudio` int(11) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imageneologia`
--

INSERT INTO `imageneologia` (`id_imageneologia`, `id_cita_estudio`, `imagen`) VALUES
(5, 6, 'radioimg/2019-04-044.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interconsulta`
--

CREATE TABLE `interconsulta` (
  `id_interconsulta` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `interconsulta`
--

INSERT INTO `interconsulta` (`id_interconsulta`, `id_cita`, `id_paciente`) VALUES
(4, 1, 1),
(5, 2, 1),
(6, 13, 3),
(7, 11, 1),
(8, 22, 1),
(9, 15, 1),
(10, 18, 1),
(11, 28, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` int(11) NOT NULL,
  `id_cita_estudio` int(11) NOT NULL,
  `observaciones` varchar(250) NOT NULL,
  `resultados` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `id_cita_estudio`, `observaciones`, `resultados`) VALUES
(19, 5, ' id : 5', 'archivos/2019-04-021.pdf'),
(20, 33, ' id : 33', 'archivos/2019-04-08333.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `id_medicamento` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `almacen` int(11) NOT NULL,
  `via_administracion` varchar(30) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`id_medicamento`, `nombre`, `imagen`, `almacen`, `via_administracion`, `tipo`) VALUES
(3, 'Bismuto', 'images/Bismuto.jpg', 84, 'oral', 'jarabes'),
(4, 'Loperamida', 'images/Loperamida.jpg', 96, 'oral', 'pastillas'),
(5, 'Ãcido acetilsalicÃ­lico', 'images/300_300 (1).png', 100, 'oral', 'pastillas'),
(6, 'Buprenorfina', 'images/fondo.jpg', 100, 'intramuscular', 'jeringas'),
(7, 'Cetroreflix', 'images/cetrorelix-2.jpg', 30, 'subcutanea', 'jeringas'),
(8, 'Cinitrapida', 'images/descarga.jpg', 100, 'oral', 'capsulas'),
(9, 'Ibuprofeno', 'images/7503006569623_1.jpg', 11, 'oral', 'capsulas'),
(10, 'Ãcido MefenÃ¡mico', 'images/7501825302087_1.JPG', 3, 'oral', 'capsulas'),
(11, 'Allegra', 'images/allegra_susp-ean13_7501165006171-botella-y-caja.png', 5, 'oral', 'jarabes'),
(12, 'Espaven', 'images/75004996_1.jpg', 0, 'oral', 'jarabes'),
(13, 'Fosfocil', 'images/7501314701711_1.jpg', 5, 'intramuscular', 'jeringas'),
(14, 'Suero', 'images/suero-fisiovet-500-ml.jpg.png', 0, 'intravenosa', 'jeringas'),
(15, 'Norek', 'images/cetrorelix-2.jpg', 5, 'inhalatoria', 'capsulas'),
(16, 'Legalon', 'images/7501092760016_1.jpg', 4, 'oral', 'capsulas'),
(17, 'Nasalub', 'images/comprar-nasalub-solucion-caja-con-frasco-con-30-ml-humectante-nasal-precio-650240015366.jpg', 12, 'inhalatoria', 'jarabes'),
(19, 'Solutina', 'images/7501088617904_1.JPG', 6, 'transdermica', 'jarabes'),
(20, 'Tabcin Active', 'images/0750100848505L2.jpg', 12, 'oral', 'capsulas'),
(21, 'Tabcin Noche', 'images/7501008485033.jpg', 12, 'oral', 'capsulas'),
(22, 'Tabcin Dia', 'images/tabcin-dia-acetaminofen.jpg', 5, 'oral', 'capsulas'),
(23, 'Paracetamol', 'images/paracetamol.jpg', 200, 'oral', 'pastillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `id_medico` int(11) NOT NULL,
  `no_cedula` varchar(8) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`id_medico`, `no_cedula`, `id_especialidad`, `usuario_id`) VALUES
(1, '25625645', 4, 3),
(3, '24235345', 4, 15),
(5, '12345678', 9, 19),
(6, '12345678', 10, 20),
(7, '12345678', 3, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_evolucion`
--

CREATE TABLE `nota_evolucion` (
  `id_nota_evolucion` int(11) NOT NULL,
  `abuso_sustancia` varchar(250) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `pronostico` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota_evolucion`
--

INSERT INTO `nota_evolucion` (`id_nota_evolucion`, `abuso_sustancia`, `id_cita`, `pronostico`) VALUES
(28, 'SUSTANCIA0', 17, 'PRONOSTICO0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nss` varchar(11) NOT NULL,
  `tipo_sangre` varchar(3) NOT NULL,
  `alergias` varchar(500) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nss`, `tipo_sangre`, `alergias`, `usuario_id`) VALUES
(1, '56445656', 'A+', 'null', 2),
(3, '12345678956', 'B-', 'penisilina', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `iso` char(2) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `iso`, `nombre`) VALUES
(1, 'AF', 'Afganistán'),
(2, 'AX', 'Islas Gland'),
(3, 'AL', 'Albania'),
(4, 'DE', 'Alemania'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antártida'),
(9, 'AG', 'Antigua y Barbuda'),
(10, 'AN', 'Antillas Holandesas'),
(11, 'SA', 'Arabia Saudí'),
(12, 'DZ', 'Argelia'),
(13, 'AR', 'Argentina'),
(14, 'AM', 'Armenia'),
(15, 'AW', 'Aruba'),
(16, 'AU', 'Australia'),
(17, 'AT', 'Austria'),
(18, 'AZ', 'Azerbaiyán'),
(19, 'BS', 'Bahamas'),
(20, 'BH', 'Bahréin'),
(21, 'BD', 'Bangladesh'),
(22, 'BB', 'Barbados'),
(23, 'BY', 'Bielorrusia'),
(24, 'BE', 'Bélgica'),
(25, 'BZ', 'Belice'),
(26, 'BJ', 'Benin'),
(27, 'BM', 'Bermudas'),
(28, 'BT', 'Bhután'),
(29, 'BO', 'Bolivia'),
(30, 'BA', 'Bosnia y Herzegovina'),
(31, 'BW', 'Botsuana'),
(32, 'BV', 'Isla Bouvet'),
(33, 'BR', 'Brasil'),
(34, 'BN', 'Brunéi'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'CV', 'Cabo Verde'),
(39, 'KY', 'Islas Caimán'),
(40, 'KH', 'Camboya'),
(41, 'CM', 'Camerún'),
(42, 'CA', 'Canadá'),
(43, 'CF', 'República Centroafricana'),
(44, 'TD', 'Chad'),
(45, 'CZ', 'República Checa'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CY', 'Chipre'),
(49, 'CX', 'Isla de Navidad'),
(50, 'VA', 'Ciudad del Vaticano'),
(51, 'CC', 'Islas Cocos'),
(52, 'CO', 'Colombia'),
(53, 'KM', 'Comoras'),
(54, 'CD', 'República Democrática del Congo'),
(55, 'CG', 'Congo'),
(56, 'CK', 'Islas Cook'),
(57, 'KP', 'Corea del Norte'),
(58, 'KR', 'Corea del Sur'),
(59, 'CI', 'Costa de Marfil'),
(60, 'CR', 'Costa Rica'),
(61, 'HR', 'Croacia'),
(62, 'CU', 'Cuba'),
(63, 'DK', 'Dinamarca'),
(64, 'DM', 'Dominica'),
(65, 'DO', 'República Dominicana'),
(66, 'EC', 'Ecuador'),
(67, 'EG', 'Egipto'),
(68, 'SV', 'El Salvador'),
(69, 'AE', 'Emiratos Árabes Unidos'),
(70, 'ER', 'Eritrea'),
(71, 'SK', 'Eslovaquia'),
(72, 'SI', 'Eslovenia'),
(73, 'ES', 'España'),
(74, 'UM', 'Islas ultramarinas de Estados Unidos'),
(75, 'US', 'Estados Unidos'),
(76, 'EE', 'Estonia'),
(77, 'ET', 'Etiopía'),
(78, 'FO', 'Islas Feroe'),
(79, 'PH', 'Filipinas'),
(80, 'FI', 'Finlandia'),
(81, 'FJ', 'Fiyi'),
(82, 'FR', 'Francia'),
(83, 'GA', 'Gabón'),
(84, 'GM', 'Gambia'),
(85, 'GE', 'Georgia'),
(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur'),
(87, 'GH', 'Ghana'),
(88, 'GI', 'Gibraltar'),
(89, 'GD', 'Granada'),
(90, 'GR', 'Grecia'),
(91, 'GL', 'Groenlandia'),
(92, 'GP', 'Guadalupe'),
(93, 'GU', 'Guam'),
(94, 'GT', 'Guatemala'),
(95, 'GF', 'Guayana Francesa'),
(96, 'GN', 'Guinea'),
(97, 'GQ', 'Guinea Ecuatorial'),
(98, 'GW', 'Guinea-Bissau'),
(99, 'GY', 'Guyana'),
(100, 'HT', 'Haití'),
(101, 'HM', 'Islas Heard y McDonald'),
(102, 'HN', 'Honduras'),
(103, 'HK', 'Hong Kong'),
(104, 'HU', 'Hungría'),
(105, 'IN', 'India'),
(106, 'ID', 'Indonesia'),
(107, 'IR', 'Irán'),
(108, 'IQ', 'Iraq'),
(109, 'IE', 'Irlanda'),
(110, 'IS', 'Islandia'),
(111, 'IL', 'Israel'),
(112, 'IT', 'Italia'),
(113, 'JM', 'Jamaica'),
(114, 'JP', 'Japón'),
(115, 'JO', 'Jordania'),
(116, 'KZ', 'Kazajstán'),
(117, 'KE', 'Kenia'),
(118, 'KG', 'Kirguistán'),
(119, 'KI', 'Kiribati'),
(120, 'KW', 'Kuwait'),
(121, 'LA', 'Laos'),
(122, 'LS', 'Lesotho'),
(123, 'LV', 'Letonia'),
(124, 'LB', 'Líbano'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libia'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lituania'),
(129, 'LU', 'Luxemburgo'),
(130, 'MO', 'Macao'),
(131, 'MK', 'ARY Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MY', 'Malasia'),
(134, 'MW', 'Malawi'),
(135, 'MV', 'Maldivas'),
(136, 'ML', 'Malí'),
(137, 'MT', 'Malta'),
(138, 'FK', 'Islas Malvinas'),
(139, 'MP', 'Islas Marianas del Norte'),
(140, 'MA', 'Marruecos'),
(141, 'MH', 'Islas Marshall'),
(142, 'MQ', 'Martinica'),
(143, 'MU', 'Mauricio'),
(144, 'MR', 'Mauritania'),
(145, 'YT', 'Mayotte'),
(146, 'MX', 'México'),
(147, 'FM', 'Micronesia'),
(148, 'MD', 'Moldavia'),
(149, 'MC', 'Mónaco'),
(150, 'MN', 'Mongolia'),
(151, 'MS', 'Montserrat'),
(152, 'MZ', 'Mozambique'),
(153, 'MM', 'Myanmar'),
(154, 'NA', 'Namibia'),
(155, 'NR', 'Nauru'),
(156, 'NP', 'Nepal'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Níger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Isla Norfolk'),
(162, 'NO', 'Noruega'),
(163, 'NC', 'Nueva Caledonia'),
(164, 'NZ', 'Nueva Zelanda'),
(165, 'OM', 'Omán'),
(166, 'NL', 'Países Bajos'),
(167, 'PK', 'Pakistán'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestina'),
(170, 'PA', 'Panamá'),
(171, 'PG', 'Papúa Nueva Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Perú'),
(174, 'PN', 'Islas Pitcairn'),
(175, 'PF', 'Polinesia Francesa'),
(176, 'PL', 'Polonia'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'GB', 'Reino Unido'),
(181, 'RE', 'Reunión'),
(182, 'RW', 'Ruanda'),
(183, 'RO', 'Rumania'),
(184, 'RU', 'Rusia'),
(185, 'EH', 'Sahara Occidental'),
(186, 'SB', 'Islas Salomón'),
(187, 'WS', 'Samoa'),
(188, 'AS', 'Samoa Americana'),
(189, 'KN', 'San Cristóbal y Nevis'),
(190, 'SM', 'San Marino'),
(191, 'PM', 'San Pedro y Miquelón'),
(192, 'VC', 'San Vicente y las Granadinas'),
(193, 'SH', 'Santa Helena'),
(194, 'LC', 'Santa Lucía'),
(195, 'ST', 'Santo Tomé y Príncipe'),
(196, 'SN', 'Senegal'),
(197, 'CS', 'Serbia y Montenegro'),
(198, 'SC', 'Seychelles'),
(199, 'SL', 'Sierra Leona'),
(200, 'SG', 'Singapur'),
(201, 'SY', 'Siria'),
(202, 'SO', 'Somalia'),
(203, 'LK', 'Sri Lanka'),
(204, 'SZ', 'Suazilandia'),
(205, 'ZA', 'Sudáfrica'),
(206, 'SD', 'Sudán'),
(207, 'SE', 'Suecia'),
(208, 'CH', 'Suiza'),
(209, 'SR', 'Surinam'),
(210, 'SJ', 'Svalbard y Jan Mayen'),
(211, 'TH', 'Tailandia'),
(212, 'TW', 'Taiwán'),
(213, 'TZ', 'Tanzania'),
(214, 'TJ', 'Tayikistán'),
(215, 'IO', 'Territorio Británico del Océano Índico'),
(216, 'TF', 'Territorios Australes Franceses'),
(217, 'TL', 'Timor Oriental'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad y Tobago'),
(222, 'TN', 'Túnez'),
(223, 'TC', 'Islas Turcas y Caicos'),
(224, 'TM', 'Turkmenistán'),
(225, 'TR', 'Turquía'),
(226, 'TV', 'Tuvalu'),
(227, 'UA', 'Ucrania'),
(228, 'UG', 'Uganda'),
(229, 'UY', 'Uruguay'),
(230, 'UZ', 'Uzbekistán'),
(231, 'VU', 'Vanuatu'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Islas Vírgenes Británicas'),
(235, 'VI', 'Islas Vírgenes de los Estados Unidos'),
(236, 'WF', 'Wallis y Futuna'),
(237, 'YE', 'Yemen'),
(238, 'DJ', 'Yibuti'),
(239, 'ZM', 'Zambia'),
(240, 'ZW', 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `id_cita`, `estado`) VALUES
(22, 1, 1),
(27, 2, 1),
(28, 11, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_lista`
--

CREATE TABLE `receta_lista` (
  `id_receta_lista` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `id_medicamento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `entregada` int(11) NOT NULL,
  `dosis` int(11) NOT NULL,
  `dias` int(11) NOT NULL,
  `horas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta_lista`
--

INSERT INTO `receta_lista` (`id_receta_lista`, `id_receta`, `id_medicamento`, `cantidad`, `entregada`, `dosis`, `dias`, `horas`) VALUES
(26, 22, 3, 4, 4, 1, 1, 1),
(27, 22, 4, 1, 1, 1, 1, 1),
(38, 27, 3, 1, 1, 1, 1, 1),
(39, 28, 3, 1, 0, 1, 1, 1),
(40, 28, 4, 1, 0, 1, 1, 1),
(41, 28, 11, 1, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias_y_translados`
--

CREATE TABLE `referencias_y_translados` (
  `id_referencia` int(11) NOT NULL,
  `id_origen` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `descripcion_terapeutica` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `id_hospitalizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `nombre`) VALUES
(1, 'administrador'),
(2, 'paciente'),
(3, 'medico'),
(4, 'Expediente'),
(5, 'Farmacologo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urgencias`
--

CREATE TABLE `urgencias` (
  `id_urgencia` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `diagnostico` varchar(250) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `urgencias`
--

INSERT INTO `urgencias` (`id_urgencia`, `id_paciente`, `id_medico`, `diagnostico`, `fecha`) VALUES
(13, 1, 1, 'VÃ³mito', '2019-04-08'),
(14, 3, 1, 'Gastritis', '2019-04-08'),
(15, 1, 1, 'Todo correcto.', '2019-04-10'),
(16, 3, 5, 'Desmayo', '2019-04-08'),
(17, 1, 5, 'Se siente mal', '2019-04-08'),
(19, 1, 1, 'hola', '2019-04-08'),
(20, 3, 3, 'Desmayo', '2019-04-06'),
(21, 1, 6, 'internet lento.\r\nmmmmmm\r\n', '2019-04-08'),
(22, 1, 1, 'por problemas de internet', '2019-04-01'),
(24, 3, 7, 'Infarto', '2019-04-08'),
(25, 3, 3, 'hola danieÃ±', '2019-04-09'),
(26, 3, 6, 'muy enfermo\r\n', '2019-04-09'),
(27, 1, 1, 'CAMA 0', '2019-04-09'),
(28, 3, 5, 'mmmmm\r\npelon \r\npelon', '2019-04-09'),
(29, 1, 1, 'CAMA 00', '2019-04-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `municipio` varchar(60) NOT NULL,
  `estado` varchar(60) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `cel` varchar(20) DEFAULT NULL,
  `e-mail` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena`, `id_tipo`, `nombre`, `apellido`, `sexo`, `fecha_nacimiento`, `direccion`, `cp`, `municipio`, `estado`, `id_pais`, `tel`, `cel`, `e-mail`) VALUES
(1, 'admin', 'admin', 1, 'Administrador', '', '', '2019-01-01', '', '', '', '', 146, NULL, NULL, NULL),
(2, 'paciente1', 'secret', 2, 'Jose Felipe', 'Martinez Lopez', 'M', '1990-01-06', 'Calle 4 de Julio No. 120, Fracc. Pastores', '87000', 'Cd. Victoria', 'Tamaulipas', 146, '8343125608', '8341552921', 'felipe_85@gmail.com'),
(3, 'medico1', 'secret', 3, 'Sara Patricia', 'Torres Garza', 'M', '1990-01-06', 'Calle Benito Juarez No. 510, Fracc. Las Flores', '87070', 'Cd. Victoria', 'Tamaulipas', 146, '8343152893', '8120201718', 'sara_23@gmail.com'),
(6, 'paciente2', 'secret', 2, 'Daniel', 'De Leon', 'H', '2019-02-07', 'Calle Juanita de Jesus Col. Mainero', '87070', 'Cd. Victoria', 'Tamaulipas', 146, '8343060156', '8341552921', 'daniel12@gmail.com'),
(15, 'medico2', 'secret', 3, 'Jose Juan', 'Perez Rodriguez', 'H', '1998-08-26', 'Mi casa', '87000', 'Victoria', 'Tamaulipas', 9, '8321034941', '2353427', 'alejandroshdx@gmail.com'),
(17, 'expediente', 'secret', 4, 'Jose', 'Salinas', 'H', '1992-04-02', 'Calle Bajo Costa', '85000', 'Mante', 'Tamaulipas', 146, NULL, NULL, NULL),
(19, 'medico3', 'secret', 3, 'Mariana', 'Montes', 'M', '1982-03-07', 'Calle Juanita de Jesus Col. Mainero', '78000', 'Cd. Victoria', 'Tamaulipas', 146, NULL, NULL, NULL),
(20, 'medico4', 'secret', 3, 'Carlos', 'Pacheco', 'H', '1974-04-09', 'Calle Juanita de Jesus Col. Mainero', '87070', 'Cd. Victoria', 'Tamaulipas', 146, NULL, NULL, NULL),
(21, 'medico5', 'secret', 3, 'Eduardo', 'Flores', 'H', '1990-05-24', 'Calle Juanita de Jesus Col. Mainero', '87070', 'Cd. Victoria', 'Tamaulipas', 146, NULL, NULL, NULL),
(22, 'farmacologo', 'secret', 5, 'Luis Carlo', 'Solis', 'H', '1995-04-16', 'Calle Juanita de Jesus Col. Mainero', '87070', 'Cd. Victoria', 'Tamaulipas', 146, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area_hospital`
--
ALTER TABLE `area_hospital`
  ADD PRIMARY KEY (`id_area_hospital`);

--
-- Indices de la tabla `cama`
--
ALTER TABLE `cama`
  ADD PRIMARY KEY (`id_cama`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `cita_estudio`
--
ALTER TABLE `cita_estudio`
  ADD PRIMARY KEY (`id_cita_estudio`),
  ADD KEY `id_interconsulta` (`id_interconsulta`),
  ADD KEY `id_estudio` (`id_estudio`);

--
-- Indices de la tabla `datos_referencias`
--
ALTER TABLE `datos_referencias`
  ADD PRIMARY KEY (`id_dato`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id_especialidad`),
  ADD KEY `id_area` (`id_area`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`id_estudio`);

--
-- Indices de la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id_expediente`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `fk_id_cita` (`id_cita`);

--
-- Indices de la tabla `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  ADD PRIMARY KEY (`id_hospitalizacion`),
  ADD KEY `id_urgencia` (`id_urgencia`),
  ADD KEY `id_cama` (`id_cama`);

--
-- Indices de la tabla `imageneologia`
--
ALTER TABLE `imageneologia`
  ADD PRIMARY KEY (`id_imageneologia`),
  ADD KEY `id_cita_estudio` (`id_cita_estudio`);

--
-- Indices de la tabla `interconsulta`
--
ALTER TABLE `interconsulta`
  ADD PRIMARY KEY (`id_interconsulta`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`),
  ADD KEY `id_cita_estudio` (`id_cita_estudio`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`id_medicamento`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id_medico`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `nota_evolucion`
--
ALTER TABLE `nota_evolucion`
  ADD PRIMARY KEY (`id_nota_evolucion`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`),
  ADD KEY `usuario_id_2` (`usuario_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `receta_lista`
--
ALTER TABLE `receta_lista`
  ADD PRIMARY KEY (`id_receta_lista`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `id_medicamento` (`id_medicamento`);

--
-- Indices de la tabla `referencias_y_translados`
--
ALTER TABLE `referencias_y_translados`
  ADD PRIMARY KEY (`id_referencia`),
  ADD KEY `id_origen` (`id_origen`),
  ADD KEY `id_destino` (`id_destino`),
  ADD KEY `id_hospitalizacion` (`id_hospitalizacion`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `urgencias`
--
ALTER TABLE `urgencias`
  ADD PRIMARY KEY (`id_urgencia`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_id_tipo` (`id_tipo`),
  ADD KEY `fk_id_pais` (`id_pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area_hospital`
--
ALTER TABLE `area_hospital`
  MODIFY `id_area_hospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cama`
--
ALTER TABLE `cama`
  MODIFY `id_cama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `cita_estudio`
--
ALTER TABLE `cita_estudio`
  MODIFY `id_cita_estudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `datos_referencias`
--
ALTER TABLE `datos_referencias`
  MODIFY `id_dato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `id_estudio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'del 1-3 lab del 4-6 radio', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id_expediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  MODIFY `id_hospitalizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `imageneologia`
--
ALTER TABLE `imageneologia`
  MODIFY `id_imageneologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `interconsulta`
--
ALTER TABLE `interconsulta`
  MODIFY `id_interconsulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `id_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `nota_evolucion`
--
ALTER TABLE `nota_evolucion`
  MODIFY `id_nota_evolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `receta_lista`
--
ALTER TABLE `receta_lista`
  MODIFY `id_receta_lista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `referencias_y_translados`
--
ALTER TABLE `referencias_y_translados`
  MODIFY `id_referencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `urgencias`
--
ALTER TABLE `urgencias`
  MODIFY `id_urgencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_id_medico_cita` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_paciente_cita` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita_estudio`
--
ALTER TABLE `cita_estudio`
  ADD CONSTRAINT `cita_estudio_ibfk_1` FOREIGN KEY (`id_interconsulta`) REFERENCES `interconsulta` (`id_interconsulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_estudio_ibfk_2` FOREIGN KEY (`id_estudio`) REFERENCES `estudio` (`id_estudio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD CONSTRAINT `especialidad_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area_hospital` (`id_area_hospital`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expediente`
--
ALTER TABLE `expediente`
  ADD CONSTRAINT `expediente_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_cita` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`);

--
-- Filtros para la tabla `hospitalizacion`
--
ALTER TABLE `hospitalizacion`
  ADD CONSTRAINT `hospitalizacion_ibfk_1` FOREIGN KEY (`id_cama`) REFERENCES `cama` (`id_cama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hospitalizacion_ibfk_2` FOREIGN KEY (`id_urgencia`) REFERENCES `urgencias` (`id_urgencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imageneologia`
--
ALTER TABLE `imageneologia`
  ADD CONSTRAINT `imageneologia_ibfk_1` FOREIGN KEY (`id_cita_estudio`) REFERENCES `cita_estudio` (`id_cita_estudio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `interconsulta`
--
ALTER TABLE `interconsulta`
  ADD CONSTRAINT `interconsulta_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD CONSTRAINT `laboratorio_ibfk_1` FOREIGN KEY (`id_cita_estudio`) REFERENCES `cita_estudio` (`id_cita_estudio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id_especialidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota_evolucion`
--
ALTER TABLE `nota_evolucion`
  ADD CONSTRAINT `fk_id_hospitalizacion_evolucion` FOREIGN KEY (`id_cita`) REFERENCES `hospitalizacion` (`id_hospitalizacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receta_lista`
--
ALTER TABLE `receta_lista`
  ADD CONSTRAINT `receta_lista_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `receta_lista_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamento` (`id_medicamento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `referencias_y_translados`
--
ALTER TABLE `referencias_y_translados`
  ADD CONSTRAINT `fk_id_destino` FOREIGN KEY (`id_destino`) REFERENCES `datos_referencias` (`id_dato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_hospitalizacion` FOREIGN KEY (`id_hospitalizacion`) REFERENCES `hospitalizacion` (`id_hospitalizacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_origen` FOREIGN KEY (`id_origen`) REFERENCES `datos_referencias` (`id_dato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `urgencias`
--
ALTER TABLE `urgencias`
  ADD CONSTRAINT `urgencias_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `urgencias_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_pais` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuario` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
