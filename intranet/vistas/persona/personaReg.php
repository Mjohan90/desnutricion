<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('pers_reg', 'vistas/persona/persona.php');
?>
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
?>
<form id='frmPersonaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Registrar persona</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr>
    <td><label for='txtPersTdiID'>Doc. Identidad:</label></td>
    <td><select id='txtPersTdiID' name='txtTdiID' class='txt110'>
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
var pers_reg = '#frmPersonaReg';
$(document).ready(function (e) {
    $(pers_reg).find('#txtPersNombre').focus();
    $(pers_reg).find('#txtPersFechaNac').datepicker();

    $(pers_reg).find('#txtPersTdiNro').keypress(function (e) {
        if (e.which === 13) {
            consultarPersonaReniec();
        }
    });

    $(pers_reg).find('#btnConsultaDNI').off('click').click(function () {
        consultarPersonaReniec();
    });

    function consultarPersonaReniec() {
        var pers_tdi_id = toInteger($('#txtPersTdiID').val());

        if (pers_tdi_id === 1) {
            var pers_dni = $(pers_reg).find('#txtPersTdiNro').val();
            var url      = 'vistas/persona/proceso/persona_consulta_reniec.php';
            $.ajax({
                type   : 'POST',
                url    : url,
                data   : 'pers_dni=' + pers_dni,
                success: function (datos) {
                    console.log(datos);
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

    $(pers_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (pers_validar()) {
            var pers_nombre     = $(pers_reg).find('#txtPersNombre').val();
            var pers_snombre    = $(pers_reg).find('#txtPersSnombre').val();
            var pers_ap_paterno = $(pers_reg).find('#txtPersApPaterno').val();
            var pers_ap_materno = $(pers_reg).find('#txtPersApMaterno').val();
            var pers_tdi_id     = $(pers_reg).find('#txtPersTdiID').val();
            var pers_tdi_nro    = $(pers_reg).find('#txtPersTdiNro').val();
            var pers_sexo       = $(pers_reg).find('input[name="txtPersSexo"]:checked').val();
            var pers_fecha_nac  = getDateYMD($(pers_reg).find('#txtPersFechaNac').val());
            var pers_email      = $(pers_reg).find('#txtPersEmail').val();
            var pers_celular    = $(pers_reg).find('#txtPersCelular').val();
            var pers_telefono   = $(pers_reg).find('#txtPersTelefono').val();

            $.post('vistas/persona/proceso/persona_insert.php', {
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
    $(pers_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function pers_validar() {
    var pers_nombre     = $(pers_reg).find('#txtPersNombre').val();
    var pers_snombre    = $(pers_reg).find('#txtPersSnombre').val();
    var pers_ap_paterno = $(pers_reg).find('#txtPersApPaterno').val();
    var pers_ap_materno = $(pers_reg).find('#txtPersApMaterno').val();
    var pers_tdi_id     = $(pers_reg).find('#txtPersTdiID').val();
    var pers_tdi_nro    = $(pers_reg).find('#txtPersTdiNro').val();
    var pers_sexo       = $(pers_reg).find('input[name="txtPersSexo"]:checked').val();
    var pers_fecha_nac  = $(pers_reg).find('#txtPersFechaNac').val();
    var pers_email      = $(pers_reg).find('#txtPersEmail').val();
    var pers_celular    = $(pers_reg).find('#txtPersCelular').val();
    var pers_telefono   = $(pers_reg).find('#txtPersTelefono').val();

    if (pers_nombre == '') {
        showMessageWarning('Ingrese un <b>nombre</b> válido de persona', 'txtPersNombre');
        return false;
    }
    if (pers_snombre == '') {
        // showMessageWarning('Ingrese un <b>segundo nombre</b> válido de persona', 'txtPersSnombre');
        // return false;
    }
    if (pers_ap_paterno == '') {
        showMessageWarning('Ingrese una <b>apellido paterno</b> válida', 'txtPersApPaterno');
        return false;
    }
    if (pers_ap_materno == '') {
        showMessageWarning('Ingrese una <b>apellido materno</b> válida', 'txtPersApMaterno');
        return false;
    }
    if (!(isInteger(pers_tdi_id) && pers_tdi_id > 0)) {
        showMessageWarning('Seleccione <b>tipo documento de identidad</b>', 'txtPersTdiID');
        return false;
    }
    if (pers_tdi_nro == '') {
        showMessageWarning('Ingrese un <b>numero de identidad</b> válida', 'txtPersTdiNro');
        return false;
    }
    if (typeof pers_sexo == 'undefined') {
        showMessageWarning('Seleccione <b>sexo</b>', 'txtPersSexo');
        return false;
    }
    if (!isDate(pers_fecha_nac)) {
        showMessageWarning('Ingrese una <b>fecha nacimiento</b> válida', 'txtPersFechaNac');
        return false;
    }
    var hoy = toDate('<?= todayYMD() ?>');
    if (hoy < sumarAnios(pers_fecha_nac, 18)) {
        showMessageWarning('La persona debe ser mayor de edad', 'txtPersFechaNac');
        return false;
    }
    if (!isEmail(pers_email)) {
        // showMessageWarning('Ingrese valor de <b>email</b> válido', 'txtPersEmail');
        // return false;
    }
    if (pers_celular == '') {
        // showMessageWarning('Ingrese un <b>celular</b> válida', 'txtPersCelular');
        // return false;
    }
    if (pers_telefono == '') {
        // showMessageWarning('Ingrese un <b>telefono</b> válida', 'txtPersTelefono');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
