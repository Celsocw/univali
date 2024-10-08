<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/Pessoas.php');
	include_once(__DIR__ . '/Pessoas_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('Pessoas');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'Pessoas';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`Pessoas`.`Id`" => "Id",
		"`Pessoas`.`Nome`" => "Nome",
		"IF(    CHAR_LENGTH(`Estados1`.`Nome`) || CHAR_LENGTH(`Estados1`.`Sigla`), CONCAT_WS('',   `Estados1`.`Nome`, '    -    ', `Estados1`.`Sigla`), '') /* Estado */" => "Estado",
		"IF(    CHAR_LENGTH(`Municipios1`.`Nome`), CONCAT_WS('',   `Municipios1`.`Nome`), '') /* Cidade */" => "Cidade",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"`Pessoas`.`Rua`" => "Rua",
		"`Pessoas`.`numero`" => "numero",
		"`Pessoas`.`CEP`" => "CEP",
		"`Pessoas`.`Contato`" => "Contato",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "profissao",
		"`Pessoas`.`Email`" => "Email",
		"`Pessoas`.`Midias`" => "Midias",
		"`Pessoas`.`Obs`" => "Obs",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`Pessoas`.`Id`',
		2 => 2,
		3 => 3,
		4 => '`Municipios1`.`Nome`',
		5 => '`Bairro1`.`Nome`',
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`Pessoas`.`Id`" => "Id",
		"`Pessoas`.`Nome`" => "Nome",
		"IF(    CHAR_LENGTH(`Estados1`.`Nome`) || CHAR_LENGTH(`Estados1`.`Sigla`), CONCAT_WS('',   `Estados1`.`Nome`, '    -    ', `Estados1`.`Sigla`), '') /* Estado */" => "Estado",
		"IF(    CHAR_LENGTH(`Municipios1`.`Nome`), CONCAT_WS('',   `Municipios1`.`Nome`), '') /* Cidade */" => "Cidade",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"`Pessoas`.`Rua`" => "Rua",
		"`Pessoas`.`numero`" => "numero",
		"`Pessoas`.`CEP`" => "CEP",
		"`Pessoas`.`Contato`" => "Contato",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "profissao",
		"`Pessoas`.`Email`" => "Email",
		"`Pessoas`.`Midias`" => "Midias",
		"`Pessoas`.`Obs`" => "Obs",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`Pessoas`.`Id`" => "Id",
		"`Pessoas`.`Nome`" => "Nome",
		"IF(    CHAR_LENGTH(`Estados1`.`Nome`) || CHAR_LENGTH(`Estados1`.`Sigla`), CONCAT_WS('',   `Estados1`.`Nome`, '    -    ', `Estados1`.`Sigla`), '') /* Estado */" => "Estado",
		"IF(    CHAR_LENGTH(`Municipios1`.`Nome`), CONCAT_WS('',   `Municipios1`.`Nome`), '') /* Cidade */" => "Cidade",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"`Pessoas`.`Rua`" => "Rua",
		"`Pessoas`.`numero`" => "Numero",
		"`Pessoas`.`CEP`" => "CEP",
		"`Pessoas`.`Contato`" => "Telefone",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "Profiss&#227;o",
		"`Pessoas`.`Email`" => "E-mail",
		"`Pessoas`.`Midias`" => "Midias Sociais",
		"`Pessoas`.`Obs`" => "Obs",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`Pessoas`.`Id`" => "Id",
		"`Pessoas`.`Nome`" => "Nome",
		"IF(    CHAR_LENGTH(`Estados1`.`Nome`) || CHAR_LENGTH(`Estados1`.`Sigla`), CONCAT_WS('',   `Estados1`.`Nome`, '    -    ', `Estados1`.`Sigla`), '') /* Estado */" => "Estado",
		"IF(    CHAR_LENGTH(`Municipios1`.`Nome`), CONCAT_WS('',   `Municipios1`.`Nome`), '') /* Cidade */" => "Cidade",
		"IF(    CHAR_LENGTH(`Bairro1`.`Nome`), CONCAT_WS('',   `Bairro1`.`Nome`), '') /* Bairro */" => "Bairro",
		"`Pessoas`.`Rua`" => "Rua",
		"`Pessoas`.`numero`" => "numero",
		"`Pessoas`.`CEP`" => "CEP",
		"`Pessoas`.`Contato`" => "Contato",
		"IF(    CHAR_LENGTH(`Profissoes1`.`Profissao`) || CHAR_LENGTH(`Profissoes1`.`Seguimento`), CONCAT_WS('',   `Profissoes1`.`Profissao`, '   -   ', `Profissoes1`.`Seguimento`), '') /* Profiss&#227;o */" => "profissao",
		"`Pessoas`.`Email`" => "Email",
		"`Pessoas`.`Midias`" => "Midias",
		"`Pessoas`.`Obs`" => "Obs",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['Estado' => 'Estado', 'Cidade' => 'Cidade', 'Bairro' => 'Bairro', 'profissao' => 'Profiss&#227;o', ];

	$x->QueryFrom = "`Pessoas` LEFT JOIN `Estados` as Estados1 ON `Estados1`.`id`=`Pessoas`.`Estado` LEFT JOIN `Municipios` as Municipios1 ON `Municipios1`.`Id`=`Pessoas`.`Cidade` LEFT JOIN `Bairro` as Bairro1 ON `Bairro1`.`Id`=`Pessoas`.`Bairro` LEFT JOIN `Profissoes` as Profissoes1 ON `Profissoes1`.`id`=`Pessoas`.`profissao` ";
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
	$x->ScriptFileName = 'Pessoas_view.php';
	$x->TableTitle = 'Cadastros';
	$x->TableIcon = 'resources/table_icons/group_add.png';
	$x->PrimaryKey = '`Pessoas`.`Id`';
	$x->DefaultSortField = '2';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Nome', 'Estado', 'Cidade', 'Bairro', 'Rua', 'Telefone', 'Profiss&#227;o', 'E-mail', ];
	$x->ColFieldName = ['Nome', 'Estado', 'Cidade', 'Bairro', 'Rua', 'Contato', 'profissao', 'Email', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 9, 10, 11, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/Pessoas_templateTV.html';
	$x->SelectedTemplate = 'templates/Pessoas_templateTVS.html';
	$x->TemplateDV = 'templates/Pessoas_templateDV.html';
	$x->TemplateDVP = 'templates/Pessoas_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: Pessoas_init
	$render = true;
	if(function_exists('Pessoas_init')) {
		$args = [];
		$render = Pessoas_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Pessoas_header
	$headerCode = '';
	if(function_exists('Pessoas_header')) {
		$args = [];
		$headerCode = Pessoas_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: Pessoas_footer
	$footerCode = '';
	if(function_exists('Pessoas_footer')) {
		$args = [];
		$footerCode = Pessoas_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
