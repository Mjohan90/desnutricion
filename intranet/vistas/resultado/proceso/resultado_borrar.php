<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/resultadoDAL.php';

	if (isset($_POST['result_id'])){
		$result_dal = new resultadoDAL();

		$result_id = $_POST['result_id'];
		$result_rs = $result_dal->borrar($result_id);

		echo ($result_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
