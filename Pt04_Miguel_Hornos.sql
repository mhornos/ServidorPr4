-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS `pt04_miguel_hornos` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_miguel_hornos`;

-- Creación de la tabla usuaris
CREATE TABLE `usuaris` (
    `ID` int(11) NOT NULL AUTO_INCREMENT, -- Clave primaria
    `nombreUsuario` varchar(50) NOT NULL, -- Nombre de usuario
    `contrasenya` varchar(255) NOT NULL, -- Contraseña
    `correo` varchar(100) NOT NULL, -- Correo
    PRIMARY KEY (`ID`), -- Clave primaria en el campo ID
    UNIQUE (`nombreUsuario`), -- El nombre de usuario debe ser único
    UNIQUE (`correo`) -- Aseguramos que no haya correos duplicados
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Creación de la tabla article
CREATE TABLE `article` (
  `ID` int(11) NOT NULL AUTO_INCREMENT, -- Clave primaria
  `titol` varchar(255) NOT NULL, -- Título del artículo
  `cos` text NOT NULL, -- Cuerpo del artículo
  `correoUsuario` varchar(100) DEFAULT NULL, -- Columna para el correo del usuario que escribió el artículo
  PRIMARY KEY (`ID`), -- Clave primaria en el campo ID
  CONSTRAINT `fk_correoUsuario` FOREIGN KEY (`correoUsuario`) REFERENCES `usuaris` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE -- Relación entre article y usuaris
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla article
INSERT INTO `article` (`ID`, `titol`, `cos`, `correoUsuario`) VALUES
(46, 'fojjeb fojsdof iasd oug aos goafsd g', 'asodjbgoijs bojdfob do bd', NULL),
(47, 'ASDF', 'ASF', NULL),
(48, 'ASF', 'ASF', NULL),
(49, 'ASF', 'ASF', NULL),
(50, 'ASF', 'ASF', NULL),
(51, 'ASF', 'ASF', NULL),
(52, 'ASF', 'ASF', NULL),
(53, 'wadefrgdtsearwfe', 'asdfgsafwsdnd', NULL),
(54, '1', '1', NULL),
(55, '1', '1', NULL),
(56, '1', '1', NULL),
(57, 'Hola', 'Adios', NULL);

-- Ajustes de AUTO_INCREMENT para las tablas
ALTER TABLE `article`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

ALTER TABLE `usuaris`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

-- Confirmar transacción
COMMIT;
