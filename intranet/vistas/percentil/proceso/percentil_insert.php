<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
	$usu_id = $_SESSION['auth.usu_id'];
?>
<?php
	include_once '../../../entidades/percentil.php';
	include_once '../../../datos/percentilDAL.php';

	if (isset($_POST['percent_sexo'], $_POST['percent_indic_id'], $_POST['percent_var1_valor'], $_POST['percent_var2_valor'], $_POST['percent_percentil'])){

		$percent_dal = new percentilDAL();
		$percent = new percentil();

		$percent->sexo = $_POST['percent_sexo'];
		$percent->indic_id = $_POST['percent_indic_id'];
		$percent->var1_valor = $_POST['percent_var1_valor'];
		$percent->var2_valor = $_POST['percent_var2_valor'];
		$percent->percentil = $_POST['percent_percentil'];

		$percent_rs = $percent_dal->registrar($percent);
		echo ($percent_rs > 0) ? $percent_rs : 'No se ha podido registrar';

	} else {
		echo 'Ingrese datos validos';
	}
?>