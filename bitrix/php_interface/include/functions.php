<?

function getNumEnding($number, $endingArray)
{
    $number = $number % 100;
    if ($number>=11 && $number<=19) {
        $ending=$endingArray[2];
    }
    else {
        $i = $number % 10;
        switch ($i)
        {
            case (1): $ending = $endingArray[0]; break;
            case (2):
            case (3):
            case (4): $ending = $endingArray[1]; break;
            default: $ending=$endingArray[2];
        }
    }
    return $ending;
}

function OnPageRequest() {
	global $APPLICATION;
	
	$dir = $iblock = '';
	$ew = $ex = $exx = $result = $sect = [];
	
	$needcheck = ["collections","napolnye-pokrytiya","santekhnika"];
	
	$iblocks = [
		"collections" => 4,
		"napolnye-pokrytiya" => 9,
		"santekhnika" => 11,
	];
	
	CModule::IncludeModule('iblock');
	
	$dir = $_SERVER["REQUEST_URI"];
	$dirs = $_SERVER["SCRIPT_URL"];
	
	$ew = explode('?', $dir);
	
	$havelink = $stop = false;
		
	$find[] = $ew[0];

	if(!empty($_SERVER["SCRIPT_URL"])){
		$find[] = $_SERVER["SCRIPT_URL"];
	}
	if(!empty($_SERVER["REQUEST_URL"])){
		$find[] = $_SERVER["REQUEST_URL"];
	}

	$resSec = CIBlockElement::GetList([], ['IBLOCK_ID' => 33, "ACTIVE"=>"Y", "=PROPERTY_NEW"=> $find], false, false, ["IBLOCK_ID","NAME","PROPERTY_NEW_REAL_1","PROPERTY_NEW_REAL_2","PROPERTY_NEW"])->GetNext();
	
	if(!empty($resSec)){
		if(!empty($resSec["PROPERTY_NEW_REAL_1_VALUE"])){

			$sect = explode("?",$resSec["PROPERTY_NEW_REAL_1_VALUE"]);
			$ex = explode('/', $resSec["PROPERTY_NEW_REAL_1_VALUE"]);
			$iblock = $iblocks[$ex[1]];

			if(!empty($ex[2])){
				$ex[2] = str_replace("?","",$ex[2]);
				$exx = explode('&', $ex[2]);

				foreach($exx as $arl){
					$exxx = [];
					$exxx = explode('=', $arl);
					$_REQUEST[$exxx[0]] = $exxx[1];
				}
				$_SERVER['REQUEST_URI'] = $resSec["PROPERTY_NEW_REAL_1_VALUE"];
				$havelink = true;
			}
		}elseif(!empty($resSec["PROPERTY_NEW_REAL_2_VALUE"])){
			$ex = explode("?",$resSec["PROPERTY_NEW_REAL_2_VALUE"]);
			$sect = explode('/', $resSec["PROPERTY_NEW_REAL_2_VALUE"]);
			$iblock = $iblocks[$sect[0]];

			if(!empty($ex[1])){
				$exx = explode('&', $ex[1]);

				foreach($exx as $arl){
					$exxx = [];
					$exxx = explode('=', $arl);
					$_REQUEST[$exxx[0]] = $exxx[1];
				}
				$_SERVER['REQUEST_URI'] = $resSec["PROPERTY_NEW_REAL_2_VALUE"];
				$havelink = true;
			}
		}

		if($havelink == true){
			$_GET = $_REQUEST;
			$APPLICATION->reinitPath();
		}
	}
}

function theEnding($value = 1, $status = array('','а','ов')) {
    $array = array(2,0,1,1,1,2);
    return $status[($value % 100 > 4 && $value % 100 < 20)? 2 : $array[($value % 10 < 5) ? $value % 10 : 5]];
}

function getCurrecy(){
	
	CModule::IncludeModule('catalog');
	
	$res = CCurrency::GetList(($by="name"), ($order1="asc"), LANGUAGE_ID);
	$arCurrency = array();
	while($cur_res = $res->Fetch())
	{
		if(!empty($cur_res['BASE']) && $cur_res['BASE'] == 'Y') continue;

		$result[$cur_res['CURRENCY']] = $cur_res['AMOUNT'];
	}
	$result['RUB'] = 1;

	return $result;
}

function getViewedProductsID(){
	\Bitrix\Main\Loader::includeModule('sale');
	\Bitrix\Main\Loader::includeModule('catalog');

	$emptyProducts = array();
	$skipUserInit = false;
	
	if (!Bitrix\Catalog\Product\Basket::isNotCrawler())
		$skipUserInit = true;
	
	$basketUserId = (int)CSaleBasket::GetBasketUserID($skipUserInit);
	
	$filter = array('=FUSER_ID' => $basketUserId, '=SITE_ID' => SITE_ID);

	$viewedIterator = Bitrix\Catalog\CatalogViewedProductTable::getList(array(
		'select' => array('PRODUCT_ID', 'ELEMENT_ID'),
		'filter' => $filter,
		'order' => array('DATE_VISIT' => 'ASC'),
		'limit' => 10
	));
	unset($filter);

	while ($viewedProduct = $viewedIterator->fetch())
	{
		$viewedProduct['ELEMENT_ID'] = (int)$viewedProduct['ELEMENT_ID'];
		$viewedProduct['PRODUCT_ID'] = (int)$viewedProduct['PRODUCT_ID'];
		$map[$viewedProduct['PRODUCT_ID']] = $viewedProduct['ELEMENT_ID'];
		if ($viewedProduct['ELEMENT_ID'] <= 0)
			$emptyProducts[] = $viewedProduct['PRODUCT_ID'];
	}

	if (!empty($emptyProducts))
	{
		$emptyProducts = Bitrix\Catalog\CatalogViewedProductTable::getProductsMap($emptyProducts);
		if (!empty($emptyProducts))
		{
			foreach ($emptyProducts as $product => $parent)
			{
				$map[$product] = $parent;
			}
		}
	}
	unset($filter);
	
	return $map;
}

function getVideoReviewfromFile(){
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/local/ajax/video_views.json');
    $result = json_decode($content);

    return $result;
}

// remove double slashes
function rds($uri, $step="start") {
	$new_uri = str_replace("//", "/", $uri);
	if (strpos($uri, "//") !== false) {
		rds($new_uri, "continue");
	} else {
		if (strpos($new_uri, "//") !== false){
			rds($new_uri,"continue");
		} elseif($step != "start") {
			header("HTTP/1.1 301 Moved Permanently");
			header('Location: https://' . $_SERVER['SERVER_NAME'] . $new_uri);
			exit();            
		}
	}
}

// создаем обработчик события "BeforeIndex"
function BeforeIndexHandler($arFields){
	if(!CModule::IncludeModule("iblock")) // подключаем модуль
	return $arFields;
	
	if($arFields["MODULE_ID"] == "iblock"){

		$arFields["TITLE"] .= " ".$arFields["ITEM_ID"]; // Добавим свойство в конец заголовка индексируемого элемента

		return $arFields; // вернём изменения
	}
}

