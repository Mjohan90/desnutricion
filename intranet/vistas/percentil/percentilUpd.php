<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('percent_upd', 'vistas/percentil/percentil.php');
?>
<?php
	include_once '../../datos/percentilDAL.php';
	$percent_dal = new percentilDAL();
	$percent_id = GetNumParam('percent_id');

	$percent_row = $percent_dal->getByID($percent_id);
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
?>
<form id='frmPercentilUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar percentil</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPercentSexo'>Sexo:</label></td>
		<td><input type='text' id='txtPercentSexo' name='txtPercentSexo' value='<?php if ($percent_row) { echo htmlspecialchars($percent_row['percent_sexo']); } ?>' maxlength='1' placeholder='Ingrese sexo'/></td>
	</tr>
	<tr><td><label for='txtPercentIndicID'>Indicador:</label></td>
		<td><select id='txtPercentIndicID' name='txtPercentIndicID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $indic_list = $indic_dal->listarcbo($percent_row['percent_indic_id']); ?>
			<?php foreach($indic_list as $row) { ?>
				<option value='<?php echo $row['indic_id']; ?>'
					<?php echo ($row['indic_id'] == $percent_row['indic_id']) ? 'selected' : '';  ?>>
					<?php echo $row['indic_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtPercentVar1Valor'>Var1 valor:</label></td>
		<td><input type='text' id='txtPercentVar1Valor' name='txtPercentVar1Valor' value='<?php if ($percent_row) { echo $percent_row['percent_var1_valor']; } ?>' maxlength='9' placeholder='Ingrese var1 valor'/></td>
	</tr>
	<tr><td><label for='txtPercentVar2Valor'>Var2 valor:</label></td>
		<td><input type='text' id='txtPercentVar2Valor' name='txtPercentVar2Valor' value='<?php if ($percent_row) { echo $percent_row['percent_var2_valor']; } ?>' maxlength='9' placeholder='Ingrese var2 valor'/></td>
	</tr>
	<tr><td><label for='txtPercentPercentil'>Percentil:</label></td>
		<td><input type='text' id='txtPercentPercentil' name='txtPercentPercentil' value='<?php if ($percent_row) { echo $percent_row['percent_percentil']; } ?>' maxlength='9' placeholder='Ingrese percentil'/></td>
	</tr>
	<tr hidden><td><label for='txtPercentEstado'>Estado:</label></td>
		<td><input type='text' id='txtPercentEstado' name='txtPercentEstado' value='<?php if ($percent_row) { echo $percent_row['percent_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var percent_upd = '#frmPercentilUpd';
$(document).ready(function(e) {
	$(percent_upd).find('#txtPercentSexo').focus();
	$(percent_upd).find('#btnActualizar').off('click').click(function(e) {
		if (percent_validar()) {
			var percent_id = '<?php echo $percent_id; ?>';
			var percent_sexo = $(percent_upd).find('#txtPercentSexo').val();
			var percent_indic_id = $(percent_upd).find('#txtPercentIndicID').val();
			var percent_var1_valor = $(percent_upd).find('#txtPercentVar1Valor').val();
			var percent_var2_valor = $(percent_upd).find('#txtPercentVar2Valor').val();
			var percent_percentil = $(percent_upd).find('#txtPercentPercentil').val();
			var percent_estado = $(percent_upd).find('#txtPercentEstado').val();

			$.post('vistas/percentil/proceso/percentil_update.php',{
				percent_id : percent_id,
				percent_sexo : percent_sexo,
				percent_indic_id : percent_indic_id,
				percent_var1_valor : percent_var1_valor,
				percent_var2_valor : percent_var2_valor,
				percent_percentil : percent_percentil,
				percent_estado : percent_estado
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
	$(percent_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function percent_validar() {
	var percent_sexo = $(percent_upd).find('#txtPercentSexo').val();
	var percent_indic_id = $(percent_upd).find('#txtPercentIndicID').val();
	var percent_var1_valor = $(percent_upd).find('#txtPercentVar1Valor').val();
	var percent_var2_valor = $(percent_upd).find('#txtPercentVar2Valor').val();
	var percent_percentil = $(percent_upd).find('#txtPercentPercentil').val();

	if (percent_sexo == '') {
		showMessageWarning('Ingrese <b>sexo</b>', 'txtPercentSexo');
		return false;
	}
	if (!(isInteger(percent_indic_id) && percent_indic_id > 0)) {
		showMessageWarning('Seleccione <b>indicador</b>', 'txtPercentIndicID');
		return false;
	}
	if (!isNumeric(percent_var1_valor)) {
		showMessageWarning('Ingrese <b>var1 valor</b> válido', 'txtPercentVar1Valor');
		return false;
	}
	if (!isNumeric(percent_var2_valor)) {
		showMessageWarning('Ingrese <b>var2 valor</b> válido', 'txtPercentVar2Valor');
		return false;
	}
	if (!isNumeric(percent_percentil)) {
		showMessageWarning('Ingrese <b>percentil</b> válido', 'txtPercentPercentil');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
