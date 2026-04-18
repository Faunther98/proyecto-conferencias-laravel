-- Eventos de Prueba


INSERT INTO eventos (nombre, fecha_inicio, fecha_fin, lugar, capacidad, estado) 
VALUES 
('Congreso de Seguridad Informática', '2026-05-15', '2026-05-17', 'Auditorio Alfa', 150, 'S'),
('Taller de Laravel Livewire', '2026-06-10', '2026-06-10', 'Laboratorio 3', 30, 'S');


INSERT INTO sesiones (id_evento, fecha, hora_inicio, hora_fin, ponente, estado)
VALUES
(1, '2026-05-15', '10:00:00', '12:00:00', 'Dr. Hackerman', 'S');