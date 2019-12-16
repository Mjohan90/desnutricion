DELIMITER $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_getRow;
CREATE PROCEDURE pa_ubigeo_getRow(
	IN _ubig_id int(11)
)
BEGIN
	SELECT ubig_id, ubig_cod, ubig_dpto_cod, ubig_prov_cod, ubig_dist_cod, ubig_nombre,
		   ubig_estado
	FROM ubigeo ubig
	WHERE ubig.ubig_id = _ubig_id;
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_getByID;
CREATE PROCEDURE pa_ubigeo_getByID(
	IN _ubig_id int(11)
)
BEGIN
	SELECT ubig_id, ubig_cod, ubig_dpto_cod, ubig_prov_cod, ubig_dist_cod, ubig_nombre,
		   ubig_estado
	FROM ubigeo ubig
	WHERE ubig.ubig_id = _ubig_id;
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_listcbo;
CREATE PROCEDURE pa_ubigeo_listcbo(
	IN _ubig_id int(11)
)
BEGIN
	SELECT ubig_id, ubig_cod, ubig_dpto_cod, ubig_prov_cod, ubig_dist_cod, ubig_nombre,
		   ubig_estado
	FROM ubigeo ubig
	WHERE ubig.ubig_estado = 1 OR (ubig.ubig_id = _ubig_id);
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_list;
CREATE PROCEDURE pa_ubigeo_list(
	IN _buscar varchar(50),
	IN _ubig_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT ubig_id, ubig_cod, ubig_dpto_cod, ubig_prov_cod, ubig_dist_cod, ubig_nombre,
		   ubig_estado
	FROM ubigeo ubig
	WHERE ubig.ubig_estado = _ubig_estado
	  AND (ubig.ubig_nombre LIKE _buscar);
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_insert;
CREATE PROCEDURE pa_ubigeo_insert(
	OUT _ubig_id int(11),
	IN _ubig_cod char(6),
	IN _ubig_dpto_cod int(11),
	IN _ubig_prov_cod int(11),
	IN _ubig_dist_cod int(11),
	IN _ubig_nombre varchar(100)
)
BEGIN
	INSERT INTO ubigeo (
		ubig_cod,
		ubig_dpto_cod,
		ubig_prov_cod,
		ubig_dist_cod,
		ubig_nombre,
		ubig_estado
	)
	VALUES (
		_ubig_cod,
		_ubig_dpto_cod,
		_ubig_prov_cod,
		_ubig_dist_cod,
		_ubig_nombre,
		1
	);
	SET _ubig_id = LAST_INSERT_ID();
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_update;
CREATE PROCEDURE pa_ubigeo_update(
	IN _ubig_id int(11),
	IN _ubig_cod char(6),
	IN _ubig_dpto_cod int(11),
	IN _ubig_prov_cod int(11),
	IN _ubig_dist_cod int(11),
	IN _ubig_nombre varchar(100)
)
BEGIN
	UPDATE ubigeo
	SET ubig_cod = _ubig_cod,
		ubig_dpto_cod = _ubig_dpto_cod,
		ubig_prov_cod = _ubig_prov_cod,
		ubig_dist_cod = _ubig_dist_cod,
		ubig_nombre = _ubig_nombre
	WHERE ubig_id = _ubig_id;
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_activate;
CREATE PROCEDURE pa_ubigeo_activate(
	IN _ubig_id int(11)
)
BEGIN
	UPDATE ubigeo
	SET ubig_estado = 1
	WHERE ubig_id = _ubig_id;
END $$

-- Tabla: ubigeo
-- DROP PROCEDURE IF EXISTS pa_ubigeo_delete;
CREATE PROCEDURE pa_ubigeo_delete(
	IN _ubig_id int(11)
)
BEGIN
	UPDATE ubigeo
	SET ubig_estado = 0
	WHERE ubig_id = _ubig_id;
END $$
