<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// $APPLICATION->SetPageProperty("keywords", "Популярные коллекции, самая популярная плитка, популярная керамическая плитка, популярная плитка для ванной");
$APPLICATION->SetPageProperty("description", "Популярные сантехника в интернет-магазине «Плитка на дом». Огромный выбор сантехники по лучшей цене в Москве");
// $APPLICATION->SetPageProperty("keywords_inner", "Популярные коллекции");
$APPLICATION->SetPageProperty("title", "Популярные сантехника | «Плитка на дом»");
$APPLICATION->SetTitle("Популярные сантехника");
?><?
$APPLICATION->IncludeComponent("bitrix:catalog.main","product_list", [
	"IBLOCK_TYPE" => "catalog",
	"TYPE" => "POPULAR",
	"IBLOCK_ID" => [11],
	"PAGE_ELEMENT_COUNT" => 40,
	"SORT" => "PROPERTY_POPULAR",
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