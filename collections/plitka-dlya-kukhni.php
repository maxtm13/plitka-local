<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
//	$APPLICATION->SetTitle("Керамическая плитка для кухни");
//	$APPLICATION->SetPageProperty("title", "Плитка Керамическая (Для Кухни) Купить По Лучшим Ценам За М2 В Москве!");
	// $APPLICATION->SetPageProperty("keywords", "плитка для кухни на пол напольная купить москва кафель красивая недорого с рисунком каталог цветная белая матовая черная");
//	$APPLICATION->SetPageProperty("description", "Широкий выбор коллекций красивой,модной,яркой керамической и кафельной плитки (на фартук,стены,пол) для кухни в каталоге интернет магазина plitkanadom");
//	$APPLICATION->AddChainItem('Плитка для кухни');
	//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 25);
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 25;
	?>
<?
if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}	
	?>
	<? /*
	<img src="https://www.plitkanadom.ru/upload/medialibrary/129/skidka_na_plitku.png" alt="Лучшие цены на керамическую плитку в Москве" style="max-width: 100%; margin:0 0 20px;" />
	*/ ?>
	<?
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
			  "SECTION_FIELDS" => [
					0 => "",
					1 => "",
			  ],
			  "SECTION_ID" => "",
			  "SECTION_URL" => "",
			  "SECTION_USER_FIELDS" => [
					0 => "UF_TOPTEXT",
					1 => "UF_MORO_PHOTO",
					2 => "UF_HEADER",
					3 => "UF_CATALOG_PRICE_1",
					4 => "UF_82",
					5 => "UF_91",
					6 => "UF_92",
					7 => "UF_ASSIGN",
					8 => "UF_ASSIGN_ONLY",
					9 => "UF_AVAILABILITY",
					10 => "",
			  ],
			  "SHOW_PARENT_NAME" => "N",
			  "TOP_DEPTH" => "3",
			  "VIEW_MODE" => "TILE",
			//  "RBS_SORT" => $rbs_sort,
			  "COMPONENT_TEMPLATE" => "section-list-catalog",
			  "MIN_FILTER_PRICE" => "100",
			  "MAX_FILTER_PRICE" => "10000",
			  "HIDE_SORT_PANEL" => "N",
			  "COMPOSITE_FRAME_MODE" => "A",
			  "COMPOSITE_FRAME_TYPE" => "AUTO",
			  "COLLECII" => "Y",
			 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		 ],
		 false
	); ?>
<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>