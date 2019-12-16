<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/especialidad.php';
	include_once '../../../datos/especialidadDAL.php';

	if (isset($_POST['espec_id'])) {

		$espec_dal = new especialidadDAL();
		$espec = new especialidad();

		$espec_id = $_POST['espec_id'];
		$espec_row = $espec_dal->getRow($espec_id);

		$espec->espec_id	 = $espec_id;
		$espec->nombre	 = getField('espec_nombre', $espec_row);
		$espec->estado	 = getField('espec_estado', $espec_row);

		$espec_rs = $espec_dal->actualizar($espec);
		echo ($espec_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>