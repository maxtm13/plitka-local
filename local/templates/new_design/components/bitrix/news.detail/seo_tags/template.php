<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arResult["ID"]):
if(empty($arParams["PAGEN"])){
	define("PAGE_TOP_TEXT", trim($arResult["PREVIEW_TEXT"]));
	define("PAGE_BOTTOM_TEXT", trim($arResult["DETAIL_TEXT"]));
	define("SEO_BOTTOM_TEXT", trim($arResult["DETAIL_TEXT"]));
}
if ($arParams['PAGEN'] > 1) {
	$dpage = " Страница {$arParams['PAGEN']}.";
}
	define("PAGE_TITLE", trim($arResult["NAME"]));
	define("SET_META_TITLE", "N");
	define("SET_CUSTOM", "N");
endif;
