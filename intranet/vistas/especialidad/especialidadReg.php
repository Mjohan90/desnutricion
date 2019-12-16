<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('espec_reg', 'vistas/especialidad/especialidad.php');
?>
<form id='frmEspecialidadReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar especialidad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtEspecNombre'>Nombre:</label></td>
		<td><input type='text' id='txtEspecNombre' name='txtEspecNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var espec_reg = '#frmEspecialidadReg';
$(document).ready(function(e) {
	$(espec_reg).find('#txtEspecNombre').focus();
	$(espec_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (espec_validar()){
			var espec_nombre = $(espec_reg).find('#txtEspecNombre').val();

			$.post('vistas/especialidad/proceso/especialidad_insert.php',{
				espec_nombre : espec_nombre
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
	$(espec_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function espec_validar() {
	var espec_nombre = $(espec_reg).find('#txtEspecNombre').val();

	if (espec_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de especialidad', 'txtEspecNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>