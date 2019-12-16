<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/ubigeo.php';
	include_once '../../../datos/ubigeoDAL.php';

	if (isset($_POST['ubig_id'])) {

		$ubig_dal = new ubigeoDAL();
		$ubig = new ubigeo();

		$ubig_id = $_POST['ubig_id'];
		$ubig_row = $ubig_dal->getRow($ubig_id);

		$ubig->ubig_id	 = $ubig_id;
		$ubig->cod	 = getField('ubig_cod', $ubig_row);
		$ubig->dpto_cod	 = getField('ubig_dpto_cod', $ubig_row);
		$ubig->prov_cod	 = getField('ubig_prov_cod', $ubig_row);
		$ubig->dist_cod	 = getField('ubig_dist_cod', $ubig_row);
		$ubig->nombre	 = getField('ubig_nombre', $ubig_row);
		$ubig->estado	 = getField('ubig_estado', $ubig_row);

		$ubig_rs = $ubig_dal->actualizar($ubig);
		echo ($ubig_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>