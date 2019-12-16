<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('empl_upd', 'vistas/empleado/empleado.php');
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
	$empl_id  = GetNumericParam('empl_id');
	
	$empl_row = $empl_dal->getByID($empl_id);
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
	$pers_row = $pers_dal->getByID($empl_row['pers_id']);
?>
<?php
	include_once '../../datos/cargoDAL.php';
	$carg_dal = new cargoDAL();
?>
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
?>
<form id='frmEmpleadoUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Editar empleado</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr hidden>
    <td><label for='txtEmplPersID'>Persona:</label></td>
    <td><input type='text' id='txtEmplPersID' name='txtEmplPersID' value='<?php if ($empl_row) {
			echo $empl_row['pers_id'];
		} ?>' maxlength='10' placeholder='Persona ID'/>
    </td>
</tr>
<tr>
    <td><label for='txtPersTdiID'>Doc. Identidad:</label></td>
    <td><select id='txtPersTdiID' name='txtTdiID' class='txt110'>
            <option value='0'>(Seleccione)</option>
			<?php $tdi_list = $tdi_dal->listarcbo(); ?>
			<?php foreach ($tdi_list as $row) { ?>
                <option value='<?php echo $row['tdi_id']; ?>'
					<?php echo ($pers_row['tdi_id'] == $row['tdi_id']) ? 'selected' : ''; ?>>
					<?php echo $row['tdi_abrev']; ?>
                </option>
			<?php } ?>
        </select>
        <input type='text' id='txtPersTdiNro' name='txtPersTdiNro' value='<?php if ($pers_row) {
			echo $pers_row['pers_tdi_nro'];
		} ?>' maxlength='20' class='txt100' placeholder='00000000'/>
    </td>
</tr>
<tr>
    <td><label for='txtPersNombre'>Nombre:</label></td>
    <td><input type='text' id='txtPersNombre' name='txtPersNombre' value='<?php if ($pers_row) {
			echo $pers_row['pers_nombre'];
		} ?>' maxlength='30'
               placeholder='Ingrese nombre'/></td>
</tr>
<tr hidden>
    <td><label for='txtPersSnombre'>Segundo nombre:</label></td>
    <td><input type='text' id='txtPersSnombre' name='txtPersSnombre' value='<?php if ($pers_row) {
			echo $pers_row['pers_snombre'];
		} ?>' maxlength='30'
               placeholder='Ingrese segundo nombre'/></td>
</tr>
<tr>
    <td><label for='txtPersApPaterno'>Ap Paterno:</label></td>
    <td><input type='text' id='txtPersApPaterno' name='txtPersApPaterno' value='<?php if ($pers_row) {
			echo $pers_row['pers_ap_paterno'];
		} ?>' maxlength='30' placeholder='Ingrese apellido paterno'/></td>
</tr>
<tr>
    <td><label for='txtPersApMaterno'>Ap Materno:</label></td>
    <td><input type='text' id='txtPersApMaterno' name='txtPersApMaterno' value='<?php if ($pers_row) {
			echo $pers_row['pers_ap_materno'];
		} ?>' maxlength='30' placeholder='Ingrese apellido materno'/></td>
