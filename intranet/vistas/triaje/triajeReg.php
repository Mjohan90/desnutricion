<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('triaje_reg', 'vistas/triaje/triaje.php');
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
<form id='frmTriajeReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar triaje</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTriajeAtencID'>Atención:</label></td>
		<td><select id='txtTriajeAtencID' name='txtTriajeAtencID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $atenc_list = $atenc_dal->listarcbo(); ?>
			<?php foreach($atenc_list as $row) { ?>
				<option value='<?php echo $row['atenc_id']; ?>'>
					<?php echo $row['atenc_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtTriajeVarID'>Variable:</label></td>
		<td><select id='txtTriajeVarID' name='txtTriajeVarID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $var_list = $var_dal->listarcbo(); ?>
			<?php foreach($var_list as $row) { ?>
				<option value='<?php echo $row['var_id']; ?>'>
					<?php echo $row['var_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtTriajeUmID'>Unidad de medida:</label></td>
		<td><select id='txtTriajeUmID' name='txtTriajeUmID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $um_list = $um_dal->listarcbo(); ?>
			<?php foreach($um_list as $row) { ?>
				<option value='<?php echo $row['um_id']; ?>'>
					<?php echo $row['um_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtTriajeValor'>Valor:</label></td>
		<td><input type='text' id='txtTriajeValor' name='txtTriajeValor' maxlength='9' placeholder='Ingrese valor'/></td>
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
var triaje_reg = '#frmTriajeReg';
$(document).ready(function(e) {
	$(triaje_reg).find('#txtTriajeAtencID').focus();
	$(triaje_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (triaje_validar()){
			var triaje_atenc_id = $(triaje_reg).find('#txtTriajeAtencID').val();
			var triaje_var_id = $(triaje_reg).find('#txtTriajeVarID').val();
			var triaje_um_id = $(triaje_reg).find('#txtTriajeUmID').val();
			var triaje_valor = $(triaje_reg).find('#txtTriajeValor').val();

			$.post('vistas/triaje/proceso/triaje_insert.php',{
				triaje_atenc_id : triaje_atenc_id,
				triaje_var_id : triaje_var_id,
				triaje_um_id : triaje_um_id,
				triaje_valor : triaje_valor
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
	$(triaje_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function triaje_validar() {
	var triaje_atenc_id = $(triaje_reg).find('#txtTriajeAtencID').val();
	var triaje_var_id = $(triaje_reg).find('#txtTriajeVarID').val();
	var triaje_um_id = $(triaje_reg).find('#txtTriajeUmID').val();
	var triaje_valor = $(triaje_reg).find('#txtTriajeValor').val();

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