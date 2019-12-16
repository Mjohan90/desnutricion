DELIMITER $$

DROP TRIGGER IF EXISTS trg_indicador_beforeInsert;
CREATE TRIGGER trg_indicador_beforeInsert
BEFORE INSERT ON indicador
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.indic_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre del indicador no debe estar en blanco';
	END IF;
	IF NOT new.indic_var1_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo var1 ID debe ser mayor a cero';
	END IF;
	IF NOT new.indic_var2_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo var2 ID debe ser mayor a cero';
	END IF;
	IF NOT new.indic_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.indic_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del indicador solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_indicador_beforeUpdate;
CREATE TRIGGER trg_indicador_beforeUpdate
BEFORE UPDATE ON indicador
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.indic_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo nombre del indicador no debe estar en blanco';
	END IF;
	IF NOT new.indic_var1_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo var1 ID debe ser mayor a cero';
	END IF;
	IF NOT new.indic_var2_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo var2 ID debe ser mayor a cero';
	END IF;
	IF NOT new.indic_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.indic_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del indicador solo puede contener los valores 0, 1';
	END IF;
END; $$