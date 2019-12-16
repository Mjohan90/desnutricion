<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
?>
<form name='frmlogin' method='post' accept-charset="utf-8">
    <div class='loginform'>
        <div>
            <div class='txt_center'>
                <h1>Recuperar mi contraseña</h1>
            </div>
            <div style='margin: auto;'>
                <table style='margin: auto;'>
                    <tr>
                        <td><label for='txtUsuNombre'>Usuario:</label></td>
                        <td><input type='text' name='txtUsuNombre' id='txtUsuNombre'
                                   maxlength='20' placeholder='Ingrese usuario' value=''/>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='txtPersCorreo'>Correo:</label></td>
                        <td><input type='text' id='txtPersCorreo' name='txtPersCorreo' maxlength='50'
                                   placeholder='Ingrese correo'/></td>
                    </tr>
                    <tr>
                        <td colspan='2' class='txt_right'>
                            <label id='lblMensaje'></label>
                        </td>
                    </tr>
                </table>
                <div style='text-align: center;'>
                    <a  id='btnRecuperar' class='login_button'>Enviar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function (e) {
        $('#btnRecuperar').click(function (e) {
            var nombre = $('#txtUsuNombre').val();
            var correo = $('#txtPersCorreo').val();
            var valido = 1;

            if (nombre == '') {
                $('#lblMensaje').html('Ingrese nombre de usuario');
                valido = 0;
            }

            if (!isEmail(correo)) {
                $('#lblMensaje').html('Ingrese correo válido');
                valido = 0;
            }

            if (valido == 1) {

                $('#lblMensaje').html('Enviando mensaje, espere unos segundos...');

                $.post('vistas/usuario/proceso/recupera_password.php',
                    {
                        usu_nombre: nombre,
                        pers_correo: correo
                    },
                    function (data) {
                        $('#lblMensaje').html(data);
                    }
                );
            }
        });
    });
</script>