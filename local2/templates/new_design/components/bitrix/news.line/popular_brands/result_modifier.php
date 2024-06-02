<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$sections = [];
if(!empty($arResult["ITEMS"]))
	foreach($arResult["ITEMS"] as $item)
		if(!empty($item["PROPERTY_FABRIC_VALUE"]))
			$sections[] = $item["PROPERTY_FABRIC_VALUE"];

if(!empty($sections)){
	$arFilter = array('IBLOCK_ID' => CATALOG_ID, "ID" => $sections);
   $rsSect = CIBlockSection::GetList([],$arFilter, ["ID", "PICTURE", "SECTION_PAGE_URL", "NAME"]);
   while ($arSect = $rsSect->GetNext())
   {
		$arSect["LOGO"] = CFile::ResizeImageGet($arSect["PICTURE"], ["width" => 300, "height" => 100], BX_RESIZE_IMAGE_EXACT,true,false,false,85)["src"];
		$arResult["BRANDS"][$arSect["ID"]] = $arSect;
   }
}

unset($sections, $rsSect, $arSect);