function delete_type(&$content) {
    $content = preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $content);
}

function checkUrl() {
	
	global $APPLICATION;	

    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        return true;
    }

    $url   = $APPLICATION->GetCurPage();
	
    if (strpos($url, '%20') !== false || strpos($url, ' ') !== false) {
		define("ERROR_404",  "Y");
    }else{
		$exurl = explode('/',$url);

		$allinone = ['collections', 'napolnye-pokrytiya', 'santekhnika', 'sukhie-stroitelnye-smesi'];

		if(in_array($exurl[1], $allinone) && empty(end($exurl)) && count($exurl)>3){
			
			if($exurl[2] == "brand" && empty($exurl[3])){
				//
			}else{

				$keys = array_keys($exurl);

				unset($exurl[end($keys)]);

				$urlx = implode('/',$exurl);

				header("HTTP/1.1 301 Moved Permanently");
				header('Location: https://' . $_SERVER['SERVER_NAME'] . $urlx);
				exit();
			}
		}
	}
}

/**
 * Функция-обработчик события изменения инфоблока. Проверяет необходимость создания новых пользовательских свойств, которые
 * будут использоваться для фильтрации разделов с использованием "умного" фильтра Bitrix
*/
function bxUpdateIBlock(&$arFields) {
    if ($arFields['ID'] == CATALOG_ID) {

        // Получение пользовательских свойств для инфоблока каталога
        $res = CUserTypeEntity::GetList([], ["ENTITY_ID" => "IBLOCK_" . $arFields['ID'] . "_SECTION"]);
        $arUserProp = [];
        while ($prop = $res->GetNext()) {
            $arUserProp[] = $prop['FIELD_NAME'];
        }

        $arSmartProp = [];

        // Свойства, связанные с инфоблоком каталога
        $arPropLinks = CIBlockSectionPropertyLink::GetArray($arFields['ID'], 0);
        if (!empty($arPropLinks)) {
            foreach ($arPropLinks as $key => $val) {
                // Отбираем свойства, которые должны отображаться в умном фильтре и не были добавлены в пользовательские свойства
                if ($val['SMART_FILTER'] == 'Y' && !in_array('UF_' . $key, $arUserProp)) {
                    $arSmartProp['UF_' . $key] = $val;
                }
            }
        }

        if (count($arSmartProp)) {
            // добавляем новые пользовательские свойства
            foreach ($arSmartProp as $name => $prop) {
                $arUserFields = [
                    "ENTITY_ID" => "IBLOCK_{$arFields['ID']}_SECTION",
                    "FIELD_NAME" => $name,
                    "USER_TYPE_ID" => 'string',
                    "MULTIPLE" => "Y",
                    "EDIT_IN_LIST" => "Y",
                ];
                $obUserField = new CUserTypeEntity();
                $obUserField->Add($arUserFields);
            }
        }
    }
}

/*
 * Функция копирует свойства всех элементов раздела в соответствующие пользовательские свойства для раздела
 * @param integer $iblock Идентификатор инфоблока
 * @param integer $section Идентификатор раздела
 * @param integer $price_type Идентификатор типа цены
 * @param string $user_prefix Префикc пользовательских полей (необязательный)
 */
function SetSectionProps($iblock, $secid, $price_type, $user_prefix = "UF_") {
    if (CModule::IncludeModule('iblock')) {

		 // Выберем свойства, которые должны отображаться в умном фильтре
		 $arPropLinks = CIBlockSectionPropertyLink::GetArray($iblock, 0);

		 // Массив идентификаторов свойств флажков (хит, скидка, наличие образца), которые не нужно отображать в умном фильтре, но необходимы для отображения раздела
		 $arException = [91, 92, 82, 49];

		 if (empty($arPropLinks)) {
			  return;
		 }

		 $arSelect = ["IBLOCK_ID", "ID", "CATALOG_PRICE_". $price_type, "PROPERTY_AVAILABILITY"];
		 $arPropValue = []; // список значений всех свойств
		 $hav = false;

	// Не будем разбирать что за плитка, берем первую.

		 $obElement = CIBlockElement::GetList(["CATALOG_PRICE_" . $price_type => "ASC", "ACTIVE" => "Y", "PROPERTY_AVAILABILITY" != "Нет в наличии"],
			  ["IBLOCK_ID" => $iblock, "SECTION_ID" => $secid], false, ["nTopCount" => 1], $arSelect);
		 while ($arElement = $obElement->GetNext()) {
			 if($arElement){
				 $hav = true;
				 $arPropValue["UF_CATALOG_PRICE_" . $price_type] = $arElement["CATALOG_PRICE_" . $price_type];
				 $arPropValue["ACTIVE"] = "Y";
			 }
		 }

		if($hav != true){
			$arPropValue["ACTIVE"] = "N";
		}else{
			 $getSection = CIBlockSection::GetByID($secid);
			 if($ar_res = $getSection->GetNext()){
				$arPropValue["NAME"] = $ar_res['NAME'];
			 }

			 $wdwd["NAME"] = $arPropValue["NAME"];
			 $wdwd["ACTIVE"] = "Y";
			 $wdwd["SORT"] = 500;
			 $wdwd["UF_AVAILABILITY"] = '';
			 $wdwd["UF_CATALOG_PRICE_" . $price_type] = (int)$arPropValue["UF_CATALOG_PRICE_" . $price_type];
		}

		$bs = new CIBlockSection();
		$res = $bs->Update($secid, $wdwd);
	}
}

/*
 * Функция копирует свойства всех элементов раздела в соответствующие пользовательские свойства для раздела
 * @param integer $iblock Идентификатор инфоблока
 * @param integer $section Идентификатор раздела
 * @param integer $price_type Идентификатор типа цены
 * @param string $user_prefix Префикc пользовательских полей (необязательный)
 */
