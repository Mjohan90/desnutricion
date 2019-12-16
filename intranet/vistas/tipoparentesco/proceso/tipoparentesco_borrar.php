<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/tipoparentescoDAL.php';

	if (isset($_POST['tparent_id'])){
		$tparent_dal = new tipoparentescoDAL();

		$tparent_id = $_POST['tparent_id'];
		$tparent_rs = $tparent_dal->borrar($tparent_id);

		echo ($tparent_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
