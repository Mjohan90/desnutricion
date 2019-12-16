<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmTipoparentesco' class='listform'>
<div class='form_top'>
	<span class='h1'>Tipos de parentesco</span>
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
var frm_tparent = '#frmTipoparentesco';
$(document).ready(function(e){
	tparent_mostrarDatos();
	$(frm_tparent).find('#txtBuscar').focus();
	$(frm_tparent).find('#txtBuscar').keyup(function(e) {
		tparent_mostrarDatos();
	});
	$(frm_tparent).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/tipoparentesco/tipoparentescoReg.php?parent=vistas/tipoparentesco/tipoparentesco.php');
	});
	$(frm_tparent).find('#btnRefrescar').off('click').click(function(e) {
		tparent_mostrarDatos();
	});
});
function tparent_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_tparent).find('#datos').load('vistas/tipoparentesco/tipoparentescoList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/tipoparentesco/tipoparentesco.php');
}
</script>