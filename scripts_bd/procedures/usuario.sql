DELIMITER $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_login;
CREATE PROCEDURE pa_usuario_login(
    IN _usu_nombre varchar(20),
    IN _usu_contrasena varchar(32)
)
BEGIN
    SELECT usu_id, usu_nombre, empl_id, pers_id, pers_nombre, pers_ap_paterno, pers_ap_materno,
           rol_id, rol_nombre, usu_fecha_reg, usu_estado
    FROM usuario usu
        INNER JOIN empleado empl ON usu.usu_empl_id = empl.empl_id
        INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
        INNER JOIN rol rol ON usu.usu_rol_id = rol.rol_id
    WHERE usu.usu_nombre = _usu_nombre AND usu_contrasena = _usu_contrasena;
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_getRow;
CREATE PROCEDURE pa_usuario_getRow(
	IN _usu_id int(11)
)
BEGIN
	SELECT usu_id, usu_nombre, empl_id, rol_id, rol_nombre, usu_fecha_reg, usu_estado
	FROM usuario usu
		INNER JOIN empleado empl ON usu.usu_empl_id = empl.empl_id
		INNER JOIN rol rol ON usu.usu_rol_id = rol.rol_id
	WHERE usu.usu_id = _usu_id;
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_getByID;
CREATE PROCEDURE pa_usuario_getByID(
	IN _usu_id int(11)
)
BEGIN
	SELECT usu_id, usu_nombre, empl_id, rol_id, rol_nombre, usu_fecha_reg, usu_estado
	FROM usuario usu
		INNER JOIN empleado empl ON usu.usu_empl_id = empl.empl_id
		INNER JOIN rol rol ON usu.usu_rol_id = rol.rol_id
	WHERE usu.usu_id = _usu_id;
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_listcbo;
CREATE PROCEDURE pa_usuario_listcbo(
	IN _usu_id int(11)
)
BEGIN
	SELECT usu_id, usu_nombre, empl_id, rol_id, rol_nombre, usu_fecha_reg, usu_estado
	FROM usuario usu
		INNER JOIN empleado empl ON usu.usu_empl_id = empl.empl_id
		INNER JOIN rol rol ON usu.usu_rol_id = rol.rol_id
	WHERE usu.usu_estado = 1 OR (usu.usu_id = _usu_id);
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_list;
CREATE PROCEDURE pa_usuario_list(
	IN _buscar varchar(50),
	IN _usu_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT usu_id, usu_nombre, empl_id, rol_id, rol_nombre, usu_fecha_reg, usu_estado,
	       pers_nombre, pers_ap_paterno, pers_ap_materno
	FROM usuario usu
		INNER JOIN empleado empl ON usu.usu_empl_id = empl.empl_id
	    INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
		INNER JOIN rol rol ON usu.usu_rol_id = rol.rol_id
	WHERE usu.usu_estado in (1, 2)
	  AND (usu.usu_nombre LIKE _buscar
	    OR pers.pers_nombre LIKE  _buscar
        OR pers.pers_ap_paterno LIKE  _buscar
        OR pers.pers_ap_materno LIKE  _buscar
	  );
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_insert;
CREATE PROCEDURE pa_usuario_insert(
	OUT _usu_id int(11),
	IN _usu_nombre varchar(20),
	IN _usu_contrasena varchar(32),
	IN _usu_empl_id int(11),
	IN _usu_rol_id int(11)
)
BEGIN
	INSERT INTO usuario (
		usu_nombre,
		usu_contrasena,
		usu_empl_id,
		usu_rol_id,
		usu_fecha_reg,
		usu_estado
	)
	VALUES (
		_usu_nombre,
		_usu_contrasena,
		_usu_empl_id,
		_usu_rol_id,
		NOW(),
		1
	);
	SET _usu_id = LAST_INSERT_ID();
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_update;
CREATE PROCEDURE pa_usuario_update(
	IN _usu_id int(11),
	IN _usu_nombre varchar(20),
	IN _usu_contrasena varchar(32),
	IN _usu_empl_id int(11),
	IN _usu_rol_id int(11)
)
BEGIN
	UPDATE usuario
	SET usu_nombre = _usu_nombre,
		usu_contrasena = _usu_contrasena,
		usu_empl_id = _usu_empl_id,
		usu_rol_id = _usu_rol_id
	WHERE usu_id = _usu_id;
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_activate;
CREATE PROCEDURE pa_usuario_activate(
	IN _usu_id int(11)
)
BEGIN
	UPDATE usuario
	SET usu_estado = 1
	WHERE usu_id = _usu_id;
END $$

-- Tabla: usuario
-- DROP PROCEDURE IF EXISTS pa_usuario_delete;
CREATE PROCEDURE pa_usuario_delete(
	IN _usu_id int(11)
)
BEGIN
	UPDATE usuario
	SET usu_estado = 0
	WHERE usu_id = _usu_id;
END $$
