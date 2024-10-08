<?php

// Data functions (insert, update, delete, form) for table Atendimentos

// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

function Atendimentos_insert(&$error_message = '') {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('Atendimentos');
	if(!$arrPerm['insert']) return false;

	$data = [
		'Colaborador' => Request::lookup('Colaborador', ''),
		'Eleitor' => Request::lookup('Eleitor', ''),
		'Data' => Request::dateComponents('Data', ''),
		'Situacao' => Request::val('Situacao', ''),
		'Pedido' => br2nl(Request::val('Pedido', '')),
		'Pendencias' => br2nl(Request::val('Pendencias', '')),
		'Solucao' => br2nl(Request::val('Solucao', '')),
	];

	if($data['Colaborador'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Colaborador': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Eleitor'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Eleitor': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Data'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Data': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Situacao'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Situa&#231;&#227;o': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Pedido'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Descri&#231;&#227;o dos pedidos': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}

	// hook: Atendimentos_before_insert
	if(function_exists('Atendimentos_before_insert')) {
		$args = [];
		if(!Atendimentos_before_insert($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('Atendimentos', backtick_keys_once($data), $error);
	if($error) {
		$error_message = $error;
		return false;
	}

	$recID = db_insert_id(db_link());

	update_calc_fields('Atendimentos', $recID, calculated_fields()['Atendimentos']);

	// hook: Atendimentos_after_insert
	if(function_exists('Atendimentos_after_insert')) {
		$res = sql("SELECT * FROM `Atendimentos` WHERE `id`='" . makeSafe($recID, false) . "' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args = [];
		if(!Atendimentos_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	// record owner is current user
	$recordOwner = getLoggedMemberID();
	set_record_owner('Atendimentos', $recID, $recordOwner);

	// if this record is a copy of another record, copy children if applicable
	if(strlen(Request::val('SelectedID'))) Atendimentos_copy_children($recID, Request::val('SelectedID'));

	return $recID;
}

function Atendimentos_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = []; // array of curl handlers for launching insert requests
	$eo = ['silentErrors' => true];
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function Atendimentos_delete($selected_id, $AllowDeleteOfParents = false, $skipChecks = false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id = makeSafe($selected_id);

	// mm: can member delete record?
	if(!check_record_permission('Atendimentos', $selected_id, 'delete')) {
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: Atendimentos_before_delete
	if(function_exists('Atendimentos_before_delete')) {
		$args = [];
		if(!Atendimentos_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'] . (
				!empty($args['error_message']) ?
					'<div class="text-bold">' . strip_tags($args['error_message']) . '</div>'
					: '' 
			);
	}

	sql("DELETE FROM `Atendimentos` WHERE `id`='{$selected_id}'", $eo);

	// hook: Atendimentos_after_delete
	if(function_exists('Atendimentos_after_delete')) {
		$args = [];
		Atendimentos_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("DELETE FROM `membership_userrecords` WHERE `tableName`='Atendimentos' AND `pkValue`='{$selected_id}'", $eo);
}

function Atendimentos_update(&$selected_id, &$error_message = '') {
	global $Translation;

	// mm: can member edit record?
	if(!check_record_permission('Atendimentos', $selected_id, 'edit')) return false;

	$data = [
		'Colaborador' => Request::lookup('Colaborador', ''),
		'Eleitor' => Request::lookup('Eleitor', ''),
		'Data' => Request::dateComponents('Data', ''),
		'Situacao' => Request::val('Situacao', ''),
		'Pedido' => br2nl(Request::val('Pedido', '')),
		'Pendencias' => br2nl(Request::val('Pendencias', '')),
		'Solucao' => br2nl(Request::val('Solucao', '')),
	];

	if($data['Colaborador'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Colaborador': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Eleitor'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Eleitor': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Data'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Data': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Situacao'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Situa&#231;&#227;o': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	if($data['Pedido'] === '') {
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Descri&#231;&#227;o dos pedidos': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">' . $Translation['< back'] . '</a></div>';
		exit;
	}
	// get existing values
	$old_data = getRecord('Atendimentos', $selected_id);
	if(is_array($old_data)) {
		$old_data = array_map('makeSafe', $old_data);
		$old_data['selectedID'] = makeSafe($selected_id);
	}

	$data['selectedID'] = makeSafe($selected_id);

	// hook: Atendimentos_before_update
	if(function_exists('Atendimentos_before_update')) {
		$args = ['old_data' => $old_data];
		if(!Atendimentos_before_update($data, getMemberInfo(), $args)) {
			if(isset($args['error_message'])) $error_message = $args['error_message'];
			return false;
		}
	}

	$set = $data; unset($set['selectedID']);
	foreach ($set as $field => $value) {
		$set[$field] = ($value !== '' && $value !== NULL) ? $value : NULL;
	}

	if(!update(
		'Atendimentos', 
		backtick_keys_once($set), 
		['`id`' => $selected_id], 
		$error_message
	)) {
		echo $error_message;
		echo '<a href="Atendimentos_view.php?SelectedID=' . urlencode($selected_id) . "\">{$Translation['< back']}</a>";
		exit;
	}


	$eo = ['silentErrors' => true];

	update_calc_fields('Atendimentos', $data['selectedID'], calculated_fields()['Atendimentos']);

	// hook: Atendimentos_after_update
	if(function_exists('Atendimentos_after_update')) {
		$res = sql("SELECT * FROM `Atendimentos` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) $data = array_map('makeSafe', $row);

		$data['selectedID'] = $data['id'];
		$args = ['old_data' => $old_data];
		if(!Atendimentos_after_update($data, getMemberInfo(), $args)) return;
	}

	// mm: update record update timestamp
	set_record_owner('Atendimentos', $selected_id);
}

function Atendimentos_form($selectedId = '', $allowUpdate = true, $allowInsert = true, $allowDelete = true, $separateDV = true, $templateDV = '', $templateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selectedId. If $selectedId
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;
	$eo = ['silentErrors' => true];
	$noUploads = $row = $urow = $jsReadOnly = $jsEditable = $lookups = null;
	$noSaveAsCopy = true;
	$hasSelectedId = strlen($selectedId) > 0;

	// mm: get table permissions
	$arrPerm = getTablePermissions('Atendimentos');
	$allowInsert = ($arrPerm['insert'] ? true : false);
	$allowUpdate = $hasSelectedId && check_record_permission('Atendimentos', $selectedId, 'edit');
	$allowDelete = $hasSelectedId && check_record_permission('Atendimentos', $selectedId, 'delete');

	if(!$allowInsert && !$hasSelectedId)
		// no insert permission and no record selected
		// so show access denied error -- except if TVDV: just hide DV
		return $separateDV ? $Translation['tableAccessDenied'] : '';

	if($hasSelectedId && !check_record_permission('Atendimentos', $selectedId, 'view'))
		return $Translation['tableAccessDenied'];

	// print preview?
	$dvprint = $hasSelectedId && Request::val('dvprint_x') != '';

	$showSaveNew = !$dvprint && ($allowInsert && !$hasSelectedId);
	$showSaveChanges = !$dvprint && $allowUpdate && $hasSelectedId;
	$showDelete = !$dvprint && $allowDelete && $hasSelectedId;
	$showSaveAsCopy = !$dvprint && ($allowInsert && $hasSelectedId && !$noSaveAsCopy);
	$fieldsAreEditable = !$dvprint && (($allowInsert && !$hasSelectedId) || ($allowUpdate && $hasSelectedId) || $showSaveAsCopy);

	$filterer_Colaborador = Request::val('filterer_Colaborador');
	$filterer_Eleitor = Request::val('filterer_Eleitor');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: Colaborador
	$combo_Colaborador = new DataCombo;
	// combobox: Eleitor
	$combo_Eleitor = new DataCombo;
	// combobox: Data
	$combo_Data = new DateCombo;
	$combo_Data->DateFormat = "dmy";
	$combo_Data->MinYear = defined('Atendimentos.Data.MinYear') ? constant('Atendimentos.Data.MinYear') : 1900;
	$combo_Data->MaxYear = defined('Atendimentos.Data.MaxYear') ? constant('Atendimentos.Data.MaxYear') : 2100;
	$combo_Data->DefaultDate = parseMySQLDate('', '');
	$combo_Data->MonthNames = $Translation['month names'];
	$combo_Data->NamePrefix = 'Data';
	// combobox: Situacao
	$combo_Situacao = new Combo;
	$combo_Situacao->ListType = 0;
	$combo_Situacao->MultipleSeparator = ', ';
	$combo_Situacao->ListBoxHeight = 10;
	$combo_Situacao->RadiosPerLine = 1;
	if(is_file(__DIR__ . '/hooks/Atendimentos.Situacao.csv')) {
		$Situacao_data = addslashes(implode('', @file(__DIR__ . '/hooks/Atendimentos.Situacao.csv')));
		$combo_Situacao->ListItem = array_trim(explode('||', entitiesToUTF8(convertLegacyOptions($Situacao_data))));
		$combo_Situacao->ListData = $combo_Situacao->ListItem;
	} else {
		$combo_Situacao->ListItem = array_trim(explode('||', entitiesToUTF8(convertLegacyOptions("Em aberto;;Com pend&#234;ncias;;Finalizado"))));
		$combo_Situacao->ListData = $combo_Situacao->ListItem;
	}
	$combo_Situacao->SelectName = 'Situacao';
	$combo_Situacao->AllowNull = false;

	if($hasSelectedId) {
		$res = sql("SELECT * FROM `Atendimentos` WHERE `id`='" . makeSafe($selectedId) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'Atendimentos_view.php', false);
		}
		$combo_Colaborador->SelectedData = $row['Colaborador'];
		$combo_Eleitor->SelectedData = $row['Eleitor'];
		$combo_Data->DefaultDate = $row['Data'];
		$combo_Situacao->SelectedData = $row['Situacao'];
		$urow = $row; /* unsanitized data */
		$row = array_map('safe_html', $row);
	} else {
		$filterField = Request::val('FilterField');
		$filterOperator = Request::val('FilterOperator');
		$filterValue = Request::val('FilterValue');
		$combo_Colaborador->SelectedData = $filterer_Colaborador;
		$combo_Eleitor->SelectedData = $filterer_Eleitor;
		$combo_Situacao->SelectedText = (isset($filterField[1]) && $filterField[1] == '5' && $filterOperator[1] == '<=>' ? $filterValue[1] : entitiesToUTF8(''));
	}
	$combo_Colaborador->HTML = '<span id="Colaborador-container' . $rnd1 . '"></span><input type="hidden" name="Colaborador" id="Colaborador' . $rnd1 . '" value="' . html_attr($combo_Colaborador->SelectedData) . '">';
	$combo_Colaborador->MatchText = '<span id="Colaborador-container-readonly' . $rnd1 . '"></span><input type="hidden" name="Colaborador" id="Colaborador' . $rnd1 . '" value="' . html_attr($combo_Colaborador->SelectedData) . '">';
	$combo_Eleitor->HTML = '<span id="Eleitor-container' . $rnd1 . '"></span><input type="hidden" name="Eleitor" id="Eleitor' . $rnd1 . '" value="' . html_attr($combo_Eleitor->SelectedData) . '">';
	$combo_Eleitor->MatchText = '<span id="Eleitor-container-readonly' . $rnd1 . '"></span><input type="hidden" name="Eleitor" id="Eleitor' . $rnd1 . '" value="' . html_attr($combo_Eleitor->SelectedData) . '">';
	$combo_Situacao->Render();

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_Colaborador__RAND__ = { text: "", value: "<?php echo addslashes($hasSelectedId ? $urow['Colaborador'] : htmlspecialchars($filterer_Colaborador, ENT_QUOTES)); ?>"};
		AppGini.current_Eleitor__RAND__ = { text: "", value: "<?php echo addslashes($hasSelectedId ? $urow['Eleitor'] : htmlspecialchars($filterer_Eleitor, ENT_QUOTES)); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(Colaborador_reload__RAND__) == 'function') Colaborador_reload__RAND__();
				if(typeof(Eleitor_reload__RAND__) == 'function') Eleitor_reload__RAND__();
			}, 50); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function Colaborador_reload__RAND__() {
		<?php if($fieldsAreEditable) { ?>

			$j("#Colaborador-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_Colaborador__RAND__.value, t: 'Atendimentos', f: 'Colaborador' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="Colaborador"]').val(resp.results[0].id);
							$j('[id=Colaborador-container-readonly__RAND__]').html('<span class="match-text" id="Colaborador-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Colaboradores_view_parent]').hide(); } else { $j('.btn[id=Colaboradores_view_parent]').show(); }


							if(typeof(Colaborador_update_autofills__RAND__) == 'function') Colaborador_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { return { s: term, p: page, t: 'Atendimentos', f: 'Colaborador' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_Colaborador__RAND__.value = e.added.id;
				AppGini.current_Colaborador__RAND__.text = e.added.text;
				$j('[name="Colaborador"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Colaboradores_view_parent]').hide(); } else { $j('.btn[id=Colaboradores_view_parent]').show(); }


				if(typeof(Colaborador_update_autofills__RAND__) == 'function') Colaborador_update_autofills__RAND__();
			});

			if(!$j("#Colaborador-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_Colaborador__RAND__.value, t: 'Atendimentos', f: 'Colaborador' },
					success: function(resp) {
						$j('[name="Colaborador"]').val(resp.results[0].id);
						$j('[id=Colaborador-container-readonly__RAND__]').html('<span class="match-text" id="Colaborador-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Colaboradores_view_parent]').hide(); } else { $j('.btn[id=Colaboradores_view_parent]').show(); }

						if(typeof(Colaborador_update_autofills__RAND__) == 'function') Colaborador_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_Colaborador__RAND__.value, t: 'Atendimentos', f: 'Colaborador' },
				success: function(resp) {
					$j('[id=Colaborador-container__RAND__], [id=Colaborador-container-readonly__RAND__]').html('<span class="match-text" id="Colaborador-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Colaboradores_view_parent]').hide(); } else { $j('.btn[id=Colaboradores_view_parent]').show(); }

					if(typeof(Colaborador_update_autofills__RAND__) == 'function') Colaborador_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function Eleitor_reload__RAND__() {
		<?php if($fieldsAreEditable) { ?>

			$j("#Eleitor-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_Eleitor__RAND__.value, t: 'Atendimentos', f: 'Eleitor' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="Eleitor"]').val(resp.results[0].id);
							$j('[id=Eleitor-container-readonly__RAND__]').html('<span class="match-text" id="Eleitor-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Eleitores_view_parent]').hide(); } else { $j('.btn[id=Eleitores_view_parent]').show(); }


							if(typeof(Eleitor_update_autofills__RAND__) == 'function') Eleitor_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { return { s: term, p: page, t: 'Atendimentos', f: 'Eleitor' }; },
					results: function(resp, page) { return resp; }
				},
				escapeMarkup: function(str) { return str; }
			}).on('change', function(e) {
				AppGini.current_Eleitor__RAND__.value = e.added.id;
				AppGini.current_Eleitor__RAND__.text = e.added.text;
				$j('[name="Eleitor"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Eleitores_view_parent]').hide(); } else { $j('.btn[id=Eleitores_view_parent]').show(); }


				if(typeof(Eleitor_update_autofills__RAND__) == 'function') Eleitor_update_autofills__RAND__();
			});

			if(!$j("#Eleitor-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_Eleitor__RAND__.value, t: 'Atendimentos', f: 'Eleitor' },
					success: function(resp) {
						$j('[name="Eleitor"]').val(resp.results[0].id);
						$j('[id=Eleitor-container-readonly__RAND__]').html('<span class="match-text" id="Eleitor-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Eleitores_view_parent]').hide(); } else { $j('.btn[id=Eleitores_view_parent]').show(); }

						if(typeof(Eleitor_update_autofills__RAND__) == 'function') Eleitor_update_autofills__RAND__();
					}
				});
			}

		<?php } else { ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_Eleitor__RAND__.value, t: 'Atendimentos', f: 'Eleitor' },
				success: function(resp) {
					$j('[id=Eleitor-container__RAND__], [id=Eleitor-container-readonly__RAND__]').html('<span class="match-text" id="Eleitor-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=Eleitores_view_parent]').hide(); } else { $j('.btn[id=Eleitores_view_parent]').show(); }

					if(typeof(Eleitor_update_autofills__RAND__) == 'function') Eleitor_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_clean());


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$templateDVP}") ? "./{$templateDVP}" : './templates/Atendimentos_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	} else {
		$template_file = is_file("./{$templateDV}") ? "./{$templateDV}" : './templates/Atendimentos_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Detalhes', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', (Request::val('Embedded') ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($showSaveNew) {
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return Atendimentos_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
	} elseif($showSaveAsCopy) {
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return Atendimentos_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if(Request::val('Embedded')) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	} else {
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($hasSelectedId) {
		if(!Request::val('Embedded')) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($allowUpdate)
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return Atendimentos_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		else
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);

		if($allowDelete)
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		else
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);

		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	} else {
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);

		// if not in embedded mode and user has insert only but no view/update/delete,
		// remove 'back' button
		if(
			$allowInsert
			&& !$allowUpdate && !$allowDelete && !$arrPerm['view']
			&& !Request::val('Embedded')
		)
			$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '', $templateCode);
		elseif($separateDV)
			$templateCode = str_replace(
				'<%%DESELECT_BUTTON%%>', 
				'<button
					type="submit" 
					class="btn btn-default" 
					id="deselect" 
					name="deselect_x" 
					value="1" 
					onclick="' . $backAction . '" 
					title="' . html_attr($Translation['Back']) . '">
						<i class="glyphicon glyphicon-chevron-left"></i> ' .
						$Translation['Back'] .
				'</button>',
				$templateCode
			);
		else
			$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '', $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(!$fieldsAreEditable) {
		$jsReadOnly = '';
		$jsReadOnly .= "\tjQuery('#Colaborador').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#Colaborador_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#Eleitor').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#Eleitor_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#Data').prop('readonly', true);\n";
		$jsReadOnly .= "\tjQuery('#DataDay, #DataMonth, #DataYear').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#Situacao').replaceWith('<div class=\"form-control-static\" id=\"Situacao\">' + (jQuery('#Situacao').val() || '') + '</div>'); jQuery('#Situacao-multi-selection-help').hide();\n";
		$jsReadOnly .= "\tjQuery('#Pedido').replaceWith('<div class=\"form-control-static\" id=\"Pedido\">' + (jQuery('#Pedido').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#Pendencias').replaceWith('<div class=\"form-control-static\" id=\"Pendencias\">' + (jQuery('#Pendencias').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#Solucao').replaceWith('<div class=\"form-control-static\" id=\"Solucao\">' + (jQuery('#Solucao').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	} else {
		// temporarily disable form change handler till time and datetime pickers are enabled
		$jsEditable = "\tjQuery('form').eq(0).data('already_changed', true);";
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(Colaborador)%%>', $combo_Colaborador->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(Colaborador)%%>', $combo_Colaborador->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(Colaborador)%%>', urlencode($combo_Colaborador->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(Eleitor)%%>', $combo_Eleitor->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(Eleitor)%%>', $combo_Eleitor->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(Eleitor)%%>', urlencode($combo_Eleitor->MatchText), $templateCode);
	$templateCode = str_replace(
		'<%%COMBO(Data)%%>', 
		(!$fieldsAreEditable ? 
			'<div class="form-control-static">' . $combo_Data->GetHTML(true) . '</div>' : 
			$combo_Data->GetHTML()
		), $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(Data)%%>', $combo_Data->GetHTML(true), $templateCode);
	$templateCode = str_replace('<%%COMBO(Situacao)%%>', $combo_Situacao->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(Situacao)%%>', $combo_Situacao->SelectedData, $templateCode);

	/* lookup fields array: 'lookup field name' => ['parent table name', 'lookup field caption'] */
	$lookup_fields = ['Colaborador' => ['Colaboradores', 'Colaborador'], 'Eleitor' => ['Eleitores', 'Eleitor'], ];
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if(($pt_perm['view'] && isDetailViewEnabled($ptfc[0])) || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] /* && !Request::val('Embedded')*/) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-default add_new_parent" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus text-success"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Colaborador)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Eleitor)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Data)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Situacao)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Pedido)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Pendencias)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(Solucao)%%>', '', $templateCode);

	// process values
	if($hasSelectedId) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(Colaborador)%%>', safe_html($urow['Colaborador']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(Colaborador)%%>', html_attr($row['Colaborador']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Colaborador)%%>', urlencode($urow['Colaborador']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(Eleitor)%%>', safe_html($urow['Eleitor']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(Eleitor)%%>', html_attr($row['Eleitor']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Eleitor)%%>', urlencode($urow['Eleitor']), $templateCode);
		$templateCode = str_replace('<%%VALUE(Data)%%>', app_datetime($row['Data']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Data)%%>', urlencode(app_datetime($urow['Data'])), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(Situacao)%%>', safe_html($urow['Situacao']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(Situacao)%%>', html_attr($row['Situacao']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Situacao)%%>', urlencode($urow['Situacao']), $templateCode);
		$templateCode = str_replace('<%%VALUE(Pedido)%%>', safe_html($urow['Pedido'], $fieldsAreEditable), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Pedido)%%>', urlencode($urow['Pedido']), $templateCode);
		$templateCode = str_replace('<%%VALUE(Pendencias)%%>', safe_html($urow['Pendencias'], $fieldsAreEditable), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Pendencias)%%>', urlencode($urow['Pendencias']), $templateCode);
		$templateCode = str_replace('<%%VALUE(Solucao)%%>', safe_html($urow['Solucao'], $fieldsAreEditable), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Solucao)%%>', urlencode($urow['Solucao']), $templateCode);
	} else {
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Colaborador)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Colaborador)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Eleitor)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Eleitor)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Data)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Data)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Situacao)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Situacao)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Pedido)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Pedido)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Pendencias)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Pendencias)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(Solucao)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(Solucao)%%>', urlencode(''), $templateCode);
	}

	// process translations
	$templateCode = parseTemplate($templateCode);

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if(Request::val('dvprint_x') == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$hasSelectedId) {
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields
	$filterField = Request::val('FilterField');
	$filterOperator = Request::val('FilterOperator');
	$filterValue = Request::val('FilterValue');

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('Atendimentos');
	if($hasSelectedId) {
		$jdata = get_joined_record('Atendimentos', $selectedId);
		if($jdata === false) $jdata = get_defaults('Atendimentos');
		$rdata = $row;
	}
	$templateCode .= loadView('Atendimentos-ajax-cache', ['rdata' => $rdata, 'jdata' => $jdata]);

	// hook: Atendimentos_dv
	if(function_exists('Atendimentos_dv')) {
		$args = [];
		Atendimentos_dv(($hasSelectedId ? $selectedId : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}