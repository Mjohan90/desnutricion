<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmPaciente' class='listform'>
<div class='form_top'>
	<span class='h1'>Pacientes</span>
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
var frm_pac = '#frmPaciente';
$(document).ready(function(e){
	pac_mostrarDatos();
	$(frm_pac).find('#txtBuscar').focus();
	$(frm_pac).find('#txtBuscar').keyup(function(e) {
		pac_mostrarDatos();
	});
	$(frm_pac).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/paciente/pacienteReg.php?parent=vistas/paciente/paciente.php');
	});
	$(frm_pac).find('#btnRefrescar').off('click').click(function(e) {
		pac_mostrarDatos();
	});
});
function pac_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_pac).find('#datos').load('vistas/paciente/pacienteList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/paciente/paciente.php');
}
</script>