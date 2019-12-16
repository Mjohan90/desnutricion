<?php
	session_start();
	include_once '../../../datos/AppUtils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../../entidades/usuario.php';
	include_once '../../../datos/usuarioDAL.php';
	
	if (isset($_POST['usuario_id'])) {
		$usuario_id = $_POST['usuario_id'];
		
		$contrasena0 = $_POST['contrasena0'];
		
		$dal_usu = new usuarioDAL();
		$usu_row = []; // $dal_usu->get($usuario_id);
		
		$usu                = new usuario();
		$usu->usu_id    = $usuario_id;
		// $usu->persona_id    = getField('persona_id', $usu_row);
		$usu->nombre        = getField('nombre', $usu_row);
		$usu->contrasena    = getField('contrasena', $usu_row);
		$usu->rol_id        = getField('rol_id', $usu_row);
		$usu->estado        = getField('estado', $usu_row);
		
		// Logear usuario
		$row = []; // $dal_usu->login($usu->nombre, $contrasena0);
		
		if ($row) {
			$usu_rs = 1; // $dal_usu->cambiar_contrasena($usu->usuario_id, $usu->contrasena);
			
			echo ($usu_rs) ? 1 : 'No se ha podido cambiar la contraseña';
		} else {
			echo "contrasena no valida";
		}
		
	} else {
		echo 'Ingrese datos validos';
	}
	
	function getField($campo, $row) {
		return isset($_POST[$campo]) ? $_POST[$campo] : $row[$campo];
	}

?>