<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('hc_reg', 'vistas/historiaclinica/historiaclinica.php');
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
?>
<form id='frmHistoriaclinicaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar historia clínica</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtHcPacID'>Paciente:</label></td>
		<td><select id='txtHcPacID' name='txtHcPacID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pac_list = $pac_dal->listarcbo(); ?>
			<?php foreach($pac_list as $row) { ?>
				<option value='<?php echo $row['pac_id']; ?>'>
					<?php echo $row['pac_id'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtHcFechaSuceso'>Fecha suceso:</label></td>
		<td><input type='text' id='txtHcFechaSuceso' name='txtHcFechaSuceso'  placeholder='Ingrese fecha suceso'/></td>
	</tr>
	<tr><td><label for='txtHcComentario'>Comentario:</label></td>
		<td><input type='text' id='txtHcComentario' name='txtHcComentario' maxlength='400' placeholder='Ingrese comentario'/></td>
	</tr>
	<tr><td><label for='txtHcAtencIDRef'>Atenc id ref:</label></td>
		<td><input type='text' id='txtHcAtencIDRef' name='txtHcAtencIDRef' maxlength='10' placeholder='Ingrese atenc id ref'/></td>
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
var hc_reg = '#frmHistoriaclinicaReg';
$(document).ready(function(e) {
	$(hc_reg).find('#txtHcPacID').focus();
	$(hc_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (hc_validar()){
			var hc_pac_id = $(hc_reg).find('#txtHcPacID').val();
			var hc_fecha_suceso = getDateYMD($(hc_reg).find('#txtHcFechaSuceso').val());
			var hc_comentario = $(hc_reg).find('#txtHcComentario').val();
			var hc_atenc_id_ref = $(hc_reg).find('#txtHcAtencIDRef').val();

			$.post('vistas/historiaclinica/proceso/historiaclinica_insert.php',{
				hc_pac_id : hc_pac_id,
				hc_fecha_suceso : hc_fecha_suceso,
				hc_comentario : hc_comentario,
				hc_atenc_id_ref : hc_atenc_id_ref
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
	$(hc_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function hc_validar() {
	var hc_pac_id = $(hc_reg).find('#txtHcPacID').val();
	var hc_fecha_suceso = $(hc_reg).find('#txtHcFechaSuceso').val();
	var hc_comentario = $(hc_reg).find('#txtHcComentario').val();
	var hc_atenc_id_ref = $(hc_reg).find('#txtHcAtencIDRef').val();

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