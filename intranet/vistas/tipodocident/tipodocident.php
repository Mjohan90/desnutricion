<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmTipodocident' class='listform'>
<div class='form_top'>
	<span class='h1'>Tipos de documento de identidad</span>
	<hr class='separator'/>
	<div>
	<label for='txtBuscar'>Buscar:</label>
	<input type='text' id='txtBuscar' name='txtBuscar' placeholder='Ingrese búsqueda' />
	<a href='#' class='btn' id='btnRefrescar' name='btnRefrescar'>
		<img class='icon' src='../recursos/img/refresh.png'>
	</a>
	<a href='#' class='btn b_azul' id='btnNuevo' name='btnNuevo'>Nuevo</a>
</div>
</div>
<hr class='separator'/>
<div class='listform_body bpad15'>
	<div id='datos' class='centered' style='max-width: 800px;'></div>
</div>
</div>
<script>
var frm_tdi = '#frmTipodocident';
$(document).ready(function(e){
	tdi_mostrarDatos();
	$(frm_tdi).find('#txtBuscar').focus();
	$(frm_tdi).find('#txtBuscar').keyup(function(e) {
		tdi_mostrarDatos();
	});
	$(frm_tdi).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/tipodocident/tipodocidentReg.php?parent=vistas/tipodocident/tipodocident.php');
	});
	$(frm_tdi).find('#btnRefrescar').off('click').click(function(e) {
		tdi_mostrarDatos();
	});
});
function tdi_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tdi).find('#datos').load('vistas/tipodocident/tipodocidentList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/tipodocident/tipodocident.php');
}
</script>