<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/enfermedadDAL.php';

	if (isset($_POST['enferm_id'])){
		$enferm_dal = new enfermedadDAL();

		$enferm_id = $_POST['enferm_id'];
		$enferm_rs = $enferm_dal->borrar($enferm_id);

		echo ($enferm_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
