<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/rolDAL.php';

	if (isset($_POST['rol_id'])){
		$rol_dal = new rolDAL();

		$rol_id = $_POST['rol_id'];
		$rol_rs = $rol_dal->activar($rol_id);

		echo ($rol_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
