<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["ITEMS"]){
	foreach($arResult["ITEMS"] as &$item){
		if($item["PREVIEW_PICTURE"]){
			$item["PICTURE"]["MOB"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], ["width" => 315, "height" => 220], BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true,false,false,75)["src"];
			$item["PICTURE"]["BIG"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], ["width" => 1240, "height" => 1240], BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true,false,false,75)["src"];
		}
	}
	console($arResult["ITEMS"]);
}