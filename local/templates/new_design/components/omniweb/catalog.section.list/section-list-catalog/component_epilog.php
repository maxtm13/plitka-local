<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global $APPLICATION;
// устанавливаем тител 
if ($arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) {
    $APPLICATION->SetTitle($arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]);
}
