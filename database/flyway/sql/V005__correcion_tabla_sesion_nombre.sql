
ALTER TABLE sesiones ADD COLUMN nombre VARCHAR(255);


UPDATE sesiones SET nombre = 'Sesión del Evento' WHERE nombre IS NULL;


ALTER TABLE sesiones ALTER COLUMN nombre SET NOT NULL;