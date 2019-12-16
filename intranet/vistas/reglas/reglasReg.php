<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	$parent = ReceiveParent('regla_reg', 'vistas/reglas/reglas.php');
?>
<?php
	include_once '../../datos/diagnosticoDAL.php';
	$diag_dal = new diagnosticoDAL();
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
?>
<?php
	include_once '../../datos/indicadorDAL.php';
	$indic_dal = new indicadorDAL();
?>
<form id='frmReglasReg' method='post'>
<div class='regform'>
<div class='regform_body'>
<div class='form_title'>
	<span class='h2'>Registrar reglas</span>
</div>
<hr class='separator'/>
<table class='form_data'>
	<tr><td><label for='txtReglaIndic1ID'>Indicador:</label></td>
		<td><select id='txtReglaIndic1ID' name='txtReglaIndic1ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $indic_list = $indic_dal->listarcbo(); ?>
			<?php foreach($indic_list as $row) { ?>
				<option value='<?php echo $row['indic_id']; ?>'>
					<?php echo $row['indic_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtReglaIndic2ID'>Indicador:</label></td>
		<td><select id='txtReglaIndic2ID' name='txtReglaIndic2ID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $indic_list = $indic_dal->listarcbo(); ?>
			<?php foreach($indic_list as $row) { ?>
				<option value='<?php echo $row['indic_id']; ?>'>
					<?php echo $row['indic_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
	</tr>
	<tr><td><label for='txtReglaFormula'>Formula:</label></td>
		<td><input type='text' id='txtReglaFormula' name='txtReglaFormula' maxlength='200' placeholder='Ingrese formula'/></td>
	</tr>
	<tr><td><label for='txtReglaDiagID'>Diagnóstico:</label></td>
		<td><select id='txtReglaDiagID' name='txtReglaDiagID'> <!-- maxlength='10' -->
			<option value = '0'>(Seleccione)</option>
			<?php $diag_list = $diag_dal->listarcbo(); ?>
			<?php foreach($diag_list as $row) { ?>
				<option value='<?php echo $row['diag_id']; ?>'>
					<?php echo $row['diag_nombre'];  ?>
				</option>
			<?php } ?>
			</select>
		</td>
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
var regla_reg = '#frmReglasReg';
$(document).ready(function(e) {
	$(regla_reg).find('#txtReglaIndic1ID').focus();
	$(regla_reg).find('#btnRegistrar').off('click').click(function(e) {
		if (regla_validar()){
			var regla_indic1_id = $(regla_reg).find('#txtReglaIndic1ID').val();
			var regla_indic2_id = $(regla_reg).find('#txtReglaIndic2ID').val();
			var regla_formula = $(regla_reg).find('#txtReglaFormula').val();
			var regla_diag_id = $(regla_reg).find('#txtReglaDiagID').val();

			$.post('vistas/reglas/proceso/reglas_insert.php',{
				regla_indic1_id : regla_indic1_id,
				regla_indic2_id : regla_indic2_id,
				regla_formula : regla_formula,
				regla_diag_id : regla_diag_id
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
	$(regla_reg).find('#btnCancelar').click(function(e) {
		volver();
	});
});
function regla_validar() {
	var regla_indic1_id = $(regla_reg).find('#txtReglaIndic1ID').val();
	var regla_indic2_id = $(regla_reg).find('#txtReglaIndic2ID').val();
	var regla_formula = $(regla_reg).find('#txtReglaFormula').val();
	var regla_diag_id = $(regla_reg).find('#txtReglaDiagID').val();

	if (!(isInteger(regla_indic1_id) && regla_indic1_id > 0)) {
		showMessageWarning('Seleccione <b>indicador</b>', 'txtReglaIndic1ID');
		return false;
	}
	if (!(isInteger(regla_indic2_id) && regla_indic2_id > 0)) {
		showMessageWarning('Seleccione <b>indicador</b>', 'txtReglaIndic2ID');
		return false;
	}
	if (regla_formula == '') {
		showMessageWarning('Ingrese una <b>formula</b> válida', 'txtReglaFormula');
		return false;
	}
	if (!(isInteger(regla_diag_id) && regla_diag_id > 0)) {
		showMessageWarning('Seleccione <b>diagnóstico</b>', 'txtReglaDiagID');
		return false;
	}
	return true;
}
function volver() {
	performLoad('<?php echo $parent; ?>');
}
</script>