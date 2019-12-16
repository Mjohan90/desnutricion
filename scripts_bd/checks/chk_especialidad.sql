DELIMITER $$

DROP TRIGGER IF EXISTS trg_especialidad_beforeInsert;
CREATE TRIGGER trg_especialidad_beforeInsert
BEFORE INSERT ON especialidad
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.espec_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre de la especialidad no debe estar en blanco';
	END IF;
    IF NOT new.espec_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la especialidad solo puede contener letras';
    END IF;
	IF NOT new.espec_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.espec_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la especialidad solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_especialidad_beforeUpdate;
CREATE TRIGGER trg_especialidad_beforeUpdate
BEFORE UPDATE ON especialidad
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.espec_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la especialidad no debe estar en blanco';
    END IF;
    IF NOT new.espec_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la especialidad solo puede contener letras';
    END IF;
    IF NOT new.espec_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.espec_estado IN (0, 1)  THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la especialidad solo puede contener los valores 0, 1';
    END IF;
END; $$