<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
	CheckLoginAccess();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	$atenc_id  = GetNumParam('atenc_id');
	$atenc_row = $atenc_dal->getByID($atenc_id);
?>
<?php
	$parent = ReceiveParent('cita_upd', 'vistas/atencion/cita.php');
	$pac_id = $atenc_row['pac_id'];
?>
<span class='h2'>Evolucion del paciente</span>
<div class='txt_center'>
    <div id="bar_chart"></div>
    <br><br>
</div>
<div class='pad30'>
    <a href='#' class='btn' id='btnCancelar'>Volver</a>
</div>
<script>
    $(function () {
        showGrafico();
        $('#btnCancelar').click(function (e) {
            volver();
        });
    });

    function showGrafico() {
        var pac_id = '<?= $pac_id; ?>';
        $('#bar_chart').load('vistas/atencion/evolucionGraph.php?pac_id=' + pac_id);
    }

    function volver() {
        performLoad('<?php echo $parent; ?>');
    }
</script>
