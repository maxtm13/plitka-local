<?
function kursValut(){ // работает Шаг 1 - обновлениие курса валют - агент
	$ch = curl_init('https://www.cbr-xml-daily.ru/daily_json.js');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$getContent = curl_exec($ch);
	curl_close($ch);

	$getContent = json_decode($getContent);

	if($getContent){
		
		unlink(PATH_TO_CURS.'eur.json');
		unlink(PATH_TO_CURS.'usd.json');
		$fp = fopen(PATH_TO_CURS.'eur.json', 'w');
		fwrite($fp, $getContent->Valute->EUR->Value);
		fclose($fp);
		$fp = fopen(PATH_TO_CURS.'usd.json', 'w');
		fwrite($fp, $getContent->Valute->USD->Value);
		fclose($fp);
	}
	return 'kursValut();';
}
function getValut($valuta){ // работает Используется для получения курса валюты (не агент)
	$path = PATH_TO_CURS.strtolower($valuta).'.json';
	if(file_exists($path)) {
		$result = file_get_contents($path);
	}
	return json_decode($result);
}

function setComparisons(){ // Hаботает -Шаг 2 - Зaнесение данных из совместимости в ассортимент - агент (медленный 2:17 сек)
	
	if(CModule::IncludeModule('iblock') && CModule::IncludeModule('sale')){
		
		$provederIDs = $otherProvedersName = $otherProvedersPrice = $winner = $allIDs = $allPrice = $allArts = [];

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>POSTAVSHIKI_KERAMIKA, "ACtIVE"=>"Y"], false, [], ["ID"]);
		while($ob = $res->Fetch())
		{
			$provederIDs[$ob["ID"]] = $ob["ID"];
			$allInfo["PROVIDER"][$ob["ID"]]["ID"] = $ob["ID"];
		}
		unset($res, $ob);

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>SOPOSTAVLENIE_KERAMIKA, "ACtIVE"=>"Y", "!PROPERTY_GOODS"=> false, "!PROPERTY_PROVIDER"=> false, "!PROPERTY_SKU"=> false], false, [], ["ID", "NAME", "PROPERTY_SKU", "PROPERTY_GOODS", "PROPERTY_PROVIDER", "PROPERTY_BRAND", "PROPERTY_COLLECTION"]);
		while($ob = $res->Fetch())
		{
			if($ob["PROPERTY_PROVIDER_VALUE"] && $ob["PROPERTY_SKU_VALUE"] && $ob["PROPERTY_GOODS_VALUE"]){
				$comparisonIDs[$ob["ID"]] = $ob["ID"];	
				$allInfo["PROVIDER"][$ob["PROPERTY_PROVIDER_VALUE"]]["ITEMS"][strtolower(($ob["PROPERTY_SKU_VALUE"] ?? $ob["NAME"]))] = $ob;
			}
		}
		unset($res, $ob);

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>ASSORTIMENTS_KERAMIKA, "ACtIVE"=>"Y"], false, [], ["ID", "NAME", "PROPERTY_PROVIDER", "PROPERTY_ARTNUMBER"]);
		while($ob = $res->Fetch())
		{
			$goodsID = '';
			$isob = [];
			$comparisonIDs[$ob["ID"]] = $ob["ID"];	
			if(!empty($allInfo["PROVIDER"][$ob["PROPERTY_PROVIDER_VALUE"]]["ITEMS"][strtolower(($ob["PROPERTY_ARTNUMBER_VALUE"] ?? $ob["NAME"]))]["PROPERTY_GOODS_VALUE"])){
				$isob = $allInfo["PROVIDER"][$ob["PROPERTY_PROVIDER_VALUE"]]["ITEMS"][strtolower(($ob["PROPERTY_ARTNUMBER_VALUE"] ?? $ob["NAME"]))];
				CIBlockElement::SetPropertyValueCode($ob["ID"], "GOODS_ID", $isob["PROPERTY_GOODS_VALUE"]);
				if($isob["PROPERTY_BRAND_VALUE"]){
					CIBlockElement::SetPropertyValueCode($ob["ID"], "BRAND", $isob["PROPERTY_BRAND_VALUE"]);
				}
				if($isob["PROPERTY_COLLECTION_VALUE"]){
					CIBlockElement::SetPropertyValueCode($ob["ID"], "COLLECTION", $isob["PROPERTY_COLLECTION_VALUE"]);
				}
			}
		}
		unset($res, $ob);
	}
	return "setComparisons();";
}

