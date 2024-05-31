<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["ITEMS"]){
	foreach($arResult["ITEMS"] as &$item){
		
		if($item["PREVIEW_PICTURE"]){
			$item["PICTURE"]["MOBILE"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], ["width" => 501, "height" => 501], BX_RESIZE_IMAGE_EXACT, true,false,false,75)["src"];
		}
		
		if($item["DETAIL_PICTURE"]){
			$item["PICTURE"]["DESCTOP"] = CFile::ResizeImageGet($item["DETAIL_PICTURE"], ["width" => 1257, "height" => 472], BX_RESIZE_IMAGE_EXACT, true,false,false,75)["src"];
		}
		$item["LINK"] = ($item["PROPERTY_URL_SLIDER_VALUE"] ?? '');
	}
}