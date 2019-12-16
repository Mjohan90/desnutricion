<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('diag_upd', 'vistas/diagnostico/diagnostico.php');
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
	$diag_id = GetNumParam('diag_id');

	$diag_row = $diag_dal->getByID($diag_id);
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	include_once '../../datos/enfermedadDAL.php';
	$enferm_dal = new enfermedadDAL();
?>
<form id='frmDiagnosticoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2 blanco'>Editar diagnóstico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtDiagAtencID'>Atención:</label></td>
		<td><select id='txtDiagAtencID' name='txtDiagAtencID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $atenc_list = $atenc_dal->listarcbo($diag_row['diag_atenc_id']); ?>
			<?php foreach($atenc_list as $row) { ?>
				<option value='<?php echo $row['atenc_id']; ?>'
					<?php echo ($row['atenc_id'] == $diag_row['atenc_id']) ? 'selected' : '';  ?>>
					<?php echo $row['atenc_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtDiagEnfermID'>Enfermedad:</label></td>
		<td><select id='txtDiagEnfermID' name='txtDiagEnfermID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $enferm_list = $enferm_dal->listarcbo($diag_row['diag_enferm_id']); ?>
			<?php foreach($enferm_list as $row) { ?>
				<option value='<?php echo $row['enferm_id']; ?>'
					<?php echo ($row['enferm_id'] == $diag_row['enferm_id']) ? 'selected' : '';  ?>>
					<?php echo $row['enferm_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_naranja' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var diag_upd = '#frmDiagnosticoUpd';
$(document).ready(function(e) {
	$(diag_upd).find('#txtDiagAtencID').focus();
	$(diag_upd).find('#btnActualizar').off('click').click(function(e) {
		if (diag_validar()) {
			var diag_id = '<?php echo $diag_id; ?>';
			var diag_atenc_id = $(diag_upd).find('#txtDiagAtencID').val();
			var diag_enferm_id = $(diag_upd).find('#txtDiagEnfermID').val();

			$.post('vistas/diagnostico/proceso/diagnostico_update.php',{
				diag_id : diag_id,
				diag_atenc_id : diag_atenc_id,
				diag_enferm_id : diag_enferm_id
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
	$(diag_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function diag_validar() {
	var diag_atenc_id = $(diag_upd).find('#txtDiagAtencID').val();
	var diag_enferm_id = $(diag_upd).find('#txtDiagEnfermID').val();

	if (!(isInteger(diag_atenc_id) && diag_atenc_id > 0)) {
		showMessageWarning('Seleccione <b>atención</b>', 'txtDiagAtencID');
		return false;
	}
	if (!(isInteger(diag_enferm_id) && diag_enferm_id > 0)) {
		showMessageWarning('Seleccione <b>enfermedad</b>', 'txtDiagEnfermID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