function SetSectionPropsFromAllElems($iblock, $section, $price_type, $user_prefix = "UF_") {
    if (!CModule::IncludeModule('iblock')) {
        return;
    }

    // Выберем свойства, которые должны отображаться в умном фильтре
    $arPropLinks = CIBlockSectionPropertyLink::GetArray($iblock, 0);

    // Массив идентификаторов свойств флажков (хит, скидка, наличие образца), которые не нужно отображать в умном фильтре, но необходимы для отображения раздела
    $arException = [91, 92, 82];

    if (empty($arPropLinks)) {
        return;
    }

    $arSelect = ["IBLOCK_ID", "ID", "CATALOG_GROUP_" . $price_type, "PROPERTY_AVAILABILITY"];
    $arPropValue = []; // список значений всех свойств
    foreach ($arPropLinks as $key => $prop) {
        if ($prop['SMART_FILTER'] != 'Y' && !in_array($key, $arException)) {
            unset($arPropLinks[$key]);
        } else {
            $arSelect[] = "PROPERTY_" . $key;
            $arPropValue[$user_prefix . $key] = [];
        }
    }
    // Выберем для текущего раздела все значения свойств элементов
    $arPropValue["UF_CATALOG_PRICE_" . $price_type] = 0;
    $arPropValue["UF_AVAILABILITY"] = "";
    $arPropValue["SORT"] = 500;
    $firstPrice = 0;
    $notAvailable = true;

    $obElement = CIBlockElement::GetList(["SORT" => "ASC", "ID" => "ASC"],
        ["IBLOCK_ID" => $iblock, "SECTION_ID" => $section, 'ACTIVE' => 'Y'], false, false, $arSelect);
    while ($arElement = $obElement->GetNext()) {
        if (empty($firstPrice)) { //1-й элемент
            //устанавливаем цену
            $arPropValue["UF_CATALOG_PRICE_" . $price_type] = $arElement["CATALOG_PRICE_" . $price_type];
            $firstPrice = $arElement["CATALOG_PRICE_" . $price_type];
        }
        //устанавливаем флаг наличие
        if (empty($arElement["PROPERTY_AVAILABILITY_VALUE"]) || (!empty($arElement["PROPERTY_AVAILABILITY_VALUE"]) && $arElement["PROPERTY_AVAILABILITY_VALUE"] != "Нет в наличии")) {
            $notAvailable = false;
        }

        foreach ($arPropLinks as $id => $prop) {
            if ($prop['PROPERTY_TYPE'] == 'N') {
                $sPropName = "PROPERTY_" . $id . "_VALUE";
            } else {
                $sPropName = "PROPERTY_" . $id . "_ENUM_ID";
            }
            if (!empty($arElement[$sPropName]) && !in_array($arElement[$sPropName], $arPropValue[$user_prefix . $id])) {
                $arPropValue[$user_prefix . $id][] = $arElement[$sPropName];
            }
        }
    }

    //устанавливаем наличие
    if ($notAvailable) {
        $arPropValue["UF_AVAILABILITY"] = "Нет в наличии";
        $arPropValue["SORT"] = 999;
    }

    // Добавим свойства к разделу
    if (CIBlockSection::GetByID($section)) {
        $newSection = new CIBlockSection();
        $newSection->Update($section, $arPropValue);
    }
}

/* Обработчик события добавления товара в каталог */
function bxProductAdd($ID, $arFields) {
    // Проверим наличие единицы измерения в свойстве
    if (CModule::IncludeModule('iblock') && CModule::IncludeModule('catalog')) {
        //получим информацию об элементе
        $rEl = CIBlockElement::GetByID($ID);
        $arEl = $rEl->Fetch();
        if (in_array($arEl['IBLOCK_ID'], [CATALOG_ID, CATALOG_FLOOR_ID])) {
            /*$arMeasure = array(
                5 => 'шт.',
                6 => 'кв. м.',
                7 => 'компл.',
                8 => 'пог. м.',
            ); // список единиц измерения*/

            //получим список ед. изм. торгового каталога
            $arMeasure = [];
            $rM = CCatalogMeasure::GetList();
            while ($arM = $rM->Fetch()) {
                $arMeasure[$arM['ID']] = $arM['SYMBOL_RUS'];
            }
            $arFilter = [
                "IBLOCK_ID" => $arEl['IBLOCK_ID'], //CATALOG_ID,
                "ID" => $ID,
            ];
            switch ($arEl['IBLOCK_ID']) {
                case CATALOG_ID:
                    $unitsPropCode = 'UNITS_TMP';
                    break;
                case CATALOG_FLOOR_ID:
                    $unitsPropCode = 'MEASURE';
                    break;
            }
            $arSelect = ["ID", "IBLOCK_ID", "PROPERTY_" . $unitsPropCode];
            $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
            if ($item = $res->Fetch()) {
                if (!empty($item['PROPERTY_' . $unitsPropCode . '_VALUE'])) {
                    if ($mesID = array_search(trim($item['PROPERTY_' . $unitsPropCode . '_VALUE']), $arMeasure)) {
                        CCatalogProduct::Update($item['ID'], ["MEASURE" => $mesID]);
                    }
                }
            }
        }
    }
}

/* Обработчик отрабатывает до отправки письма с информацией о новом заказе. Расширяем стандартный набор полей */
function bxModifySaleMails($orderID, &$eventName, &$arFields, $statusVar = '') {
    if (CModule::IncludeModule('sale')) {
        // Получение свойств заказа
        $arFields['PHONE'] = '';
        $arFields['COMMENT'] = '';
        $arFields['DELIVERY'] = '';
        $arFields['PAY_SYSTEM'] = '';
        $arFields['TEXTMANAGERSALE'] = '';

        $orderProps = CSaleOrderPropsValue::GetOrderProps($orderID);
        $arAddress = [];
        $manager = '';
        while ($arProps = $orderProps->GetNext()) {
            if ($arProps['CODE'] == 'FIO') {
                $arFields["USER"] = $arProps["VALUE"];
            }

            if ($arProps['CODE'] == 'LOCATION') {
                // получим значение местоположения
                $arVal = CSaleLocation::GetByID($arProps["VALUE"], LANGUAGE_ID);
                $arFields['LOCATION'] = $arVal["COUNTRY_NAME"] . ",  " . $arVal["CITY_NAME"];
            } elseif ($arProps['CODE'] == 'PHONE') {
                $arFields[$arProps['CODE']] = $arProps['VALUE'];
            }

            if ($arProps['CODE'] == 'TEXTMANAGERSALE') {
                $arFields['TEXTMANAGERSALE'] = $arProps['VALUE'];
            }

            if ($arProps['CODE'] == 'managersi') {
                //т.к. св-во имеет тип список, то в нём хранится ID значения, получим информацию по этому ID
                $arVal = CSaleOrderPropsVariant::GetByValue($arProps['PROP_ID'], $arProps['VALUE']);
                $manager = $arVal['NAME'];
            }
        }

        // Получение информации о заказе
        $arOrder = CSaleOrder::GetByID($orderID);

        if (empty($arOrder)) {
            return;
        }

        if (!empty($arOrder['DELIVERY_ID'])) {
            // получим способ доставки
            $arDeliv = CSaleDelivery::GetByID($arOrder['DELIVERY_ID']);
            if ($arDeliv) {
                $arFields['DELIVERY'] = $arDeliv['NAME'];
            }
        }

        if (!empty($arOrder['PAY_SYSTEM_ID'])) {
            // получить способ оплаты
            $arPay = CSalePaySystem::GetByID($arOrder['PAY_SYSTEM_ID']);
            if ($arPay) {
                $arFields['PAY_SYSTEM'] = $arPay['NAME'];
            }
        }

        if (empty($arFields['DELIVERY'])) {
            $arFields['DELIVERY'] = 'Стандартная доставка';
        }

        $arFields['COMMENT'] = $arOrder["USER_DESCRIPTION"];
    }


    if ($eventName == "SALE_STATUS_CHANGED_C") {
        CModule::IncludeModule('catalog');
        //получим список ед. изм. торгового каталога
        $arMeasure = [];
        $rM = CCatalogMeasure::GetList();
        while ($arM = $rM->Fetch()) {
            $arMeasure[$arM['ID']] = $arM['SYMBOL_RUS'];
        }

        $strOrderList = "";
        $dbBasketItems = CSaleBasket::GetList(
            ["NAME" => "ASC"],
            ["ORDER_ID" => $orderID],
            false,
            false,
            ["ID", "PRODUCT_ID", "DETAIL_PAGE_URL", "NAME", "QUANTITY", "PRICE", "CURRENCY"]
        );
        while ($arBasketItems = $dbBasketItems->Fetch()) {
            //получаем данные о товаре
            $arProd = CCatalogProduct::GetByID($arBasketItems['PRODUCT_ID']);
            //формируем строку вывода для товара
            $arBasketItems["NAME"] = '<a href="' . $arBasketItems["DETAIL_PAGE_URL"] . '" target="_blank">' . $arBasketItems["NAME"] . '</a>';
            $strOrderList .= $arBasketItems["NAME"] . " - " . (float)$arBasketItems["QUANTITY"] . " " . $arMeasure[$arProd['MEASURE']] . ": " . SaleFormatCurrency($arBasketItems["PRICE"],
                    $arBasketItems["CURRENCY"]) . "<br/>";
            $strOrderList .= "\n";
        }

        $arFields["PRICE"] = SaleFormatCurrency($arOrder["PRICE"], $arOrder["CURRENCY"]);
        $arFields["ORDER_LIST"] = $strOrderList;
        $arFields["DELIVERY_PRICE"] = SaleFormatCurrency($arOrder["PRICE_DELIVERY"], $arOrder["CURRENCY"]);
        $arFields['MANAGER'] = (!empty($manager)) ? '<p>Ваш менеджер: ' . $manager . '</p>' : '';
    }
} // end bxModifySaleMails

