<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('carg_reg', 'vistas/cargo/cargo.php');
?>
<form id='frmCargoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar cargo</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtCargNombre'>Nombre:</label></td>
		<td><input type='text' id='txtCargNombre' name='txtCargNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var carg_reg = '#frmCargoReg';
$(document).ready(function(e) {
	$(carg_reg).find('#txtCargNombre').focus();
	$(carg_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (carg_validar()){
			var carg_nombre = $(carg_reg).find('#txtCargNombre').val();

			$.post('vistas/cargo/proceso/cargo_insert.php',{
				carg_nombre : carg_nombre
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
	$(carg_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function carg_validar() {
	var carg_nombre = $(carg_reg).find('#txtCargNombre').val();

	if (carg_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de cargo', 'txtCargNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>