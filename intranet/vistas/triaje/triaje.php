<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmTriaje' class='listform'>
    <div class='form_top'>
        <span class='h1'>Triajes</span>
        <hr class='separator'/>
        <div>
            <label for='txtBuscar'>Buscar:</label>
            <input type='text' id='txtFecha' name='txtFecha' class='txt120' value='<?= today(); ?>'
                   placeholder='00/00/0000'/>

            <input type='text' id='txtBuscar' name='txtBuscar' placeholder='Buscar paciente'/>
            <a href='#' class='btn' id='btnRefrescar' name='btnRefrescar'>
                <img class='icon' src='../recursos/img/refresh.png'>
            </a>
            <!--            <a href='#' class='btn b_azul' id='btnNuevo' name='btnNuevo'>Nuevo</a>-->
        </div>
    </div>
    <hr class='separator'/>
    <div class='listform_body bpad15'>
        <div id='datos' class='centered' style='max-width: 800px;'></div>
    </div>
</div>
<script>
    var frm_triaje = '#frmTriaje';
    $(document).ready(function (e) {
        $('#txtFecha').datepicker();

        triaje_mostrarDatos();
        $(frm_triaje).find('#txtBuscar').focus();
        $(frm_triaje).find('#txtBuscar').keyup(function (e) {
            triaje_mostrarDatos();
        });
        $(frm_triaje).find('#btnNuevo').off('click').click(function (e) {
            performLoad('vistas/triaje/triajeReg.php?parent=vistas/triaje/triaje.php');
        });
        $(frm_triaje).find('#btnRefrescar').off('click').click(function (e) {
            triaje_mostrarDatos();
        });
    });

    function triaje_mostrarDatos() {
        var fecha  = encodeURIComponent(getDateYMD($('#txtFecha').val()));
        var buscar = encodeURIComponent($('#txtBuscar').val());
        $(frm_triaje).find('#datos').load('vistas/triaje/citaList.php?b=' + buscar + '&fecha=' + fecha);
    }

    function volver() {
        performLoad('vistas/triaje/triaje.php');
    }
</script>
