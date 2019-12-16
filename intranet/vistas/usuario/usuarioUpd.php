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
	$usu_dal = new usuarioDAL();
	$usu_id = GetNumericParam('usu_id');

	$usu_row = $usu_dal->getByID($usu_id);
?>
<?php
	include_once '../../datos/empleadoDAL.php';
	$empl_dal = new empleadoDAL();
?>
<?php
	include_once '../../datos/rolDAL.php';
	$rol_dal = new rolDAL();
?>
<form id='frmUsuarioUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar usuario</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUsuNombre'>Nombre:</label></td>
		<td><input type='text' id='txtUsuNombre' name='txtUsuNombre' value='<?php if ($usu_row) { echo htmlspecialchars($usu_row['usu_nombre']); } ?>' maxlength='20' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtUsuContrasena'>Contrasena:</label></td>
		<td><input type='password' id='txtUsuContrasena' name='txtUsuContrasena' value='' maxlength='32' placeholder='Ingrese contrasena'/></td>
	</tr>
	<tr><td><label for='txtUsuEmplID'>Empleado:</label></td>
		<td><select id='txtUsuEmplID' name='txtUsuEmplID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $empl_list = $empl_dal->listarcbo($usu_row['usu_empl_id']); ?>
			<?php foreach($empl_list as $row) { ?>
				<option value='<?php echo $row['empl_id']; ?>'
					<?php echo ($row['empl_id'] == $usu_row['empl_id']) ? 'selected' : '';  ?>>
					<?php echo $row['empl_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtUsuRolID'>Rol:</label></td>
		<td><select id='txtUsuRolID' name='txtUsuRolID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $rol_list = $rol_dal->listarcbo($usu_row['usu_rol_id']); ?>
			<?php foreach($rol_list as $row) { ?>
				<option value='<?php echo $row['rol_id']; ?>'
					<?php echo ($row['rol_id'] == $usu_row['rol_id']) ? 'selected' : '';  ?>>
					<?php echo $row['rol_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr hidden><td><label for='txtUsuEstado'>Estado:</label></td>
		<td><input type='text' id='txtUsuEstado' name='txtUsuEstado' value='<?php if ($usu_row) { echo $usu_row['usu_estado']; } ?>'  placeholder='Ingrese estado'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_verde' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var usu_upd = '#frmUsuarioUpd';
$(document).ready(function(e) {
	$(usu_upd).find('#txtUsuNombre').focus();
	$(usu_upd).find('#btnActualizar').off('click').click(function(e) {
		if (usu_validar()) {
			var usu_id = '<?php echo $usu_id; ?>';
			var usu_nombre = $(usu_upd).find('#txtUsuNombre').val();
			var usu_contrasena = $(usu_upd).find('#txtUsuContrasena').val();
			var usu_empl_id = $(usu_upd).find('#txtUsuEmplID').val();
			var usu_rol_id = $(usu_upd).find('#txtUsuRolID').val();
			var usu_estado = $(usu_upd).find('#txtUsuEstado').val();

			$.post('vistas/usuario/proceso/usuario_update.php',{
				usu_id : usu_id,
				usu_nombre : usu_nombre,
				usu_contrasena : usu_contrasena,
				usu_empl_id : usu_empl_id,
				usu_rol_id : usu_rol_id,
				usu_estado : usu_estado
			},
			function(datos) {
				if (datos == 1){
					alert('Actualizacion correcta');
					volver();
				} else {
					alert('Error al actualizar. ' + datos);
				}
			});
		}
	});
	$(usu_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function usu_validar() {
	var usu_nombre = $(usu_upd).find('#txtUsuNombre').val();
	var usu_contrasena = $(usu_upd).find('#txtUsuContrasena').val();
	var usu_empl_id = $(usu_upd).find('#txtUsuEmplID').val();
	var usu_rol_id = $(usu_upd).find('#txtUsuRolID').val();

	if (usu_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de usuario', 'txtUsuNombre');
		return false;
	}
	if (usu_contrasena == '') {
		showMessageWarning('Ingrese una <b>contrasena</b> válida', 'txtUsuContrasena');
		return false;
	}
	if (!(isInteger(usu_empl_id) && usu_empl_id > 0)) {
		showMessageWarning('Seleccione <b>empleado</b>', 'txtUsuEmplID');
		return false;
	}
	if (!(isInteger(usu_rol_id) && usu_rol_id > 0)) {
		showMessageWarning('Seleccione <b>rol</b>', 'txtUsuRolID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>