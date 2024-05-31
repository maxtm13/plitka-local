<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "Популярные коллекции, самая популярная плитка, популярная керамическая плитка, популярная плитка для ванной");
$APPLICATION->SetPageProperty("description", "Популярные коллекции плитки в интернет-магазине «Плитка на дом». Огромный выбор керамической плитки по лучшей цене в Москве");
// $APPLICATION->SetPageProperty("keywords_inner", "Популярные коллекции");
$APPLICATION->SetPageProperty("title", "Популярные коллекции напольных покрытий | «Плитка на дом»");
$APPLICATION->SetTitle("Популярные коллекции напольных покрытий");
?><? $APPLICATION->IncludeComponent(
	"bitrix:catalog.main",
	"section_list",
	[
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => CACHETIME,
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => [CATALOG_FLOOR_ID],
		"IBLOCK_TYPE" => "catalog",
		"PAGE" => (int)$_REQUEST["PAGEN_1"],
		"PAGE_ELEMENT_COUNT" => 24,
		"TYPE" => "POPULAR"
	]
); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>