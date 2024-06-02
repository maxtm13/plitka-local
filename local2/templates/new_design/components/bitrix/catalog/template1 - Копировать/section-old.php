<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (!$arParams['FILTER_VIEW_MODE']) {
    $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
}

/**
 * Алфавит брендов в текущем разделе
 
$APPLICATION->IncludeComponent(
    "custom:catalog.section.brand.list",
    "",
    ["IBLOCK_ID" => $arParams["IBLOCK_ID"]],
    false
);
*/

$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');
$verticalGrid = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
if ($verticalGrid) { ?>
    <div class="workarea grid2x1">
<? }
/*
    if ($arParams['USE_FILTER'] == 'Y') {

        $arFilter = [
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "GLOBAL_ACTIVE" => "Y",
        ];
        if (0 < intval($arResult["VARIABLES"]["SECTION_ID"])) {
            $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
        } elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"]) {
            $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
        }

        $obCache = new CPHPCache();
        if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog")) {
            $arCurSection = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            $arCurSection = [];
            if (\Bitrix\Main\Loader::includeModule("iblock")) {
                $dbRes = CIBlockSection::GetList([], $arFilter, false, ["ID"]);

                if (defined("BX_COMP_MANAGED_CACHE")) {
                    global $CACHE_MANAGER;
                    $CACHE_MANAGER->StartTagCache("/iblock/catalog");

                    if ($arCurSection = $dbRes->Fetch()) {
                        $CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams["IBLOCK_ID"]);
                    }
                    $CACHE_MANAGER->EndTagCache();
                } else {
                    if (!$arCurSection = $dbRes->Fetch()) {
                        $arCurSection = [];
                    }
                }
            }
            $obCache->EndDataCache($arCurSection);
        }
        if (!isset($arCurSection)) {
            $arCurSection = [];  // НЕ ясно для чего это используется! 
        }
        if ($verticalGrid) { ?>
            <div class="bx_sidebar">
        <? } ?>
        <? if ($verticalGrid) { ?>
            </div> <? // .bx_sidebar ?>
        <? }
    }
	*/
    if ($verticalGrid) { ?>
    <div class="bx_content_section">

        <? } ?>
        <?
		 /*
        $APPLICATION->IncludeComponent(
            "sotbit:seo.meta.tags",
            ".default",
            [
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CNT_TAGS" => "",
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SORT" => "CONDITIONS",
                "SORT_ORDER" => "desc",
                "COMPONENT_TEMPLATE" => ".default",
            ]
        );
		  */

        ?>
        <? if (!isset($_REQUEST['set_filter'])) {
            $GLOBALS['arrFilter']['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];
        }
        /*$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 2;*/
        ?>
        <? if ($arParams['IBLOCK_ID'] == CATALOG_ID) {
	
			if(!$_REQUEST['s']){
				$_REQUEST['s'] = 'pod';
			}
            // для плитки подключаем кастомизированный компонент, умный фильтр осуществляет поиск по разделам, для которых дулируются значения свойств товаров
            /*---bgn 2015-07-02---*/
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
	
            /*---end 2015-07-02---*/
            /*---bgn 2016-07-06---*/
            if (\Bitrix\Main\Loader::includeModule("iblock")) {
                $rSec = CIBlockSection::GetByID($arResult["VARIABLES"]["SECTION_ID"]);
                $arSec = $rSec->Fetch();
            }
            /*---end 2016-07-06---*/ ?>
            <?php if ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) {
				//выводим все разделы 3 ур. Страны
				/*
Комментарий выше не ясен - так как не обнаружено в каких местах этот блок выводится
*/
				
                $GLOBALS['arrCountrySectionsFilter'] = ['DEPTH_LEVEL' => 3];
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
                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                        "SECTION_URL" => "",
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                        "FILTER_NAME" => "arrCountrySectionsFilter",
                        "SECTION_COUNT" => "40",
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
                        'SEC_SORT_BY' => $sort_by,
                        'SEC_SORT_ORDER' => $sort_order,
                        'NO_WRAPPER' => 'Y',
								 "SORT_BY" => $arParams["SORT_BY"],
								 "SORT_ORDER" => $arParams["SORT_ORDER"],
								 "IN_PAGE" => $arParams["IN_PAGE"],
								 "PAGE" => $arParams["PAGE"],
			  					"PAGEN" => $arParams["PAGEN"],
			  					"YEAR" => $arParams["YEAR"],
							   "NEED_DEPTH" => $arParams["NEED_DEPTH"],
                    ],
                    $component
                ); ?>

                <p>&nbsp;</p>
                <style>
                    .h3 {
                        font-size: 18px;
                        font-weight: normal;
                        color: rgb(193, 92, 31);
                    }
                </style>
                <div class="h3"><?php echo $arSec['NAME'] . ' ' . GetMessage('BY_MANUFACTURER'); ?></div>
            <?php }

            if (isset($_REQUEST['set_filter'])) {
                $GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
            }
            $GLOBALS['arrFilter']['=UF_AVAILABILITY'] = false;
