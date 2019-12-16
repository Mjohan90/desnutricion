<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('carg_upd', 'vistas/cargo/cargo.php');
?>
<?php
	include_once '../../datos/cargoDAL.php';
	$carg_dal = new cargoDAL();
	$carg_id = GetNumParam('carg_id');

	$carg_row = $carg_dal->getByID($carg_id);
?>
<form id='frmCargoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar cargo</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCargNombre'>Nombre:</label></td>
		<td><input type='text' id='txtCargNombre' name='txtCargNombre' value='<?php if ($carg_row) { echo htmlspecialchars($carg_row['carg_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtCargEstado'>Estado:</label></td>
		<td><input type='text' id='txtCargEstado' name='txtCargEstado' value='<?php if ($carg_row) { echo $carg_row['carg_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var carg_upd = '#frmCargoUpd';
$(document).ready(function(e) {
	$(carg_upd).find('#txtCargNombre').focus();
	$(carg_upd).find('#btnActualizar').off('click').click(function(e) {
		if (carg_validar()) {
			var carg_id = '<?php echo $carg_id; ?>';
			var carg_nombre = $(carg_upd).find('#txtCargNombre').val();
			var carg_estado = $(carg_upd).find('#txtCargEstado').val();

			$.post('vistas/cargo/proceso/cargo_update.php',{
				carg_id : carg_id,
				carg_nombre : carg_nombre,
				carg_estado : carg_estado
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
	$(carg_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function carg_validar() {
	var carg_nombre = $(carg_upd).find('#txtCargNombre').val();

	if (carg_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de cargo', 'txtCargNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
