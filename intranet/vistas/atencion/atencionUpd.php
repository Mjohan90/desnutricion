<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('atenc_upd', 'vistas/atencion/atencion.php');
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
	$atenc_id  = GetNumParam('atenc_id');
	
	$atenc_row = $atenc_dal->getByID($atenc_id);
	$pac_row   = $pac_dal->getByID($atenc_row['pac_id']);
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
?>
<?php
	include_once '../../datos/especialidadDAL.php';
	$espec_dal = new especialidadDAL();
?>

<form id='frmAtencionUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Procesar atención</span>
</div>
<hr class='separator'/>
<div class='inline' style='vertical-align: top;'>
<table class='form_data'>
<tr hidden>
    <td>Paciente ID</td>
    <td><select hidden id='txtAtencPacID' name='txtAtencPacID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $pac_list = $pac_dal->listarcbo($atenc_row['atenc_pac_id']); ?>
			<?php foreach ($pac_list as $row) { ?>
                <option value='<?php echo $row['pac_id']; ?>'
					<?php echo ($row['pac_id'] == $atenc_row['pac_id']) ? 'selected' : ''; ?>>
					<?php echo $row['pac_id']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtAtencPacID'>Paciente:</label></td>
    <td><span><?= $pac_row['pers_nombre'], ' ', $pac_row['pers_ap_paterno'], ' ', $pac_row['pers_ap_materno']; ?></span>
    </td>
</tr>
<tr>
    <td><label>D.I.:</label></td>
    <td><span><?= $pac_row['tdi_abrev'], ' - ', $pac_row['pers_tdi_nro'] ?></span>
    </td>
</tr>
<tr>
    <td><label>Edad:</label></td>
	<?php $edad = edad(todayYMD(), $pac_row['pers_fecha_nac'], true); ?>
    <td><span><?= $edad['anios'] ?> años</span> - Fecha Nac: <?= formatDate($pac_row['pers_fecha_nac']) ?> </td>
</tr>
<tr hidden>
    <td><label for='txtAtencMedicoID'>Empleado:</label></td>
    <td><select id='txtAtencMedicoID' name='txtAtencMedicoID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $empl_list = $empl_dal->listarcbo($atenc_row['atenc_medico_id']); ?>
			<?php foreach ($empl_list as $row) { ?>
                <option value='<?php echo $row['empl_id']; ?>'
					<?php echo ($row['empl_id'] == $atenc_row['empl_id']) ? 'selected' : ''; ?>>
					<?php echo $row['empl_id']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr hidden>
    <td><label for='txtAtencEspecID'>Especialidad:</label></td>
    <td><select id='txtAtencEspecID' name='txtAtencEspecID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $espec_list = $espec_dal->listarcbo($atenc_row['atenc_espec_id']); ?>
			<?php foreach ($espec_list as $row) { ?>
                <option value='<?php echo $row['espec_id']; ?>'
					<?php echo ($row['espec_id'] == $atenc_row['espec_id']) ? 'selected' : ''; ?>>
					<?php echo $row['espec_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr hidden>
    <td><label for='txtAtencFechaAtenc'>Fecha atenc:</label></td>
    <td><input type='text' id='txtAtencFechaAtenc' name='txtAtencFechaAtenc' value='<?php if ($atenc_row) {
			echo formatDate($atenc_row['atenc_fecha_atenc']);
		} ?>' placeholder='Ingrese fecha atenc'/></td>
</tr>
<tr>
    <td colspan='2'>
        <div>
            <hr class='separator_bold'>
            <br>
            <!--            <a href='#' class='btn'>Ver ficha tecnica</a>-->
            <a href='#' id='btnTriaje' class='btn b_verde'>Triaje</a>
            <a href='#' id='btnVerResultados' class='btn b_verde'>Ver resultados experto</a>
            <!--            <a href='#' class='btn'>Ver grafico evolución</a>-->
        </div>
    </td>
</tr>
<tr>
    <td><label for='txtAtencObservacion'>Observacion:</label></td>
    <td><textarea id='txtAtencObservacion' name='txtAtencObservacion' maxlength='200' rows='5' cols='50'
                  class='' placeholder=''><?php if ($atenc_row) {
				echo htmlspecialchars($atenc_row['atenc_observacion']);
			} ?></textarea>
    </td>
</tr>
<tr>
    <td><label for='txtAtencTratamiento'>Tratamiento:</label></td>
    <td><textarea id='txtAtencTratamiento' name='txtAtencTratamiento' maxlength='200' rows='5' cols='50'
                  class='' placeholder=''><?php if ($atenc_row) {
				echo htmlspecialchars($atenc_row['atenc_tratamiento']);
			} ?></textarea>
    </td>
</tr>
<tr>
    <td><label for='txtAtencDieta'>Dieta:</label></td>
    <td> <textarea id='txtAtencDieta' name='txtAtencDieta' maxlength='200' rows='5' cols='50'
                   class='' placeholder=''><?php if ($atenc_row) {
				echo htmlspecialchars($atenc_row['atenc_dieta']);
			} ?></textarea>
    </td>
</tr>
<tr hidden>
    <td><label for='txtAtencSituacion'>Situacion:</label></td>
    <td><input type='text' id='txtAtencSituacion' name='txtAtencSituacion' value='<?php if ($atenc_row) {
			echo ATENCION_ATENDIDO; // echo $atenc_row['atenc_situacion'];
		} ?>' placeholder='Ingrese situacion'/></td>
</tr>
<tr hidden>
    <td><label for='txtAtencEstado'>Estado:</label></td>
    <td><input type='text' id='txtAtencEstado' name='txtAtencEstado' value='<?php if ($atenc_row) {
			echo $atenc_row['atenc_estado'];
		} ?>' placeholder='Ingrese estado'/></td>
</tr>
</table>
</div>
<div id='divResultado' class='inline' style='vertical-align: top;'></div>
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

    $(atenc_upd).find('#btnTriaje').off('click').click(function (e) {
        performLoad('vistas/triaje/triajeReg.php?atenc_id=<?= $atenc_id; ?>&parent=vistas/atencion/atencionUpd.php?atenc_id=<?= $atenc_id; ?>');
    });

    $(atenc_upd).find('#btnVerResultados').off('click').click(function (e) {
        $('#divResultado').load('vistas/atencion/resultado.php');
    });

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
