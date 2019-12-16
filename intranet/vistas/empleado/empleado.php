<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmEmpleado' class='listform'>
<div class='form_top'>
	<span class='h1'>Empleados</span>
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
var frm_empl = '#frmEmpleado';
$(document).ready(function(e){
	empl_mostrarDatos();
	$(frm_empl).find('#txtBuscar').focus();
	$(frm_empl).find('#txtBuscar').keyup(function(e) {
		empl_mostrarDatos();
	});
	$(frm_empl).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/empleado/empleadoReg.php?parent=vistas/empleado/empleado.php');
	});
	$(frm_empl).find('#btnRefrescar').off('click').click(function(e) {
		empl_mostrarDatos();
	});
});
function empl_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_empl).find('#datos').load('vistas/empleado/empleadoList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/empleado/empleado.php');
}
</script>