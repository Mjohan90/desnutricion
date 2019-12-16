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
		$diag->atenc_id	 = getField('diag_atenc_id', $diag_row);
		$diag->enferm_id	 = getField('diag_enferm_id', $diag_row);

		$diag_rs = $diag_dal->actualizar($diag);
		echo ($diag_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>