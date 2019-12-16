<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('espec_upd', 'vistas/especialidad/especialidad.php');
?>
<?php
	include_once '../../datos/especialidadDAL.php';
	$espec_dal = new especialidadDAL();
	$espec_id = GetNumericParam('espec_id');

	$espec_row = $espec_dal->getByID($espec_id);
?>
<form id='frmEspecialidadUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar especialidad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtEspecNombre'>Nombre:</label></td>
		<td><input type='text' id='txtEspecNombre' name='txtEspecNombre' value='<?php if ($espec_row) { echo htmlspecialchars($espec_row['espec_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtEspecEstado'>Estado:</label></td>
		<td><input type='text' id='txtEspecEstado' name='txtEspecEstado' value='<?php if ($espec_row) { echo $espec_row['espec_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var espec_upd = '#frmEspecialidadUpd';
$(document).ready(function(e) {
	$(espec_upd).find('#txtEspecNombre').focus();
	$(espec_upd).find('#btnActualizar').off('click').click(function(e) {
		if (espec_validar()) {
			var espec_id = '<?php echo $espec_id; ?>';
			var espec_nombre = $(espec_upd).find('#txtEspecNombre').val();
			var espec_estado = $(espec_upd).find('#txtEspecEstado').val();

			$.post('vistas/especialidad/proceso/especialidad_update.php',{
				espec_id : espec_id,
				espec_nombre : espec_nombre,
				espec_estado : espec_estado
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
	$(espec_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function espec_validar() {
	var espec_nombre = $(espec_upd).find('#txtEspecNombre').val();

	if (espec_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de especialidad', 'txtEspecNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>