<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmParentesco' class='listform'>
<div class='form_top'>
	<span class='h1'>Parentescos</span>
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
var frm_parent = '#frmParentesco';
$(document).ready(function(e){
	parent_mostrarDatos();
	$(frm_parent).find('#txtBuscar').focus();
	$(frm_parent).find('#txtBuscar').keyup(function(e) {
		parent_mostrarDatos();
	});
	$(frm_parent).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/parentesco/parentescoReg.php?parent=vistas/parentesco/parentesco.php');
	});
	$(frm_parent).find('#btnRefrescar').off('click').click(function(e) {
		parent_mostrarDatos();
	});
});
function parent_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_parent).find('#datos').load('vistas/parentesco/parentescoList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/parentesco/parentesco.php');
}
</script>