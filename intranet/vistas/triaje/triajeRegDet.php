<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
?>
<?php
	include_once '../../datos/variableDAL.php';
	$var_dal = new variableDAL();
?>
<?php
	include_once '../../datos/triajeDAL.php';
	$triaje_dal = new triajeDAL();
?>
<?php
	include_once '../../datos/atencionDAL.php';
	$atenc_dal = new atencionDAL();
?>
<?php
	include_once '../../datos/pacienteDAL.php';
	$pac_dal = new pacienteDAL();
?>
<?php
	$action      = GetStrParam('action');
	$atenc_id    = GetNumParam('atenc_id');
	$var_id      = GetNumParam('var_id');
	$var_key     = GetStrParam('var_key');
	$key_pressed = GetStrParam('key_pressed');
	
	$atenc_row = $atenc_dal->getByID($atenc_id);
	$pac_row   = $pac_dal->getByID($atenc_row['pac_id']);
	
	$array_key = "triaje{$atenc_id}.var";
	
	if ($action == 'init') {
		$triaje_list = $triaje_dal->listarByAtencion($atenc_id);
		unset($_SESSION[$array_key]);
		
		if (count($triaje_list) > 0) {
			foreach ($triaje_list as $triaje_row) {
				$_SESSION[$array_key]["{$triaje_row['var_id']}"] = [
					'triaje_id'       => $triaje_row['triaje_id'],
					'catvar_id'       => $triaje_row['catvar_id'],
					'catvar_nombre'   => $triaje_row['catvar_nombre'],
					'var_id'          => $triaje_row['var_id'],
					'var_nombre'      => $triaje_row['var_nombre'],
					'var_tipo_var'    => $triaje_row['var_tipo_var'],
					'var_tipo_escala' => $triaje_row['var_tipo_escala'],
					'triaje_um_id'    => $triaje_row['um_id'],
					'triaje_um_abrev' => $triaje_row['um_abrev'],
					'triaje_valor'    => $triaje_row['triaje_valor']
				];
			}
		} else {
			$var_list = $var_dal->listar();
			foreach ($var_list as $var_id => $var_row) {
				$_SESSION[$array_key]["{$var_id}"] = [
					'triaje_id'       => 0,
					'catvar_id'       => $var_row['catvar_id'],
					'catvar_nombre'   => $var_row['catvar_nombre'],
					'var_id'          => $var_row['var_id'],
					'var_nombre'      => $var_row['var_nombre'],
					'var_tipo_var'    => $var_row['var_tipo_var'],
					'var_tipo_escala' => $var_row['var_tipo_escala'],
					'triaje_um_id'    => $var_row['um_id'],
					'triaje_um_abrev' => $var_row['um_abrev'],
					'triaje_valor'    => ($var_row['var_id'] == VAR_EDAD) ? edad($atenc_row['atenc_fecha_reg'], $pac_row['pers_fecha_nac'], false) : 0
				];
				
			}
		}
	} elseif ($action == 'add') {
		if ($var_id) {
			$var_row = $var_dal->getByID($var_id);
			
			$_SESSION[$array_key]["{$var_id}"] = [
				'triaje_id'       => 0,
				'catvar_id'       => $var_row['catvar_id'],
				'catvar_nombre'   => $var_row['catvar_nombre'],
				'var_id'          => $var_row['var_id'],
				'var_nombre'      => $var_row['var_nombre'],
				'var_tipo_var'    => $var_row['var_tipo_var'],
				'var_tipo_escala' => $var_row['var_tipo_escala'],
				'triaje_um_id'    => $var_row['um_id'],
				'triaje_um_abrev' => $var_row['um_abrev'],
				'triaje_valor'    => 0
			];
		}
	} elseif ($action == 'remove') {
		unset($_SESSION[$array_key][$var_key]);
		
	} elseif ($action == 'clear') {
		unset($_SESSION[$array_key]);
		
	} elseif ($action == 'update') {
		$array = $_SESSION[$array_key][$var_key];
		
		if (IssetGetParam('triaje_um_id')) {
			$array['triaje_um_id'] = GetNumParam('triaje_um_id');
			echo "<script>changeFocus('txtTriajeUmID', '$var_key', '$key_pressed');</script>";
		}
		if (IssetGetParam('triaje_valor')) {
			$array['triaje_valor'] = GetNumParam('triaje_valor');
			echo "<script>changeFocus('txtTriajeValor', '$var_key', '$key_pressed');</script>";
		}
		
		$_SESSION[$array_key][$var_key] = $array;
	}
	
	$triaje = IssetOr($_SESSION[$array_key], []);
	
	// ordenar por categoria:
	uasort($triaje, function ($a, $b) {
		return $b['catvar_id'] < $a['catvar_id'];
	})
?>
<table id='tblTriaje' class='datatable'>
<tr>
    <th>Nº</th>
    <th>Variable</th>
    <th hidden>UM</th>
    <th>Valor</th>
    <th>UM</th>
    <th>Resultado</th>
    <th hidden>Quitar</th>
