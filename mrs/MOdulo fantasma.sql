CREATE TABLE `profesor` (
  `rut_profesor` integer PRIMARY KEY,
  `nombre_profesor` varchar(255) NOT NULL,
  `facultad` facultad NOT NULL,
  `cargo_institucional` c_inst NOT NULL
);

CREATE TABLE `alumno` (
  `rut_alumno` integer PRIMARY KEY,
  `nombre_alumno` varchar(255) NOT NULL,
  `facultad` facultad NOT NULL,
  `carrera` carrera NOT NULL
);

CREATE TABLE `notas_hab` (
  `rut_alumno` integer PRIMARY KEY,
  `nota` float
);
