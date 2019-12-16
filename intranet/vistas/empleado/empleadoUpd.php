<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('empl_upd', 'vistas/empleado/empleado.php');
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
	$empl_id = GetNumericParam('empl_id');

	$empl_row = $empl_dal->getByID($empl_id);
?>
<?php
	include_once '../../datos/cargoDAL.php';
	$carg_dal = new cargoDAL();
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<form id='frmEmpleadoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar empleado</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtEmplPersID'>Persona:</label></td>
		<td><select id='txtEmplPersID' name='txtEmplPersID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo($empl_row['empl_pers_id']); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'
					<?php echo ($row['pers_id'] == $empl_row['pers_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtEmplCargID'>Cargo:</label></td>
		<td><select id='txtEmplCargID' name='txtEmplCargID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $carg_list = $carg_dal->listarcbo($empl_row['empl_carg_id']); ?>
			<?php foreach($carg_list as $row) { ?>
				<option value='<?php echo $row['carg_id']; ?>'
					<?php echo ($row['carg_id'] == $empl_row['carg_id']) ? 'selected' : '';  ?>>
					<?php echo $row['carg_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr hidden><td><label for='txtEmplEstado'>Estado:</label></td>
		<td><input type='text' id='txtEmplEstado' name='txtEmplEstado' value='<?php if ($empl_row) { echo $empl_row['empl_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var empl_upd = '#frmEmpleadoUpd';
$(document).ready(function(e) {
	$(empl_upd).find('#txtEmplPersID').focus();
	$(empl_upd).find('#btnActualizar').off('click').click(function(e) {
		if (empl_validar()) {
			var empl_id = '<?php echo $empl_id; ?>';
			var empl_pers_id = $(empl_upd).find('#txtEmplPersID').val();
			var empl_carg_id = $(empl_upd).find('#txtEmplCargID').val();
			var empl_estado = $(empl_upd).find('#txtEmplEstado').val();

			$.post('vistas/empleado/proceso/empleado_update.php',{
				empl_id : empl_id,
				empl_pers_id : empl_pers_id,
				empl_carg_id : empl_carg_id,
				empl_estado : empl_estado
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
	$(empl_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function empl_validar() {
	var empl_pers_id = $(empl_upd).find('#txtEmplPersID').val();
	var empl_carg_id = $(empl_upd).find('#txtEmplCargID').val();

	if (!(isInteger(empl_pers_id) && empl_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtEmplPersID');
		return false;
	}
	if (!(isInteger(empl_carg_id) && empl_carg_id > 0)) {
		showMessageWarning('Seleccione <b>cargo</b>', 'txtEmplCargID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>