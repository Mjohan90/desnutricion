<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('var_upd', 'vistas/variable/variable.php');
?>
<?php
	include_once '../../datos/variableDAL.php';
	$var_dal = new variableDAL();
	$var_id = GetNumericParam('var_id');

	$var_row = $var_dal->getByID($var_id);
?>
<?php
	include_once '../../datos/categvariableDAL.php';
	$catvar_dal = new categvariableDAL();
?>
<?php
	include_once '../../datos/umDAL.php';
	$um_dal = new umDAL();
?>
<form id='frmVariableUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar variable</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtVarCatvarID'>Categoría de variable:</label></td>
		<td><select id='txtVarCatvarID' name='txtVarCatvarID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $catvar_list = $catvar_dal->listarcbo($var_row['var_catvar_id']); ?>
			<?php foreach($catvar_list as $row) { ?>
				<option value='<?php echo $row['catvar_id']; ?>'
					<?php echo ($row['catvar_id'] == $var_row['catvar_id']) ? 'selected' : '';  ?>>
					<?php echo $row['catvar_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtVarNombre'>Nombre:</label></td>
		<td><input type='text' id='txtVarNombre' name='txtVarNombre' value='<?php if ($var_row) { echo htmlspecialchars($var_row['var_nombre']); } ?>' maxlength='50' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtVarUmID'>Unidad de medida:</label></td>
		<td><select id='txtVarUmID' name='txtVarUmID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $um_list = $um_dal->listarcbo($var_row['var_um_id']); ?>
			<?php foreach($um_list as $row) { ?>
				<option value='<?php echo $row['um_id']; ?>'
					<?php echo ($row['um_id'] == $var_row['um_id']) ? 'selected' : '';  ?>>
					<?php echo $row['um_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtVarTipoVar'>Tipo var:</label></td>
		<td><input type='text' id='txtVarTipoVar' name='txtVarTipoVar' value='<?php if ($var_row) { echo htmlspecialchars($var_row['var_tipo_var']); } ?>' maxlength='1' placeholder='Ingrese tipo var'/></td>
	</tr>
	<tr hidden><td><label for='txtVarEstado'>Estado:</label></td>
		<td><input type='text' id='txtVarEstado' name='txtVarEstado' value='<?php if ($var_row) { echo $var_row['var_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var var_upd = '#frmVariableUpd';
$(document).ready(function(e) {
	$(var_upd).find('#txtVarCatvarID').focus();
	$(var_upd).find('#btnActualizar').off('click').click(function(e) {
		if (var_validar()) {
			var var_id = '<?php echo $var_id; ?>';
			var var_catvar_id = $(var_upd).find('#txtVarCatvarID').val();
			var var_nombre = $(var_upd).find('#txtVarNombre').val();
			var var_um_id = $(var_upd).find('#txtVarUmID').val();
			var var_tipo_var = $(var_upd).find('#txtVarTipoVar').val();
			var var_estado = $(var_upd).find('#txtVarEstado').val();

			$.post('vistas/variable/proceso/variable_update.php',{
				var_id : var_id,
				var_catvar_id : var_catvar_id,
				var_nombre : var_nombre,
				var_um_id : var_um_id,
				var_tipo_var : var_tipo_var,
				var_estado : var_estado
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
	$(var_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function var_validar() {
	var var_catvar_id = $(var_upd).find('#txtVarCatvarID').val();
	var var_nombre = $(var_upd).find('#txtVarNombre').val();
	var var_um_id = $(var_upd).find('#txtVarUmID').val();
	var var_tipo_var = $(var_upd).find('#txtVarTipoVar').val();

	if (!(isInteger(var_catvar_id) && var_catvar_id > 0)) {
		showMessageWarning('Seleccione <b>categoría de variable</b>', 'txtVarCatvarID');
		return false;
	}
	if (var_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de variable', 'txtVarNombre');
		return false;
	}
	if (!(isInteger(var_um_id) && var_um_id > 0)) {
		showMessageWarning('Seleccione <b>unidad de medida</b>', 'txtVarUmID');
		return false;
	}
	if (var_tipo_var == '') {
		showMessageWarning('Ingrese <b>tipo var</b>', 'txtVarTipoVar');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>