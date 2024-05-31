<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>70000){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
	$dpage = '';
	if ($_GET['PAGEN_1'] > 1) {
		 $dpage = " Страница {$_GET['PAGEN_1']}.";
	}
	$APPLICATION->SetPageProperty("title", "Керамическая Плитка Для Ванной Комнаты Купить По Лучшим Ценам В Москве!");
	// $APPLICATION->SetPageProperty("keywords", "кафель для ванной комнаты плитка пол стены напольная настенная купить москва недорого стоимость цветная");
	$APPLICATION->SetPageProperty("description",
		 "Широкий выбор красивой керамической плитки, кафеля для ванны и туалета по лучшей стоимости за м2 в каталоге интернет магазина plitkanadom с доставкой по Москве и в регионы {$dpage}");
//	$APPLICATION->AddChainItem('Плитка для ванной'); ?><?
//	$APPLICATION->SetTitle("Плитка для ванной комнаты");
	//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 24);
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 24;
	?>
	<?
if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

	$APPLICATION->IncludeComponent(
		 "omniweb:catalog.section.list",
		 "section-list-catalog",
		 [
			  "ADD_SECTIONS_CHAIN" => "N",
			  "CACHE_GROUPS" => "N",
			  "CACHE_TIME" => "360000",
			  "CACHE_TYPE" => "A",
			  "COUNT_ELEMENTS" => "N",
			  "DISPLAY_BOTTOM_PAGER" => "Y",
			  "DISPLAY_TOP_PAGER" => "N",
			  "FILTER_NAME" => "arrFilter",
			  "FILTER_SORT_PANEL" => "Y",
			  "HIDE_SECTION_NAME" => "N",
			  "IBLOCK_ID" => "4",
			  "IBLOCK_TYPE" => "catalog",
			  "PAGER_DESC_NUMBERING" => "N",
			  "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			  "PAGER_SHOW_ALL" => "N",
			  "PAGER_SHOW_ALWAYS" => "N",
			  "PAGER_TEMPLATE" => "arrows",
			  "PAGER_TITLE" => "Разделы",
			  "SECTION_CODE" => "",
			  "SECTION_COUNT" => "40",
			  "SECTION_FIELDS" => ["", ""],
			  "SECTION_ID" => "",
			  "SECTION_URL" => "",
			  "SECTION_USER_FIELDS" => [
					"UF_HEADER",
					"UF_MORO_PHOTO",
					"UF_82",
					'UF_91',
					'UF_92',
					'UF_ASSIGN',
					'UF_ASSIGN_ONLY',
					'UF_CATALOG_PRICE_1',
					'UF_AVAILABILITY',
					'UF_TOPTEXT'
			  ],
			  "SHOW_PARENT_NAME" => "N",
			  "TOP_DEPTH" => "3",
			  "VIEW_MODE" => "TILE",
		//	  'RBS_SORT' => $rbs_sort,
			  "COLLECII" => "Y",
			 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		 ]
	); ?>
<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