function addNewBrandsAndCollections(){ // Работает - Шаг 3 - Получение из ассортимента списка новых коллекций и фабрик- (медленный 44 сек)
	if(CModule::IncludeModule('iblock')){
		$arParams = array("replace_space"=>"_","replace_other"=>"_");

		$brandsIDs = $full = $newBrand = $collectionIDs = [];

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>FABRIKI_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER"=>false], false, [], ["ID", "NAME", "CODE", "PROPERTY_PROVIDER"]);
		while($ob = $res->Fetch())
		{
			$brandsIDs[$ob["ID"]] = $ob["CODE"];
			$full[$ob["PROPERTY_PROVIDER_VALUE"]]["BRAND"][$ob["CODE"]]["ID"] = $ob["ID"];
		}
		unset ($res, $ob);

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>COLLECTIONS_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER"=>false, "!PROPERTY_BRAND" => false], false, [], ["ID", "NAME", "CODE","PROPERTY_PROVIDER", "PROPERTY_BRAND"]);
		while($ob = $res->Fetch())
		{
			$collectionIDs[$ob["ID"]] = $ob["CODE"];
			$full[$ob["PROPERTY_PROVIDER_VALUE"]]["BRAND"][$brandsIDs[$ob["PROPERTY_BRAND_VALUE"]]]["COLLECTIONS"][$ob["CODE"]]["ID"] = $ob["ID"];
		}
		unset ($res, $ob);

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>ASSORTIMENTS_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER"=>false, "!PROPERTY_BRAND"=>false], false, [], ["ID", "NAME", "PROPERTY_PROVIDER", "PROPERTY_BRAND", "PROPERTY_COLLECTION"]);
		while($ob = $res->Fetch())
		{
			$proveder_id = '';
			if($ob["PROPERTY_PROVIDER_VALUE"]){
				$proveder_id = $ob["PROPERTY_PROVIDER_VALUE"];
				$brand = [];
				if(!$full[$proveder_id]["BRAND"][Cutil::translit($ob["PROPERTY_BRAND_VALUE"],"ru",$arParams)]["ID"]){
					$brand = [
						"NAME" => $ob["PROPERTY_BRAND_VALUE"],
						"CODE" => Cutil::translit($ob["PROPERTY_BRAND_VALUE"],"ru",$arParams),
						"ACTIVE" => "Y",
						"IBLOCK_ID" => FABRIKI_KERAMIKA,
						"PROPERTY_VALUES" => [
							"PROVIDER" => $proveder_id,	
						]
					];
					$el = new CIBlockElement;
					$brand_id = $el->Add($brand);
					$brandsIDs[$brand_id] = $brand["CODE"];
					$full[$proveder_id]["BRAND"][$brand["CODE"]]["ID"] = $brand_id;
				}else{
					$brand["CODE"] = Cutil::translit($ob["PROPERTY_BRAND_VALUE"],"ru",$arParams);
					$brand_id = $full[$proveder_id]["BRAND"][$brand["CODE"]]["ID"];
				}

				$collection = [];
				if(!$full[$proveder_id]["BRAND"][$brand["CODE"]]["COLLECTIONS"][Cutil::translit($ob["PROPERTY_COLLECTION_VALUE"],"ru",$arParams)]["ID"]){
					$collection = [
						"NAME" => $ob["PROPERTY_COLLECTION_VALUE"],
						"CODE" => Cutil::translit($ob["PROPERTY_COLLECTION_VALUE"],"ru",$arParams),
						"ACTIVE" => "Y",
						"IBLOCK_ID" => COLLECTIONS_KERAMIKA,
						"PROPERTY_VALUES" => [
							"PROVIDER" => $proveder_id,
							"BRAND" => $brand_id,
						]
					];

					$cel = new CIBlockElement;
					$collection_id = $cel->Add($collection);
					$collectionIDs[$collection_id] = $collection["CODE"];
					$full[$proveder_id]["BRAND"][$brand["CODE"]]["COLLECTIONS"][$collection["CODE"]]["ID"] = $collection_id;

				}
				unset($collection_id, $brand, $brand_id, $proveder_id);
			}
		}
		unset ($res, $ob);
	}
	return "addNewBrandsAndCollections();";
}

function getAssortimentItems(){ // работает Шаг 4 - обновлениие списка ассортимента для дальнейшей обработки - aгент (12 сек.)
		
	if(CModule::IncludeModule('iblock')){
		
		$fileUrl = $_SERVER['DOCUMENT_ROOT']."/local/for_functions/assortiment_ids.json";	

		$arItems = [];

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>ASSORTIMENTS_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER"=>false], false, [], ["ID", "PROPERTY_PROVIDER", "PROPERTY_COLLECTION", "PROPERTY_BRAND", "PROPERTY_SALE", "PROPERTY_GOODS_ID"]);
		while($ob = $res->Fetch())
		{
			if(!empty($ob["PROPERTY_GOODS_ID_VALUE"])){
				$arItems[$ob["ID"]]["p"] = $ob["PROPERTY_PROVIDER_VALUE"];

				if($ob["PROPERTY_COLLECTION_VALUE"]){
					$arItems[$ob["ID"]]["c"] = $ob["PROPERTY_COLLECTION_VALUE"];
				}
				if($ob["PROPERTY_BRAND_VALUE"]){
					$arItems[$ob["ID"]]["b"] = $ob["PROPERTY_BRAND_VALUE"];
				}
				if($ob["PROPERTY_SALE_VALUE"]){
					$arItems[$ob["ID"]]["s"] = $ob["PROPERTY_SALE_VALUE"];
				}
			}
		}

		$fp = fopen($fileUrl, 'w');
		fwrite($fp, json_encode($arItems));
		fclose($fp);
	}

	return 'getAssortimentItems();';
}

