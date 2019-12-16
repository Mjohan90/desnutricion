<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/umDAL.php';

	if (isset($_POST['um_id'])){
		$um_dal = new umDAL();

		$um_id = $_POST['um_id'];
		$um_rs = $um_dal->activar($um_id);

		echo ($um_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
