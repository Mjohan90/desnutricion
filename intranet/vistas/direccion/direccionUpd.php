<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('direc_upd', 'vistas/direccion/direccion.php');
?>
<?php
	include_once '../../datos/direccionDAL.php';
	$direc_dal = new direccionDAL();
	$direc_id = GetNumericParam('direc_id');

	$direc_row = $direc_dal->getByID($direc_id);
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<?php
	include_once '../../datos/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmDireccionUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar dirección</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtDirecPersID'>Persona:</label></td>
		<td><select id='txtDirecPersID' name='txtDirecPersID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo($direc_row['direc_pers_id']); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'
					<?php echo ($row['pers_id'] == $direc_row['pers_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtDirecUbigID'>Ubicación geográfica:</label></td>
		<td><select id='txtDirecUbigID' name='txtDirecUbigID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo($direc_row['direc_ubig_id']); ?>
			<?php foreach($ubig_list as $row) { ?>
				<option value='<?php echo $row['ubig_id']; ?>'
					<?php echo ($row['ubig_id'] == $direc_row['ubig_id']) ? 'selected' : '';  ?>>
					<?php echo $row['ubig_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtDirecDescripcion'>Descripcion:</label></td>
		<td><input type='text' id='txtDirecDescripcion' name='txtDirecDescripcion' value='<?php if ($direc_row) { echo htmlspecialchars($direc_row['direc_descripcion']); } ?>' maxlength='200' placeholder='Ingrese descripcion'/></td>
	</tr>
	<tr hidden><td><label for='txtDirecEstado'>Estado:</label></td>
		<td><input type='text' id='txtDirecEstado' name='txtDirecEstado' value='<?php if ($direc_row) { echo $direc_row['direc_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var direc_upd = '#frmDireccionUpd';
$(document).ready(function(e) {
	$(direc_upd).find('#txtDirecPersID').focus();
	$(direc_upd).find('#btnActualizar').off('click').click(function(e) {
		if (direc_validar()) {
			var direc_id = '<?php echo $direc_id; ?>';
			var direc_pers_id = $(direc_upd).find('#txtDirecPersID').val();
			var direc_ubig_id = $(direc_upd).find('#txtDirecUbigID').val();
			var direc_descripcion = $(direc_upd).find('#txtDirecDescripcion').val();
			var direc_estado = $(direc_upd).find('#txtDirecEstado').val();

			$.post('vistas/direccion/proceso/direccion_update.php',{
				direc_id : direc_id,
				direc_pers_id : direc_pers_id,
				direc_ubig_id : direc_ubig_id,
				direc_descripcion : direc_descripcion,
				direc_estado : direc_estado
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
	$(direc_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function direc_validar() {
	var direc_pers_id = $(direc_upd).find('#txtDirecPersID').val();
	var direc_ubig_id = $(direc_upd).find('#txtDirecUbigID').val();
	var direc_descripcion = $(direc_upd).find('#txtDirecDescripcion').val();

	if (!(isInteger(direc_pers_id) && direc_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtDirecPersID');
		return false;
	}
	if (!(isInteger(direc_ubig_id) && direc_ubig_id > 0)) {
		showMessageWarning('Seleccione <b>ubicación geográfica</b>', 'txtDirecUbigID');
		return false;
	}
	if (direc_descripcion == '') {
		showMessageWarning('Ingrese una <b>descripcion</b> válida de dirección', 'txtDirecDescripcion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>