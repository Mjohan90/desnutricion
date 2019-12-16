<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/tipodocident.php';
	include_once '../../../datos/tipodocidentDAL.php';

	if (isset($_POST['tdi_nombre'], $_POST['tdi_abrev'])){

		$tdi_dal = new tipodocidentDAL();
		$tdi = new tipodocident();

		$tdi->nombre = $_POST['tdi_nombre'];
		$tdi->abrev = $_POST['tdi_abrev'];

		$tdi_rs = $tdi_dal->registrar($tdi);
		echo ($tdi_rs > 0) ? $tdi_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>