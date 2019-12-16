DELIMITER $$

DROP FUNCTION IF EXISTS fn_calcular_promedio_valor_triaje;

CREATE FUNCTION fn_calcular_promedio_valor_triaje (_pac_id int, _var_id int)
RETURNS decimal
DETERMINISTIC
BEGIN
    DECLARE valor_prom decimal;

    SET valor_prom = (
        SELECT avg(triaje_valor) as valor_prom
        FROM triaje
            INNER JOIN atencion ON triaje.triaje_atenc_id = atencion.atenc_id
        WHERE atenc_pac_id = _pac_id AND triaje_var_id = _var_id
    );

    RETURN valor_prom;
END $$

SELECT fn_calcular_promedio_valor_triaje(1,1) as prom;

