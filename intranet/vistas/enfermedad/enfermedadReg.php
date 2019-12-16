<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('enferm_reg', 'vistas/enfermedad/enfermedad.php');
?>
<?php
	include_once '../../datos/claseenfermedadDAL.php';
	$clsenferm_dal = new claseenfermedadDAL();
?>
<form id='frmEnfermedadReg' method='post'>
    <div class='regform'>
        <div class='regform_body'>
            <div class='form_title'>
                <span class='h2'>Registrar enfermedad</span>
            </div>
            <hr class='separator'/>
            <table class='form_data'>
                <tr>
                    <td><label for='txtEnfermClsenfermID'>Clase de enfermedad:</label></td>
                    <td><select id='txtEnfermClsenfermID' name='txtEnfermClsenfermID'> <!-- maxlength='10' -->
                            <option value='0'>(Seleccione)</option>
				            <?php $clsenferm_list = $clsenferm_dal->listarcbo(); ?>
				            <?php foreach ($clsenferm_list as $row) { ?>
                                <option value='<?php echo $row['clsenferm_id']; ?>'>
						            <?php echo $row['clsenferm_nombre']; ?>
                                </option>
				            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for='txtEnfermNombre'>Nombre:</label></td>
                    <td><input type='text' id='txtEnfermNombre' name='txtEnfermNombre' maxlength='50'
                               placeholder='Ingrese nombre'/></td>
                </tr>
                <tr>
                    <td><label for='txtEnfermTratamientoSug'>Tratamiento sugerido:</label></td>
                    <td>
                        <textarea name="txtEnfermTratamientoSug" id="txtEnfermTratamientoSug" cols="40" rows="6"
                                  placeholder='Ingrese tratamiento sugerido'></textarea>
                </tr>
                <tr>
                    <td><label for='txtEnfermDietaSug'>Dieta sugerida:</label></td>
                    <td><textarea name="txtEnfermDietaSug" id="txtEnfermDietaSug" cols="40" rows="6"
                                  placeholder='Ingrese dieta sugerida'></textarea>
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
var enferm_reg = '#frmEnfermedadReg';
$(document).ready(function (e) {
    $(enferm_reg).find('#txtEnfermNombre').focus();
    $(enferm_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (enferm_validar()) {
            var enferm_nombre          = $(enferm_reg).find('#txtEnfermNombre').val();
            var enferm_clsenferm_id    = $(enferm_reg).find('#txtEnfermClsenfermID').val();
            var enferm_tratamiento_sug = $(enferm_reg).find('#txtEnfermTratamientoSug').val();
            var enferm_dieta_sug       = $(enferm_reg).find('#txtEnfermDietaSug').val();

            $.post('vistas/enfermedad/proceso/enfermedad_insert.php', {
                    enferm_nombre         : enferm_nombre,
                    enferm_clsenferm_id   : enferm_clsenferm_id,
                    enferm_tratamiento_sug: enferm_tratamiento_sug,
                    enferm_dieta_sug      : enferm_dieta_sug
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
    $(enferm_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function enferm_validar() {
    var enferm_nombre          = $(enferm_reg).find('#txtEnfermNombre').val();
    var enferm_clsenferm_id    = $(enferm_reg).find('#txtEnfermClsenfermID').val();
    var enferm_tratamiento_sug = $(enferm_reg).find('#txtEnfermTratamientoSug').val();
    var enferm_dieta_sug       = $(enferm_reg).find('#txtEnfermDietaSug').val();

    if (enferm_nombre == '') {
        showMessageWarning('Ingrese una <b>nombre</b> válida de enfermedad', 'txtEnfermNombre');
        return false;
    }
    if (!(isInteger(enferm_clsenferm_id) && enferm_clsenferm_id > 0)) {
        showMessageWarning('Seleccione <b>clase de enfermedad</b>', 'txtEnfermClsenfermID');
        return false;
    }
    if (enferm_tratamiento_sug == '') {
        // showMessageWarning('Ingrese una <b>tratamiento sug</b> válida', 'txtEnfermTratamientoSug');
        // return false;
    }
    if (enferm_dieta_sug == '') {
        // showMessageWarning('Ingrese una <b>dieta sug</b> válida', 'txtEnfermDietaSug');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
