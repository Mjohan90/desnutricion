<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tdi_upd', 'vistas/tipodocident/tipodocident.php');
?>
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
	$tdi_id = GetNumParam('tdi_id');

	$tdi_row = $tdi_dal->getByID($tdi_id);
?>
<form id='frmTipodocidentUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar tipo documento de identidad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTdiNombre'>Nombre:</label></td>
		<td><input type='text' id='txtTdiNombre' name='txtTdiNombre' value='<?php if ($tdi_row) { echo htmlspecialchars($tdi_row['tdi_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtTdiAbrev'>Abrev:</label></td>
		<td><input type='text' id='txtTdiAbrev' name='txtTdiAbrev' value='<?php if ($tdi_row) { echo htmlspecialchars($tdi_row['tdi_abrev']); } ?>' maxlength='10' placeholder='Ingrese abrev'/></td>
	</tr>
	<tr hidden><td><label for='txtTdiEstado'>Estado:</label></td>
		<td><input type='text' id='txtTdiEstado' name='txtTdiEstado' value='<?php if ($tdi_row) { echo $tdi_row['tdi_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var tdi_upd = '#frmTipodocidentUpd';
$(document).ready(function(e) {
	$(tdi_upd).find('#txtTdiNombre').focus();
	$(tdi_upd).find('#btnActualizar').off('click').click(function(e) {
		if (tdi_validar()) {
			var tdi_id = '<?php echo $tdi_id; ?>';
			var tdi_nombre = $(tdi_upd).find('#txtTdiNombre').val();
			var tdi_abrev = $(tdi_upd).find('#txtTdiAbrev').val();
			var tdi_estado = $(tdi_upd).find('#txtTdiEstado').val();

			$.post('vistas/tipodocident/proceso/tipodocident_update.php',{
				tdi_id : tdi_id,
				tdi_nombre : tdi_nombre,
				tdi_abrev : tdi_abrev,
				tdi_estado : tdi_estado
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
	$(tdi_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tdi_validar() {
	var tdi_nombre = $(tdi_upd).find('#txtTdiNombre').val();
	var tdi_abrev = $(tdi_upd).find('#txtTdiAbrev').val();

	if (tdi_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo documento de identidad', 'txtTdiNombre');
		return false;
	}
	if (tdi_abrev == '') {
		showMessageWarning('Ingrese una <b>abrev</b> válida', 'txtTdiAbrev');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
