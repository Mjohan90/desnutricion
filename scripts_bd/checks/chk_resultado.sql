DELIMITER $$

DROP TRIGGER IF EXISTS trg_resultado_beforeInsert;
CREATE TRIGGER trg_resultado_beforeInsert
BEFORE INSERT ON resultado
FOR EACH ROW
BEGIN
	IF NOT new.result_atenc_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo atencion ID';
	END IF;
	IF NOT new.result_diag_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo diagnostico ID';
	END IF;
	IF NOT DAYNAME(result_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_resultado_beforeUpdate;
CREATE TRIGGER trg_resultado_beforeUpdate
BEFORE UPDATE ON resultado
FOR EACH ROW
BEGIN
	IF NOT new.result_atenc_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo atencion ID';
	END IF;
	IF NOT new.result_diag_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo diagnostico ID';
	END IF;
	IF NOT DAYNAME(result_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
END; $$