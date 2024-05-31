<?php
global $isniceSer;

global $arrFilter;
$arrFilter['IBLOCK_ID'] = 11;

if(!empty($isniceSer)){
	
	CModule::IncludeModule('iblock');
	
	foreach($isniceSer as $links){
		if(strpos($links,'sec_id') !== false){
			
			$query = [];
			$setPath = '';
			$parts = parse_url($links);
			parse_str($parts['query'], $query);
			if($query["sid"]){
				$sid = $query["sid"];
			}
			unset($query["clear_cache"], $query["sid"], $query["set_filter"]);

			foreach($query as $k=>$fil){

				$exFill = explode("_",$k);

				if($exFill[0] == "arrFilter" && $exFill[2] != "MIN" && $exFill[2] != "MAX"){
					$arrFilter['PROPERTY_'.$exFill[1]] = $exFill[2];
				}
			}
		}
	}
	
/*	
echo "<!--<pre>";
print_r($sid);
echo "</pre>-->";
echo "<!--<pre>";
print_r($form_action);
echo "</pre>-->";
echo "<!--<pre>";
print_r($_REQUEST);
echo "</pre>-->";
*/
}


echo "<!--<pre>";
print_r($_REQUEST);
echo "</pre>-->";


global $APPLICATION;

if(strpos($_SERVER["REQUEST_URI"], "?" && empty($isniceSer))){
	
	$exdir = explode('?', $_SERVER["REQUEST_URI"]);
	
	$exdir = explode('&', $exdir[1]);
	
	foreach($exdir as $k=>$exirt){
		$isReq = explode('=', $exirt);
		if($isReq[0] != 'set_filter'){
			$_REQUEST[$isReq[0]] = $isReq[1];
		}
	}
}


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

$dustom = '';
$dustom = SET_CUSTOM;

if($_SERVER['REQUEST_URI'] != $_SERVER["SCRIPT_URL"] && $dustom == "Y"){
	$query = [];
	$setPath = '';
	$parts = parse_url($_SERVER['REQUEST_URI']);
	parse_str($parts['query'], $query);
	if($query["sid"]){
		$sid = $query["sid"];
	}
	unset($query["clear_cache"], $query["sid"], $query["set_filter"]);
	
	foreach($query as $k=>$fil){
		
		$exFill = explode("_",$k);
		
		if($exFill[0] == "arrFilter" && $exFill[2] != "MIN" && $exFill[2] != "MAX"){
			$arrFilter['PROPERTY_'.$exFill[1]] = $exFill[2];
		}
	}
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

/*
echo "<!--<pre>";
print_r($arrFilter);
echo "</pre>-->";
*/
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
		 'SEARCH_EVERYWHERE' => '/napolnye-pokrytiya/',
    ],
    false,
    ['HIDE_ICONS' => 'Y']
);
}?>