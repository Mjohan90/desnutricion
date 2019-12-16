DELIMITER $$

DROP TRIGGER IF EXISTS trg_historiaclinica_beforeInsert;
CREATE TRIGGER trg_historiaclinica_beforeInsert
BEFORE INSERT ON historiaclinica
FOR EACH ROW
BEGIN
	IF NOT new.hc_pac_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo paciente ID';
	END IF;
	IF NOT DAYNAME(hc_fecha_suceso) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha suceso debe ser una fecha válida';
	END IF;
    IF NOT hc_fecha_suceso <= NOW() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El valor de fecha suceso no puede ser mayor a la fecha de hoy';
    END IF;
	IF NOT length(trim(new.hc_comentario)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo comentario no debe estar en blanco';
	END IF;
	IF NOT new.hc_atenc_id_ref > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo atencion ID referencial debe ser mayor a cero';
	END IF;
	IF NOT DAYNAME(hc_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.hc_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.hc_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la historia clínica solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_historiaclinica_beforeUpdate;
CREATE TRIGGER trg_historiaclinica_beforeUpdate
BEFORE UPDATE ON historiaclinica
FOR EACH ROW
BEGIN
    IF NOT new.hc_pac_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo paciente ID';
    END IF;
    IF NOT DAYNAME(hc_fecha_suceso) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha suceso debe ser una fecha válida';
    END IF;
    IF NOT hc_fecha_suceso <= NOW() THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha suceso no puede ser mayor a la fecha de hoy';
    END IF;
    IF NOT length(trim(new.hc_comentario)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo comentario no debe estar en blanco';
    END IF;
    IF NOT new.hc_atenc_id_ref > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo atencion ID referencial debe ser mayor a cero';
    END IF;
    IF NOT DAYNAME(hc_fecha_reg) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
    END IF;
    IF NOT new.hc_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.hc_estado IN (0, 1)  THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la historia clínica solo puede contener los valores 0, 1';
    END IF;
END; $$