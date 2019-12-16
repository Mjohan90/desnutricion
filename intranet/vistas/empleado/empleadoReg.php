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
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
?>
<?php
	include_once '../../datos/especialidadDAL.php';
	$espec_dal = new especialidadDAL();
?>
<form id='frmEmpleadoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Registrar empleado</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr hidden>
    <td><label for='txtPacPersID'>Persona:</label></td>
    <td><input type='text' id='txtPacPersID' name='txtPacPersID' maxlength='10' placeholder='Persona ID'/>
    </td>
</tr>
<tr>
    <td><label for='txtPersTdiID'>Doc. Identidad:</label></td>
    <td><select id='txtPersTdiID' name='txtTdiID' class='txt110'>
            <option value='0'>(Seleccione)</option>
			<?php $tdi_list = $tdi_dal->listarcbo(); ?>
			<?php foreach ($tdi_list as $row) { ?>
                <option value='<?php echo $row['tdi_id']; ?>'>
					<?php echo $row['tdi_abrev']; ?>
                </option>
			<?php } ?>
        </select>
        <input type='text' id='txtPersTdiNro' name='txtPersTdiNro' maxlength='20'
               class='txt100' placeholder='00000000'/>
        <a href='#' class='btn' id='btnConsultaDNI'>Consultar</a>
    </td>
</tr>
<tr>
    <td><label for='txtPersNombre'>Nombres:</label></td>
    <td><input type='text' id='txtPersNombre' name='txtPersNombre' maxlength='30'
               placeholder='Ingrese nombres'/></td>
</tr>
<tr hidden>
    <td><label for='txtPersSnombre'>Segundo nombre:</label></td>
    <td><input type='text' id='txtPersSnombre' name='txtPersSnombre' maxlength='30'
               placeholder='Ingrese segundo nombre'/></td>
</tr>
<tr>
    <td><label for='txtPersApPaterno'>Ap Paterno:</label></td>
    <td><input type='text' id='txtPersApPaterno' name='txtPersApPaterno' maxlength='30'
               placeholder='Ingrese apellido paterno'/></td>
</tr>
<tr>
    <td><label for='txtPersApMaterno'>Ap Materno:</label></td>
    <td><input type='text' id='txtPersApMaterno' name='txtPersApMaterno' maxlength='30'
               placeholder='Ingrese apellido materno'/></td>