function getAssortimentPrice(){ // работает Шаг 5 - обновлениие цен ассортимента для дальнейшей обработки - aгент 10сек
		
	if(CModule::IncludeModule('catalog')){

		$fileUrl = $_SERVER['DOCUMENT_ROOT']."/local/for_functions/assortiment_price.json";	

		$arPrice = [];

		$db_res = CCatalogProduct::GetList(
		[],
		["!PURCHASING_PRICE" => false, "ELEMENT_IBLOCK_ID"=>ASSORTIMENTS_KERAMIKA],
		false,
		[]);
		while($ar_res = $db_res->Fetch())
		{
			$arPrice[$ar_res["PURCHASING_CURRENCY"]][$ar_res["ID"]] = $ar_res["PURCHASING_PRICE"];
		}

		$fp = fopen($fileUrl, 'w');
		fwrite($fp, json_encode($arPrice));
		fclose($fp);

		return 'getAssortimentPrice();';
	}
}

function setAssortimentPrice(){ // работает Шаг 6 - добавление конечной цены в ассортимент товара с конвертации валюты - aгент (самый медленный 1:10 сек)
	
	if(CModule::IncludeModule('iblock')){

		$collections = $brands = $allInfo = [];

		$getCurs["EUR"] = getValut('EUR');
		$getCurs["USD"] = getValut('USD');
		$getCurs["RUB"] = 1;

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>POSTAVSHIKI_KERAMIKA, "ACTIVE"=>"Y"], false, [], ["ID", "PROPERTY_SALE"]);
		while($ob = $res->Fetch())
		{
			$allInfo[$ob["ID"]]["ID"] = $ob["ID"];
			if(!empty($ob["PROPERTY_SALE_VALUE"])){
				$allInfo[$ob["ID"]]["SALE"] = $ob["PROPERTY_SALE_VALUE"];
			}
		}
		unset($res, $ob);

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>FABRIKI_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER" => false], false, [], ["ID", "NAME", "PROPERTY_SALE", "PROPERTY_PROVIDER"]);
		while($ob = $res->Fetch())
		{
			$allBrands[$ob["ID"]] = $ob["NAME"];
			$allInfo[$ob["PROPERTY_PROVIDER_VALUE"]]["BRAND"][$ob["NAME"]]["ID"] = $ob["ID"];
			$allInfo[$ob["PROPERTY_PROVIDER_VALUE"]]["BRAND"][$ob["NAME"]]["SALE"] = $ob["PROPERTY_SALE_VALUE"];
		}
		unset($res, $ob);


		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>COLLECTIONS_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER" => false], false, [], ["ID", "NAME", "PROPERTY_SALE", "PROPERTY_BRAND", "PROPERTY_PROVIDER"]);
		while($ob = $res->Fetch())
		{
			$allCollections[$ob["ID"]] = $ob["NAME"];
			if($ob["PROPERTY_BRAND_VALUE"] && $ob["PROPERTY_PROVIDER_VALUE"]){
				$allInfo[$ob["PROPERTY_PROVIDER_VALUE"]]["BRAND"][$allBrands[$ob["PROPERTY_BRAND_VALUE"]]]["COLLECTION"][$ob["NAME"]]["ID"] = $ob["ID"];
				$allInfo[$ob["PROPERTY_PROVIDER_VALUE"]]["BRAND"][$allBrands[$ob["PROPERTY_BRAND_VALUE"]]]["COLLECTION"][$ob["NAME"]]["SALE"] = $ob["PROPERTY_SALE_VALUE"];
			}
		}
		unset($res, $ob);
		
		$fileItems = $_SERVER['DOCUMENT_ROOT']."/local/for_functions/assortiment_ids.json";	
		$filePrices = $_SERVER['DOCUMENT_ROOT']."/local/for_functions/assortiment_price.json";

		$items = $prices = $sales = [];
		$content = '';

		if(file_exists($fileItems) && file_exists($filePrices)){
			$content = file_get_contents($fileItems);
			$items = json_decode($content);
			$content = file_get_contents($filePrices);
			$prices = json_decode($content);
			
			foreach($items as $k=>$item){

				if(!empty($item->p) && !empty($allInfo[$item->p]["SALE"])){
					$sales[$k] = $allInfo[$item->p]["SALE"];
				}
				if(!empty($item->p) && !empty($item->b) && !empty($allInfo[$item->p]["BRAND"][$item->b]["SALE"])){
					$sales[$k] = $allInfo[$item->p]["BRAND"][$item->b]["SALE"];
				}
				if(!empty($item->p) && !empty($item->b) && !empty($item->c) && !empty($allInfo[$item->p]["BRAND"][$item->b]["COLLECTION"][$item->c]["SALE"])){
					$sales[$k] = $allInfo[$item->p]["BRAND"][$item->b]["COLLECTION"][$item->c]["SALE"];
				}
				if(!empty($item->s)){
					$sales[$k] = $item->s;
				}


				$curPrice = 0;
				
				foreach($getCurs as $key=>$curs){
					if(!empty($prices->$key->$k)){
						$curPrice = $prices->$key->$k*$curs;
					}
				}

				$endPrice = 0;

				$endPrice = (!empty($sales[$k]) ? $curPrice-$curPrice*($sales[$k]/100): $curPrice);
				
				CIBlockElement::SetPropertyValueCode($k, "END_PRICE", round($endPrice));
				
				unset($curPrice);
				
				
			}
		}

		unset($content , $items , $prices , $allInfo , $fileItems , $filePrices , $getCurs);
	}

	return 'setAssortimentPrice();';
}

