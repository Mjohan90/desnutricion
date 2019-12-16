DELIMITER $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_getRow;
CREATE PROCEDURE pa_especialidad_getRow(
	IN _espec_id int(11)
)
BEGIN
	SELECT espec_id, espec_nombre, espec_estado
	FROM especialidad espec
	WHERE espec.espec_id = _espec_id;
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_getByID;
CREATE PROCEDURE pa_especialidad_getByID(
	IN _espec_id int(11)
)
BEGIN
	SELECT espec_id, espec_nombre, espec_estado
	FROM especialidad espec
	WHERE espec.espec_id = _espec_id;
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_listcbo;
CREATE PROCEDURE pa_especialidad_listcbo(
	IN _espec_id int(11)
)
BEGIN
	SELECT espec_id, espec_nombre, espec_estado
	FROM especialidad espec
	WHERE espec.espec_estado = 1 OR (espec.espec_id = _espec_id);
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_list;
CREATE PROCEDURE pa_especialidad_list(
	IN _buscar varchar(50),
	IN _espec_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT espec_id, espec_nombre, espec_estado
	FROM especialidad espec
	WHERE espec.espec_estado = _espec_estado
	  AND (espec.espec_nombre LIKE _buscar);
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_insert;
CREATE PROCEDURE pa_especialidad_insert(
	OUT _espec_id int(11),
	IN _espec_nombre varchar(50)
)
BEGIN
	INSERT INTO especialidad (
		espec_nombre,
		espec_estado
	)
	VALUES (
		_espec_nombre,
		1
	);
	SET _espec_id = LAST_INSERT_ID();
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_update;
CREATE PROCEDURE pa_especialidad_update(
	IN _espec_id int(11),
	IN _espec_nombre varchar(50)
)
BEGIN
	UPDATE especialidad
	SET espec_nombre = _espec_nombre
	WHERE espec_id = _espec_id;
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_activate;
CREATE PROCEDURE pa_especialidad_activate(
	IN _espec_id int(11)
)
BEGIN
	UPDATE especialidad
	SET espec_estado = 1
	WHERE espec_id = _espec_id;
END $$

-- Tabla: especialidad
-- DROP PROCEDURE IF EXISTS pa_especialidad_delete;
CREATE PROCEDURE pa_especialidad_delete(
	IN _espec_id int(11)
)
BEGIN
	UPDATE especialidad
	SET espec_estado = 0
	WHERE espec_id = _espec_id;
END $$
