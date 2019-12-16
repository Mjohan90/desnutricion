<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('catvar_reg', 'vistas/categvariable/categvariable.php');
?>
<form id='frmCategvariableReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar categoría de variable</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCatvarNombre'>Nombre:</label></td>
		<td><input type='text' id='txtCatvarNombre' name='txtCatvarNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var catvar_reg = '#frmCategvariableReg';
$(document).ready(function(e) {
	$(catvar_reg).find('#txtCatvarNombre').focus();
	$(catvar_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (catvar_validar()){
			var catvar_nombre = $(catvar_reg).find('#txtCatvarNombre').val();

			$.post('vistas/categvariable/proceso/categvariable_insert.php',{
				catvar_nombre : catvar_nombre
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
	$(catvar_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function catvar_validar() {
	var catvar_nombre = $(catvar_reg).find('#txtCatvarNombre').val();

	if (catvar_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de categoría de variable', 'txtCatvarNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>