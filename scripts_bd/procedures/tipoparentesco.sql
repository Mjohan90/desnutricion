DELIMITER $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_getRow;
CREATE PROCEDURE pa_tipoparentesco_getRow(
	IN _tparent_id int(11)
)
BEGIN
	SELECT tparent_id, tparent_nombre, tparent_estado
	FROM tipoparentesco tparent
	WHERE tparent.tparent_id = _tparent_id;
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_getByID;
CREATE PROCEDURE pa_tipoparentesco_getByID(
	IN _tparent_id int(11)
)
BEGIN
	SELECT tparent_id, tparent_nombre, tparent_estado
	FROM tipoparentesco tparent
	WHERE tparent.tparent_id = _tparent_id;
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_listcbo;
CREATE PROCEDURE pa_tipoparentesco_listcbo(
	IN _tparent_id int(11)
)
BEGIN
	SELECT tparent_id, tparent_nombre, tparent_estado
	FROM tipoparentesco tparent
	WHERE tparent.tparent_estado = 1 OR (tparent.tparent_id = _tparent_id);
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_list;
CREATE PROCEDURE pa_tipoparentesco_list(
	IN _buscar varchar(50),
	IN _tparent_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT tparent_id, tparent_nombre, tparent_estado
	FROM tipoparentesco tparent
	WHERE tparent.tparent_estado = _tparent_estado
	  AND (tparent.tparent_nombre LIKE _buscar);
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_insert;
CREATE PROCEDURE pa_tipoparentesco_insert(
	OUT _tparent_id int(11),
	IN _tparent_nombre varchar(50)
)
BEGIN
	INSERT INTO tipoparentesco (
		tparent_nombre,
		tparent_estado
	)
	VALUES (
		_tparent_nombre,
		1
	);
	SET _tparent_id = LAST_INSERT_ID();
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_update;
CREATE PROCEDURE pa_tipoparentesco_update(
	IN _tparent_id int(11),
	IN _tparent_nombre varchar(50)
)
BEGIN
	UPDATE tipoparentesco
	SET tparent_nombre = _tparent_nombre
	WHERE tparent_id = _tparent_id;
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_activate;
CREATE PROCEDURE pa_tipoparentesco_activate(
	IN _tparent_id int(11)
)
BEGIN
	UPDATE tipoparentesco
	SET tparent_estado = 1
	WHERE tparent_id = _tparent_id;
END $$

-- Tabla: tipoparentesco
-- DROP PROCEDURE IF EXISTS pa_tipoparentesco_delete;
CREATE PROCEDURE pa_tipoparentesco_delete(
	IN _tparent_id int(11)
)
BEGIN
	UPDATE tipoparentesco
	SET tparent_estado = 0
	WHERE tparent_id = _tparent_id;
END $$
