<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "Новинки коллекции, новинки керамическая плитка, новинка плитка для ванной");
$APPLICATION->SetPageProperty("description", "Новинки сантехники в интернет-магазине «Плитка на дом». Огромный выбор сантехники по лучшей цене в Москве");
// $APPLICATION->SetPageProperty("keywords_inner", "Новинки коллекции");
$APPLICATION->SetPageProperty("title", "Новинки сантехники | «Плитка на дом»");
$APPLICATION->SetTitle("Новинки сантехники");
?><?
$APPLICATION->IncludeComponent("bitrix:catalog.main","product_list", [
	"IBLOCK_TYPE" => "catalog",
	"TYPE" => "NEW",
	"IBLOCK_ID" => [11],
	"PAGE_ELEMENT_COUNT" => 40,
	"SORT" => "DATE_CREATE",
	"SORT_ORDER" => "DESC",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "360000",
	"CACHE_GROUPS" => "N",
	"NIGHT" => $checktime,
	"USER_GROUP" => $usergropus,
	"CHECK_DATE" => $checkdate,
	"CURENCY" => $ccurency,
	"YEAR" => date("Y"),
	"PAGE" => (int)$_REQUEST["PAGEN_1"],
	"MARGIN" => "N"
]);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>