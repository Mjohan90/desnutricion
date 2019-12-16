DELIMITER $$

DROP TRIGGER IF EXISTS trg_rol_beforeInsert;
CREATE TRIGGER trg_rol_beforeInsert
BEFORE INSERT ON rol
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.rol_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre del rol no debe estar en blanco';
	END IF;
    IF NOT new.rol_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del rol solo puede contener letras';
    END IF;
	IF NOT DAYNAME(rol_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.rol_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.rol_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del rol solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_rol_beforeUpdate;
CREATE TRIGGER trg_rol_beforeUpdate
BEFORE UPDATE ON rol
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.rol_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del rol no debe estar en blanco';
    END IF;
    IF NOT new.rol_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del rol solo puede contener letras';
    END IF;
    IF NOT DAYNAME(rol_fecha_reg) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
    END IF;
    IF NOT new.rol_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.rol_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del rol solo puede contener los valores 0, 1';
    END IF;
END; $$