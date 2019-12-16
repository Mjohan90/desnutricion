DELIMITER $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_getRow;
CREATE PROCEDURE pa_empleado_getRow(
	IN _empl_id int(11)
)
BEGIN
	SELECT empl_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   carg_id, carg_nombre, empl_fecha_reg, empl_estado
	FROM empleado empl
		INNER JOIN cargo carg ON empl.empl_carg_id = carg.carg_id
		INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
	WHERE empl.empl_id = _empl_id;
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_getByID;
CREATE PROCEDURE pa_empleado_getByID(
	IN _empl_id int(11)
)
BEGIN
	SELECT empl_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   carg_id, carg_nombre, empl_fecha_reg, empl_estado
	FROM empleado empl
		INNER JOIN cargo carg ON empl.empl_carg_id = carg.carg_id
		INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
	WHERE empl.empl_id = _empl_id;
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_listcbo;
CREATE PROCEDURE pa_empleado_listcbo(
	IN _empl_id int(11)
)
BEGIN
	SELECT empl_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   carg_id, carg_nombre, empl_fecha_reg, empl_estado
	FROM empleado empl
		INNER JOIN cargo carg ON empl.empl_carg_id = carg.carg_id
		INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
	WHERE empl.empl_estado = 1 OR (empl.empl_id = _empl_id);
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_list;
CREATE PROCEDURE pa_empleado_list(
	IN _buscar varchar(50),
	IN _empl_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT empl_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   carg_id, carg_nombre, empl_fecha_reg, empl_estado
	FROM empleado empl
		INNER JOIN cargo carg ON empl.empl_carg_id = carg.carg_id
		INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
	WHERE empl.empl_estado = _empl_estado;
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_insert;
CREATE PROCEDURE pa_empleado_insert(
	OUT _empl_id int(11),
	IN _empl_pers_id int(11),
	IN _empl_carg_id int(11)
)
BEGIN
	INSERT INTO empleado (
		empl_pers_id,
		empl_carg_id,
		empl_fecha_reg,
		empl_estado
	)
	VALUES (
		_empl_pers_id,
		_empl_carg_id,
		NOW(),
		1
	);
	SET _empl_id = LAST_INSERT_ID();
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_update;
CREATE PROCEDURE pa_empleado_update(
	IN _empl_id int(11),
	IN _empl_pers_id int(11),
	IN _empl_carg_id int(11)
)
BEGIN
	UPDATE empleado
	SET empl_pers_id = _empl_pers_id,
		empl_carg_id = _empl_carg_id
	WHERE empl_id = _empl_id;
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_activate;
CREATE PROCEDURE pa_empleado_activate(
	IN _empl_id int(11)
)
BEGIN
	UPDATE empleado
	SET empl_estado = 1
	WHERE empl_id = _empl_id;
END $$

-- Tabla: empleado
-- DROP PROCEDURE IF EXISTS pa_empleado_delete;
CREATE PROCEDURE pa_empleado_delete(
	IN _empl_id int(11)
)
BEGIN
	UPDATE empleado
	SET empl_estado = 0
	WHERE empl_id = _empl_id;
END $$
