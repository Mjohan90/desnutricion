<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/parentesco.php';
	include_once '../../../datos/parentescoDAL.php';

	if (isset($_POST['parent_id'])) {

		$parent_dal = new parentescoDAL();
		$parent = new parentesco();

		$parent_id = $_POST['parent_id'];
		$parent_row = $parent_dal->getRow($parent_id);

		$parent->parent_id	 = $parent_id;
		$parent->pers1_id	 = getField('parent_pers1_id', $parent_row);
		$parent->pers2_id	 = getField('parent_pers2_id', $parent_row);
		$parent->tparent_id	 = getField('parent_tparent_id', $parent_row);
		$parent->es_apoderado	 = getField('parent_es_apoderado', $parent_row);
		$parent->estado	 = getField('parent_estado', $parent_row);

		$parent_rs = $parent_dal->actualizar($parent);
		echo ($parent_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>