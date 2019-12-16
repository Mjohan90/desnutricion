<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('ubig_upd', 'vistas/ubigeo/ubigeo.php');
?>
<?php
	include_once '../../datos/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
	$ubig_id = GetNumParam('ubig_id');

	$ubig_row = $ubig_dal->getByID($ubig_id);
?>
<form id='frmUbigeoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar ubicación geográfica</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUbigCod'>Cod:</label></td>
		<td><input type='text' id='txtUbigCod' name='txtUbigCod' value='<?php if ($ubig_row) { echo htmlspecialchars($ubig_row['ubig_cod']); } ?>' maxlength='6' placeholder='Ingrese cod'/></td>
	</tr>
	<tr><td><label for='txtUbigDptoCod'>Dpto cod:</label></td>
		<td><input type='text' id='txtUbigDptoCod' name='txtUbigDptoCod' value='<?php if ($ubig_row) { echo $ubig_row['ubig_dpto_cod']; } ?>' maxlength='10' placeholder='Ingrese dpto cod'/></td>
	</tr>
	<tr><td><label for='txtUbigProvCod'>Prov cod:</label></td>
		<td><input type='text' id='txtUbigProvCod' name='txtUbigProvCod' value='<?php if ($ubig_row) { echo $ubig_row['ubig_prov_cod']; } ?>' maxlength='10' placeholder='Ingrese prov cod'/></td>
	</tr>
	<tr><td><label for='txtUbigDistCod'>Dist cod:</label></td>
		<td><input type='text' id='txtUbigDistCod' name='txtUbigDistCod' value='<?php if ($ubig_row) { echo $ubig_row['ubig_dist_cod']; } ?>' maxlength='10' placeholder='Ingrese dist cod'/></td>
	</tr>
	<tr><td><label for='txtUbigNombre'>Nombre:</label></td>
		<td><input type='text' id='txtUbigNombre' name='txtUbigNombre' value='<?php if ($ubig_row) { echo htmlspecialchars($ubig_row['ubig_nombre']); } ?>' maxlength='100' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtUbigEstado'>Estado:</label></td>
		<td><input type='text' id='txtUbigEstado' name='txtUbigEstado' value='<?php if ($ubig_row) { echo $ubig_row['ubig_estado']; } ?>'  placeholder='Ingrese estado'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_verde' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var ubig_upd = '#frmUbigeoUpd';
$(document).ready(function(e) {
	$(ubig_upd).find('#txtUbigCod').focus();
	$(ubig_upd).find('#btnActualizar').off('click').click(function(e) {
		if (ubig_validar()) {
			var ubig_id = '<?php echo $ubig_id; ?>';
			var ubig_cod = $(ubig_upd).find('#txtUbigCod').val();
			var ubig_dpto_cod = $(ubig_upd).find('#txtUbigDptoCod').val();
			var ubig_prov_cod = $(ubig_upd).find('#txtUbigProvCod').val();
			var ubig_dist_cod = $(ubig_upd).find('#txtUbigDistCod').val();
			var ubig_nombre = $(ubig_upd).find('#txtUbigNombre').val();
			var ubig_estado = $(ubig_upd).find('#txtUbigEstado').val();

			$.post('vistas/ubigeo/proceso/ubigeo_update.php',{
				ubig_id : ubig_id,
				ubig_cod : ubig_cod,
				ubig_dpto_cod : ubig_dpto_cod,
				ubig_prov_cod : ubig_prov_cod,
				ubig_dist_cod : ubig_dist_cod,
				ubig_nombre : ubig_nombre,
				ubig_estado : ubig_estado
			},
			function(datos) {
				if (datos == 1){
					alert('Actualizacion correcta');
					volver();
				} else {
					alert('Error al actualizar. ' + datos);
				}
			});
		}
	});
	$(ubig_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function ubig_validar() {
	var ubig_cod = $(ubig_upd).find('#txtUbigCod').val();
	var ubig_dpto_cod = $(ubig_upd).find('#txtUbigDptoCod').val();
	var ubig_prov_cod = $(ubig_upd).find('#txtUbigProvCod').val();
	var ubig_dist_cod = $(ubig_upd).find('#txtUbigDistCod').val();
	var ubig_nombre = $(ubig_upd).find('#txtUbigNombre').val();

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
