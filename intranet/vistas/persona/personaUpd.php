<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('pers_upd', 'vistas/persona/persona.php');
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
	$pers_id = GetNumericParam('pers_id');

	$pers_row = $pers_dal->getByID($pers_id);
?>
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
?>
<form id='frmPersonaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar persona</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPersNombre'>Nombre:</label></td>
		<td><input type='text' id='txtPersNombre' name='txtPersNombre' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_nombre']); } ?>' maxlength='30' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtPersSnombre'>Snombre:</label></td>
		<td><input type='text' id='txtPersSnombre' name='txtPersSnombre' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_snombre']); } ?>' maxlength='30' placeholder='Ingrese snombre'/></td>
	</tr>
	<tr><td><label for='txtPersApPaterno'>Ap paterno:</label></td>
		<td><input type='text' id='txtPersApPaterno' name='txtPersApPaterno' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_ap_paterno']); } ?>' maxlength='30' placeholder='Ingrese ap paterno'/></td>
	</tr>
	<tr><td><label for='txtPersApMaterno'>Ap materno:</label></td>
		<td><input type='text' id='txtPersApMaterno' name='txtPersApMaterno' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_ap_materno']); } ?>' maxlength='30' placeholder='Ingrese ap materno'/></td>
	</tr>
	<tr><td><label for='txtPersTdiID'>Tipo documento de identidad:</label></td>
		<td><select id='txtPersTdiID' name='txtPersTdiID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tdi_list = $tdi_dal->listarcbo($pers_row['pers_tdi_id']); ?>
			<?php foreach($tdi_list as $row) { ?>
				<option value='<?php echo $row['tdi_id']; ?>'
					<?php echo ($row['tdi_id'] == $pers_row['tdi_id']) ? 'selected' : '';  ?>>
					<?php echo $row['tdi_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtPersTdiNro'>Tdi nro:</label></td>
		<td><input type='text' id='txtPersTdiNro' name='txtPersTdiNro' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_tdi_nro']); } ?>' maxlength='20' placeholder='Ingrese tdi nro'/></td>
	</tr>
	<tr><td><label for='txtPersSexo'>Sexo:</label></td>
		<td><input type='text' id='txtPersSexo' name='txtPersSexo' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_sexo']); } ?>' maxlength='1' placeholder='Ingrese sexo'/></td>
	</tr>
	<tr><td><label for='txtPersFechaNac'>Fecha nac:</label></td>
		<td><input type='text' id='txtPersFechaNac' name='txtPersFechaNac' value='<?php if ($pers_row) { echo formatDate($pers_row['pers_fecha_nac']); } ?>'  placeholder='Ingrese fecha nac'/></td>
	</tr>
	<tr><td><label for='txtPersEmail'>Email:</label></td>
		<td><input type='text' id='txtPersEmail' name='txtPersEmail' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_email']); } ?>' maxlength='20' placeholder='Ingrese email'/></td>
	</tr>
	<tr><td><label for='txtPersCelular'>Celular:</label></td>
		<td><input type='text' id='txtPersCelular' name='txtPersCelular' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_celular']); } ?>' maxlength='20' placeholder='Ingrese celular'/></td>
	</tr>
	<tr><td><label for='txtPersTelefono'>Telefono:</label></td>
		<td><input type='text' id='txtPersTelefono' name='txtPersTelefono' value='<?php if ($pers_row) { echo htmlspecialchars($pers_row['pers_telefono']); } ?>' maxlength='20' placeholder='Ingrese telefono'/></td>
	</tr>
	<tr hidden><td><label for='txtPersEstado'>Estado:</label></td>
		<td><input type='text' id='txtPersEstado' name='txtPersEstado' value='<?php if ($pers_row) { echo $pers_row['pers_estado']; } ?>'  placeholder='Ingrese estado'/></td>
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
var pers_upd = '#frmPersonaUpd';
$(document).ready(function(e) {
	$(pers_upd).find('#txtPersNombre').focus();
	$(pers_upd).find('#btnActualizar').off('click').click(function(e) {
		if (pers_validar()) {
			var pers_id = '<?php echo $pers_id; ?>';
			var pers_nombre = $(pers_upd).find('#txtPersNombre').val();
			var pers_snombre = $(pers_upd).find('#txtPersSnombre').val();
			var pers_ap_paterno = $(pers_upd).find('#txtPersApPaterno').val();
			var pers_ap_materno = $(pers_upd).find('#txtPersApMaterno').val();
			var pers_tdi_id = $(pers_upd).find('#txtPersTdiID').val();
			var pers_tdi_nro = $(pers_upd).find('#txtPersTdiNro').val();
			var pers_sexo = $(pers_upd).find('#txtPersSexo').val();
			var pers_fecha_nac = getDateYMD($(pers_upd).find('#txtPersFechaNac').val());
			var pers_email = $(pers_upd).find('#txtPersEmail').val();
			var pers_celular = $(pers_upd).find('#txtPersCelular').val();
			var pers_telefono = $(pers_upd).find('#txtPersTelefono').val();
			var pers_estado = $(pers_upd).find('#txtPersEstado').val();

			$.post('vistas/persona/proceso/persona_update.php',{
				pers_id : pers_id,
				pers_nombre : pers_nombre,
				pers_snombre : pers_snombre,
				pers_ap_paterno : pers_ap_paterno,
				pers_ap_materno : pers_ap_materno,
				pers_tdi_id : pers_tdi_id,
				pers_tdi_nro : pers_tdi_nro,
				pers_sexo : pers_sexo,
				pers_fecha_nac : pers_fecha_nac,
				pers_email : pers_email,
				pers_celular : pers_celular,
				pers_telefono : pers_telefono,
				pers_estado : pers_estado
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
	$(pers_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function pers_validar() {
	var pers_nombre = $(pers_upd).find('#txtPersNombre').val();
	var pers_snombre = $(pers_upd).find('#txtPersSnombre').val();
	var pers_ap_paterno = $(pers_upd).find('#txtPersApPaterno').val();
	var pers_ap_materno = $(pers_upd).find('#txtPersApMaterno').val();
	var pers_tdi_id = $(pers_upd).find('#txtPersTdiID').val();
	var pers_tdi_nro = $(pers_upd).find('#txtPersTdiNro').val();
	var pers_sexo = $(pers_upd).find('#txtPersSexo').val();
	var pers_fecha_nac = $(pers_upd).find('#txtPersFechaNac').val();
	var pers_email = $(pers_upd).find('#txtPersEmail').val();
	var pers_celular = $(pers_upd).find('#txtPersCelular').val();
	var pers_telefono = $(pers_upd).find('#txtPersTelefono').val();

	if (pers_nombre == '') {
		showMessageWarning('Ingrese una <b>nombre</b> válida de persona', 'txtPersNombre');
		return false;
	}
	if (pers_snombre == '') {
		showMessageWarning('Ingrese una <b>snombre</b> válida de persona', 'txtPersSnombre');
		return false;
	}
	if (pers_ap_paterno == '') {
		showMessageWarning('Ingrese una <b>ap paterno</b> válida', 'txtPersApPaterno');
		return false;
	}
	if (pers_ap_materno == '') {
		showMessageWarning('Ingrese una <b>ap materno</b> válida', 'txtPersApMaterno');
		return false;
	}
	if (!(isInteger(pers_tdi_id) && pers_tdi_id > 0)) {
		showMessageWarning('Seleccione <b>tipo documento de identidad</b>', 'txtPersTdiID');
		return false;
	}
	if (pers_tdi_nro == '') {
		showMessageWarning('Ingrese una <b>tdi nro</b> válida', 'txtPersTdiNro');
		return false;
	}
	if (pers_sexo == '') {
		showMessageWarning('Ingrese <b>sexo</b>', 'txtPersSexo');
		return false;
	}
	if (!isDate(pers_fecha_nac)) {
		showMessageWarning('Ingrese una <b>fecha nac</b> válida', 'txtPersFechaNac');
		return false;
	}
	if (!isEmail(pers_email)) {
		showMessageWarning('Ingrese valor de <b>email</b> válido', 'txtPersEmail');
		return false;
	}
	if (pers_celular == '') {
		showMessageWarning('Ingrese una <b>celular</b> válida', 'txtPersCelular');
		return false;
	}
	if (pers_telefono == '') {
		showMessageWarning('Ingrese una <b>telefono</b> válida', 'txtPersTelefono');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>