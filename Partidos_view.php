<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/Partidos.php');
	include_once(__DIR__ . '/Partidos_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('Partidos');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'Partidos';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`Partidos`.`id`" => "id",
		"`Partidos`.`Nome`" => "Nome",
		"`Partidos`.`Numero`" => "Numero",
		"`Partidos`.`Sigla`" => "Sigla",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`Partidos`.`id`',
		2 => 2,
		3 => '`Partidos`.`Numero`',
		4 => 4,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`Partidos`.`id`" => "id",
		"`Partidos`.`Nome`" => "Nome",
		"`Partidos`.`Numero`" => "Numero",
		"`Partidos`.`Sigla`" => "Sigla",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`Partidos`.`id`" => "ID",
		"`Partidos`.`Nome`" => "Nome",
		"`Partidos`.`Numero`" => "Numero",
		"`Partidos`.`Sigla`" => "Sigla",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`Partidos`.`id`" => "id",
		"`Partidos`.`Nome`" => "Nome",
		"`Partidos`.`Numero`" => "Numero",
		"`Partidos`.`Sigla`" => "Sigla",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`Partidos` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = (getLoggedAdmin() !== false);
	$x->AllowAdminShowSQL = 0;
	$x->RecordsPerPage = 20;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'Partidos_view.php';
	$x->TableTitle = 'Partidos';
	$x->TableIcon = 'resources/table_icons/entity.png';
	$x->PrimaryKey = '`Partidos`.`id`';

	$x->ColWidth = [150, 150, 150, ];
	$x->ColCaption = ['Nome', 'Numero', 'Sigla', ];
	$x->ColFieldName = ['Nome', 'Numero', 'Sigla', ];
	$x->ColNumber  = [2, 3, 4, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/Partidos_templateTV.html';
	$x->SelectedTemplate = 'templates/Partidos_templateTVS.html';
	$x->TemplateDV = 'templates/Partidos_templateDV.html';
	$x->TemplateDVP = 'templates/Partidos_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: Partidos_init
	$render = true;
	if(function_exists('Partidos_init')) {
		$args = [];
		$render = Partidos_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Partidos_header
	$headerCode = '';
	if(function_exists('Partidos_header')) {
		$args = [];
		$headerCode = Partidos_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: Partidos_footer
	$footerCode = '';
	if(function_exists('Partidos_footer')) {
		$args = [];
		$footerCode = Partidos_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
