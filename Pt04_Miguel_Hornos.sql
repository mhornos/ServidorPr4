-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS `pt04_miguel_hornos` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_miguel_hornos`;

-- Creación de la tabla usuaris
CREATE TABLE `usuaris` (
    `ID` int(11) NOT NULL AUTO_INCREMENT, -- Clave primaria
    `nombreUsuario` varchar(50) NOT NULL, -- Nombre de usuario
    `contrasenya` varchar(255) NOT NULL, -- Contraseña
    `correo` varchar(100) NOT NULL, -- Correo
    `ciutat` varchar(100) NOT NULL, -- Nueva columna: Ciudad
    PRIMARY KEY (`ID`), -- Clave primaria en el campo ID
    UNIQUE (`nombreUsuario`), -- El nombre de usuario debe ser único
    UNIQUE (`correo`) -- Aseguramos que no haya correos duplicados
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserción de datos en la tabla usuaris (asegúrate de tener usuarios para evitar errores)
INSERT INTO `usuaris` (`nombreUsuario`, `contrasenya`, `correo`, `ciutat`) VALUES
('usuario1', 'contrasena1', 'correo1@example.com', 'Barcelona'),
('usuario2', 'contrasena2', 'correo2@example.com', 'Madrid');

-- Creación de la tabla article
CREATE TABLE `article` (
  `ID` int(11) NOT NULL AUTO_INCREMENT, -- Clave primaria
  `marca` varchar(100) NOT NULL, -- Nueva columna: Marca
  `model` varchar(100) NOT NULL, -- Nueva columna: Modelo
  `color` varchar(50) NOT NULL, -- Nueva columna: Color
  `matricula` varchar(20) NOT NULL, -- Nueva columna: Matrícula
  `nom_usuari` varchar(50) DEFAULT NULL, -- Columna para el nombre de usuario que escribió el artículo
  PRIMARY KEY (`ID`), -- Clave primaria en el campo ID
  CONSTRAINT `fk_nomUsuari` FOREIGN KEY (`nom_usuari`) REFERENCES `usuaris` (`nombreUsuario`) ON DELETE CASCADE ON UPDATE CASCADE -- Relación entre article y usuaris
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserción de datos en la tabla article
INSERT INTO `article` (`marca`, `model`, `color`, `matricula`, `nom_usuari`) VALUES
('Toyota', 'Corolla', 'Rojo', '1234ABC', 'usuario1'),
('Ford', 'Fiesta', 'Azul', '5678DEF', 'usuario1'),
('Honda', 'Civic', 'Verde', '9101GHI', 'usuario2');

-- Ajustes de AUTO_INCREMENT para las tablas
ALTER TABLE `article`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `usuaris`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

-- Confirmar transacción
COMMIT;
