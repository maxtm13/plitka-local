<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arResult["ID"]):
$APPLICATION->AddChainItem($arResult["NAME"]);
$APPLICATION->SetPageProperty("title", $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]);
$APPLICATION->SetPageProperty("description", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]." {".$dpage."}");
$APPLICATION->SetTitle(($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] : $arResult["NAME"]));
endif;
