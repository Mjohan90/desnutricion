<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('empl_reg', 'vistas/empleado/empleado.php');
?>
<?php
	include_once '../../datos/cargoDAL.php';
	$carg_dal = new cargoDAL();
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<form id='frmEmpleadoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar empleado</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtEmplPersID'>Persona:</label></td>
		<td><select id='txtEmplPersID' name='txtEmplPersID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo(); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtEmplCargID'>Cargo:</label></td>
		<td><select id='txtEmplCargID' name='txtEmplCargID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $carg_list = $carg_dal->listarcbo(); ?>
			<?php foreach($carg_list as $row) { ?>
				<option value='<?php echo $row['carg_id']; ?>'>
					<?php echo $row['carg_nombre'];  ?>
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
var empl_reg = '#frmEmpleadoReg';
$(document).ready(function(e) {
	$(empl_reg).find('#txtEmplPersID').focus();
	$(empl_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (empl_validar()){
			var empl_pers_id = $(empl_reg).find('#txtEmplPersID').val();
			var empl_carg_id = $(empl_reg).find('#txtEmplCargID').val();

			$.post('vistas/empleado/proceso/empleado_insert.php',{
				empl_pers_id : empl_pers_id,
				empl_carg_id : empl_carg_id
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
	$(empl_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function empl_validar() {
	var empl_pers_id = $(empl_reg).find('#txtEmplPersID').val();
	var empl_carg_id = $(empl_reg).find('#txtEmplCargID').val();

	if (!(isInteger(empl_pers_id) && empl_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtEmplPersID');
		return false;
	}
	if (!(isInteger(empl_carg_id) && empl_carg_id > 0)) {
		showMessageWarning('Seleccione <b>cargo</b>', 'txtEmplCargID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>