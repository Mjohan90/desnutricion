<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('ubig_reg', 'vistas/ubigeo/ubigeo.php');
?>
<form id='frmUbigeoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar ubicación geográfica</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUbigCod'>Cod:</label></td>
		<td><input type='text' id='txtUbigCod' name='txtUbigCod' maxlength='6' placeholder='Ingrese cod'/></td>
	</tr>
	<tr><td><label for='txtUbigDptoCod'>Dpto cod:</label></td>
		<td><input type='text' id='txtUbigDptoCod' name='txtUbigDptoCod' maxlength='10' placeholder='Ingrese dpto cod'/></td>
	</tr>
	<tr><td><label for='txtUbigProvCod'>Prov cod:</label></td>
		<td><input type='text' id='txtUbigProvCod' name='txtUbigProvCod' maxlength='10' placeholder='Ingrese prov cod'/></td>
	</tr>
	<tr><td><label for='txtUbigDistCod'>Dist cod:</label></td>
		<td><input type='text' id='txtUbigDistCod' name='txtUbigDistCod' maxlength='10' placeholder='Ingrese dist cod'/></td>
	</tr>
	<tr><td><label for='txtUbigNombre'>Nombre:</label></td>
		<td><input type='text' id='txtUbigNombre' name='txtUbigNombre' maxlength='100' placeholder='Ingrese nombre'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
	<input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
	<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var ubig_reg = '#frmUbigeoReg';
$(document).ready(function(e) {
	$(ubig_reg).find('#txtUbigCod').focus();
	$(ubig_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (ubig_validar()){
			var ubig_cod = $(ubig_reg).find('#txtUbigCod').val();
			var ubig_dpto_cod = $(ubig_reg).find('#txtUbigDptoCod').val();
			var ubig_prov_cod = $(ubig_reg).find('#txtUbigProvCod').val();
			var ubig_dist_cod = $(ubig_reg).find('#txtUbigDistCod').val();
			var ubig_nombre = $(ubig_reg).find('#txtUbigNombre').val();

			$.post('vistas/ubigeo/proceso/ubigeo_insert.php',{
				ubig_cod : ubig_cod,
				ubig_dpto_cod : ubig_dpto_cod,
				ubig_prov_cod : ubig_prov_cod,
				ubig_dist_cod : ubig_dist_cod,
				ubig_nombre : ubig_nombre
			},
			function(datos) {
				if (datos > 0) {
					alert('Registro correcto');
					volver();
				} else {
					alert('Error al registrar. ' + datos);
				}
			});
		}
	});
	$(ubig_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function ubig_validar() {
	var ubig_cod = $(ubig_reg).find('#txtUbigCod').val();
	var ubig_dpto_cod = $(ubig_reg).find('#txtUbigDptoCod').val();
	var ubig_prov_cod = $(ubig_reg).find('#txtUbigProvCod').val();
	var ubig_dist_cod = $(ubig_reg).find('#txtUbigDistCod').val();
	var ubig_nombre = $(ubig_reg).find('#txtUbigNombre').val();

	if (ubig_cod == '') {
		showMessageWarning('Ingrese <b>cod</b>', 'txtUbigCod');
		return false;
	}
	if (!isInteger(ubig_dpto_cod)) {
		showMessageWarning('Ingrese <b>dpto cod</b> válido', 'txtUbigDptoCod');
		return false;
	}
	if (!isInteger(ubig_prov_cod)) {
		showMessageWarning('Ingrese <b>prov cod</b> válido', 'txtUbigProvCod');
		return false;
	}
	if (!isInteger(ubig_dist_cod)) {
		showMessageWarning('Ingrese <b>dist cod</b> válido', 'txtUbigDistCod');
		return false;
	}
	if (ubig_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de ubicación geográfica', 'txtUbigNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>