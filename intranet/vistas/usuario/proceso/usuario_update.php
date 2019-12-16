<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/usuario.php';
	include_once '../../../datos/usuarioDAL.php';
	
	if (isset($_POST['usu_id'])) {
		
		$usu_dal = new usuarioDAL();
		$usu     = new usuario();
		
		$usu_id  = $_POST['usu_id'];
		$usu_row = $usu_dal->getRow($usu_id);
		
		$usu->usu_id     = $usu_id;
		$usu->nombre     = getField('usu_nombre', $usu_row);
		$usu->contrasena = getField('usu_contrasena', $usu_row);
		$usu->empl_id    = getField('usu_empl_id', $usu_row);
		$usu->rol_id     = getField('usu_rol_id', $usu_row);
		$usu->estado     = getField('usu_estado', $usu_row);
		
		$usu_rs = $usu_dal->actualizar($usu);
		echo ($usu_rs == 1) ? 1 : 'No se ha podido actualizar';
		
	} else {
		echo 'Ingrese datos validos';
	}
	function getField($campo, $row) {
		return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
	}

?>
