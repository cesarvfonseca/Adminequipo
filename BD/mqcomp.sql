-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2017 a las 17:23:41
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mqcomp`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `comp_resp`()
BEGIN
SELECT e.cod_equipo,CONCAT(r.nombre,' ',r.apellido) as nombre,r.puesto,r.sucursal,r.planta_depto,e.marca,e.modelo,e.numero_serie,e.numero_producto,e.numero_factura,e.status,e.comentarios
FROM equipos as e
INNER JOIN responsables as r
WHERE e.RESPONSABLES_cod_resp=r.cod_resp;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEquipo`(e_codigo varchar(3),e_tipo varchar(15),e_marca varchar(25),e_modelo varchar(25),e_nserie varchar(25),e_nproducto varchar(25),e_nfactura varchar(35),
e_ffactura varchar(45),e_dduro varchar(10),e_ram varchar(10),e_os varchar(10),e_comentarios varchar(65),e_status varchar(1),e_responsable varchar(3))
BEGIN
INSERT INTO equipos
(cod_equipo, tipo, marca, modelo, numero_serie, numero_producto, numero_factura, 
fecha_factura, disco_duro, ram, sistema_operativo, comentarios, status, RESPONSABLES_cod_resp) 
VALUES (e_codigo,e_tipo,e_marca,e_modelo,e_serie,e_nproducto,e_nfactura,e_ffactura,e_dduro,e_ram,e_os,e_comentarios,e_status,e_responsable);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEquipo_responsable`(r_codigo varchar(3),r_nombre varchar(45),r_apellido varchar(45),r_puesto varchar(45),r_sucursal varchar(45),r_depto varchar(45),r_correo varchar(45), r_fecha date,
e_codigo varchar(3),e_tipo varchar(15),e_marca varchar(25),e_modelo varchar(25),e_nserie varchar(25),e_nproducto varchar(25),e_nfactura varchar(35),
e_ffactura varchar(45),e_proveedor varchar(25),e_procesador varchar(65),e_dduro varchar(10),e_ram varchar(10),e_os varchar(10),e_comentarios varchar(65),
e_status varchar(1),e_responsable varchar(3))
BEGIN
INSERT INTO responsables
(cod_resp, nombre,apellido, puesto, sucursal, planta_depto, correo, fecha) 
VALUES (r_codigo,r_nombre,r_apellido,r_puesto,r_sucursal,r_depto,r_correo,r_fecha);

INSERT IGNORE INTO equipos
(cod_equipo, tipo, marca, modelo, numero_serie, numero_producto, numero_factura, 
fecha_factura, proveedor, procesador, disco_duro, ram, sistema_operativo, comentarios, status, RESPONSABLES_cod_resp) 
VALUES (e_codigo,e_tipo,e_marca,e_modelo,e_nserie,e_nproducto,
e_nfactura,e_ffactura,e_proveedor,e_procesador,e_dduro,e_ram,e_os,e_comentarios,e_status,e_responsable);

commit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarResponsable`(r_codigo varchar(3),r_nombre varchar(45),r_apellido varchar(45),r_puesto varchar(45),r_sucursal varchar(45),r_depto varchar(45),r_correo varchar(45), r_fecha date)
BEGIN
INSERT INTO responsables
(cod_resp, nombre,apellido, puesto, sucursal, planta_depto, correo, fecha) 
VALUES (r_codigo,r_nombre,r_apellido,r_puesto,r_sucursal,r_depto,r_correo,r_fecha);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `maximoResponsablesequipos`(eTipo varchar(2))
BEGIN
SELECT MAX(substr(r.cod_resp,3,1)) AS idRESPONSABLE,
MAX(substr(e.cod_equipo,3,1)) AS idEQUIPO
FROM equipos as e
INNER JOIN responsables r
WHERE e.cod_equipo LIKE CONCAT(eTipo,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ultimoidEquipos`(eTipo varchar(2))
BEGIN
SELECT MAX(substr(cod_equipo,3,1)) AS id FROM equipos WHERE cod_equipo LIKE CONCAT(eTipo,'%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ultimoidResponsable`()
BEGIN
SELECT MAX(substr(cod_resp,3,1)) AS id FROM responsables;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `cod_usuario` varchar(10) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido` varchar(35) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `contra` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `cod_equipo` varchar(5) NOT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `marca` varchar(25) DEFAULT NULL,
  `modelo` varchar(25) DEFAULT NULL,
  `numero_serie` varchar(25) DEFAULT NULL,
  `numero_producto` varchar(25) DEFAULT NULL,
  `numero_factura` varchar(35) DEFAULT NULL,
  `fecha_factura` date DEFAULT NULL,
  `proveedor` varchar(45) NOT NULL DEFAULT 'N/A',
  `procesador` varchar(20) NOT NULL,
  `disco_duro` varchar(5) DEFAULT NULL,
  `ram` varchar(5) DEFAULT NULL,
  `sistema_operativo` varchar(10) DEFAULT NULL,
  `comentarios` varchar(65) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `RESPONSABLES_cod_resp` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`cod_equipo`, `tipo`, `marca`, `modelo`, `numero_serie`, `numero_producto`, `numero_factura`, `fecha_factura`, `proveedor`, `procesador`, `disco_duro`, `ram`, `sistema_operativo`, `comentarios`, `status`, `RESPONSABLES_cod_resp`) VALUES
('MQ1', 'LAP', 'HP', 'DEV', 'ASD23ED4', '1233W', 'A75823', '2016-01-01', '', '', '500GB', '2GB', 'WIN10', 'N/A', 'A', 'CV1'),
('MQ2', 'LAP', 'HP', 'DEVELOPER', 'ERERT', 'RTRTRT', 'A78823', '2016-01-01', '', '', '1TB', '8GB', 'WIN10', 'N/A', 'A', 'GH2'),
('MQ4', 'MQ', 'DELL', 'ALLIEN-WARE', 'RYUK8556', 'QWERT856', 'DN852369', '1992-01-11', '', '', '500GB', '4GB', 'w10', 'Nuevo', 'A', 'LY6'),
('MQ5', 'MQ', 'DELL', 'DEV', 'AFTERMATH', 'BERZERK', 'MMLP2', '2017-06-05', '', '', '320GB', '6GB', 'wXP', 'It''s me bitch', 'A', 'MM9'),
('MQ6', 'MQ', 'HP', 'AIR', '5CG85D6', 'QWERTY', 'AGS0001', '2015-07-04', '', '', '120GB', '8GB', 'w10', 'Ais', 'A', 'LP1'),
('MQ7', 'MQ', 'ACER', 'ASPIRE E15', 'NXGE6AL01971204F127600', 'NX.GE7AL.001', '5362006963', '2017-06-30', '', '', '1TB', '8GB', 'w10', '15.6"', 'A', 'VS1'),
('PC1', 'PC', 'HP', 'VISION', 'HL5283', 'LH89654', 'A78883', '2016-01-01', '', '', '1TB', '8GB', 'WIN7', 'N/A', 'A', 'HL3'),
('PC2', 'PC', 'HP', '280 G2', '4CE6420ZLK', 'W5Y88LT#ABM', 'PA001852', '2017-04-25', 'Office Depot', 'CORE I3-361001', '500GB', '4GB', 'w7', '', 'A', 'DE1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE IF NOT EXISTS `mantenimientos` (
  `cod_mantenimiento` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `comentario` varchar(65) DEFAULT NULL,
  `ADMINISTRADORES_cod_usuario` varchar(10) NOT NULL,
  `EQUIPOS_cod_equipo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables`
--

CREATE TABLE IF NOT EXISTS `responsables` (
  `cod_resp` varchar(10) NOT NULL,
  `nombre` varchar(35) DEFAULT NULL,
  `apellido` varchar(35) DEFAULT NULL,
  `puesto` varchar(25) DEFAULT NULL,
  `sucursal` varchar(25) DEFAULT NULL,
  `planta_depto` varchar(25) DEFAULT NULL,
  `correo` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `responsables`
--

INSERT INTO `responsables` (`cod_resp`, `nombre`, `apellido`, `puesto`, `sucursal`, `planta_depto`, `correo`, `fecha`) VALUES
('CA8', 'Carlos', 'Avalos', 'Operaciones', 'Aguascalientes', 'Exedy', 'cavalos@mexq.com.mx', '2017-02-17'),
('CV1', 'Cesar', 'Valenciano', 'Coordinador de sistemas', 'Corporativo', 'Sistemas', 'cvalenciano@mexq.com.mx', '2016-01-01'),
('DE1', 'Dennise', 'Estrada', 'Finanzas', 'Corporativo', 'Finanzas', 'destrada@mexq.com.mx', '2017-07-08'),
('GH2', 'Gabriela', 'Hernandez', 'Auxiliar de ventas', 'Corporativo', 'Ventas', 'ghernandez@mexq.com.mx', '2016-01-01'),
('HL3', 'Hitomi', 'Laine', 'Auxiliar de sistemas', 'Corporativo', 'Sistemas', 'hitomi.laine@mexq.com.mx', '2016-11-23'),
('LP1', 'Luis Antonio', 'Peña Morales', 'Piloto', 'Son', 'Volaris', 'lamorales@volaris.com', '2017-07-04'),
('LP4', 'Luis Antonio', 'Peña Morales', 'Piloto', 'Sinaloa', 'Transporte', 'lmorales@volaris.com', '2016-12-05'),
('LY6', 'Light', 'Yagami', 'Jefe Logistica', 'Japon', 'Death Note', 'lyagami@dn.com', '2016-12-05'),
('MA7', 'Misa', 'Amane', 'Actriz', 'Japon', 'Hushen', 'mamane@dn.com.mx', '2016-12-05'),
('MM9', 'Marshall', 'Mathers', 'Jefe', 'Usa', 'Detroit', 'mmathers@eminem.com', '2017-07-04'),
('TT1', 'Test', 'Test', 'Test', 'Testtest', 'Test', 'test@test.com', '2017-07-04'),
('VS1', 'Viridiana Berenice', 'Sierra Espinosa', 'Coordinadora', 'San Luis Potosi', 'Coordinacion', 'vsierra@mexq.com.mx', '2017-07-07'),
('YG5', 'Yuno', 'Gasai', 'Loca', 'Japon', 'Mirai Nikki', 'yuno@correo.com', '2016-12-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
 ADD PRIMARY KEY (`cod_usuario`), ADD UNIQUE KEY `usuario` (`usuario`), ADD UNIQUE KEY `cod_usuario_UNIQUE` (`cod_usuario`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
 ADD PRIMARY KEY (`cod_equipo`), ADD KEY `fk_EQUIPOS_RESPONSABLES_idx` (`RESPONSABLES_cod_resp`);

--
-- Indices de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
 ADD PRIMARY KEY (`cod_mantenimiento`), ADD KEY `fk_MANTENIMIENTOS_ADMINISTRADORES1_idx` (`ADMINISTRADORES_cod_usuario`), ADD KEY `fk_MANTENIMIENTOS_EQUIPOS1_idx` (`EQUIPOS_cod_equipo`);

--
-- Indices de la tabla `responsables`
--
ALTER TABLE `responsables`
 ADD PRIMARY KEY (`cod_resp`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
ADD CONSTRAINT `fk_EQUIPOS_RESPONSABLES` FOREIGN KEY (`RESPONSABLES_cod_resp`) REFERENCES `responsables` (`cod_resp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
ADD CONSTRAINT `fk_MANTENIMIENTOS_ADMINISTRADORES1` FOREIGN KEY (`ADMINISTRADORES_cod_usuario`) REFERENCES `administradores` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_MANTENIMIENTOS_EQUIPOS1` FOREIGN KEY (`EQUIPOS_cod_equipo`) REFERENCES `equipos` (`cod_equipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
