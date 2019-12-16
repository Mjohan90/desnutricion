DELIMITER $$

DROP TRIGGER IF EXISTS trg_parentesco_beforeInsert;
CREATE TRIGGER trg_parentesco_beforeInsert
BEFORE INSERT ON parentesco
FOR EACH ROW
BEGIN
	IF NOT new.parent_pers1_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persono 1 ID';
	END IF;
	IF NOT new.parent_pers2_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona 2 ID';
	END IF;
	IF NOT new.parent_tparent_id > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo tipo de parentesco ID';
	END IF;
	IF NOT new.parent_es_apoderado > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo apoderado debe ser mayor a cero';
	END IF;
	IF NOT new.parent_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.parent_estado IN (0, 1)  THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado del parentesco solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_parentesco_beforeUpdate;
CREATE TRIGGER trg_parentesco_beforeUpdate
BEFORE UPDATE ON parentesco
FOR EACH ROW
BEGIN
    IF NOT new.parent_pers1_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persono 1 ID';
    END IF;
    IF NOT new.parent_pers2_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo persona 2 ID';
    END IF;
    IF NOT new.parent_tparent_id > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ingrese un valor válido para el campo tipo de parentesco ID';
    END IF;
    IF NOT new.parent_es_apoderado > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo apoderado debe ser mayor a cero';
    END IF;
    IF NOT new.parent_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.parent_estado IN (0, 1)  THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado del parentesco solo puede contener los valores 0, 1';
    END IF;
END; $$

DROP TRIGGER IF EXISTS trg_parentesco_afterInsert;
CREATE TRIGGER trg_parentesco_afterInsert
    AFTER INSERT ON parentesco
    FOR EACH ROW
BEGIN
    IF(NEW.parent_es_apoderado = 1) THEN
        UPDATE parentesco
        SET parent_es_apoderado = 0
        WHERE parent_pers1_id = NEW.parent_pers1_id AND parent_id <> NEW.parent_id;
    END IF;
END; $$

DROP TRIGGER IF EXISTS trg_parentesco_afterUpdate;
CREATE TRIGGER trg_parentesco_afterUpdate
    AFTER UPDATE ON parentesco
    FOR EACH ROW
BEGIN
    IF(NEW.parent_es_apoderado = 1) THEN
        UPDATE parentesco
        SET parent_es_apoderado = 0
        WHERE parent_pers1_id = NEW.parent_pers1_id AND parent_id <> NEW.parent_id;
    END IF;
END; $$
