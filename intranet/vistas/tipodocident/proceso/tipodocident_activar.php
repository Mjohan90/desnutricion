<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/tipodocidentDAL.php';

	if (isset($_POST['tdi_id'])){
		$tdi_dal = new tipodocidentDAL();

		$tdi_id = $_POST['tdi_id'];
		$tdi_rs = $tdi_dal->activar($tdi_id);

		echo ($tdi_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