/* Обработчик отрабатывает перед добавлением комментария к блогу */
function bxBeforeBlogCommentAdd(&$arFields) {
    if ($arFields['BLOG_ID'] == 3) {
        /*если это комментарий к разделу, снимаем комментарий с публикации (модерация)*/
        $arFields['PUBLISH_STATUS'] = 'K';
    }
}

/* Обработчик отрабатывает при добавлении заказа */
function bxOnOrderSave($orderID, $arFields, $arOrder, $isNew) {
	
    if (CModule::IncludeModule('iblock') && $isNew) {
		
		$arProducts = $fabrics = $collections = $arSections = $depth2 = $depth3 = [];
	
		foreach ($arOrder['BASKET_ITEMS'] as $item) {
			$arProducts[] = $item["PRODUCT_ID"];
		}

		if (count($arProducts)) {
			$resSec = CIBlockElement::GetList([], ['ID' => $arProducts], false, false, ["IBLOCK_ID", "ID","IBLOCK_SECTION_ID"]);
			while ($obEl = $resSec->GetNext()) {
				if($obEl["IBLOCK_ID"] != 11){
					$depth3[$obEl['IBLOCK_ID']][$obEl['IBLOCK_SECTION_ID']] = $obEl['IBLOCK_SECTION_ID'];
				}
				if($obEl["IBLOCK_ID"] == 11){
					$db_props = CIBlockElement::GetProperty($obEl['IBLOCK_ID'], $obEl['ID'], ["sort" => "asc"], ["CODE"=>"POPULAR"]);
					if($ar_props = $db_props->Fetch()){
						$ar_props["VALUE"]++;
						CIBlockElement::SetPropertyValueCode($obEl['ID'], "POPULAR", $ar_props["VALUE"]);
					}
					unset($db_props, $ar_props);
				}
			}
		}

		if(!empty($depth3)){
			foreach($depth3 as $iblock => $list){
				if(!empty($list)){
					$resSec = CIBlockSection::GetList([], ["IBLOCK_ID"=>$iblock, "ID" => $list, "ACTIVE" => "Y"], false, ['ID', 'NAME', 'IBLOCK_ID', 'UF_HIT', 'IBLOCK_SECTION_ID']);
					while ($obSec = $resSec->GetNext()){
						$depth2[$obSec["IBLOCK_ID"]][$obSec['IBLOCK_SECTION_ID']] = $obSec['IBLOCK_SECTION_ID'];
						$collections[$obSec["IBLOCK_ID"]][] = $obSec;
					}
				}
			}
		}

		if(!empty($depth2)){
			foreach($depth2 as $iblock => $list){
				if(!empty($list)){
					$resSec = CIBlockSection::GetList([], ["IBLOCK_ID"=>$iblock, "ID" => $list, "ACTIVE" => "Y"], false, ['ID', 'NAME', 'IBLOCK_ID', 'UF_HIT']);
					while ($obSec = $resSec->GetNext()){
						$fabrics[$obSec["IBLOCK_ID"]][] = $obSec;
					}
				}
			}
		}

		if(!empty($collections)){
			foreach($collections as $iblock => $list){
				foreach($list as $sect){
					$sect['UF_HIT'] = ++$sect['UF_HIT'];
					$bs = new CIBlockSection;
					$bs->Update($sect["ID"], ['UF_HIT' => $sect['UF_HIT']]);
				}
			}

		}

		if(!empty($fabrics)){
			foreach($fabrics as $iblock => $list){
				foreach($list as $sect){
					$sect['UF_HIT'] = ++$sect['UF_HIT'];
					$bs = new CIBlockSection;
					$bs->Update($sect["ID"], ['UF_HIT' => $sect['UF_HIT']]);
				}
			}
		}
    }
} // end bxOnOrderAdd

/* Ф-ция получения ID раздела, по адресу страницы (исп. для фильтра)
По умолчанию ищется в инфоблоке керамич. плитки, для других нужно передать ID инфоблока
Возвращает ID раздела, если такой существует, иначе пустое значение */
function omniGetSIDFromPageUrl($iblock_id = 4, $rootPath = '') {
    if (!CModule::IncludeModule('iblock')) {
        return '';
    }

    global $APPLICATION;
    $page_path = $APPLICATION->GetCurPage(); //получаем адрес тек. страницы

    if (!empty($rootPath)) {
        $pos = strpos($page_path, $rootPath);
        if ($pos === 0) {
            $page_path = substr($page_path, strlen($rootPath));
        }
    }

    if ($page_path[0] == '/') {
        //если адрес нач. со слэша, удаляем его
        $page_path = substr($page_path, 1);
    }
    if ($page_path[strlen($page_path) - 1] == '/') {
        //если адрес оканч. слэшом, удаляем его
        $page_path = substr($page_path, 0, -1);
    }
    $page_path = explode('/', $page_path); //разбиваем адрес
    $code_id = $page_path[count($page_path) - 1]; //берём последнее значениея

    if (empty($code_id)) {
        return '';
    } else {
        if ($sid = omniIsIBlockSection($code_id, $iblock_id, $page_path)) { //раздел
            return $sid;
        } else {
            if ($sid = omniIsIBlockElement($code_id, $iblock_id)) { //элемент
                return $sid;
            } else {
                return '';
            }
        }
    }
} //end omniGetSIDFromPageUrl

