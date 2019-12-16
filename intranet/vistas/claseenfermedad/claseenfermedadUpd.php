<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('clsenferm_upd', 'vistas/claseenfermedad/claseenfermedad.php');
?>
<?php
	include_once '../../datos/claseenfermedadDAL.php';
	$clsenferm_dal = new claseenfermedadDAL();
	$clsenferm_id = GetNumParam('clsenferm_id');

	$clsenferm_row = $clsenferm_dal->getByID($clsenferm_id);
?>
<form id='frmClaseenfermedadUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2 blanco'>Editar clase de enfermedad</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtClsenfermID'>Id:</label></td>
		<td><input type='text' id='txtClsenfermID' name='txtClsenfermID' value='<?php if ($clsenferm_row) { echo $clsenferm_row['clsenferm_id']; } ?>' maxlength='10' placeholder='Ingrese id'/></td>
	</tr>
	<tr><td><label for='txtClsenfermNombre'>Nombre:</label></td>
		<td><input type='text' id='txtClsenfermNombre' name='txtClsenfermNombre' value='<?php if ($clsenferm_row) { echo $clsenferm_row['clsenferm_nombre']; } ?>'  placeholder='Ingrese nombre'/></td>
	</tr>
	<tr hidden><td><label for='txtClsenfermEstado'>Estado:</label></td>
		<td><input type='text' id='txtClsenfermEstado' name='txtClsenfermEstado' value='<?php if ($clsenferm_row) { echo $clsenferm_row['clsenferm_estado']; } ?>'  placeholder='Ingrese estado'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_naranja' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var clsenferm_upd = '#frmClaseenfermedadUpd';
$(document).ready(function(e) {
	$(clsenferm_upd).find('#txtClsenfermID').focus();
	$(clsenferm_upd).find('#btnActualizar').off('click').click(function(e) {
		if (clsenferm_validar()) {
			var clsenferm_id = '<?php echo $clsenferm_id; ?>';
			var clsenferm_nombre = $(clsenferm_upd).find('#txtClsenfermNombre').val();
			var clsenferm_estado = $(clsenferm_upd).find('#txtClsenfermEstado').val();

			$.post('vistas/claseenfermedad/proceso/claseenfermedad_update.php',{
				clsenferm_id : clsenferm_id,
				clsenferm_nombre : clsenferm_nombre,
				clsenferm_estado : clsenferm_estado
			},
			function(datos) {
				if (datos == 1){
					alert('Actualizacion correcta');
					volver();
				} else {
					alert('Error al actualizar. ' + datos);
				}
			});
		}
	});
	$(clsenferm_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function clsenferm_validar() {
	var clsenferm_id = $(clsenferm_upd).find('#txtClsenfermID').val();
	var clsenferm_nombre = $(clsenferm_upd).find('#txtClsenfermNombre').val();

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
