<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('pac_upd', 'vistas/paciente/paciente.php');
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
	$pac_id = GetNumericParam('pac_id');

	$pac_row = $pac_dal->getByID($pac_id);
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<form id='frmPacienteUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar paciente</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPacPersID'>Persona:</label></td>
		<td><select id='txtPacPersID' name='txtPacPersID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo($pac_row['pac_pers_id']); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'
					<?php echo ($row['pers_id'] == $pac_row['pers_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr hidden><td><label for='txtPacEstado'>Estado:</label></td>
		<td><input type='text' id='txtPacEstado' name='txtPacEstado' value='<?php if ($pac_row) { echo $pac_row['pac_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var pac_upd = '#frmPacienteUpd';
$(document).ready(function(e) {
	$(pac_upd).find('#txtPacPersID').focus();
	$(pac_upd).find('#btnActualizar').off('click').click(function(e) {
		if (pac_validar()) {
			var pac_id = '<?php echo $pac_id; ?>';
			var pac_pers_id = $(pac_upd).find('#txtPacPersID').val();
			var pac_estado = $(pac_upd).find('#txtPacEstado').val();

			$.post('vistas/paciente/proceso/paciente_update.php',{
				pac_id : pac_id,
				pac_pers_id : pac_pers_id,
				pac_estado : pac_estado
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
	$(pac_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function pac_validar() {
	var pac_pers_id = $(pac_upd).find('#txtPacPersID').val();

	if (!(isInteger(pac_pers_id) && pac_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtPacPersID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>