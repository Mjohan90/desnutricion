<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('cita_upd', 'vistas/atencion/cita.php');
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
	$atenc_id  = GetNumParam('atenc_id');
	
	$atenc_row = $atenc_dal->getByID($atenc_id);
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
<form id='frmAtencionUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Editar cita</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr>
    <td><label for='txtAtencPacID'>Paciente:</label></td>
    <td><select disabled id='txtAtencPacID' name='txtAtencPacID' class='txt300'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $pac_list = $pac_dal->listarcbo($atenc_row['atenc_pac_id']); ?>
			<?php foreach ($pac_list as $row) { ?>
                <option value='<?php echo $row['pac_id']; ?>'
					<?php echo ($row['pac_id'] == $atenc_row['pac_id']) ? 'selected' : ''; ?>>
					<?php echo $row['pers_nombre'], ' ', $row['pers_ap_materno'], ' ', $row['pers_ap_paterno']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtAtencEspecID'>Especialidad:</label></td>
    <td><select disabled id='txtAtencEspecID' name='txtAtencEspecID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $espec_list = $espec_dal->listar($atenc_row['atenc_espec_id']); ?>
			<?php foreach ($espec_list as $row) { ?>
                <option value='<?php echo $row['espec_id']; ?>'
					<?php echo ($row['espec_id'] == $atenc_row['espec_id']) ? 'selected' : ''; ?>>
					<?php echo $row['espec_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtAtencMedicoID'>Médico:</label></td>
    <td><select id='txtAtencMedicoID' name='txtAtencMedicoID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $empl_list = $empl_dal->listarMedicosByEspecialidad($atenc_row['espec_id']); ?>
			<?php foreach ($empl_list as $row) { ?>
                <option value='<?php echo $row['empl_id']; ?>'
					<?php echo ($row['empl_id'] == $atenc_row['empl_id']) ? 'selected' : ''; ?>>
					<?php echo $row['pers_nombre'], ' ', $row['pers_ap_materno'], ' ', $row['pers_ap_paterno']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr hidden>
    <td><label for='txtAtencFechaAtenc'>Fecha atención:</label></td>
    <td><input type='text' id='txtAtencFechaAtenc' name='txtAtencFechaAtenc' value='<?php if ($atenc_row) {
			echo formatDate($atenc_row['atenc_fecha_atenc']);
		} ?>' class='txt120' placeholder='00/00/0000'/></td>
</tr>
<tr hidden>
    <td><label for='txtAtencObservacion'>Observacion:</label></td>
    <td><input type='text' id='txtAtencObservacion' name='txtAtencObservacion' value='<?php if ($atenc_row) {
			echo htmlspecialchars($atenc_row['atenc_observacion']);
		} ?>' maxlength='400' placeholder='Ingrese observacion'/></td>
</tr>
<tr hidden>
    <td><label for='txtAtencTratamiento'>Tratamiento:</label></td>
    <td><input type='text' id='txtAtencTratamiento' name='txtAtencTratamiento' value='<?php if ($atenc_row) {
			echo htmlspecialchars($atenc_row['atenc_tratamiento']);
		} ?>' maxlength='400' placeholder='Ingrese tratamiento'/></td>
</tr>
<tr hidden>
    <td><label for='txtAtencDieta'>Dieta:</label></td>
    <td><input type='text' id='txtAtencDieta' name='txtAtencDieta' value='<?php if ($atenc_row) {
			echo htmlspecialchars($atenc_row['atenc_dieta']);
		} ?>' maxlength='300' placeholder='Ingrese dieta'/></td>
</tr>
<tr hidden>
    <td><label for='txtAtencSituacion'>Situacion:</label></td>
    <td><input type='text' id='txtAtencSituacion' name='txtAtencSituacion' value='<?php if ($atenc_row) {
			echo $atenc_row['atenc_situacion'];
		} ?>' placeholder='Ingrese situacion'/></td>
</tr>
<tr hidden>
    <td><label for='txtAtencEstado'>Estado:</label></td>
    <td><input type='text' id='txtAtencEstado' name='txtAtencEstado' value='<?php if ($atenc_row) {
			echo $atenc_row['atenc_estado'];
		} ?>' placeholder='Ingrese estado'/></td>
</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_naranja' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</form>
<br/>
<script>
var atenc_upd = '#frmAtencionUpd';
$(document).ready(function (e) {
    $(atenc_upd).find('#txtAtencPacID').focus();
    $(atenc_upd).find('#btnActualizar').off('click').click(function (e) {
        if (atenc_validar()) {
            var atenc_id          = '<?php echo $atenc_id; ?>';
            var atenc_pac_id      = $(atenc_upd).find('#txtAtencPacID').val();
            var atenc_medico_id   = $(atenc_upd).find('#txtAtencMedicoID').val();
            var atenc_espec_id    = $(atenc_upd).find('#txtAtencEspecID').val();
            var atenc_fecha_atenc = getDateYMD($(atenc_upd).find('#txtAtencFechaAtenc').val());
            var atenc_observacion = $(atenc_upd).find('#txtAtencObservacion').val();
            var atenc_tratamiento = $(atenc_upd).find('#txtAtencTratamiento').val();
            var atenc_dieta       = $(atenc_upd).find('#txtAtencDieta').val();
            var atenc_situacion   = $(atenc_upd).find('#txtAtencSituacion').val();
            var atenc_estado      = $(atenc_upd).find('#txtAtencEstado').val();

            $.post('vistas/atencion/proceso/atencion_update.php', {
                    atenc_id         : atenc_id,
                    atenc_pac_id     : atenc_pac_id,
                    atenc_medico_id  : atenc_medico_id,
                    atenc_espec_id   : atenc_espec_id,
                    atenc_fecha_atenc: atenc_fecha_atenc,
                    atenc_observacion: atenc_observacion,
                    atenc_tratamiento: atenc_tratamiento,
                    atenc_dieta      : atenc_dieta,
                    atenc_situacion  : atenc_situacion,
                    atenc_estado     : atenc_estado
                },
                function (datos) {
                    if (datos == 1) {
                        alert('Actualizacion correcta');
                        volver();
                    } else {
                        alert('Error al actualizar. ' + datos);
                    }
                });
        }
    });
    $(atenc_upd).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function atenc_validar() {
    var atenc_pac_id      = $(atenc_upd).find('#txtAtencPacID').val();
    var atenc_medico_id   = $(atenc_upd).find('#txtAtencMedicoID').val();
    var atenc_espec_id    = $(atenc_upd).find('#txtAtencEspecID').val();
    var atenc_fecha_atenc = $(atenc_upd).find('#txtAtencFechaAtenc').val();
    var atenc_observacion = $(atenc_upd).find('#txtAtencObservacion').val();
    var atenc_tratamiento = $(atenc_upd).find('#txtAtencTratamiento').val();
    var atenc_dieta       = $(atenc_upd).find('#txtAtencDieta').val();
    var atenc_situacion   = $(atenc_upd).find('#txtAtencSituacion').val();

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
        // showMessageWarning('Ingrese una <b>observacion</b> válida', 'txtAtencObservacion');
        // return false;
    }
    if (atenc_tratamiento == '') {
        // showMessageWarning('Ingrese una <b>tratamiento</b> válida', 'txtAtencTratamiento');
        // return false;
    }
    if (atenc_dieta == '') {
        // showMessageWarning('Ingrese una <b>dieta</b> válida', 'txtAtencDieta');
        // return false;
    }
    if (!isTinyint(atenc_situacion)) {
        // showMessageWarning('Ingrese un valor de <b>situacion</b> válido', 'txtAtencSituacion');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
