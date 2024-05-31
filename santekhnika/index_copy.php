<?php
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
	$exDir = explode("/",$APPLICATION->GetCurDir());
if(!$_REQUEST["CODE"]){
	LocalRedirect("/".$exDir[1]."/");
}else{
	$error = true;
	if(!$exDir[4]){
		$error = false;
		$brand = $exDir = [];
		$brand = getBrandInfo(htmlspecialchars($_REQUEST["CODE"]), 11);
	}else{
		$error = true;
	}
	if(!empty($brand)){
			$error = false;
			$APPLICATION->SetPageProperty("title", "Сантехника ".$brand["NAME"]." Купить По Лучшим Цена В Москве!");
			$APPLICATION->SetPageProperty("description", "Широкий выбор сантехники ".$brand["NAME"]." в каталоге интернет магазина plitkanadom недорого с доставкой по Москве и в любой другой регион России.");
			$APPLICATION->SetTitle("Сантехника ".$brand["NAME"]);
			$APPLICATION->AddChainItem($brand["NAME"], $APPLICATION->GetCurDir().htmlspecialchars($_REQUEST["CODE"]));

			global $arrFilter;
			$arrFilter["!PROPERTY_AVAILABILITY"] = [5044, 5649, 4914];
			$arrFilter["PROPERTY_MANUFACTURER"] = $brand["NAME"];
			if (!empty($_REQUEST['s'])) {
				  if (empty($_REQUEST['s']) || substr($_REQUEST['s'], -1) == 'a') {
						$sort_order = 'ASC';
				  } else {
						$sort_order = 'DESC';
				  }
				  if (empty($_REQUEST['s']) || in_array($_REQUEST['s'], ['da', 'dd'])) {
						$sort_by = 'DATE_CREATE';
				  } else if (in_array($_REQUEST['s'], ['pa', 'pd'])) {
						$sort_by = 'CATALOG_PRICE_1';
				  } else if (in_array($_REQUEST['s'], ['poa', 'pod'])) {
						$sort_by = 'SHOW_COUNTER';
				  } else {
						$sort_by = 'NAME';
				  }
			 } else {
				  $sort_by = 'sort';
				  $sort_order = 'asc';
			 }

			 $APPLICATION->IncludeComponent(
				  "bitrix:catalog.section",
				  "brand-product-list",
				  [
						"ACTION_VARIABLE" => "action",
						"ADD_PICT_PROP" => "-",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"ADD_SECTIONS_CHAIN" => "Y",
						"ADD_TO_BASKET_ACTION" => "ADD",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"BASKET_URL" => "/personal/cart/",
						"BROWSER_TITLE" => "-",
						"CACHE_FILTER" => "A",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COMPONENT_TEMPLATE" => "product-list",
						"CONVERT_CURRENCY" => "N",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_COMPARE" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"ELEMENT_SORT_FIELD" => $sort_by,
						"ELEMENT_SORT_FIELD2" => "name",
						"ELEMENT_SORT_ORDER" => $sort_order,
						"ELEMENT_SORT_ORDER2" => "asc",
						"FILTER_NAME" => "arrFilter",
						"BRAND" => $brand,
						"TYPE" => 'santekhnika',
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
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => "arrows",
						"PAGER_TITLE" => "Товары",
						"PAGE_ELEMENT_COUNT" => (!empty($_REQUEST['el_c'])) ? intval($_REQUEST['el_c']) : 40,
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRICE_CODE" => [
							 0 => "BASE",
						],
						"PRICE_VAT_INCLUDE" => "Y",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRODUCT_PROPERTIES" => [
						],
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PRODUCT_SUBSCRIPTION" => "N",
						"PROPERTY_CODE" => [
							 0 => "NIGHT_PRICE",
							 1 => "",
						],
						"SECTION_CODE" => "",
						"SECTION_ID" => '',
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"SECTION_URL" => "",
						"SECTION_USER_FIELDS" => [
							 0 => "UF_MORO_PHOTO",
							 1 => "",
						],
						"SEF_MODE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SHOW_ALL_WO_SECTION" => "Y",
						"SHOW_CLOSE_POPUP" => "N",
						"SHOW_DISCOUNT_PERCENT" => "Y",
						"SHOW_OLD_PRICE" => "Y",
						"SHOW_PRICE_COUNT" => "1",
						"TEMPLATE_THEME" => "",
						"USE_MAIN_ELEMENT_SECTION" => "N",
						"USE_PRICE_COUNT" => "N",
						"USE_PRODUCT_QUANTITY" => "Y",
						"CUSTOM_FILTER" => "",
						"HIDE_NOT_AVAILABLE_OFFERS" => "N",
						"BACKGROUND_IMAGE" => "-",
						"COMPATIBLE_MODE" => "Y",
						"DISABLE_INIT_JS_IN_COMPONENT" => "N",
					  "NEED_BRAND" => "Y"
				  ],
				  false
			 );
	}else{
		$error = true;	
	}
	
	if($error == true){
		define("ERROR_404", "Y");
		\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
	}
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
}