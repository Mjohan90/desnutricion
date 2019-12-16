DELIMITER $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_getRow;
CREATE PROCEDURE pa_historiaclinica_getRow(
	IN _hc_id int(11)
)
BEGIN
	SELECT hc_id, pac_id, hc_fecha_suceso, hc_comentario, hc_atenc_id_ref, hc_fecha_reg,
		   hc_estado
	FROM historiaclinica hc
		INNER JOIN paciente pac ON hc.hc_pac_id = pac.pac_id
	WHERE hc.hc_id = _hc_id;
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_getByID;
CREATE PROCEDURE pa_historiaclinica_getByID(
	IN _hc_id int(11)
)
BEGIN
	SELECT hc_id, pac_id, hc_fecha_suceso, hc_comentario, hc_atenc_id_ref, hc_fecha_reg,
		   hc_estado
	FROM historiaclinica hc
		INNER JOIN paciente pac ON hc.hc_pac_id = pac.pac_id
	WHERE hc.hc_id = _hc_id;
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_listcbo;
CREATE PROCEDURE pa_historiaclinica_listcbo(
	IN _hc_id int(11)
)
BEGIN
	SELECT hc_id, pac_id, hc_fecha_suceso, hc_comentario, hc_atenc_id_ref, hc_fecha_reg,
		   hc_estado
	FROM historiaclinica hc
		INNER JOIN paciente pac ON hc.hc_pac_id = pac.pac_id
	WHERE hc.hc_estado = 1 OR (hc.hc_id = _hc_id);
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_list;
CREATE PROCEDURE pa_historiaclinica_list(
	IN _buscar varchar(50),
	IN _hc_estado int(11)
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT hc_id, pac_id, hc_fecha_suceso, hc_comentario, hc_atenc_id_ref, hc_fecha_reg,
		   hc_estado
	FROM historiaclinica hc
		INNER JOIN paciente pac ON hc.hc_pac_id = pac.pac_id
	WHERE hc.hc_estado = _hc_estado;
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_insert;
CREATE PROCEDURE pa_historiaclinica_insert(
	OUT _hc_id int(11),
	IN _hc_pac_id int(11),
	IN _hc_fecha_suceso datetime,
	IN _hc_comentario varchar(400),
	IN _hc_atenc_id_ref int(11)
)
BEGIN
	INSERT INTO historiaclinica (
		hc_pac_id,
		hc_fecha_suceso,
		hc_comentario,
		hc_atenc_id_ref,
		hc_fecha_reg,
		hc_estado
	)
	VALUES (
		_hc_pac_id,
		_hc_fecha_suceso,
		_hc_comentario,
		_hc_atenc_id_ref,
		NOW(),
		1
	);
	SET _hc_id = LAST_INSERT_ID();
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_update;
CREATE PROCEDURE pa_historiaclinica_update(
	IN _hc_id int(11),
	IN _hc_pac_id int(11),
	IN _hc_fecha_suceso datetime,
	IN _hc_comentario varchar(400),
	IN _hc_atenc_id_ref int(11)
)
BEGIN
	UPDATE historiaclinica
	SET hc_pac_id = _hc_pac_id,
		hc_fecha_suceso = _hc_fecha_suceso,
		hc_comentario = _hc_comentario,
		hc_atenc_id_ref = _hc_atenc_id_ref
	WHERE hc_id = _hc_id;
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_activate;
CREATE PROCEDURE pa_historiaclinica_activate(
	IN _hc_id int(11)
)
BEGIN
	UPDATE historiaclinica
	SET hc_estado = 1
	WHERE hc_id = _hc_id;
END $$

-- Tabla: historiaclinica
-- DROP PROCEDURE IF EXISTS pa_historiaclinica_delete;
CREATE PROCEDURE pa_historiaclinica_delete(
	IN _hc_id int(11)
)
BEGIN
	UPDATE historiaclinica
	SET hc_estado = 0
	WHERE hc_id = _hc_id;
END $$
