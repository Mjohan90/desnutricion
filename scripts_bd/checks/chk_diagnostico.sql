DELIMITER $$

DROP TRIGGER trg_diagnostico_beforeInsert;
CREATE TRIGGER trg_diagnostico_beforeInsert
BEFORE INSERT ON diagnostico
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.diag_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
	END IF;
	IF NOT length(trim(new.diag_tratamiento_sug)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo tratamiento sugerido no debe estar en blanco';
	END IF;
	IF NOT length(trim(new.diag_dieta_sug)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo dieta sugerida no debe estar en blanco';
	END IF;
	IF NOT new.diag_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
	END IF;
	IF NOT new.diag_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del diagnóstico solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER trg_diagnostico_beforeUpdate;
CREATE TRIGGER trg_diagnostico_beforeUpdate
BEFORE UPDATE ON diagnostico
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.diag_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
    END IF;
    IF NOT length(trim(new.diag_tratamiento_sug)) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo tratamiento sugerido no debe estar en blanco';
    END IF;
    IF NOT length(trim(new.diag_dieta_sug)) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo dieta sugerida no debe estar en blanco';
    END IF;
    IF NOT new.diag_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
    END IF;
    IF NOT new.diag_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El estado del diagnóstico solo puede contener los valores 0, 1';
    END IF;
END; $$