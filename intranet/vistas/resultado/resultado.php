<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmResultado' class='listform'>
<div class='form_top'>
	<span class='h1'>Resultados</span>
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
var frm_result = '#frmResultado';
$(document).ready(function(e){
	result_mostrarDatos();
	$(frm_result).find('#txtBuscar').focus();
	$(frm_result).find('#txtBuscar').keyup(function(e) {
		result_mostrarDatos();
	});
	$(frm_result).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/resultado/resultadoReg.php?parent=vistas/resultado/resultado.php');
	});
	$(frm_result).find('#btnRefrescar').off('click').click(function(e) {
		result_mostrarDatos();
	});
});
function result_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_result).find('#datos').load('vistas/resultado/resultadoList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/resultado/resultado.php');
}
</script>