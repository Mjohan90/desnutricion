DELIMITER $$

DROP TRIGGER IF EXISTS trg_persona_beforeInsert;
CREATE TRIGGER trg_persona_beforeInsert
BEFORE INSERT ON persona
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.pers_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
	END IF;
	IF NOT new.pers_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre solo puede contener letras';
	END IF;
# 	IF NOT length(trim(new.pers_snombre)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El snombre no debe estar en blanco';
# 	END IF;
	IF (length(trim(new.pers_snombre)) > 0 AND NOT new.pers_snombre REGEXP '^[[:alpha:]_ ]+$') THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El segundo nombre solo puede contener letras';
	END IF;
	IF NOT length(trim(new.pers_ap_paterno)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo apellido paterno no debe estar en blanco';
	END IF;
	IF NOT new.pers_ap_paterno REGEXP '^[[:alpha:]_ ]+$' THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El apellido paterno solo puede contener letras';
	END IF;
	IF NOT length(trim(new.pers_ap_materno)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo apellido materno no debe estar en blanco';
	END IF;
	IF NOT new.pers_ap_materno REGEXP '^[[:alpha:]_ ]+$' THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El apellido materno solo puede contener letras';
	END IF;
	IF NOT new.pers_tdi_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un tipo de documento de identidad';
	END IF;
	IF NOT length(trim(new.pers_tdi_nro)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El número de documento de identidad no debe estar en blanco';
	END IF;
	IF NOT length(trim(new.pers_sexo)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El sexo no debe estar en blanco';
	END IF;
	IF NOT new.pers_sexo IN ('M', 'F') THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El sexo de la persona solo puede contener los valores M, F';
	END IF;
	IF NOT (DAYNAME(pers_fecha_nac) IS NOT NULL AND DATE(pers_fecha_nac) < DATE(NOW())) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha nacimiento debe ser una fecha válida y menor a la fecha de hoy';
	END IF;
	IF NOT length(trim(new.pers_email)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo email no debe estar en blanco';
	END IF;
	IF NOT new.pers_email REGEXP '^[A-Z0-9\._]+@[A-Z0-9]+\.[A-Z]{2,4}$' THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese una dirección de correo electrónico válida';
	END IF;
# 	IF NOT length(trim(new.pers_celular)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo celular no debe estar en blanco';
# 	END IF;
# 	IF NOT length(trim(new.pers_telefono)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo telefono no debe estar en blanco';
# 	END IF;
	IF NOT new.pers_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.pers_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la persona solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_persona_beforeUpdate;
CREATE TRIGGER trg_persona_beforeUpdate
BEFORE UPDATE ON persona
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.pers_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo nombre no debe estar en blanco';
    END IF;
    IF NOT new.pers_nombre REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre solo puede contener letras';
    END IF;
    # 	IF NOT length(trim(new.pers_snombre)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El snombre no debe estar en blanco';
# 	END IF;
    IF (length(trim(new.pers_snombre)) > 0 AND NOT new.pers_snombre REGEXP '^[[:alpha:]_ ]+$') THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El segundo nombre solo puede contener letras';
    END IF;
    IF NOT length(trim(new.pers_ap_paterno)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo apellido paterno no debe estar en blanco';
    END IF;
    IF NOT new.pers_ap_paterno REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El apellido paterno solo puede contener letras';
    END IF;
    IF NOT length(trim(new.pers_ap_materno)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo apellido materno no debe estar en blanco';
    END IF;
    IF NOT new.pers_ap_materno REGEXP '^[[:alpha:]_ ]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El apellido materno solo puede contener letras';
    END IF;
    IF NOT new.pers_tdi_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un tipo de documento de identidad';
    END IF;
    IF NOT length(trim(new.pers_tdi_nro)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El número de documento de identidad no debe estar en blanco';
    END IF;
    IF NOT length(trim(new.pers_sexo)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El sexo no debe estar en blanco';
    END IF;
    IF NOT new.pers_sexo IN ('M', 'F') THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El sexo de la persona solo puede contener los valores M, F';
    END IF;
    IF NOT (DAYNAME(pers_fecha_nac) IS NOT NULL AND DATE(pers_fecha_nac) < DATE(NOW())) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha nacimiento debe ser una fecha válida y menor a la fecha de hoy';
    END IF;
    IF NOT length(trim(new.pers_email)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo email no debe estar en blanco';
    END IF;
    IF NOT new.pers_email REGEXP '^[A-Z0-9\._]+@[A-Z0-9]+\.[A-Z]{2,4}$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese una dirección de correo electrónico válida';
    END IF;
    # 	IF NOT length(trim(new.pers_celular)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo celular no debe estar en blanco';
# 	END IF;
# 	IF NOT length(trim(new.pers_telefono)) > 0 THEN
# 		SIGNAL SQLSTATE '45000'
# 		SET MESSAGE_TEXT = 'El campo telefono no debe estar en blanco';
# 	END IF;
    IF NOT new.pers_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.pers_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la persona solo puede contener los valores 0, 1';
    END IF;
END; $$