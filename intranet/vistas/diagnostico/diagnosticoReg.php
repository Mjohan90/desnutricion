<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('diag_reg', 'vistas/diagnostico/diagnostico.php');
?>
<form id='frmDiagnosticoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar diagnóstico</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtDiagNombre'>Nombre:</label></td>
		<td><input type='text' id='txtDiagNombre' name='txtDiagNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtDiagTratamientoSug'>Tratamiento sug:</label></td>
		<td><input type='text' id='txtDiagTratamientoSug' name='txtDiagTratamientoSug' maxlength='500' placeholder='Ingrese tratamiento sug'/></td>
	</tr>
	<tr><td><label for='txtDiagDietaSug'>Dieta sug:</label></td>
		<td><input type='text' id='txtDiagDietaSug' name='txtDiagDietaSug' maxlength='500' placeholder='Ingrese dieta sug'/></td>
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
var diag_reg = '#frmDiagnosticoReg';
$(document).ready(function(e) {
	$(diag_reg).find('#txtDiagNombre').focus();
	$(diag_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (diag_validar()){
			var diag_nombre = $(diag_reg).find('#txtDiagNombre').val();
			var diag_tratamiento_sug = $(diag_reg).find('#txtDiagTratamientoSug').val();
			var diag_dieta_sug = $(diag_reg).find('#txtDiagDietaSug').val();

			$.post('vistas/diagnostico/proceso/diagnostico_insert.php',{
				diag_nombre : diag_nombre,
				diag_tratamiento_sug : diag_tratamiento_sug,
				diag_dieta_sug : diag_dieta_sug
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
	$(diag_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function diag_validar() {
	var diag_nombre = $(diag_reg).find('#txtDiagNombre').val();
	var diag_tratamiento_sug = $(diag_reg).find('#txtDiagTratamientoSug').val();
	var diag_dieta_sug = $(diag_reg).find('#txtDiagDietaSug').val();

	if (diag_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de diagnóstico', 'txtDiagNombre');
		return false;
	}
	if (diag_tratamiento_sug == '') {
		showMessageWarning('Ingrese una <b>tratamiento sug</b> válida', 'txtDiagTratamientoSug');
		return false;
	}
	if (diag_dieta_sug == '') {
		showMessageWarning('Ingrese una <b>dieta sug</b> válida', 'txtDiagDietaSug');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>