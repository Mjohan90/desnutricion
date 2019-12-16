<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('percent_reg', 'vistas/percentil/percentil.php');
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
?>
<form id='frmPercentilReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar percentil</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPercentSexo'>Sexo:</label></td>
		<td><input type='text' id='txtPercentSexo' name='txtPercentSexo' maxlength='1' placeholder='Ingrese sexo'/></td>
	</tr>
	<tr><td><label for='txtPercentIndicID'>Indicador:</label></td>
		<td><select id='txtPercentIndicID' name='txtPercentIndicID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $indic_list = $indic_dal->listarcbo(); ?>
			<?php foreach($indic_list as $row) { ?>
				<option value='<?php echo $row['indic_id']; ?>'>
					<?php echo $row['indic_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtPercentVar1Valor'>Var1 valor:</label></td>
		<td><input type='text' id='txtPercentVar1Valor' name='txtPercentVar1Valor' maxlength='9' placeholder='Ingrese var1 valor'/></td>
	</tr>
	<tr><td><label for='txtPercentVar2Valor'>Var2 valor:</label></td>
		<td><input type='text' id='txtPercentVar2Valor' name='txtPercentVar2Valor' maxlength='9' placeholder='Ingrese var2 valor'/></td>
	</tr>
	<tr><td><label for='txtPercentPercentil'>Percentil:</label></td>
		<td><input type='text' id='txtPercentPercentil' name='txtPercentPercentil' maxlength='9' placeholder='Ingrese percentil'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
	<input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
	<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var percent_reg = '#frmPercentilReg';
$(document).ready(function(e) {
	$(percent_reg).find('#txtPercentSexo').focus();
	$(percent_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (percent_validar()){
			var percent_sexo = $(percent_reg).find('#txtPercentSexo').val();
			var percent_indic_id = $(percent_reg).find('#txtPercentIndicID').val();
			var percent_var1_valor = $(percent_reg).find('#txtPercentVar1Valor').val();
			var percent_var2_valor = $(percent_reg).find('#txtPercentVar2Valor').val();
			var percent_percentil = $(percent_reg).find('#txtPercentPercentil').val();

			$.post('vistas/percentil/proceso/percentil_insert.php',{
				percent_sexo : percent_sexo,
				percent_indic_id : percent_indic_id,
				percent_var1_valor : percent_var1_valor,
				percent_var2_valor : percent_var2_valor,
				percent_percentil : percent_percentil
			},
			function(datos) {
				if (datos > 0) {
					alert('Registro correcto');
					volver();
				} else {
					alert('Error al registrar. ' + datos);
				}
			});
		}
	});
	$(percent_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function percent_validar() {
	var percent_sexo = $(percent_reg).find('#txtPercentSexo').val();
	var percent_indic_id = $(percent_reg).find('#txtPercentIndicID').val();
	var percent_var1_valor = $(percent_reg).find('#txtPercentVar1Valor').val();
	var percent_var2_valor = $(percent_reg).find('#txtPercentVar2Valor').val();
	var percent_percentil = $(percent_reg).find('#txtPercentPercentil').val();

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