<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("BESTSELLERS_SECTIONS_TEMPLATE_NAME"),
	"DESCRIPTION" => GetMessage("BESTSELLERS_SECTIONS_TEMPLATE_DESCRIPTION"),
	"ICON" => "/images/sections_top_count.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "omniweb",
		"CHILD" => array(
			"ID" => "e-store",
			"NAME" => GetMessage("T_IBLOCK_DESC_E_STORE")
		),
	),
);

?>