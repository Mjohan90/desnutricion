<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmEspecialidad' class='listform'>
<div class='form_top'>
	<span class='h1'>Especialidades</span>
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
var frm_espec = '#frmEspecialidad';
$(document).ready(function(e){
	espec_mostrarDatos();
	$(frm_espec).find('#txtBuscar').focus();
	$(frm_espec).find('#txtBuscar').keyup(function(e) {
		espec_mostrarDatos();
	});
	$(frm_espec).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/especialidad/especialidadReg.php?parent=vistas/especialidad/especialidad.php');
	});
	$(frm_espec).find('#btnRefrescar').off('click').click(function(e) {
		espec_mostrarDatos();
	});
});
function espec_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_espec).find('#datos').load('vistas/especialidad/especialidadList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/especialidad/especialidad.php');
}
</script>