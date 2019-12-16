DELIMITER $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_getRow;
CREATE PROCEDURE pa_paciente_getRow(
	IN _pac_id int(11)
)
BEGIN
	SELECT pac_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   pac_fecha_reg, pac_estado
	FROM paciente pac
		INNER JOIN persona pers ON pac.pac_pers_id = pers.pers_id
	WHERE pac.pac_id = _pac_id;
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_getByID;
CREATE PROCEDURE pa_paciente_getByID(
	IN _pac_id int(11)
)
BEGIN
	SELECT pac_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   pac_fecha_reg, pac_estado
	FROM paciente pac
		INNER JOIN persona pers ON pac.pac_pers_id = pers.pers_id
	WHERE pac.pac_id = _pac_id;
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_listcbo;
CREATE PROCEDURE pa_paciente_listcbo(
	IN _pac_id int(11)
)
BEGIN
	SELECT pac_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
		   pac_fecha_reg, pac_estado
	FROM paciente pac
		INNER JOIN persona pers ON pac.pac_pers_id = pers.pers_id
	WHERE pac.pac_estado = 1 OR (pac.pac_id = _pac_id);
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_list;
CREATE PROCEDURE pa_paciente_list(
	IN _buscar varchar(50),
	IN _pac_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT pac_id, pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
	       pers_fecha_nac, tdi_id, tdi_abrev, pers_tdi_nro, pac_fecha_reg, pac_estado
	FROM paciente pac
		INNER JOIN persona pers ON pac.pac_pers_id = pers.pers_id
	    INNER JOIN tipodocident tdi ON pers.pers_tdi_id = tdi.tdi_id
	WHERE pac.pac_estado = _pac_estado
	    AND (pers.pers_nombre like _buscar
        or pers.pers_snombre like _buscar
	    or pers_ap_paterno LIKE _buscar
	    or pers_ap_materno LIKE  _buscar);
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_insert;
CREATE PROCEDURE pa_paciente_insert(
	OUT _pac_id int(11),
	IN _pac_pers_id int(11)
)
BEGIN
	INSERT INTO paciente (
		pac_pers_id,
		pac_fecha_reg,
		pac_estado
	)
	VALUES (
		_pac_pers_id,
		NOW(),
		1
	);
	SET _pac_id = LAST_INSERT_ID();
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_update;
CREATE PROCEDURE pa_paciente_update(
	IN _pac_id int(11),
	IN _pac_pers_id int(11)
)
BEGIN
	UPDATE paciente
	SET pac_pers_id = _pac_pers_id
	WHERE pac_id = _pac_id;
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_activate;
CREATE PROCEDURE pa_paciente_activate(
	IN _pac_id int(11)
)
BEGIN
	UPDATE paciente
	SET pac_estado = 1
	WHERE pac_id = _pac_id;
END $$

-- Tabla: paciente
-- DROP PROCEDURE IF EXISTS pa_paciente_delete;
CREATE PROCEDURE pa_paciente_delete(
	IN _pac_id int(11)
)
BEGIN
	UPDATE paciente
	SET pac_estado = 0
	WHERE pac_id = _pac_id;
END $$
