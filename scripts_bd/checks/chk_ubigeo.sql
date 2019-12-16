DELIMITER $$

DROP TRIGGER IF EXISTS trg_ubigeo_beforeInsert;
CREATE TRIGGER trg_ubigeo_beforeInsert
BEFORE INSERT ON ubigeo
FOR EACH ROW
BEGIN
	IF NOT length(trim(new.ubig_cod)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo codigo de ubigeo no debe estar en blanco';
	END IF;
    IF NOT length(trim(new.ubig_cod)) = 6 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo de ubigeo debe contener 6 dígitos';
    END IF;
    IF NOT new.ubig_cod REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo de ubigeo solo debe contener dígitos';
    END IF;
	IF NOT new.ubig_dpto_cod > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo codigo del departamento debe ser mayor a cero';
	END IF;
	IF NOT new.ubig_prov_cod > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo codigo de la provincia debe ser mayor a cero';
	END IF;
	IF NOT new.ubig_dist_cod > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo codigo del distrito debe ser mayor a cero';
	END IF;
	IF NOT length(trim(new.ubig_nombre)) > 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El nombre no debe estar en blanco';
	END IF;
	IF NOT new.ubig_estado >= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
	END IF;
	IF NOT new.ubig_estado IN (0, 1) THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'El estado de la ubicación geográfica solo puede contener los valores 0, 1';
	END IF;
END; $$

DROP TRIGGER IF EXISTS trg_ubigeo_beforeUpdate;
CREATE TRIGGER trg_ubigeo_beforeUpdate
BEFORE UPDATE ON ubigeo
FOR EACH ROW
BEGIN
    IF NOT length(trim(new.ubig_cod)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo de ubigeo no debe estar en blanco';
    END IF;
    IF NOT length(trim(new.ubig_cod)) = 6 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo de ubigeo debe contener 6 dígitos';
    END IF;
    IF NOT new.ubig_cod REGEXP '^[0-9]+$' THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo de ubigeo solo debe contener dígitos';
    END IF;
    IF NOT new.ubig_dpto_cod > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo del departamento debe ser mayor a cero';
    END IF;
    IF NOT new.ubig_prov_cod > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo de la provincia debe ser mayor a cero';
    END IF;
    IF NOT new.ubig_dist_cod > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo codigo del distrito debe ser mayor a cero';
    END IF;
    IF NOT length(trim(new.ubig_nombre)) > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El nombre no debe estar en blanco';
    END IF;
    IF NOT new.ubig_estado >= 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El campo estado debe ser mayor igual a cero';
    END IF;
    IF NOT new.ubig_estado IN (0, 1) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'El estado de la ubicación geográfica solo puede contener los valores 0, 1';
    END IF;
END; $$