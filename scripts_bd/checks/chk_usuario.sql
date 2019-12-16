DELIMITER $$

DROP TRIGGER IF EXISTS trg_usuario_beforeInsert;
CREATE TRIGGER trg_usuario_beforeInsert
BEFORE INSERT ON usuario
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.usu_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre del usuario no debe estar en blanco';
	END IF;
	IF NOT length(trim(new.usu_contrasena)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'La contraseña no debe estar en blanco';
	END IF;
	IF NOT new.usu_empl_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo empleado ID';
	END IF;
	IF NOT new.usu_rol_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo rol ID';
	END IF;
	IF NOT DAYNAME(usu_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.usu_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.usu_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del usuario solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_usuario_beforeUpdate;
CREATE TRIGGER trg_usuario_beforeUpdate
BEFORE UPDATE ON usuario
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.usu_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre del usuario no debe estar en blanco';
    END IF;
    IF NOT length(trim(new.usu_contrasena)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La contraseña no debe estar en blanco';
    END IF;
    IF NOT new.usu_empl_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo empleado ID';
    END IF;
    IF NOT new.usu_rol_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo rol ID';
    END IF;
    IF NOT DAYNAME(usu_fecha_reg) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
    END IF;
    IF NOT new.usu_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.usu_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del usuario solo puede contener los valores 0, 1';
    END IF;
END; $$