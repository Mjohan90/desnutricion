<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tparent_upd', 'vistas/tipoparentesco/tipoparentesco.php');
?>
<?php
	include_once '../../datos/tipoparentescoDAL.php';
	$tparent_dal = new tipoparentescoDAL();
	$tparent_id = GetNumParam('tparent_id');

	$tparent_row = $tparent_dal->getByID($tparent_id);
?>
<form id='frmTipoparentescoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo de parentesco</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTparentNombre'>Nombre:</label></td>
		<td><input type='text' id='txtTparentNombre' name='txtTparentNombre' value='<?php if ($tparent_row) { echo htmlspecialchars($tparent_row['tparent_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtTparentEstado'>Estado:</label></td>
		<td><input type='text' id='txtTparentEstado' name='txtTparentEstado' value='<?php if ($tparent_row) { echo $tparent_row['tparent_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tparent_upd = '#frmTipoparentescoUpd';
$(document).ready(function(e) {
	$(tparent_upd).find('#txtTparentNombre').focus();
	$(tparent_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tparent_validar()) {
			var tparent_id = '<?php echo $tparent_id; ?>';
			var tparent_nombre = $(tparent_upd).find('#txtTparentNombre').val();
			var tparent_estado = $(tparent_upd).find('#txtTparentEstado').val();

			$.post('vistas/tipoparentesco/proceso/tipoparentesco_update.php',{
				tparent_id : tparent_id,
				tparent_nombre : tparent_nombre,
				tparent_estado : tparent_estado
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
	$(tparent_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tparent_validar() {
	var tparent_nombre = $(tparent_upd).find('#txtTparentNombre').val();

	if (tparent_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo de parentesco', 'txtTparentNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
