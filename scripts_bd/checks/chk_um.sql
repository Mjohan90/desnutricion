DELIMITER $$

DROP TRIGGER IF EXISTS trg_um_beforeInsert;
CREATE TRIGGER trg_um_beforeInsert
BEFORE INSERT ON um
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.um_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
	END IF;
	IF NOT length(trim(new.um_abrev)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo abrev no debe estar en blanco';
	END IF;
	IF NOT new.um_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.um_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la unidad de medida solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_um_beforeUpdate;
CREATE TRIGGER trg_um_beforeUpdate
BEFORE UPDATE ON um
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.um_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
	END IF;
	IF NOT length(trim(new.um_abrev)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo abrev no debe estar en blanco';
	END IF;
	IF NOT new.um_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.um_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la unidad de medida solo puede contener los valores 0, 1';
	END IF;
END; $$