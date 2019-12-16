DELIMITER $$

DROP TRIGGER IF EXISTS trg_tipodocident_beforeInsert;
CREATE TRIGGER trg_tipodocident_beforeInsert
BEFORE INSERT ON tipodocident
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.tdi_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre del tipo de documento de identidad no debe estar en blanco';
	END IF;
    IF NOT new.tdi_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del tipo de documento de identidad solo puede contener letras';
    END IF;
	IF NOT length(trim(new.tdi_abrev)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'La abreviatura del tipo de documento de identidad no debe estar en blanco';
	END IF;
    IF NOT new.tdi_abrev REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La abreviatura del tipo de documento de identidad solo puede contener letras';
    END IF;
	IF NOT new.tdi_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.tdi_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del tipo documento de identidad solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_tipodocident_beforeUpdate;
CREATE TRIGGER trg_tipodocident_beforeUpdate
BEFORE UPDATE ON tipodocident
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.tdi_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del tipo de documento de identidad no debe estar en blanco';
    END IF;
    IF NOT new.tdi_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del tipo de documento de identidad solo puede contener letras';
    END IF;
    IF NOT length(trim(new.tdi_abrev)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La abreviatura del tipo de documento de identidad no debe estar en blanco';
    END IF;
    IF NOT new.tdi_abrev REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La abreviatura del tipo de documento de identidad solo puede contener letras';
    END IF;
    IF NOT new.tdi_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.tdi_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del tipo documento de identidad solo puede contener los valores 0, 1';
    END IF;
END; $$