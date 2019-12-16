<!DOCTYPE html>
<html lang='es'>
<head>
    <title>Sistema Centro Salud Santa</title>
    <meta charset="utf-8"/>

    <link rel="stylesheet" type="text/css" href="../recursos/css/styles3.css"/>
    <script type='text/javascript' src='../recursos/js/jquery.min.js'></script>
    <script type='text/javascript' src='../recursos/js/jquery_ui.min.js'></script>
    <script type="text/javascript" src="vistas/utils.js"></script>
</head>

<body>
<table class="cuerpo">
    <tr>
        <td colspan="2">
            <div class="banner">
                <div style="float:left;"><a class="menubox-index">Centro Salud Santa</a></div>
                <div style="clear:both;"></div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div id="contenido" class="contenido"></div>
        </td>
    </tr>
    <tr>
    
    </tr>
</table>
</body>
</html>
<script>
    $('#contenido').load('vistas/usuario/login.php');
</script>