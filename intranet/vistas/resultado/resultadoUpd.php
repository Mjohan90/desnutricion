<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('result_upd', 'vistas/resultado/resultado.php');
?>
<?php
	include_once '../../datos/resultadoDAL.php';
	$result_dal = new resultadoDAL();
	$result_id = GetNumericParam('result_id');

	$result_row = $result_dal->getByID($result_id);
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
?>
<form id='frmResultadoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar resultado</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtResultAtencID'>Atención:</label></td>
		<td><select id='txtResultAtencID' name='txtResultAtencID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $atenc_list = $atenc_dal->listarcbo($result_row['result_atenc_id']); ?>
			<?php foreach($atenc_list as $row) { ?>
				<option value='<?php echo $row['atenc_id']; ?>'
					<?php echo ($row['atenc_id'] == $result_row['atenc_id']) ? 'selected' : '';  ?>>
					<?php echo $row['atenc_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtResultDiagID'>Diagnóstico:</label></td>
		<td><select id='txtResultDiagID' name='txtResultDiagID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $diag_list = $diag_dal->listarcbo($result_row['result_diag_id']); ?>
			<?php foreach($diag_list as $row) { ?>
				<option value='<?php echo $row['diag_id']; ?>'
					<?php echo ($row['diag_id'] == $result_row['diag_id']) ? 'selected' : '';  ?>>
					<?php echo $row['diag_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
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
var result_upd = '#frmResultadoUpd';
$(document).ready(function(e) {
	$(result_upd).find('#txtResultAtencID').focus();
	$(result_upd).find('#btnActualizar').off('click').click(function(e) {
		if (result_validar()) {
			var result_id = '<?php echo $result_id; ?>';
			var result_atenc_id = $(result_upd).find('#txtResultAtencID').val();
			var result_diag_id = $(result_upd).find('#txtResultDiagID').val();

			$.post('vistas/resultado/proceso/resultado_update.php',{
				result_id : result_id,
				result_atenc_id : result_atenc_id,
				result_diag_id : result_diag_id
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
	$(result_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function result_validar() {
	var result_atenc_id = $(result_upd).find('#txtResultAtencID').val();
	var result_diag_id = $(result_upd).find('#txtResultDiagID').val();

	if (!(isInteger(result_atenc_id) && result_atenc_id > 0)) {
		showMessageWarning('Seleccione <b>atención</b>', 'txtResultAtencID');
		return false;
	}
	if (!(isInteger(result_diag_id) && result_diag_id > 0)) {
		showMessageWarning('Seleccione <b>diagnóstico</b>', 'txtResultDiagID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>