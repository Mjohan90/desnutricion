<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/triaje.php';
	include_once '../../../datos/triajeDAL.php';

	if (isset($_POST['triaje_atenc_id'], $_POST['triaje_var_id'], $_POST['triaje_um_id'], $_POST['triaje_valor'])){

		$triaje_dal = new triajeDAL();
		$triaje = new triaje();

		$triaje->atenc_id = $_POST['triaje_atenc_id'];
		$triaje->var_id = $_POST['triaje_var_id'];
		$triaje->um_id = $_POST['triaje_um_id'];
		$triaje->valor = $_POST['triaje_valor'];

		$triaje_rs = $triaje_dal->registrar($triaje);
		echo ($triaje_rs > 0) ? $triaje_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>