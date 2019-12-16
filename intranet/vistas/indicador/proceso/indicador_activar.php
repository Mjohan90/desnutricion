<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/indicadorDAL.php';

	if (isset($_POST['indic_id'])){
		$indic_dal = new indicadorDAL();

		$indic_id = $_POST['indic_id'];
		$indic_rs = $indic_dal->activar($indic_id);

		echo ($indic_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
