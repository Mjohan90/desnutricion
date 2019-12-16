DELIMITER $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_getRow;
CREATE PROCEDURE pa_cargo_getRow(
	IN _carg_id int(11)
)
BEGIN
	SELECT carg_id, carg_nombre, carg_estado
	FROM cargo carg
	WHERE carg.carg_id = _carg_id;
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_getByID;
CREATE PROCEDURE pa_cargo_getByID(
	IN _carg_id int(11)
)
BEGIN
	SELECT carg_id, carg_nombre, carg_estado
	FROM cargo carg
	WHERE carg.carg_id = _carg_id;
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_listcbo;
CREATE PROCEDURE pa_cargo_listcbo(
	IN _carg_id int(11)
)
BEGIN
	SELECT carg_id, carg_nombre, carg_estado
	FROM cargo carg
	WHERE carg.carg_estado = 1 OR (carg.carg_id = _carg_id);
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_list;
CREATE PROCEDURE pa_cargo_list(
	IN _buscar varchar(50),
	IN _carg_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT carg_id, carg_nombre, carg_estado
	FROM cargo carg
	WHERE carg.carg_estado = _carg_estado
	  AND (carg.carg_nombre LIKE _buscar);
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_insert;
CREATE PROCEDURE pa_cargo_insert(
	OUT _carg_id int(11),
	IN _carg_nombre varchar(50)
)
BEGIN
	INSERT INTO cargo (
		carg_nombre,
		carg_estado
	)
	VALUES (
		_carg_nombre,
		1
	);
	SET _carg_id = LAST_INSERT_ID();
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_update;
CREATE PROCEDURE pa_cargo_update(
	IN _carg_id int(11),
	IN _carg_nombre varchar(50)
)
BEGIN
	UPDATE cargo
	SET carg_nombre = _carg_nombre
	WHERE carg_id = _carg_id;
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_activate;
CREATE PROCEDURE pa_cargo_activate(
	IN _carg_id int(11)
)
BEGIN
	UPDATE cargo
	SET carg_estado = 1
	WHERE carg_id = _carg_id;
END $$

-- Tabla: cargo
-- DROP PROCEDURE IF EXISTS pa_cargo_delete;
CREATE PROCEDURE pa_cargo_delete(
	IN _carg_id int(11)
)
BEGIN
	UPDATE cargo
	SET carg_estado = 0
	WHERE carg_id = _carg_id;
END $$
