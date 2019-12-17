<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmPercentil' class='listform'>
<div class='form_top'>
	<span class='h1'>Percentiles</span>
	<hr class='separator'/>
	<div>
	<label for='txtBuscar'>Buscar:</label>
	<input type='text' id='txtBuscar' name='txtBuscar' placeholder='Ingrese búsqueda' />
	<a href='#' class='btn' id='btnRefrescar' name='btnRefrescar'>
		<img class='icon' src='../recursos/img/refresh.png'>
	</a>
<!--	<a href='#' class='btn b_azul' id='btnNuevo' name='btnNuevo'>Nuevo</a>-->
</div>
</div>
<hr class='separator'/>
<div class='listform_body bpad15'>
	<div id='datos' class='centered' style='max-width: 800px;'></div>
</div>
</div>
<script>
var frm_percent = '#frmPercentil';
$(document).ready(function(e){
	percent_mostrarDatos();
	$(frm_percent).find('#txtBuscar').focus();
	$(frm_percent).find('#txtBuscar').keyup(function(e) {
		percent_mostrarDatos();
	});
	$(frm_percent).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/percentil/percentilReg.php?parent=vistas/percentil/percentil.php');
	});
	$(frm_percent).find('#btnRefrescar').off('click').click(function(e) {
		percent_mostrarDatos();
	});
});
function percent_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_percent).find('#datos').load('vistas/percentil/percentilList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/percentil/percentil.php');
}
</script>