<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/reglas.php';
	include_once '../../../datos/reglasDAL.php';

	if (isset($_POST['regla_id'])) {

		$regla_dal = new reglasDAL();
		$regla = new reglas();

		$regla_id = $_POST['regla_id'];
		$regla_row = $regla_dal->getRow($regla_id);

		$regla->regla_id	 = $regla_id;
		$regla->indic1_id	 = getField('regla_indic1_id', $regla_row);
		$regla->indic2_id	 = getField('regla_indic2_id', $regla_row);
		$regla->formula	 = getField('regla_formula', $regla_row);
		$regla->diag_id	 = getField('regla_diag_id', $regla_row);

		$regla_rs = $regla_dal->actualizar($regla);
		echo ($regla_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>