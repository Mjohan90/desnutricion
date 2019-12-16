<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/percentil.php';
	include_once '../../../datos/percentilDAL.php';

	if (isset($_POST['percent_id'])) {

		$percent_dal = new percentilDAL();
		$percent = new percentil();

		$percent_id = $_POST['percent_id'];
		$percent_row = $percent_dal->getRow($percent_id);

		$percent->percent_id	 = $percent_id;
		$percent->sexo	 = getField('percent_sexo', $percent_row);
		$percent->indic_id	 = getField('percent_indic_id', $percent_row);
		$percent->var1_valor	 = getField('percent_var1_valor', $percent_row);
		$percent->var2_valor	 = getField('percent_var2_valor', $percent_row);
		$percent->percentil	 = getField('percent_percentil', $percent_row);
		$percent->estado	 = getField('percent_estado', $percent_row);

		$percent_rs = $percent_dal->actualizar($percent);
		echo ($percent_rs == 1) ? 1 : 'No se ha podido actualizar';

	} else {
		echo 'Ingrese datos validos';
	}
function getField($campo, $row) {
	return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
}
?>