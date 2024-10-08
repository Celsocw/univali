<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/Colaboradores.php');
	include_once(__DIR__ . '/Colaboradores_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('Colaboradores');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'Colaboradores';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`Colaboradores`.`Id`" => "Id",
		"IF(    CHAR_LENGTH(`Pessoas1`.`Nome`), CONCAT_WS('',   `Pessoas1`.`Nome`), '') /* Nome */" => "Nome",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "Profissao",
		"IF(    CHAR_LENGTH(`Funcoes1`.`Nome`), CONCAT_WS('',   `Funcoes1`.`Nome`), '') /* Fun&#231;&#227;o */" => "Funcao",
		"IF(    CHAR_LENGTH(`Pessoas2`.`Nome`) || CHAR_LENGTH(`Funcoes2`.`Nome`), CONCAT_WS('',   `Pessoas2`.`Nome`, '   -   ', `Funcoes2`.`Nome`), '') /* Responsavel */" => "Responsavel",
		"`Colaboradores`.`Obs`" => "Obs",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`Colaboradores`.`Id`',
		2 => '`Pessoas1`.`Nome`',
		3 => 3,
		4 => 4,
		5 => '`Funcoes1`.`Nome`',
		6 => 6,
		7 => 7,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`Colaboradores`.`Id`" => "Id",
		"IF(    CHAR_LENGTH(`Pessoas1`.`Nome`), CONCAT_WS('',   `Pessoas1`.`Nome`), '') /* Nome */" => "Nome",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "Profissao",
		"IF(    CHAR_LENGTH(`Funcoes1`.`Nome`), CONCAT_WS('',   `Funcoes1`.`Nome`), '') /* Fun&#231;&#227;o */" => "Funcao",
		"IF(    CHAR_LENGTH(`Pessoas2`.`Nome`) || CHAR_LENGTH(`Funcoes2`.`Nome`), CONCAT_WS('',   `Pessoas2`.`Nome`, '   -   ', `Funcoes2`.`Nome`), '') /* Responsavel */" => "Responsavel",
		"`Colaboradores`.`Obs`" => "Obs",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`Colaboradores`.`Id`" => "Id",
		"IF(    CHAR_LENGTH(`Pessoas1`.`Nome`), CONCAT_WS('',   `Pessoas1`.`Nome`), '') /* Nome */" => "Nome",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "Profiss&#227;o",
		"IF(    CHAR_LENGTH(`Funcoes1`.`Nome`), CONCAT_WS('',   `Funcoes1`.`Nome`), '') /* Fun&#231;&#227;o */" => "Fun&#231;&#227;o",
		"IF(    CHAR_LENGTH(`Pessoas2`.`Nome`) || CHAR_LENGTH(`Funcoes2`.`Nome`), CONCAT_WS('',   `Pessoas2`.`Nome`, '   -   ', `Funcoes2`.`Nome`), '') /* Responsavel */" => "Responsavel",
		"`Colaboradores`.`Obs`" => "Obs",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`Colaboradores`.`Id`" => "Id",
		"IF(    CHAR_LENGTH(`Pessoas1`.`Nome`), CONCAT_WS('',   `Pessoas1`.`Nome`), '') /* Nome */" => "Nome",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "Profissao",
		"IF(    CHAR_LENGTH(`Funcoes1`.`Nome`), CONCAT_WS('',   `Funcoes1`.`Nome`), '') /* Fun&#231;&#227;o */" => "Funcao",
		"IF(    CHAR_LENGTH(`Pessoas2`.`Nome`) || CHAR_LENGTH(`Funcoes2`.`Nome`), CONCAT_WS('',   `Pessoas2`.`Nome`, '   -   ', `Funcoes2`.`Nome`), '') /* Responsavel */" => "Responsavel",
		"`Colaboradores`.`Obs`" => "Obs",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['Nome' => 'Nome', 'Profissao' => 'Profiss&#227;o', 'Funcao' => 'Fun&#231;&#227;o', 'Responsavel' => 'Responsavel', ];

	$x->QueryFrom = "`Colaboradores` LEFT JOIN `Pessoas` as Pessoas1 ON `Pessoas1`.`Id`=`Colaboradores`.`Nome` LEFT JOIN `Profissoes` as Profissoes1 ON `Profissoes1`.`id`=`Colaboradores`.`Profissao` LEFT JOIN `Funcoes` as Funcoes1 ON `Funcoes1`.`Id`=`Colaboradores`.`Funcao` LEFT JOIN `Colaboradores` as Colaboradores1 ON `Colaboradores1`.`Id`=`Colaboradores`.`Responsavel` LEFT JOIN `Pessoas` as Pessoas2 ON `Pessoas2`.`Id`=`Colaboradores1`.`Nome` LEFT JOIN `Funcoes` as Funcoes2 ON `Funcoes2`.`Id`=`Colaboradores1`.`Funcao` LEFT JOIN `Bairro` as Bairro1 ON `Bairro1`.`Id`=`Pessoas1`.`Bairro` ";
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
	$x->ScriptFileName = 'Colaboradores_view.php';
	$x->TableTitle = 'Colaboradores';
	$x->TableIcon = 'resources/table_icons/premium_support.png';
	$x->PrimaryKey = '`Colaboradores`.`Id`';

	$x->ColWidth = [150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Nome', 'Bairro', 'Profiss&#227;o', 'Fun&#231;&#227;o', 'Responsavel', ];
	$x->ColFieldName = ['Nome', 'Bairro', 'Profissao', 'Funcao', 'Responsavel', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/Colaboradores_templateTV.html';
	$x->SelectedTemplate = 'templates/Colaboradores_templateTVS.html';
	$x->TemplateDV = 'templates/Colaboradores_templateDV.html';
	$x->TemplateDVP = 'templates/Colaboradores_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: Colaboradores_init
	$render = true;
	if(function_exists('Colaboradores_init')) {
		$args = [];
		$render = Colaboradores_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Colaboradores_header
	$headerCode = '';
	if(function_exists('Colaboradores_header')) {
		$args = [];
		$headerCode = Colaboradores_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: Colaboradores_footer
	$footerCode = '';
	if(function_exists('Colaboradores_footer')) {
		$args = [];
		$footerCode = Colaboradores_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