function getMinPrice(){ // работает Шаг 7 - добавление цены поставщиков в каталог  керамики - aгент (0:56 сек)
	
	if(CModule::IncludeModule('iblock')){
		
		$provederIDs = $otherProvedersName = $otherProvedersPrice = $winner = $allIDs = $allPrice = $allArts = [];

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>POSTAVSHIKI_KERAMIKA, "ACtIVE"=>"Y"], false, [], ["ID", "NAME"]);
		while($arFields = $res->Fetch())
		{
			$provederIDs[$arFields["ID"]] = $arFields["NAME"];	
		}
		unset($res, $ob, $arFields);

		$res = CIBlockElement::GetList(["PROPERTY_END_PRICE"=>"ASC"], ["IBLOCK_ID"=>ASSORTIMENTS_KERAMIKA, "ACTIVE"=>"Y", "!PROPERTY_PROVIDER"=>false, "!PROPERTY_END_PRICE"=>false, "!PROPERTY_GOODS_ID"=>false], false, [], ["ID","IBLOCK_ID","ACTIVE", "PROPERTY_END_PRICE", "PROPERTY_PROVIDER", "PROPERTY_GOODS_ID"]);
		while($arFields = $res->Fetch())
		{
			if($arFields["PROPERTY_GOODS_ID_VALUE"] && $arFields["PROPERTY_END_PRICE_VALUE"]>0 && 		$provederIDs[$arFields["PROPERTY_PROVIDER_VALUE"]]){
				if(empty($allPrice[$arFields["PROPERTY_GOODS_ID_VALUE"]]["WIN"])){
					$allPrice[$arFields["PROPERTY_GOODS_ID_VALUE"]]["WIN"] = [
						"PROVIDER" => $provederIDs[$arFields["PROPERTY_PROVIDER_VALUE"]]. ' - ' .$arFields["PROPERTY_END_PRICE_VALUE"]
					];
				}else{
					$allPrice[$arFields["PROPERTY_GOODS_ID_VALUE"]]["OTHER_PROVIDERS"][] = $provederIDs[$arFields["PROPERTY_PROVIDER_VALUE"]]. ' - ' .$arFields["PROPERTY_END_PRICE_VALUE"];
				}
			}
		}
		unset($res, $ob, $arFields);

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>4, "ACtIVE"=>"Y"], false, [], ["ID"]);
		while($arFields = $res->Fetch())
		{
			if($arFields["ID"]){
				if(!empty($allPrice[$arFields["ID"]])){
					if(!empty($allPrice[$arFields["ID"]]["WIN"])){
						CIBlockElement::SetPropertyValueCode($arFields["ID"], "WIN_PROVIDER", $allPrice[$arFields["ID"]]["WIN"]["PROVIDER"]);
						if(!empty($allPrice[$arFields["ID"]]["OTHER_PROVIDERS"])){
							CIBlockElement::SetPropertyValueCode($arFields["ID"], "OTHER_PROVIDERS", $allPrice[$arFields["ID"]]["OTHER_PROVIDERS"]);
						}
					}
				}
			}
		}
		unset($res, $ob, $arFields);
	}
	return "getMinPrice();";
}


