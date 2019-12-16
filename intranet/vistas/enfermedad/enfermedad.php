<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmEnfermedad' class='listform'>
<div class='form_top'>
	<span class='h1'>Enfermedades</span>
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
var frm_enferm = '#frmEnfermedad';
$(document).ready(function(e){
	enferm_mostrarDatos();
	$(frm_enferm).find('#txtBuscar').focus();
	$(frm_enferm).find('#txtBuscar').keyup(function(e) {
		enferm_mostrarDatos();
	});
	$(frm_enferm).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/enfermedad/enfermedadReg.php?parent=vistas/enfermedad/enfermedad.php');
	});
	$(frm_enferm).find('#btnRefrescar').off('click').click(function(e) {
		enferm_mostrarDatos();
	});
});
function enferm_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_enferm).find('#datos').load('vistas/enfermedad/enfermedadList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/enfermedad/enfermedad.php');
}
</script>
