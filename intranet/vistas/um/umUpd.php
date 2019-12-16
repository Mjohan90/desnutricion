<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('um_upd', 'vistas/um/um.php');
?>
<?php
	include_once '../../datos/umDAL.php';
	$um_dal = new umDAL();
	$um_id = GetNumParam('um_id');

	$um_row = $um_dal->getByID($um_id);
?>
<form id='frmUmUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar unidad de medida</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUmNombre'>Nombre:</label></td>
		<td><input type='text' id='txtUmNombre' name='txtUmNombre' value='<?php if ($um_row) { echo htmlspecialchars($um_row['um_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtUmAbrev'>Abrev:</label></td>
		<td><input type='text' id='txtUmAbrev' name='txtUmAbrev' value='<?php if ($um_row) { echo htmlspecialchars($um_row['um_abrev']); } ?>' maxlength='10' placeholder='Ingrese abrev'/></td>
	</tr>
	<tr hidden><td><label for='txtUmEstado'>Estado:</label></td>
		<td><input type='text' id='txtUmEstado' name='txtUmEstado' value='<?php if ($um_row) { echo $um_row['um_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var um_upd = '#frmUmUpd';
$(document).ready(function(e) {
	$(um_upd).find('#txtUmNombre').focus();
	$(um_upd).find('#btnActualizar').off('click').click(function(e) {
		if (um_validar()) {
			var um_id = '<?php echo $um_id; ?>';
			var um_nombre = $(um_upd).find('#txtUmNombre').val();
			var um_abrev = $(um_upd).find('#txtUmAbrev').val();
			var um_estado = $(um_upd).find('#txtUmEstado').val();

			$.post('vistas/um/proceso/um_update.php',{
				um_id : um_id,
				um_nombre : um_nombre,
				um_abrev : um_abrev,
				um_estado : um_estado
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
	$(um_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function um_validar() {
	var um_nombre = $(um_upd).find('#txtUmNombre').val();
	var um_abrev = $(um_upd).find('#txtUmAbrev').val();

	if (um_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de unidad de medida', 'txtUmNombre');
		return false;
	}
	if (um_abrev == '') {
		showMessageWarning('Ingrese una <b>abrev</b> válida', 'txtUmAbrev');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
