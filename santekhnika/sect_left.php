<?php

if(empty($sid)){
	if ($_REQUEST['sec_id'] > 0) {
		$sid = $_REQUEST['sec_id'];
	} else {
		$sid = omniGetSIDFromPageUrl(11);
	}
}
if ($sid > 0) {
    CModule::IncludeModule('iblock');
    $rSec = CIBlockSection::GetByID($sid);
    $arSec = $rSec->GetNext();
    $form_action = $arSec['SECTION_PAGE_URL'];
} else {
    $form_action = '/santekhnika/';
}

if (strpos($form_action, '/santekhnika/') !== false) {
    $skipDateAndPermissionsCheck = 'Y';
} else {
    $skipDateAndPermissionsCheck = 'N';
}

$isPlitkaElPage = false;
$curPagePath = $APPLICATION->GetCurPage(); //получаем адрес тек. страницы
$filterCatalogPath = $curPagePath;
if ($curPagePath[0] == '/') {
    //если адрес нач. со слэша, удаляем его
    $curPagePath = substr($curPagePath, 1);
}
if ($curPagePath[strlen($curPagePath) - 1] == '/') {
    //если адрес оканч. слэшом, удаляем его
    $curPagePath = substr($curPagePath, 0, -1);
    $filterCatalogPath = $curPagePath;

}
if (!empty($curPagePath) && empty($getSection) ) {
    $curPagePath = explode('/', $curPagePath); //разбиваем адрес
    $codeID = $curPagePath[count($curPagePath) - 1]; //берём последнее значение
    if (!empty($codeID)) {
        if (omniIsIBlockElement($codeID, 11) !== false) { //элемент
            $isPlitkaElPage = true;
        }
    }
}

if(!$isPlitkaElPage){
?>
<? $APPLICATION->IncludeComponent(
    "custom:catalog.smart.filter",
    "filter_vertical",
    [
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "11",
        "SECTION_ID" => $sid, //$arSec['ID'], //'', //$el['ID'],
        "FILTER_NAME" => "arrFilter",
        "PRICE_CODE" => [    // Тип цены
            0 => "BASE",
        ],
        "CACHE_TYPE" => "A",
        'PREFILTER_NAME'=>'arrFilter',
        "CACHE_TIME" => "36000000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "Y",
        "SAVE_IN_SESSION" => "N",
        "XML_EXPORT" => "Y",
        "SECTION_TITLE" => "NAME",
        "SECTION_DESCRIPTION" => "DESCRIPTION",
        "FORM_ACTION" => $form_action, //$APPLICATION->GetCurPage(), // '/filter-sant/',
        'SKIP_DATE_AND_PERMISSIONS_CHECK' => $skipDateAndPermissionsCheck,
		 "BACK_URL" => $APPLICATION->GetCurDir(),
		 'SEARCH_EVERYWHERE' => '/santekhnika/',
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
}?>