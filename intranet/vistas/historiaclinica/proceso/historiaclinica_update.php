<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/historiaclinica.php';
	include_once '../../../datos/historiaclinicaDAL.php';

	if (isset($_POST['hc_id'])) {

		$hc_dal = new historiaclinicaDAL();
		$hc = new historiaclinica();

		$hc_id = $_POST['hc_id'];
		$hc_row = $hc_dal->getRow($hc_id);

		$hc->hc_id	 = $hc_id;
		$hc->pac_id	 = getField('hc_pac_id', $hc_row);
		$hc->fecha_suceso	 = getField('hc_fecha_suceso', $hc_row);
		$hc->comentario	 = getField('hc_comentario', $hc_row);
		$hc->atenc_id_ref	 = getField('hc_atenc_id_ref', $hc_row);
		$hc->estado	 = getField('hc_estado', $hc_row);

		$hc_rs = $hc_dal->actualizar($hc);
		echo ($hc_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>