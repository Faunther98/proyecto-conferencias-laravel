

--TABLA EVENTOS

CREATE TABLE eventos (
    id_evento SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    lugar VARCHAR(255) NOT NULL,
    capacidad INTEGER NOT NULL,
    estado VARCHAR(20) DEFAULT 'S',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT check_capacidad CHECK (capacidad>0),
    CONSTRAINT check_estado_evento CHECK (estado IN ('S', 'N'))
    );

    COMMENT ON TABLE eventos IS 'Catálogo de eventos y conferencias disponibles';
    COMMENT ON COLUMN eventos.id_evento IS 'Id del evento';


CREATE TABLE sesiones (
    id_sesion SERIAL PRIMARY KEY,
    id_evento BIGINT NOT NULL,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    ponente VARCHAR(255) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT check_estado_sesion CHECK (estado IN ('S', 'N')),
    CONSTRAINT check_horas_sesion CHECK (hora_inicio < hora_fin),

    CONSTRAINT fk_sesiones_evento
        FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) ON DELETE CASCADE
    );

    COMMENT ON TABLE sesiones IS 'Sesiones correspondientes a un evento';
    CREATE INDEX idx_sesiones_evento ON sesiones(id_evento);


CREATE TABLE inscripciones (
    id_inscripcion SERIAL PRIMARY KEY,
    id_usuario BIGINT NOT NULL,
    id_evento BIGINT NOT NULL,
    asistencia VARCHAR(2) DEFAULT 'N',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT check_asistencia CHECK (asistencia IN ('S', 'N')),
    CONSTRAINT uk_usuario_evento UNIQUE (id_usuario, id_evento),

    CONSTRAINT fk_inscripciones_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    CONSTRAINT fk_inscripciones_evento
        FOREIGN KEY (id_evento) REFERENCES eventos(id_evento) ON DELETE CASCADE
    );

    COMMENT ON TABLE inscripciones IS 'Registro de usuarios inscritos a los eventos';
    CREATE INDEX idx_inscripciones_usuario ON inscripciones(id_usuario);
    CREATE INDEX idx_inscripciones_evento ON inscripciones(id_evento);
