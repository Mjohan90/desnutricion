<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('catvar_upd', 'vistas/categvariable/categvariable.php');
?>
<?php
	include_once '../../datos/categvariableDAL.php';
	$catvar_dal = new categvariableDAL();
	$catvar_id = GetNumericParam('catvar_id');

	$catvar_row = $catvar_dal->getByID($catvar_id);
?>
<form id='frmCategvariableUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar categoría de variable</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCatvarNombre'>Nombre:</label></td>
		<td><input type='text' id='txtCatvarNombre' name='txtCatvarNombre' value='<?php if ($catvar_row) { echo htmlspecialchars($catvar_row['catvar_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtCatvarEstado'>Estado:</label></td>
		<td><input type='text' id='txtCatvarEstado' name='txtCatvarEstado' value='<?php if ($catvar_row) { echo $catvar_row['catvar_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var catvar_upd = '#frmCategvariableUpd';
$(document).ready(function(e) {
	$(catvar_upd).find('#txtCatvarNombre').focus();
	$(catvar_upd).find('#btnActualizar').off('click').click(function(e) {
		if (catvar_validar()) {
			var catvar_id = '<?php echo $catvar_id; ?>';
			var catvar_nombre = $(catvar_upd).find('#txtCatvarNombre').val();
			var catvar_estado = $(catvar_upd).find('#txtCatvarEstado').val();

			$.post('vistas/categvariable/proceso/categvariable_update.php',{
				catvar_id : catvar_id,
				catvar_nombre : catvar_nombre,
				catvar_estado : catvar_estado
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
	$(catvar_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function catvar_validar() {
	var catvar_nombre = $(catvar_upd).find('#txtCatvarNombre').val();

	if (catvar_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de categoría de variable', 'txtCatvarNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>