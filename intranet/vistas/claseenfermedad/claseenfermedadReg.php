<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('clsenferm_reg', 'vistas/claseenfermedad/claseenfermedad.php');
?>
<form id='frmClaseenfermedadReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2 blanco'>Registrar clase de enfermedad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtClsenfermID'>Id:</label></td>
		<td><input type='text' id='txtClsenfermID' name='txtClsenfermID' maxlength='10' placeholder='Ingrese id'/></td>
	</tr>
	<tr><td><label for='txtClsenfermNombre'>Nombre:</label></td>
		<td><input type='text' id='txtClsenfermNombre' name='txtClsenfermNombre'  placeholder='Ingrese nombre'/></td>
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
var clsenferm_reg = '#frmClaseenfermedadReg';
$(document).ready(function(e) {
	$(clsenferm_reg).find('#txtClsenfermID').focus();
	$(clsenferm_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (clsenferm_validar()){
			var clsenferm_id = $(clsenferm_reg).find('#txtClsenfermID').val();
			var clsenferm_nombre = $(clsenferm_reg).find('#txtClsenfermNombre').val();

			$.post('vistas/claseenfermedad/proceso/claseenfermedad_insert.php',{
				clsenferm_id : clsenferm_id,
				clsenferm_nombre : clsenferm_nombre
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
	$(clsenferm_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function clsenferm_validar() {
	var clsenferm_id = $(clsenferm_reg).find('#txtClsenfermID').val();
	var clsenferm_nombre = $(clsenferm_reg).find('#txtClsenfermNombre').val();

	if (!isInteger(clsenferm_id)) {
		showMessageWarning('Ingrese <b>id</b> válido', 'txtClsenfermID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>