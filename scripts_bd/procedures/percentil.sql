DELIMITER $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_getRow;
CREATE PROCEDURE pa_percentil_getRow(
	IN _percent_id int(11)
)
BEGIN
	SELECT percent_id, percent_sexo, indic_id, indic_nombre, percent_var1_valor, percent_var2_valor,
		   percent_percentil, percent_estado
	FROM percentil percent
		INNER JOIN indicador indic ON percent.percent_indic_id = indic.indic_id
	WHERE percent.percent_id = _percent_id;
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_getByID;
CREATE PROCEDURE pa_percentil_getByID(
	IN _percent_id int(11)
)
BEGIN
	SELECT percent_id, percent_sexo, indic_id, indic_nombre, percent_var1_valor, percent_var2_valor,
		   percent_percentil, percent_estado
	FROM percentil percent
		INNER JOIN indicador indic ON percent.percent_indic_id = indic.indic_id
	WHERE percent.percent_id = _percent_id;
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_listcbo;
CREATE PROCEDURE pa_percentil_listcbo(
	IN _percent_id int(11)
)
BEGIN
	SELECT percent_id, percent_sexo, indic_id, indic_nombre, percent_var1_valor, percent_var2_valor,
		   percent_percentil, percent_estado
	FROM percentil percent
		INNER JOIN indicador indic ON percent.percent_indic_id = indic.indic_id
	WHERE percent.percent_estado = 1 OR (percent.percent_id = _percent_id);
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_list;
CREATE PROCEDURE pa_percentil_list(
	IN _buscar varchar(50),
	IN _percent_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT percent_id, percent_sexo, indic_id, indic_nombre, percent_var1_valor, percent_var2_valor,
		   percent_percentil, percent_estado
	FROM percentil percent
		INNER JOIN indicador indic ON percent.percent_indic_id = indic.indic_id
	WHERE percent.percent_estado = _percent_estado
	  AND (percent.percent_var1_valor LIKE _buscar
		OR percent.percent_var2_valor LIKE _buscar);
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_insert;
CREATE PROCEDURE pa_percentil_insert(
	OUT _percent_id int(11),
	IN _percent_sexo char(1),
	IN _percent_indic_id int(11),
	IN _percent_var1_valor decimal(9, 2),
	IN _percent_var2_valor decimal(9, 2),
	IN _percent_percentil decimal(9, 2)
)
BEGIN
	INSERT INTO percentil (
		percent_sexo,
		percent_indic_id,
		percent_var1_valor,
		percent_var2_valor,
		percent_percentil,
		percent_estado
	)
	VALUES (
		_percent_sexo,
		_percent_indic_id,
		_percent_var1_valor,
		_percent_var2_valor,
		_percent_percentil,
		1
	);
	SET _percent_id = LAST_INSERT_ID();
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_update;
CREATE PROCEDURE pa_percentil_update(
	IN _percent_id int(11),
	IN _percent_sexo char(1),
	IN _percent_indic_id int(11),
	IN _percent_var1_valor decimal(9, 2),
	IN _percent_var2_valor decimal(9, 2),
	IN _percent_percentil decimal(9, 2)
)
BEGIN
	UPDATE percentil
	SET percent_sexo = _percent_sexo,
		percent_indic_id = _percent_indic_id,
		percent_var1_valor = _percent_var1_valor,
		percent_var2_valor = _percent_var2_valor,
		percent_percentil = _percent_percentil
	WHERE percent_id = _percent_id;
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_activate;
CREATE PROCEDURE pa_percentil_activate(
	IN _percent_id int(11)
)
BEGIN
	UPDATE percentil
	SET percent_estado = 1
	WHERE percent_id = _percent_id;
END $$

-- Tabla: percentil
-- DROP PROCEDURE IF EXISTS pa_percentil_delete;
CREATE PROCEDURE pa_percentil_delete(
	IN _percent_id int(11)
)
BEGIN
	UPDATE percentil
	SET percent_estado = 0
	WHERE percent_id = _percent_id;
END $$
