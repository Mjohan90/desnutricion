<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('regla_upd', 'vistas/reglas/reglas.php');
?>
<?php
	include_once '../../datos/reglasDAL.php';
	$regla_dal = new reglasDAL();
	$regla_id = GetNumericParam('regla_id');

	$regla_row = $regla_dal->getByID($regla_id);
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
?>
<form id='frmReglasUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar reglas</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtReglaIndic1ID'>Indicador:</label></td>
		<td><select id='txtReglaIndic1ID' name='txtReglaIndic1ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $indic_list = $indic_dal->listarcbo($regla_row['regla_indic1_id']); ?>
			<?php foreach($indic_list as $row) { ?>
				<option value='<?php echo $row['indic_id']; ?>'
					<?php echo ($row['indic_id'] == $regla_row['indic_id']) ? 'selected' : '';  ?>>
					<?php echo $row['indic_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtReglaIndic2ID'>Indicador:</label></td>
		<td><select id='txtReglaIndic2ID' name='txtReglaIndic2ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $indic_list = $indic_dal->listarcbo($regla_row['regla_indic2_id']); ?>
			<?php foreach($indic_list as $row) { ?>
				<option value='<?php echo $row['indic_id']; ?>'
					<?php echo ($row['indic_id'] == $regla_row['indic_id']) ? 'selected' : '';  ?>>
					<?php echo $row['indic_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtReglaFormula'>Formula:</label></td>
		<td><input type='text' id='txtReglaFormula' name='txtReglaFormula' value='<?php if ($regla_row) { echo htmlspecialchars($regla_row['regla_formula']); } ?>' maxlength='200' placeholder='Ingrese formula'/></td>
	</tr>
	<tr><td><label for='txtReglaDiagID'>Diagnóstico:</label></td>
		<td><select id='txtReglaDiagID' name='txtReglaDiagID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $diag_list = $diag_dal->listarcbo($regla_row['regla_diag_id']); ?>
			<?php foreach($diag_list as $row) { ?>
				<option value='<?php echo $row['diag_id']; ?>'
					<?php echo ($row['diag_id'] == $regla_row['diag_id']) ? 'selected' : '';  ?>>
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
var regla_upd = '#frmReglasUpd';
$(document).ready(function(e) {
	$(regla_upd).find('#txtReglaIndic1ID').focus();
	$(regla_upd).find('#btnActualizar').off('click').click(function(e) {
		if (regla_validar()) {
			var regla_id = '<?php echo $regla_id; ?>';
			var regla_indic1_id = $(regla_upd).find('#txtReglaIndic1ID').val();
			var regla_indic2_id = $(regla_upd).find('#txtReglaIndic2ID').val();
			var regla_formula = $(regla_upd).find('#txtReglaFormula').val();
			var regla_diag_id = $(regla_upd).find('#txtReglaDiagID').val();

			$.post('vistas/reglas/proceso/reglas_update.php',{
				regla_id : regla_id,
				regla_indic1_id : regla_indic1_id,
				regla_indic2_id : regla_indic2_id,
				regla_formula : regla_formula,
				regla_diag_id : regla_diag_id
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
	$(regla_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function regla_validar() {
	var regla_indic1_id = $(regla_upd).find('#txtReglaIndic1ID').val();
	var regla_indic2_id = $(regla_upd).find('#txtReglaIndic2ID').val();
	var regla_formula = $(regla_upd).find('#txtReglaFormula').val();
	var regla_diag_id = $(regla_upd).find('#txtReglaDiagID').val();

	if (!(isInteger(regla_indic1_id) && regla_indic1_id > 0)) {
		showMessageWarning('Seleccione <b>indicador</b>', 'txtReglaIndic1ID');
		return false;
	}
	if (!(isInteger(regla_indic2_id) && regla_indic2_id > 0)) {
		showMessageWarning('Seleccione <b>indicador</b>', 'txtReglaIndic2ID');
		return false;
	}
	if (regla_formula == '') {
		showMessageWarning('Ingrese una <b>formula</b> válida', 'txtReglaFormula');
		return false;
	}
	if (!(isInteger(regla_diag_id) && regla_diag_id > 0)) {
		showMessageWarning('Seleccione <b>diagnóstico</b>', 'txtReglaDiagID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>