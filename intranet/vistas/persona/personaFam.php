<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('pers_fam', 'vistas/persona/persona.php');
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
	$pers_id  = GetNumericParam('pers_id');
	$pers_row = $pers_dal->getByID($pers_id);
?>
<form id='frmPersonaFam' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Familiares</span>
</div>
<hr class='separator'/>
<table class='form_data'>
    <tr>
        <td><label for='txtPersNombre' class='bold'>Nombres y apellidos:</label></td>
        <td><?= htmlspecialchars($pers_row['pers_nombre'].' '.$pers_row['pers_snombre'].' '.$pers_row['pers_ap_paterno'].' '.$pers_row['pers_ap_materno']) ?>
        </td>
    </tr>
    <tr>
        <td><label for='txtPersTdiID' class='bold'>Doc. Ident:</label></td>
        <td><?= htmlspecialchars($pers_row['tdi_abrev']).' - '.$pers_row['pers_tdi_nro'] ?></td>
    </tr>
    <tr>
        <td><label for='txtPersSexo' class='bold'>Sexo:</label></td>
        <td><?= htmlspecialchars($pers_row['pers_sexo']) ?></td>
    </tr>
    <tr>
        <td><label for='txtPersFechaNac' class='bold'>Fecha nacimiento:</label></td>
        <td><?= formatDate($pers_row['pers_fecha_nac']) ?></td>
    </tr>
    <tr>
        <td colspan='2'>
            <hr class='separator_bold'>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
            <table>
                <tr>
                    <td><label>Agregar familiar:</label></td>
                    <td>
                        <input type='text' id='txtPersPersNombre' name='txtPersPersNombre' maxlength='' value=''
                               placeholder=''/>
                        <input hidden type='text' id='txtPersPersID' name='txtPersPersID' maxlength='' value=''
                               placeholder=''/>
                    </td>
                    <td><a href='#' class='btn b_azul' id='btnAgregarPersona'
                           title="Agregar persona a la lista">Agregar</a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
            <div id='divParentesco'></div>
        </td>
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
<br>
<script>
divPersona_Load();

var pers_fam     = '#frmPersonaFam';
var persona_list = [];
$(document).ready(function (e) {
    loadPersonas();
    divPersona_Init();

    $(pers_fam).find("#btnAgregarPersona").off('click').click(function (e) {
        if ($(pers_fam).find('#txtPersPersNombre').val()) {
            var pers_id = $(pers_fam).find('#txtPersPersID').val();
            $(pers_fam).find('#txtPersPersID').val('');
            $(pers_fam).find('#txtPersPersNombre').val('');
            divPersona_AddPersona(pers_id);
        }
    });
    $(pers_fam).find('#btnActualizar').click(function (e) {
        $.post('vistas/persona/proceso/persona_familiares.php', {
                pers_id: '<?= $pers_id ?>'
            },
            function (datos) {
                if (datos > 0) {
                    alert('Registro correcto');
                    divPersona_ClearPersona();
                    volver();
                } else {
                    alert('Error al registrar. ' + datos);
                }
            });

    });
    $(pers_fam).find('#btnCancelar').click(function (e) {
        volver();
    });

    function loadPersonas() {
        $.post('vistas/persona/proceso/persona_fam_listcbo.php', {
                pers_id: '<?= $pers_id ?>'
            },
            function (datos) {
                persona_list = JSON.parse(datos);

                $(pers_fam).find('#txtPersPersNombre').easyAutocomplete({
                    data    : persona_list,
                    getValue: 'pers_nombre_completo',
                    list    : {
                        match            : {enabled: true},
                        onSelectItemEvent: function () {
                            var value = $(pers_fam).find("#txtPersPersNombre").getSelectedItemData().pers_id;
                            $(pers_fam).find("#txtPersPersID").val(value).trigger("change");
                        }
                    }
                });
            });
    }
});

// Manejo de parentesco
var key_pressed = 0;

function divPersona_Init() {
    divPersona_Load('action=init');
}

function divPersona_AddPersona(pers_id) {
    divPersona_Load('action=add&pers_id=' + pers_id);
}

function divPersona_RemovePersona(pers_key) {
    divPersona_Load('action=remove&pers_key=' + pers_key);
}

function divPersona_ClearPersona() {
    divPersona_Load('action=clear');
}

function divPersona_UpdateParentTparentID(pers_key, parent_tparent_id) {
    divPersona_Load('action=update&pers_key=' + pers_key + '&parent_tparent_id=' + parent_tparent_id + '&key_pressed=' + key_pressed);
}

function divPersona_UpdateParentEsApoderado(pers_key, parent_es_apoderado) {
    divPersona_Load('action=update&pers_key=' + pers_key + '&parent_es_apoderado=' + parent_es_apoderado + '&key_pressed=' + key_pressed);
}

function divPersona_Load(params) {
    var xpers_id = '<?= $pers_id ?>';
    if (typeof params !== 'undefined') {
        $(pers_fam).find('#divParentesco').load('vistas/persona/personaFamDet.php?xpers_id=' + xpers_id + '&' + params);
    } else {
        $(pers_fam).find('#divParentesco').load('vistas/persona/personaFamDet.php?xpers_id=' + xpers_id);
    }
}

function pers_validar() {
    var detailsCount = $(pers_fam).find('#txtParentDetailsCount').val();

    // Validación del detalle:
    if (detailsCount == 0) {
        showMessageWarning('<b>Agregue</b> por lo menos un <b>persona</b> a la lista', 'txtParentPersona');
        return false;
    }
    if ($(pers_fam).find('#txtParentTparentID_wrong').val() != '') {
        showMessageWarning('Ingrese valor valido para <b>tipo de parentesco</b>', $(pers_fam).find('#txtParentTparentID_wrong').val());
        return false;
    }
    if ($(pers_fam).find('#txtParentEsApoderado_wrong').val() != '') {
        showMessageWarning('Ingrese valor valido para <b>es apoderado</b>', $(pers_fam).find('#txtParentEsApoderado_wrong').val());
        return false;
    }
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>

