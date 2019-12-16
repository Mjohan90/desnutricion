<?php
	session_start();
	$usuario_id      = 0;
	$rol_id          = 0;
	$rol_nombre      = '';
	$pers_nombres    = '';
	$pers_ap_paterno = '';
	$pers_ap_materno = '';
	
	if (isset ($_SESSION['auth.usu_id'])) {
		$usuario_id      = $_SESSION['auth.usu_id'];
		$rol_id          = $_SESSION['auth.rol_id'];
		$rol_nombre      = $_SESSION['auth.rol_nombre'];
		$pers_nombres    = $_SESSION['auth.pers_nombres'];
		$pers_ap_paterno = $_SESSION['auth.pers_ap_paterno'];
		$pers_ap_materno = $_SESSION['auth.pers_ap_materno'];
	} else {
		header('Location:login.php');
		exit();
	}
	
	define('ROL_ADMIN', 1);
	define('ROL_MEDICO', 2);
	define('ROL_RECEPCION', 3);
	define('ROL_ENFERMERA', 4);
	define('ROL_CAJA', 5);
	define('ROL_PACIENTE', 6);
?>
<!DOCTYPE html>
<html lang=''>
<head>
    <title>Sistema Centro Salud Santa</title>
    <meta charset='utf-8'/>
    <meta name="description" content="Centro Salud Santa">
    <link rel='stylesheet' type='text/css' href='../recursos/css/styles3.css'/>
    <link rel="stylesheet" type="text/css" href='../recursos/css/styles.datepicker.css'/>
    <link rel="stylesheet" type="text/css" href='../recursos/css/hmenu.css'/>
    <link rel="stylesheet" type="text/css" href='../recursos/css/spectrum.css'/>
    <link rel="stylesheet" type="text/css" href='../recursos/css/multiselect.css'/>
    <link rel="stylesheet" type="text/css" href='../recursos/css/rangeslider.css'/>
    <link rel="stylesheet" type="text/css" href='../recursos/css/easy-autocomplete.min.css'/>

    <script type='text/javascript' src='../recursos/js/jquery.min.js'></script>
    <script type='text/javascript' src='../recursos/js/jquery_ui.min.js'></script>
    <script type='text/javascript' src='../recursos/js/jquery.easy-autocomplete.min.js'></script>
    <script type='text/javascript' src='../recursos/js/spectrum.js'></script>
    <script>$.fn.spectrum.load = false;</script>
    <script type='text/javascript' src='../recursos/js/moment.js'></script>
    <script type='text/javascript' src='../recursos/js/chart.min.js'></script>
    <script type='text/javascript' src='../recursos/js/chart.custom.js'></script>
    <script type='text/javascript' src='../recursos/js/dropdowns.js'></script>
    <script type='text/javascript' src='../recursos/js/multiselect.js'></script>
    <script type='text/javascript' src='../recursos/js/rangesliders.js'></script>
    <script type='text/javascript' src='../intranet/vistas/utils.js'></script>
</head>
<?php
	if (!isset($_SESSION['pagina']) || isset($_POST['index'])) {
		$_SESSION['pagina'] = 'index.php';
	}
	$pagina = $_SESSION['pagina'];
?>
<body>
<table class='cuerpo'>
<tr>
    <td colspan='2' style='background-color:#004D71;'>
        <div class='banner'>
            <div style='float:left;'>
                <a class='menubox-index'>Centro Salud Santa</a>
            </div>
            <div style='float:left;'>
                <a id='btnIndex' class='menubox-ini' href='index.php'>
                    <img src='../recursos/img/admin/usuario.png' alt='inicio'/>
                    <span><?php echo ucfirst(strtolower(current(explode(' ', $pers_nombres)))).' '; ?>
						<?php if ($pers_ap_paterno) {
								echo ucfirst($pers_ap_paterno[0]);
							} ?>
						<?php if ($pers_ap_materno) {
								echo ucfirst($pers_ap_materno[0]);
							} ?>
				</span> </a>
            </div>
            <div style='float:right;'>
                <a id='btnCerrarSesion' class='menubox-btn' href='#'>
                    <span>Cerrar</span> </a>
            </div>
            <div style="clear:both;"></div>
        </div>
    </td>
