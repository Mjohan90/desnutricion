<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmClaseenfermedad' class='listform'>
<div class='form_top'>
	<span class='h1'>Clases de enfermedad</span>
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
var frm_clsenferm = '#frmClaseenfermedad';
$(document).ready(function(e){
	clsenferm_mostrarDatos();
	$(frm_clsenferm).find('#txtBuscar').focus();
	$(frm_clsenferm).find('#txtBuscar').keyup(function(e) {
		clsenferm_mostrarDatos();
	});
	$(frm_clsenferm).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/claseenfermedad/claseenfermedadReg.php?parent=vistas/claseenfermedad/claseenfermedad.php');
	});
	$(frm_clsenferm).find('#btnRefrescar').off('click').click(function(e) {
		clsenferm_mostrarDatos();
	});
});
function clsenferm_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_clsenferm).find('#datos').load('vistas/claseenfermedad/claseenfermedadList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/claseenfermedad/claseenfermedad.php');
}
</script>