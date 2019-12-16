<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/especialidadDAL.php';

	if (isset($_POST['espec_id'])){
		$espec_dal = new especialidadDAL();

		$espec_id = $_POST['espec_id'];
		$espec_rs = $espec_dal->borrar($espec_id);

		echo ($espec_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
