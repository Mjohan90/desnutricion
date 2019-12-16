<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/paciente.php';
	include_once '../../../datos/pacienteDAL.php';

	if (isset($_POST['pac_pers_id'])){

		$pac_dal = new pacienteDAL();
		$pac = new paciente();

		$pac->pers_id = $_POST['pac_pers_id'];

		$pac_rs = $pac_dal->registrar($pac);
		echo ($pac_rs > 0) ? $pac_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>