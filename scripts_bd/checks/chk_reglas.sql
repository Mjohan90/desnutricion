DELIMITER $$

DROP TRIGGER IF EXISTS trg_reglas_beforeInsert;
CREATE TRIGGER trg_reglas_beforeInsert
BEFORE INSERT ON reglas
FOR EACH ROW
BEGIN
	IF NOT new.regla_indic1_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo indicador 1 ID';
	END IF;
	IF NOT new.regla_indic2_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo indicador 2 ID';
	END IF;
	IF NOT length(trim(new.regla_formula)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo formula no debe estar en blanco';
	END IF;
	IF NOT new.regla_diag_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo diagnostico ID';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_reglas_beforeUpdate;
CREATE TRIGGER trg_reglas_beforeUpdate
BEFORE UPDATE ON reglas
FOR EACH ROW
BEGIN
    IF NOT new.regla_indic1_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo indicador 1 ID';
    END IF;
    IF NOT new.regla_indic2_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo indicador 2 ID';
    END IF;
    IF NOT length(trim(new.regla_formula)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo formula no debe estar en blanco';
    END IF;
    IF NOT new.regla_diag_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo diagnostico ID';
    END IF;
END; $$