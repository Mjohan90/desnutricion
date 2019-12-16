DELIMITER $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_getRow;
CREATE PROCEDURE pa_direccion_getRow(
	IN _direc_id int(11)
)
BEGIN
	SELECT direc_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   ubig_id, ubig_nombre, direc_descripcion, direc_fecha_reg, direc_estado
	FROM direccion direc
		INNER JOIN persona pers ON direc.direc_pers_id = pers.pers_id
		INNER JOIN ubigeo ubig ON direc.direc_ubig_id = ubig.ubig_id
	WHERE direc.direc_id = _direc_id;
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_getByID;
CREATE PROCEDURE pa_direccion_getByID(
	IN _direc_id int(11)
)
BEGIN
	SELECT direc_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   ubig_id, ubig_nombre, direc_descripcion, direc_fecha_reg, direc_estado
	FROM direccion direc
		INNER JOIN persona pers ON direc.direc_pers_id = pers.pers_id
		INNER JOIN ubigeo ubig ON direc.direc_ubig_id = ubig.ubig_id
	WHERE direc.direc_id = _direc_id;
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_listcbo;
CREATE PROCEDURE pa_direccion_listcbo(
	IN _direc_id int(11)
)
BEGIN
	SELECT direc_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   ubig_id, ubig_nombre, direc_descripcion, direc_fecha_reg, direc_estado
	FROM direccion direc
		INNER JOIN persona pers ON direc.direc_pers_id = pers.pers_id
		INNER JOIN ubigeo ubig ON direc.direc_ubig_id = ubig.ubig_id
	WHERE direc.direc_estado = 1 OR (direc.direc_id = _direc_id);
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_list;
CREATE PROCEDURE pa_direccion_list(
	IN _buscar varchar(50),
	IN _direc_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT direc_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   ubig_id, ubig_nombre, direc_descripcion, direc_fecha_reg, direc_estado
	FROM direccion direc
		INNER JOIN persona pers ON direc.direc_pers_id = pers.pers_id
		INNER JOIN ubigeo ubig ON direc.direc_ubig_id = ubig.ubig_id
	WHERE direc.direc_estado = _direc_estado
	  AND (direc.direc_descripcion LIKE _buscar);
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_insert;
CREATE PROCEDURE pa_direccion_insert(
	OUT _direc_id int(11),
	IN _direc_pers_id int(11),
	IN _direc_ubig_id int(11),
	IN _direc_descripcion varchar(200)
)
BEGIN
	INSERT INTO direccion (
		direc_pers_id,
		direc_ubig_id,
		direc_descripcion,
		direc_fecha_reg,
		direc_estado
	)
	VALUES (
		_direc_pers_id,
		_direc_ubig_id,
		_direc_descripcion,
		NOW(),
		1
	);
	SET _direc_id = LAST_INSERT_ID();
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_update;
CREATE PROCEDURE pa_direccion_update(
	IN _direc_id int(11),
	IN _direc_pers_id int(11),
	IN _direc_ubig_id int(11),
	IN _direc_descripcion varchar(200)
)
BEGIN
	UPDATE direccion
	SET direc_pers_id = _direc_pers_id,
		direc_ubig_id = _direc_ubig_id,
		direc_descripcion = _direc_descripcion
	WHERE direc_id = _direc_id;
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_activate;
CREATE PROCEDURE pa_direccion_activate(
	IN _direc_id int(11)
)
BEGIN
	UPDATE direccion
	SET direc_estado = 1
	WHERE direc_id = _direc_id;
END $$

-- Tabla: direccion
-- DROP PROCEDURE IF EXISTS pa_direccion_delete;
CREATE PROCEDURE pa_direccion_delete(
	IN _direc_id int(11)
)
BEGIN
	UPDATE direccion
	SET direc_estado = 0
	WHERE direc_id = _direc_id;
END $$
