
CREATE TABLE nomina_alumnos_externos (
    rut_alumno varchar(10) PRIMARY KEY,
    nombre_alumno varchar(50) NOT NULL,
    facultad varchar(100) NOT NULL,
    carrera varchar(100) NOT NULL
);

CREATE TABLE nomina_profesores_externos (
    rut_profesor varchar(10) PRIMARY KEY,
    nombre_profesor varchar(50) NOT NULL,
    facultad varchar(100) NOT NULL,
    cargo_institucional varchar(50) NOT NULL,
    es_dinf boolean DEFAULT false
);

CREATE TABLE notas_finales_externas (
    id_nota serial PRIMARY KEY,
    rut_alumno varchar(10) NOT NULL,
    nota_final numeric(2,1),
    asignatura varchar(50) NOT NULL
);

INSERT INTO nomina_alumnos_externos (rut_alumno, nombre_alumno, facultad, carrera) VALUES
('213069322', 'Jorge Rubilar', 'Ingeniería', 'Ingeniería Civil Informática'),
('111111111', 'Ana Torres', 'Ingeniería', 'Ingeniería Civil Informática'),
('222222222', 'Carlos Vera', 'Ingeniería', 'Ingeniería Civil Informática'),
('333333333', 'Sofia Reyes', 'Medicina', 'Medicina'); -- Alumna que no es de la carrera

-- Insertar Profesores
INSERT INTO nomina_profesores_externos (rut_profesor, nombre_profesor, facultad, cargo_institucional, es_dinf) VALUES
('12345678K', 'Profesor Guía Ejemplo', 'Ingeniería', 'Planta', true),
('987654321', 'Profesor Comisión Ejemplo', 'Ingeniería', 'Planta', true),
('555555555', 'Profesor Externo', 'Humanidades', 'Visitante', false); -- Profesor que no es del DINF

-- Insertar Notas
INSERT INTO notas_finales_externas (rut_alumno, nota_final, asignatura) VALUES
('213069322', 5.5, 'Habilitación Profesional'),
('111111111', 6.0, 'Habilitación Profesional'),
('222222222', 4.0, 'Cálculo 1'); -- Nota de otra asignatura