</tr>
<tr>
<td id='td_acordeon' style='width:200px;vertical-align:top;'>
<div id='acordeon' class='acordeon_wrapper'>
<ul id='items' class='acordeon'>
<?php if ($rol_id == ROL_ADMIN) { ?>
    <li><a href='#'>Experto</a>
        <ul class='sub-menu'>
            <li><a href='#' onclick="load('categvariable')">Categorías de variable</a></li>
            <li><a href='#' onclick="load('variable')">Variables</a></li>
            <li><a href='#' onclick="load('claseenfermedad')">Clase de enfermedad</a></li>
            <li><a href='#' onclick="load('enfermedad')">Enfermedad</a></li>
            <li hidden><a href='#' onclick="load('indicador')">Indicador</a></li>
            <li><a href='#' onclick="loadOn('percentil', 'graficos')">Graficos</a></li>
            <li><a href='#' onclick="load('percentil')">Percentil</a></li>
        </ul>
    </li>
<?php } ?>
<?php if ($rol_id == ROL_RECEPCION) { ?>
    <li><a href='#'>Pacientes</a>
        <ul class='sub-menu'>
            <li><a href='#' onclick="load('paciente')">Pacientes</a></li>
            <li><a href='#' onclick="load('tipoparentesco')">Tipo de parentesco</a></li>
        </ul>
    </li>
<?php } ?>
<?php if ($rol_id == ROL_ADMIN || $rol_id == ROL_MEDICO || $rol_id == ROL_RECEPCION || $rol_id == ROL_ENFERMERA) { ?>
    <li><a href='#'>Atenciones</a>
        <ul class='sub-menu'>
			<?php if ($rol_id == ROL_RECEPCION) { ?>
                <li><a href='#' onclick="loadOn('atencion', 'cita')">Citas</a></li>
			<?php } ?>
			<?php if ($rol_id == ROL_MEDICO || $rol_id == ROL_ENFERMERA) { ?>
                <li><a href='#' onclick="load('triaje')">Triaje</a></li>
			<?php } ?>
			<?php if ($rol_id == ROL_MEDICO) { ?>
                <li><a href='#' onclick="load('atencion')">Atenciones</a></li>
			<?php } ?>
			<?php if ($rol_id == ROL_ADMIN) { ?>
                <li><a href='#' onclick="load('especialidad')">Especialidades</a></li>
			<?php } ?>
        </ul>
    </li>
<?php } ?>
<?php if ($rol_id == ROL_ADMIN) { ?>
    <li><a href='#'>Personal</a>
        <ul class='sub-menu'>
            <li><a href='#' onclick="load('empleado')">Empleados</a></li>
            <li><a href='#' onclick="load('cargo')">Cargos</a></li>
        </ul>
    </li>
<?php } ?>
<?php if ($rol_id == ROL_ADMIN) { ?>
    <li><a href='#'>Seguridad</a>
        <ul class='sub-menu'>
            <li><a href='#' onclick="load('usuario')">Usuarios</a></li>
            <li><a href='#' onclick="load('rol')">Roles</a></li>
        </ul>
    </li>
<?php } ?>
</ul>
</div>
</td>
<td style='vertical-align:top;'>
    <div id='contenido' class='contenido'>
		<?php if ($pagina == 'index.php') { ?>
            <div style='text-align:center;margin-top:15px;'>
                <h1>Bienvenido <?php if ($usuario_id) {
						echo ': '.$pers_nombres.' '.$pers_ap_paterno.'<br/>('.$rol_nombre.')';
					} ?>
                </h1><br><br>
                <img src='../recursos/img/nutricion.jpg' style='width: 100%; max-width: 673px;' alt=''>
            </div>
		<?php } else {
			echo "<script>$('#contenido').load('$pagina');</script>";
		} ?>
    </div>
</td>
</tr>
</table>

<div id='modalWindow' class='modalWindow'>
    <div id="modal"></div>
</div>
<div id='modalWindowReg' class='modalWindow'>
    <div id="modalReg"></div>
</div>
<div id='yesNoWindow' class='yesNoWindow'>
    <div id='yesNoDialog' class='txt_center'>
        <span id='yesNoMsg'></span><br/>
        <input type='button' id='btnYes' class='btn naranja' style='width:80px;' value='Sí'>
        <input type='button' id='btnNo' class='btn' style='width:80px;' value='No' onclick='closeYesNoDialog();'>
    </div>
</div>
<div id='infoWindow' class='infoWindow'>
    <div id='infomodal' class='txt_center'>
        <div style='height:2px;'></div>
        <img id='info-img' src='' alt='resultado'> <span id='info-msg'></span>
        <div style='height:6px;'></div>
        <input type='button' id='btnInfoAceptar' value='Aceptar' class='btn' style='width:90px;'>
        <div style='height:2px;'></div>
    </div>
</div>
<script>
$(document).ready(function (e) {
    $('#btnIndex').click(function (e) {
        $.post('index.php', {index: 1}, function () {
        });
    });
    $('#btnAlertas').click(function (e) {
        performLoad('alerts.php');
    });
    $('#btnCerrarSesion').click(function (e) {
        $.post('vistas/usuario/proceso/logout.php', {},
            function () {
                window.location = 'login.php';
            });
    });

    // menu acordeon
    $(function () {
        var menu  = $('.acordeon > li > a'),
            items = $('.acordeon > li > ul');
        items.hide();
        $('.acordeon > li:nth-child(1) > ul').show();
        $('.acordeon > li:nth-child(1) > a').addClass('active');
        menu.click(function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active')) {
                items.slideUp();
                $(this).next().slideToggle();
                menu.removeClass('active');
                $(this).addClass('active');
            }
        });
    });

    $(document).mouseup(function (e) {
    });
    // ------- Fin menu horizontal -------
});

// >> Carga de paginas
function load(pagina) {
    performLoad('vistas/' + pagina + '/' + pagina + '.php');
}

function loadOn(module, pagina) {
    performLoad('vistas/' + module + '/' + pagina + '.php');
}

