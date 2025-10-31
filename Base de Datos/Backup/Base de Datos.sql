CREATE DOMAIN T_prof AS varchar(10)
CHECK (VALUE IN ('Guia', 'Co-Guia', 'Comision', 'Tutor'));

CREATE DOMAIN S_I AS varchar(6)
CHECK (VALUE ~ '^\d{4}-\d{1}$');

CREATE DOMAIN T_hab AS varchar(5)
CHECK (VALUE IN ('PrIng', 'PrInv', 'PrTut'));

CREATE TABLE alumno (
rut_alumno varchar(10) PRIMARY KEY,
nombre_alumno varchar(50) NOT NULL
);

CREATE TABLE profesor (
rut_profesor varchar(10) PRIMARY KEY,
nombre_profesor varchar(50) NOT NULL,
Dinf bool NOT NULL DEFAULT false
);

CREATE TABLE Habilitacion (
id_habilitacion serial PRIMARY KEY,
rut_alumno varchar(10) NOT NULL,
semestre_inicio S_I NOT NULL,
Nota numeric(2,1),
Fecha_registro_nota date,
Nombre_empresa varchar(40),
Nombre_Supervisor_Empresa varchar(30),
T_habilitacion T_hab NOT NULL,
CONSTRAINT FK_Habilitacion_Alumno
FOREIGN KEY (rut_alumno) REFERENCES alumno (rut_alumno)
);

CREATE TABLE P_H (
id_habilitacion integer NOT NULL,
rut_profesor varchar(10) NOT NULL,
Tipo_profesor T_prof NOT NULL,
PRIMARY KEY (id_habilitacion, rut_profesor, Tipo_profesor),
CONSTRAINT FK_PH_Habilitacion
FOREIGN KEY (id_habilitacion) REFERENCES Habilitacion (id_habilitacion)
ON DELETE CASCADE,
CONSTRAINT FK_PH_Profesor
FOREIGN KEY (rut_profesor) REFERENCES profesor (rut_profesor)
);

CREATE TABLE admin (
ID serial PRIMARY KEY,
rut_admin varchar(10) NOT NULL UNIQUE,
password varchar(255) NOT NULL
);