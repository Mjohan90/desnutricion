DELIMITER $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_getRow;
CREATE PROCEDURE pa_diagnostico_getRow(
	IN _diag_id int(11)
)
BEGIN
	SELECT diag_id, diag_nombre, diag_tratamiento_sug, diag_dieta_sug, diag_estado
	FROM diagnostico diag
	WHERE diag.diag_id = _diag_id;
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_getByID;
CREATE PROCEDURE pa_diagnostico_getByID(
	IN _diag_id int(11)
)
BEGIN
	SELECT diag_id, diag_nombre, diag_tratamiento_sug, diag_dieta_sug, diag_estado
	FROM diagnostico diag
	WHERE diag.diag_id = _diag_id;
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_listcbo;
CREATE PROCEDURE pa_diagnostico_listcbo(
	IN _diag_id int(11)
)
BEGIN
	SELECT diag_id, diag_nombre, diag_tratamiento_sug, diag_dieta_sug, diag_estado
	FROM diagnostico diag
	WHERE diag.diag_estado = 1 OR (diag.diag_id = _diag_id);
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_list;
CREATE PROCEDURE pa_diagnostico_list(
	IN _buscar varchar(50),
	IN _diag_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT diag_id, diag_nombre, diag_tratamiento_sug, diag_dieta_sug, diag_estado
	FROM diagnostico diag
	WHERE diag.diag_estado = _diag_estado
	  AND (diag.diag_nombre LIKE _buscar);
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_insert;
CREATE PROCEDURE pa_diagnostico_insert(
	OUT _diag_id int(11),
	IN _diag_nombre varchar(50),
	IN _diag_tratamiento_sug varchar(500),
	IN _diag_dieta_sug varchar(500)
)
BEGIN
	INSERT INTO diagnostico (
		diag_nombre,
		diag_tratamiento_sug,
		diag_dieta_sug,
		diag_estado
	)
	VALUES (
		_diag_nombre,
		_diag_tratamiento_sug,
		_diag_dieta_sug,
		1
	);
	SET _diag_id = LAST_INSERT_ID();
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_update;
CREATE PROCEDURE pa_diagnostico_update(
	IN _diag_id int(11),
	IN _diag_nombre varchar(50),
	IN _diag_tratamiento_sug varchar(500),
	IN _diag_dieta_sug varchar(500)
)
BEGIN
	UPDATE diagnostico
	SET diag_nombre = _diag_nombre,
		diag_tratamiento_sug = _diag_tratamiento_sug,
		diag_dieta_sug = _diag_dieta_sug
	WHERE diag_id = _diag_id;
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_activate;
CREATE PROCEDURE pa_diagnostico_activate(
	IN _diag_id int(11)
)
BEGIN
	UPDATE diagnostico
	SET diag_estado = 1
	WHERE diag_id = _diag_id;
END $$

-- Tabla: diagnostico
-- DROP PROCEDURE IF EXISTS pa_diagnostico_delete;
CREATE PROCEDURE pa_diagnostico_delete(
	IN _diag_id int(11)
)
BEGIN
	UPDATE diagnostico
	SET diag_estado = 0
	WHERE diag_id = _diag_id;
END $$
