<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('pers_reg', 'vistas/persona/persona.php');
?>
<?php
	include_once '../../datos/tipodocidentDAL.php';
	$tdi_dal = new tipodocidentDAL();
?>
<form id='frmPersonaReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar persona</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtPersNombre'>Nombre:</label></td>
		<td><input type='text' id='txtPersNombre' name='txtPersNombre' maxlength='30' placeholder='Ingrese nombre'/></td>
	</tr>
	<tr><td><label for='txtPersSnombre'>Snombre:</label></td>
		<td><input type='text' id='txtPersSnombre' name='txtPersSnombre' maxlength='30' placeholder='Ingrese snombre'/></td>
	</tr>
	<tr><td><label for='txtPersApPaterno'>Ap paterno:</label></td>
		<td><input type='text' id='txtPersApPaterno' name='txtPersApPaterno' maxlength='30' placeholder='Ingrese ap paterno'/></td>
	</tr>
	<tr><td><label for='txtPersApMaterno'>Ap materno:</label></td>
		<td><input type='text' id='txtPersApMaterno' name='txtPersApMaterno' maxlength='30' placeholder='Ingrese ap materno'/></td>
	</tr>
	<tr><td><label for='txtPersTdiID'>Tipo documento de identidad:</label></td>
		<td><select id='txtPersTdiID' name='txtPersTdiID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $tdi_list = $tdi_dal->listarcbo(); ?>
			<?php foreach($tdi_list as $row) { ?>
				<option value='<?php echo $row['tdi_id']; ?>'>
					<?php echo $row['tdi_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtPersTdiNro'>Tdi nro:</label></td>
		<td><input type='text' id='txtPersTdiNro' name='txtPersTdiNro' maxlength='20' placeholder='Ingrese tdi nro'/></td>
	</tr>
	<tr><td><label for='txtPersSexo'>Sexo:</label></td>
		<td><input type='text' id='txtPersSexo' name='txtPersSexo' maxlength='1' placeholder='Ingrese sexo'/></td>
	</tr>
	<tr><td><label for='txtPersFechaNac'>Fecha nac:</label></td>
		<td><input type='text' id='txtPersFechaNac' name='txtPersFechaNac'  placeholder='Ingrese fecha nac'/></td>
	</tr>
	<tr><td><label for='txtPersEmail'>Email:</label></td>
		<td><input type='text' id='txtPersEmail' name='txtPersEmail' maxlength='20' placeholder='Ingrese email'/></td>
	</tr>
	<tr><td><label for='txtPersCelular'>Celular:</label></td>
		<td><input type='text' id='txtPersCelular' name='txtPersCelular' maxlength='20' placeholder='Ingrese celular'/></td>
	</tr>
	<tr><td><label for='txtPersTelefono'>Telefono:</label></td>
		<td><input type='text' id='txtPersTelefono' name='txtPersTelefono' maxlength='20' placeholder='Ingrese telefono'/></td>
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
var pers_reg = '#frmPersonaReg';
$(document).ready(function(e) {
	$(pers_reg).find('#txtPersNombre').focus();
	$(pers_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (pers_validar()){
			var pers_nombre = $(pers_reg).find('#txtPersNombre').val();
			var pers_snombre = $(pers_reg).find('#txtPersSnombre').val();
			var pers_ap_paterno = $(pers_reg).find('#txtPersApPaterno').val();
			var pers_ap_materno = $(pers_reg).find('#txtPersApMaterno').val();
			var pers_tdi_id = $(pers_reg).find('#txtPersTdiID').val();
			var pers_tdi_nro = $(pers_reg).find('#txtPersTdiNro').val();
			var pers_sexo = $(pers_reg).find('#txtPersSexo').val();
			var pers_fecha_nac = getDateYMD($(pers_reg).find('#txtPersFechaNac').val());
			var pers_email = $(pers_reg).find('#txtPersEmail').val();
			var pers_celular = $(pers_reg).find('#txtPersCelular').val();
			var pers_telefono = $(pers_reg).find('#txtPersTelefono').val();

			$.post('vistas/persona/proceso/persona_insert.php',{
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
				pers_telefono : pers_telefono
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
	$(pers_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function pers_validar() {
	var pers_nombre = $(pers_reg).find('#txtPersNombre').val();
	var pers_snombre = $(pers_reg).find('#txtPersSnombre').val();
	var pers_ap_paterno = $(pers_reg).find('#txtPersApPaterno').val();
	var pers_ap_materno = $(pers_reg).find('#txtPersApMaterno').val();
	var pers_tdi_id = $(pers_reg).find('#txtPersTdiID').val();
	var pers_tdi_nro = $(pers_reg).find('#txtPersTdiNro').val();
	var pers_sexo = $(pers_reg).find('#txtPersSexo').val();
	var pers_fecha_nac = $(pers_reg).find('#txtPersFechaNac').val();
	var pers_email = $(pers_reg).find('#txtPersEmail').val();
	var pers_celular = $(pers_reg).find('#txtPersCelular').val();
	var pers_telefono = $(pers_reg).find('#txtPersTelefono').val();

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