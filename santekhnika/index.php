<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$sectionId = intval(($_REQUEST["sec_id"]) ? $_REQUEST["sec_id"] : omniGetSIDFromPageUrl(11));

$isSection = [];
if($sectionId>0){
	$isSection = CIBlockSection::GetList([], ["IBLOCK_ID"=>11, "ID" => $sectionId, "ACTIVE"=>"Y", 'CNT_ACTIVE'=>true], true, ["NAME","ELEMENT_CNT"])->Fetch();

	if($isSection["ELEMENT_CNT"]<1){
		\Bitrix\Iblock\Component\Tools::process404('Данная страница не существует!', true, true, true, false);
	}
}
$settitle = SET_META_TITLE;

$setMeta = "N";

if(empty($settitle)){
	$setMeta = "Y";
	$APPLICATION->SetPageProperty("title", "Купить сантехнику в интернет-магазине | Сантехника по низким ценам с доставкой по Москве и  другим городам России");
	// $APPLICATION->SetPageProperty("keywords", "сантехника по низким ценам купить заказать интернет магазин плитка на дом доставка москва россия");
	$APPLICATION->SetPageProperty("description", "Предлагаем дешево купить сантехнику. У нас низкие цены на сантехнику. Доставим сантехнику по Москве и области.");
	if($APPLICATION->GetCurDir() == "/santekhnika/"){
		$APPLICATION->SetTitle("Сантехника");	
	}
}
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");

global $arrFilter;
$arrFilter["!PROPERTY_AVAILABILITY"] = [5044, 5649, 4914];

if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

$sort_by = 'SHOW_COUNTER';
$sort_order = 'DESC';
		
	if(!empty($sess["sort"])){

		if($sess["sort"]["type"] == 'UF_CATALOG_PRICE_1'){
			$sort_by = "SCALED_PRICE_1";
		}
		if($sess["sort"]["sort"]["type"] == 'UF_HIT'){
			$sort_by = "SHOW_COUNTER";
		}
		if($sess["sort"]["sort"]["type"] == 'NAME'){
			$sort_by = "NAME";
		}
		if($sess["sort"]["sort"]["type"] == 'ID'){
			$sort_by = "ID";
		}
		$sort_order = $sess["sort"]["order"];
	}

