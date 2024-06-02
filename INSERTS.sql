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


