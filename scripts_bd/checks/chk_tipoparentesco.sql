DELIMITER $$

DROP TRIGGER IF EXISTS trg_tipoparentesco_beforeInsert;
CREATE TRIGGER trg_tipoparentesco_beforeInsert
BEFORE INSERT ON tipoparentesco
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.tparent_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre del tipo de parentesco no debe estar en blanco';
	END IF;
    IF NOT new.tparent_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del tipo de parentesco solo puede contener letras';
    END IF;
	IF NOT new.tparent_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.tparent_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del tipo de parentesco solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_tipoparentesco_beforeUpdate;
CREATE TRIGGER trg_tipoparentesco_beforeUpdate
BEFORE UPDATE ON tipoparentesco
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.tparent_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del tipo de parentesco no debe estar en blanco';
    END IF;
    IF NOT new.tparent_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del tipo de parentesco solo puede contener letras';
    END IF;
    IF NOT new.tparent_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.tparent_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del tipo de parentesco solo puede contener los valores 0, 1';
    END IF;
END; $$