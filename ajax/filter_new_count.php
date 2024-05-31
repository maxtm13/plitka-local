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

  $sid = 23115;//Временное решение привязка к одной категории
  if ($sec_id > 0) {
      $sid = $sec_id;
  } else {
    $getSection = checkSectionIsActiveByUrl($result['link'], 4);
    if($getSection["ID"]){
      $sid = $getSection["ID"];
    }else{
      $sid = omniGetSIDFromPageUrl(4, '/collections/');
    }
  }
  if ($sid > 0) {
      CModule::IncludeModule('iblock');
      $rSec = CIBlockSection::GetByID($sid);
      $arSec = $rSec->GetNext();
      $form_action = $arSec['SECTION_PAGE_URL'];
  } else {
      $form_action = '/collections/';
  }
  $arNazn = [
      '/collections/aglomeratnaya-plitka',
      '/collections/dekorativnaya-plitka',
      '/collections/keramogranit',
      '/collections/klinker',
      '/collections/mozaika',
      '/collections/napolnaya-plitka',
      '/collections/nastennaya-plitka',
      '/collections/plitka-dlya-basseina',
      '/collections/plitka-dlya-vannoi',
      '/collections/plitka-dlya-kukhni'
  ];
  if (in_array($exdir, $arNazn)) {
      $sid = 0;
      $form_action = $exdir;
  }
  //проверим, находимся ли мы на странице элемента плитки
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
          if (omniIsIBlockElement($codeID) !== false) { //элемент
              $isPlitkaElPage = true;
          }
      }
  }

  if (strpos($form_action, '/collections/') === false) {
      $skipDateAndPermissionsCheck = 'N';
  } else {
      $skipDateAndPermissionsCheck = 'Y';
  }

  global $arrFilter;
  $arrFilter['ACTIVE'] = "Y";


  if ($_SERVER["SCRIPT_URL"]){
      /**
       * Пробрасываем значения для свойства в фильтр
       */
      switch ($_SERVER["SCRIPT_URL"]){
          case '/collections/keramogranit':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 28;
              break;
          }
          case '/collections/nastennaya-plitka':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 23;
              break;
          }
          case '/collections/napolnaya-plitka':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 26;
              break;
          }
          case '/collections/plitka-dlya-vannoi':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 24;
              break;
          }
          case '/collections/aglomeratnaya-plitka':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 5083;
              break;
          }
          case '/collections/dekorativnaya-plitka':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 5231;
              break;
          }
          case '/collections/plitka-dlya-basseina':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 1767;
              break;
          }
          case '/collections/plitka-dlya-kukhni':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 25;
              break;
          }
          case '/collections/klinker':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 29;
              break;
          }
          case '/collections/mozaika':{
              $arrFilter['DEPTH_LEVEL'] = 3;
              $arrFilter['PROPERTY_45'] = 27;
              break;
          }
      }
  }

  file_put_contents(__DIR__ . '/log.txt', print_r($_REQUEST, true) . PHP_EOL, FILE_APPEND);

  $count = $APPLICATION->IncludeComponent(
    "custom:catalog.smart.filter",
    "filter_vertical",
    [
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "4",
        "SECTION_ID" => $sec_id ? $sec_id : 0,
        "FILTER_NAME" => "arrFilter",
        'PREFILTER_NAME'=>'arrFilter',
        "PRICE_CODE" => [    // Тип цены
            0 => "BASE",
        ],
        "SHOW_BORDER" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "360000",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "N",
        "SAVE_IN_SESSION" => "N",
        "XML_EXPORT" => "N",
        "SECTION_TITLE" => "NAME",
        "SECTION_DESCRIPTION" => "DESCRIPTION",
        "FORM_ACTION" => $form_action, //'/filter-tiles/',
        'SEARCH_EVERYWHERE' => '/collections/',
        'SKIP_DATE_AND_PERMISSIONS_CHECK' => $skipDateAndPermissionsCheck,
        'GET_COUNT' => "Y"
    ],
    false,
    ['HIDE_ICONS' => 'N']
  );
  
  if($is_section) {
    echo json_encode(array_merge(["count"=>$count["SEC"]], $count));
  } else {
    echo json_encode(array_merge(["count"=>$count["EL"]], $count));
  }
	
}else
	die();