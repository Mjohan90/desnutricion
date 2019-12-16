<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmDireccion' class='listform'>
<div class='form_top'>
	<span class='h1'>Direcciones</span>
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
var frm_direc = '#frmDireccion';
$(document).ready(function(e){
	direc_mostrarDatos();
	$(frm_direc).find('#txtBuscar').focus();
	$(frm_direc).find('#txtBuscar').keyup(function(e) {
		direc_mostrarDatos();
	});
	$(frm_direc).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/direccion/direccionReg.php?parent=vistas/direccion/direccion.php');
	});
	$(frm_direc).find('#btnRefrescar').off('click').click(function(e) {
		direc_mostrarDatos();
	});
});
function direc_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_direc).find('#datos').load('vistas/direccion/direccionList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/direccion/direccion.php');
}
</script>