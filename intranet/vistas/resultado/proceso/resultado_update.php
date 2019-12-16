<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/resultado.php';
	include_once '../../../datos/resultadoDAL.php';

	if (isset($_POST['result_id'])) {

		$result_dal = new resultadoDAL();
		$result = new resultado();

		$result_id = $_POST['result_id'];
		$result_row = $result_dal->getRow($result_id);

		$result->result_id	 = $result_id;
		$result->atenc_id	 = getField('result_atenc_id', $result_row);
		$result->diag_id	 = getField('result_diag_id', $result_row);

		$result_rs = $result_dal->actualizar($result);
		echo ($result_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>