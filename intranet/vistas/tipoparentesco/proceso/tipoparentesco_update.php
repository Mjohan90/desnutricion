<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/tipoparentesco.php';
	include_once '../../../datos/tipoparentescoDAL.php';

	if (isset($_POST['tparent_id'])) {

		$tparent_dal = new tipoparentescoDAL();
		$tparent = new tipoparentesco();

		$tparent_id = $_POST['tparent_id'];
		$tparent_row = $tparent_dal->getRow($tparent_id);

		$tparent->tparent_id	 = $tparent_id;
		$tparent->nombre	 = getField('tparent_nombre', $tparent_row);
		$tparent->estado	 = getField('tparent_estado', $tparent_row);

		$tparent_rs = $tparent_dal->actualizar($tparent);
		echo ($tparent_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>