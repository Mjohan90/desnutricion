<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/claseenfermedadDAL.php';

	if (isset($_POST['clsenferm_id'])){
		$clsenferm_dal = new claseenfermedadDAL();

		$clsenferm_id = $_POST['clsenferm_id'];
		$clsenferm_rs = $clsenferm_dal->borrar($clsenferm_id);

		echo ($clsenferm_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
