<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["DETAIL_PICTURE"]["ID"]))
	$arResult["PICTURE"]["BIG"] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], ["width" => 1280, "height" => 1280], BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,85)["src"];

if(!empty($arResult["PREVIEW_PICTURE"]["ID"]))
	$arResult["PICTURE"]["MIN"] = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], ["width" => 438, "height" => 438], BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,85)["src"];