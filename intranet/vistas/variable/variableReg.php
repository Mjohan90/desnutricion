<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('var_reg', 'vistas/variable/variable.php');
?>
<?php
	include_once '../../datos/categvariableDAL.php';
	$catvar_dal = new categvariableDAL();
?>
<?php
	include_once '../../datos/umDAL.php';
	$um_dal = new umDAL();
?>
<form id='frmVariableReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Registrar variable</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr>
    <td><label for='txtVarCatvarID'>Categoría de variable:</label></td>
    <td><select id='txtVarCatvarID' name='txtVarCatvarID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $catvar_list = $catvar_dal->listarcbo(); ?>
			<?php foreach ($catvar_list as $row) { ?>
                <option value='<?php echo $row['catvar_id']; ?>'>
					<?php echo $row['catvar_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label for='txtVarNombre'>Nombre:</label></td>
    <td><input type='text' id='txtVarNombre' name='txtVarNombre' maxlength='50' placeholder='Ingrese nombre'/>
    </td>
</tr>
<tr>
    <td><label for='txtVarUmID'>Unidad de medida:</label></td>
    <td><select id='txtVarUmID' name='txtVarUmID'> <!-- maxlength='10' -->
            <option value='0'>(Seleccione)</option>
			<?php $um_list = $um_dal->listarcbo(); ?>
			<?php foreach ($um_list as $row) { ?>
                <option value='<?php echo $row['um_id']; ?>'>
					<?php echo $row['um_nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td><label>Tipo variable:</label></td>
    <td><?php foreach (getTipoVar() as $tvar_key => $tvar_nombre) { ?>
            <label class='check'>
                <input type='radio' name='txtVarTipoVar' id='txtVarTipoVar' value='<?= $tvar_key ?>'>
				<?= $tvar_nombre ?>
            </label>
		<?php } ?>
    </td>
</tr>
<tr>
    <td><label for='txtVarTipoEscala'>Tipo de escala:</label></td>
    <td><select id='txtVarTipoEscala' name='txtVarTipoEscala'>
            <option value='0'>(Seleccione)</option>
			<?php foreach (getTipoEscala() as $tesc_key => $tesc_nombre) { ?>
                <option value='<?= $tesc_key ?>'> <?= $tesc_nombre ?></option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr hidden>
    <td><label for='txtVarFormula'>Formula:</label></td>
    <td><input type='text' id='txtVarFormula' name='txtVarFormula' maxlength='500'
               placeholder='Ingrese formula'/></td>
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
var var_reg = '#frmVariableReg';
$(document).ready(function (e) {
    $(var_reg).find('#txtVarCatvarID').focus();
    $(var_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (var_validar()) {
            var var_catvar_id   = $(var_reg).find('#txtVarCatvarID').val();
            var var_nombre      = $(var_reg).find('#txtVarNombre').val();
            var var_um_id       = $(var_reg).find('#txtVarUmID').val();
            var var_tipo_var    = $(var_reg).find('input[name=txtVarTipoVar]:checked').val();
            var var_tipo_escala = $(var_reg).find('#txtVarTipoEscala').val();
            var var_formula     = $(var_reg).find('#txtVarFormula').val();

            $.post('vistas/variable/proceso/variable_insert.php', {
                    var_catvar_id  : var_catvar_id,
                    var_nombre     : var_nombre,
                    var_um_id      : var_um_id,
                    var_tipo_var   : var_tipo_var,
                    var_tipo_escala: var_tipo_escala,
                    var_formula    : var_formula
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
    $(var_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function var_validar() {
    var var_catvar_id   = $(var_reg).find('#txtVarCatvarID').val();
    var var_nombre      = $(var_reg).find('#txtVarNombre').val();
    var var_um_id       = $(var_reg).find('#txtVarUmID').val();
    var var_tipo_var    = $(var_reg).find('input[name=txtVarTipoVar]:checked').val();
    var var_tipo_escala = $(var_reg).find('#txtVarTipoEscala').val();
    var var_formula     = $(var_reg).find('#txtVarFormula').val();

    if (!(isInteger(var_catvar_id) && var_catvar_id > 0)) {
        showMessageWarning('Seleccione <b>categoría de variable</b>', 'txtVarCatvarID');
        return false;
    }
    if (var_nombre == '') {
        showMessageWarning('Ingrese una <b>nombre</b> válida de variable', 'txtVarNombre');
        return false;
    }
    if (!(isInteger(var_um_id) && var_um_id > 0)) {
        showMessageWarning('Seleccione <b>unidad de medida</b>', 'txtVarUmID');
        return false;
    }
    if (!isTinyint(var_tipo_var)) {
        showMessageWarning('Ingrese un valor de <b>tipo var</b> válido', 'txtVarTipoVar');
        return false;
    }
    if (!isTinyint(var_tipo_escala)) {
        showMessageWarning('Ingrese un valor de <b>tipo escala</b> válido', 'txtVarTipoEscala');
        return false;
    }
    if (var_formula == '') {
        // showMessageWarning('Ingrese una <b>formula</b> válida', 'txtVarFormula');
        // return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>
