<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["ITEMS"]){
	foreach($arResult["ITEMS"] as &$item){
		if($item["PREVIEW_PICTURE"]){
			$item["PICTURE"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], ["width" => 152, "height" => 152], BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,75)["src"];
		}
	}
}