</tr>
<tr>
    <td><label for='txtEmplCargID'>Cargo:</label></td>
    <td><select id='txtEmplCargID' name='txtEmplCargID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $carg_list = $carg_dal->listarcbo($empl_row['empl_carg_id']); ?>
			<?php foreach ($carg_list as $row) { ?>
                <option value='<?php echo $row['carg_id']; ?>'
					<?php echo ($row['carg_id'] == $empl_row['carg_id']) ? 'selected' : ''; ?>>
					<?php echo $row['carg_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtPersSexo'>Sexo:</label></td>
    <td>
        <label class='check' for='txtPersSexo_Masculino'>
            <input type='radio' name='txtPersSexo' id='txtPersSexo_Masculino' value='M'
				<?php echo ($pers_row['pers_sexo'] == 'M') ? 'checked' : ''; ?>>Masculino
        </label>
        <label class='check' for='txtPersSexo_Femenino'>
            <input type='radio' name='txtPersSexo' id='txtPersSexo_Femenino' value='F'
				<?php echo ($pers_row['pers_sexo'] == 'F') ? 'checked' : ''; ?>>Femenino
        </label>
    </td>
</tr>
<tr>
    <td><label for='txtPersFechaNac'>Fecha Nacimiento:</label></td>
    <td><input type='text' id='txtPersFechaNac' name='txtPersFechaNac' value='<?php if ($pers_row) {
			echo formatDate($pers_row['pers_fecha_nac']);
		} ?>' placeholder='00/00/0000'/></td>
</tr>
<tr>
    <td><label for='txtPersEmail'>Email:</label></td>
    <td><input type='text' id='txtPersEmail' name='txtPersEmail' maxlength='20' value='<?php if ($pers_row) {
			echo $pers_row['pers_email'];
		} ?>' placeholder='email@correo.com'/>
    </td>
</tr>
<tr>
    <td><label for='txtPersCelular'>Celular:</label></td>
    <td><input type='text' id='txtPersCelular' name='txtPersCelular' value='<?php if ($pers_row) {
			echo $pers_row['pers_celular'];
		} ?>' maxlength='20' placeholder='000-000000'/></td>
</tr>
<tr>
    <td><label for='txtPersTelefono'>Telefono:</label></td>
    <td><input type='text' id='txtPersTelefono' name='txtPersTelefono' value='<?php if ($pers_row) {
			echo $pers_row['pers_telefono'];
		} ?>' maxlength='20' placeholder='000-000000'/></td>
</tr>

<tr hidden>
    <td><label for='txtEmplEstado'>Estado:</label></td>
    <td><input type='text' id='txtEmplEstado' name='txtEmplEstado' value='<?php if ($empl_row) {
			echo $empl_row['empl_estado'];
		} ?>' placeholder='Ingrese estado'/></td>
