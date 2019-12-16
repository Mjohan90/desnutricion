<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('hc_upd', 'vistas/historiaclinica/historiaclinica.php');
?>
<?php
	include_once '../../datos/historiaclinicaDAL.php';
	$hc_dal = new historiaclinicaDAL();
	$hc_id = GetNumParam('hc_id');

	$hc_row = $hc_dal->getByID($hc_id);
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
?>
<form id='frmHistoriaclinicaUpd' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Editar historia clínica</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtHcPacID'>Paciente:</label></td>
		<td><select id='txtHcPacID' name='txtHcPacID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pac_list = $pac_dal->listarcbo($hc_row['hc_pac_id']); ?>
			<?php foreach($pac_list as $row) { ?>
				<option value='<?php echo $row['pac_id']; ?>'
					<?php echo ($row['pac_id'] == $hc_row['pac_id']) ? 'selected' : '';  ?>>
					<?php echo $row['pac_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtHcFechaSuceso'>Fecha suceso:</label></td>
		<td><input type='text' id='txtHcFechaSuceso' name='txtHcFechaSuceso' value='<?php if ($hc_row) { echo formatDate($hc_row['hc_fecha_suceso']); } ?>'  placeholder='Ingrese fecha suceso'/></td>
	</tr>
	<tr><td><label for='txtHcComentario'>Comentario:</label></td>
		<td><input type='text' id='txtHcComentario' name='txtHcComentario' value='<?php if ($hc_row) { echo htmlspecialchars($hc_row['hc_comentario']); } ?>' maxlength='400' placeholder='Ingrese comentario'/></td>
	</tr>
	<tr><td><label for='txtHcAtencIDRef'>Atenc id ref:</label></td>
		<td><input type='text' id='txtHcAtencIDRef' name='txtHcAtencIDRef' value='<?php if ($hc_row) { echo $hc_row['hc_atenc_id_ref']; } ?>' maxlength='10' placeholder='Ingrese atenc id ref'/></td>
	</tr>
	<tr hidden><td><label for='txtHcEstado'>Estado:</label></td>
		<td><input type='text' id='txtHcEstado' name='txtHcEstado' value='<?php if ($hc_row) { echo $hc_row['hc_estado']; } ?>' maxlength='10' placeholder='Ingrese estado'/></td>
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
var hc_upd = '#frmHistoriaclinicaUpd';
$(document).ready(function(e) {
	$(hc_upd).find('#txtHcPacID').focus();
	$(hc_upd).find('#btnActualizar').off('click').click(function(e) {
		if (hc_validar()) {
			var hc_id = '<?php echo $hc_id; ?>';
			var hc_pac_id = $(hc_upd).find('#txtHcPacID').val();
			var hc_fecha_suceso = getDateYMD($(hc_upd).find('#txtHcFechaSuceso').val());
			var hc_comentario = $(hc_upd).find('#txtHcComentario').val();
			var hc_atenc_id_ref = $(hc_upd).find('#txtHcAtencIDRef').val();
			var hc_estado = $(hc_upd).find('#txtHcEstado').val();

			$.post('vistas/historiaclinica/proceso/historiaclinica_update.php',{
				hc_id : hc_id,
				hc_pac_id : hc_pac_id,
				hc_fecha_suceso : hc_fecha_suceso,
				hc_comentario : hc_comentario,
				hc_atenc_id_ref : hc_atenc_id_ref,
				hc_estado : hc_estado
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
	$(hc_upd).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function hc_validar() {
	var hc_pac_id = $(hc_upd).find('#txtHcPacID').val();
	var hc_fecha_suceso = $(hc_upd).find('#txtHcFechaSuceso').val();
	var hc_comentario = $(hc_upd).find('#txtHcComentario').val();
	var hc_atenc_id_ref = $(hc_upd).find('#txtHcAtencIDRef').val();

	if (!(isInteger(hc_pac_id) && hc_pac_id > 0)) {
		showMessageWarning('Seleccione <b>paciente</b>', 'txtHcPacID');
		return false;
	}
	if (!isDate(hc_fecha_suceso)) {
		showMessageWarning('Ingrese una <b>fecha suceso</b> válida', 'txtHcFechaSuceso');
		return false;
	}
	if (hc_comentario == '') {
		showMessageWarning('Ingrese una <b>comentario</b> válida', 'txtHcComentario');
		return false;
	}
	if (!isInteger(hc_atenc_id_ref)) {
		showMessageWarning('Ingrese <b>atenc id ref</b> válido', 'txtHcAtencIDRef');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>
