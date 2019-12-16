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
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
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
<?php
	$atenc_id  = GetNumParam('atenc_id');
	$atenc_row = $atenc_dal->getRow($atenc_id);
	$pac_row   = $pac_dal->getByID($atenc_row['pac_id']);
?>
<form id='frmTriajeReg' method='post'>
    <div class='regform'>
        <div class='regform_body'>
            <div class='form_title'>
                <span class='h2'>Registrar triaje</span>
            </div>
            <hr class='separator'/>
            <table class='form_data width500px' style='width: 100%;'>
                <tr hidden>
                    <td><label for='txtTriajeAtencID'>Atención:</label></td>
                    <td><input type='text' id='txtTriajeAtencID' name=txtTriajeAtencID' maxlength=''
                               value='<?= $atenc_id ?>'
                               placeholder=''/>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <label class='bold'>Paciente: </label>
                        <span class=''><?= $pac_row['pers_nombre'], ' ', $pac_row['pers_ap_paterno'], ' ', $pac_row['pers_ap_materno']; ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <div id='divTriaje'></div>
                    </td>
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
var triaje_reg = '#frmTriajeReg';
$(document).ready(function (e) {
    $(triaje_reg).find('#txtTriajeAtencID').focus();
    
    divAtencion_Init();
    $(triaje_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (triaje_validar()) {
            var triaje_atenc_id = $(triaje_reg).find('#txtTriajeAtencID').val();

            $.post('vistas/triaje/proceso/triaje_insert.php', {
                    triaje_atenc_id: triaje_atenc_id
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
    $(triaje_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function triaje_validar() {
    var triaje_atenc_id = $(triaje_reg).find('#txtTriajeAtencID').val();

    if (!(isInteger(triaje_atenc_id) && triaje_atenc_id > 0)) {
        showMessageWarning('Seleccione <b>atención</b>', 'txtTriajeAtencID');
        return false;
    }

    var detailsCount = $(triaje_reg).find('#txtTriajeDetailsCount').val();

    // Validación del detalle:
    if (detailsCount == 0) {
        showMessageWarning('<b>Agregue</b> por lo menos un <b>variable</b> a la lista', 'txtTriajeVariable');
        return false;
    }
    if ($(triaje_reg).find('#txtTriajeUmID_wrong').val() != '') {
        showMessageWarning('Ingrese valor valido para <b>um</b>', $(triaje_reg).find('#txtTriajeUmID_wrong').val());
        return false;
    }
    if ($(triaje_reg).find('#txtTriajeValor_wrong').val() != '') {
        showMessageWarning('Ingrese valor valido para <b>valor</b>', $(triaje_reg).find('#txtTriajeValor_wrong').val());
        return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}

// Manejo de triaje
var key_pressed = 0;

function divAtencion_Init() {
    divAtencion_Load('action=init');
}

function divAtencion_AddVariable(var_id) {
    divAtencion_Load('action=add&var_id=' + var_id);
}

function divAtencion_RemoveVariable(var_key) {
    divAtencion_Load('action=remove&var_key=' + var_key);
}

function divAtencion_ClearVariable() {
    divAtencion_Load('action=clear');
}

function divAtencion_UpdateTriajeUmID(var_key, triaje_um_id) {
    divAtencion_Load('action=update&var_key=' + var_key + '&triaje_um_id=' + triaje_um_id + '&key_pressed=' + key_pressed);
}

function divAtencion_UpdateTriajeValor(var_key, triaje_valor) {
    divAtencion_Load('action=update&var_key=' + var_key + '&triaje_valor=' + triaje_valor + '&key_pressed=' + key_pressed);
}

function divAtencion_Load(params) {
    var atenc_id = toInteger('<?=$atenc_id; ?>');

    if (typeof params !== 'undefined') {
        $(triaje_reg).find('#divTriaje').load('vistas/triaje/triajeRegDet.php?atenc_id=' + atenc_id + '&' + params);
    } else {
        $(triaje_reg).find('#divTriaje').load('vistas/triaje/triajeRegDet.php?atenc_id=' + atenc_id);
    }
}
</script>
