<?php
	session_start();
	include_once '../../datos/AppUtils.php';
	include_once '../../vistas/utils.php';
?>
<?php
	include_once '../../datos/personaDAL.php';
	$dal_pers = new personaDAL();
?>
<?php
	include_once '../../datos/tipoparentescoDAL.php';
	$tparent_dal = new tipoparentescoDAL();
?>
<?php
	$action      = GetStringParam('action');
	$xpers_id    = GetNumericParam('xpers_id');
	$pers_id     = GetNumericParam('pers_id');
	$pers_key    = GetStringParam('pers_key');
	$key_pressed = GetStringParam('key_pressed');
	
	$array_key = "parent.pers{$xpers_id}";
	
	if ($action == 'init') {
		$fam_list = $dal_pers->listarFamiliares($xpers_id);
		
		unset($_SESSION[$array_key]);
		
		foreach ($fam_list as $fam_row) {
			$_SESSION[$array_key]["{$fam_row['pers2_id']}"] = [
				'parent_id'               => $fam_row['parent_id'],
				'parent_pers1_id'         => $fam_row['pers1_id'],
				'parent_pers2_id'         => $fam_row['pers2_id'],
				'parent_pers2_nombre'     => $fam_row['pers2_nombre'],
				'parent_pers2_ap_paterno' => $fam_row['pers2_ap_paterno'],
				'parent_pers2_ap_materno' => $fam_row['pers2_ap_materno'],
				'parent_tparent_id'       => $fam_row['tparent_id'],
				'parent_es_apoderado'     => $fam_row['parent_es_apoderado'],
				'parent_estado'           => $fam_row['parent_estado']
			];
		}
		
	} elseif ($action == 'add') {
		if ($pers_id) {
			$row_pers = $dal_pers->getByID($pers_id);
			
			$_SESSION[$array_key]["{$pers_id}"] = [
				'parent_id'               => 0,
				'parent_pers1_id'         => 0,
				'parent_pers2_id'         => $pers_id,
				'parent_pers2_nombre'     => $row_pers['pers_nombre'],
				'parent_pers2_ap_paterno' => $row_pers['pers_ap_paterno'],
				'parent_pers2_ap_materno' => $row_pers['pers_ap_materno'],
				'parent_tparent_id'       => 0,
				'parent_es_apoderado'     => 0,
				'parent_estado'           => 0
			];
		}
	} elseif ($action == 'remove') {
		unset($_SESSION[$array_key][$pers_key]);
		
	} elseif ($action == 'clear') {
		unset($_SESSION[$array_key]);
		
	} elseif ($action == 'update') {
		$array = $_SESSION[$array_key][$pers_key];
		
		if (IssetGetParam('parent_tparent_id')) {
			$array['parent_tparent_id'] = GetNumericParam('parent_tparent_id');
			echo "<script>changeFocus('txtParentTparentID', '$pers_key', '$key_pressed');</script>";
		}
		if (IssetGetParam('parent_es_apoderado')) {
			$array_data = $_SESSION[$array_key];
			foreach ($array_data as $key => $data) {
				$_SESSION[$array_key][$key]['parent_es_apoderado'] = 0;
			}
			$array['parent_es_apoderado'] = GetNumericParam('parent_es_apoderado');
			echo "<script>changeFocus('txtParentEsApoderado', '$pers_key', '$key_pressed');</script>";
		}
		
		$_SESSION[$array_key][$pers_key] = $array;
	}
	
	$parent = IssetOr($_SESSION[$array_key], []);
?>
<table id='tblParentesco' class='datatable' style='margin-left: 0;'>
    <tr>
        <th>Nº</th>
        <th>Persona</th>
        <th>Parentesco</th>
        <th>Apoderado</th>
        <th>Quitar</th>
    </tr>
	<?php $x = 0; ?>
	<?php foreach ($parent as $pers_key => $item) { ?>
        <tr>
            <td class='txt_center'><?php echo pad(++$x, 2); ?></td>
            <td><?php echo $item['parent_pers2_nombre'], ' ', $item['parent_pers2_ap_paterno'], ' ', $item['parent_pers2_ap_materno']; ?></td>
            <td class='txt_center'>
                <select name='txtParentTparentID_<?php echo $pers_key; ?>'
                        id='txtParentTparentID_<?php echo $pers_key; ?>' class='txtParentTparentID txt120'>
                    <option value='0'>(Seleccione)</option>
					<?php $tparent_list = $tparent_dal->listarcbo(); ?>
					<?php foreach ($tparent_list as $row) { ?>
                        <option value='<?php echo $row['tparent_id']; ?>'
							<?= $item['parent_tparent_id'] == $row['tparent_id'] ? 'selected' : '' ?>>
							<?php echo $row['tparent_nombre']; ?>
                        </option>
					<?php } ?>
                </select>
            </td>
            <td class='txt_center'>
                <label class='check'>
                    <input type='radio' class='txtParentEsApoderado' name='txtParentEsApoderado'
                           id='txtParentEsApoderado_<?php echo $pers_key; ?>' <?= ($item['parent_es_apoderado'] == 1) ? 'checked' : ''; ?>>
                </label>
            </td>
            <td><a href='#' onclick="divPersona_RemovePersona('<?php echo $pers_key; ?>');return false;">Quitar</a></td>
        </tr>
	<?php } ?>
	<?php if (count($parent) == 0) { ?>
        <tr>
            <td colspan='7' class='txt_center' style='padding-top:20px;padding-bottom:20px;'>
				<?php echo 'Agregue personas a la lista'; ?>
            </td>
        </tr>
	<?php } ?>
</table>
<div style='display: none;'>
	<?php
		$txtParentTparentID_wrong   = '';
		$txtParentEsApoderado_wrong = '';
		
		foreach ($parent as $pers_key => $d) {
			if ($d['parent_tparent_id'] == '') {
				$txtParentTparentID_wrong = "txtParentTparentID_{$pers_key}";
				break;
			}
			if ($d['parent_es_apoderado'] == '') {
				$txtParentEsApoderado_wrong = "txtParentEsApoderado_{$pers_key}";
				break;
			}
		}
	?>
    <input type='text' id='txtParentDetailsCount' value='<?php echo count($parent); ?>'
           class='txt60' title=''>
    <input type='text' id='txtParentTparentID_wrong' value='<?php echo $txtParentTparentID_wrong; ?>'
           class='txt60' title=''>
    <input type='text' id='txtParentEsApoderado_wrong' value='<?php echo $txtParentEsApoderado_wrong; ?>'
           class='txt60' title=''>
</div>
<script>
    $('#tblParentesco').find('.txtParentTparentID').change(function (e) {
        var input_id          = e.target.id;
        var pers_key          = input_id.split('_').slice(1).join('_');
        var parent_tparent_id = $(pers_fam).find('#' + input_id).val();
        divPersona_UpdateParentTparentID(pers_key, parent_tparent_id);
    });
    $('#tblParentesco').find('.txtParentEsApoderado').change(function (e) {
        var input_id            = e.target.id;
        var pers_key            = input_id.split('_').slice(1).join('_');
        var parent_es_apoderado = $(pers_fam).find("input[name='txtParentEsApoderado']:checked") ? 1 : 0;
        divPersona_UpdateParentEsApoderado(pers_key, parent_es_apoderado);
    });
    $('#tblParentesco').find('#tblParentesco').find('input').keydown(function (e) {
        key_pressed = (e.which == 9 || e.which == 13) ? e.which : 0;
    });
</script>
