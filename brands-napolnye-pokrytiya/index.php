<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Рейтинг популярности фабрик-производителей напольных покрытий | «Плитка на дом»");
$APPLICATION->SetPageProperty("description", "Рейтинг популярности фабрик-производителей напольных покрытий | «Плитка на дом»");
$APPLICATION->SetTitle("Рейтинг популярности фабрик-производителей напольных покрытий");
$APPLICATION->IncludeFile("/include/brands_text_napolnye-pokrytiya.php",[],["MODE"=>"html"]);
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "popular_brands_page",
	[
	  "IBLOCK_TYPE" => 'catalog',
	  "IBLOCK_ID" => 9,
	  "SECTION_ID" => 0,
	  "SECTION_CODE" => "",
	  "SECTION_URL" => "",
	  "COUNT_ELEMENTS" => "N",
	  "TOP_DEPTH" => "2",
	  "SECTION_FIELDS" => ["PICTURE"],
	  "SECTION_USER_FIELDS" => ["UF_HIT"],
	  "ADD_SECTIONS_CHAIN" => "N",
	  "CACHE_TYPE" => "Y",
	  "CACHE_TIME" => "360000",
	  "CACHE_NOTES" => "",
	  "CACHE_GROUPS" => "Y",
	  "CUSTOM_SECTION_SORT" => ["UF_HIT"=>"DESC","NAME"=>"ASC"],
		"TYPE" => "FULL",
		"COUNT" => "500",
	]
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>