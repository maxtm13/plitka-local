<?
$sess = [];
if(!empty($_SESSION["SORT_VS_COUNT"])){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

$arParams = [
    "IBLOCK_TYPE" => "catalog",
    "IBLOCK_ID" => 4,
    "HIDE_NOT_AVAILABLE" => "N",
    "SECTION_ID_VARIABLE" => "SECTION_ID",
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/collections/",
    "AJAX_MODE" => "N",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "N",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => 360000,
    "CACHE_FILTER" => "Y",
    "CACHE_GROUPS" => "Y",
    "SET_STATUS_404" => "Y",
    "SET_TITLE" => "N",
    "ADD_SECTIONS_CHAIN" => "Y",
    "ADD_ELEMENT_CHAIN" => "Y",
    "USE_ELEMENT_COUNTER" => "Y",
    "USE_FILTER" => "Y",
    "FILTER_NAME" => "arrCustomFilter",
    "FILTER_PROPERTY_CODE" => [
        0 => "MANUFAC_FIL",
        1 => "USE",
        2 => "dop_params",
        3 => "SURFACE",
        4 => "SIZE_LENGTH",
        5 => "SIZE_WIDTH",
        6 => "DISCOUNT_PERCENT",
        7 => "COUNTRY",
        8 => "COLOR"
    ],
    "FILTER_PRICE_CODE" => Array
        (
            0 => 'BASE'
        ),

    "FILTER_VIEW_MODE" => 'VERTICAL',
    "USE_REVIEW" => "Y",
    "MESSAGES_PER_PAGE" => 10,
    "USE_CAPTCHA" => "Y",
    "REVIEW_AJAX_POST" => "N",
    "PATH_TO_SMILE" => '/bitrix/images/forum/smile/',
    "FORUM_ID" => 1,
    "URL_TEMPLATES_READ" => '',
    "SHOW_LINK_TO_FORUM" => "Y",
    "POST_FIRST_MESSAGE" => "N",
    "USE_COMPARE" => "N",
    "PRICE_CODE" => Array
        (
            0 => 'BASE',
        ),

    "USE_PRICE_COUNT" => "N",
    "SHOW_PRICE_COUNT" => 1,
    "PRICE_VAT_INCLUDE" => "Y",
    "PRICE_VAT_SHOW_VALUE" => "N",
    "CONVERT_CURRENCY" => "N",
    "CURRENCY_ID" => 'RUB',
    "BASKET_URL" => '/personal/cart/',
    "ACTION_VARIABLE" => 'action',
    "PRODUCT_ID_VARIABLE" => 'id',
    "USE_PRODUCT_QUANTITY" => "Y",
    "PRODUCT_QUANTITY_VARIABLE" => 'quantity',
    "ADD_PROPERTIES_TO_BASKET" => "Y",
    "PRODUCT_PROPS_VARIABLE" => 'prop',
    "PARTIAL_PRODUCT_PROPERTIES" => "Y",
    "PRODUCT_PROPERTIES" => '',
    "SHOW_TOP_ELEMENTS" => "N",
    "SECTION_COUNT_ELEMENTS" => "N",
    "SECTION_TOP_DEPTH" => 1,
    "SECTIONS_VIEW_MODE" => 'TILE',
    "SECTIONS_SHOW_PARENT_NAME" => "Y",
    "PAGE_ELEMENT_COUNT" => 20,
    "LINE_ELEMENT_COUNT" => 4,
    "ELEMENT_SORT_FIELD" => 'PROPERTYSORT_GROUP',
    "ELEMENT_SORT_ORDER" => 'asc',
    "ELEMENT_SORT_FIELD2" => "sort",
    "ELEMENT_SORT_ORDER2" => "asc",
    "ELEMENT_SORT_FIELD3" => "id",
    "ELEMENT_SORT_ORDER3" => "asc",
    "LIST_PROPERTY_CODE" => [
      2 => "NIGHT_PRICE",
      3 => "SURFACE",
      4 => "SIZE",
      5 => "SIZE_LENGTH",
      6 => "SIZE_WIDTH",
      7 => "RECOMMENDED_PRICE",
      9 => "COLOR",
      10 => "AVAILABILITY",
      11 => "HIT",
      12 => "UNIT",
      13 => "NEWPRODUCT",
      14 => "SALELEADER",
      15 => "SPECIALOFFER"
    ],
    "INCLUDE_SUBSECTIONS" => "N",
    "LIST_META_KEYWORDS" => "UF_METAKEYWORDS",
    "LIST_META_DESCRIPTION" => "UF_METADESC",
    "LIST_BROWSER_TITLE" => "UF_METATITLE",
    "DETAIL_PROPERTY_CODE" => [
      0 => 299,
      1 => 300,
      2 => 304,
      3 => "MANUFAC_FIL",
      4 => "USE",
      5 => "BRENDS",
      6 => "GROUP",
      7 => "UNITS_TMP",
      8 => "SURFACE",
      9 => "SIZE",
      10 => "SIZE_LENGTH",
      11 => "SIZE_WIDTH",
      12 => "rating",
      13 => "RISUNOK",
      14 => "COUNTRY",
      15 => "THICKNESS",
      16 => "FORM",
      17 => "COLOR",
      18 => "SHTUK_V_UPAC",
      19 => "AVAILABILITY",
      20 => "NEWPRODUCT",
      21 => "MATERIAL",
    ],
    "UF_FILEDS" => [
      1 => "UF_CATALOG_PRICE_1",
      2 => "UF_82",
      3 => "UF_91",
      4 => "UF_92"
    ],
    "DETAIL_META_KEYWORDS" => "-",
    "DETAIL_META_DESCRIPTION" => "-",
    "DETAIL_BROWSER_TITLE" => "-",
    "DETAIL_DISPLAY_NAME" => "Y",
    "DETAIL_DETAIL_PICTURE_MODE" => "POPUP",
    "DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
    "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
    "LINK_IBLOCK_TYPE" => '',
    "LINK_IBLOCK_ID" => '',
    "LINK_PROPERTY_SID" => '',
    "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
    "USE_ALSO_BUY" => "Y",
    "ALSO_BUY_ELEMENT_COUNT" => "4",
    "ALSO_BUY_MIN_BUYES" => "1",
    "USE_STORE" => "N",
    "USE_STORE_PHONE" => "Y",
    "USE_STORE_SCHEDULE" => "Y",
    "USE_MIN_AMOUNT" => "N",
    "STORE_PATH" => "/store/#store_id#",
    "MAIN_TITLE" => 'Наличие на складах',
    "PAGER_TEMPLATE" => "arrows",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Товары",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => 3600000,
    "PAGER_SHOW_ALL" => "N",
    "TEMPLATE_THEME" => "site",
    "ADD_PICT_PROP" => "-",
    "LABEL_PROP" => "-",
    "SHOW_DISCOUNT_PERCENT" => "Y",
    "SHOW_OLD_PRICE" => "Y",
    "DETAIL_SHOW_MAX_QUANTITY" => "N",
    "MESS_BTN_BUY" => "Купить",
    "MESS_BTN_ADD_TO_BASKET" => 'В корзину',
    "MESS_BTN_COMPARE" => "Сравнение",
    "MESS_BTN_DETAIL" => "Подробнее",
    "MESS_NOT_AVAILABLE" => 'Нет в наличии',
    "DETAIL_USE_VOTE_RATING" => "Y",
    "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
    "DETAIL_USE_COMMENTS" => "Y",
    "DETAIL_BLOG_USE" => "Y",
    "DETAIL_VK_USE" => "N",
    "DETAIL_FB_USE" => "Y",
    "DETAIL_FB_APP_ID" => '',
    "DETAIL_BRAND_USE" => "Y",
    "DETAIL_BRAND_PROP_CODE" => "BRENDS",
    "AJAX_OPTION_ADDITIONAL" => '',
    "SECTIONS_HIDE_SECTION_NAME" => "N",
    "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
    "COMPONENT_TEMPLATE" => "template1",
    "USE_MAIN_ELEMENT_SECTION" => "N",
    "SET_LAST_MODIFIED" => "N",
    "DETAIL_SET_CANONICAL_URL" => "Y",
    "SHOW_DEACTIVATED" => "N",
    "PAGER_BASE_LINK_ENABLE" => "N",
    "SHOW_404" => "Y",
    "MESSAGE_404" => '',
    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
    "DETAIL_STRICT_SECTION_CHECK" => "N",
    "SECTION_BACKGROUND_IMAGE" => "-",
    "DETAIL_BACKGROUND_IMAGE" => "-",
    "USE_GIFTS_DETAIL" => "Y",
    "USE_GIFTS_SECTION" => "Y",
    "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
    "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
    "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
    "GIFTS_DETAIL_BLOCK_TITLE" => 'Выберите один из подарков',
    "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
    "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
    "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
    "GIFTS_SECTION_LIST_BLOCK_TITLE" => 'Подарки к товарам этого раздела',
    "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
    "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
    "GIFTS_SHOW_OLD_PRICE" => "Y",
    "GIFTS_SHOW_NAME" => "Y",
    "GIFTS_SHOW_IMAGE" => "Y",
    "GIFTS_MESS_BTN_BUY" => "Выбрать",
    "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
    "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
    "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => 'Выберите один из товаров, чтобы получить подарок',
    "COMPATIBLE_MODE" => "Y",
    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
    "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
    "COMPOSITE_FRAME_MODE" => "Y",
    "COMPOSITE_FRAME_TYPE" => "DYNAMIC_WITH_STUB_LOADING",
    "USER_CONSENT" => "N",
    "USER_CONSENT_ID" => "0",
    "USER_CONSENT_IS_CHECKED" => "Y",
    "USER_CONSENT_IS_LOADED" => "N",
    "SORT_BY" => ($sess["sort"]["type"]?$sess["sort"]["type"]:"UF_HIT"),
		"SORT_ORDER" => ($sess["sort"]["order"]?$sess["sort"]["order"]:"DESC"),
		"IN_PAGE" => ($sess["inpage"]?$sess["inpage"]:"40"),
		"PAGE" => ($_SERVER["REDIRECT_URL"]??$_SERVER["REQUEST_URI"]),
		"PAGEN" => ($_REQUEST["PAGEN_2"]?$_REQUEST["PAGEN_2"]:$_REQUEST["PAGEN_1"]),
		"YEAR" => date("Y",strtotime(date("Y")."-01-01 -1year")),
    "SHOW_SKU_DESCRIPTION" => "N",
    "FILE_404" => '',
    "SEF_URL_TEMPLATES" => Array
        (
            "sections" => '',
            "section" => "#SECTION_CODE_PATH#",
            "element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
            "compare" => "compare.php?action=#ACTION_CODE#",
            "smart_filter" => "#SECTION_CODE_PATH#filter/#SMART_FILTER_PATH#/apply/",
        ),
    "VARIABLE_ALIASES" => Array
        (
            "compare" => Array
                (
                    "ACTION_CODE" => "action",
                )

        )
];
?>


<div class="workarea grid2x1">
    <div class="bx_content_section">
    <?
	if(!$_REQUEST['s']){
		$_REQUEST['s'] = 'pod';
	}

    if (empty($_REQUEST['s']) || substr($_REQUEST['s'], -1) == 'a') {
        $sort_order = 'ASC';
    } else {
        $sort_order = 'DESC';
    }
    
    if (empty($_REQUEST['s']) || in_array($_REQUEST['s'], ['na', 'nd'])) {
        $sort_by = 'NAME';
    } else {
        if (in_array($_REQUEST['s'], ['pa', 'pd'])) {
            $sort_by = 'UF_CATALOG_PRICE_1';
        } else {
            if (in_array($_REQUEST['s'], ['poa', 'pod'])) {
                $sort_by = 'UF_HIT';
            } else {
                $sort_by = 'ID';
            }
        }
    }
	
    if (\Bitrix\Main\Loader::includeModule("iblock")) {
        $rSec = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"]);
        $arSec = $rSec->Fetch();
    }

    if (isset($_REQUEST['set_filter'])) {
        $GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
    }
    $GLOBALS['arrFilter']['=UF_AVAILABILITY'] = false;

    $arSPagen = $APPLICATION->IncludeComponent(
        "omniweb:catalog.section.list",
        "section-list-catalog",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE" => "",
            "COUNT_ELEMENTS" => "N",
            "TOP_DEPTH" => "3",
            "SECTION_FIELDS" => ["", ""],
            "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
            "SHOW_PARENT_NAME" => ($arSec['DEPTH_LEVEL'] == 1) ? "N" : $arParams["SECTIONS_SHOW_PARENT_NAME"],
            "SECTION_URL" => "",
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
            "ADD_SECTIONS_CHAIN" => (($arSec['DEPTH_LEVEL'] == 1) ? 'N' : (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')),
            "FILTER_NAME" => "arrFilter",
            "SECTION_COUNT" => ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) ? "3000" : "60",
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
            "PAGER_TEMPLATE" => "arrows",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Разделы",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "FILTER_SORT_PANEL" => "Y",
            'SEC_SORT_BY' => ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) ? "NAME" : $sort_by,
            'SEC_SORT_ORDER' => ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) ? "ASC" : $sort_order,
            'HIDE_SORT_PANEL' => ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) ? "Y" : 'N',
            'HIDE_SEC_PRICE' => ($arSec['DEPTH_LEVEL'] == 1) ? "Y" : "N",
            'NO_WRAPPER' => (isset($_REQUEST['set_filter'])) ? 'Y' : 'N',
                            "SORT_BY" => $arParams["SORT_BY"],
                            "SORT_ORDER" => $arParams["SORT_ORDER"],
                            "IN_PAGE" => $arParams["IN_PAGE"],
                            "PAGE" => $arParams["PAGE"],
                    "BRANDS" => "Y",
                        "PAGEN" => $arParams["PAGEN"],
                        "YEAR" => $arParams["YEAR"],
                        "NEED_DEPTH" => $arParams["NEED_DEPTH"],
        ],
        $component
    );
    $APPLICATION->SetTitle("Керамическая плитка");
    ?>

    </div>
    <div style="clear: both;"></div>
</div>