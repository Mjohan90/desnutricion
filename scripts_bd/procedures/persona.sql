DELIMITER $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_getRow;
CREATE PROCEDURE pa_persona_getRow(
	IN _pers_id int(11)
)
BEGIN
	SELECT pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno, tdi_id,
		   tdi_nombre, tdi_abrev, pers_tdi_nro, pers_sexo, pers_fecha_nac, pers_email,
		   pers_celular, pers_telefono, pers_estado
	FROM persona pers
		INNER JOIN tipodocident tdi ON pers.pers_tdi_id = tdi.tdi_id
	WHERE pers.pers_id = _pers_id;
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_getByID;
CREATE PROCEDURE pa_persona_getByID(
	IN _pers_id int(11)
)
BEGIN
	SELECT pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno, tdi_id,
		   tdi_nombre, tdi_abrev, pers_tdi_nro, pers_sexo, pers_fecha_nac, pers_email,
		   pers_celular, pers_telefono, pers_estado
	FROM persona pers
		INNER JOIN tipodocident tdi ON pers.pers_tdi_id = tdi.tdi_id
	WHERE pers.pers_id = _pers_id;
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_listcbo;
CREATE PROCEDURE pa_persona_listcbo(
	IN _pers_id int(11)
)
BEGIN
	SELECT pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno, tdi_id,
		   tdi_nombre, tdi_abrev, pers_tdi_nro, pers_sexo, pers_fecha_nac, pers_email,
		   pers_celular, pers_telefono, pers_estado
	FROM persona pers
		INNER JOIN tipodocident tdi ON pers.pers_tdi_id = tdi.tdi_id
	WHERE pers.pers_estado = 1 OR (pers.pers_id = _pers_id);
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_list;
CREATE PROCEDURE pa_persona_list(
	IN _buscar varchar(50),
	IN _pers_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno, tdi_id,
		   tdi_nombre, tdi_abrev, pers_tdi_nro, pers_sexo, pers_fecha_nac, pers_email,
		   pers_celular, pers_telefono, pers_estado
	FROM persona pers
		INNER JOIN tipodocident tdi ON pers.pers_tdi_id = tdi.tdi_id
	WHERE pers.pers_estado = _pers_estado
	  AND (pers.pers_nombre LIKE _buscar
		OR pers.pers_snombre LIKE _buscar
		OR pers.pers_ap_paterno LIKE _buscar
		OR pers.pers_ap_materno LIKE _buscar);
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_insert;
CREATE PROCEDURE pa_persona_insert(
	OUT _pers_id int(11),
	IN _pers_nombre varchar(30),
	IN _pers_snombre varchar(30),
	IN _pers_ap_paterno varchar(30),
	IN _pers_ap_materno varchar(30),
	IN _pers_tdi_id int(11),
	IN _pers_tdi_nro varchar(20),
	IN _pers_sexo char(1),
	IN _pers_fecha_nac datetime,
	IN _pers_email varchar(20),
	IN _pers_celular varchar(20),
	IN _pers_telefono varchar(20)
)
BEGIN
	INSERT INTO persona (
		pers_nombre,
		pers_snombre,
		pers_ap_paterno,
		pers_ap_materno,
		pers_tdi_id,
		pers_tdi_nro,
		pers_sexo,
		pers_fecha_nac,
		pers_email,
		pers_celular,
		pers_telefono,
		pers_estado
	)
	VALUES (
		_pers_nombre,
		_pers_snombre,
		_pers_ap_paterno,
		_pers_ap_materno,
		_pers_tdi_id,
		_pers_tdi_nro,
		_pers_sexo,
		_pers_fecha_nac,
		_pers_email,
		_pers_celular,
		_pers_telefono,
		1
	);
	SET _pers_id = LAST_INSERT_ID();
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_update;
CREATE PROCEDURE pa_persona_update(
	IN _pers_id int(11),
	IN _pers_nombre varchar(30),
	IN _pers_snombre varchar(30),
	IN _pers_ap_paterno varchar(30),
	IN _pers_ap_materno varchar(30),
	IN _pers_tdi_id int(11),
	IN _pers_tdi_nro varchar(20),
	IN _pers_sexo char(1),
	IN _pers_fecha_nac datetime,
	IN _pers_email varchar(20),
	IN _pers_celular varchar(20),
	IN _pers_telefono varchar(20)
)
BEGIN
	UPDATE persona
	SET pers_nombre = _pers_nombre,
		pers_snombre = _pers_snombre,
		pers_ap_paterno = _pers_ap_paterno,
		pers_ap_materno = _pers_ap_materno,
		pers_tdi_id = _pers_tdi_id,
		pers_tdi_nro = _pers_tdi_nro,
		pers_sexo = _pers_sexo,
		pers_fecha_nac = _pers_fecha_nac,
		pers_email = _pers_email,
		pers_celular = _pers_celular,
		pers_telefono = _pers_telefono
	WHERE pers_id = _pers_id;
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_activate;
CREATE PROCEDURE pa_persona_activate(
	IN _pers_id int(11)
)
BEGIN
	UPDATE persona
	SET pers_estado = 1
	WHERE pers_id = _pers_id;
END $$

-- Tabla: persona
-- DROP PROCEDURE IF EXISTS pa_persona_delete;
CREATE PROCEDURE pa_persona_delete(
	IN _pers_id int(11)
)
BEGIN
	UPDATE persona
	SET pers_estado = 0
	WHERE pers_id = _pers_id;
END $$
