DELIMITER $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_getRow;
CREATE PROCEDURE pa_atencion_getRow(
	IN _atenc_id int(11)
)
BEGIN
	SELECT atenc_id, pac_id, empl_id, espec_id, espec_nombre, atenc_fecha_atenc, atenc_observacion,
		   atenc_tratamiento, atenc_dieta, atenc_situacion, atenc_registra_id,
		   atenc_fecha_reg, atenc_estado
	FROM atencion atenc
		INNER JOIN empleado empl ON atenc.atenc_medico_id = empl.empl_id
		INNER JOIN especialidad espec ON atenc.atenc_espec_id = espec.espec_id
		INNER JOIN paciente pac ON atenc.atenc_pac_id = pac.pac_id
	WHERE atenc.atenc_id = _atenc_id;
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_getByID;
CREATE PROCEDURE pa_atencion_getByID(
	IN _atenc_id int(11)
)
BEGIN
	SELECT atenc_id, pac_id, empl_id, espec_id, espec_nombre, atenc_fecha_atenc, atenc_observacion,
		   atenc_tratamiento, atenc_dieta, atenc_situacion, atenc_registra_id,
		   atenc_fecha_reg, atenc_estado
	FROM atencion atenc
		INNER JOIN empleado empl ON atenc.atenc_medico_id = empl.empl_id
		INNER JOIN especialidad espec ON atenc.atenc_espec_id = espec.espec_id
		INNER JOIN paciente pac ON atenc.atenc_pac_id = pac.pac_id
	WHERE atenc.atenc_id = _atenc_id;
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_listcbo;
CREATE PROCEDURE pa_atencion_listcbo(
	IN _atenc_id int(11)
)
BEGIN
	SELECT atenc_id, pac_id, empl_id, espec_id, espec_nombre, atenc_fecha_atenc, atenc_observacion,
		   atenc_tratamiento, atenc_dieta, atenc_situacion, atenc_registra_id,
		   atenc_fecha_reg, atenc_estado
	FROM atencion atenc
		INNER JOIN empleado empl ON atenc.atenc_medico_id = empl.empl_id
		INNER JOIN especialidad espec ON atenc.atenc_espec_id = espec.espec_id
		INNER JOIN paciente pac ON atenc.atenc_pac_id = pac.pac_id
	WHERE atenc.atenc_estado = 1 OR (atenc.atenc_id = _atenc_id);
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_list;
CREATE PROCEDURE pa_atencion_list(
	IN _buscar varchar(50),
	IN _atenc_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT atenc_id, pac_id, empl_id, espec_id, espec_nombre, atenc_fecha_atenc, atenc_observacion,
		   atenc_tratamiento, atenc_dieta, atenc_situacion, atenc_registra_id,
		   atenc_fecha_reg, atenc_estado
	FROM atencion atenc
		INNER JOIN empleado empl ON atenc.atenc_medico_id = empl.empl_id
		INNER JOIN especialidad espec ON atenc.atenc_espec_id = espec.espec_id
		INNER JOIN paciente pac ON atenc.atenc_pac_id = pac.pac_id
	WHERE atenc.atenc_estado = _atenc_estado;
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_insert;
CREATE PROCEDURE pa_atencion_insert(
	OUT _atenc_id int(11),
	IN _atenc_pac_id int(11),
	IN _atenc_medico_id int(11),
	IN _atenc_espec_id int(11),
	IN _atenc_fecha_atenc datetime,
	IN _atenc_observacion varchar(400),
	IN _atenc_tratamiento varchar(400),
	IN _atenc_dieta varchar(300),
	IN _atenc_situacion tinyint(4) unsigned,
	IN _atenc_registra_id int(11)
)
BEGIN
	INSERT INTO atencion (
		atenc_pac_id,
		atenc_medico_id,
		atenc_espec_id,
		atenc_fecha_atenc,
		atenc_observacion,
		atenc_tratamiento,
		atenc_dieta,
		atenc_situacion,
		atenc_registra_id,
		atenc_fecha_reg,
		atenc_estado
	)
	VALUES (
		_atenc_pac_id,
		_atenc_medico_id,
		_atenc_espec_id,
		_atenc_fecha_atenc,
		_atenc_observacion,
		_atenc_tratamiento,
		_atenc_dieta,
		1,
		_atenc_registra_id,
		NOW(),
		1
	);
	SET _atenc_id = LAST_INSERT_ID();
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_update;
CREATE PROCEDURE pa_atencion_update(
	IN _atenc_id int(11),
	IN _atenc_pac_id int(11),
	IN _atenc_medico_id int(11),
	IN _atenc_espec_id int(11),
	IN _atenc_fecha_atenc datetime,
	IN _atenc_observacion varchar(400),
	IN _atenc_tratamiento varchar(400),
	IN _atenc_dieta varchar(300),
	IN _atenc_situacion tinyint(4) unsigned
)
BEGIN
	UPDATE atencion
	SET atenc_pac_id = _atenc_pac_id,
		atenc_medico_id = _atenc_medico_id,
		atenc_espec_id = _atenc_espec_id,
		atenc_fecha_atenc = _atenc_fecha_atenc,
		atenc_observacion = _atenc_observacion,
		atenc_tratamiento = _atenc_tratamiento,
		atenc_dieta = _atenc_dieta,
		atenc_situacion = _atenc_situacion
	WHERE atenc_id = _atenc_id;
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_activate;
CREATE PROCEDURE pa_atencion_activate(
	IN _atenc_id int(11)
)
BEGIN
	UPDATE atencion
	SET atenc_estado = 1
	WHERE atenc_id = _atenc_id;
END $$

-- Tabla: atencion
-- DROP PROCEDURE IF EXISTS pa_atencion_delete;
CREATE PROCEDURE pa_atencion_delete(
	IN _atenc_id int(11)
)
BEGIN
	UPDATE atencion
	SET atenc_estado = 0
	WHERE atenc_id = _atenc_id;
END $$