if (isset($_REQUEST['set_filter']) || (substr_count($APPLICATION->GetCurPageParam(), 'set_filter=') > 0)) {
    $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"product-list", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "product-list",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"SORT_BY" => ($sess["sort"]["type"]?$sess["sort"]["type"]:"UF_HIT"),
		"SORT_ORDER" => ($sess["sort"]["order"]?$sess["sort"]["order"]:"DESC"),
		"IN_PAGE" => ($sess["inpage"]?$sess["inpage"]:"40"),
		"PAGE" => ($_SERVER["REDIRECT_URL"]??$_SERVER["REQUEST_URI"]),
		"PAGEN" => ($_REQUEST["PAGEN_2"]?$_REQUEST["PAGEN_2"]:$_REQUEST["PAGEN_1"]),
		"YEAR" => date("Y",strtotime(date("Y")."-01-01 -1year")),
		"ELEMENT_SORT_FIELD" => $sort_by,
		"ELEMENT_SORT_ORDER" => $sort_order,
		"ELEMENT_SORT_FIELD2" => "name",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "4",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "1",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => ($sess["inpage"]?$sess["inpage"]:"40"),
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "NIGHT_PRICE",
			1 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => $sectionId,
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_MORO_PHOTO",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"BACKGROUND_IMAGE" => "-",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILE_404" => ""
	),
	false
);

} else {
	if($sectionId < 1){
		if($APPLICATION->GetCurPage(false) != "/santekhnika/") {
			\Bitrix\Iblock\Component\Tools::process404(
			    '404 Не найдено',
			    true,
			    true,
			    true,
			    false
			);
		} else {
			$APPLICATION->IncludeComponent("bitrix:catalog.section.list","category_menu",
			[
				"VIEW_MODE" => "TEXT",
				"SHOW_PARENT_NAME" => "Y",
				"IBLOCK_TYPE" => "services",
				"IBLOCK_ID" => "40",
				"SECTION_ID" => '53406',
				"SECTION_CODE" => "",
				"SECTION_URL" => "",
				"COUNT_ELEMENTS" => "N",
				"TOP_DEPTH" => "3",
				"SECTION_FIELDS" => "",
				"SECTION_USER_FIELDS" => ['UF_*'],
				"ADD_SECTIONS_CHAIN" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "360000",
				"CACHE_NOTES" => "",
				"CACHE_GROUPS" => "N",
				"CUSTOM_SECTION_SORT" => ["SORT" => "ASC"],
				"TYPE" => "sant",
			], false
			);
		}
	}else{
		$APPLICATION->IncludeComponent(
			"bitrix:catalog", 
			"template1", 
			array(
				"ACTION_VARIABLE" => "action",
				"ADD_ELEMENT_CHAIN" => "Y",
				"ADD_PICT_PROP" => "MORE_PHOTO",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "Y",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"ALSO_BUY_ELEMENT_COUNT" => "4",
				"ALSO_BUY_MIN_BUYES" => "1",
				"BASKET_URL" => "/personal/cart/",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "360000",
				"CACHE_TYPE" => "A",
				"COMPONENT_TEMPLATE" => "template1",
				"CONVERT_CURRENCY" => "N",
				"CURRENCY_ID" => "RUB",
				"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
				"DETAIL_BACKGROUND_IMAGE" => "-",
				"DETAIL_BLOG_USE" => "Y",
				"DETAIL_BRAND_PROP_CODE" => "-",
				"DETAIL_BRAND_USE" => "Y",
				"DETAIL_BROWSER_TITLE" => "-",
				"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
				"DETAIL_DETAIL_PICTURE_MODE" => "POPUP",
				"DETAIL_DISPLAY_NAME" => "Y",
				"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
				"DETAIL_FB_APP_ID" => "",
				"DETAIL_FB_USE" => "Y",
				"DETAIL_META_DESCRIPTION" => "-",
				"DETAIL_META_KEYWORDS" => "-",
				"DETAIL_PROPERTY_CODE" => array(
					0 => "144",
					1 => "145",
					2 => "146",
					3 => "148",
					4 => "149",
					5 => "150",
					6 => "151",
					7 => "152",
					8 => "153",
					9 => "154",
					10 => "155",
					11 => "156",
					12 => "157",
					13 => "158",
					14 => "159",
					15 => "160",
					16 => "161",
					17 => "163",
					18 => "164",
					19 => "165",
					20 => "166",
					21 => "167",
					22 => "168",
					23 => "205",
					24 => "206",
					25 => "207",
					26 => "208",
					27 => "209",
					28 => "210",
					29 => "212",
					30 => "213",
					31 => "214",
					32 => "215",
					33 => "216",
					34 => "217",
					35 => "218",
					36 => "219",
					37 => "220",
					38 => "221",
					39 => "222",
					40 => "223",
					41 => "247",
					42 => "248",
					43 => "256",
					44 => "257",
					45 => "258",
					46 => "259",
					47 => "260",
					48 => "261",
					49 => "262",
					50 => "263",
					51 => "290",
					52 => "291",
					53 => "292",
					54 => "293",
					55 => "306",
					56 => "333",
					57 => "335",
					58 => "336",
					59 => "337",
					60 => "338",
					61 => "339",
					62 => "VID",
					63 => "MANUFACTURER",
					64 => "COLLECTION",
					65 => "USE",
					66 => "IN_WATER_CONNECT",
					67 => "COUNTRY",
					68 => "ATT_FORM",
					69 => "COLOR",
					70 => "AVAILABILITY",
					71 => "147",
					72 => "140",
					73 => "141",
					74 => "169",
					75 => "250",
					76 => "DESIGN",
					77 => "MEASURE",
					78 => "RESISTANCE",
					79 => "CHAMFER",
					80 => "SHADE",
					81 => "DENSITY",
					82 => "SURFACE",
					83 => "WOOD",
					84 => "PROFILE",
					85 => "SIZE",
					86 => "UPAK_SIZE",
					87 => "MOUNT",
					88 => "SORT",
					89 => "STRUCTURE",
					90 => "GROWTH",
					91 => "HARDNESS",
					92 => "TYPE",
					93 => "CONNECTION",
					94 => "",
				),
				"DETAIL_SET_CANONICAL_URL" => "Y",
				"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
				"DETAIL_SHOW_MAX_QUANTITY" => "N",
				"DETAIL_USE_COMMENTS" => "N",
				"DETAIL_USE_VOTE_RATING" => "Y",
				"DETAIL_VK_USE" => "N",
				"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_ORDER2" => "asc",
				"FILTER_FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "arrFilter",
				"FILTER_PRICE_CODE" => array(
					0 => "BASE",
				),
				"FILTER_PROPERTY_CODE" => array(
					0 => "154",
					1 => "155",
					2 => "",
				),
				"FILTER_VIEW_MODE" => "VERTICAL",
				"FORUM_ID" => "1",
				"HIDE_NOT_AVAILABLE" => "Y",
				"IBLOCK_ID" => "11",
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_SUBSECTIONS" => "Y",
				"LABEL_PROP" => "-",
				"LINE_ELEMENT_COUNT" => "4",
				"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
				"LINK_IBLOCK_ID" => "",
				"LINK_IBLOCK_TYPE" => "",
				"LINK_PROPERTY_SID" => "",
				"LIST_BROWSER_TITLE" => "UF_METATITLE",
				"LIST_META_DESCRIPTION" => "UF_METADESC",
				"LIST_META_KEYWORDS" => "UF_METAKEYWORDS",
				"LIST_PROPERTY_CODE" => array(
					0 => "SAMPLE",
					1 => "COLOR",
					12 => "MATERIAL",
				//	1 => "USE",
					2 => "NIGHT_PRICE",
					3 => "AVAILABILITY",
					4 => "RESISTANCE",
					5 => "SHADE",
					6 => "WOOD",
					7 => "SIZE",
					8 => "NEWPRODUCT",
					9 => "SALELEADER",
					10 => "SPECIALOFFER",
					11 => "",
				),
				"MAIN_TITLE" => "Наличие на складах",
				"MESSAGES_PER_PAGE" => "10",
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_COMPARE" => "Сравнение",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "arrows",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => $cat_el_count,
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
				"POST_FIRST_MESSAGE" => "N",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRICE_VAT_SHOW_VALUE" => "N",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPERTIES" => array(
				),
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"REVIEW_AJAX_POST" => "N",
				"SECTIONS_HIDE_SECTION_NAME" => "N",
				"SECTIONS_SHOW_PARENT_NAME" => "Y",
				"SECTIONS_VIEW_MODE" => "TILE",
				"SECTION_BACKGROUND_IMAGE" => "-",
				"SECTION_COUNT_ELEMENTS" => "N",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_TOP_DEPTH" => "1",
				"SEF_FOLDER" => "/santekhnika/",
				"SEF_MODE" => "Y",
				"SET_LAST_MODIFIED" => "N",
				"SET_STATUS_404" => "Y",
				"SET_TITLE" => "Y",
				"SHOW_404" => "Y",
				"SHOW_DEACTIVATED" => "N",
				"SHOW_DISCOUNT_PERCENT" => "Y",
				"SHOW_LINK_TO_FORUM" => "Y",
				"SHOW_OLD_PRICE" => "Y",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_TOP_ELEMENTS" => "N",
				"STORE_PATH" => "/store/#store_id#",
				"TEMPLATE_THEME" => "site",
				"URL_TEMPLATES_READ" => "",
				"USE_ALSO_BUY" => "N",
				"USE_CAPTCHA" => "Y",
				"USE_COMPARE" => "N",
				"USE_ELEMENT_COUNTER" => "Y",
				"USE_FILTER" => "Y",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_MIN_AMOUNT" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "Y",
				"USE_REVIEW" => "Y",
				"USE_STORE" => "N",
				"USE_STORE_PHONE" => "Y",
				"USE_STORE_SCHEDULE" => "Y",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"DETAIL_STRICT_SECTION_CHECK" => "N",
				"USE_GIFTS_DETAIL" => "Y",
				"USE_GIFTS_SECTION" => "Y",
				"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
				"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
				"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
				"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
				"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
				"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
				"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
				"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
				"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
				"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
				"GIFTS_SHOW_OLD_PRICE" => "Y",
				"GIFTS_SHOW_NAME" => "Y",
				"GIFTS_SHOW_IMAGE" => "Y",
				"GIFTS_MESS_BTN_BUY" => "Выбрать",
				"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
				"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
				"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
				"COMPATIBLE_MODE" => "Y",
				"USER_CONSENT" => "N",
				"USER_CONSENT_ID" => "0",
				"USER_CONSENT_IS_CHECKED" => "Y",
				"USER_CONSENT_IS_LOADED" => "N",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
						 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
						 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
						 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
						 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
						"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
					  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
				"SEF_URL_TEMPLATES" => array(
					"sections" => "",
					"section" => "#SECTION_CODE_PATH#",
					"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
					"compare" => "compare.php?action=#ACTION_CODE#",
					"smart_filter" => "#SECTION_CODE_PATH#filter/#SMART_FILTER_PATH#/apply/",
				),
				"VARIABLE_ALIASES" => array(
					"compare" => array(
						"ACTION_CODE" => "action",
					),
				)
			),
			false
		);
	}
}
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.main","product_slider", [
	"IBLOCK_TYPE" => "catalog",
	"TYPE" => "POPULAR",
	"IBLOCK_ID" => [11],
	"TITLE" => "Популярные товары сантехники",
	"LINK" => '/populyarnya-santekhnika/',
	"PAGE_ELEMENT_COUNT" => 12,
	"SORT" => "PROPERTY_POPULAR",
	"SORT_ORDER" => "DESC",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "360000",
	"CACHE_GROUPS" => "N",
	"NIGHT" => $checktime,
	"USER_GROUP" => $usergropus,
	"CHECK_DATE" => $checkdate,
	"CURENCY" => $ccurency,
	"YEAR" => date("Y"),
	"MARGIN" => "N"
]);
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.main","product_slider", [
	"IBLOCK_TYPE" => "catalog",
	"TYPE" => "NEW",
	"IBLOCK_ID" => [11],
	"TITLE" => "Новинки сантехники",
	"LINK" => '/novinki-santekhnika/',
	"PAGE_ELEMENT_COUNT" => 12,
	"SORT" => "DATE_CREATE",
	"SORT_ORDER" => "DESC",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "360000",
	"CACHE_GROUPS" => "N",
	"NIGHT" => $checktime,
	"USER_GROUP" => $usergropus,
	"CHECK_DATE" => $checkdate,
	"CURENCY" => $ccurency,
	"YEAR" => date("Y"),
	"MARGIN" => "N"
]);

$APPLICATION->IncludeComponent(
    "bitrix:catalog.main",
    "popluar_brands",
    Array(
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "360000",
        "CACHE_TYPE" => "A",
        "IBLOCK_ID" => [11],
        "IBLOCK_TYPE" => "catalog",
        "PAGE_ELEMENT_COUNT" => 20,
        "SORT" => "ID",
        "SORT_ORDER" => "ASC"
    )
);

?>

<?php
/*
if (!empty($sotbitSeoMetaBreadcrumbTitle)) {
    $APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle);
}
*/
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
