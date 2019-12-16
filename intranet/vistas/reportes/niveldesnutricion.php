<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<div id='frmReporte' class='listform'>
	<div class='form_top'>
		<span class='h1'>Casos de desnutrición por zonas</span>
		<hr class='separator'/>
		<div>
			<label for='txtBuscar'>Buscar:</label>
			<input type='text' id='txtBuscar' name='txtBuscar' placeholder='Ingrese búsqueda' />
			<a href='#' class='btn' id='btnRefrescar' name='btnRefrescar'>
				<img class='icon' src='../recursos/img/refresh.png'>
			</a>
		</div>
	</div>
	<hr class='separator'/>
	<div class='listform_body bpad15'>
		<div id='datos' class='centered' style='max-width: 800px;'></div>
	</div>
</div>
<script>
    var frm_empl = '#frmReporte';
    $(document).ready(function(e){
        empl_mostrarDatos();
        $(frm_empl).find('#txtBuscar').focus();
        $(frm_empl).find('#txtBuscar').keyup(function(e) {
            empl_mostrarDatos();
        });       
        $(frm_empl).find('#btnRefrescar').off('click').click(function(e) {
            empl_mostrarDatos();
        });
    });
    function empl_mostrarDatos() {
        var buscar = encodeURIComponent($('#txtBuscar').val());
        $(frm_empl).find('#datos').load('vistas/reportes/niveldesnutricionList.php?b='+buscar);
    }
    function volver() {
        performLoad('vistas/reportes/niveldesnutricion.php');
    }
</script>