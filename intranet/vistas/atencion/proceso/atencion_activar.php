<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/atencionDAL.php';

	if (isset($_POST['atenc_id'])){
		$atenc_dal = new atencionDAL();

		$atenc_id = $_POST['atenc_id'];
		$atenc_rs = $atenc_dal->activar($atenc_id);

		echo ($atenc_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
