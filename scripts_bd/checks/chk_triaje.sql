DELIMITER $$

DROP TRIGGER IF EXISTS trg_triaje_beforeInsert;
CREATE TRIGGER trg_triaje_beforeInsert
BEFORE INSERT ON triaje
FOR EACH ROW
BEGIN
    -- verifica la consistencia del campo [triaje_um_id]
    DECLARE var_um_id int;
    SET var_um_id = (
        SELECT var_um_id FROM variable WHERE var_id = new.triaje_var_id
    );
    SET new.triaje_um_id = var_um_id;

    -- checks
	IF NOT new.triaje_atenc_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo atencion ID';
	END IF;
	IF NOT new.triaje_var_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo variable ID';
	END IF;
	IF NOT new.triaje_um_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese una unidad de medida';
	END IF;
	IF NOT new.triaje_valor > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo valor debe ser mayor cero';
	END IF;
	IF NOT DAYNAME(triaje_fecha_reg) IS NOT NULL THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
	END IF;
	IF NOT new.triaje_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.triaje_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del triaje solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_triaje_beforeUpdate;
CREATE TRIGGER trg_triaje_beforeUpdate
BEFORE UPDATE ON triaje
FOR EACH ROW
BEGIN
    -- verifica la consistencia del campo [triaje_um_id]
    DECLARE var_um_id int;
    SET var_um_id = (
        SELECT var_um_id FROM variable WHERE var_id = new.triaje_var_id
        );
    SET new.triaje_um_id = var_um_id;

    -- checks
    IF NOT new.triaje_atenc_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo atencion ID';
    END IF;
    IF NOT new.triaje_var_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo variable ID';
    END IF;
    IF NOT new.triaje_um_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese una unidad de medida';
    END IF;
    IF NOT new.triaje_valor > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo valor debe ser mayor cero';
    END IF;
    IF NOT DAYNAME(triaje_fecha_reg) IS NOT NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de fecha registro debe ser una fecha válida';
    END IF;
    IF NOT new.triaje_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.triaje_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del triaje solo puede contener los valores 0, 1';
    END IF;
END; $$