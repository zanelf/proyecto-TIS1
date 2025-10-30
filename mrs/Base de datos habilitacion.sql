CREATE TABLE `alumno` (
  `rut_alumno` integer PRIMARY KEY,
  `nombre_alumno` varchar(255) NOT NULL
);

CREATE TABLE `profesor` (
  `rut_profesor` integer PRIMARY KEY,
  `nombre_profesor` varchar(255) NOT NULL,
  `Tipo_Profesor` t_prof NOT NULL,
  `Dinf` bool NOT NULL
);

CREATE TABLE `Habilitacion` (
  `id_habilitacion` varchar(255) PRIMARY KEY,
  `rut_profesor` integer NOT NULL,
  `rut_alumno` integer NOT NULL,
  `semestre_inicio` S_I NOT NULL,
  `Nota` float,
  `Fecha_modificacion_nota` date,
  `Fecha_nota` date,
  `T_habilitacion` T_proy NOT NULL
);

CREATE TABLE `P_H` (
  `id_proyecto` varchar(255),
  `rut_profesor` integer,
  `Tipo_profesor` t_prof NOT NULL,
  PRIMARY KEY (`id_proyecto`, `rut_profesor`)
);

CREATE TABLE `admin` (
  `ID` integer PRIMARY KEY,
  `password` varchar(255) NOT NULL
);

ALTER TABLE `Habilitacion` ADD CONSTRAINT `P_alumno` FOREIGN KEY (`rut_alumno`) REFERENCES `alumno` (`rut_alumno`);

ALTER TABLE `P_H` ADD CONSTRAINT `P_profesor` FOREIGN KEY (`id_proyecto`) REFERENCES `Habilitacion` (`id_habilitacion`);

ALTER TABLE `P_H` ADD CONSTRAINT `P_vinculo` FOREIGN KEY (`rut_profesor`) REFERENCES `profesor` (`rut_profesor`);
