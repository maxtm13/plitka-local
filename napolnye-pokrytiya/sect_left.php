<?php
if ($_REQUEST['sec_id'] > 0) {
    $sid = $_REQUEST['sec_id'];
} else {
   $getSection = checkSectionIsActiveByUrl($_SERVER["REQUEST_URI"], 9);
	if($getSection["ID"]){
		$sid = $getSection["ID"];
	}else{
    $sid = omniGetSIDFromPageUrl(9, '/napolnye-pokrytiya/');
	}
}

if ($sid > 0) {
    CModule::IncludeModule('iblock');
    $rSec = CIBlockSection::GetByID($sid);
    $arSec = $rSec->GetNext();
    $form_action = $arSec['SECTION_PAGE_URL'];
} else {
    $form_action = '/napolnye-pokrytiya/';
}

if (strpos($form_action, '/napolnye-pokrytiya/') !== false) {
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
        if (omniIsIBlockElement($codeID, 9) !== false) { //элемент
            $isPlitkaElPage = true;
        }
    }
}

if(!$isPlitkaElPage){

	global $arrFilter;
	$arrFilter['IBLOCK_ID'] = 9;
	?>
	<? $APPLICATION->IncludeComponent(
		 "custom:catalog.smart.filter",
		 "filter_vertical",
		 [
			  "IBLOCK_TYPE" => "catalog",
			  "IBLOCK_ID" => "9",
			  "SECTION_ID" => $sid, //'',//$el['ID'],
			  "FILTER_NAME" => "arrFilter",
			  "PRICE_CODE" => [    // Тип цены
					0 => "BASE",
			  ],
			  "CACHE_TYPE" => "A",
			  "CACHE_TIME" => "360000",
			  "CACHE_NOTES" => "",
			  "CACHE_GROUPS" => "N",
			  "SAVE_IN_SESSION" => "N",
			  "PREFILTER_NAME"=>'arrFilter',
			  "XML_EXPORT" => "Y",
			  "SECTION_TITLE" => "NAME",
			  "SECTION_DESCRIPTION" => "DESCRIPTION",
			  "FORM_ACTION" => $form_action, //'/filter-floor/',
			  'SKIP_DATE_AND_PERMISSIONS_CHECK' => $skipDateAndPermissionsCheck,
			 "BACK_URL" => $APPLICATION->GetCurDir(),
			 'SEARCH_EVERYWHERE' => '/napolnye-pokrytiya/',
			  /*"SECTION_CODE" => "#SECTION_CODE#",
			  "SECTION_CODE_PATH" => "#SECTION_CODE_PATH#",
			  "SEF_MODE" => "Y",
			  "SEF_RULE" => "#SECTION_CODE_PATH#filter/#SMART_FILTER_PATH#/apply/",
			  "SMART_FILTER_PATH" => "#SMART_FILTER_PATH#",*/
		 ],
		 false,
		 ['HIDE_ICONS' => 'Y']
	); 
}
?>