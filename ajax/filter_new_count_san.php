<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(is_array($_POST) && $_POST["ajax"] == "Y"){
	CModule::IncludeModule("iblock");
	$links = $checkUrl = [];
	
	$exdir = htmlspecialchars($_POST["dir"]);
	$exback =  htmlspecialchars($_POST["back"]);
	$sec_id =  htmlspecialchars($_POST["sec_id"]);
  $is_section = false;
  if(array_key_exists("is_section", $_POST)) {
    $is_section = true;
  }
	
	if(strlen($exdir) > strlen($exback)){
		$dir = $exback;
		$back = $exdir;
	}else{
		$dir = $exdir;
		$back = $exback;
	}
	
	unset($_POST["dir"], $_POST["back"], $_POST["sec_id"], $_POST["ajax"]);
	$just = false;
	
	$checkUrl[0] = $dir;
	
	if(!empty($back) && $dir != $back){
		$checkUrl[1] = $back;
	}
	
	$i = '0';
	foreach($_POST as $k=>$post){
		if(strpos($k, "arrFilter") !== false && !empty($post)){ 
			$i++;
			if($i == 1 && !empty($sec_id)){
				$checkUrl[0] = $checkUrl[0]."?sec_id=".$sec_id;
			}
			$checkUrl[0] = $checkUrl[0].($i == 1 && empty($sec_id) ? "?" : '&').$k."=".$post;
			if(!empty($checkUrl[1])){
				$checkUrl[1] = $checkUrl[1].($i == 1 ? "?" : '&').$k."=".$post;
			}
		}
	}
	
	if($i > 0){
		$checkUrl[0] = $checkUrl[0]."&set_filter=Y";
		if(!empty($checkUrl[1])){
			$checkUrl[1] = $checkUrl[1]."&set_filter=Y";
		}
	}
		
	$result["check"] = $checkUrl;
	
	if(count($checkUrl)>0){
		$res = CIBlockElement::GetList(["ID"=>"ASC"], ["IBLOCK_ID"=>33, "PROPERTY_NEW_REAL_1"=>$checkUrl, "ACTIVE"=>"Y"], false, [], ["ID","PROPERTY_NEW"])->GetNext()[ "PROPERTY_NEW_VALUE"];
		if(!empty($res)){
			$result['link'] = $res;
		}else{
			$res = CIBlockElement::GetList(["ID"=>"ASC"], ["IBLOCK_ID"=>33, "PROPERTY_NEW_REAL_2"=>$checkUrl, "ACTIVE"=>"Y"], false, [], ["ID","PROPERTY_NEW"])->GetNext()[ "PROPERTY_NEW_VALUE"];
			if(!empty($res)){
				$result['link'] = $res;
			}else{
				$result['link'] = ($checkUrl[1] ?? $checkUrl[0]);
			}
		}
	}else{
		$result['link'] = ($checkUrl[1] ?? $checkUrl[0]);
	}


if ($sec_id > 0) {
		$sid = $sec_id;
	} else {
		$sid = omniGetSIDFromPageUrl(11);
	}

//$sid = 0;

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
$curPagePath = $exdir; //получаем адрес тек. страницы
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

  $count = $APPLICATION->IncludeComponent(
    "custom:catalog.smart.filter",
    "filter_vertical",
    [
      "IBLOCK_TYPE" => "catalog",
      "IBLOCK_ID" => "11",
      "SECTION_ID" => $sid,
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
      "FORM_ACTION" => $form_action,
      'SKIP_DATE_AND_PERMISSIONS_CHECK' => $skipDateAndPermissionsCheck,
      'SEARCH_EVERYWHERE' => '/santekhnika/',
      'GET_COUNT' => "Y"
    ],
    false,
    ['HIDE_ICONS' => 'Y']
  );

  if($is_section) {
    echo json_encode(array_merge(["count"=>$count["SEC"]], $count));
  } else {
    echo json_encode(array_merge(["count"=>$count["EL"]], $count));
  }

}else
die();