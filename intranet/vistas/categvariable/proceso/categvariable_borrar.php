<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/categvariableDAL.php';

	if (isset($_POST['catvar_id'])){
		$catvar_dal = new categvariableDAL();

		$catvar_id = $_POST['catvar_id'];
		$catvar_rs = $catvar_dal->borrar($catvar_id);

		echo ($catvar_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
