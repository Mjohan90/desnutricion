DELIMITER $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_getRow;
CREATE PROCEDURE pa_reglas_getRow(
	IN _regla_id int(11)
)
BEGIN
	SELECT regla_id, indic1.indic_id as indic1_id, indic1.indic_nombre as indic1_nombre,
		   indic2.indic_id as indic2_id, indic2.indic_nombre as indic2_nombre,
		   regla_formula, diag_id, diag_nombre
	FROM reglas regla
		INNER JOIN diagnostico diag ON regla.regla_diag_id = diag.diag_id
		INNER JOIN indicador indic1 ON regla.regla_indic1_id = indic1.indic_id
		INNER JOIN indicador indic2 ON regla.regla_indic2_id = indic2.indic_id
	WHERE regla.regla_id = _regla_id;
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_getByID;
CREATE PROCEDURE pa_reglas_getByID(
	IN _regla_id int(11)
)
BEGIN
	SELECT regla_id, indic1.indic_id as indic1_id, indic1.indic_nombre as indic1_nombre,
		   indic2.indic_id as indic2_id, indic2.indic_nombre as indic2_nombre,
		   regla_formula, diag_id, diag_nombre
	FROM reglas regla
		INNER JOIN diagnostico diag ON regla.regla_diag_id = diag.diag_id
		INNER JOIN indicador indic1 ON regla.regla_indic1_id = indic1.indic_id
		INNER JOIN indicador indic2 ON regla.regla_indic2_id = indic2.indic_id
	WHERE regla.regla_id = _regla_id;
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_listcbo;
CREATE PROCEDURE pa_reglas_listcbo(
	IN _regla_id int(11)
)
BEGIN
	SELECT regla_id, indic1.indic_id as indic1_id, indic1.indic_nombre as indic1_nombre,
		   indic2.indic_id as indic2_id, indic2.indic_nombre as indic2_nombre,
		   regla_formula, diag_id, diag_nombre
	FROM reglas regla
		INNER JOIN diagnostico diag ON regla.regla_diag_id = diag.diag_id
		INNER JOIN indicador indic1 ON regla.regla_indic1_id = indic1.indic_id
		INNER JOIN indicador indic2 ON regla.regla_indic2_id = indic2.indic_id;
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_list;
CREATE PROCEDURE pa_reglas_list(
	IN _buscar varchar(50)
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT regla_id, indic1.indic_id as indic1_id, indic1.indic_nombre as indic1_nombre,
		   indic2.indic_id as indic2_id, indic2.indic_nombre as indic2_nombre,
		   regla_formula, diag_id, diag_nombre
	FROM reglas regla
		INNER JOIN diagnostico diag ON regla.regla_diag_id = diag.diag_id
		INNER JOIN indicador indic1 ON regla.regla_indic1_id = indic1.indic_id
		INNER JOIN indicador indic2 ON regla.regla_indic2_id = indic2.indic_id;
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_insert;
CREATE PROCEDURE pa_reglas_insert(
	OUT _regla_id int(11),
	IN _regla_indic1_id int(11),
	IN _regla_indic2_id int(11),
	IN _regla_formula varchar(200),
	IN _regla_diag_id int(11)
)
BEGIN
	INSERT INTO reglas (
		regla_indic1_id,
		regla_indic2_id,
		regla_formula,
		regla_diag_id
	)
	VALUES (
		_regla_indic1_id,
		_regla_indic2_id,
		_regla_formula,
		_regla_diag_id
	);
	SET _regla_id = LAST_INSERT_ID();
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_update;
CREATE PROCEDURE pa_reglas_update(
	IN _regla_id int(11),
	IN _regla_indic1_id int(11),
	IN _regla_indic2_id int(11),
	IN _regla_formula varchar(200),
	IN _regla_diag_id int(11)
)
BEGIN
	UPDATE reglas
	SET regla_indic1_id = _regla_indic1_id,
		regla_indic2_id = _regla_indic2_id,
		regla_formula = _regla_formula,
		regla_diag_id = _regla_diag_id
	WHERE regla_id = _regla_id;
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_activate;
CREATE PROCEDURE pa_reglas_activate(
	IN _regla_id int(11)
)
BEGIN
	-- reglas no tiene columna estado
END $$

-- Tabla: reglas
-- DROP PROCEDURE IF EXISTS pa_reglas_delete;
CREATE PROCEDURE pa_reglas_delete(
	IN _regla_id int(11)
)
BEGIN
	-- reglas no tiene columna estado
END $$
