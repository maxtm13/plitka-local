<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "Распродажа плитки, распродажа керамогранита, распродажа плитки для ванной, распродажа керамической плитки");
$APPLICATION->SetPageProperty("title", "Распродажа керамической плитки в Москве| «Плитка на дом»");
$APPLICATION->SetPageProperty("description", "Распродажа керамической плитки в интернет-магазине «Плитка на дом». Широкий ассортимент керамической плитки на любой вкус по сниженной цене");
$APPLICATION->SetTitle("Распродажа керамической плитки");
?><div class="clear">
</div>
 <?
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
?> <?
	$arrFilter_new = array("PROPERTY_RASPRODAZH_VALUE"=>"1"); 
?>
<div>
	<p>
		 В данном разделе представлены коллекции плитки, которая в настоящее время продается по сниженной цене!!!
	</p>
	<h3>Распродажа плитки и керамогранита может производиться по разным причинам:</h3>
	<ul>
		<li>проведение производителями-поставщиками плитки временных акций стимулирования продаж. Эти акции имеют определенный период проведения и после завершения акции цены возвращаются к первоначальному уровню. Информацию об актуальности акционной цены Вы можете уточнить у менеджеров нашего магазина; </li>
		<li>снятие плитки с производства (вывод коллекции из продажи). В данном случае завод переходит на выпуск новых коллекций плитки, а остатки данной плитки распродаются по значительно сниженной цене. Снижение цены может достигать 50% и более процентов!!! Это отличный шанс купить высококачественную дорогую плитку или керамогранит, иногда даже премиальной ценовой категории, по цене плитки из средней или низкой ценовой категории! Однако, количество товара в данном случае будет ограничено. Количество товара, доступное к продаже Вы можете уточнить по телефону или e-mail. <b>Настоятельно рекомендуем</b> при расчете необходимого Вам количества плитки, снятой с производства, заказывать ее с запасом, т.к. эта плитка больше производиться не будет!</li>
		<p>
			 Мы постоянно обновляем раздел "Распродажа", чтобы Вы могли видеть актуальную информацию о проводимых акциях и скидках. Но перед заказом, пожалуйста, уточните наличие данной плитки и актуальность цены у менеджеров.
		</p>
	</ul>
</div>
<div id="collection-wrapper">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"sale", 
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
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
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
		"PAGER_SHOW_ALL" => "N",
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
		"COMPONENT_TEMPLATE" => "sale"
	),
	false
);?>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>