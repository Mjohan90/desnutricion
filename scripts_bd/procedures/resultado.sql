DELIMITER $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_getRow;
CREATE PROCEDURE pa_resultado_getRow(
	IN _result_id int(11)
)
BEGIN
	SELECT result_id, atenc_id, diag_id, diag_nombre, result_fecha_reg
	FROM resultado result
		INNER JOIN atencion atenc ON result.result_atenc_id = atenc.atenc_id
		INNER JOIN diagnostico diag ON result.result_diag_id = diag.diag_id
	WHERE result.result_id = _result_id;
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_getByID;
CREATE PROCEDURE pa_resultado_getByID(
	IN _result_id int(11)
)
BEGIN
	SELECT result_id, atenc_id, diag_id, diag_nombre, result_fecha_reg
	FROM resultado result
		INNER JOIN atencion atenc ON result.result_atenc_id = atenc.atenc_id
		INNER JOIN diagnostico diag ON result.result_diag_id = diag.diag_id
	WHERE result.result_id = _result_id;
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_listcbo;
CREATE PROCEDURE pa_resultado_listcbo(
	IN _result_id int(11)
)
BEGIN
	SELECT result_id, atenc_id, diag_id, diag_nombre, result_fecha_reg
	FROM resultado result
		INNER JOIN atencion atenc ON result.result_atenc_id = atenc.atenc_id
		INNER JOIN diagnostico diag ON result.result_diag_id = diag.diag_id;
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_list;
CREATE PROCEDURE pa_resultado_list(
	IN _buscar varchar(50)
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT result_id, atenc_id, diag_id, diag_nombre, result_fecha_reg
	FROM resultado result
		INNER JOIN atencion atenc ON result.result_atenc_id = atenc.atenc_id
		INNER JOIN diagnostico diag ON result.result_diag_id = diag.diag_id;
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_insert;
CREATE PROCEDURE pa_resultado_insert(
	OUT _result_id int(11),
	IN _result_atenc_id int(11),
	IN _result_diag_id int(11)
)
BEGIN
	INSERT INTO resultado (
		result_atenc_id,
		result_diag_id,
		result_fecha_reg
	)
	VALUES (
		_result_atenc_id,
		_result_diag_id,
		NOW()
	);
	SET _result_id = LAST_INSERT_ID();
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_update;
CREATE PROCEDURE pa_resultado_update(
	IN _result_id int(11),
	IN _result_atenc_id int(11),
	IN _result_diag_id int(11)
)
BEGIN
	UPDATE resultado
	SET result_atenc_id = _result_atenc_id,
		result_diag_id = _result_diag_id
	WHERE result_id = _result_id;
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_activate;
CREATE PROCEDURE pa_resultado_activate(
	IN _result_id int(11)
)
BEGIN
	-- resultado no tiene columna estado
END $$

-- Tabla: resultado
-- DROP PROCEDURE IF EXISTS pa_resultado_delete;
CREATE PROCEDURE pa_resultado_delete(
	IN _result_id int(11)
)
BEGIN
	-- resultado no tiene columna estado
END $$
