DELIMITER $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_getRow;
CREATE PROCEDURE pa_categvariable_getRow(
	IN _catvar_id int(11)
)
BEGIN
	SELECT catvar_id, catvar_nombre, catvar_estado
	FROM categvariable catvar
	WHERE catvar.catvar_id = _catvar_id;
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_getByID;
CREATE PROCEDURE pa_categvariable_getByID(
	IN _catvar_id int(11)
)
BEGIN
	SELECT catvar_id, catvar_nombre, catvar_estado
	FROM categvariable catvar
	WHERE catvar.catvar_id = _catvar_id;
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_listcbo;
CREATE PROCEDURE pa_categvariable_listcbo(
	IN _catvar_id int(11)
)
BEGIN
	SELECT catvar_id, catvar_nombre, catvar_estado
	FROM categvariable catvar
	WHERE catvar.catvar_estado = 1 OR (catvar.catvar_id = _catvar_id);
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_list;
CREATE PROCEDURE pa_categvariable_list(
	IN _buscar varchar(50),
	IN _catvar_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT catvar_id, catvar_nombre, catvar_estado
	FROM categvariable catvar
	WHERE catvar.catvar_estado = _catvar_estado
	  AND (catvar.catvar_nombre LIKE _buscar);
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_insert;
CREATE PROCEDURE pa_categvariable_insert(
	OUT _catvar_id int(11),
	IN _catvar_nombre varchar(50)
)
BEGIN
	INSERT INTO categvariable (
		catvar_nombre,
		catvar_estado
	)
	VALUES (
		_catvar_nombre,
		1
	);
	SET _catvar_id = LAST_INSERT_ID();
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_update;
CREATE PROCEDURE pa_categvariable_update(
	IN _catvar_id int(11),
	IN _catvar_nombre varchar(50)
)
BEGIN
	UPDATE categvariable
	SET catvar_nombre = _catvar_nombre
	WHERE catvar_id = _catvar_id;
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_activate;
CREATE PROCEDURE pa_categvariable_activate(
	IN _catvar_id int(11)
)
BEGIN
	UPDATE categvariable
	SET catvar_estado = 1
	WHERE catvar_id = _catvar_id;
END $$

-- Tabla: categvariable
-- DROP PROCEDURE IF EXISTS pa_categvariable_delete;
CREATE PROCEDURE pa_categvariable_delete(
	IN _catvar_id int(11)
)
BEGIN
	UPDATE categvariable
	SET catvar_estado = 0
	WHERE catvar_id = _catvar_id;
END $$
