<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/diagnostico.php';
	include_once '../../../datos/diagnosticoDAL.php';

	if (isset($_POST['diag_id'])) {

		$diag_dal = new diagnosticoDAL();
		$diag = new diagnostico();

		$diag_id = $_POST['diag_id'];
		$diag_row = $diag_dal->getRow($diag_id);

		$diag->diag_id	 = $diag_id;
		$diag->nombre	 = getField('diag_nombre', $diag_row);
		$diag->tratamiento_sug	 = getField('diag_tratamiento_sug', $diag_row);
		$diag->dieta_sug	 = getField('diag_dieta_sug', $diag_row);
		$diag->estado	 = getField('diag_estado', $diag_row);

		$diag_rs = $diag_dal->actualizar($diag);
		echo ($diag_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>