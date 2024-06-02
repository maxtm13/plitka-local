<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["ITEMS"])){
	
	$allids = [];
	
	unset($arResult["ITEMS"]);
	
	$navPages = $iblockprops = $iblockenum = [];
	
	$navPages = [
		"iNumPage" => (!empty($arParams["PAGE"]) && $arParams["PAGE"] > 1 ? $arParams["PAGE"] : 1),
		"nPageSize" => ($arParams["PAGE_ELEMENT_COUNT"] ? $arParams["PAGE_ELEMENT_COUNT"]: 20),
		"bShowAll" => false
	];
	
	$selects = [];
	$selects = ["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_CREATE", "CATALOG_PURCHASING_PRICE", "PROPERTY_SIZE"];
	
	$ibselects[4] = ["PROPERTY_UNITS_TMP", "PROPERTY_SIZE_WIDTH", "PROPERTY_SIZE_LENGTH"];
	$ibselects[9] = ["PROPERTY_MEASURE", "PROPERTY_WIDTH_MM", "PROPERTY_LENGTH_MM", "PROPERTY_SHTUK_V_UPAC", "PROPERTY_KVM_v_UPAC"];
	
	$arProductsExclude = array(191023, 210039, 456314, 456315, 293803, 456313, 454011, 454012, 456312, 191024, 402017, 293804, 444252);
	
	if(!empty($arParams["IDS"]) && $arParams["TYPE"] == "VIEWED"){

		foreach($arParams["IBLOCK_ID"] as $iblock){
			
			$merge_selects = (!empty($ibselects[$iblock]) ? array_merge($selects, $ibselects[$iblock]) : $selects);
			
			$res = CIBlockElement::GetList(["IBLOCK_ID" =>$iblock, "ID" => $arParams["IDS"], "NAME" => "ASC"], ["ID" => $arParams["IDS"], "ACTIVE"=>"Y", "!ID" => $arProductsExclude, "!CATALOG_PRICE_1" => false, ">CATALOG_PRICE_1" => 0], false, $navPages, $merge_selects);
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
		}
		$arResult["IDS"] = array_reverse($arResult["IDS"]);
	}
	
	if(!empty($arParams["IS_FILTER"]) && $arParams["TYPE"] == "COLLECTION"){
		
		$iblock = $arParams["IBLOCK_ID"][0];
		
		$arProductsExclude[] = $arParams["IS_PRODUCT"];
		
		$merge_selects = (!empty($ibselects[$iblock]) ? array_merge($selects, $ibselects[$iblock]) : $selects);
		
		$arfilter = ["IBLOCK_ID" => $iblock, "ACTIVE"=>"Y", "!ID" => $arProductsExclude, "!CATALOG_PRICE_1" => false, ">CATALOG_PRICE_1" => 0];
		$arfilter = array_merge($arfilter, $arParams["IS_FILTER"]);
		
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"], "NAME" => "ASC"], $arfilter, false, $navPages, $merge_selects);
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
	
		if(in_array($iblock, [4, 9])){
			$arResult["SECTION_NAME"] = CIBlockSection::GetByID($arParams["IS_FILTER"]["SECTION_ID"])->GetNext()["NAME"];
		}
		
	}
	
	if($arParams["TYPE"] == "JUST"){
		
		$iblock = $arParams["IBLOCK_ID"][0];
		
		$isfilter = [];
		
		if(!empty($arParams["IS_FILTER"])){
			
			$res = CIBlock::GetProperties($iblock, [], []);

			while($ob = $res->Fetch()){
				$iblockprops[$ob["ID"]] = $ob["CODE"];
				$iblockpropsL[$ob["ID"]] = $ob["PROPERTY_TYPE"];
				if(in_array($ob["PROPERTY_TYPE"], ["L", "C", "S", "N"])){
					$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblock, "CODE"=>$ob["CODE"], ""));
					while($enum_fields = $property_enums->GetNext())
					{
					  $iblockenum[$ob["ID"]][abs(crc32(htmlspecialcharsbx($enum_fields["ID"])))] = $enum_fields["ID"];
					}
				}
			}
			
			foreach($arParams["IS_FILTER"] as $k=>$fval){
				$wxp = explode("arrFilter_", htmlspecialchars($k));
				if(!empty($wxp[1]) && $fval == "Y"){

					$exexp = explode("_",$wxp[1]);
					if($iblockpropsL[$exexp[0]] == "L" || $iblockpropsL[$exexp[0]] == "C"){
						$isfilter["PROPERTY_".$iblockprops[$exexp[0]]][] = $iblockenum[$exexp[0]][$exexp[1]];
					}else{
						$isfilter["PROPERTY_".$iblockprops[$exexp[0]]][] = $arParams["ALL_ENUMS"][$k];
					}
				}elseif(!empty($wxp[1]) && is_numeric($fval)){

					$exexp = explode("_",$wxp[1]);

					if($exexp[1] == "MIN"){
						$k = '>='.($exexp[0] == 'P1' ? 'CATALOG_PRICE_1' : "PROPERTY_".$iblockprops[$exexp[0]]);
					}
					if($exexp[1] == "MAX"){
						$k = '<='.($exexp[0] == 'P1' ? 'CATALOG_PRICE_1' : "PROPERTY_".$iblockprops[$exexp[0]]);
					}

					$isfilter[$k] = htmlspecialchars($fval);

				}
			}
			
		}
		
		if(!empty($arParams["USUALLY_FILTER"])){
			$isfilter = $arParams["USUALLY_FILTER"];
		}
		
		$merge_selects = (!empty($ibselects[$iblock]) ? array_merge($selects, $ibselects[$iblock]) : $selects);
		
		$arfilter = ["IBLOCK_ID" => $iblock, "ACTIVE"=>"Y", "!ID" => $arProductsExclude, "!CATALOG_PRICE_1" => false, ">CATALOG_PRICE_1" => 0];
		
		if(!empty($arParams["SECTION_ID"])){
			$isfilter["SECTION_ID"] = $arParams["SECTION_ID"];
			$isfilter["INCLUDE_SUBSECTIONS"] = "Y";
		}

		if(!empty($isfilter)){
			$arfilter = array_merge($arfilter, $isfilter);
		}
		
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"], "NAME" => "ASC"], $arfilter, false, $navPages, $merge_selects);
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
	
		if(!empty($arParams["SECTION_ID"]) && !empty($arParams["SHOW_SECTION_DESC"])){
			$arResult["SECTION"] = CIBlockSection::GetByID($arParams["SECTION_ID"])->GetNext();
		}
