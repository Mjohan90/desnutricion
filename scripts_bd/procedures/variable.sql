DELIMITER $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_getRow;
CREATE PROCEDURE pa_variable_getRow(
	IN _var_id int(11)
)
BEGIN
	SELECT var_id, catvar_id, catvar_nombre, var_nombre, um_id, um_nombre, um_abrev, var_tipo_var,
		   var_estado
	FROM variable var
		INNER JOIN categvariable catvar ON var.var_catvar_id = catvar.catvar_id
		INNER JOIN um um ON var.var_um_id = um.um_id
	WHERE var.var_id = _var_id;
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_getByID;
CREATE PROCEDURE pa_variable_getByID(
	IN _var_id int(11)
)
BEGIN
	SELECT var_id, catvar_id, catvar_nombre, var_nombre, um_id, um_nombre, um_abrev, var_tipo_var,
		   var_estado
	FROM variable var
		INNER JOIN categvariable catvar ON var.var_catvar_id = catvar.catvar_id
		INNER JOIN um um ON var.var_um_id = um.um_id
	WHERE var.var_id = _var_id;
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_listcbo;
CREATE PROCEDURE pa_variable_listcbo(
	IN _var_id int(11)
)
BEGIN
	SELECT var_id, catvar_id, catvar_nombre, var_nombre, um_id, um_nombre, um_abrev, var_tipo_var,
		   var_estado
	FROM variable var
		INNER JOIN categvariable catvar ON var.var_catvar_id = catvar.catvar_id
		INNER JOIN um um ON var.var_um_id = um.um_id
	WHERE var.var_estado = 1 OR (var.var_id = _var_id);
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_list;
CREATE PROCEDURE pa_variable_list(
	IN _buscar varchar(50),
	IN _var_estado tinyint(4) unsigned
)
BEGIN
	SET @aux = _buscar;
	SET _buscar = IF(_buscar <> '', concat('%', replace(_buscar, ' ', '%'), '%'), '%');

	SELECT var_id, catvar_id, catvar_nombre, var_nombre, um_id, um_nombre, um_abrev, var_tipo_var,
		   var_estado
	FROM variable var
		INNER JOIN categvariable catvar ON var.var_catvar_id = catvar.catvar_id
		INNER JOIN um um ON var.var_um_id = um.um_id
	WHERE var.var_estado = _var_estado
	  AND (var.var_nombre LIKE _buscar);
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_insert;
CREATE PROCEDURE pa_variable_insert(
	OUT _var_id int(11),
	IN _var_catvar_id int(11),
	IN _var_nombre varchar(50),
	IN _var_um_id int(11),
	IN _var_tipo_var char(1)
)
BEGIN
	INSERT INTO variable (
		var_catvar_id,
		var_nombre,
		var_um_id,
		var_tipo_var,
		var_estado
	)
	VALUES (
		_var_catvar_id,
		_var_nombre,
		_var_um_id,
		_var_tipo_var,
		1
	);
	SET _var_id = LAST_INSERT_ID();
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_update;
CREATE PROCEDURE pa_variable_update(
	IN _var_id int(11),
	IN _var_catvar_id int(11),
	IN _var_nombre varchar(50),
	IN _var_um_id int(11),
	IN _var_tipo_var char(1)
)
BEGIN
	UPDATE variable
	SET var_catvar_id = _var_catvar_id,
		var_nombre = _var_nombre,
		var_um_id = _var_um_id,
		var_tipo_var = _var_tipo_var
	WHERE var_id = _var_id;
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_activate;
CREATE PROCEDURE pa_variable_activate(
	IN _var_id int(11)
)
BEGIN
	UPDATE variable
	SET var_estado = 1
	WHERE var_id = _var_id;
END $$

-- Tabla: variable
-- DROP PROCEDURE IF EXISTS pa_variable_delete;
CREATE PROCEDURE pa_variable_delete(
	IN _var_id int(11)
)
BEGIN
	UPDATE variable
	SET var_estado = 0
	WHERE var_id = _var_id;
END $$