/* Определяет есть ли элемент в инфоблоке, если да, возвращает ID раздела */
function omniIsIBlockElement($el, $bid = 4) {
    if (!CModule::IncludeModule('iblock')) {
        return false;
    }

    $arFltr['IBLOCK_ID'] = $bid;
    if (is_numeric($el)) {
        $arFltr['ID'] = $el;
    } else {
        $arFltr['CODE'] = $el;
    }
    $rE = CIBlockElement::GetList([], $arFltr, false, false, ['ID', 'IBLOCK_SECTION_ID']);
    $arE = $rE->Fetch();
    if (empty($arE['ID'])) {
        return false;
    } else {
        return $arE['IBLOCK_SECTION_ID'];
    }
}

/* Определяет есть ли раздел в инфоблоке, если да, возвращается ID раздела */
function omniIsIBlockSection($sec, $bid = 4, $pagePath = []) {
    if (!CModule::IncludeModule('iblock')) {
        return false;
    }

    $arFltr['IBLOCK_ID'] = $bid;
    if (is_numeric($sec)) {
        $arFltr['ID'] = $sec;
    } else {
        $arFltr['CODE'] = $sec;
    }

    $rS = CIBlockSection::GetList([], $arFltr, false, ['ID', 'IBLOCK_SECTION_ID', 'LEFT_MARGIN', 'RIGHT_MARGIN']);
    if ($rS->SelectedRowsCount() == 0) {
        return false;
    } else {
        if ($rS->SelectedRowsCount() == 1) {
            $arS = $rS->Fetch();
            if (empty($arS['ID'])) {
                return false;
            } else {
                return $arS['ID'];
            }
        } else { //если несколько разделов с одинаковым кодом
            while ($arS = $rS->Fetch()) {
                if (empty($arS['IBLOCK_SECTION_ID'])) {
                    if (count($pagePath) < 2) {
                        return $arS['ID'];
                    }
                } else {
                    //берём родителя и смотрим входит ли код родителя в адрес страницы
                    $rTmp = CIBlockSection::GetList([], ['IBLOCK_ID' => $bid, 'ID' => $arS['IBLOCK_SECTION_ID']], false,
                        ['IBLOCK_ID', 'ID', 'CODE']);
                    $arTmp = $rTmp->Fetch();
                    if (in_array($arTmp['CODE'],
                        $pagePath)) { //возвращаем ID раздела, если родитель входит в адрес страницы
                        return $arS['ID'];
                    }
                }
            }
        }
    }
}

/* Подмена цены товара на ночную */
function omniOnBeforeBasketAdd(&$arFields) {
    
    if (CModule::IncludeModule('iblock') && CModule::IncludeModule('catalog') && CModule::IncludeModule('currency')) {
        $now = time();
        $week_day = date('N', $now);
        $hour = intval(date('H', $now));
        $minutes = intval(date('i', $now));
        // Выключаем выходные дни "ночные цены"
        /*if (in_array($week_day, array(6,7)) || (!in_array($week_day, array(6,7)) && (($hour >= 20 && $minutes >= 45) || ($hour <= 8 && $minutes < 30)))) {  */
        if ($hour == 20 && $minutes >= 30 || $hour > 20 || $hour == 8 && $minutes <= 30 || $hour < 8) {
            $arProd = CCatalogProduct::GetByID($arFields['PRODUCT_ID']);
            $rEl = CIBlockElement::GetList([], [
                'IBLOCK_ID' => [CATALOG_ID, CATALOG_FLOOR_ID, CATALOG_SANTEH_ID]
                /*CATALOG_ID*/,
                'ID' => $arFields['PRODUCT_ID']
            ], false, false, ['ID', 'PROPERTY_NIGHT_PRICE', 'PROPERTY_MARGIN']);
            $arEl = $rEl->GetNext();
            if ($arEl['PROPERTY_NIGHT_PRICE_VALUE'] == 1) {
                // Получим список валют с курсом
                $lcur = CCurrency::GetList(($by = "name"), ($order1 = "asc"), LANGUAGE_ID);
                $arCurrency = [];
                while ($lcur_res = $lcur->Fetch()) {
                    if (!empty($lcur_res['BASE']) && $lcur_res['BASE'] == 'Y') {
                        continue;
                    }

                    $arCurrency[$lcur_res['CURRENCY']] = $lcur_res['AMOUNT'];
                }
                if (empty($arCurrency['RUB'])) {
                    $arCurrency['RUB'] = 1;
                }
                if (!empty($arEl['PROPERTY_MARGIN_VALUE'])) {
                    $arEl['PROPERTY_MARGIN_VALUE'] = (float)str_replace(',', '.', $arEl['PROPERTY_MARGIN_VALUE']);
                    $margin = 1 + $arEl['PROPERTY_MARGIN_VALUE'] / 100;
                } else {
                    $margin = 1;
                }
                $nightPrice = round($arProd['PURCHASING_PRICE'] * $margin * $arCurrency[$arProd['PURCHASING_CURRENCY']]);
                $arFields['PRICE'] = $nightPrice;
                $arFields['BASE_PRICE'] = $nightPrice;
                $arFields['CUSTOM_PRICE'] = 'Y';
                $arFields['IGNORE_CALLBACK_FUNC'] = 'Y';
            }
        }
    }
    //}
}

function omniOnBeforeLocalRedirect(&$url) {
    if ($url == '/personal/cart/' && (substr_count($_SERVER['HTTP_USER_AGENT'],
                'Trident') > 0 || substr_count($_SERVER['HTTP_USER_AGENT'], 'MSIE') > 0)) {
        //переходим в корзину в IE
        $url .= '?' . uniqid('v=');
    }
}

/*Возвращет ID разделов, в которых есть елементы с указанным значением св-ва Новинка*/
function omniGetSectionsIDsWithNewPropVal() {
   $secIDs = [];
	
		if (!count($secIDs)) {
			if (CModule::IncludeModule('iblock')) {
				$year = date('Y');
				$rE = CIBlockElement::GetList([], ['IBLOCK_ID' => CATALOG_ID, 'ACTIVE' => 'Y', '>=DATE_CREATE' => date('d.m.Y H:i:s',strtotime($year.'-01-01'))], false, false, ['IBLOCK_ID', 'ID', 'IBLOCK_SECTION_ID', 'PROPERTY_NEWSALE']);
				while ($arE = $rE->GetNext()){
				if (!in_array($arE['IBLOCK_SECTION_ID'], $secIDs)) {
					$secIDs[] = $arE['IBLOCK_SECTION_ID'];
				}
			}
		}
	}
	return $secIDs;
}

/*---bgn 2020-02-03---*/
/**
 * Получение значение варианта св-ва типа список по его ID
 * param $valIDs - массив или одиночное значение
 * return $val - массив или одиночное значение
 **/
