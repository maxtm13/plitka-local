<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<? $APPLICATION->IncludeComponent("bitrix:news.detail", "article",
	[
		"IBLOCK_TYPE" => "services",
		"IBLOCK_ID" => 25,
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => htmlspecialchars($_REQUEST["ELEMENT_CODE"]),
		"FIELD_CODE" => ["PREVIEW_PICTURE"],
		"PROPERTY_CODE" => [],
		"SET_TITLE" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"BROWSER_TITLE" => "-",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_GROUPS" => "N"
	], false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>