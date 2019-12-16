<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/triajeDAL.php';

	if (isset($_POST['triaje_id'])){
		$triaje_dal = new triajeDAL();

		$triaje_id = $_POST['triaje_id'];
		$triaje_rs = $triaje_dal->activar($triaje_id);

		echo ($triaje_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
