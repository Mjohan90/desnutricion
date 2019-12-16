DELIMITER $$

DROP TRIGGER trg_cargo_beforeInsert;
CREATE TRIGGER trg_cargo_beforeInsert
BEFORE INSERT ON cargo
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.carg_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
	END IF;
	IF NOT new.carg_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre solo debe contener letraz A-Z';
	END IF;
	IF NOT new.carg_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
	END IF;
	IF NOT new.carg_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del cargo solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER trg_cargo_beforeUpdate;
CREATE TRIGGER trg_cargo_beforeUpdate
BEFORE UPDATE ON cargo
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.carg_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
    END IF;
    IF NOT new.carg_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo nombre solo debe contener letraz A-Z';
    END IF;
    IF NOT new.carg_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
    END IF;
    IF NOT new.carg_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del cargo solo puede contener los valores 0, 1';
    END IF;
END; $$