<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmRol' class='listform'>
<div class='form_top'>
	<span class='h1'>Roles</span>
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
var frm_rol = '#frmRol';
$(document).ready(function(e){
	rol_mostrarDatos();
	$(frm_rol).find('#txtBuscar').focus();
	$(frm_rol).find('#txtBuscar').keyup(function(e) {
		rol_mostrarDatos();
	});
	$(frm_rol).find('#btnNuevo').off('click').click(function(e) {
		performLoad('vistas/rol/rolReg.php?parent=vistas/rol/rol.php');
	});
	$(frm_rol).find('#btnRefrescar').off('click').click(function(e) {
		rol_mostrarDatos();
	});
});
function rol_mostrarDatos() {
	var buscar = encodeURIComponent($('#txtBuscar').val());
	$(frm_rol).find('#datos').load('vistas/rol/rolList.php?b='+buscar);
}
function volver() {
	performLoad('vistas/rol/rol.php');
}
</script>