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

$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');
?>
    <div class="workarea grid2x1">
    <div class="bx_content_section">
        <? if (!isset($_REQUEST['set_filter'])) {
            $GLOBALS['arrFilter']['SECTION_ID'] = $arResult["VARIABLES"]["SECTION_ID"];
        }
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
            <?php if ($arSec['DEPTH_LEVEL'] == 1 && !isset($_REQUEST['set_filter'])) { //выводим все разделы 3 ур. Страны
				/*
Комментарий выше не ясен - так как не обнаружено в каких местах этот блок выводится
*/


                $GLOBALS['arrCountrySectionsFilter'] = ['DEPTH_LEVEL' => 3];
				$arSPagen = $APPLICATION->IncludeComponent(
                    "omniweb:catalog.section.list",
                    "section-list-catalog",
                    [
"COMPATIBLE_MODE" => "Y",
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
                        "SECTION_COUNT" => "45",
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
                \CHTTP::SetStatus("200 OK");
            }
            $GLOBALS['arrFilter']['=UF_AVAILABILITY'] = false;
/*
Выводится в коллекции по типу /collections/italyanskaya-plitka/vallelunga/rialto
блок вывода картинок коллекции и её категорий справа
*/
            ?>
			<? /* $APPLICATION->IncludeComponent(
				"bitrix:catalog.main",
				"section_list",
				[
					"CACHE_GROUPS" => "N",
					"CACHE_TIME" => CACHETIME,
					"CACHE_TYPE" => "A",
					"IBLOCK_ID" => [$arParams["IBLOCK_ID"]],
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"PAGE" => (int)$_REQUEST["PAGEN_1"],
					"PAGE_ELEMENT_COUNT" => 24,
					"ROWS" => 3,
					"TYPE" => "LIST"
				]
			);
				*/
			?>
            <? $arSPagen = $APPLICATION->IncludeComponent(
                "omniweb:catalog.section.list",
                "section-list-catalog",
                [
"COMPATIBLE_MODE" => "Y",
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
                    "SECTION_COUNT" => // (strpos($arResult["VARIABLES"]["SECTION_CODE_PATH"],"/")=== FALSE) ? "40" :
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
                    "DISPLAY_BOTTOM_PAGER" => "Y",//($arSec['DEPTH_LEVEL'] == 1) ? "N" : "Y",
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
            );  ?>
        <? } else {

			$showSectionsList = false;

            if (empty($arResult["VARIABLES"]["SECTION_ID"]) || (!empty($arResult["VARIABLES"]["SECTION_ID"]) && !in_array($arParams['IBLOCK_ID'], array(CATALOG_FLOOR_ID, CATALOG_SANTEH_ID)))) {
                //отображаем список разделов для главной каталога и не разделов напольных и сантехники
                $showSectionsList = true;
            }
            $addSectionsChain = 'N';
            if (!$showSectionsList && in_array($arParams['IBLOCK_ID'], array(CATALOG_FLOOR_ID, CATALOG_SANTEH_ID))) {
                //для разделов напольных и сантехники включаем раздел в цепочку навигации
                $addSectionsChain = 'Y';
            }


            if ($showSectionsList && !in_array($_SERVER["SCRIPT_URL"] , ['/sukhie-stroitelnye-smesi/', '/napolnye-pokrytiya/', '/collections/', '/santekhnika/'] )) {

				$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "section-list-catalog",
                    [
"COMPATIBLE_MODE" => "Y",
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
        <?
		/*
        if ($arParams["USE_COMPARE"] == "Y") {
            ?><?
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.compare.list",
                "",
                [
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "NAME" => $arParams["COMPARE_NAME"],
                    "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                    "COMPARE_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["compare"],
                ],
                $component
            ); ?><?
        }
		*/

        $intSectionID = 0;
        /*---bgn 2017-02-07---*/
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
        /*---end 2017-02-07---*/

        if ($arParams["IBLOCK_ID"] == CATALOG_ID && $arSec['DEPTH_LEVEL'] == 3) {
            $pageElementCount = MAX_PAGE_ELEMENT_COUNT;
        } else {
            $pageElementCount = $arParams["PAGE_ELEMENT_COUNT"];
        }
        ?>

		 <?

		 ?>
        <? /* if($USER->IsAdmin() && $USER->GetID()==68021){

	global $arrCustomFilter;


				echo "<pre>";
				print_r($arrCustomFilter);
				echo "</pre>";


				echo "<pre>";
				print_r($arParams);
				echo "</pre>";


				echo "<pre>";
				print_r($arResult);
				echo "</pre>";

			}else{
			*/

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

                $template_section = "";
                if($arParams["IBLOCK_ID"] == 4 && $arSec['DEPTH_LEVEL'] == 3) {
                    $template_section = "section_collection";
                }

				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					$template_section,
					[
"COMPATIBLE_MODE" => "Y",
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
						"PAGE_ELEMENT_COUNT" => "200",
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
						"SECTION_USER_FIELDS" => ["UF_HEADER", "UF_MORO_PHOTO", "UF_TOP_TEXT", "UF_CATALOG_PRICE_1"],
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
						'PRODUCT_SUBSCRIPTION' => "N",
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
		/*	} */
		?>
    </div>
    <div style="clear: both;"></div>
</div>
<?
/*
if (empty($arResult["VARIABLES"]["SECTION_ID"])) :
    ?>
    <div class="productdiv_desc">
        <?
        $rIB = CIBlock::GetByID($arParams['IBLOCK_ID']);
        $arIB = $rIB->Fetch();
        $ib_desc = trim(strip_tags($arIB['DESCRIPTION'], '<img>'));
        if (!empty($ib_desc) && empty($arParams["PAGEN"])) {
            echo $arIB['DESCRIPTION'];
        } ?>
    </div>
<?
endif;
*/
?>
<?
/*
$showBestTab = false;
if (\Bitrix\Main\ModuleManager::isModuleInstalled("sale")) {
    //---2018-06-18 доб. условие проверки плитка или нет ---//
    if ($arParams['IBLOCK_ID'] != CATALOG_ID) { //не плитка
        $arRecomData = [];
        $recomCacheID = ['IBLOCK_ID' => $arParams['IBLOCK_ID']];
        $obCache = new CPHPCache();
        if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers")) {
            $arRecomData = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            if (\Bitrix\Main\Loader::includeModule("catalog")) {
                $arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
                $arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
            }
            $obCache->EndDataCache($arRecomData);
        }
        if (!empty($arRecomData)) {
            $showBestTab = true;
        }
    } else { //плитка
        $showBestTab = true;
    }
}
*/
?>
<? /*
<div class="tabs-wrapper">
    <div class="tabs-switch simpleText title-bg uppercase">
        <?if ($showBestTab) {?>
            <a href="#tabBest" class="active"><?=GetMessage('TAB_BEST_TITLE')?></a>
        <?}?>
        <a href="#tabRecommendations" <?if (!$showBestTab) {?>class="active"<?}?>><?=GetMessage('TAB_RECOMMENDATIONS_TITLE')?></a>
    </div>
    <div class="tabs noTitle">
        <?if ($showBestTab) {?>
            <div class="tab" id="tabBest">
                <?if ($arParams['IBLOCK_ID'] != CATALOG_ID) { //не плитка?>
                    <?$APPLICATION->IncludeComponent("bitrix:sale.bestsellers", ".default", [
                            "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                            "PAGE_ELEMENT_COUNT" => "4",
                            "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
                            "PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
                            "SHOW_NAME" => "Y",
                            "SHOW_IMAGE" => "Y",
                            "MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
                            "MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
                            "MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
                            "MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
                            "LINE_ELEMENT_COUNT" => 4,
                            "TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "BY" => [
                                0 => "AMOUNT",
                            ],
                            "PERIOD" => [
                                0 => "15",
                            ],
                            "FILTER" => [
                                0 => "CANCELED",
                                1 => "ALLOW_DELIVERY",
                                2 => "PAYED",
                                3 => "DEDUCTED",
                                4 => "N",
                                5 => "P",
                                6 => "F",
                            ],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "ORDER_FILTER_NAME" => "arOrderFilter",
                            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                            "SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                            "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                            "SHOW_PRODUCTS_" . $arParams["IBLOCK_ID"] => "Y",
                            "OFFER_TREE_PROPS_" . $arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"]
                        ],
                        $component
                    );?>
                <?} else { //плитка
                    // bgn 2018-06-14
                    //лидеры продаж (коллекции) ?>
                    <?$APPLICATION->IncludeComponent(
                        "omniweb:sale.bestsellers.sections",
                        "section-list-catalog",
                        [
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "COUNT_ELEMENTS" => "N",
                            "SECTION_FIELDS" => ["", ""],
                            "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                            "SHOW_PARENT_NAME" => 'N',
                            "SECTION_URL" => "",
                            "CACHE_TYPE" => 'N', //$arParams["CACHE_TYPE"],
                            "CACHE_TIME" => '600',
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                            "FILTER_NAME" => '',
                            "SECTION_COUNT" => "4",
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
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Коллекции",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                        ],
                        $component
                    );?>
                    <?//---end 2018-06-14
                }?>
            </div>
        <?}?>
        <div class="tab" id="tabRecommendations">
            <?$recommBlockID = $arParams["IBLOCK_ID"];
            $sfx = '';
            if ($recommBlockID == CATALOG_FLOOR_ID) {
                $sfx = '_floor';
            } else if ($recommBlockID == CATALOG_SANTEH_ID) {
                $sfx = '_santeh';
            }?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/personal_recommendations".$sfx.".php",
                    "AREA_FILE_RECURSIVE" => "N",
                    "EDIT_MODE" => "html",
                ),
                false,
                Array('HIDE_ICONS' => 'Y')
            );?>
        </div>
    </div>
</div>
*/ ?>
