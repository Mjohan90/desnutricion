DELIMITER $$

DROP TRIGGER IF EXISTS trg_empleado_beforeInsert;
CREATE TRIGGER trg_empleado_beforeInsert
BEFORE INSERT ON empleado
FOR EACH ROW
BEGIN
	IF NOT new.empl_pers_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona ID';
	END IF;
	IF NOT new.empl_carg_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo cargo ID';
	END IF;
	IF NOT DAYNAME(empl_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.empl_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.empl_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del empleado solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_empleado_beforeUpdate;
CREATE TRIGGER trg_empleado_beforeUpdate
BEFORE UPDATE ON empleado
FOR EACH ROW
BEGIN
	IF NOT new.empl_pers_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona ID';
	END IF;
	IF NOT new.empl_carg_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo cargo ID';
	END IF;
	IF NOT DAYNAME(empl_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.empl_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.empl_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del empleado solo puede contener los valores 0, 1';
	END IF;
END; $$