</tr>
<?php $x = 0; ?>
<?php $cat_var_id_aux = 0; ?>
<?php foreach ($triaje as $var_key => $item) { ?>
	<?php if ($item['catvar_id'] != $cat_var_id_aux) { ?>
		<?php $cat_var_id_aux = $item['catvar_id']; ?>
        <tr>
            <td colspan='7' style='background-color: #EAF6F9;'>
                <b><?php echo $item['catvar_nombre']; ?></b>
            </td>
        </tr>
	<?php } ?>
    <tr>
    <td class='txt_center'><?php echo pad(++$x, 2); ?></td>
    <td><?php echo $item['var_nombre']; ?></td>
    <td hidden>
        <input type='text' id='txtTriajeUmID_<?php echo $var_key; ?>'
               value="<?php echo EmptyZero($item['triaje_um_id']); ?>"
               class='txtTriajeUmID txt70' title='um id'/></td>
	<?php if ($item['var_tipo_var'] == TVAR_NUMERIC) { ?>
        <td class='txt_center'>
			<?php $hidden = ($item['var_id'] == VAR_EDAD) ? "hidden" : ""; ?>
			<?php $edad = edad($atenc_row['atenc_fecha_reg'], $pac_row['pers_fecha_nac'], true); ?>

            <input <?= $hidden ?>
                   type='text' id='txtTriajeValor_<?php echo $var_key; ?>'
                   value="<?php echo int_nformat($item['triaje_valor'], 2); ?>"
                   class='txtTriajeValor txt70' title='valor'/>
            
            <?php if($item['var_id'] == VAR_EDAD) { ?>
                <input readonly type='text' value='<?= "$edad[anios]a $edad[meses]m" ?>' class='txt70'>
            <?php } ?>
            
        </td>
        <td class='txt_center'>
            <input <?= $hidden ?> readonly type='text' id='txtTriajeUmAbrev_<?php echo $var_key; ?>'
                   value="<?php echo $item['triaje_um_abrev']; ?>"
                   class='txtTriajeUmAbrev txt70 bg_lgris' title='um abrev'/>
        </td>
	<?php } elseif ($item['var_tipo_var'] == TVAR_ESCALA) { ?>
		<?php
		$esc_list = [];
		if ($item['var_tipo_escala'] == TESC_SINO) {
			$esc_list = getEscalaSiNo();
		} elseif ($item['var_tipo_escala'] == TESC_LIKERT3) {
			$esc_list = getEscalaLikert3();
		} elseif ($item['var_tipo_escala'] == TESC_LIKERT5) {
			$esc_list = getEscalaLikert5();
		} ?>
        <td colspan='2' class='txt_center'>
			<?php foreach ($esc_list as $esc_key => $esc_nombre) { ?>
                <label class='check'>
                    <input type='radio' class='chkTriajeValor' name='txtTriajeValor_<?php echo $var_key; ?>'
                           id='txtTriajeValor_<?php echo $var_key; ?>' value='<?= $esc_key ?>'
					       <?= $esc_key == $item['triaje_valor'] ? 'checked' : '' ?>>
					<?= $esc_nombre ?>
                </label>
			<?php } ?>
        </td>
	<?php } ?>
    <td></td>
    <td hidden>
        <a href='#' onclick="divAtencion_RemoveVariable('<?php echo $var_key; ?>');return false;">Quitar</a>
    </td>
    </tr>
<?php } ?>
<?php if (count($triaje) == 0) { ?>
    <tr>
        <td colspan='8' class='txt_center' style='padding-top:20px;padding-bottom:20px;'>
			<?php echo 'Agregue variables a la lista'; ?>
        </td>
    </tr>
<?php } ?>
</table>
<div style='display: none;'>
	<?php
		$txtTriajeUmID_wrong  = '';
		$txtTriajeValor_wrong = '';
		
		foreach ($triaje as $var_key => $d) {
			if ($d['triaje_um_id'] == '') {
				$txtTriajeUmID_wrong = "txtTriajeUmID_{$var_key}";
				break;
			}
			if ($d['triaje_valor'] == '') {
				$txtTriajeValor_wrong = "txtTriajeValor_{$var_key}";
				break;
			}
		}
	?>
    <input type='text' id='txtTriajeDetailsCount' value='<?php echo count($triaje); ?>'
           class='txt60' title=''>
    <input type='text' id='txtTriajeUmID_wrong' value='<?php echo $txtTriajeUmID_wrong; ?>'
           class='txt60' title=''>
    <input type='text' id='txtTriajeValor_wrong' value='<?php echo $txtTriajeValor_wrong; ?>'
           class='txt60' title=''>
</div>
<script>
    var triaje_reg = '#frmTriajeReg';
    $(triaje_reg).find('.txtTriajeUmID').change(function (e) {
        var input_id     = e.target.id;
        var var_key      = input_id.split('_').slice(1).join('_');
        var triaje_um_id = $(triaje_reg).find('#' + input_id).val();
        divAtencion_UpdateTriajeUmID(var_key, triaje_um_id);
    });
    $(triaje_reg).find('.txtTriajeValor').change(function (e) {
        var input_id     = e.target.id;
        var var_key      = input_id.split('_').slice(1).join('_');
        var triaje_valor = $(triaje_reg).find('#' + input_id).val();
        divAtencion_UpdateTriajeValor(var_key, triaje_valor);
    });
    $(triaje_reg).find('.chkTriajeValor').change(function (e) {
        var input_id     = e.target.id;
        var var_key      = input_id.split('_').slice(1).join('_');
        var triaje_valor = $(triaje_reg).find("input[name=" + input_id + "]:checked").val();
        divAtencion_UpdateTriajeValor(var_key, triaje_valor);
    });
    $(triaje_reg).find('#tblTriaje').find('input').keydown(function (e) {
        key_pressed = (e.which == 9 || e.which == 13) ? e.which : 0;
    });
</script>
