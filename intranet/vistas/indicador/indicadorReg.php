<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('indic_reg', 'vistas/indicador/indicador.php');
?>
<form id='frmIndicadorReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar indicador</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtIndicNombre'>Nombre:</label></td>
		<td><input type='text' id='txtIndicNombre' name='txtIndicNombre' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtIndicVar1ID'>Var1 id:</label></td>
		<td><input type='text' id='txtIndicVar1ID' name='txtIndicVar1ID' maxlength='10' placeholder='Ingrese var1 id'/></td>
	</tr>
	<tr><td><label for='txtIndicVar2ID'>Var2 id:</label></td>
		<td><input type='text' id='txtIndicVar2ID' name='txtIndicVar2ID' maxlength='10' placeholder='Ingrese var2 id'/></td>
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
var indic_reg = '#frmIndicadorReg';
$(document).ready(function(e) {
	$(indic_reg).find('#txtIndicNombre').focus();
	$(indic_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (indic_validar()){
			var indic_nombre = $(indic_reg).find('#txtIndicNombre').val();
			var indic_var1_id = $(indic_reg).find('#txtIndicVar1ID').val();
			var indic_var2_id = $(indic_reg).find('#txtIndicVar2ID').val();

			$.post('vistas/indicador/proceso/indicador_insert.php',{
				indic_nombre : indic_nombre,
				indic_var1_id : indic_var1_id,
				indic_var2_id : indic_var2_id
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
	$(indic_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function indic_validar() {
	var indic_nombre = $(indic_reg).find('#txtIndicNombre').val();
	var indic_var1_id = $(indic_reg).find('#txtIndicVar1ID').val();
	var indic_var2_id = $(indic_reg).find('#txtIndicVar2ID').val();

	if (indic_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de indicador', 'txtIndicNombre');
		return false;
	}
	if (!isInteger(indic_var1_id)) {
		showMessageWarning('Ingrese <b>var1 id</b> válido', 'txtIndicVar1ID');
		return false;
	}
	if (!isInteger(indic_var2_id)) {
		showMessageWarning('Ingrese <b>var2 id</b> válido', 'txtIndicVar2ID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>