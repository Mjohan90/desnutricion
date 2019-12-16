<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmCargo' class='listform'>
<div class='form_top'>
	<span class='h1'>Cargos</span>
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
var frm_carg = '#frmCargo';
$(document).ready(function(e){
	carg_mostrarDatos();
	$(frm_carg).find('#txtBuscar').focus();
	$(frm_carg).find('#txtBuscar').keyup(function(e) {
		carg_mostrarDatos();
	});
	$(frm_carg).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/cargo/cargoReg.php?parent=vistas/cargo/cargo.php');
	});
	$(frm_carg).find('#btnRefrescar').off('click').click(function(e) {
		carg_mostrarDatos();
	});
});
function carg_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_carg).find('#datos').load('vistas/cargo/cargoList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/cargo/cargo.php');
}
</script>