<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/reglasDAL.php';

	if (isset($_POST['regla_id'])){
		$regla_dal = new reglasDAL();

		$regla_id = $_POST['regla_id'];
		$regla_rs = $regla_dal->activar($regla_id);

		echo ($regla_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
