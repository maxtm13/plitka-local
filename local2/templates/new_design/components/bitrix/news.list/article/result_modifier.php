<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if($arResult["ITEMS"]){
	foreach($arResult["ITEMS"] as &$item){
		if(!empty($item["PREVIEW_PICTURE"]["ID"])){
			$item["PICTURE"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], ["width" => 438, "height" => 438], BX_RESIZE_IMAGE_EXACT,true,false,false,85)["src"];
		}else{
			$item["PICTURE"] = "/image/new_design/empty.jpg";
		}
	}
}