<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/direccion.php';
	include_once '../../../datos/direccionDAL.php';

	if (isset($_POST['direc_pers_id'], $_POST['direc_ubig_id'], $_POST['direc_descripcion'])){

		$direc_dal = new direccionDAL();
		$direc = new direccion();

		$direc->pers_id = $_POST['direc_pers_id'];
		$direc->ubig_id = $_POST['direc_ubig_id'];
		$direc->descripcion = $_POST['direc_descripcion'];

		$direc_rs = $direc_dal->registrar($direc);
		echo ($direc_rs > 0) ? $direc_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>