<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/cargo.php';
	include_once '../../../datos/cargoDAL.php';

	if (isset($_POST['carg_id'])) {

		$carg_dal = new cargoDAL();
		$carg = new cargo();

		$carg_id = $_POST['carg_id'];
		$carg_row = $carg_dal->getRow($carg_id);

		$carg->carg_id	 = $carg_id;
		$carg->nombre	 = getField('carg_nombre', $carg_row);
		$carg->estado	 = getField('carg_estado', $carg_row);

		$carg_rs = $carg_dal->actualizar($carg);
		echo ($carg_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>