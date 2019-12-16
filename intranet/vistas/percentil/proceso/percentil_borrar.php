<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../datos/percentilDAL.php';

	if (isset($_POST['percent_id'])){
		$percent_dal = new percentilDAL();

		$percent_id = $_POST['percent_id'];
		$percent_rs = $percent_dal->borrar($percent_id);

		echo ($percent_rs == 1) ? 1 : 'No se ha podido borrar';

	} else {
		echo 'Ingrese datos validos';
	}
