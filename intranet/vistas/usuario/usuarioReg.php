<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('usu_reg', 'vistas/usuario/usuario.php');
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
?>
<?php
	include_once '../../datos/rolDAL.php';
	$rol_dal = new rolDAL();
?>
<form id='frmUsuarioReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Registrar usuario</span>
</div>
<hr class='separator'/>
<table class='form_data'>
    <tr>
        <td><label for='txtUsuEmplID'>Empleado:</label></td>
        <td><select id='txtUsuEmplID' name='txtUsuEmplID'> <!-- maxlength='10' -->
                <option value='0'>(Seleccione)</option>
				<?php $empl_list = $empl_dal->listarcbo(); ?>
				<?php foreach ($empl_list as $row) { ?>
                    <option value='<?php echo $row['empl_id']; ?>'>
						<?php echo $row['pers_nombre'], ' ', $row['pers_ap_paterno'], ' ', $row['pers_ap_materno']; ?>
                    </option>
				<?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for='txtUsuRolID'>Rol:</label></td>
        <td><select id='txtUsuRolID' name='txtUsuRolID'> <!-- maxlength='10' -->
                <option value='0'>(Seleccione)</option>
				<?php $rol_list = $rol_dal->listarcbo(); ?>
				<?php foreach ($rol_list as $row) { ?>
                    <option value='<?php echo $row['rol_id']; ?>'>
						<?php echo $row['rol_nombre']; ?>
                    </option>
				<?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><label for='txtUsuNombre'>Nombre de usuario:</label></td>
        <td><input type='text' id='txtUsuNombre' name='txtUsuNombre' maxlength='20'
                   placeholder='Ingrese nombre'/></td>
    </tr>
    <tr>
        <td><label for='txtUsuContrasena'>Contraseña:</label></td>
        <td><input type='password' id='txtUsuContrasena' name='txtUsuContrasena' maxlength='32'
                   placeholder='Ingrese contrasena'/></td>
    </tr>
    <tr>
        <td><label for='txtUsuContrasena2'>Confirmar:</label></td>
        <td><input type='password' id='txtUsuContrasena2' name='txtUsuContrasena2' maxlength='32'
                   placeholder='Confirme contrasena'/></td>
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
var usu_reg = '#frmUsuarioReg';
$(document).ready(function (e) {
    $(usu_reg).find('#txtUsuNombre').focus();
    $(usu_reg).find('#btnRegistrar').off('click').click(function (e) {
        if (usu_validar()) {
            var usu_nombre     = $(usu_reg).find('#txtUsuNombre').val();
            var usu_contrasena = $(usu_reg).find('#txtUsuContrasena').val();
            var usu_empl_id    = $(usu_reg).find('#txtUsuEmplID').val();
            var usu_rol_id     = $(usu_reg).find('#txtUsuRolID').val();

            $.post('vistas/usuario/proceso/usuario_insert.php', {
                    usu_nombre    : usu_nombre,
                    usu_contrasena: usu_contrasena,
                    usu_empl_id   : usu_empl_id,
                    usu_rol_id    : usu_rol_id
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
    $(usu_reg).find('#btnCancelar').click(function (e) {
        volver();
    });
});

function usu_validar() {
    var usu_nombre      = $(usu_reg).find('#txtUsuNombre').val();
    var usu_contrasena  = $(usu_reg).find('#txtUsuContrasena').val();
    var usu_contrasena2 = $(usu_reg).find('#txtUsuContrasena2').val();
    var usu_empl_id     = $(usu_reg).find('#txtUsuEmplID').val();
    var usu_rol_id      = $(usu_reg).find('#txtUsuRolID').val();

    if (!(isInteger(usu_empl_id) && usu_empl_id > 0)) {
        showMessageWarning('Seleccione <b>empleado</b>', 'txtUsuEmplID');
        return false;
    }
    if (!(isInteger(usu_rol_id) && usu_rol_id > 0)) {
        showMessageWarning('Seleccione <b>rol</b>', 'txtUsuRolID');
        return false;
    }
    if (usu_nombre == '') {
        showMessageWarning('Ingrese una <b>nombre</b> válida de usuario', 'txtUsuNombre');
        return false;
    }
    if (usu_contrasena == '') {
        showMessageWarning('Ingrese una <b>contrasena</b> válida', 'txtUsuContrasena');
        return false;
    }
    if (usu_contrasena != usu_contrasena2) {
        showMessageWarning('Las <b>contraseñas</b> no coinciden', 'txtUsuContrasena2');
        return false;
    }
    return true;
}

function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>