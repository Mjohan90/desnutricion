<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/empleado.php';
	include_once '../../../datos/empleadoDAL.php';

	if (isset($_POST['empl_pers_id'], $_POST['empl_carg_id'])){

		$empl_dal = new empleadoDAL();
		$empl = new empleado();

		$empl->pers_id = $_POST['empl_pers_id'];
		$empl->carg_id = $_POST['empl_carg_id'];

		$empl_rs = $empl_dal->registrar($empl);
		echo ($empl_rs > 0) ? $empl_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>