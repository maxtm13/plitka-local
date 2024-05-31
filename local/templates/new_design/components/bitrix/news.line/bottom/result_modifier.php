<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["ITEMS"]){
	foreach($arResult["ITEMS"] as &$item){
		if($item["PREVIEW_PICTURE"]){
			$item["PICTURE"]["MOBILE"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], ["width" => 480, "height" => 480], BX_RESIZE_IMAGE_EXACT, true,false,false,75)["src"];
		}
		if($item["DETAIL_PICTURE"]){
			$item["PICTURE"]["DESCTOP"] = CFile::ResizeImageGet($item["DETAIL_PICTURE"], ["width" => 1240, "height" => 500], BX_RESIZE_IMAGE_EXACT, true,false,false,75)["src"];
		}
	}
}