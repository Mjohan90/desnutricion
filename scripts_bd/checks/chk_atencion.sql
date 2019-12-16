DELIMITER $$

DROP TRIGGER trg_atencion_beforeInsert;
CREATE TRIGGER trg_atencion_beforeInsert
BEFORE INSERT ON atencion
FOR EACH ROW
BEGIN
	IF NOT new.atenc_pac_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo paciente ID';
	END IF;
	IF NOT new.atenc_medico_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo medico ID';
	END IF;
	IF NOT new.atenc_espec_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo especialidad ID';
	END IF;
	IF NOT DAYNAME(atenc_fecha_atenc) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha atención debe ser una fecha válida';
	END IF;
#   IF NOT length(trim(new.atenc_observacion)) > 0 THEN
#    	SIGNAL SQLSTATE '45000'
#    	SET MESSAGE_TEXT = 'El campo observación no debe estar en blanco';
#   END IF;
#   IF NOT length(trim(new.atenc_tratamiento)) > 0 THEN
#    	SIGNAL SQLSTATE '45000'
#    	SET MESSAGE_TEXT = 'El campo tratamiento no debe estar en blanco';
#   END IF;
#   IF NOT length(trim(new.atenc_dieta)) > 0 THEN
#    	SIGNAL SQLSTATE '45000'
#    	SET MESSAGE_TEXT = 'El campo dieta no debe estar en blanco';
#   END IF;
	IF NOT new.atenc_situacion > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo situación debe ser mayor a cero';
	END IF;
	IF NOT new.atenc_situacion IN (1, 2) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'La situacion de la atención solo puede contener los valores 1, 2';
	END IF;
	IF NOT new.atenc_registra_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese el código del usuario que registra los datos';
	END IF;
	IF NOT DAYNAME(atenc_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.atenc_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
	END IF;
	IF NOT new.atenc_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la atención solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER trg_atencion_beforeUpdate;
CREATE TRIGGER trg_atencion_beforeUpdate
BEFORE UPDATE ON atencion
FOR EACH ROW
BEGIN
    IF NOT new.atenc_pac_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo paciente ID';
    END IF;
    IF NOT new.atenc_medico_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo medico ID';
    END IF;
    IF NOT new.atenc_espec_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo especialidad ID';
    END IF;
    IF NOT DAYNAME(atenc_fecha_atenc) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha atención debe ser una fecha válida';
    END IF;
#     IF NOT length(trim(new.atenc_observacion)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo observación no debe estar en blanco';
#     END IF;
#     IF NOT length(trim(new.atenc_tratamiento)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo tratamiento no debe estar en blanco';
#     END IF;
#     IF NOT length(trim(new.atenc_dieta)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo dieta no debe estar en blanco';
#     END IF;
    IF NOT new.atenc_situacion > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo situación debe ser mayor a cero';
    END IF;
    IF NOT new.atenc_situacion IN (1, 2) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La situacion de la atención solo puede contener los valores 1, 2';
    END IF;
    IF NOT new.atenc_registra_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese el código del usuario que registra los datos';
    END IF;
    IF NOT DAYNAME(atenc_fecha_reg) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
    END IF;
    IF NOT new.atenc_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor o igual a cero';
    END IF;
    IF NOT new.atenc_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la atención solo puede contener los valores 0, 1';
    END IF;
END; $$