</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_verde' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</form>
<br/>
<script>
var empl_upd = '#frmEmpleadoUpd';
$(document).ready(function (e) {
    $(empl_upd).find('#txtEmplPersID').focus();
    $(empl_upd).find('#btnActualizar').off('click').click(function (e) {
        if (empl_validar()) {
            var empl_id         = '<?php echo $empl_id; ?>';
            var empl_pers_id    = $(empl_upd).find('#txtEmplPersID').val();
            var empl_carg_id    = $(empl_upd).find('#txtEmplCargID').val();
            var empl_estado     = $(empl_upd).find('#txtEmplEstado').val();
            var pers_nombre     = $(empl_upd).find('#txtPersNombre').val();
            var pers_snombre    = $(empl_upd).find('#txtPersSnombre').val();
            var pers_ap_paterno = $(empl_upd).find('#txtPersApPaterno').val();
            var pers_ap_materno = $(empl_upd).find('#txtPersApMaterno').val();
            var pers_tdi_id     = $(empl_upd).find('#txtPersTdiID').val();
            var pers_tdi_nro    = $(empl_upd).find('#txtPersTdiNro').val();
            var pers_sexo       = $(empl_upd).find('input[name="txtPersSexo"]:checked').val();
            var pers_fecha_nac  = getDateYMD($(empl_upd).find('#txtPersFechaNac').val());
            var pers_email      = $(empl_upd).find('#txtPersEmail').val();
            var pers_celular    = $(empl_upd).find('#txtPersCelular').val();
            var pers_telefono   = $(empl_upd).find('#txtPersTelefono').val();

            $.post('vistas/empleado/proceso/empleado_update.php', {
                    empl_id        : empl_id,
                    empl_pers_id   : empl_pers_id,
                    empl_carg_id   : empl_carg_id,
                    empl_estado    : empl_estado,
                    pers_nombre    : pers_nombre,
                    pers_snombre   : pers_snombre,
                    pers_ap_paterno: pers_ap_paterno,
                    pers_ap_materno: pers_ap_materno,
                    pers_tdi_id    : pers_tdi_id,
                    pers_tdi_nro   : pers_tdi_nro,
                    pers_sexo      : pers_sexo,
                    pers_fecha_nac : pers_fecha_nac,
                    pers_email     : pers_email,
                    pers_celular   : pers_celular,
                    pers_telefono  : pers_telefono
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
    $(empl_upd).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function empl_validar() {
    var empl_pers_id    = $(empl_upd).find('#txtEmplPersID').val();
    var empl_carg_id    = $(empl_upd).find('#txtEmplCargID').val();
    var pers_nombre     = $(empl_upd).find('#txtPersNombre').val();
    var pers_snombre    = $(empl_upd).find('#txtPersSnombre').val();
    var pers_ap_paterno = $(empl_upd).find('#txtPersApPaterno').val();
    var pers_ap_materno = $(empl_upd).find('#txtPersApMaterno').val();
    var pers_tdi_id     = $(empl_upd).find('#txtPersTdiID').val();
    var pers_tdi_nro    = $(empl_upd).find('#txtPersTdiNro').val();
    var pers_sexo       = $(empl_upd).find('input[name="txtPersSexo"]:checked').val();
    var pers_fecha_nac  = $(empl_upd).find('#txtPersFechaNac').val();
    var pers_email      = $(empl_upd).find('#txtPersEmail').val();
    var pers_celular    = $(empl_upd).find('#txtPersCelular').val();
    var pers_telefono   = $(empl_upd).find('#txtPersTelefono').val();

    if (!(isInteger(empl_pers_id) && empl_pers_id > 0)) {
        showMessageWarning('Seleccione <b>persona</b>', 'txtEmplPersID');
        return false;
    }
    if (!(isInteger(empl_carg_id) && empl_carg_id > 0)) {
        showMessageWarning('Seleccione <b>cargo</b>', 'txtEmplCargID');
        return false;
    }
    if (pers_nombre == '') {
        showMessageWarning('Ingrese <b> nombre</b> de paciente', 'txtPersNombre');
        return false;
    }
    if (pers_snombre == '') {
        // showMessageWarning('Ingrese <b>segundo nombre</b> de paciente', 'txtPersSnombre');
        // return false;
    }
    if (pers_ap_paterno == '') {
        showMessageWarning('Ingrese <b>apellido paterno</b>', 'txtPersApPaterno');
        return false;
    }
    if (pers_ap_materno == '') {
        showMessageWarning('Ingrese <b>apellido materno</b>', 'txtPersApMaterno');
        return false;
    }
    if (!isInteger(pers_tdi_id)) {
        showMessageWarning('Seleccione tipo de <b>documento de identidad</b> válido', 'txtPersTdiID');
        return false;
    }
    if (pers_tdi_nro == '') {
        showMessageWarning('Ingrese <b>número de documento de identidad</b>', 'txtPersTdiNro');
        return false;
    }
    if (typeof pers_sexo == 'undefined') {
        showMessageWarning('Seleccione <b>sexo</b>', 'txtPersSexo');
        return false;
    }
    if (!isDate(pers_fecha_nac)) {
        showMessageWarning('Ingrese una <b>fecha de nacimiento</b> válida', 'txtPersFechaNac');
        return false;
    }
    if (!isEmail(pers_email)) {
        // showMessageWarning('Ingrese <b>email</b>', 'txtPersEmail');
        // return false;
    }
    if (pers_celular == '') {
        // showMessageWarning('Ingrese <b>celular</b>', 'txtPersCelular');
        // return false;
    }
    if (pers_telefono == '') {
        // showMessageWarning('Ingrese <b>telefono</b>', 'txtPersTelefono');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
