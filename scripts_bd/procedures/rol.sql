DELIMITER $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_getRow;
CREATE PROCEDURE pa_rol_getRow(
	IN _rol_id int(11)
)
BEGIN
	SELECT rol_id, rol_nombre, rol_fecha_reg, rol_estado
	FROM rol rol
	WHERE rol.rol_id = _rol_id;
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_getByID;
CREATE PROCEDURE pa_rol_getByID(
	IN _rol_id int(11)
)
BEGIN
	SELECT rol_id, rol_nombre, rol_fecha_reg, rol_estado
	FROM rol rol
	WHERE rol.rol_id = _rol_id;
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_listcbo;
CREATE PROCEDURE pa_rol_listcbo(
	IN _rol_id int(11)
)
BEGIN
	SELECT rol_id, rol_nombre, rol_fecha_reg, rol_estado
	FROM rol rol
	WHERE rol.rol_estado = 1 OR (rol.rol_id = _rol_id);
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_list;
CREATE PROCEDURE pa_rol_list(
	IN _buscar varchar(50),
	IN _rol_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT rol_id, rol_nombre, rol_fecha_reg, rol_estado
	FROM rol rol
	WHERE rol.rol_estado = _rol_estado
	  AND (rol.rol_nombre LIKE _buscar);
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_insert;
CREATE PROCEDURE pa_rol_insert(
	OUT _rol_id int(11),
	IN _rol_nombre varchar(50)
)
BEGIN
	INSERT INTO rol (
		rol_nombre,
		rol_fecha_reg,
		rol_estado
	)
	VALUES (
		_rol_nombre,
		NOW(),
		1
	);
	SET _rol_id = LAST_INSERT_ID();
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_update;
CREATE PROCEDURE pa_rol_update(
	IN _rol_id int(11),
	IN _rol_nombre varchar(50)
)
BEGIN
	UPDATE rol
	SET rol_nombre = _rol_nombre
	WHERE rol_id = _rol_id;
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_activate;
CREATE PROCEDURE pa_rol_activate(
	IN _rol_id int(11)
)
BEGIN
	UPDATE rol
	SET rol_estado = 1
	WHERE rol_id = _rol_id;
END $$

-- Tabla: rol
-- DROP PROCEDURE IF EXISTS pa_rol_delete;
CREATE PROCEDURE pa_rol_delete(
	IN _rol_id int(11)
)
BEGIN
	UPDATE rol
	SET rol_estado = 0
	WHERE rol_id = _rol_id;
END $$
