<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/usuarioDAL.php';

	if (isset($_POST['usu_id'])){
		$usu_dal = new usuarioDAL();

		$usu_id = $_POST['usu_id'];
		$usu_rs = $usu_dal->activar($usu_id);

		echo ($usu_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
