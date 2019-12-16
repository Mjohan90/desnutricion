<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/parentesco.php';
	include_once '../../../datos/parentescoDAL.php';

	if (isset($_POST['parent_pers1_id'], $_POST['parent_pers2_id'], $_POST['parent_tparent_id'], $_POST['parent_es_apoderado'])){

		$parent_dal = new parentescoDAL();
		$parent = new parentesco();

		$parent->pers1_id = $_POST['parent_pers1_id'];
		$parent->pers2_id = $_POST['parent_pers2_id'];
		$parent->tparent_id = $_POST['parent_tparent_id'];
		$parent->es_apoderado = $_POST['parent_es_apoderado'];

		$parent_rs = $parent_dal->registrar($parent);
		echo ($parent_rs > 0) ? $parent_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>