<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('rol_reg', 'vistas/rol/rol.php');
?>
<form id='frmRolReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar rol</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtRolNombre'>Nombre:</label></td>
		<td><input type='text' id='txtRolNombre' name='txtRolNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
	<input class='btn b_azul' type='button' name='btnRegistrar' id='btnRegistrar' value='Registrar'/>
	<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var rol_reg = '#frmRolReg';
$(document).ready(function(e) {
	$(rol_reg).find('#txtRolNombre').focus();
	$(rol_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (rol_validar()){
			var rol_nombre = $(rol_reg).find('#txtRolNombre').val();

			$.post('vistas/rol/proceso/rol_insert.php',{
				rol_nombre : rol_nombre
			},
			function(datos) {
				if (datos > 0) {
					alert('Registro correcto');
					volver();
				} else {
					alert('Error al registrar. ' + datos);
				}
			});
		}
	});
	$(rol_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function rol_validar() {
	var rol_nombre = $(rol_reg).find('#txtRolNombre').val();

	if (rol_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de rol', 'txtRolNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>