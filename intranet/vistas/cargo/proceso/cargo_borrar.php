<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/cargoDAL.php';

	if (isset($_POST['carg_id'])){
		$carg_dal = new cargoDAL();

		$carg_id = $_POST['carg_id'];
		$carg_rs = $carg_dal->borrar($carg_id);

		echo ($carg_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
