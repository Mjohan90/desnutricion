<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmVariable' class='listform'>
<div class='form_top'>
	<span class='h1'>Variables</span>
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
var frm_var = '#frmVariable';
$(document).ready(function(e){
	var_mostrarDatos();
	$(frm_var).find('#txtBuscar').focus();
	$(frm_var).find('#txtBuscar').keyup(function(e) {
		var_mostrarDatos();
	});
	$(frm_var).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/variable/variableReg.php?parent=vistas/variable/variable.php');
	});
	$(frm_var).find('#btnRefrescar').off('click').click(function(e) {
		var_mostrarDatos();
	});
});
function var_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_var).find('#datos').load('vistas/variable/variableList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/variable/variable.php');
}
</script>