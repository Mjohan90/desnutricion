<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/um.php';
	include_once '../../../datos/umDAL.php';

	if (isset($_POST['um_id'])) {

		$um_dal = new umDAL();
		$um = new um();

		$um_id = $_POST['um_id'];
		$um_row = $um_dal->getRow($um_id);

		$um->um_id	 = $um_id;
		$um->nombre	 = getField('um_nombre', $um_row);
		$um->abrev	 = getField('um_abrev', $um_row);
		$um->estado	 = getField('um_estado', $um_row);

		$um_rs = $um_dal->actualizar($um);
		echo ($um_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>