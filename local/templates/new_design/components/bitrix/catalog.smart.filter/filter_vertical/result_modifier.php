<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$theme = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arResult['FORM_ACTION'] = $arParams['FORM_ACTION'] ? $arParams['FORM_ACTION'] : '';

// Ќайдем минимальную и максимульную цену дл€ поиска
$minPrice = 100;
$maxPrice = 10000;
/*$arFilter =  array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ACTIVE" => "Y",
	"GLOBAL_ACTIVE" => "Y",
	"DEPTH_LEVEL" => 3,
	"!UF_CATALOG_PRICE_1" => false,
);
$arSelect = array("ID", "UF_CATALOG_PRICE_1");
$arNavParams = array("nPageSize" => 1);

$res = CIBlockSection::GetList(array("UF_CATALOG_PRICE_1" => "ASC"), $arFilter, false, $arSelect, $arNavParams);
if($price = $res->Fetch()){
	$minPrice = $price['UF_CATALOG_PRICE_1'];
}

$res = CIBlockSection::GetList(array("UF_CATALOG_PRICE_1" => "DESC"), $arFilter, false, $arSelect, $arNavParams);
if($price = $res->Fetch()){
	$maxPrice = $price['UF_CATALOG_PRICE_1'];
}*/

$arResult['ITEMS']['BASE']['VALUES']['MIN']['VALUE'] = $minPrice;
$arResult['ITEMS']['BASE']['VALUES']['MAX']['VALUE'] = $maxPrice;

global $sotbitFilterResult;  
$sotbitFilterResult = $arResult;

