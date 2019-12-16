<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/indicador.php';
	include_once '../../../datos/indicadorDAL.php';

	if (isset($_POST['indic_id'])) {

		$indic_dal = new indicadorDAL();
		$indic = new indicador();

		$indic_id = $_POST['indic_id'];
		$indic_row = $indic_dal->getRow($indic_id);

		$indic->indic_id	 = $indic_id;
		$indic->nombre	 = getField('indic_nombre', $indic_row);
		$indic->var1_id	 = getField('indic_var1_id', $indic_row);
		$indic->var2_id	 = getField('indic_var2_id', $indic_row);
		$indic->estado	 = getField('indic_estado', $indic_row);

		$indic_rs = $indic_dal->actualizar($indic);
		echo ($indic_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>