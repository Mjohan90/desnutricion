<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/empleado.php';
	include_once '../../../datos/empleadoDAL.php';

	if (isset($_POST['empl_id'])) {

		$empl_dal = new empleadoDAL();
		$empl = new empleado();

		$empl_id = $_POST['empl_id'];
		$empl_row = $empl_dal->getRow($empl_id);

		$empl->empl_id	 = $empl_id;
		$empl->pers_id	 = getField('empl_pers_id', $empl_row);
		$empl->carg_id	 = getField('empl_carg_id', $empl_row);
		$empl->estado	 = getField('empl_estado', $empl_row);

		$empl_rs = $empl_dal->actualizar($empl);
		echo ($empl_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>