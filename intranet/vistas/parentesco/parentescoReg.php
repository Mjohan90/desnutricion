<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('parent_reg', 'vistas/parentesco/parentesco.php');
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<?php
	include_once '../../datos/tipoparentescoDAL.php';
	$tparent_dal = new tipoparentescoDAL();
?>
<form id='frmParentescoReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar parentesco</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtParentPers1ID'>Persona:</label></td>
		<td><select id='txtParentPers1ID' name='txtParentPers1ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo(); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtParentPers2ID'>Persona:</label></td>
		<td><select id='txtParentPers2ID' name='txtParentPers2ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $pers_list = $pers_dal->listarcbo(); ?>
			<?php foreach($pers_list as $row) { ?>
				<option value='<?php echo $row['pers_id']; ?>'>
					<?php echo $row['pers_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtParentTparentID'>Tipo de parentesco:</label></td>
		<td><select id='txtParentTparentID' name='txtParentTparentID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tparent_list = $tparent_dal->listarcbo(); ?>
			<?php foreach($tparent_list as $row) { ?>
				<option value='<?php echo $row['tparent_id']; ?>'>
					<?php echo $row['tparent_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtParentEsApoderado'>Es apoderado:</label></td>
		<td><input type='text' id='txtParentEsApoderado' name='txtParentEsApoderado'  placeholder='Ingrese es apoderado'/></td>
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
var parent_reg = '#frmParentescoReg';
$(document).ready(function(e) {
	$(parent_reg).find('#txtParentPers1ID').focus();
	$(parent_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (parent_validar()){
			var parent_pers1_id = $(parent_reg).find('#txtParentPers1ID').val();
			var parent_pers2_id = $(parent_reg).find('#txtParentPers2ID').val();
			var parent_tparent_id = $(parent_reg).find('#txtParentTparentID').val();
			var parent_es_apoderado = $(parent_reg).find('#txtParentEsApoderado').val();

			$.post('vistas/parentesco/proceso/parentesco_insert.php',{
				parent_pers1_id : parent_pers1_id,
				parent_pers2_id : parent_pers2_id,
				parent_tparent_id : parent_tparent_id,
				parent_es_apoderado : parent_es_apoderado
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
	$(parent_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function parent_validar() {
	var parent_pers1_id = $(parent_reg).find('#txtParentPers1ID').val();
	var parent_pers2_id = $(parent_reg).find('#txtParentPers2ID').val();
	var parent_tparent_id = $(parent_reg).find('#txtParentTparentID').val();
	var parent_es_apoderado = $(parent_reg).find('#txtParentEsApoderado').val();

	if (!(isInteger(parent_pers1_id) && parent_pers1_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtParentPers1ID');
		return false;
	}
	if (!(isInteger(parent_pers2_id) && parent_pers2_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtParentPers2ID');
		return false;
	}
	if (!(isInteger(parent_tparent_id) && parent_tparent_id > 0)) {
		showMessageWarning('Seleccione <b>tipo de parentesco</b>', 'txtParentTparentID');
		return false;
	}
	if (!isTinyint(parent_es_apoderado)) {
		showMessageWarning('Ingrese un valor de <b>es apoderado</b> válido', 'txtParentEsApoderado');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>