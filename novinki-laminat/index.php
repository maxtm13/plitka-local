<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "Новинки коллекции, новинки керамическая плитка, новинка плитка для ванной");
$APPLICATION->SetPageProperty("description", "Коллекции новинок напольных покрытий в интернет-магазине «Плитка на дом». Огромный выбор напольных покрытий по лучшей цене в Москве");
// $APPLICATION->SetPageProperty("keywords_inner", "Новинки коллекции");
$APPLICATION->SetPageProperty("title", "Коллекции новинок напольных покрытий | «Плитка на дом»");
$APPLICATION->SetTitle("Коллекции новинок напольных покрытий");
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
		"TYPE" => "NEW"
	]
); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>