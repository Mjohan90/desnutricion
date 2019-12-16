<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/personaDAL.php';

	if (isset($_POST['pers_id'])){
		$pers_dal = new personaDAL();

		$pers_id = $_POST['pers_id'];
		$pers_rs = $pers_dal->borrar($pers_id);

		echo ($pers_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