function omniGetPropertyValueByListID($valIDs) {
    if (!is_array($valIDs)) {
        $valIDs = [$valIDs];
    }
    $val = [];
    $cache = new CPHPCache();
    $cache_time = 3600;
    $cache_id = 'arPropValueByListID' . implode('', $valIDs);
    $cache_path = 'omniweb';
    if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path)) {
        $res = $cache->GetVars();
        if (is_array($res["arPropValueByListID"]) && (count($res["arPropValueByListID"]) > 0))
            $val = $res["arPropValueByListID"];
    }
    if (!count($val)) {
        foreach ($valIDs as $valID) {
            $res = CIBlockPropertyEnum::GetByID($valID);
            $val[] = $res['VALUE'];
        }
        //////////// end cache /////////

        if ($cache_time > 0) {
            $cache->StartDataCache($cache_time, $cache_id, $cache_path);
            $cache->EndDataCache(array("arPropValueByListID" => $val));
        }
    }
    return $val;
}

/*---end 2020-02-03---*/

/***
 * Функция для вкладки SEO, шаблона {=omni_ifsecdepth this.iblock.Code this.Code "уровень раздела" "вывод при равенстве" "вывод при не равенстве"}
 * пример шаблона {=omni_ifsecdepth this.iblock.Code this.Code 2 "Плитка this.Name" "this.Name"}
 * т.к. в стандартных шаблонах нельзя получить уровень раздела, то используем код раздела (this.Code) и код инфоблока (this.iblock.Code), чтобы затем по нему получить уровень
 *
 * примеры реализации можно посмотреть здесь:
 * http://dev.1c-bitrix.ru/community/blogs/oracle/userdefined-functions-and-seo-infoblock.php
 * http://dev.1c-bitrix.ru/community/webdev/user/87386/blog/9317/
 ***/

/*подключаем файл с определением класса FunctionBase
это пока требуется т.к. класс не описан в правилах автозагрузки*/
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/iblock/lib/template/functions/fabric.php');

use Bitrix\Main;

//регистрируем обработчик события
$eventManager = Main\EventManager::getInstance();
$eventManager->addEventHandler("iblock", "OnTemplateGetFunctionClass", "omniOnTemplateGetFunctionClass");

function omniOnTemplateGetFunctionClass(Bitrix\Main\Event $event) {
    $arParam = $event->getParameters();
    $functionClass = $arParam[0];
    if (is_string($functionClass) && class_exists($functionClass) && in_array($functionClass,
            ['omni_ifsecdepth', 'omni_notempty'])) {
        $result = new Bitrix\Main\EventResult(1, $functionClass);
        return $result;
    }
}

//класс обработки ф-ции
class omni_ifsecdepth extends Bitrix\Iblock\Template\Functions\FunctionBase {
    /*в принципе не нужна эта ф-ция, т.к. она описана в родительском классе
    public function onPrepareParameters(\Bitrix\Iblock\Template\Entity\Base $entity, $parameters)
    {
      $arguments = array();
      /** @var \Bitrix\Iblock\Template\NodeBase $parameter */
    /*foreach ($parameters as $parameter)
    {
       $arguments[] = $parameter->process($entity);
    }
    return $arguments;
  }*/

