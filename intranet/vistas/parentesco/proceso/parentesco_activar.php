<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/parentescoDAL.php';

	if (isset($_POST['parent_id'])){
		$parent_dal = new parentescoDAL();

		$parent_id = $_POST['parent_id'];
		$parent_rs = $parent_dal->activar($parent_id);

		echo ($parent_rs == 1) ? 1 : 'No se ha podido activar';

	} else {
		echo 'Ingrese datos validos';
	}
