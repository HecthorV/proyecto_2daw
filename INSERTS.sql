INSERT INTO evento (nombre, fecha_inicio, fecha_fin) VALUES
                                                         ('Conferencia de Tecnología', '2024-06-15', '2024-06-17'),
                                                         ('Feria de Emprendedores', '2024-07-01', NULL),
                                                         ('Seminario de Marketing', '2024-05-20', '2024-05-21'),
                                                         ('Taller de Programación', '2024-08-10', '2024-08-12'),
                                                         ('Exposición de Arte', '2024-09-05', '2024-09-07'),
                                                         ('Concierto de Verano', '2024-06-22', '2024-06-22'),
                                                         ('Hackathon', '2024-07-18', '2024-07-20'),
                                                         ('Congreso de Ciencias', '2024-10-14', '2024-10-16'),
                                                         ('Jornada de Salud', '2024-11-10', '2024-11-11'),
                                                         ('Festival de Cine', '2024-12-01', '2024-12-05');

INSERT INTO ponente (nombre, cargo, url)
VALUES
    ('Ana López', 'Directora', 'analopezdirectora.jpg'),
    ('Carlos Pérez', 'Jefe de Estudios', 'carlosperezjefedeestudios.jpg'),
    ('María Gómez', 'Coordinadora de Actividades', 'mariagomezcoordinadoradeactividades.jpg'),
    ('Juan Martínez', 'Profesor de Matemáticas', 'juanmartinezprofesordematematicas.jpg'),
    ('Lucía Fernández', 'Secretaria', 'luciafernandezsecretaria.jpg');


-- RECURSO
INSERT INTO recurso (nombre) VALUES
                                 ('Altavoces'),
                                 ('Balón de fútbol'),
                                 ('Proyector'),
                                 ('Sillas plegables'),
                                 ('Mesas'),
                                 ('Conos de entrenamiento'),
                                 ('Red de voleibol'),
                                 ('Equipo de sonido'),
                                 ('Micrófono inalámbrico'),
                                 ('Tablero de baloncesto');


-- EDIFICIO
INSERT INTO edificio (nombre) VALUES
                                  ('Edificio Principal'),
                                  ('Edificio de Ciencias'),
                                  ('Edificio de Humanidades'),
                                  ('Edificio de Deportes'),
                                  ('Edificio de Administración'),
                                  ('Edificio de Informática'),
                                  ('Edificio de Biblioteca'),
                                  ('Edificio de Música'),
                                  ('Edificio de Arte'),
                                  ('Edificio de Laboratorios');

-- ESPACIO
INSERT INTO espacio (nombre, aforo, edificio_id) VALUES
                                                     ('Aula 101', 30, 1),
                                                     ('Aula 102', 25, 1),
                                                     ('Laboratorio de Química', 20, 2),
                                                     ('Laboratorio de Física', 15, 2),
                                                     ('Sala de Conferencias', 100, 3),
                                                     ('Gimnasio', 50, 4),
                                                     ('Sala de Reuniones', 10, 5),
                                                     ('Sala de Computación', 40, 6),
                                                     ('Biblioteca Principal', 60, 7),
                                                     ('Aula de Música', 20, 8);

-- ESPACIO_RECURSO
INSERT INTO espacio_recurso (espacio_id, recurso_id) VALUES
                                                         (1,1),
                                                         (1,2),
                                                         (1,5),

                                                         (2,1),
                                                         (2,5),

                                                         (5,3),
                                                         (5,8),
                                                         (5,9),

                                                         (6,2),
                                                         (6,6),
                                                         (6,7),
                                                         (6,9),
                                                         (6,10)
;


INSERT INTO nivel_educativo (siglas, descripcion) VALUES
                                                  ("DAW", "Desarrollo de Aplicaciones Web"),
                                                  ("DAM", "Desarrollo de Aplicaciones Multiplataforma"),
                                                  ("ASIR", "Administración de Sistemas Informáticos en Red");

INSERT INTO grupo (nombre, curso, letra, nivel_educativo_id) VALUES
                                                                 ("DAW", 1, "A", 1),
                                                                 ("DAW", 1, "B", 1),
                                                                 ("DAM", 2, "A", 2),
                                                                 ("DAM", 2, "B", 2),
                                                                 ("ASIR", 3, "A", 3),
                                                                 ("ASIR", 3, "B", 3);



SELECT
    a.id AS actividad_id,
    a.nombre AS actividad_nombre,
    a.fecha_hora_inicio AS actividad_fechaHoraInicio,
    a.fecha_hora_fin AS actividad_fechaHoraFin,
    a.compuesta AS actividad_compuesta,
    e.id AS evento_id,
    e.nombre AS evento_nombre,
    d.id AS detalleActividad_id,
    d.nombre AS detalleActividad_nombre,
    d.fecha_hora_inicio AS detalleActividad_fechaHoraInicio,
    d.fecha_hora_fin AS detalleActividad_fechaHoraFin,
    p.id AS ponente_id,
    p.nombre AS ponente_nombre,
    p.cargo AS ponente_cargo,
    p.url AS ponente_url
FROM
    actividad a
        LEFT JOIN
    detalle_actividad d ON a.id = d.actividad_id
        LEFT JOIN
    ponente p ON a.id = p.detalle_actividad_id
        LEFT JOIN
    evento e ON a.evento_id = e.id
WHERE
    a.compuesta = 1;


