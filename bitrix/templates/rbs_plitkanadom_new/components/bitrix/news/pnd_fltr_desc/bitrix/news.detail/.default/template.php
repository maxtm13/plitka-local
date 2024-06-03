<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php /*$filter_prop_id = $arResult['SECTION_UF']['UF_FLTR_PROP_ID'];
if ($arResult['DISPLAY_PROPERTIES']['FLTR_'.$filter_prop_id]['MULTIPLE'] == 'N') {
	$val = explode(']', $arResult['DISPLAY_PROPERTIES']['FLTR_'.$filter_prop_id]['VALUE']);
	$val = substr($val[0], 1);
}
$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_".$filter_prop_id => $val); ?>
<?$arSecPagen = $APPLICATION->IncludeComponent(
	"omniweb:catalog.section.list",
	"section-list",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => array("",""),
		"SECTION_USER_FIELDS" => array("UF_82","UF_91","UF_92"),
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "N",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_SECTION_NAME" => "N",
		"FILTER_NAME" => "arrFilter",
		"SECTION_COUNT" => "20",
		"PAGER_TEMPLATE" => "arrows",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Разделы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y"
	)
);*/?>
<?if((!isset($_REQUEST['PAGEN_'.$arParams['PND_SEC_PAGEN']['NavNum']]) || $_REQUEST['PAGEN_'.$arParams['PND_SEC_PAGEN']['NavNum']] == 1) && !empty($arResult['DETAIL_TEXT'])):?>
	<div class="page-description">
		<?/*<h1><?=$arResult["NAME"]?></h1>*/?>
		<?if($arResult["NAV_RESULT"]):?>
			<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
			<?echo $arResult["NAV_TEXT"];?>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
		<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
			<?echo $arResult["DETAIL_TEXT"];?>
		<?else:?>
			<?echo $arResult["PREVIEW_TEXT"];?>
		<?endif?>
	</div>
<?endif;?>