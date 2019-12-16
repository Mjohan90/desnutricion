<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmDiagnostico' class='listform'>
<div class='form_top'>
	<span class='h1'>Diagnósticos</span>
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
var frm_diag = '#frmDiagnostico';
$(document).ready(function(e){
	diag_mostrarDatos();
	$(frm_diag).find('#txtBuscar').focus();
	$(frm_diag).find('#txtBuscar').keyup(function(e) {
		diag_mostrarDatos();
	});
	$(frm_diag).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/diagnostico/diagnosticoReg.php?parent=vistas/diagnostico/diagnostico.php');
	});
	$(frm_diag).find('#btnRefrescar').off('click').click(function(e) {
		diag_mostrarDatos();
	});
});
function diag_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_diag).find('#datos').load('vistas/diagnostico/diagnosticoList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/diagnostico/diagnostico.php');
}
</script>