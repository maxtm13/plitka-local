<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $checkdate, $usergropus, $checktime, $dir, $seoID;

$sectionId = (isset($_REQUEST["sec_id"])) ? $_REQUEST["sec_id"] : omniGetSIDFromPageUrl(9, "/napolnye-pokrytiya/");

$settitle = SET_META_TITLE;

$setMeta = "N";

if(empty($settitle) && empty($seoID)){
	$setMeta = "Y";
	$APPLICATION->SetPageProperty("title", "Напольные покрытия: ламинат, паркет, массив по низким ценам | Купить напольные покрытия в интернет-магазине «Плитка на дом»");
	// $APPLICATION->SetPageProperty("keywords", "напольные покрытия для дома купить в москве");
	$APPLICATION->SetPageProperty("description", "Напольные покрытия для дома в интернет-магазине «Плитка на дом». Большой ассортимент линолеума, ламината, паркетной и инженерной доски. Низкие цены, быстрая доставка.");
	$APPLICATION->SetTitle("Напольные покрытия: ламинат, паркет, массив");
}
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");

global $arrFilter;
$arrFilter["ACTIVE"] = "Y";
$arrFilter["!PROPERTY_AVAILABILITY"] = [5044, 5649, 4914];

if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

if (isset($_REQUEST['set_filter']) || (substr_count($APPLICATION->GetCurPageParam(), 'set_filter=') > 0)) {
    
	/*---bgn 2017-02-07---*/
	
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
	
	echo "test";
	
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "product-list",
        [
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "9",
            "SECTION_ID" => $sectionId,
            "SECTION_CODE" => "",
            "SECTION_USER_FIELDS" => [
                0 => "UF_MORO_PHOTO",
                1 => "",
            ],
			 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
            "ELEMENT_SORT_FIELD" => $sort_by,
            "ELEMENT_SORT_ORDER" => $sort_order,
            "ELEMENT_SORT_FIELD2" => "name",
            "ELEMENT_SORT_ORDER2" => "asc",
            "FILTER_NAME" => "arrFilter",
            "INCLUDE_SUBSECTIONS" => "Y",
            "SHOW_ALL_WO_SECTION" => "Y",
            "HIDE_NOT_AVAILABLE" => "Y",
            "PAGE_ELEMENT_COUNT" => (!empty($_REQUEST['el_c'])) ? intval($_REQUEST['el_c']) : 40,
            "LINE_ELEMENT_COUNT" => "4",
            "PROPERTY_CODE" => [
                0 => "NIGHT_PRICE",
                1 => "",
            ],
            "OFFERS_LIMIT" => "1",
            "TEMPLATE_THEME" => "",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SHOW_DISCOUNT_PERCENT" => "Y",
            "SHOW_OLD_PRICE" => "Y",
            "SHOW_CLOSE_POPUP" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "360000",
            "CACHE_GROUPS" => "N",
            "SET_TITLE" => $setMeta,
            "SET_BROWSER_TITLE" => $setMeta,
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => $setMeta,
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => $setMeta,
            "META_DESCRIPTION" => "-",
            "ADD_SECTIONS_CHAIN" => $setMeta,
            "SET_STATUS_404" => "N",
            "CACHE_FILTER" => "Y",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRICE_CODE" => [
                0 => "BASE",
            ],
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/cart/",
            "USE_PRODUCT_QUANTITY" => "Y",
            "ADD_PROPERTIES_TO_BASKET" => "N",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRODUCT_PROPERTIES" => [
            ],
            "ADD_TO_BASKET_ACTION" => "ADD",
            "DISPLAY_COMPARE" => "N",
            "PAGER_TEMPLATE" => "arrows",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "ADD_PICT_PROP" => "-",
            "LABEL_PROP" => "-",
            "MESS_BTN_COMPARE" => "Сравнить",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "COMPONENT_TEMPLATE" => "product-list",
            "SEF_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "SET_LAST_MODIFIED" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "SHOW_404" => "N",
            "MESSAGE_404" => "",
            "CUSTOM_FILTER" => "",
            "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
            "BACKGROUND_IMAGE" => "-",
            "COMPATIBLE_MODE" => "Y",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
			  "PAGEN" => htmlspecialchars($_REQUEST['PAGEN_1'])
        ],
        false
    );

} else {
	if ($_SERVER["SCRIPT_URL"] == '/napolnye-pokrytiya/') {
		
		$APPLICATION->IncludeComponent("bitrix:catalog.section.list","category_menu",
			[
				"VIEW_MODE" => "TEXT",
				"SHOW_PARENT_NAME" => "Y",
				"IBLOCK_TYPE" => "services",
				"IBLOCK_ID" => "40",
				"SECTION_ID" => '54095',
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
				"TYPE" => "collect",
			], false	
		);
	}else{
		$APPLICATION->IncludeComponent(
		"bitrix:catalog", 
		"template1", 
		array(
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "9",
			"HIDE_NOT_AVAILABLE" => "N",
			"SECTION_ID_VARIABLE" => "SECTION_ID",
			"SEF_MODE" => "Y",
			"SEF_FOLDER" => "/napolnye-pokrytiya/",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "86400",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "N",
			"SET_STATUS_404" => "Y",
			"SET_TITLE" => "Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"ADD_ELEMENT_CHAIN" => "Y",
			"USE_ELEMENT_COUNTER" => "Y",
			"USE_FILTER" => "Y",
			"FILTER_NAME" => "arrFilter",
			"FILTER_FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_PROPERTY_CODE" => array(
				0 => "AVAILABILITY",
				1 => "",
			),
			"FILTER_PRICE_CODE" => array(
				0 => "BASE",
			),
			"FILTER_VIEW_MODE" => "VERTICAL",
			"USE_REVIEW" => "Y",
			"MESSAGES_PER_PAGE" => "10",
			"USE_CAPTCHA" => "Y",
			"REVIEW_AJAX_POST" => "N",
			"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
			"FORUM_ID" => "1",
			"URL_TEMPLATES_READ" => "",
			"SHOW_LINK_TO_FORUM" => "Y",
			"POST_FIRST_MESSAGE" => "N",
			"USE_COMPARE" => "N",
			"PRICE_CODE" => array(
				0 => "BASE",
			),
			"USE_PRICE_COUNT" => "N",
			"SHOW_PRICE_COUNT" => "1",
			"PRICE_VAT_INCLUDE" => "Y",
			"PRICE_VAT_SHOW_VALUE" => "N",
			"CONVERT_CURRENCY" => "N",
			"CURRENCY_ID" => "RUB",
			"BASKET_URL" => "/personal/cart/",
			"ACTION_VARIABLE" => "action",
			"PRODUCT_ID_VARIABLE" => "id",
			"USE_PRODUCT_QUANTITY" => "Y",
			"PRODUCT_QUANTITY_VARIABLE" => "quantity",
			"ADD_PROPERTIES_TO_BASKET" => "Y",
			"PRODUCT_PROPS_VARIABLE" => "prop",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRODUCT_PROPERTIES" => array(
			),
			"SHOW_TOP_ELEMENTS" => "N",
			"SECTION_COUNT_ELEMENTS" => "N",
			"SECTION_TOP_DEPTH" => "1",
			"SECTIONS_VIEW_MODE" => "TILE",
			"SECTIONS_SHOW_PARENT_NAME" => "Y",
			"PAGE_ELEMENT_COUNT" => "20",
			"LINE_ELEMENT_COUNT" => "4",
			"ELEMENT_SORT_FIELD" => "NAME",
			"ELEMENT_SORT_ORDER" => "asc",
			"ELEMENT_SORT_FIELD2" => "id",
			"ELEMENT_SORT_ORDER2" => "asc",
			"LIST_PROPERTY_CODE" => array(
			//	0 => "USE",
				1 => "SAMPLE",
				2 => "RESISTANCE",
				3 => "AVAILABILITY",
				4 => "NIGHT_PRICE",
				5 => "SHADE",
				6 => "WOOD",
				7 => "SIZE",
				8 => "NEWPRODUCT",
				9 => "SALELEADER",
				10 => "SPECIALOFFER",
				11 => "",
			),
			"INCLUDE_SUBSECTIONS" => "Y",
			"LIST_META_KEYWORDS" => "UF_METAKEYWORDS",
			"LIST_META_DESCRIPTION" => "UF_METADESC",
			"LIST_BROWSER_TITLE" => "UF_METATITLE",
			"DETAIL_PROPERTY_CODE" => array(
				0 => "226",
				1 => "227",
				2 => "228",
				3 => "231",
				4 => "232",
				5 => "233",
				6 => "234",
				7 => "235",
				8 => "236",
				9 => "237",
				10 => "238",
				11 => "239",
				12 => "240",
				13 => "241",
				14 => "242",
				15 => "243",
				16 => "244",
				17 => "245",
				18 => "264",
				19 => "269",
				20 => "276",
				21 => "277",
				22 => "278",
				23 => "279",
				24 => "281",
				25 => "324",
				26 => "325",
				27 => "326",
				28 => "327",
				29 => "328",
				30 => "329",
				31 => "330",
				32 => "331",
				33 => "365",
				34 => "USE",
				35 => "VID",
				36 => "DESIGN",
				37 => "LENGTH_MM",
				38 => "MEASURE",
				39 => "KVM_v_UPAC",
				40 => "RESISTANCE",
				41 => "AVAILABILITY",
				42 => "CHAMFER",
				43 => "NIGHT_PRICE",
				44 => "SHADE",
				45 => "OTTENOK_DEREVA",
				46 => "DENSITY",
				47 => "SURFACE",
				48 => "WOOD",
				49 => "MANUFACTURE",
				50 => "PROFILE",
				51 => "SIZE",
				52 => "UPAK_SIZE",
				53 => "MOUNT",
				54 => "SORT",
				55 => "STRUCTURE",
				56 => "STYLE",
				57 => "COUNTRY",
				58 => "GROWTH",
				59 => "HARDNESS",
				60 => "TYPE",
				61 => "CONNECTION",
				62 => "LAMINAT_TYPE",
				63 => "TYPE_LINOLEUM",
				64 => "THICKNESS_MM",
				65 => "WIDTH_MM",
				66 => "SHTUK_V_UPAC",
				67 => "230",
				68 => "",
			),
			"DETAIL_META_KEYWORDS" => "-",
			"DETAIL_META_DESCRIPTION" => "-",
			"DETAIL_BROWSER_TITLE" => "-",
			"DETAIL_DISPLAY_NAME" => "Y",
			"DETAIL_DETAIL_PICTURE_MODE" => "POPUP",
			"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
			"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
			"LINK_IBLOCK_TYPE" => "",
			"LINK_IBLOCK_ID" => "",
			"LINK_PROPERTY_SID" => "",
			"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
			"USE_ALSO_BUY" => "Y",
			"ALSO_BUY_ELEMENT_COUNT" => "4",
			"ALSO_BUY_MIN_BUYES" => "1",
			"USE_STORE" => "N",
			"USE_STORE_PHONE" => "Y",
			"USE_STORE_SCHEDULE" => "Y",
			"USE_MIN_AMOUNT" => "N",
			"STORE_PATH" => "/store/#store_id#",
			"MAIN_TITLE" => "Наличие на складах",
			"PAGER_TEMPLATE" => "arrows",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Товары",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
			"PAGER_SHOW_ALL" => "N",
			"TEMPLATE_THEME" => "site",
			"ADD_PICT_PROP" => "MORE_PHOTO",
			"LABEL_PROP" => "-",
			"SHOW_DISCOUNT_PERCENT" => "Y",
			"SHOW_OLD_PRICE" => "Y",
			"DETAIL_SHOW_MAX_QUANTITY" => "N",
			"MESS_BTN_BUY" => "Купить",
			"MESS_BTN_ADD_TO_BASKET" => "В корзину",
			"MESS_BTN_COMPARE" => "Сравнение",
			"MESS_BTN_DETAIL" => "Подробнее",
			"MESS_NOT_AVAILABLE" => "Нет в наличии",
			"DETAIL_USE_VOTE_RATING" => "Y",
			"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
			"DETAIL_USE_COMMENTS" => "N",
			"DETAIL_BLOG_USE" => "Y",
			"DETAIL_VK_USE" => "N",
			"DETAIL_FB_USE" => "Y",
			"DETAIL_FB_APP_ID" => "",
			"DETAIL_BRAND_USE" => "Y",
			"DETAIL_BRAND_PROP_CODE" => "-",
			"AJAX_OPTION_ADDITIONAL" => "",
			"SECTIONS_HIDE_SECTION_NAME" => "N",
			"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
			"COMPONENT_TEMPLATE" => "template1",
			"USE_MAIN_ELEMENT_SECTION" => "N",
			"SET_LAST_MODIFIED" => "N",
			"DETAIL_SET_CANONICAL_URL" => "N",
			"SHOW_DEACTIVATED" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"SHOW_404" => "N",
			"MESSAGE_404" => "",
			"SECTION_BACKGROUND_IMAGE" => "-",
			"DETAIL_BACKGROUND_IMAGE" => "-",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
			"HIDE_NOT_AVAILABLE_OFFERS" => "N",
			"USER_CONSENT" => "N",
			"USER_CONSENT_ID" => "0",
			"USER_CONSENT_IS_CHECKED" => "Y",
			"USER_CONSENT_IS_LOADED" => "N",
			"DETAIL_STRICT_SECTION_CHECK" => "N",
			"USE_GIFTS_DETAIL" => "Y",
			"USE_GIFTS_SECTION" => "Y",
			"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
			"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
			"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
			"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
			"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
			"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
			"GIFTS_SHOW_OLD_PRICE" => "Y",
			"GIFTS_SHOW_NAME" => "Y",
			"GIFTS_SHOW_IMAGE" => "Y",
			"GIFTS_MESS_BTN_BUY" => "Выбрать",
			"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
			"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
			"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
			"COMPATIBLE_MODE" => "Y",
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
				"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
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
/*
if (!empty($sotbitSeoMetaBreadcrumbTitle)) {
    $APPLICATION->AddChainItem($sotbitSeoMetaBreadcrumbTitle);
}
*/

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
