<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Рейтинг популярности фабрик-производителей сантехники | «Плитка на дом»");
$APPLICATION->SetPageProperty("description", "Рейтинг популярности фабрик-производителей сантехники | «Плитка на дом»");
$APPLICATION->SetTitle("Рейтинг популярности фабрик-производителей сантехники");
$APPLICATION->IncludeFile("/include/brands_text_santekhnika.php",[],["MODE"=>"html"]);
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"popular_brands_page", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "11",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "PICTURE",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_HIT",
			1 => "",
		),
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "360000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"CUSTOM_SECTION_SORT" => array(
			"UF_HIT" => "DESC",
			"NAME" => "ASC",
		),
		"TYPE" => "FULL",
		"COUNT" => "500",
		"COMPONENT_TEMPLATE" => "popular_brands_page",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"FILTER_NAME" => "sectionsFilter",
		"CACHE_FILTER" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>