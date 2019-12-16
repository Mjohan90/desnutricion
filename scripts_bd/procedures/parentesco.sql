DELIMITER $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_getRow;
CREATE PROCEDURE pa_parentesco_getRow(
	IN _parent_id int(11)
)
BEGIN
	SELECT parent_id, pers1.pers_id as pers1_id, pers1.pers_nombre as pers1_nombre,
		   pers1.pers_snombre as pers1_snombre, pers1.pers_ap_paterno as pers1_ap_paterno,
		   pers1.pers_ap_materno as pers1_ap_materno, pers2.pers_id as pers2_id,
		   pers2.pers_nombre as pers2_nombre, pers2.pers_snombre as pers2_snombre,
		   pers2.pers_ap_paterno as pers2_ap_paterno, pers2.pers_ap_materno as pers2_ap_materno,
		   tparent_id, tparent_nombre, parent_es_apoderado, parent_estado
	FROM parentesco parent
		INNER JOIN persona pers1 ON parent.parent_pers1_id = pers1.pers_id
		INNER JOIN persona pers2 ON parent.parent_pers2_id = pers2.pers_id
		INNER JOIN tipoparentesco tparent ON parent.parent_tparent_id = tparent.tparent_id
	WHERE parent.parent_id = _parent_id;
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_getByID;
CREATE PROCEDURE pa_parentesco_getByID(
	IN _parent_id int(11)
)
BEGIN
	SELECT parent_id, pers1.pers_id as pers1_id, pers1.pers_nombre as pers1_nombre,
		   pers1.pers_snombre as pers1_snombre, pers1.pers_ap_paterno as pers1_ap_paterno,
		   pers1.pers_ap_materno as pers1_ap_materno, pers2.pers_id as pers2_id,
		   pers2.pers_nombre as pers2_nombre, pers2.pers_snombre as pers2_snombre,
		   pers2.pers_ap_paterno as pers2_ap_paterno, pers2.pers_ap_materno as pers2_ap_materno,
		   tparent_id, tparent_nombre, parent_es_apoderado, parent_estado
	FROM parentesco parent
		INNER JOIN persona pers1 ON parent.parent_pers1_id = pers1.pers_id
		INNER JOIN persona pers2 ON parent.parent_pers2_id = pers2.pers_id
		INNER JOIN tipoparentesco tparent ON parent.parent_tparent_id = tparent.tparent_id
	WHERE parent.parent_id = _parent_id;
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_listcbo;
CREATE PROCEDURE pa_parentesco_listcbo(
	IN _parent_id int(11)
)
BEGIN
	SELECT parent_id, pers1.pers_id as pers1_id, pers1.pers_nombre as pers1_nombre,
		   pers1.pers_snombre as pers1_snombre, pers1.pers_ap_paterno as pers1_ap_paterno,
		   pers1.pers_ap_materno as pers1_ap_materno, pers2.pers_id as pers2_id,
		   pers2.pers_nombre as pers2_nombre, pers2.pers_snombre as pers2_snombre,
		   pers2.pers_ap_paterno as pers2_ap_paterno, pers2.pers_ap_materno as pers2_ap_materno,
		   tparent_id, tparent_nombre, parent_es_apoderado, parent_estado
	FROM parentesco parent
		INNER JOIN persona pers1 ON parent.parent_pers1_id = pers1.pers_id
		INNER JOIN persona pers2 ON parent.parent_pers2_id = pers2.pers_id
		INNER JOIN tipoparentesco tparent ON parent.parent_tparent_id = tparent.tparent_id
	WHERE parent.parent_estado = 1 OR (parent.parent_id = _parent_id);
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_list;
CREATE PROCEDURE pa_parentesco_list(
	IN _buscar varchar(50),
	IN _parent_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT parent_id, pers1.pers_id as pers1_id, pers1.pers_nombre as pers1_nombre,
		   pers1.pers_snombre as pers1_snombre, pers1.pers_ap_paterno as pers1_ap_paterno,
		   pers1.pers_ap_materno as pers1_ap_materno, pers2.pers_id as pers2_id,
		   pers2.pers_nombre as pers2_nombre, pers2.pers_snombre as pers2_snombre,
		   pers2.pers_ap_paterno as pers2_ap_paterno, pers2.pers_ap_materno as pers2_ap_materno,
		   tparent_id, tparent_nombre, parent_es_apoderado, parent_estado
	FROM parentesco parent
		INNER JOIN persona pers1 ON parent.parent_pers1_id = pers1.pers_id
		INNER JOIN persona pers2 ON parent.parent_pers2_id = pers2.pers_id
		INNER JOIN tipoparentesco tparent ON parent.parent_tparent_id = tparent.tparent_id
	WHERE parent.parent_estado = _parent_estado;
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_insert;
CREATE PROCEDURE pa_parentesco_insert(
	OUT _parent_id int(11),
	IN _parent_pers1_id int(11),
	IN _parent_pers2_id int(11),
	IN _parent_tparent_id int(11),
	IN _parent_es_apoderado tinyint(4) unsigned
)
BEGIN
	INSERT INTO parentesco (
		parent_pers1_id,
		parent_pers2_id,
		parent_tparent_id,
		parent_es_apoderado,
		parent_estado
	)
	VALUES (
		_parent_pers1_id,
		_parent_pers2_id,
		_parent_tparent_id,
		_parent_es_apoderado,
		1
	);
	SET _parent_id = LAST_INSERT_ID();
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_update;
CREATE PROCEDURE pa_parentesco_update(
	IN _parent_id int(11),
	IN _parent_pers1_id int(11),
	IN _parent_pers2_id int(11),
	IN _parent_tparent_id int(11),
	IN _parent_es_apoderado tinyint(4) unsigned
)
BEGIN
	UPDATE parentesco
	SET parent_pers1_id = _parent_pers1_id,
		parent_pers2_id = _parent_pers2_id,
		parent_tparent_id = _parent_tparent_id,
		parent_es_apoderado = _parent_es_apoderado
	WHERE parent_id = _parent_id;
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_activate;
CREATE PROCEDURE pa_parentesco_activate(
	IN _parent_id int(11)
)
BEGIN
	UPDATE parentesco
	SET parent_estado = 1
	WHERE parent_id = _parent_id;
END $$

-- Tabla: parentesco
-- DROP PROCEDURE IF EXISTS pa_parentesco_delete;
CREATE PROCEDURE pa_parentesco_delete(
	IN _parent_id int(11)
)
BEGIN
	UPDATE parentesco
	SET parent_estado = 0
	WHERE parent_id = _parent_id;
END $$
