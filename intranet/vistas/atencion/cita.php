<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmAtencion' class='listform'>
    <div class='form_top'>
        <span class='h1'>Citas</span>
        <hr class='separator'/>
        <div>
            <input type='text' id='txtFecha' name='txtFecha' class='txt120' value='<?= today(); ?>'
                   placeholder='00/00/0000'/>
            <label for='txtBuscar'>Buscar:</label>
            <input type='text' id='txtBuscar' name='txtBuscar' placeholder='Ingrese búsqueda'/>
            <a href='#' class='btn' id='btnRefrescar' name='btnRefrescar'>
                <img class='icon' src='../recursos/img/refresh.png'>
            </a>
            <a href='#' class='btn b_azul' id='btnNuevo' name='btnNuevo'>Nueva cita</a>
        </div>
    </div>
    <hr class='separator'/>
    <div class='listform_body bpad15'>
        <div id='datos' class='centered' style='max-width: 800px;'></div>
    </div>
</div>
<script>
    var frm_atenc = '#frmAtencion';
    $(document).ready(function (e) {
        $(frm_atenc).find('#txtFecha').datepicker();
        atenc_mostrarDatos();
        $(frm_atenc).find('#txtBuscar').focus();
        $(frm_atenc).find('#txtBuscar').keyup(function (e) {
            atenc_mostrarDatos();
        });
        $(frm_atenc).find('#txtFecha').change(function (e) {
            atenc_mostrarDatos();
        });
        $(frm_atenc).find('#btnNuevo').off('click').click(function (e) {
            performLoad('vistas/atencion/citaReg.php?parent=vistas/atencion/cita.php');
        });
        $(frm_atenc).find('#btnRefrescar').off('click').click(function (e) {
            atenc_mostrarDatos();
        });
    });

    function atenc_mostrarDatos() {
        var fecha  = encodeURIComponent(getDateYMD($(frm_atenc).find('#txtFecha').val()));
        var buscar = encodeURIComponent($(frm_atenc).find('#txtBuscar').val());
        $(frm_atenc).find('#datos').load('vistas/atencion/citaList.php?b=' + buscar + '&fecha=' + fecha);
    }

    function volver() {
        performLoad('vistas/atencion/atencion.php');
    }
</script>
