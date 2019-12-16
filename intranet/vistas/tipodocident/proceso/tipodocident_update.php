<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/tipodocident.php';
	include_once '../../../datos/tipodocidentDAL.php';

	if (isset($_POST['tdi_id'])) {

		$tdi_dal = new tipodocidentDAL();
		$tdi = new tipodocident();

		$tdi_id = $_POST['tdi_id'];
		$tdi_row = $tdi_dal->getRow($tdi_id);

		$tdi->tdi_id	 = $tdi_id;
		$tdi->nombre	 = getField('tdi_nombre', $tdi_row);
		$tdi->abrev	 = getField('tdi_abrev', $tdi_row);
		$tdi->estado	 = getField('tdi_estado', $tdi_row);

		$tdi_rs = $tdi_dal->actualizar($tdi);
		echo ($tdi_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>