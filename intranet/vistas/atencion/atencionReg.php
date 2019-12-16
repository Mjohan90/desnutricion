<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('atenc_reg', 'vistas/atencion/atencion.php');
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
?>
<?php
	include_once '../../datos/especialidadDAL.php';
	$espec_dal = new especialidadDAL();
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
?>
<form id='frmAtencionReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar atención</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtAtencPacID'>Paciente:</label></td>
		<td><select id='txtAtencPacID' name='txtAtencPacID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pac_list = $pac_dal->listarcbo(); ?>
			<?php foreach($pac_list as $row) { ?>
				<option value='<?php echo $row['pac_id']; ?>'>
					<?php echo $row['pac_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtAtencMedicoID'>Empleado:</label></td>
		<td><select id='txtAtencMedicoID' name='txtAtencMedicoID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $empl_list = $empl_dal->listarcbo(); ?>
			<?php foreach($empl_list as $row) { ?>
				<option value='<?php echo $row['empl_id']; ?>'>
					<?php echo $row['empl_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtAtencEspecID'>Especialidad:</label></td>
		<td><select id='txtAtencEspecID' name='txtAtencEspecID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $espec_list = $espec_dal->listarcbo(); ?>
			<?php foreach($espec_list as $row) { ?>
				<option value='<?php echo $row['espec_id']; ?>'>
					<?php echo $row['espec_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtAtencFechaAtenc'>Fecha atenc:</label></td>
		<td><input type='text' id='txtAtencFechaAtenc' name='txtAtencFechaAtenc'  placeholder='Ingrese fecha atenc'/></td>
	</tr>
	<tr><td><label for='txtAtencObservacion'>Observacion:</label></td>
		<td><input type='text' id='txtAtencObservacion' name='txtAtencObservacion' maxlength='400' placeholder='Ingrese observacion'/></td>
	</tr>
	<tr><td><label for='txtAtencTratamiento'>Tratamiento:</label></td>
		<td><input type='text' id='txtAtencTratamiento' name='txtAtencTratamiento' maxlength='400' placeholder='Ingrese tratamiento'/></td>
	</tr>
	<tr><td><label for='txtAtencDieta'>Dieta:</label></td>
		<td><input type='text' id='txtAtencDieta' name='txtAtencDieta' maxlength='300' placeholder='Ingrese dieta'/></td>
	</tr>
	<tr><td><label for='txtAtencSituacion'>Situacion:</label></td>
		<td><input type='text' id='txtAtencSituacion' name='txtAtencSituacion'  placeholder='Ingrese situacion'/></td>
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
var atenc_reg = '#frmAtencionReg';
$(document).ready(function(e) {
	$(atenc_reg).find('#txtAtencPacID').focus();
	$(atenc_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (atenc_validar()){
			var atenc_pac_id = $(atenc_reg).find('#txtAtencPacID').val();
			var atenc_medico_id = $(atenc_reg).find('#txtAtencMedicoID').val();
			var atenc_espec_id = $(atenc_reg).find('#txtAtencEspecID').val();
			var atenc_fecha_atenc = getDateYMD($(atenc_reg).find('#txtAtencFechaAtenc').val());
			var atenc_observacion = $(atenc_reg).find('#txtAtencObservacion').val();
			var atenc_tratamiento = $(atenc_reg).find('#txtAtencTratamiento').val();
			var atenc_dieta = $(atenc_reg).find('#txtAtencDieta').val();
			var atenc_situacion = $(atenc_reg).find('#txtAtencSituacion').val();

			$.post('vistas/atencion/proceso/atencion_insert.php',{
				atenc_pac_id : atenc_pac_id,
				atenc_medico_id : atenc_medico_id,
				atenc_espec_id : atenc_espec_id,
				atenc_fecha_atenc : atenc_fecha_atenc,
				atenc_observacion : atenc_observacion,
				atenc_tratamiento : atenc_tratamiento,
				atenc_dieta : atenc_dieta,
				atenc_situacion : atenc_situacion
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
	$(atenc_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function atenc_validar() {
	var atenc_pac_id = $(atenc_reg).find('#txtAtencPacID').val();
	var atenc_medico_id = $(atenc_reg).find('#txtAtencMedicoID').val();
	var atenc_espec_id = $(atenc_reg).find('#txtAtencEspecID').val();
	var atenc_fecha_atenc = $(atenc_reg).find('#txtAtencFechaAtenc').val();
	var atenc_observacion = $(atenc_reg).find('#txtAtencObservacion').val();
	var atenc_tratamiento = $(atenc_reg).find('#txtAtencTratamiento').val();
	var atenc_dieta = $(atenc_reg).find('#txtAtencDieta').val();
	var atenc_situacion = $(atenc_reg).find('#txtAtencSituacion').val();

	if (!(isInteger(atenc_pac_id) && atenc_pac_id > 0)) {
		showMessageWarning('Seleccione <b>paciente</b>', 'txtAtencPacID');
		return false;
	}
	if (!(isInteger(atenc_medico_id) && atenc_medico_id > 0)) {
		showMessageWarning('Seleccione <b>empleado</b>', 'txtAtencMedicoID');
		return false;
	}
	if (!(isInteger(atenc_espec_id) && atenc_espec_id > 0)) {
		showMessageWarning('Seleccione <b>especialidad</b>', 'txtAtencEspecID');
		return false;
	}
	if (!isDate(atenc_fecha_atenc)) {
		showMessageWarning('Ingrese una <b>fecha atenc</b> válida', 'txtAtencFechaAtenc');
		return false;
	}
	if (atenc_observacion == '') {
		showMessageWarning('Ingrese una <b>observacion</b> válida', 'txtAtencObservacion');
		return false;
	}
	if (atenc_tratamiento == '') {
		showMessageWarning('Ingrese una <b>tratamiento</b> válida', 'txtAtencTratamiento');
		return false;
	}
	if (atenc_dieta == '') {
		showMessageWarning('Ingrese una <b>dieta</b> válida', 'txtAtencDieta');
		return false;
	}
	if (!isTinyint(atenc_situacion)) {
		showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtAtencSituacion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>