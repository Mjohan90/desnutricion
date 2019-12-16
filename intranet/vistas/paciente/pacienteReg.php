<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('pac_reg', 'vistas/paciente/paciente.php');
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<form id='frmPacienteReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar paciente</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPacPersID'>Persona:</label></td>
		<td><select id='txtPacPersID' name='txtPacPersID'> <!-- maxlength='10' -->
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
</table>
<hr class='separator'/>
<div class='form_foot'>
	<input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
	<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var pac_reg = '#frmPacienteReg';
$(document).ready(function(e) {
	$(pac_reg).find('#txtPacPersID').focus();
	$(pac_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (pac_validar()){
			var pac_pers_id = $(pac_reg).find('#txtPacPersID').val();

			$.post('vistas/paciente/proceso/paciente_insert.php',{
				pac_pers_id : pac_pers_id
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
	$(pac_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function pac_validar() {
	var pac_pers_id = $(pac_reg).find('#txtPacPersID').val();

	if (!(isInteger(pac_pers_id) && pac_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtPacPersID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>