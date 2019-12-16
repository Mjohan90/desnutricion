<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmHistoriaclinica' class='listform'>
<div class='form_top'>
	<span class='h1'>Historias clínicas</span>
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
var frm_hc = '#frmHistoriaclinica';
$(document).ready(function(e){
	hc_mostrarDatos();
	$(frm_hc).find('#txtBuscar').focus();
	$(frm_hc).find('#txtBuscar').keyup(function(e) {
		hc_mostrarDatos();
	});
	$(frm_hc).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/historiaclinica/historiaclinicaReg.php?parent=vistas/historiaclinica/historiaclinica.php');
	});
	$(frm_hc).find('#btnRefrescar').off('click').click(function(e) {
		hc_mostrarDatos();
	});
});
function hc_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_hc).find('#datos').load('vistas/historiaclinica/historiaclinicaList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/historiaclinica/historiaclinica.php');
}
</script>