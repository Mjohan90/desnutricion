DELIMITER $$

DROP TRIGGER IF EXISTS trg_direccion_beforeInsert;
CREATE TRIGGER trg_direccion_beforeInsert
BEFORE INSERT ON direccion
FOR EACH ROW
BEGIN
	IF NOT new.direc_pers_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona ID';
	END IF;
	IF NOT new.direc_ubig_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo ubigeo ID';
	END IF;
	IF NOT length(trim(new.direc_descripcion)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'La descripción de la dirección no debe estar en blanco';
	END IF;
	IF NOT DAYNAME(direc_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha reg debe ser una fecha válida';
	END IF;
	IF NOT new.direc_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.direc_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la dirección solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_direccion_beforeUpdate;
CREATE TRIGGER trg_direccion_beforeUpdate
BEFORE UPDATE ON direccion
FOR EACH ROW
BEGIN
	IF NOT new.direc_pers_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona ID';
	END IF;
	IF NOT new.direc_ubig_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo ubigeo ID';
	END IF;
	IF NOT length(trim(new.direc_descripcion)) > 0 THEN
		SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La descripción de la dirección no debe estar en blanco';
	END IF;
	IF NOT DAYNAME(direc_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha reg debe ser una fecha válida';
	END IF;
	IF NOT new.direc_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.direc_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la dirección solo puede contener los valores 0, 1';
	END IF;
END; $$