DELIMITER $$

DROP TRIGGER trg_categvariable_beforeInsert;
CREATE TRIGGER trg_categvariable_beforeInsert
BEFORE INSERT ON categvariable
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.catvar_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre de la categoría de variable no debe estar en blanco';
	END IF;
	IF NOT new.catvar_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la categoría de variable solo puede contener letras A-Z';
    END IF;
	IF NOT new.catvar_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
	END IF;
	IF NOT new.catvar_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la categoría de variable solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER trg_categvariable_beforeUpdate;
CREATE TRIGGER trg_categvariable_beforeUpdate
BEFORE UPDATE ON categvariable
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.catvar_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la categoría de variable no debe estar en blanco';
    END IF;
    IF NOT new.catvar_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre de la categoría de variable solo puede contener letras A-Z';
    END IF;
    IF NOT new.catvar_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
    END IF;
    IF NOT new.catvar_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la categoría de variable solo puede contener los valores 0, 1';
    END IF;
END; $$