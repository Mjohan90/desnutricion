<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('result_reg', 'vistas/resultado/resultado.php');
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
?>
<form id='frmResultadoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar resultado</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtResultAtencID'>Atención:</label></td>
		<td><select id='txtResultAtencID' name='txtResultAtencID'> <!-- maxlength='10' -->
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
	<tr><td><label for='txtResultDiagID'>Diagnóstico:</label></td>
		<td><select id='txtResultDiagID' name='txtResultDiagID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $diag_list = $diag_dal->listarcbo(); ?>
			<?php foreach($diag_list as $row) { ?>
				<option value='<?php echo $row['diag_id']; ?>'>
					<?php echo $row['diag_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
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
var result_reg = '#frmResultadoReg';
$(document).ready(function(e) {
	$(result_reg).find('#txtResultAtencID').focus();
	$(result_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (result_validar()){
			var result_atenc_id = $(result_reg).find('#txtResultAtencID').val();
			var result_diag_id = $(result_reg).find('#txtResultDiagID').val();

			$.post('vistas/resultado/proceso/resultado_insert.php',{
				result_atenc_id : result_atenc_id,
				result_diag_id : result_diag_id
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
	$(result_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function result_validar() {
	var result_atenc_id = $(result_reg).find('#txtResultAtencID').val();
	var result_diag_id = $(result_reg).find('#txtResultDiagID').val();

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