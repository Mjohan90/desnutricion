<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/direccion.php';
	include_once '../../../datos/direccionDAL.php';

	if (isset($_POST['direc_id'])) {

		$direc_dal = new direccionDAL();
		$direc = new direccion();

		$direc_id = $_POST['direc_id'];
		$direc_row = $direc_dal->getRow($direc_id);

		$direc->direc_id	 = $direc_id;
		$direc->pers_id	 = getField('direc_pers_id', $direc_row);
		$direc->ubig_id	 = getField('direc_ubig_id', $direc_row);
		$direc->descripcion	 = getField('direc_descripcion', $direc_row);
		$direc->estado	 = getField('direc_estado', $direc_row);

		$direc_rs = $direc_dal->actualizar($direc);
		echo ($direc_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>