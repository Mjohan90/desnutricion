<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/direccionDAL.php';

	if (isset($_POST['direc_id'])){
		$direc_dal = new direccionDAL();

		$direc_id = $_POST['direc_id'];
		$direc_rs = $direc_dal->activar($direc_id);

		echo ($direc_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
