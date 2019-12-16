<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('diag_upd', 'vistas/diagnostico/diagnostico.php');
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
	$diag_id = GetNumericParam('diag_id');

	$diag_row = $diag_dal->getByID($diag_id);
?>
<form id='frmDiagnosticoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar diagnóstico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtDiagNombre'>Nombre:</label></td>
		<td><input type='text' id='txtDiagNombre' name='txtDiagNombre' value='<?php if ($diag_row) { echo htmlspecialchars($diag_row['diag_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtDiagTratamientoSug'>Tratamiento sug:</label></td>
		<td><input type='text' id='txtDiagTratamientoSug' name='txtDiagTratamientoSug' value='<?php if ($diag_row) { echo htmlspecialchars($diag_row['diag_tratamiento_sug']); } ?>' maxlength='500' placeholder='Ingrese tratamiento sug'/></td>
	</tr>
	<tr><td><label for='txtDiagDietaSug'>Dieta sug:</label></td>
		<td><input type='text' id='txtDiagDietaSug' name='txtDiagDietaSug' value='<?php if ($diag_row) { echo htmlspecialchars($diag_row['diag_dieta_sug']); } ?>' maxlength='500' placeholder='Ingrese dieta sug'/></td>
	</tr>
	<tr hidden><td><label for='txtDiagEstado'>Estado:</label></td>
		<td><input type='text' id='txtDiagEstado' name='txtDiagEstado' value='<?php if ($diag_row) { echo $diag_row['diag_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var diag_upd = '#frmDiagnosticoUpd';
$(document).ready(function(e) {
	$(diag_upd).find('#txtDiagNombre').focus();
	$(diag_upd).find('#btnActualizar').off('click').click(function(e) {
		if (diag_validar()) {
			var diag_id = '<?php echo $diag_id; ?>';
			var diag_nombre = $(diag_upd).find('#txtDiagNombre').val();
			var diag_tratamiento_sug = $(diag_upd).find('#txtDiagTratamientoSug').val();
			var diag_dieta_sug = $(diag_upd).find('#txtDiagDietaSug').val();
			var diag_estado = $(diag_upd).find('#txtDiagEstado').val();

			$.post('vistas/diagnostico/proceso/diagnostico_update.php',{
				diag_id : diag_id,
				diag_nombre : diag_nombre,
				diag_tratamiento_sug : diag_tratamiento_sug,
				diag_dieta_sug : diag_dieta_sug,
				diag_estado : diag_estado
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
	$(diag_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function diag_validar() {
	var diag_nombre = $(diag_upd).find('#txtDiagNombre').val();
	var diag_tratamiento_sug = $(diag_upd).find('#txtDiagTratamientoSug').val();
	var diag_dieta_sug = $(diag_upd).find('#txtDiagDietaSug').val();

	if (diag_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de diagnóstico', 'txtDiagNombre');
		return false;
	}
	if (diag_tratamiento_sug == '') {
		showMessageWarning('Ingrese una <b>tratamiento sug</b> válida', 'txtDiagTratamientoSug');
		return false;
	}
	if (diag_dieta_sug == '') {
		showMessageWarning('Ingrese una <b>dieta sug</b> válida', 'txtDiagDietaSug');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>