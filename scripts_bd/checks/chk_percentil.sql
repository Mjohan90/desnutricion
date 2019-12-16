DELIMITER $$

DROP TRIGGER IF EXISTS trg_percentil_beforeInsert;
CREATE TRIGGER trg_percentil_beforeInsert
BEFORE INSERT ON percentil
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.percent_sexo)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo sexo no debe estar en blanco';
	END IF;
	IF NOT new.percent_sexo IN ('M', 'F') THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El sexo del percentil solo puede contener los valores M, F';
	END IF;
	IF NOT new.percent_indic_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo indicador ID';
	END IF;
	IF NOT new.percent_var1_valor > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de la variable 1 debe ser mayor cero';
	END IF;
	IF NOT new.percent_var2_valor > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El valor de la variable 2 debe ser mayor cero';
	END IF;
	IF NOT new.percent_percentil > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo percentil debe ser mayor cero';
	END IF;
	IF NOT new.percent_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.percent_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del percentil solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_percentil_beforeUpdate;
CREATE TRIGGER trg_percentil_beforeUpdate
BEFORE UPDATE ON percentil
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.percent_sexo)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo sexo no debe estar en blanco';
    END IF;
    IF NOT new.percent_sexo IN ('M', 'F') THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El sexo del percentil solo puede contener los valores M, F';
    END IF;
    IF NOT new.percent_indic_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo indicador ID';
    END IF;
    IF NOT new.percent_var1_valor > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de la variable 1 debe ser mayor cero';
    END IF;
    IF NOT new.percent_var2_valor > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El valor de la variable 2 debe ser mayor cero';
    END IF;
    IF NOT new.percent_percentil > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo percentil debe ser mayor cero';
    END IF;
    IF NOT new.percent_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.percent_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del percentil solo puede contener los valores 0, 1';
    END IF;
END; $$