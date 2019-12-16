DROP VIEW IF EXISTS v_direcciones;
CREATE VIEW v_direcciones
AS
SELECT pers_id, pers_nombre, pers_snombre, pers_ap_paterno, pers_ap_materno,
       pers_tdi_id, pers_tdi_nro, ubig_cod, ubig_nombre, direc_descripcion
FROM persona pers
    INNER JOIN direccion d ON pers.pers_id = d.direc_pers_id
    INNER JOIN ubigeo u ON d.direc_ubig_id = u.ubig_id;

SELECT * FROM v_direcciones;

DROP VIEW IF EXISTS v_familiares;
CREATE VIEW v_familiares
AS
SELECT pac.pers_id as pac_id,
    pac.pers_nombre as pac_nombre, pac.pers_snombre as pac_snombre,
    pac.pers_ap_paterno as pac_ap_paterno, pac.pers_ap_materno as pac_ap_materno,
    pac.pers_tdi_id as pac_tdi_id, pac.pers_tdi_nro as pac_tdi_nro,
    fam.pers_id as fam_id,
    fam.pers_nombre as fam_nombre, fam.pers_snombre as fam_snombre,
    fam.pers_ap_paterno as fam_ap_paterno, fam.pers_ap_materno as fam_ap_materno,
    fam.pers_tdi_id as fam_tdi_id, fam.pers_tdi_nro as fam_tdi_nro,
    t.tparent_id, t.tparent_nombre
FROM parentesco p
    INNER JOIN persona pac ON p.parent_pers1_id = pac.pers_id
    INNER JOIN persona fam ON p.parent_pers2_id = fam.pers_id
    INNER JOIN tipoparentesco t ON p.parent_tparent_id = t.tparent_id;

SELECT * FROM v_familiares;

DROP VIEW IF EXISTS v_triaje_pacientes;
CREATE VIEW v_triaje_pacientes
AS
SELECT pers.pers_id AS pac_id,
       pers.pers_nombre as pac_nombre, pers.pers_snombre as pac_snombre,
       pers.pers_ap_paterno as pac_ap_paterno, pers.pers_ap_materno as pac_ap_materno,
       atenc_id, atenc_fecha_atenc, triaje_id, var_id, var_nombre, triaje_valor,
       um_id, um_nombre, um_abrev
FROM paciente pac
    INNER JOIN persona pers ON pac.pac_pers_id = pers.pers_id
    INNER JOIN atencion atenc ON pac.pac_id = atenc.atenc_pac_id
    INNER JOIN triaje tri ON atenc.atenc_id = tri.triaje_atenc_id
    INNER JOIN variable var ON tri.triaje_var_id = var.var_id
    INNER JOIN um u ON tri.triaje_um_id = u.um_id;

SELECT * FROM v_triaje_pacientes;

DROP VIEW IF EXISTS v_empleados;
CREATE VIEW v_empleados
AS
SELECT pers_id as empl_id,
       pers_nombre as empl_nombre, pers_snombre as empl_snombre,
       pers_ap_paterno as empl_ap_paterno, pers_ap_materno as empl_ap_materno,
       pers_tdi_id as empl_tdi_id, pers_tdi_nro as empl_tdi_nro,
       carg_id, carg_nombre
FROM empleado empl
    INNER JOIN persona pers ON empl.empl_pers_id = pers.pers_id
    INNER JOIN cargo carg ON empl.empl_carg_id = carg.carg_id;

SELECT * FROM v_empleados;


DROP VIEW IF EXISTS v_atenciones;
CREATE VIEW v_atenciones
AS
SELECT atenc_id, atenc_fecha_atenc, atenc_pac_id,
       pers1.pers_id as pac_id, pers1.pers_nombre as pac_nombre,
       pers1.pers_snombre as pac_snombre, pers1.pers_ap_paterno as pac_ap_paterno,
       pers1.pers_ap_materno as pac_ap_materno, pers1.pers_tdi_id as pac_tdi_id,
       pers1.pers_tdi_nro as pac_tdi_nro,
       pers2.pers_id as medic_id,  pers2.pers_nombre as medic_nombre,
       pers2.pers_snombre as medic_snombre,  pers2.pers_ap_paterno as medic_ap_paterno,
       pers2.pers_ap_materno as medic_ap_materno,  pers2.pers_tdi_id as medic_tdi_id,
       pers2.pers_tdi_nro as medic_tdi_nro,
       atenc_observacion, atenc_tratamiento, atenc_dieta, atenc_situacion,
       atenc_estado, espec_id, espec_nombre
FROM atencion atenc
    INNER JOIN paciente pac ON atenc.atenc_pac_id = pac.pac_id
    INNER JOIN persona pers1 ON pac.pac_pers_id = pers1.pers_id
    INNER JOIN empleado empl ON atenc.atenc_medico_id = empl.empl_id
    INNER JOIN persona pers2 ON empl.empl_pers_id = pers2.pers_id
    INNER JOIN especialidad espec ON atenc.atenc_espec_id = espec.espec_id;

SELECT * FROM v_atenciones;




