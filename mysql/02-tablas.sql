SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

DROP TABLE IF EXISTS `peliculas`;

CREATE TABLE `peliculas` (
  `idpelicula` int(11) NOT NULL,
  `titulo` varchar(254) NOT NULL,
  `director` varchar(254) NOT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `imagen` longblob NOT NULL,
  `categoria` varchar(254) NOT NULL,
   PRIMARY KEY (`idpelicula`),
   UNIQUE KEY `titulo` (`titulo`),
   KEY `categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `peliculas`
  MODIFY `idpelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;


DROP TABLE IF EXISTS `puntuaciones`;

CREATE TABLE `puntuaciones` (
  `idpelicula` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `puntuacion` int(1) NOT NULL,
  KEY `idusuario` (`idusuario`),
  PRIMARY KEY (`idpelicula`,`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;