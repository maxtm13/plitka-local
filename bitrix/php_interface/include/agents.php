<?

function getVideoViews(){
	$content = file_get_contents("https://youtube.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=PNokm3_XRzE&key=AIzaSyAMUCyJibq25NJWVFxfOy89hRBEKWEE1-8");
	$content_data = json_decode($content);
	$views = '';
	$views = $content_data->items[0]->statistics->viewCount;
	if(!empty($views)){
		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/ajax/video_views.json', 'w');
		fwrite($fp, json_encode($views));
		fclose($fp);
	}
	unset($views, $content_data, $content);

	return 'getVideoViews();';
}

function deleteSopostavleniya(){
	if(CModule::IncludeModule('iblock')){
		$i = 0;
		$items = [];

		$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>SOPOSTAVLENIE_KERAMIKA], false, [], ["ID"]);
		while($arFields = $res->Fetch())
		{
			$items[] = $arFields["ID"];	
		}
		if(count($items)>1){
			foreach($items as $item){
				if(CIBlockElement::Delete($item)){
					$i++;
				}
			}
		}
	}
}

function replaceSlashInSitemapSeoLinks(){
	$file_url = $_SERVER['DOCUMENT_ROOT']."/sitemap-iblock-33.xml";

	if(file_exists($file_url)){
		$content = file_get_contents($file_url);
		$checnges = str_replace("%2F", "/", $content);
		file_put_contents($file_url, $checnges);
	}
	return 'replaceSlashInSitemapSeoLinks();';
}

function manageSectionFromID(){
	
	if (CModule::IncludeModule('iblock')) {
		
		$arPropValue = []; // список значений всех свойств
		
		$price_type = 1; // (используется только один ТИП ЦЕН (на случай будущих доработок)
		
		$fileUrl = LINK_CATEGORY_LIST;
		
		$user_prefix = "UF_";
		
		if(file_exists($fileUrl)){
			
			$categories = file_get_contents($fileUrl);

			if(!empty($categories)){

				$categories = json_decode($categories, true);

				if(!empty($categories)){ //  только по три раздела за раз в целях экономии нагрузки
					
					foreach($categories as $co => $category){
						
						if($co < 150 && !empty($category)){
							
							// Исходный вариант некоторых значений
							$arPropLinks = $arPropValue = [];
							$arPropValue["UF_CATALOG_PRICE_" . $price_type] = 0;
							$firstPrice = 0;
							$arPropValue["UF_AVAILABILITY"] = ""; // Удаляем значение так как оно уже не имеет смысла
							$arPropValue["SORT"] = 500;
					//		$arPropValue["ACTIVE"] = "N";
							$hav = false;
							
							$arException = ['91', '92', '82', '43'];
					
							$res = CIBlockSection::GetByID($category);

							if($section = $res->GetNext()){

								$arPropValue["IBLOCK_ID"] = $section["IBLOCK_ID"];

								$arPropValue["NAME"] = $section["NAME"];
								$arPropValue["CODE"] = $section["CODE"];

								$arSelect = ["IBLOCK_ID", "ID", "IBLOCK_SECTION_ID", "CATALOG_PRICE_". $price_type, "PROPERTY_AVAILABILITY", "PROPERTY_UNITS_TMP"];

								if($section["IBLOCK_ID"] == 4){

									$arPropLinks = CIBlockSectionPropertyLink::GetArray($section["IBLOCK_ID"], 0);

									// Массив идентификаторов свойств флажков (хит, скидка, наличие образца), которые не нужно отображать в умном фильтре, но необходимы для отображения раздела

									if(!empty($arPropLinks)) {

										foreach ($arPropLinks as $key => $prop) {
											if ($prop['SMART_FILTER'] != 'Y' && !in_array($key, $arException)) {
												unset($arPropLinks[$key]);
											} else {
												$arSelect[] = "PROPERTY_" . $key;
												$arPropValue[$user_prefix . $key] = [];
											}
										}
									}
								}

								$obElement = CIBlockElement::GetList(["ID" => "ASC"], ["IBLOCK_ID" => $section["IBLOCK_ID"], "SECTION_ID" => $section["ID"], "ACTIVE" => "Y"], false, false, $arSelect);

								while ($arElement = $obElement->GetNext()) {

									if($arElement["ID"]){

										if($arElement["CATALOG_PRICE_" . $price_type] > 0 && empty($arPropValue["UF_CATALOG_PRICE_" . $price_type])){
											$arPropValue["UF_CATALOG_PRICE_" . $price_type] = (int)$arElement["CATALOG_PRICE_" . $price_type];
										}

									//	$arPropValue["ACTIVE"] = "Y";
/*
										if($arPropValue["UF_CATALOG_PRICE_" . $price_type] < 1 && $arElement["CATALOG_PRICE_" . $price_type] > 0 && $arElement["PROPERTY_UNITS_TMP_VALUE"] == "кв. м."){
											$arPropValue["UF_CATALOG_PRICE_" . $price_type] = (int)$arElement["CATALOG_PRICE_" . $price_type];
										}
*/
										if($section["IBLOCK_ID"] == 4){

											foreach ($arPropLinks as $id => $prop) {
												if ($prop['PROPERTY_TYPE'] == 'N') {
													$sPropName = "PROPERTY_" . $id . "_VALUE";
												} else {
													$sPropName = "PROPERTY_" . $id . "_ENUM_ID";
												}
												if (!empty($arElement[$sPropName]) && !in_array($arElement[$sPropName], $arPropValue[$user_prefix . $id])){
													$arPropValue[$user_prefix . $id][] = $arElement[$sPropName];
												}
											}
										}
									}
								}

								$bs = new CIBlockSection();
								$res = $bs->Update($section["ID"], $arPropValue);

								if($res > 0){

									array_shift($categories);

									if(!empty($categories)){
										$fp = fopen($fileUrl, 'w');
										fwrite($fp, json_encode($categories));
										fclose($fp);
									}else{
										unlink($fileUrl);
									}
								}
							}
						}
					}
				}
			}
		}
		
		return 'manageSectionFromID();';
	}
}

