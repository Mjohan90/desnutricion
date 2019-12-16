DELIMITER $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_getRow;
CREATE PROCEDURE pa_um_getRow(
	IN _um_id int(11)
)
BEGIN
	SELECT um_id, um_nombre, um_abrev, um_estado
	FROM um um
	WHERE um.um_id = _um_id;
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_getByID;
CREATE PROCEDURE pa_um_getByID(
	IN _um_id int(11)
)
BEGIN
	SELECT um_id, um_nombre, um_abrev, um_estado
	FROM um um
	WHERE um.um_id = _um_id;
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_listcbo;
CREATE PROCEDURE pa_um_listcbo(
	IN _um_id int(11)
)
BEGIN
	SELECT um_id, um_nombre, um_abrev, um_estado
	FROM um um
	WHERE um.um_estado = 1 OR (um.um_id = _um_id);
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_list;
CREATE PROCEDURE pa_um_list(
	IN _buscar varchar(50),
	IN _um_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT um_id, um_nombre, um_abrev, um_estado
	FROM um um
	WHERE um.um_estado = _um_estado
	  AND (um.um_nombre LIKE _buscar
		OR um.um_abrev LIKE _buscar);
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_insert;
CREATE PROCEDURE pa_um_insert(
	OUT _um_id int(11),
	IN _um_nombre varchar(50),
	IN _um_abrev varchar(10)
)
BEGIN
	INSERT INTO um (
		um_nombre,
		um_abrev,
		um_estado
	)
	VALUES (
		_um_nombre,
		_um_abrev,
		1
	);
	SET _um_id = LAST_INSERT_ID();
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_update;
CREATE PROCEDURE pa_um_update(
	IN _um_id int(11),
	IN _um_nombre varchar(50),
	IN _um_abrev varchar(10)
)
BEGIN
	UPDATE um
	SET um_nombre = _um_nombre,
		um_abrev = _um_abrev
	WHERE um_id = _um_id;
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_activate;
CREATE PROCEDURE pa_um_activate(
	IN _um_id int(11)
)
BEGIN
	UPDATE um
	SET um_estado = 1
	WHERE um_id = _um_id;
END $$

-- Tabla: um
-- DROP PROCEDURE IF EXISTS pa_um_delete;
CREATE PROCEDURE pa_um_delete(
	IN _um_id int(11)
)
BEGIN
	UPDATE um
	SET um_estado = 0
	WHERE um_id = _um_id;
END $$
