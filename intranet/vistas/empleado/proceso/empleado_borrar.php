<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/empleadoDAL.php';

	if (isset($_POST['empl_id'])){
		$empl_dal = new empleadoDAL();

		$empl_id = $_POST['empl_id'];
		$empl_rs = $empl_dal->borrar($empl_id);

		echo ($empl_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
