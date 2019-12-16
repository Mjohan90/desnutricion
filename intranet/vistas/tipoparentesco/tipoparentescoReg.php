<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tparent_reg', 'vistas/tipoparentesco/tipoparentesco.php');
?>
<form id='frmTipoparentescoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo de parentesco</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTparentNombre'>Nombre:</label></td>
		<td><input type='text' id='txtTparentNombre' name='txtTparentNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
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
var tparent_reg = '#frmTipoparentescoReg';
$(document).ready(function(e) {
	$(tparent_reg).find('#txtTparentNombre').focus();
	$(tparent_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tparent_validar()){
			var tparent_nombre = $(tparent_reg).find('#txtTparentNombre').val();

			$.post('vistas/tipoparentesco/proceso/tipoparentesco_insert.php',{
				tparent_nombre : tparent_nombre
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
	$(tparent_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tparent_validar() {
	var tparent_nombre = $(tparent_reg).find('#txtTparentNombre').val();

	if (tparent_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo de parentesco', 'txtTparentNombre');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>