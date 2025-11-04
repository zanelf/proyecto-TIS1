
CREATE DOMAIN rut AS varchar(9)
  CHECK (VALUE ~ '^[0-9]{7,8}[0-9Kk]$');

CREATE DOMAIN nombre50 AS varchar(50)
  CHECK (char_length(VALUE) BETWEEN 5 AND 50);


CREATE DOMAIN s_i AS varchar(6)
  CHECK (VALUE ~ '^[0-9]{4}-(1|2)$');


CREATE DOMAIN nota7 AS numeric(3,1)
  CHECK (VALUE BETWEEN 1.0 AND 7.0);


CREATE DOMAIN t_prof AS varchar(8)
  CHECK (upper(VALUE) IN ('GUIA','COMISION'));

CREATE DOMAIN passhash AS varchar(255)
  CHECK (char_length(VALUE) >= 20);


CREATE TABLE alumno (
  rut_alumno rut PRIMARY KEY,
  nombre_alumno nombre50 NOT NULL
);

CREATE TABLE profesor (
  rut_profesor rut PRIMARY KEY,
  nombre_profesor nombre50 NOT NULL,
  dinf boolean NOT NULL DEFAULT false
);

CREATE TABLE habilitacion (
  id_habilitacion varchar(36) PRIMARY KEY,
  rut_alumno rut NOT NULL,
  semestre_inicio s_i NOT NULL,
  descripcion text NOT NULL,
  nota nota7,
  fecha_nota date,
  CONSTRAINT fk_hab_alumno
    FOREIGN KEY (rut_alumno)
    REFERENCES alumno(rut_alumno)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
);

CREATE TABLE h_p (
  id_habilitacion varchar(36) NOT NULL,
  rut_profesor rut NOT NULL,
  tipo_profesor t_prof NOT NULL,
  PRIMARY KEY (id_habilitacion, rut_profesor),
  CONSTRAINT fk_hp_hab
    FOREIGN KEY (id_habilitacion)
    REFERENCES habilitacion(id_habilitacion)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT fk_hp_prof
    FOREIGN KEY (rut_profesor)
    REFERENCES profesor(rut_profesor)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
);

CREATE TABLE admin (
  rut_admin rut PRIMARY KEY,
  password passhash NOT NULL
);


CREATE TABLE prtut (
  id_habilitacion varchar(36) PRIMARY KEY,
  empresa varchar(100) NOT NULL,
  supervisor varchar(100) NOT NULL,
  CONSTRAINT fk_prtut_hab
    FOREIGN KEY (id_habilitacion)
    REFERENCES habilitacion(id_habilitacion)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE prinv (
  id_habilitacion varchar(36) PRIMARY KEY,
  titulo_investigacion varchar(150) NOT NULL,
  CONSTRAINT fk_prinv_hab
    FOREIGN KEY (id_habilitacion)
    REFERENCES habilitacion(id_habilitacion)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE pring (
  id_habilitacion varchar(36) PRIMARY KEY,
  nombre_proyecto varchar(150) NOT NULL,
  CONSTRAINT fk_pring_hab
    FOREIGN KEY (id_habilitacion)
    REFERENCES habilitacion(id_habilitacion)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);


CREATE INDEX ix_hab_rut_alumno ON habilitacion (rut_alumno);
CREATE INDEX ix_hp_tipo ON h_p (tipo_profesor);
