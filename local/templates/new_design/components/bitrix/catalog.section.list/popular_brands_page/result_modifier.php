<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["SECTIONS"]){
	if($arParams["IBLOCK_ID"] == 4){
		foreach($arResult["SECTIONS"] as $k=>$sect){
			if($sect["DEPTH_LEVEL"]==1 && $sect["ID"] != 30756){
				if(empty($arResult["FLAGS"][$sect["ID"]]) ){
					$arResult["FLAGS"][$sect["ID"]]["SRC"] = CFile::ResizeImageGet($sect["PICTURE"], ["width" => 30, "height" => 22], BX_RESIZE_IMAGE_EXACT,true,false,false,75)["src"];
					$arResult["FLAGS"][$sect["ID"]]["NAME"] = $sect["NAME"];
				}
			}
		}
	}
	$arResult["BRANDS"] = array();
	foreach($arResult["SECTIONS"] as $k=>$sect){
		if($sect["ID"] != 30756 && $sect["DEPTH_LEVEL"] ==2 && $sect["IBLOCK_SECTION_ID"] != 37360){
			#if(count($arResult["BRANDS"]) < $arParams["COUNT"] && $sect["UF_HIT"] > 0){
			if(is_countable($arResult["BRANDS"]) && count($arResult["BRANDS"]) < $arParams["COUNT"] && $sect["UF_HIT"] > 0){
				if(!empty($sect["PICTURE"])){
					$sect["LOGO"] = CFile::ResizeImageGet($sect["PICTURE"], ["width" => 300, "height" => 300], BX_RESIZE_IMAGE_EXACT,true,false,false,85)["src"];
				}
				$arResult["BRANDS"][] = $sect;
			}else
				break;
		}
	}
}

$arResult["BRANDS_COUNT"] = is_countable($arResult["BRANDS"]) && count($arResult["BRANDS"]);
unset($arResult["SECTIONS"]);