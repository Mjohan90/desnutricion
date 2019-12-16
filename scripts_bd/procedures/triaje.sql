DELIMITER $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_getRow;
CREATE PROCEDURE pa_triaje_getRow(
	IN _triaje_id int(11)
)
BEGIN
	SELECT triaje_id, atenc_id, var_id, var_nombre, um_id, um_nombre, um_abrev, triaje_valor,
		   triaje_fecha_reg, triaje_estado
	FROM triaje triaje
		INNER JOIN atencion atenc ON triaje.triaje_atenc_id = atenc.atenc_id
		INNER JOIN um um ON triaje.triaje_um_id = um.um_id
		INNER JOIN variable var ON triaje.triaje_var_id = var.var_id
	WHERE triaje.triaje_id = _triaje_id;
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_getByID;
CREATE PROCEDURE pa_triaje_getByID(
	IN _triaje_id int(11)
)
BEGIN
	SELECT triaje_id, atenc_id, var_id, var_nombre, um_id, um_nombre, um_abrev, triaje_valor,
		   triaje_fecha_reg, triaje_estado
	FROM triaje triaje
		INNER JOIN atencion atenc ON triaje.triaje_atenc_id = atenc.atenc_id
		INNER JOIN um um ON triaje.triaje_um_id = um.um_id
		INNER JOIN variable var ON triaje.triaje_var_id = var.var_id
	WHERE triaje.triaje_id = _triaje_id;
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_listcbo;
CREATE PROCEDURE pa_triaje_listcbo(
	IN _triaje_id int(11)
)
BEGIN
	SELECT triaje_id, atenc_id, var_id, var_nombre, um_id, um_nombre, um_abrev, triaje_valor,
		   triaje_fecha_reg, triaje_estado
	FROM triaje triaje
		INNER JOIN atencion atenc ON triaje.triaje_atenc_id = atenc.atenc_id
		INNER JOIN um um ON triaje.triaje_um_id = um.um_id
		INNER JOIN variable var ON triaje.triaje_var_id = var.var_id
	WHERE triaje.triaje_estado = 1 OR (triaje.triaje_id = _triaje_id);
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_list;
CREATE PROCEDURE pa_triaje_list(
	IN _buscar varchar(50),
	IN _triaje_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT triaje_id, atenc_id, var_id, var_nombre, um_id, um_nombre, um_abrev, triaje_valor,
		   triaje_fecha_reg, triaje_estado
	FROM triaje triaje
		INNER JOIN atencion atenc ON triaje.triaje_atenc_id = atenc.atenc_id
		INNER JOIN um um ON triaje.triaje_um_id = um.um_id
		INNER JOIN variable var ON triaje.triaje_var_id = var.var_id
	WHERE triaje.triaje_estado = _triaje_estado
	  AND (triaje.triaje_valor LIKE _buscar);
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_insert;
CREATE PROCEDURE pa_triaje_insert(
	OUT _triaje_id int(11),
	IN _triaje_atenc_id int(11),
	IN _triaje_var_id int(11),
	IN _triaje_um_id int(11),
	IN _triaje_valor decimal(9, 2)
)
BEGIN
	INSERT INTO triaje (
		triaje_atenc_id,
		triaje_var_id,
		triaje_um_id,
		triaje_valor,
		triaje_fecha_reg,
		triaje_estado
	)
	VALUES (
		_triaje_atenc_id,
		_triaje_var_id,
		_triaje_um_id,
		_triaje_valor,
		NOW(),
		1
	);
	SET _triaje_id = LAST_INSERT_ID();
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_update;
CREATE PROCEDURE pa_triaje_update(
	IN _triaje_id int(11),
	IN _triaje_atenc_id int(11),
	IN _triaje_var_id int(11),
	IN _triaje_um_id int(11),
	IN _triaje_valor decimal(9, 2)
)
BEGIN
	UPDATE triaje
	SET triaje_atenc_id = _triaje_atenc_id,
		triaje_var_id = _triaje_var_id,
		triaje_um_id = _triaje_um_id,
		triaje_valor = _triaje_valor
	WHERE triaje_id = _triaje_id;
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_activate;
CREATE PROCEDURE pa_triaje_activate(
	IN _triaje_id int(11)
)
BEGIN
	UPDATE triaje
	SET triaje_estado = 1
	WHERE triaje_id = _triaje_id;
END $$

-- Tabla: triaje
-- DROP PROCEDURE IF EXISTS pa_triaje_delete;
CREATE PROCEDURE pa_triaje_delete(
	IN _triaje_id int(11)
)
BEGIN
	UPDATE triaje
	SET triaje_estado = 0
	WHERE triaje_id = _triaje_id;
END $$
