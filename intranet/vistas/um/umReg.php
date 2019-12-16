<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('um_reg', 'vistas/um/um.php');
?>
<form id='frmUmReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar unidad de medida</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtUmNombre'>Nombre:</label></td>
		<td><input type='text' id='txtUmNombre' name='txtUmNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtUmAbrev'>Abrev:</label></td>
		<td><input type='text' id='txtUmAbrev' name='txtUmAbrev' maxlength='10' placeholder='Ingrese abrev'/></td>
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
var um_reg = '#frmUmReg';
$(document).ready(function(e) {
	$(um_reg).find('#txtUmNombre').focus();
	$(um_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (um_validar()){
			var um_nombre = $(um_reg).find('#txtUmNombre').val();
			var um_abrev = $(um_reg).find('#txtUmAbrev').val();

			$.post('vistas/um/proceso/um_insert.php',{
				um_nombre : um_nombre,
				um_abrev : um_abrev
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
	$(um_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function um_validar() {
	var um_nombre = $(um_reg).find('#txtUmNombre').val();
	var um_abrev = $(um_reg).find('#txtUmAbrev').val();

	if (um_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de unidad de medida', 'txtUmNombre');
		return false;
	}
	if (um_abrev == '') {
		showMessageWarning('Ingrese una <b>abrev</b> válida', 'txtUmAbrev');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>