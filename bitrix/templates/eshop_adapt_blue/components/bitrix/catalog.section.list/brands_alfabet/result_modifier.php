<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$mainDir = [
  4 => "collections",
  9 => "napolnye-pokrytiya",
  11 => "santekhnika"
];
if($arResult["SECTIONS"]){
	foreach($arResult["SECTIONS"] as $k=>$sect){
		if($sect["DEPTH_LEVEL"]==1 || $sect["ACTIVE"] == "N"){
			unset($arResult["SECTIONS"][$k]);
		}

		if($sect["DEPTH_LEVEL"]==2 && $sect["UF_NO_ALFABET"] != 1){
			$letter = mb_substr($sect['NAME'], 0, 1);
			if($arParams["IBLOCK_ID"] == 9 || $arParams["IBLOCK_ID"] == 11){
				if(!in_array($sect['CODE'], $allbrands)){
					$arResult["ITEMS"][$letter][$sect['CODE']] = [
						"NAME" => $sect['NAME'],
						"URL" => "/".$mainDir[$arParams["IBLOCK_ID"]]."/brand/".$sect['CODE']
					];
					$allbrands[] = $sect['CODE'];
				}
			}else{
					$arResult["ITEMS"][$letter][$sect['NAME']] = [
						"NAME" => $sect['NAME'],
						"URL" => $sect['SECTION_PAGE_URL']
					];
			}
			sort($arResult['ITEMS'][$letter]);
		}
	}
	ksort($arResult['ITEMS']);
	unset($arResult["SECTIONS"]);
}