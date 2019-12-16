<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('direc_reg', 'vistas/direccion/direccion.php');
?>
<?php
	include_once '../../datos/personaDAL.php';
	$pers_dal = new personaDAL();
?>
<?php
	include_once '../../datos/ubigeoDAL.php';
	$ubig_dal = new ubigeoDAL();
?>
<form id='frmDireccionReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar dirección</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtDirecPersID'>Persona:</label></td>
		<td><select id='txtDirecPersID' name='txtDirecPersID'> <!-- maxlength='10' -->
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
	<tr><td><label for='txtDirecUbigID'>Ubicación geográfica:</label></td>
		<td><select id='txtDirecUbigID' name='txtDirecUbigID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $ubig_list = $ubig_dal->listarcbo(); ?>
			<?php foreach($ubig_list as $row) { ?>
				<option value='<?php echo $row['ubig_id']; ?>'>
					<?php echo $row['ubig_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtDirecDescripcion'>Descripcion:</label></td>
		<td><input type='text' id='txtDirecDescripcion' name='txtDirecDescripcion' maxlength='200' placeholder='Ingrese descripcion'/></td>
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
var direc_reg = '#frmDireccionReg';
$(document).ready(function(e) {
	$(direc_reg).find('#txtDirecPersID').focus();
	$(direc_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (direc_validar()){
			var direc_pers_id = $(direc_reg).find('#txtDirecPersID').val();
			var direc_ubig_id = $(direc_reg).find('#txtDirecUbigID').val();
			var direc_descripcion = $(direc_reg).find('#txtDirecDescripcion').val();

			$.post('vistas/direccion/proceso/direccion_insert.php',{
				direc_pers_id : direc_pers_id,
				direc_ubig_id : direc_ubig_id,
				direc_descripcion : direc_descripcion
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
	$(direc_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function direc_validar() {
	var direc_pers_id = $(direc_reg).find('#txtDirecPersID').val();
	var direc_ubig_id = $(direc_reg).find('#txtDirecUbigID').val();
	var direc_descripcion = $(direc_reg).find('#txtDirecDescripcion').val();

	if (!(isInteger(direc_pers_id) && direc_pers_id > 0)) {
		showMessageWarning('Seleccione <b>persona</b>', 'txtDirecPersID');
		return false;
	}
	if (!(isInteger(direc_ubig_id) && direc_ubig_id > 0)) {
		showMessageWarning('Seleccione <b>ubicación geográfica</b>', 'txtDirecUbigID');
		return false;
	}
	if (direc_descripcion == '') {
		showMessageWarning('Ingrese una <b>descripcion</b> válida de dirección', 'txtDirecDescripcion');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>