<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('triaje_upd', 'vistas/triaje/triaje.php');
?>
<?php
	include_once '../../datos/triajeDAL.php';
	$triaje_dal = new triajeDAL();
	$triaje_id = GetNumParam('triaje_id');

	$triaje_row = $triaje_dal->getByID($triaje_id);
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	include_once '../../datos/umDAL.php';
	$um_dal = new umDAL();
?>
<?php
	include_once '../../datos/variableDAL.php';
	$var_dal = new variableDAL();
?>
<form id='frmTriajeUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar triaje</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTriajeAtencID'>Atención:</label></td>
		<td><select id='txtTriajeAtencID' name='txtTriajeAtencID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $atenc_list = $atenc_dal->listarcbo($triaje_row['triaje_atenc_id']); ?>
			<?php foreach($atenc_list as $row) { ?>
				<option value='<?php echo $row['atenc_id']; ?>'
					<?php echo ($row['atenc_id'] == $triaje_row['atenc_id']) ? 'selected' : '';  ?>>
					<?php echo $row['atenc_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtTriajeVarID'>Variable:</label></td>
		<td><select id='txtTriajeVarID' name='txtTriajeVarID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $var_list = $var_dal->listarcbo($triaje_row['triaje_var_id']); ?>
			<?php foreach($var_list as $row) { ?>
				<option value='<?php echo $row['var_id']; ?>'
					<?php echo ($row['var_id'] == $triaje_row['var_id']) ? 'selected' : '';  ?>>
					<?php echo $row['var_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtTriajeUmID'>Unidad de medida:</label></td>
		<td><select id='txtTriajeUmID' name='txtTriajeUmID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $um_list = $um_dal->listarcbo($triaje_row['triaje_um_id']); ?>
			<?php foreach($um_list as $row) { ?>
				<option value='<?php echo $row['um_id']; ?>'
					<?php echo ($row['um_id'] == $triaje_row['um_id']) ? 'selected' : '';  ?>>
					<?php echo $row['um_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtTriajeValor'>Valor:</label></td>
		<td><input type='text' id='txtTriajeValor' name='txtTriajeValor' value='<?php if ($triaje_row) { echo $triaje_row['triaje_valor']; } ?>' maxlength='9' placeholder='Ingrese valor'/></td>
	</tr>
	<tr hidden><td><label for='txtTriajeEstado'>Estado:</label></td>
		<td><input type='text' id='txtTriajeEstado' name='txtTriajeEstado' value='<?php if ($triaje_row) { echo $triaje_row['triaje_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var triaje_upd = '#frmTriajeUpd';
$(document).ready(function(e) {
	$(triaje_upd).find('#txtTriajeAtencID').focus();
	$(triaje_upd).find('#btnActualizar').off('click').click(function(e) {
		if (triaje_validar()) {
			var triaje_id = '<?php echo $triaje_id; ?>';
			var triaje_atenc_id = $(triaje_upd).find('#txtTriajeAtencID').val();
			var triaje_var_id = $(triaje_upd).find('#txtTriajeVarID').val();
			var triaje_um_id = $(triaje_upd).find('#txtTriajeUmID').val();
			var triaje_valor = $(triaje_upd).find('#txtTriajeValor').val();
			var triaje_estado = $(triaje_upd).find('#txtTriajeEstado').val();

			$.post('vistas/triaje/proceso/triaje_update.php',{
				triaje_id : triaje_id,
				triaje_atenc_id : triaje_atenc_id,
				triaje_var_id : triaje_var_id,
				triaje_um_id : triaje_um_id,
				triaje_valor : triaje_valor,
				triaje_estado : triaje_estado
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
	$(triaje_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function triaje_validar() {
	var triaje_atenc_id = $(triaje_upd).find('#txtTriajeAtencID').val();
	var triaje_var_id = $(triaje_upd).find('#txtTriajeVarID').val();
	var triaje_um_id = $(triaje_upd).find('#txtTriajeUmID').val();
	var triaje_valor = $(triaje_upd).find('#txtTriajeValor').val();

	if (!(isInteger(triaje_atenc_id) && triaje_atenc_id > 0)) {
		showMessageWarning('Seleccione <b>atención</b>', 'txtTriajeAtencID');
		return false;
	}
	if (!(isInteger(triaje_var_id) && triaje_var_id > 0)) {
		showMessageWarning('Seleccione <b>variable</b>', 'txtTriajeVarID');
		return false;
	}
	if (!(isInteger(triaje_um_id) && triaje_um_id > 0)) {
		showMessageWarning('Seleccione <b>unidad de medida</b>', 'txtTriajeUmID');
		return false;
	}
	if (!isNumeric(triaje_valor)) {
		showMessageWarning('Ingrese <b>valor</b> válido', 'txtTriajeValor');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
