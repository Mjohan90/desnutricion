<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('tdi_reg', 'vistas/tipodocident/tipodocident.php');
?>
<form id='frmTipodocidentReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar tipo documento de identidad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtTdiNombre'>Nombre:</label></td>
		<td><input type='text' id='txtTdiNombre' name='txtTdiNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtTdiAbrev'>Abrev:</label></td>
		<td><input type='text' id='txtTdiAbrev' name='txtTdiAbrev' maxlength='10' placeholder='Ingrese abrev'/></td>
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
var tdi_reg = '#frmTipodocidentReg';
$(document).ready(function(e) {
	$(tdi_reg).find('#txtTdiNombre').focus();
	$(tdi_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (tdi_validar()){
			var tdi_nombre = $(tdi_reg).find('#txtTdiNombre').val();
			var tdi_abrev = $(tdi_reg).find('#txtTdiAbrev').val();

			$.post('vistas/tipodocident/proceso/tipodocident_insert.php',{
				tdi_nombre : tdi_nombre,
				tdi_abrev : tdi_abrev
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
	$(tdi_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function tdi_validar() {
	var tdi_nombre = $(tdi_reg).find('#txtTdiNombre').val();
	var tdi_abrev = $(tdi_reg).find('#txtTdiAbrev').val();

	if (tdi_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de tipo documento de identidad', 'txtTdiNombre');
		return false;
	}
	if (tdi_abrev == '') {
		showMessageWarning('Ingrese una <b>abrev</b> válida', 'txtTdiAbrev');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>