</tr>
<tr>
    <td><label for='txtEmplCargID'>Cargo:</label></td>
    <td><select id='txtEmplCargID' name='txtEmplCargID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $carg_list = $carg_dal->listarcbo(); ?>
			<?php foreach ($carg_list as $row) { ?>
                <option value='<?php echo $row['carg_id']; ?>'>
					<?php echo $row['carg_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr id='trEspecialidad'>
    <td><label for='txtEmplEspecID'>Especialidad:</label></td>
    <td><select id='txtEmplEspecID' name='txtEmplEspecID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $espec_list = $espec_dal->listarcbo(); ?>
			<?php foreach ($espec_list as $row) { ?>
                <option value='<?php echo $row['espec_id']; ?>'>
					<?php echo $row['espec_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtPersSexo'>Sexo:</label></td>
    <td>
        <label class='check' for='txtPersSexo_Masculino'>
            <input type='radio' name='txtPersSexo' id='txtPersSexo_Masculino' value='M'/>Masculino
        </label>
        <label class='check' for='txtPersSexo_Femenino'>
            <input type='radio' name='txtPersSexo' id='txtPersSexo_Femenino' value='F'/>Femenino
        </label>
    </td>
</tr>
<tr>
    <td><label for='txtPersFechaNac'>Fecha Nacimiento:</label></td>
    <td><input type='text' id='txtPersFechaNac' name='txtPersFechaNac' placeholder='00/00/0000'/></td>
</tr>
<tr>
    <td><label for='txtPersEmail'>Email:</label></td>
    <td><input type='text' id='txtPersEmail' name='txtPersEmail' maxlength='20' placeholder='email@correo.com'/>
    </td>
</tr>
<tr>
    <td><label for='txtPersCelular'>Celular:</label></td>
    <td><input type='text' id='txtPersCelular' name='txtPersCelular' maxlength='20'
               placeholder='000-000000'/></td>
</tr>
<tr>
    <td><label for='txtPersTelefono'>Telefono:</label></td>
    <td><input type='text' id='txtPersTelefono' name='txtPersTelefono' maxlength='20'
               placeholder='000-000000'/></td>
</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
    <input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
    <input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div>
</div>
</div>
</form>
<br/>
<script>
var empl_reg = '#frmEmpleadoReg';
$(document).ready(function (e) {
    $(empl_reg).find('#txtEmplPersID').focus();
    $(empl_reg).find('#txtPersTdiID').val(1);
    performEspecialidad();

    $(empl_reg).find('#txtEmplCargID').change(function (e) {
        performEspecialidad();
    });

    function performEspecialidad() {
        var carg_id = $(empl_reg).find('#txtEmplCargID').val();
        if (carg_id == 2) { // MEDICO
            $(empl_reg).find('#trEspecialidad').show();
        } else {
            $(empl_reg).find('#trEspecialidad').hide();
            $(empl_upd).find('#txtEmplEspecID').val(0);
        }
    }

    $(empl_reg).find('#txtPersTdiNro').keypress(function (e) {
        if (e.which === 13) {
            consultarPersonaReniec();
        }
    });
    $(empl_reg).find('#btnConsultaDNI').off('click').click(function () {
        consultarPersonaReniec();
    });

    function consultarPersonaReniec() {
        var pers_tdi_id = toInteger($('#txtPersTdiID').val());

        if (pers_tdi_id === 1) {
            var pers_dni = $(empl_reg).find('#txtPersTdiNro').val();
            var url      = 'vistas/persona/proceso/persona_consulta_reniec.php';
            $.ajax({
                type   : 'POST',
                url    : url,
                data   : 'pers_dni=' + pers_dni,
                success: function (datos) {
                    var pers_data = jsonParse(datos);
                    if (pers_data) {
                        $('#txtPersNombre').val(pers_data['pers_nombres']);
                        $('#txtPersApPaterno').val(pers_data['pers_ap_paterno']);
                        $('#txtPersApMaterno').val(pers_data['pers_ap_materno']);
                    } else {
                        $('#txtPersNombre').val('');
                        $('#txtPersApPaterno').val('');
                        $('#txtPersApMaterno').val('');
                    }
                }
            });
        }
    }

    $(empl_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (empl_validar()) {
            var empl_pers_id    = 0; // $(empl_reg).find('#txtEmplPersID').val();
            var empl_carg_id    = $(empl_reg).find('#txtEmplCargID').val();
            var empl_espec_id   = $(empl_reg).find('#txtEmplEspecID').val();
            var pers_nombre     = $(empl_reg).find('#txtPersNombre').val();
            var pers_snombre    = $(empl_reg).find('#txtPersSnombre').val();
            var pers_ap_paterno = $(empl_reg).find('#txtPersApPaterno').val();
            var pers_ap_materno = $(empl_reg).find('#txtPersApMaterno').val();
            var pers_tdi_id     = $(empl_reg).find('#txtPersTdiID').val();
            var pers_tdi_nro    = $(empl_reg).find('#txtPersTdiNro').val();
            var pers_sexo       = $(empl_reg).find('input[name="txtPersSexo"]:checked').val();
            var pers_fecha_nac  = getDateYMD($(empl_reg).find('#txtPersFechaNac').val());
            var pers_email      = $(empl_reg).find('#txtPersEmail').val();
            var pers_celular    = $(empl_reg).find('#txtPersCelular').val();
            var pers_telefono   = $(empl_reg).find('#txtPersTelefono').val();

            $.post('vistas/empleado/proceso/empleado_insert.php', {
                    empl_pers_id   : empl_pers_id,
                    empl_carg_id   : empl_carg_id,
                    empl_espec_id  : empl_espec_id,
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
                    if (datos > 0) {
                        alert('Registro correcto');
                        volver();
                    } else {
                        alert('Error al registrar. ' + datos);
                    }
                });
        }
    });
    $(empl_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function empl_validar() {
    var empl_pers_id    = $(empl_reg).find('#txtEmplPersID').val();
    var empl_carg_id    = $(empl_reg).find('#txtEmplCargID').val();
    var pers_nombre     = $(empl_reg).find('#txtPersNombre').val();
    var pers_snombre    = $(empl_reg).find('#txtPersSnombre').val();
    var pers_ap_paterno = $(empl_reg).find('#txtPersApPaterno').val();
    var pers_ap_materno = $(empl_reg).find('#txtPersApMaterno').val();
    var pers_tdi_id     = $(empl_reg).find('#txtPersTdiID').val();
    var pers_tdi_nro    = $(empl_reg).find('#txtPersTdiNro').val();
    var pers_sexo       = $(empl_reg).find('input[name="txtPersSexo"]:checked').val();
    var pers_fecha_nac  = $(empl_reg).find('#txtPersFechaNac').val();
    var pers_email      = $(empl_reg).find('#txtPersEmail').val();
    var pers_celular    = $(empl_reg).find('#txtPersCelular').val();
    var pers_telefono   = $(empl_reg).find('#txtPersTelefono').val();

    if (!(isInteger(empl_pers_id) && empl_pers_id > 0)) {
        // showMessageWarning('Seleccione <b>persona</b>', 'txtEmplPersID');
        // return false;
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
