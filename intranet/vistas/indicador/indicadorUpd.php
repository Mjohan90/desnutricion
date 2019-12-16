<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('indic_upd', 'vistas/indicador/indicador.php');
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
	$indic_id = GetNumParam('indic_id');

	$indic_row = $indic_dal->getByID($indic_id);
?>
<form id='frmIndicadorUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar indicador</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtIndicNombre'>Nombre:</label></td>
		<td><input type='text' id='txtIndicNombre' name='txtIndicNombre' value='<?php if ($indic_row) { echo htmlspecialchars($indic_row['indic_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtIndicVar1ID'>Var1 id:</label></td>
		<td><input type='text' id='txtIndicVar1ID' name='txtIndicVar1ID' value='<?php if ($indic_row) { echo $indic_row['indic_var1_id']; } ?>' maxlength='10' placeholder='Ingrese var1 id'/></td>
	</tr>
	<tr><td><label for='txtIndicVar2ID'>Var2 id:</label></td>
		<td><input type='text' id='txtIndicVar2ID' name='txtIndicVar2ID' value='<?php if ($indic_row) { echo $indic_row['indic_var2_id']; } ?>' maxlength='10' placeholder='Ingrese var2 id'/></td>
	</tr>
	<tr hidden><td><label for='txtIndicEstado'>Estado:</label></td>
		<td><input type='text' id='txtIndicEstado' name='txtIndicEstado' value='<?php if ($indic_row) { echo $indic_row['indic_estado']; } ?>'  placeholder='Ingrese estado'/></td>
	</tr>
</table>
<hr class='separator'/>
<div class='form_foot'>
		<input class='btn b_verde' type='button' name='btnActualizar' id='btnActualizar' value='Guardar'/>
		<input class='btn' type='button' name='btnCancelar' id='btnCancelar' value='Cancelar'/>
</div></div></div>
</form>
<br/>
<script>
var indic_upd = '#frmIndicadorUpd';
$(document).ready(function(e) {
	$(indic_upd).find('#txtIndicNombre').focus();
	$(indic_upd).find('#btnActualizar').off('click').click(function(e) {
		if (indic_validar()) {
			var indic_id = '<?php echo $indic_id; ?>';
			var indic_nombre = $(indic_upd).find('#txtIndicNombre').val();
			var indic_var1_id = $(indic_upd).find('#txtIndicVar1ID').val();
			var indic_var2_id = $(indic_upd).find('#txtIndicVar2ID').val();
			var indic_estado = $(indic_upd).find('#txtIndicEstado').val();

			$.post('vistas/indicador/proceso/indicador_update.php',{
				indic_id : indic_id,
				indic_nombre : indic_nombre,
				indic_var1_id : indic_var1_id,
				indic_var2_id : indic_var2_id,
				indic_estado : indic_estado
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
	$(indic_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function indic_validar() {
	var indic_nombre = $(indic_upd).find('#txtIndicNombre').val();
	var indic_var1_id = $(indic_upd).find('#txtIndicVar1ID').val();
	var indic_var2_id = $(indic_upd).find('#txtIndicVar2ID').val();

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
