<?php
	include_once '../../../../references/phpmailer/PHPMailerAutoload.php';
	include '../../../entidades/usuario.php';
	include '../../../datos/usuarioDAL.php';
	include '../../../datos/AppUtils.php';
	
	$usu_nombre  = $_POST['usu_nombre'];
	$pers_correo = $_POST['pers_correo'];
	$usu_dal     = new usuarioDAL();
	
	$usu_row = []; // $usu_dal->getByNombre($usu_nombre);
	
	if ($pers_correo == $usu_row['pers_correo']) {
		enviarMensajeResetearContrasena($usu_row['usuario_id'], $usu_row['pers_correo']);
	} else {
		echo "Correo no corresponde al usuario";
	}
	
	function enviarMensajeResetearContrasena($usu_id, $pers_correo) {
		
		$nueva_contrasena = generarContrasenaAleatoria();
		
		$usu_dal = new usuarioDAL();
		if ($usu_dal->resetearContrasena($usu_id, $nueva_contrasena)) {
			$titulo    = 'Restablecer contraseña';
			$contenido = "<h1 style='color: #0e7698;'>Restablecer contraseña</h1>
                         <p>Su nueva contraseña es: <b>$nueva_contrasena</b></p>
                         <p><span>Se recomienda cambiar de contraseña, después de volver a iniciar sesión.</span><br/>
                            <span>Fecha: ".Today()."</span></p>";
			SendEmail($pers_correo, $titulo, $contenido);
		}
	}
	
	function generarContrasenaAleatoria() {
		$new_password = '';
		for ($i = 0; $i < 8; $i++) {
			$digit        = rand(0, 9);
			$new_password .= $digit;
		}
		return $new_password;
	}
	
	function SendEmail($email, $titulo, $contenido) {
		date_default_timezone_set('Etc/UTC');
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';
		
		$mail->Debugoutput = 'html';
		$mail->Host        = 'smtp.live.com';
		$mail->Port        = 587;
		$mail->SMTPSecure  = 'tls';
		$mail->SMTPAuth    = true;
		
		$mail->Username = "test_raven_usp@outlook.com";
		$mail->Password = "raventest123";
		$mail->setFrom($mail->Username);
		$mail->addReplyTo($mail->Username);
		$mail->addAddress($email);
		
		$mail->Subject = $titulo;
		$mail->msgHTML($contenido);
		
		if (!$mail->send()) {
			echo "Mailer error: ".$mail->ErrorInfo;
		} else {
			echo "Mensaje enviado";
		}
	}