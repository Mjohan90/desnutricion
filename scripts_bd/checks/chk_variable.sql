DELIMITER $$

DROP TRIGGER IF EXISTS trg_variable_beforeInsert;
CREATE TRIGGER trg_variable_beforeInsert
BEFORE INSERT ON variable
FOR EACH ROW
BEGIN
	IF NOT new.var_catvar_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo categvariable ID';
	END IF;
	IF NOT length(trim(new.var_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre de la variable no debe estar en blanco';
	END IF;
	IF NOT new.var_um_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo um ID';
	END IF;
	IF NOT length(trim(new.var_tipo_var)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El tipo de variable no debe estar en blanco';
	END IF;
    IF NOT new.var_tipo_var IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El tipo de variable solo puede contener los valores 1, 2';
    END IF;
	IF NOT new.var_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.var_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la variable solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_variable_beforeUpdate;
CREATE TRIGGER trg_variable_beforeUpdate
BEFORE UPDATE ON variable
FOR EACH ROW
BEGIN
    IF NOT new.var_catvar_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo categvariable ID';
    END IF;
    IF NOT length(trim(new.var_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la variable no debe estar en blanco';
    END IF;
    IF NOT new.var_um_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo um ID';
    END IF;
    IF NOT length(trim(new.var_tipo_var)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El tipo de variable no debe estar en blanco';
    END IF;
    IF NOT new.var_tipo_var IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El tipo de variable solo puede contener los valores 1, 2';
    END IF;
    IF NOT new.var_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.var_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la variable solo puede contener los valores 0, 1';
    END IF;
END; $$