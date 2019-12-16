<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
?>
<form name='frmlogin' method='post' accept-charset="utf-8">
    <br>
    <div class='txt_center rpad20'>
        <h1>Centro Salud Santa</h1>
    </div>
    <div class='loginform'>
        <table style='margin: auto;'>
            <tr>
                <td><label for='txtNombre' class='bold'>Usuario:</label></td>
                <td><input type='text' name='txtNombre' id='txtNombre'
                           maxlength='20' placeholder='Ingrese usuario' value='admin'/>
                </td>
            </tr>
            <tr>
                <td><label for='txtContrasena' class='bold'>Contraseña:</label></td>
                <td><input type='password' name='txtContrasena' id='txtContrasena'
                           maxlength='16' placeholder='Ingrese contraseña' value='123'/>
                </td>
            </tr>
            <tr>
                <td colspan='2' class='txt_right'>
                    <label id='lblMensaje' style='display: none;'>Usuario no válido</label>
                </td>
            </tr>
        </table>
        <div style='text-align: center; margin-top: 15px;'>
            <a id='btnEntrar' class='login_button'>Entrar al sistema</a>
        </div>
    </div>
</form>
<!--<div class='txt_center' style='padding-top: 20px;'>-->
<!--    <a href='#' id='btnResetear' class='mylink'>Olvide mi contraseña</a>-->
<!--</div>-->

<script>
$(document).ready(function (e) {

    $('#txtNombre').focus();

    $('#txtNombre').keyup(function (e) {
        if (e.which != 13) {
            ocultaErrorMsg();
        }
    });
    $('#txtContrasena').keyup(function (e) {
        if (e.which != 13) {
            ocultaErrorMsg();
        }
    });
    $('#txtNombre').keypress(function (e) {
        if (e.which == 13) {
            usu_login();
        }
    });
    $('#txtContrasena').keypress(function (e) {
        if (e.which == 13) {
            usu_login();
        }
    });
    $('#btnEntrar').click(function (e) {
        usu_login();
    });

    function usu_login() {
        var nombre     = $('#txtNombre').val();
        var contrasena = $('#txtContrasena').val();

        $.post('vistas/usuario/proceso/login.php',
            {
                nombre    : nombre,
                contrasena: contrasena
            },
            function (data) {
                if (data > 0) {
                    window.location = 'index.php';
                } else {
                    $('#lblMensaje').html(data);
                    $('#lblMensaje').show();
                }
            }
        );
    }

    function ocultaErrorMsg() {
        $('#lblMensaje').hide();
    }

    $('#btnResetear').off('click').click(function (e) {
        $('#contenido').load('vistas/usuario/resetContrasena.php');
    });
});
</script>