/*
Выводится в коллекции по типу /collections/italyanskaya-plitka/vallelunga/rialto
блок вывода картинок коллекции и её категорий справа
*/
		?>
            <? $arSPagen = $APPLICATION->IncludeComponent(
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
                    "SECTION_COUNT" => /*(strpos($arResult["VARIABLES"]["SECTION_CODE_PATH"],"/")=== FALSE) ? "40" :*/
                        ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) ? "3000" : "60",
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
                    "DISPLAY_BOTTOM_PAGER" => ($arSec['DEPTH_LEVEL'] == 1) ? "N" : "Y",
                    "PAGER_TITLE" => "Разделы",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
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
            ); ?>
        <? } else {
			
			$showSectionsList = false; 
						 
            if (empty($arResult["VARIABLES"]["SECTION_ID"]) || (!empty($arResult["VARIABLES"]["SECTION_ID"]) && !in_array($arParams['IBLOCK_ID'], array(CATALOG_FLOOR_ID, CATALOG_SANTEH_ID)))) {
                //отображаем список разделов для главной каталога и не разделов напольных и сантехники
                $showSectionsList = true;
            }
            $addSectionsChain = 'Y';
            if (!$showSectionsList && in_array($arParams['IBLOCK_ID'], array(CATALOG_FLOOR_ID, CATALOG_SANTEH_ID))) {
                //для разделов напольных и сантехники включаем раздел в цепочку навигации
                $addSectionsChain = 'Y';
            }
	
	
            if ($showSectionsList && !in_array($_SERVER["SCRIPT_URL"] , ['/sukhie-stroitelnye-smesi/', '/napolnye-pokrytiya/', '/collections/', '/santekhnika/'] )) {
				
				$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
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
                        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                        "SECTION_URL" => "",
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                        "FILTER_NAME" => "arrFilter",
                        "SECTION_COUNT" => "40",
                        "SECTION_USER_FIELDS" => ["UF_HEADER", "UF_MORO_PHOTO", "UF_TOPTEXT", "UF_TOP_TEXT"],
                        "PAGER_TEMPLATE" => "arrows",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Разделы",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
								 "SORT_BY" => $arParams["SORT_BY"],
								 "SORT_ORDER" => $arParams["SORT_ORDER"],
								 "IN_PAGE" => $arParams["IN_PAGE"],
								 "PAGE" => $arParams["PAGE"],
			  					"PAGEN" => $arParams["PAGEN"],
			  					"YEAR" => $arParams["YEAR"],
                    ],
                    $component
                ); ?>
            <? } ?>
        <? } ?>
		 
	<?	require($_SERVER["DOCUMENT_ROOT"]."/include/sort_inpage.php");
		
		$isparams = [
			"IBLOCK_TYPE" => "catalog",
			"TYPE" => "JUST",
			"IBLOCK_ID" => [$arParams["IBLOCK_ID"]],
			"PAGE_ELEMENT_COUNT" => ($info["inpage"] ?? 40),
			"PAGE" => ($arParams["PAGEN"] ?? 1),
			"SORT" => ($info["sort-product"][0] ?? "ID"),
			"SORT_ORDER" => ($info["sort-product"][1] ?? "DESC"),
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "360000",
			"CACHE_GROUPS" => "N",
			"NIGHT" => $arParams["NIGHT"],
			"CHECK_DATE" => $arParams["CHECK_DATE"],
			"YEAR" => $arParams["IS_YEAR"],
			"MARGIN" => "N",
			"IS_FILTER" => $arParams["IS_FILTER"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"]
		];
		
		//$APPLICATION->IncludeComponent("bitrix:catalog.main","product_list", $isparams);
		
		
	?>
    <?
		
        $intSectionID = 0;
        //---bgn 2017-02-07---
        if (empty($_REQUEST['s'])) {
            $_REQUEST['s'] = 'na';
        } //нужно, чтобы установить правильное значение в списке сортировки и сортировки
        if (!empty($_REQUEST['s'])) {
            if (empty($_REQUEST['s']) || substr($_REQUEST['s'], -1) == 'a') {
                $sort_order = 'ASC';
            } else {
                $sort_order = 'DESC';
            }
            if (empty($_REQUEST['s']) || in_array($_REQUEST['s'],
                    ['na', 'nd'])) {
                $sort_by = 'NAME'; //'DATE_CREATE';
            } else {
                if (in_array($_REQUEST['s'], ['pa', 'pd'])) {
                    $sort_by = 'catalog_PRICE_1';
                } else {
                    if (in_array($_REQUEST['s'], ['poa', 'pod'])) {
                        $sort_by = 'SHOW_COUNTER';
                    } else {
                        $sort_by = 'DATE_CREATE'; //'NAME';
                    }
                }
            }
        } else {
            $sort_by = $arParams["ELEMENT_SORT_FIELD"];
            $sort_order = $arParams["ELEMENT_SORT_ORDER"];
        }
        //---end 2017-02-07---

        if ($arParams["IBLOCK_ID"] == CATALOG_ID && $arSec['DEPTH_LEVEL'] == 3) {
            $pageElementCount = MAX_PAGE_ELEMENT_COUNT;
        } else {
            $pageElementCount = $arParams["PAGE_ELEMENT_COUNT"];
        }
		
		
		// тут выводятся товары
		 global $arrCustomFilter;
		
			$sort_by = 'SHOW_COUNTER';
			$sort_order = 'DESC';
		
			if(!empty($arParams["SORT_BY"])){
					
					if($arParams["SORT_BY"] == 'UF_CATALOG_PRICE_1'){
						$sort_by = "SCALED_PRICE_1";
					}
					if($arParams["SORT_BY"] == 'UF_HIT'){
						$sort_by = "SHOW_COUNTER";
					}
					if($arParams["SORT_BY"] == 'NAME'){
						$sort_by = "NAME";
					}
					if($arParams["SORT_BY"] == 'ID'){
						$sort_by = "ID";
					}
					$sort_order = $arParams["SORT_ORDER"];

				}
		
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"",
					[
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
						"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
						"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
						"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
						"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
						"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
						"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
						"BASKET_URL" => $arParams["BASKET_URL"],
						"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
						"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
						"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
						"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
						"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
						"FILTER_NAME" => $arParams["FILTER_NAME"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_FILTER" => $arParams["CACHE_FILTER"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"SET_TITLE" => $arParams["SET_TITLE"],
						"SET_STATUS_404" => $arParams["SET_STATUS_404"],
						"SHOW_404" => $arParams["SHOW_404"],
						"MESSAGE_404" => "N",
						"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
						"PAGE_ELEMENT_COUNT" => "40",
						"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
						"PRICE_CODE" => $arParams["PRICE_CODE"],
						"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
						"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

						"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
						"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
						"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
						"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
						"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

						"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
						"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
						"PAGER_TITLE" => $arParams["PAGER_TITLE"],
						"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
						"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
						"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
						"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
						"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

						"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
						"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
						"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
						"OFFERS_SORT_FIELD" => $sort_by,
						"OFFERS_SORT_ORDER" => $sort_order,
						"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
						"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
						"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

						"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
						"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
						"SECTION_USER_FIELDS" => ["UF_HEADER", "UF_MORO_PHOTO", "UF_TOP_TEXT"],
						"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
						"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

						'LABEL_PROP' => $arParams['LABEL_PROP'],
						'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
						'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

						'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
						'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
						'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
						'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
						'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
						'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
						'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
						'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
						'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
						'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

						'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
						"ADD_SECTIONS_CHAIN" => $addSectionsChain,
						'PND_SEC_PAGEN' => $arSPagen,

						 "SORT_BY" => $arParams["SORT_BY"],
						 "SORT_ORDER" => $arParams["SORT_ORDER"],
						 "IN_PAGE" => $arParams["IN_PAGE"],
						 "PAGE" => $arParams["PAGE"],
						"PAGEN" => $arParams["PAGEN"],
						  "YEAR" => $arParams["YEAR"],
					],
					$component
				);
			
		?>
        <? if ($verticalGrid) { ?>
    </div>
    <div style="clear: both;"></div>
</div>
<? } ?>