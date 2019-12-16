<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('enferm_upd', 'vistas/enfermedad/enfermedad.php');
?>
<?php
	include_once '../../datos/enfermedadDAL.php';
	$enferm_dal = new enfermedadDAL();
	$enferm_id  = GetNumericParam('enferm_id');
	
	$enferm_row = $enferm_dal->getByID($enferm_id);
?>
<form id='frmEnfermedadUpd' method='post'>
    <div class='regform'>
        <div class='regform_body'>
            <div class='form_title'>
                <span class='h2 blanco'>Editar enfermedad</span>
            </div>
            <hr class='separator'/>
            <table class='form_data'>
                <tr>
                    <td><label for='txtEnfermNombre'>Nombre:</label></td>
                    <td><input type='text' id='txtEnfermNombre' name='txtEnfermNombre' value='<?php if ($enferm_row) {
							echo htmlspecialchars($enferm_row['enferm_nombre']);
						} ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
                </tr>
                <tr>
                    <td><label for='txtEnfermTratamientoSug'>Tratamiento sug:</label></td>
                    <td><textarea name="txtEnfermTratamientoSug" id="txtEnfermTratamientoSug" cols="40"
                                  rows="6"><?php if ($enferm_row) {
								echo htmlspecialchars($enferm_row['enferm_tratamiento_sug']);
							} ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td><label for='txtEnfermDietaSug'>Dieta sug:</label></td>
                    <td><textarea name="txtEnfermDietaSug" id="txtEnfermDietaSug" cols="40"
                                  rows="6"><?php if ($enferm_row) {
								echo htmlspecialchars($enferm_row['enferm_dieta_sug']);
							} ?></textarea>
                    </td>
                </tr>
                <tr hidden>
                    <td><label for='txtEnfermEstado'>Estado:</label></td>
                    <td><input type='text' id='txtEnfermEstado' name='txtEnfermEstado' value='<?php if ($enferm_row) {
							echo $enferm_row['enferm_estado'];
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
var enferm_upd = '#frmEnfermedadUpd';
$(document).ready(function (e) {
    $(enferm_upd).find('#txtEnfermNombre').focus();
    $(enferm_upd).find('#btnActualizar').off('click').click(function (e) {
        if (enferm_validar()) {
            var enferm_id              = '<?php echo $enferm_id; ?>';
            var enferm_nombre          = $(enferm_upd).find('#txtEnfermNombre').val();
            var enferm_tratamiento_sug = $(enferm_upd).find('#txtEnfermTratamientoSug').val();
            var enferm_dieta_sug       = $(enferm_upd).find('#txtEnfermDietaSug').val();
            var enferm_estado          = $(enferm_upd).find('#txtEnfermEstado').val();

            $.post('vistas/enfermedad/proceso/enfermedad_update.php', {
                    enferm_id             : enferm_id,
                    enferm_nombre         : enferm_nombre,
                    enferm_tratamiento_sug: enferm_tratamiento_sug,
                    enferm_dieta_sug      : enferm_dieta_sug,
                    enferm_estado         : enferm_estado
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
    $(enferm_upd).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function enferm_validar() {
    var enferm_nombre          = $(enferm_upd).find('#txtEnfermNombre').val();
    var enferm_tratamiento_sug = $(enferm_upd).find('#txtEnfermTratamientoSug').val();
    var enferm_dieta_sug       = $(enferm_upd).find('#txtEnfermDietaSug').val();

    if (enferm_nombre == '') {
        showMessageWarning('Ingrese una <b>nombre</b> válida de enfermedad', 'txtEnfermNombre');
        return false;
    }
    if (enferm_tratamiento_sug == '') {
        showMessageWarning('Ingrese una <b>tratamiento sug</b> válida', 'txtEnfermTratamientoSug');
        return false;
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
