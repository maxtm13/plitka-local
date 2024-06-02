<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["ITEMS"])){

	$allids = [];

	unset($arResult["ITEMS"]);

	$navPages = [];

	$navPages = [
		"iNumPage" => $arParams["PAGE"],
		"nPageSize" => ($arParams["PAGE_ELEMENT_COUNT"] ? $arParams["PAGE_ELEMENT_COUNT"]: 12),
		"bShowAll" => false
	];

	if(!empty($arParams["IDS"]) && $arParams["TYPE"] == "VIEWED"){

		$res = CIBlockElement::GetList(["ID" => $arParams["IDS"]], ["ID" => $arParams["IDS"], "ACTIVE"=>"Y"], false, $navPages, ["ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_CREATE", "CATALOG_PURCHASING_PRICE"]);
		while($ob = $res->GetNext()){
			if($ob["ID"] != $arParams["PRODUCT"]){

				$ob["DISCOUNT"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"DISCOUNT"])->Fetch()["VALUE_ENUM"];					
				$ob["UNITS_TMP"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"UNITS_TMP"])->Fetch()["VALUE"];
				$ob["OLD_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"OLD_PRICE"])->Fetch()["VALUE"];
				$ob["NIGHT_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"NIGHT_PRICE"])->Fetch()["VALUE"];
				$ob["MARGIN"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"MARGIN"])->Fetch()["VALUE"];
				if(date('Y',strtotime($ob['DATE_CREATE'])) >= $arParams["CHECK_DATE"]):
					$ob["IS_NEW"] = true;
				endif;
				
				if(!empty($ob["DETAIL_PICTURE"])){
					$ob["PICTURE"] = CFile::ResizeImageGet(
						$ob["DETAIL_PICTURE"],
						array("width" => 290, "height" => 290),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true,
						false,
						[
						  "name" => "sharpen", 
						  "precision" => 0
						], 85
					);
				}
				
				$arResult["IDS"][] = $ob["ID"];
				$arResult["GOODS"][$ob["ID"]] = $ob;
			}
		}
		$arResult["IDS"] = array_reverse($arResult["IDS"]);
	}
	
	if(!empty($arParams["IS_FILTER"]) && $arParams["TYPE"] == "COLLECTION"){
		
		$arfilter = ["IBLOCK_ID" => $arParams["IBLOCK_ID"][0], "ACTIVE"=>"Y", "!ID" => $arParams["IS_PRODUCT"]];
		$arfilter = array_merge($arfilter, $arParams["IS_FILTER"]);
				
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"]], $arfilter, false, $navPages, ["ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_CREATE", "CATALOG_PURCHASING_PRICE"]);
		while($ob = $res->GetNext()){
			$i = '0';
			
			if($ob["ID"]){
				
				$i++;

				if($i < $arParams["PAGE_ELEMENT_COUNT"]){
					$ob["DISCOUNT"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"DISCOUNT"])->Fetch()["VALUE_ENUM"];					
					$ob["UNITS_TMP"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"UNITS_TMP"])->Fetch()["VALUE"];
					$ob["OLD_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"OLD_PRICE"])->Fetch()["VALUE"];
					$ob["NIGHT_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"NIGHT_PRICE"])->Fetch()["VALUE"];
					$ob["MARGIN"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"MARGIN"])->Fetch()["VALUE"];
					if(date('Y',strtotime($ob['DATE_CREATE'])) >= $arParams["CHECK_DATE"]):
						$ob["IS_NEW"] = true;
					endif;
				
					if(!empty($ob["DETAIL_PICTURE"])){
						$ob["PICTURE"] = CFile::ResizeImageGet(
							$ob["DETAIL_PICTURE"],
							array("width" => 291, "height" => 291),
							BX_RESIZE_IMAGE_PROPORTIONAL,
							true,
							false,
							[
							  "name" => "sharpen", 
							  "precision" => 0
							], 85
						);
					}
				
					$arResult["IDS"][] = $ob["ID"];
					$arResult["GOODS"][$ob["ID"]] = $ob;
				}else{
					break;
				}
			}
		}
	
		if(in_array($arParams["IBLOCK_ID"][0], [4, 9])){
			$arResult["SECTION_NAME"] = CIBlockSection::GetByID($arParams["IS_FILTER"]["SECTION_ID"])->GetNext()["NAME"];
		}
		
	}
	
	if($arParams["TYPE"] == "NEW"){
		
		$arfilter = ["IBLOCK_ID" => $arParams["IBLOCK_ID"][0], "ACTIVE"=>"Y", '>=DATE_CREATE'=> date('d.m.Y H:i:s', strtotime($arParams["YEAR"].'-01-01 -1year'))];
				
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"]], $arfilter, false, $navPages, ["ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_CREATE", "CATALOG_PURCHASING_PRICE"]);
		while($ob = $res->GetNext()){
			
			$i = '0';
			
			if($ob["ID"]){
				
				$i++;

				if($i < $arParams["PAGE_ELEMENT_COUNT"]){
					$ob["DISCOUNT"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"DISCOUNT"])->Fetch()["VALUE_ENUM"];					
					$ob["UNITS_TMP"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"UNITS_TMP"])->Fetch()["VALUE"];
					$ob["OLD_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"OLD_PRICE"])->Fetch()["VALUE"];
					$ob["NIGHT_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"NIGHT_PRICE"])->Fetch()["VALUE"];
					$ob["MARGIN"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"MARGIN"])->Fetch()["VALUE"];
					$ob["IS_NEW"] = true;
				
					if(!empty($ob["DETAIL_PICTURE"])){
						$ob["PICTURE"] = CFile::ResizeImageGet(
							$ob["DETAIL_PICTURE"],
							array("width" => 291, "height" => 291),
							BX_RESIZE_IMAGE_PROPORTIONAL,
							true,
							false,
							[
							  "name" => "sharpen", 
							  "precision" => 0
							], 85
						);
					}
				
					$arResult["IDS"][] = $ob["ID"];
					$arResult["GOODS"][$ob["ID"]] = $ob;
				}else{
					break;
				}
			}
		}
	
		if(in_array($arParams["IBLOCK_ID"][0], [4, 9])){
			$arResult["SECTION_NAME"] = CIBlockSection::GetByID($arParams["IS_FILTER"]["SECTION_ID"])->GetNext()["NAME"];
		}
		
	}
	
	if($arParams["TYPE"] == "POPULAR"){
		
		$arfilter = ["IBLOCK_ID" => $arParams["IBLOCK_ID"][0], "ACTIVE"=>"Y", '!PROPERTY_POPULAR'=> false];
		
		if($arParams["IBLOCK_ID"][0] == 11){
			$arfilter[">CATALOG_PRICE_1"] = '10000';
		}
				
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"]], $arfilter, false, $navPages, ["ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_CREATE", "CATALOG_PURCHASING_PRICE"]);
		while($ob = $res->GetNext()){
			
			$i = '0';
			
			if($ob["ID"]){
				
				$i++;

				if($i < $arParams["PAGE_ELEMENT_COUNT"]){
					$ob["DISCOUNT"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"DISCOUNT"])->Fetch()["VALUE_ENUM"];					
					$ob["UNITS_TMP"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"UNITS_TMP"])->Fetch()["VALUE"];
					$ob["OLD_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"OLD_PRICE"])->Fetch()["VALUE"];
					$ob["NIGHT_PRICE"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"NIGHT_PRICE"])->Fetch()["VALUE"];
					$ob["MARGIN"] = CIBlockElement::GetProperty($ob["IBLOCK_ID"], $ob["ID"], ["sort"=>"asc"], ["CODE"=>"MARGIN"])->Fetch()["VALUE"];
					$ob["IS_NEW"] = true;
				
					if(!empty($ob["DETAIL_PICTURE"])){
						$ob["PICTURE"] = CFile::ResizeImageGet(
							$ob["DETAIL_PICTURE"],
							array("width" => 291, "height" => 291),
							BX_RESIZE_IMAGE_PROPORTIONAL,
							true,
							false,
							[
							  "name" => "sharpen", 
							  "precision" => 0
							], 85
						);
					}
				
					$arResult["IDS"][] = $ob["ID"];
					$arResult["GOODS"][$ob["ID"]] = $ob;
				}else{
					break;
				}
			}
		}
	
		if(in_array($arParams["IBLOCK_ID"][0], [4, 9])){
			$arResult["SECTION_NAME"] = CIBlockSection::GetByID($arParams["IS_FILTER"]["SECTION_ID"])->GetNext()["NAME"];
		}
		
	}
	
	if($arParams["TYPE"] == "LICVID"){
		
		$iblocks = [4, 9, 11, 15];
		
		foreach($iblocks as $iblock){
			$res = CIBlockElement::GetList(["ID" => "DESC"], ["IBLOCK_ID" => $iblock, "PROPERTY_DISCOUNT_VALUE" =>"3", "ACTIVE"=>"Y"], false, $navPages, ["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_UNITS_TMP", "PROPERTY_OLD_PRICE", "PROPRTY_NIGHT_PRICE", "PROPRTY_MARGIN", "DATE_CREATE", "CATALOG_PURCHASING_PRICE"]);
			while($ob = $res->GetNext()){
				if($ob["ID"] != $arParams["PRODUCT"]){
					if(!empty($ob["DETAIL_PICTURE"])){
						$ob["PICTURE"] = CFile::ResizeImageGet(
							$ob["DETAIL_PICTURE"],
							array("width" => 290, "height" => 290),
							BX_RESIZE_IMAGE_PROPORTIONAL,
							true,
							false,
							[
							  "name" => "sharpen", 
							  "precision" => 0
							], 85
						);
					}
					$ob["UNITS_TMP"] = $ob["PROPERTY_UNITS_TMP_VALUE"];
					$ob["OLD_PRICE"] = $ob["PROPERTY_OLD_PRICE_VALUE"];
					$ob["NIGHT_PRICE"] = $ob["PROPERTY_NIGHT_PRICE_VALUE"];
					$ob["MARGIN"] = $ob["PROPERTY_MARGIN_VALUE"];
					if(date('Y',strtotime($ob['DATE_CREATE'])) >= $arParams["CHECK_DATE"]):
                    	$ob["IS_NEW"] = true;
                	endif;
					
					$arResult["GOODS"][$ob["ID"]] = $ob;
					$allids[] = $ob["ID"];
				}
			}
		}
		
		$navPages = [];
		$navPages = [
			"iNumPage" => 1,
			"nPageSize" => 10,
			"bShowAll" => false
		];
		
		if(!empty($allids)){
			$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"], "NAME"=>"ASC"], ["ID" => $allids, "ACTIVE"=>"Y"], false, $navPages, ["ID", "NAME"]);
			while($ob = $res->Fetch()){
				$arResult["IDS"][] = $ob["ID"];
			}
		
		}	
	}
	
	if(!empty($arResult["IDS"])){

		\Bitrix\Main\Loader::includeModule("sale");
		\Bitrix\Main\Loader::includeModule("catalog");

		foreach($arResult["IDS"] as $itemID){

			$dbPrice = CPrice::GetList(
				["SORT" => "ASC"],
				["PRODUCT_ID" => $itemID],
				false,
				false,
				["ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY"]
			);
			while ($arPrice = $dbPrice->Fetch())
			{
				$arDiscounts = CCatalogDiscount::GetDiscountByPrice(
					$arPrice["ID"],
					$arParams["USER_GROUP"],
					"N",
					SITE_ID
				);
				$discountPrice = CCatalogProduct::CountPriceWithDiscount(
					$arPrice["PRICE"],
					$arPrice["CURRENCY"],
					$arDiscounts
				);
				$arPrice["DISCOUNT_PRICE"] = $discountPrice;

				$arResult["PRICES"][$itemID] = $arPrice;
			}
		}
	}
	
	$arResult["PAGINATION"] = $res->GetPageNavString(
		'Элементы', // поясняющий текст
		'round',   // имя шаблона
		false       // показывать всегда?
	);

	unset($arResult["ITEMS"]);	
}