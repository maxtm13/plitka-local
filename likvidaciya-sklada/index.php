<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "дисконт остатки плитки и керамогранита москва купить напольная"); 
$APPLICATION->SetPageProperty("title", "Срочная ликвидация склада. Скидки от 40% | «Плитка на дом»");
$APPLICATION->SetPageProperty("description", "Срочная ликвидация склада в интернет-магазине «Плитка на дом». Скидки на керамическую плитку от 40 %.");
$APPLICATION->SetTitle("Срочная ликвидация склада плитки ");
?>
<div class="clear">
</div>
<p>Хотите купить качественную напольную плитку с дисконтом от 40 %? Тогда не пропустите ликвидацию склада! Мы предлагаем остатки плитки и керамогранита из коллекций ведущих производителей: роскошные мозаичные панно, гресы под натуральный камень, узорчатые модули и многое другое.</p>
 <?
	$arrFilter_new = array("PROPERTY_DISCOUNT_VALUE"=>"3"); 
?>
<div id="collection-wrapper">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"product-list-discount-home", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "product-list-discount-home",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter_new",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "4",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"PAGER_TITLE" => "Коллекции",
		"PAGE_ELEMENT_COUNT" => "45",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"CUSTOM_FILTER" => "",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"TEMPLATE_THEME" => "blue",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COMPATIBLE_MODE" => "Y",
		"PAGE" => ($_SERVER["SCRIPT_URL"] ?? ($_SERVER["REQUEST_URI"] ?? $APPLICATION->GetCurDir())),
	),
	false
);?>
</div>
<div class="clear">
</div>
<p><span style='font-weight:bold'>Наше предложение будет вам интересно, если:</span></p>
<ol>
<li>Вы привыкли рационально распоряжаться деньгами и не хотите переплачивать, но одновременно не готовы на компромиссы в отношении качества. В этом случае вы можете заказать кафель в том количестве, которое подразумевает скидку, а остаток приобрести по обычной стоимости.</li>
<li>Вы находитесь в процессе отделочных работ и обнаружили, что для полной реализации проекта раскладки не хватает плитки. Если такое же покрытие есть у нас на распродаже, вы можете приобрести нужный метраж со скидкой.</li>
</ol>
<p>Доступное количество указано в карточке каждого товара. Продукция доставляется по Москве и регионам России.</p>

 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>