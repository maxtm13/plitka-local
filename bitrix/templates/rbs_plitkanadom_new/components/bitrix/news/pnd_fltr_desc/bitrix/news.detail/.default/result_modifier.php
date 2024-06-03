<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//print_r($arResult);
if (CModule::IncludeModule('iblock')) {
	$rSec = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ID'=>$arResult['IBLOCK_SECTION_ID']), false, array('ID', 'UF_*'));
	if ($arSec = $rSec->getNext()) {
		$arResult['SECTION_UF'] = $arSec;
	}
}

$resultPagenName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
if (!empty($_GET[$resultPagenName])) {
    $getParamPagen = $arResult['NAV_RESULT']->NavPageNomer;
    if ($getParamPagen > 1) {
        $pagen = 'Страница ' . $getParamPagen . '. ';
        //заголовок браузера
        $page_prop = $pagen . $APPLICATION->GetProperty('title');
        $APPLICATION->SetPageProperty('title', $page_prop);
        //описание
        $page_prop = $pagen . $APPLICATION->GetProperty('description');
        $APPLICATION->SetPageProperty('description', $page_prop);

    }
}