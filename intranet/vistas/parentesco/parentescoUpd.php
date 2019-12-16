<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('parent_upd', 'vistas/parentesco/parentesco.php');
?>
<?php
	include_once '../../datos/parentescoDAL.php';
	$parent_dal = new parentescoDAL();
	$parent_id = GetNumericParam('parent_id');

	$parent_row = $parent_dal->getByID($parent_id);
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<?php
	include_once '../../datos/tipoparentescoDAL.php';
	$tparent_dal = new tipoparentescoDAL();
?>
<form id='frmParentescoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar parentesco</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtParentPers1ID'>Persona:</label></td>
		<td><select id='txtParentPers1ID' name='txtParentPers1ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo($parent_row['parent_pers1_id']); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'
					<?php echo ($row['pers_id'] == $parent_row['pers_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtParentPers2ID'>Persona:</label></td>
		<td><select id='txtParentPers2ID' name='txtParentPers2ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo($parent_row['parent_pers2_id']); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'
					<?php echo ($row['pers_id'] == $parent_row['pers_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtParentTparentID'>Tipo de parentesco:</label></td>
		<td><select id='txtParentTparentID' name='txtParentTparentID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tparent_list = $tparent_dal->listarcbo($parent_row['parent_tparent_id']); ?>
			<?php foreach($tparent_list as $row) { ?>
				<option value='<?php echo $row['tparent_id']; ?>'
					<?php echo ($row['tparent_id'] == $parent_row['tparent_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tparent_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtParentEsApoderado'>Es apoderado:</label></td>
		<td><input type='text' id='txtParentEsApoderado' name='txtParentEsApoderado' value='<?php if ($parent_row) { echo $parent_row['parent_es_apoderado']; } ?>'  placeholder='Ingrese es apoderado'/></td>
	</tr>
	<tr hidden><td><label for='txtParentEstado'>Estado:</label></td>
		<td><input type='text' id='txtParentEstado' name='txtParentEstado' value='<?php if ($parent_row) { echo $parent_row['parent_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var parent_upd = '#frmParentescoUpd';
$(document).ready(function(e) {
	$(parent_upd).find('#txtParentPers1ID').focus();
	$(parent_upd).find('#btnActualizar').off('click').click(function(e) {
		if (parent_validar()) {
			var parent_id = '<?php echo $parent_id; ?>';
			var parent_pers1_id = $(parent_upd).find('#txtParentPers1ID').val();
			var parent_pers2_id = $(parent_upd).find('#txtParentPers2ID').val();
			var parent_tparent_id = $(parent_upd).find('#txtParentTparentID').val();
			var parent_es_apoderado = $(parent_upd).find('#txtParentEsApoderado').val();
			var parent_estado = $(parent_upd).find('#txtParentEstado').val();

			$.post('vistas/parentesco/proceso/parentesco_update.php',{
				parent_id : parent_id,
				parent_pers1_id : parent_pers1_id,
				parent_pers2_id : parent_pers2_id,
				parent_tparent_id : parent_tparent_id,
				parent_es_apoderado : parent_es_apoderado,
				parent_estado : parent_estado
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
	$(parent_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function parent_validar() {
	var parent_pers1_id = $(parent_upd).find('#txtParentPers1ID').val();
	var parent_pers2_id = $(parent_upd).find('#txtParentPers2ID').val();
	var parent_tparent_id = $(parent_upd).find('#txtParentTparentID').val();
	var parent_es_apoderado = $(parent_upd).find('#txtParentEsApoderado').val();

	if (!(isInteger(parent_pers1_id) && parent_pers1_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtParentPers1ID');
		return false;
	}
	if (!(isInteger(parent_pers2_id) && parent_pers2_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtParentPers2ID');
		return false;
	}
	if (!(isInteger(parent_tparent_id) && parent_tparent_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de parentesco</b>', 'txtParentTparentID');
		return false;
	}
	if (!isTinyint(parent_es_apoderado)) {
		showMessageWarning('Ingrese un valor de <b>es apoderado</b> válido', 'txtParentEsApoderado');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>