/*		
		$arResult["SECTIONS"] = [];

		if($arParams["BRAND"]){
			$arFilter = ['IBLOCK_ID' => $arParams["IBLOCK_ID"],'ID' => $arParams["BRAND"]["SECTIONS"], "ACTIVE"=>"Y", "DEPTH_LEVEL" => ["1","2"]];
		   $rsSect = CIBlockSection::GetList([],$arFilter, false, ["PICTURE", "NAME", "CODE", "ACTIVE", "SECTION_PAGE_URL", "DEPTH_LEVEL"]);
		   while ($arSect = $rsSect->GetNext())
		   {
				$arResult["SECTIONS"][] = [
					"ACTIVE" => $arSect["ACTIVE"],
					"NAME" => $arSect["NAME"],
					"DEPTH" => $arSect["DEPTH_LEVEL"],
					"CODE" => $arSect["CODE"],
					"URL" => $arSect["SECTION_PAGE_URL"],
					"PICTURE" => ($arSect["PICTURE"] ? CFile::GetPath($arSect["PICTURE"]) : ''),
				];
			}
		}
*/
	}
	
	if($arParams["TYPE"] == "NEW"){
		
		$iblock = $arParams["IBLOCK_ID"][0];
		
		$merge_selects = (!empty($ibselects[$iblock]) ? array_merge($selects, $ibselects[$iblock]) : $selects);
		
		$arfilter = ["IBLOCK_ID" => $iblock, "ACTIVE"=>"Y", '>=DATE_CREATE'=> date('d.m.Y H:i:s', strtotime($arParams["YEAR"].'-01-01 -1year')), "!ID" => $arProductsExclude, "!CATALOG_PRICE_1" => false, ">CATALOG_PRICE_1" => 0];
				
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"], "NAME" => "ASC"], $arfilter, false, $navPages, $merge_selects);
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
						$ob["PICTURE"]["MIN"] = CFile::ResizeImageGet(
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
	
		if(in_array($iblock, [4, 9])){
			$arResult["SECTION_NAME"] = CIBlockSection::GetByID($arParams["IS_FILTER"]["SECTION_ID"])->GetNext()["NAME"];
		}
		
	}
	
	if($arParams["TYPE"] == "POPULAR"){
		
		$iblock = $arParams["IBLOCK_ID"][0];
		
		$merge_selects = (!empty($ibselects[$iblock]) ? array_merge($selects, $ibselects[$iblock]) : $selects);
		
		$arfilter = ["IBLOCK_ID" => $iblock, "ACTIVE"=>"Y", '!PROPERTY_POPULAR'=> false, "!ID" => $arProductsExclude, "!CATALOG_PRICE_1" => false, ">CATALOG_PRICE_1" => 0];
		
		if($iblock == 11){
			$arfilter[">CATALOG_PRICE_1"] = '10000';
		}
				
		$res = CIBlockElement::GetList([$arParams["SORT"] => $arParams["SORT_ORDER"], "NAME" => "ASC"], $arfilter, false, $navPages, $merge_selects);
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
	
		if(in_array($iblock, [4, 9])){
			$arResult["SECTION_NAME"] = CIBlockSection::GetByID($arParams["IS_FILTER"]["SECTION_ID"])->GetNext()["NAME"];
		}
		
	}
	
	if($arParams["TYPE"] == "LICVID"){
		
		foreach($arParams["IBLOCK_ID"] as $iblock){
			
			$res = CIBlockElement::GetList(["ID" => "DESC"], ["IBLOCK_ID" => $iblock, "PROPERTY_DISCOUNT_VALUE" =>"3", "ACTIVE"=>"Y", "!ID" => $arProductsExclude, "!CATALOG_PRICE_1" => false, ">CATALOG_PRICE_1" => 0], false, [], ["ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_UNITS_TMP", "PROPERTY_OLD_PRICE", "PROPRTY_NIGHT_PRICE", "PROPRTY_MARGIN", "DATE_CREATE", "CATALOG_PURCHASING_PRICE"]);
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
					[2],
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
	
	if(!empty($res))
		$arResult["NAV_STRING"] = $res->GetPageNavString('', 'modern', false);

	unset($arResult["ITEMS"]);	
}