function getCategoriesForFids_v1(){
	
	if(CModule::IncludeModule('iblock')){
		$result = $allids = [];

		$arFilter = array('IBLOCK_ID' => 4,'ACTIVE'=>'Y', '<DEPTH_LEVEL' => 4);
		$rsSect = CIBlockSection::GetList(['DEPTH_LEVEL' => 'ASC'],$arFilter, false, ["ID","IBLOCK_SECTION_ID", "SECTION_PAGE_URL", "NAME","DEPTH_LEVEL", "UF_CATALOG_PRICE_1", "PICTURE", "UF_44"]);
		while ($arSect = $rsSect->GetNext())
		{
			if($arSect["DEPTH_LEVEL"] == 1){
				$result["lv1"][$arSect["ID"]] = [];
			}
			if($arSect["DEPTH_LEVEL"] == 2){
				$result['v2'][$arSect["IBLOCK_SECTION_ID"]][$arSect["ID"]] = [
					"s" => $arSect["IBLOCK_SECTION_ID"], // parentid
					"n"=> $arSect["NAME"], // name
				];
			}
			if($arSect["DEPTH_LEVEL"] == 3){
				$result['v3'][$arSect["IBLOCK_SECTION_ID"]][$arSect["ID"]] = [
					"s" => $arSect["IBLOCK_SECTION_ID"], // parentid
					"n"=> $arSect["NAME"], // name
					"l"=> $arSect["SECTION_PAGE_URL"], // link
					"i"=> $arSect["PICTURE"], // img
					"p"=> $arSect["UF_CATALOG_PRICE_1"], // name
				];
			}
		}

		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_categories_v3.json', 'w');
		fwrite($fp, json_encode($result));
		fclose($fp);
		
		return "getCategoriesForFids_v1();";
	}
}