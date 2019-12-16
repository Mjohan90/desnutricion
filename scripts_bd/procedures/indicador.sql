DELIMITER $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_getRow;
CREATE PROCEDURE pa_indicador_getRow(
	IN _indic_id int(11)
)
BEGIN
	SELECT indic_id, indic_nombre, indic_var1_id, indic_var2_id, indic_estado
	FROM indicador indic
	WHERE indic.indic_id = _indic_id;
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_getByID;
CREATE PROCEDURE pa_indicador_getByID(
	IN _indic_id int(11)
)
BEGIN
	SELECT indic_id, indic_nombre, indic_var1_id, indic_var2_id, indic_estado
	FROM indicador indic
	WHERE indic.indic_id = _indic_id;
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_listcbo;
CREATE PROCEDURE pa_indicador_listcbo(
	IN _indic_id int(11)
)
BEGIN
	SELECT indic_id, indic_nombre, indic_var1_id, indic_var2_id, indic_estado
	FROM indicador indic
	WHERE indic.indic_estado = 1 OR (indic.indic_id = _indic_id);
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_list;
CREATE PROCEDURE pa_indicador_list(
	IN _buscar varchar(50),
	IN _indic_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT indic_id, indic_nombre, indic_var1_id, indic_var2_id, indic_estado
	FROM indicador indic
	WHERE indic.indic_estado = _indic_estado
	  AND (indic.indic_nombre LIKE _buscar);
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_insert;
CREATE PROCEDURE pa_indicador_insert(
	OUT _indic_id int(11),
	IN _indic_nombre varchar(50),
	IN _indic_var1_id int(11),
	IN _indic_var2_id int(11)
)
BEGIN
	INSERT INTO indicador (
		indic_nombre,
		indic_var1_id,
		indic_var2_id,
		indic_estado
	)
	VALUES (
		_indic_nombre,
		_indic_var1_id,
		_indic_var2_id,
		1
	);
	SET _indic_id = LAST_INSERT_ID();
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_update;
CREATE PROCEDURE pa_indicador_update(
	IN _indic_id int(11),
	IN _indic_nombre varchar(50),
	IN _indic_var1_id int(11),
	IN _indic_var2_id int(11)
)
BEGIN
	UPDATE indicador
	SET indic_nombre = _indic_nombre,
		indic_var1_id = _indic_var1_id,
		indic_var2_id = _indic_var2_id
	WHERE indic_id = _indic_id;
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_activate;
CREATE PROCEDURE pa_indicador_activate(
	IN _indic_id int(11)
)
BEGIN
	UPDATE indicador
	SET indic_estado = 1
	WHERE indic_id = _indic_id;
END $$

-- Tabla: indicador
-- DROP PROCEDURE IF EXISTS pa_indicador_delete;
CREATE PROCEDURE pa_indicador_delete(
	IN _indic_id int(11)
)
BEGIN
	UPDATE indicador
	SET indic_estado = 0
	WHERE indic_id = _indic_id;
END $$
