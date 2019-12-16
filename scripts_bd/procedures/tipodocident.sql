DELIMITER $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_getRow;
CREATE PROCEDURE pa_tipodocident_getRow(
	IN _tdi_id int(11)
)
BEGIN
	SELECT tdi_id, tdi_nombre, tdi_abrev, tdi_estado
	FROM tipodocident tdi
	WHERE tdi.tdi_id = _tdi_id;
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_getByID;
CREATE PROCEDURE pa_tipodocident_getByID(
	IN _tdi_id int(11)
)
BEGIN
	SELECT tdi_id, tdi_nombre, tdi_abrev, tdi_estado
	FROM tipodocident tdi
	WHERE tdi.tdi_id = _tdi_id;
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_listcbo;
CREATE PROCEDURE pa_tipodocident_listcbo(
	IN _tdi_id int(11)
)
BEGIN
	SELECT tdi_id, tdi_nombre, tdi_abrev, tdi_estado
	FROM tipodocident tdi
	WHERE tdi.tdi_estado = 1 OR (tdi.tdi_id = _tdi_id);
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_list;
CREATE PROCEDURE pa_tipodocident_list(
	IN _buscar varchar(50),
	IN _tdi_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT tdi_id, tdi_nombre, tdi_abrev, tdi_estado
	FROM tipodocident tdi
	WHERE tdi.tdi_estado = _tdi_estado
	  AND (tdi.tdi_nombre LIKE _buscar
		OR tdi.tdi_abrev LIKE _buscar);
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_insert;
CREATE PROCEDURE pa_tipodocident_insert(
	OUT _tdi_id int(11),
	IN _tdi_nombre varchar(50),
	IN _tdi_abrev varchar(10)
)
BEGIN
	INSERT INTO tipodocident (
		tdi_nombre,
		tdi_abrev,
		tdi_estado
	)
	VALUES (
		_tdi_nombre,
		_tdi_abrev,
		1
	);
	SET _tdi_id = LAST_INSERT_ID();
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_update;
CREATE PROCEDURE pa_tipodocident_update(
	IN _tdi_id int(11),
	IN _tdi_nombre varchar(50),
	IN _tdi_abrev varchar(10)
)
BEGIN
	UPDATE tipodocident
	SET tdi_nombre = _tdi_nombre,
		tdi_abrev = _tdi_abrev
	WHERE tdi_id = _tdi_id;
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_activate;
CREATE PROCEDURE pa_tipodocident_activate(
	IN _tdi_id int(11)
)
BEGIN
	UPDATE tipodocident
	SET tdi_estado = 1
	WHERE tdi_id = _tdi_id;
END $$

-- Tabla: tipodocident
-- DROP PROCEDURE IF EXISTS pa_tipodocident_delete;
CREATE PROCEDURE pa_tipodocident_delete(
	IN _tdi_id int(11)
)
BEGIN
	UPDATE tipodocident
	SET tdi_estado = 0
	WHERE tdi_id = _tdi_id;
END $$
