<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/pacienteDAL.php';

	if (isset($_POST['pac_id'])){
		$pac_dal = new pacienteDAL();

		$pac_id = $_POST['pac_id'];
		$pac_rs = $pac_dal->borrar($pac_id);

		echo ($pac_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
