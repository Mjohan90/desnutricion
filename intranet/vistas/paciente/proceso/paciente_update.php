<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/paciente.php';
	include_once '../../../datos/pacienteDAL.php';

	if (isset($_POST['pac_id'])) {

		$pac_dal = new pacienteDAL();
		$pac = new paciente();

		$pac_id = $_POST['pac_id'];
		$pac_row = $pac_dal->getRow($pac_id);

		$pac->pac_id	 = $pac_id;
		$pac->pers_id	 = getField('pac_pers_id', $pac_row);
		$pac->estado	 = getField('pac_estado', $pac_row);

		$pac_rs = $pac_dal->actualizar($pac);
		echo ($pac_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>