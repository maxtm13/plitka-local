<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["SECTIONS"]){
	foreach($arResult["SECTIONS"] as $k=>$sect){
		if($sect["DEPTH_LEVEL"]==1){
			if(empty($arResult["FLAGS"][$sect["ID"]])){
				$arResult["FLAGS"][$sect["ID"]]["SRC"] = CFile::ResizeImageGet($sect["PICTURE"], ["width" => 30, "height" => 22], BX_RESIZE_IMAGE_EXACT,true,false,false,75)["src"];
				$arResult["FLAGS"][$sect["ID"]]["NAME"] = $sect["NAME"];
			}
		}
		if($sect["DEPTH_LEVEL"]==1 || $sect["ACTIVE"] == "N" || empty($sect["UF_STARS"])){
			unset($arResult["SECTIONS"][$k]);
		}
	}
}