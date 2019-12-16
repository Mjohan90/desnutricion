<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('usu_upd', 'vistas/usuario/usuario.php');
?>
<?php
	include_once '../../datos/usuarioDAL.php';
	$dal_usu = new usuarioDAL();
	$usu_id  = GetNumericParam('usu_id');
	
	$row = $dal_usu->getByID($usu_id);
?>
<?php
	include_once '../../datos/rolDAL.php';
	$dal_rol = new rolDAL();
?>
<form name='frmUsuarioUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
    <span class='h2'>Cambiar contraseña</span>
</div>
<hr class='separator'/>
<table class='form_data'>
<tr hidden>
    <td><label for='txtUsuPersona_id'>Persona:</label></td>
    <td><input type='text' id='txtUsuPersona_id' name='txtUsuPersona_id' value='<?php if ($row) {
			echo $row['persona_id'];
		} ?>' maxlength='10' placeholder='Ingrese persona_id'/></td>
</tr>
<tr>
    <td><label for='txtUsuPersona'>Persona:</label></td>
    <td><input disabled type='text' id='txtUsuPersona' name='txtUsuPersona' value='<?php if ($row) {
			echo $row['pers_nombres'].' '.$row['pers_apellidos'];
		} ?>' maxlength='10' placeholder='Ingrese persona_id'/></td>
</tr>
<tr>
    <td><label for='txtUsuNombre'>Nombre:</label></td>
    <td><input type='text' id='txtUsuNombre' name='txtUsuNombre' value='<?php if ($row) {
			echo htmlspecialchars($row['nombre']);
		} ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
</tr>
<tr>
    <td><label for='txtUsuContrasena0'>Contraseña anterior:</label></td>
    <td><input type='password' id='txtUsuContrasena0' name='txtUsuContrasena0' value='' maxlength='32'
               placeholder='Ingrese contrasena'/></td>
</tr>
<tr>
    <td><label for='txtUsuContrasena'>Nueva contrasena:</label></td>
    <td><input type='password' id='txtUsuContrasena' name='txtUsuContrasena' value='' maxlength='32'
               placeholder='Ingrese contrasena nueva'/></td>
</tr>
<tr>
    <td><label for='txtUsuContrasena2'>Confirmar contrasena:</label></td>
    <td><input type='password' id='txtUsuContrasena2' name='txtUsuContrasena2' value='' maxlength='32'
               placeholder='Ingrese contrasena nueva'/></td>
</tr>
<tr hidden>
	<?php $rol_list = $dal_rol->listar(); ?>
    <td><label for='txtUsuRol_id'>Rol:</label></td>
    <td><select id='txtUsuRol_id' name='txtUsuRol_id'>
			<?php foreach ($rol_list as $rol_row) { ?>
                <option value='<?php echo $rol_row['rol_id']; ?>'
					<?php echo ($row['rol_id'] == $rol_row['rol_id']) ? 'selected' : ''; ?>>
					<?php echo $rol_row['nombre']; ?>
                </option>
			<?php } ?>
        </select>
    </td>
</tr>
<tr hidden>
    <td><label for='txtUsuFecha_permiso'>Fecha_permiso:</label></td>
    <td><input type='text' id='txtUsuFecha_permiso' name='txtUsuFecha_permiso' value='<?php if ($row) {
			echo formatDate($row['fecha_permiso']);
		} ?>' placeholder='Ingrese fecha_permiso'/></td>
</tr>
<tr hidden>
    <td><label for='txtUsuEstado'>Estado:</label></td>
    <td><input type='text' id='txtUsuEstado' name='txtUsuEstado' value='<?php if ($row) {
			echo $row['estado'];
		} ?>' maxlength='10' placeholder='Ingrese estado'/></td>
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
$(document).ready(function (e) {
    $('#txtUsuPersona_id').focus();
    $('#btnActualizar').off('click').click(function (e) {
        if (usu_validar()) {
            var usuario_id    = '<?php echo $usu_id; ?>';
            var persona_id    = $('#txtUsuPersona_id').val();
            var nombre        = $('#txtUsuNombre').val();
            var contrasena0   = $('#txtUsuContrasena0').val();
            var contrasena    = $('#txtUsuContrasena').val();
            var rol_id        = $('#txtUsuRol_id').val();
            var fecha_permiso = getDateYMD($('#txtUsuFecha_permiso').val());
            var estado        = $('#txtUsuEstado').val();

            $.post('vistas/usuario/proceso/usuario_cambiar_psw.php', {
                    usuario_id   : usuario_id,
                    persona_id   : persona_id,
                    nombre       : nombre,
                    contrasena0  : contrasena0,
                    contrasena   : contrasena,
                    rol_id       : rol_id,
                    fecha_permiso: fecha_permiso,
                    estado       : estado
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
    $('#btnCancelar').click(function (e) {
        volver();
    });
});
function usu_validar() {
    var persona_id    = $('#txtUsuPersona_id').val();
    var nombre        = $('#txtUsuNombre').val();
    var contrasena0   = $('#txtUsuContrasena0').val();
    var contrasena    = $('#txtUsuContrasena').val();
    var contrasena2   = $('#txtUsuContrasena2').val();
    var rol_id        = $('#txtUsuRol_id').val();
    var fecha_permiso = $('#txtUsuFecha_permiso').val();

    if (!(isInteger(persona_id) && persona_id > 0)) {
        showMessageWarning('Seleccione <b>persona</b>', 'txtUsuPersona_id');
        return false;
    }
    if (nombre == '') {
        showMessageWarning('Ingrese <b>nombre</b> de usuario', 'txtUsuNombre');
        return false;
    }
    if (contrasena0 == '') {
        showMessageWarning('Ingrese <b>contrasena</b> anterior', 'txtUsuContrasena0');
        return false;
    }
    if (contrasena == '') {
        showMessageWarning('Ingrese <b>contrasena</b>', 'txtUsuContrasena');
        return false;
    }
    if (contrasena != contrasena2) {
        showMessageWarning('Las <b>contrasenas</b> no coinciden', 'txtUsuContrasena2');
        return false;
    }
    if (!(isInteger(rol_id) && rol_id > 0)) {
        showMessageWarning('Seleccione <b>rol</b>', 'txtUsuRol_id');
        return false;
    }
    /*
     if (!isDate(fecha_permiso)) {
     showMessageWarning('Ingrese una <b>fecha_permiso</b> válida', 'txtUsuFecha_permiso');
     return false;
     }*/
    return true;
}
function volver() {
    performLoad('<?php echo $parent; ?>');
}
</script>