<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/historiaclinicaDAL.php';

	if (isset($_POST['hc_id'])){
		$hc_dal = new historiaclinicaDAL();

		$hc_id = $_POST['hc_id'];
		$hc_rs = $hc_dal->borrar($hc_id);

		echo ($hc_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
