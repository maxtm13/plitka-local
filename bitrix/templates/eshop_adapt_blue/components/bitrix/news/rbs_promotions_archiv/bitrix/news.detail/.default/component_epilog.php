<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
if (!empty($arResult["IS_LINCED_EMPTY_COL1"])) {
			$GLOBALS['arrFilterCol'] = array("IBLOCK_SECTION_ID" => $arResult["AR_LINKS_COL"]);
			foreach ($arResult["AR_LINKS_COL"]["I1"] as $val){
				$SECNAMES = CIBlockSection::GetByID($val);
				if($SECNAME_res = $SECNAMES->GetNext()){
					$SECNAME_ANS = $SECNAME_res['NAME'];
					$SEC_SECTION = $SECNAME_res['IBLOCK_SECTION_ID'];
					$SEC_COL_URL = $SECNAME_res['SECTION_PAGE_URL'];
				}
				$SECNAMES = CIBlockSection::GetByID($SEC_SECTION);
				if($SECNAME_res = $SECNAMES->GetNext()){
					$SEC_SECTION_NAME = $SECNAME_res['NAME'];
					$SEC_URL = $SECNAME_res['SECTION_PAGE_URL'];
				}
				
				?><H3><a href = "<? echo $SEC_URL; ?>"> <? echo $SEC_SECTION_NAME; ?></a> / <a class="Col_url" href="<? echo $SEC_COL_URL ?>"><? echo $SECNAME_ANS; ?></a></H3><?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"rbs-promotions",
					Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => 4,
						"SECTION_ID" => $val,
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array("UF_MORO_PHOTO",""),
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilterCol",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "N",
						"PAGE_ELEMENT_COUNT" => "10",
						"LINE_ELEMENT_COUNT" => "5",
						"PROPERTY_CODE" => array("",""),
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
						"CACHE_TIME" => "0",
						"CACHE_GROUPS" => "Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"SET_STATUS_404" => "N",
						"CACHE_FILTER" => "N",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => array("BASE"),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => array(""),
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
						"MESSAGE_404" => ""
					)
				);
			}
		}
		if (!empty($arResult["IS_LINCED_EMPTY_COL2"])) {
			$GLOBALS['arrFilterCol1'] = array("IBLOCK_SECTION_ID" => $arResult["AR_LINKS_COL"]);
			foreach ($arResult["AR_LINKS_COL"]["I2"] as $val){
				$SECNAMES = CIBlockSection::GetByID($val);
				if($SECNAME_res = $SECNAMES->GetNext()){
					$SECNAME_ANS = $SECNAME_res['NAME'];
					$SEC_SECTION = $SECNAME_res['IBLOCK_SECTION_ID'];
					$SEC_COL_URL = $SECNAME_res['SECTION_PAGE_URL'];
				}
				$SECNAMES = CIBlockSection::GetByID($SEC_SECTION);
				if($SECNAME_res = $SECNAMES->GetNext()){
					$SEC_SECTION_NAME = $SECNAME_res['NAME'];
					$SEC_URL = $SECNAME_res['SECTION_PAGE_URL'];
				}
				?><H3><a href = "<? echo $SEC_URL; ?>"> <? echo $SEC_SECTION_NAME; ?></a> / <a class="Col_url" href="<? echo $SEC_COL_URL ?>"><? echo $SECNAME_ANS; ?></a></H3><?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"rbs-promotions",
					Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => 9,
						"SECTION_ID" => $val,
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array("UF_MORO_PHOTO",""),
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilterCol1",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "N",
						"PAGE_ELEMENT_COUNT" => "10",
						"LINE_ELEMENT_COUNT" => "5",
						"PROPERTY_CODE" => array("",""),
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
						"CACHE_TIME" => "0",
						"CACHE_GROUPS" => "Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"SET_STATUS_404" => "N",
						"CACHE_FILTER" => "N",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => array("BASE"),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => array(""),
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
						"MESSAGE_404" => ""
					)
				);
			}
		}
		if (!empty($arResult["IS_LINCED_EMPTY_COL3"])) {
			$GLOBALS['arrFilterCol1'] = array("IBLOCK_SECTION_ID" => $arResult["AR_LINKS_COL"]);
			foreach ($arResult["AR_LINKS_COL"]["I3"] as $val){
				$SECNAMES = CIBlockSection::GetByID($val);
				if($SECNAME_res = $SECNAMES->GetNext()){
					$SECNAME_ANS = $SECNAME_res['NAME'];
					$SEC_SECTION = $SECNAME_res['IBLOCK_SECTION_ID'];
					$SEC_COL_URL = $SECNAME_res['SECTION_PAGE_URL'];
				}
				$SECNAMES = CIBlockSection::GetByID($SEC_SECTION);
				if($SECNAME_res = $SECNAMES->GetNext()){
					$SEC_SECTION_NAME = $SECNAME_res['NAME'];
					$SEC_URL = $SECNAME_res['SECTION_PAGE_URL'];
				}
				?><H3><a class="Col_url" href="<? echo $SEC_COL_URL ?>"><? echo $SECNAME_ANS; ?></a></H3><?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"rbs-promotions",
					Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => 11,
						"SECTION_ID" => $val,
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array("UF_MORO_PHOTO",""),
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilterCol1",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "N",
						"PAGE_ELEMENT_COUNT" => "10",
						"LINE_ELEMENT_COUNT" => "5",
						"PROPERTY_CODE" => array("",""),
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
						"CACHE_TIME" => "0",
						"CACHE_GROUPS" => "Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"SET_STATUS_404" => "N",
						"CACHE_FILTER" => "N",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => array("BASE"),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => array(""),
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
						"MESSAGE_404" => ""
					)
				);
			}
		}
	?>
		
	<H3>Отдельные товары</H3>
	<?
		if (!empty($arResult["IS_LINCED_EMPTY_EL"])) {
			$GLOBALS['arrFilterLinked'] = array('ID' => $arResult["AR_LINKS_EL"]);
			foreach ($arResult["AR_IBLOCK_ID_EL"] as $val){
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"rbs-promotions",
					Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => $val,
						"SECTION_ID" => "",
						"SECTION_CODE" => "",
						"SECTION_USER_FIELDS" => array("UF_MORO_PHOTO",""),
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilterLinked",
						"INCLUDE_SUBSECTIONS" => "Y",
						"SHOW_ALL_WO_SECTION" => "Y",
						"HIDE_NOT_AVAILABLE" => "N",
						"PAGE_ELEMENT_COUNT" => "10",
						"LINE_ELEMENT_COUNT" => "5",
						"PROPERTY_CODE" => array("",""),
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
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"ADD_SECTIONS_CHAIN" => "N",
						"SET_STATUS_404" => "N",
						"CACHE_FILTER" => "N",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRICE_CODE" => array("BASE"),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"USE_PRODUCT_QUANTITY" => "Y",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => array(""),
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
						"MESSAGE_404" => ""
					)
				);
			}
		}
	?>
<? 

//global $USER; if($USER->IsAdmin()){echo '<pre>'; print_r($arResult['PROPERTIES']); echo '</pre>';};
?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>