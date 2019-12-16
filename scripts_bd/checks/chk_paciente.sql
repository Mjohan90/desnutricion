DELIMITER $$

DROP TRIGGER IF EXISTS trg_paciente_beforeInsert;
CREATE TRIGGER trg_paciente_beforeInsert
BEFORE INSERT ON paciente
FOR EACH ROW
BEGIN
	IF NOT new.pac_pers_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona ID';
	END IF;
	IF NOT DAYNAME(pac_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.pac_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.pac_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del paciente solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_paciente_beforeUpdate;
CREATE TRIGGER trg_paciente_beforeUpdate
BEFORE UPDATE ON paciente
FOR EACH ROW
BEGIN
	IF NOT new.pac_pers_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona ID';
	END IF;
	IF NOT DAYNAME(pac_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.pac_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.pac_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del paciente solo puede contener los valores 0, 1';
	END IF;
END; $$