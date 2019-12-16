<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmIndicador' class='listform'>
<div class='form_top'>
	<span class='h1'>Indicadores</span>
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
var frm_indic = '#frmIndicador';
$(document).ready(function(e){
	indic_mostrarDatos();
	$(frm_indic).find('#txtBuscar').focus();
	$(frm_indic).find('#txtBuscar').keyup(function(e) {
		indic_mostrarDatos();
	});
	$(frm_indic).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/indicador/indicadorReg.php?parent=vistas/indicador/indicador.php');
	});
	$(frm_indic).find('#btnRefrescar').off('click').click(function(e) {
		indic_mostrarDatos();
	});
});
function indic_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_indic).find('#datos').load('vistas/indicador/indicadorList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/indicador/indicador.php');
}
</script>