function loadReg(pagina) {
    performLoad('vistas/' + pagina + '/' + pagina + 'Reg.php');
}

function performLoad(contenido) {
    $('#contenido').load(contenido);
}

// ------- Fin carga de paginas -------

// >> Ventana modal
$(document).mouseup(function (e) {
    var container = $("#modal");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('#modalWindow').fadeOut(200);
    }
});

function showModal(contenido) {
    $('#modalWindow').hide().fadeIn(200).css('visibility', 'visible');
    $('#modal').load(contenido);
}

function fadeOutModal() {
    $('#modalWindow').fadeOut(100);
}

function closeModal() {
    $('#modalWindow').fadeOut(0);
}

// ------- Fin ventana modal -------

// >> Ventana modal de registro
function showModalReg(contenido) {
    $('#modalWindowReg').hide().fadeIn(200).css('visibility', 'visible');
    $('#modalReg').load(contenido);
}

function fadeOutModalReg() {
    $('#modalWindowReg').fadeOut(100);
}

function closeModalReg() {
    $('#modalWindowReg').fadeOut(0);
}

// ------- Fin ventana modal -------

// Dialogo de confirmacion:
$yesNoWindow = $('#yesNoWindow');
$yesButton   = $('#btnYes');
$noButton    = $('#btnNo');

function showYesNoDialog(mensaje) {
    $('#yesNoMsg').html(mensaje);
    $yesNoWindow.show();
    $yesButton.focus();
}

function closeYesNoDialog() {
    $yesNoWindow.hide();
}

$noButton.keydown(function (e) {
    if (e.which == 37 || e.which == 38 || e.which == 40) {
        $yesButton.focus();
    }
});
$yesButton.keydown(function (e) {
    if (e.which == 39 || e.which == 40 || e.which == 38) {
        $noButton.focus();
    }
});
// ------- Fin dialogo de confirmacion -------

// Ventana de información
var msg_status = '';
var info_focus = '';

function closeInfoModal() {
    $('#infoWindow').css('visibility', 'hidden');
    if (msg_status == 'OK') {
        volver();
    }
}

function showMessageOK(mensaje) {
    showMsg(mensaje);
    $('#infomodal #info-img').attr('src', '../recursos/img/dialog/correcto.png');
    msg_status = 'OK';
}

function showMessageListo(mensaje) {
    showMsg(mensaje);
    $('#infomodal #info-img').attr('src', '../recursos/img/dialog/correcto.png');
    msg_status = 'Listo';
}

function showMessageWarning(mensaje, input) {
    showMsg(mensaje);
    $('#infomodal #info-img').attr('src', '../recursos/img/dialog/warning.png');
    msg_status = 'Warning';
    input      = (typeof input === 'undefined') ? '' : input;
    info_focus = input;
}

function showMessageError(mensaje) {
    showMsg(mensaje);
    $('#infomodal #info-img').attr('src', '../recursos/img/dialog/error.png');
    msg_status = 'Error';
}

function showMsg(mensaje) {
    $('#infoWindow').css('visibility', 'visible');
    $('#infomodal #info-msg').html(mensaje);
    $('#btnInfoAceptar').focus();
}

$('#btnInfoAceptar').off('click').click(function (e) {
    closeInfoModal();
    if (msg_status == 'Warning' && info_focus != '') {
        $('#' + info_focus).focus();
    }
});
$('#yesNoDialog').draggable();
// ----------------- Fin ventana de informacion ------------------

$(document).keydown(function (e) {
    if (e.which == 27) {
        if ($yesNoWindow.css('visibility') == 'visible') {
            closeYesNoDialog();
        } else if ($('#infoWindow').css('visibility') == 'visible') {
            closeInfoModal();
            if (msg_status == 'Warning' && info_focus != '') {
                $('#' + info_focus).focus();
            }
        } else if ($('#modalWindow').css('visibility') == 'visible') {
            closeModal();
        } else {
            volver();
        }
    }
});

function datePicker(form, campo) {
    $(form).find(campo).datepicker(
        {
            changeMonth    : true,
            changeYear     : true,
            showButtonPanel: true,
            buttonImage    : "../recursos/img/date.png",
            buttonImageOnly: false,
            buttonText     : "Seleccionar fecha"
        }
    );
}

function changeFocus(field_name, field_key, key_pressed) {
    var input = '';
    if (key_pressed == 13) {
        input = $('#' + field_name + '_' + field_key).closest('tr').next().find('.' + field_name);
    } else if (key_pressed == 9) {
        input = $('#' + field_name + '_' + field_key).closest('td').next().find('input');
    }
    if (input.length) {
        input.focus();
    }
}

function changeFocus2(field_name, field_key, class_name, key_pressed) {
    var input = '';
    console.log(field_key);
    console.log(class_name);

    if (key_pressed == 13) {
        input = $('#' + field_name + '_' + field_key).closest('tr').next().find('.' + class_name);
    } else if (key_pressed == 9) {
        input = $('#' + field_name + '_' + field_key).closest('td').next().find('input');
    }
    if (input.length) {
        input.focus();
    }
}

</script>
</body>
</html>