    //ф-ция, выполняющая действие
    public function calculate(array $parameters) {
        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $rSec = CIBlockSection::GetList([], ['IBLOCK_CODE' => $parameters[0], 'CODE' => $parameters[1]], false,
                ['ID', 'DEPTH_LEVEL']);
            if ($arSec = $rSec->Fetch()) {
                if ($arSec['DEPTH_LEVEL'] == $parameters[2]) {
                    if (!empty($parameters[3])) {
                        return $parameters[3];
                    } else {
                        return '';
                    }
                } else {
                    if (!empty($parameters[4])) {
                        return $parameters[4];
                    } else {
                        return '';
                    }
                }
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}

//класс обработки ф-ции omni_notempty

/***
 * Функция для вкладки SEO, шаблона {=omni_notempty <проверяемое значение> "вывод при не пустом значении" "вывод при пустом значении"}
 * пример шаблона {=omni_notempty this.property.header this.property.header "Плитка this.Name"}
 ***/
class omni_notempty extends Bitrix\Iblock\Template\Functions\FunctionBase {
    //ф-ция, выполняющая действие
    public function calculate(array $parameters) {
        if (!empty($parameters[0])) {
            return $parameters[1];
        } else {
            return $parameters[2];
        }
    }
}

/*class omni_pagen extends Bitrix\Iblock\Template\Functions\FunctionBase
{
	//ф-ция, выполняющая действие
	public function calculate(array $parameters)
	{
		return '';
	}
}*/

/**
 * Проверка на раздел каталога
 * @param $url
 * @return bool
 */
function isCatalogSection($url = false) {
    $catalogSections = [
        '/collections/',
        '/katalog-keramicheskoy-plitki/',
        '/napolnye-pokrytiya/',
        '/santekhnika/',
    ];

    if (!$url) {
        $url = $GLOBALS['APPLICATION']->GetCurPage();
    }

    foreach ($catalogSections as $catalogSection) {
        if (strpos($url, $catalogSection) !== false) {
            return true;
        }
    }
    return false;
}

function getBrandInfo($code, $iblock){
   $arFilter = ['IBLOCK_ID' => $iblock,'CODE' => $code, "ACTIVE"=>"Y"];
   $rsSect = CIBlockSection::GetList([],$arFilter, false, ["NAME","CODE","IBLOCK_SECTION_ID","ACTIVE"]);
   while ($arSect = $rsSect->GetNext())
   {
        $result["NAME"] = $arSect["NAME"];
        $result["CODE"] = $arSect["CODE"];
        $result["SECTIONS"][] = $arSect["IBLOCK_SECTION_ID"];
    }
    return ($result ? $result : false);
}

function getSectionByID($id){
   $result = CIBlockSection::GetByID($id)->GetNext();
	return ($result ? $result : false);
}

/**Сохранение ID раздела для последующего обновление данных через агент с функциии manageSectionFromID**/

function manageItems(&$arFields) {
	$iblocks = [4, 9, 11, 15];
	
	if(in_array($arFields["IBLOCK_ID"], $iblocks)){
		
		// if($arFields["ACTIVE"] == "Y"){
		//	setDeActiveByAvailability($arFields["ID"], $arFields["IBLOCK_ID"]);
		// }
		
		saveSectionIdForUpdate($arFields);	
	}
	
}
/*
function setDeActiveByAvailability($id, $iblock){
	$db_props = CIBlockElement::GetProperty($iblock, $id, "sort", "asc", ["CODE" => "AVAILABILITY"]);
	if ($ar_props = $db_props->Fetch()) {
		
		if($ar_props["VALUE_ENUM"] === "Нет в наличии" && CModule::IncludeModule("iblock")){
			
			$bs = new CIBlockElement;
			$bssec = $bs->Update($id, ["ACTIVE"=>"N"]);
			unset($bssec, $bs);
		}
	}
}
*/
function translit($str) {
	$rus = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
	$lat = array('a', 'b', 'v', 'g', 'd', 'e', 'yo', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shch', '', 'y', '', 'e', 'yu', 'ya');

	$str = mb_strtolower($str);		
	$str = str_replace($rus, $lat, $str);
	// заменям все ненужное нам на "-"
	$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
	// удаляем начальные и конечные '-'
	$str = trim($str, "-");		
	return $str;
}

function manageSection(&$arFields){
	
	$allsection = ['32363','32356','32358','32361','32364','32357','34749','32362','32355','32359','32360','38096','41111','46000','51352','51353', '54170', '54169'];
	if(in_array($arFields["ID"], $allsection)){
		$arFields["ACTIVE"] = "Y";
	}
}

function saveSectionIdForUpdate($arFields) {
	$categories = [];
	$getContent = $sectionid = '';
	$fileUrl = LINK_CATEGORY_LIST;
	if (!empty($arFields['IBLOCK_SECTION'][0]) && in_array($arFields["IBLOCK_ID"], [4,9,11,15])){
		$sectionid = $arFields['IBLOCK_SECTION'][0];
	}else{
		$sectionid = CIBlockElement::GetList([], ["IBLOCK_ID"=>$arFields["IBLOCK_ID"], "ID"=>$arFields["ID"]], false, [], ["IBLOCK_SECTION_ID"])->GetNext()["IBLOCK_SECTION_ID"];
	}
	if($sectionid){
		if(file_exists($fileUrl)){
			$getContent = file_get_contents($fileUrl);
			if(!empty($getContent)){
				$categories = json_decode($getContent, true);

				if(!in_array($sectionid, $categories)){
					$categories[] = $sectionid;
				}
			}
		}else{
			$categories[] = $sectionid;
		}
		
		$fp = fopen($fileUrl, 'w');
		fwrite($fp, json_encode($categories));
		fclose($fp);
	}
}

// обновление данных раздела по наличию товаров

function getElementID($val, $code, $iblock){
	if (CModule::IncludeModule("iblock")){
		$result = CIBlockElement::GetList([], ["IBLOCK_ID"=>$iblock, $code=>$val, "ACTIVE"=>"Y"], false, [], ["ID"])->GetNext()["ID"];
	}
	return $result ?? false;
}
function getNiceRealPath($val, $code, $iblock){
	if (CModule::IncludeModule("iblock")){
		$result = CIBlockElement::GetList([], ["IBLOCK_ID"=>$iblock, $code=>$val, "ACTIVE"=>"Y"], false, [], ["PROPERTY_NEW_REAL"])->Fetch()["PROPERTY_NEW_REAL_VALUE"];
	}
	return $result ?? false;
}

function hideSection(){
	if(CModule::IncludeModule('iblock')){
		$arFilter = array(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => 4,
			"DEPTH_LEVEL" => 2
		);
		$i = 0;

		$ff = [];
		$res = CIBlockSection::GetList([], $arFilter, false, ["ID","DEPTH_LEVEL", "NAME", "ACTIVE"]);
		while($ob = $res->GetNext()){
			$ff[$ob["ID"]] = $ob["ID"];
			$ress = CIBlockElement::GetList([], ["IBLOCK_ID"=> 4, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>$ob["ID"]], false, ["nPageSize"=> 1], ["ID"]);
			while($obs = $ress->Fetch()){
				if($obs["ID"]){
					unset($ff[$ob["ID"]]);
				}
			}
		}
		$i = 0;
		if(count($ff)>0){
			foreach($ff as $se){
				if($i<50){
					$bs = new CIBlockSection;
					$bssec = $bs->Update($se, ["ACTIVE"=>"N"]);
					if($bssec){
						$i++;
					}
				}
			}
			return 'hideSection();';
		}
	}
}

function checkSectionIsActiveByUrl($url, $iblock_id){

	$fullpath = $subs = $filter = $result = $subSections = [];
	$fullpath = explode("/",parse_url($url, PHP_URL_PATH));

	if(count($fullpath)>1){
		foreach($fullpath as $k=>$path){
			if(empty($path)){
				$subDepth = $k-3;
				$subCode = $fullpath[$k-2];
				$depth = $k-2;
				$code = $fullpath[$k-1];	
			}else{
				$subDepth = $k-2;
				$subCode = $fullpath[$k-1];
				$depth = $k-1;
				$code = $path;
			}
		}
	};
	
	$filter = ["DEPTH_LEVEL"=>$depth, "CODE"=>$code];
	if($iblock_id){
		$filter["IBLOCK_ID"] = $iblock_id;
	}

	if(CModule::IncludeModule('iblock') && !empty($code) && $depth>0 && $depth<4){
		$res = CIBlockSection::GetList([], $filter, false, ["ID","DEPTH_LEVEL", "NAME", "ACTIVE", "IBLOCK_SECTION_ID"]);
		while($ob = $res->GetNext()){
			$subs[] = $ob["IBLOCK_SECTION_ID"];
			$sections[] = $ob;
		}
		unset($res, $ob);

		if (is_countable($sections) && count($sections)>1){
			$res = CIBlockSection::GetList([], ["IBLOCK_ID"=>$iblock_id, "DEPTH_LEVEL"=>$subDepth, "CODE"=>$subCode, "ID"=>$subs], false, ["ID","DEPTH_LEVEL", "NAME", "ACTIVE", "IBLOCK_SECTION_ID"]);
			while($ob = $res->GetNext()){
				$subSections[] = $ob["ID"];
			}
			unset($res, $ob);

			if(count($subSections)>1){
				return false;
			}else{
				foreach($sections as $sect){
					if($sect["IBLOCK_SECTION_ID"] == $subSections[0]){
						$result = $sections;
						return $sect;
					}
				}
			}
		}else{
			return $sections[0];
		}
	}
}

function hideSectionTwo(){
	if(CModule::IncludeModule('iblock')){
		$arFilter = array(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => 4,
			"DEPTH_LEVEL" => 2
		);

		$ff = [];
		$res = CIBlockSection::GetList([], $arFilter, false, ["ID","DEPTH_LEVEL", "NAME", "ACTIVE"]);
		while($ob = $res->GetNext()){
			$ff[$ob["ID"]] = $ob["ID"];
			$arFilter = array(
				"ACTIVE" => "Y",
				"IBLOCK_ID" => 4,
				"DEPTH_LEVEL" => 3,
				"SECTION_ID" => $ob["ID"]
			);
			$ress = CIBlockSection::GetList([], $arFilter, false, ["ID","DEPTH_LEVEL", "NAME", "ACTIVE"]);
			while($obs = $ress->GetNext()){
				if($obs["ID"]){
					unset($ff[$ob["ID"]]);
				}
			}
		}
	
		$i = 0;
		if(count($ff)>0){
			foreach($ff as $se){
				if($i<50){
					$bs = new CIBlockSection;
					$bssec = $bs->Update($se, ["ACTIVE"=>"N"]);
					if($bssec){
						$i++;
					}
				}
			}
			return 'hideSectionTwo();';
		}
	}
}

function getItemsGetPath(){
	if(CModule::IncludeModule('iblock')){

		$ids = [];

		$getFilterUrl = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_items.json';

		if(file_exists($getFilterUrl) && CModule::IncludeModule('catalog')){
			$ids = file_get_contents($getFilterUrl);
			$ids = json_decode($ids, true);

			foreach($ids as $k=>$item){
				if($item["i"]){
					$result[$k] = CFile::GetPath($item["i"]);
				}
			}

			$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_path.json', 'w');
			fwrite($fp, json_encode($result));
			fclose($fp);
		}
	}
}

function getKeramikaItemsForFids_v2(){
	if(CModule::IncludeModule('iblock')){

		$ids = $result = [];

		$res = CIBlockElement::GetList(array("ID"=>"DESC"), array("IBLOCK_ID" => 4, "ACTIVE" => "Y"), false, false, ["ID","IBLOCK_ID","DETAIL_PAGE_URL","IBLOCK_SECTION_ID","NAME",/*"PROPERTY_OLD_PRICE","PROPERTY_DISCOUNT","PROPERTY_DISCOUNT_PERCENT",*/"PROPERTY_SIZE_WIDTH","PROPERTY_SIZE_LENGTH","PROPERTY_COLOR", "DETAIL_PICTURE", "DETAIL_TEXT"]);
		while($obItem = $res->GetNextElement()){

			$Item = $obItem->GetFields();
			if(!in_array($Item["ID"], $ids)){
				$result[$Item["ID"]] = [
					"s" => $Item["IBLOCK_SECTION_ID"], // categoryId
					"n" => $Item["NAME"], // name
					"u" => $Item["DETAIL_PAGE_URL"], // URL
					/*
					"discount" => $Item["PROPERTY_DISCOUNT_VALUE"],
					"percent" => $Item["PROPERTY_DISCOUNT_PERCENT_VALUE"],
					"old" => $Item["PROPERTY_OLD_PRICE_VALUE"],
					*/
					"i" => $Item["DETAIL_PICTURE"], // picture
					"d" => $Item["DETAIL_TEXT"], // description
					"c" => $Item["PROPERTY_COLOR_VALUE"], // param color
					"w" => ($Item["PROPERTY_SIZE_WIDTH_VALUE"] && $Item["PROPERTY_SIZE_LENGTH_VALUE"]? $Item["PROPERTY_SIZE_WIDTH_VALUE"]."x".$Item["PROPERTY_SIZE_LENGTH_VALUE"] : ''), // param size
				];
			}
		}

		if(count($result)>0){
			$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_items.json', 'w');
			fwrite($fp, json_encode($result));
			fclose($fp);
			/*
			$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_all_ids.json', 'w');
			fwrite($fp, json_encode($ids));
			fclose($fp);
			*/
		}
	}
}

function getPricesForFids_v1(){
	
	$ids = $cats = [];

	$getFilterUrl = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_items.json';

	if(file_exists($getFilterUrl) && CModule::IncludeModule('catalog')){
		$ids = file_get_contents($getFilterUrl);
		$ids = json_decode($ids, true);

		$dbProductPrice = CPrice::GetListEx(
			array(),
			array("PRODUCT_ID" => array_keys($ids), "CATALOG_GROUP_ID"=>1),
			false,
			false,
			array("PRODUCT_ID", "CATALOG_GROUP_ID", "PRICE")
		);
		while($ar_res = $dbProductPrice->Fetch())
		{
			$result[$ar_res["PRODUCT_ID"]] = $ar_res["PRICE"];
		}

		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_price.json', 'w');
		fwrite($fp, json_encode($result));
		fclose($fp);
	}
	
	/*
	$getFilterUrl = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_categories.json';
	
	if(file_exists($getFilterUrl)){
		$cats = file_get_contents($getFilterUrl);
		$cats = json_decode($cats, true);
		
		foreach($ids as $k=>$id){
			$allCats[$id["s"]][] = $result[$k];
		}
		
		foreach($cats as $k=>$cat){
			$cats[$k]["s"] = min($allCats[$k]);
		}

		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_categories.json', 'w');
		fwrite($fp, json_encode($cat));
		fclose($fp);
	}
	*/
}

function getCollectionsForFids(){
    $iblockId = 4;
    $entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($iblockId);
    $res = $entity::getList(array(
        'order' => array('LEFT_MARGIN'=>'ASC'),
        'filter' => array(
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y',
        ), 
        'select' =>  array(
            'ID',
            'NAME',
            'CODE',
            'IBLOCK_SECTION_ID',
            'DEPTH_LEVEL',
            'PICTURE',
            'LEFT_MARGIN',
            'RIGHT_MARGIN',
            'UF_CATALOG_PRICE_1',
            'IBLOCK_SECTION_PAGE_URL' => 'IBLOCK.SECTION_PAGE_URL',
        ),
    ));

    while ($arResult = $res->fetch()) {
        if  ($arResult['DEPTH_LEVEL'] == 1) {
            $rsCountry['ID'] = $arResult['ID'];
            $rsCountry['NAME'] = $arResult['NAME'];
            $arCountry[] = $rsCountry;
        } else if ($arResult['DEPTH_LEVEL'] == 2) {
            $rsFactory['ID'] = $arResult['ID'];
            $rsFactory['COUNTRY_ID'] = $rsCountry['ID'];
            $rsFactory['NAME'] = $arResult['NAME'];
            $arFactory[] = $rsFactory;
        } else if ($arResult['DEPTH_LEVEL'] == 3) {
            $arResult['FULL_NAME'] = $arResult['NAME'].' - '.$rsFactory['NAME'];
            $arResult['COUNTRY_ID'] = $rsCountry['ID'];
            $arResult['FACTORY_ID'] = $rsFactory['ID'];
            $arResult['COUNTRY_NAME'] = $rsCountry['NAME'];
            $arResult['SRC_PICTURE'] = CFile::GetPath($arResult['PICTURE']);
            $arResult['PAGE_URL'] = CIBlock::ReplaceDetailUrl($arResult['IBLOCK_SECTION_PAGE_URL'], $arResult, true, 'S');
            $arCollections[] = $arResult;
        }
    }

    if (count($arFactory)>0) {
        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_factory.json', 'w');
        fwrite($fp, json_encode($arFactory));
        fclose($fp);
    }

    if (count($arCollections)>0) {
        $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_collections.json', 'w');
        fwrite($fp, json_encode($arCollections));
        fclose($fp);
    }
    return 'getCollectionsForFids();';
} 

function checkTime(){
	$result = false;
	
	$now = time();
	$week_day = date('N', $now);
	$hour = intval(date('H', $now));
	$minutes = intval(date('i', $now));
	
	if ($hour == 20 && $minutes >= 30 || $hour > 20 || $hour == 8 && $minutes <= 30 || $hour < 8) {
		$result = true;
	}
	
	return $result;
}

function getNightPrice($margin, $purchprice, $currency = "RUB"){
	$arCurrency = [];
	$arCurrency = getCurrecy();
	
	if(!empty($margin)){
		$margin = (float)str_replace(',', '.', $margin);
		$margin = 1 + $margin/100;
	} else {
		$margin = 1;
	}
	return round($purchprice * $margin * $arCurrency[$currency]);
}