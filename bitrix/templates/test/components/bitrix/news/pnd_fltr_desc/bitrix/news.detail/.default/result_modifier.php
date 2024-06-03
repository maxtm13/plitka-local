<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//print_r($arResult);
if (CModule::IncludeModule('iblock')) {
	$rSec = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ID'=>$arResult['IBLOCK_SECTION_ID']), false, array('ID', 'UF_*'));
	if ($arSec = $rSec->getNext()) {
		$arResult['SECTION_UF'] = $arSec;
	}
}
?>