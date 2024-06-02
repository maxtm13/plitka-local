<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["ITEMS"])){
	
	$arResult["YEAR"] = date('Y');
	
	$arParams["ROWS"] = (!empty($arParams["ROWS"]) ? $arParams["ROWS"] : 4);
	
	$arFilter = [];
	$arFilter = ["ACTIVE" => "Y", ">UF_CATALOG_PRICE_1" => 0, "DEPTH_LEVEL"=>3];
	
	if($arParams["TYPE"] == "SHOW_ROOM"){
		$arFilter["!UF_92"] = false;
		$order = ['DATE_CREATE' => 'DESC'];
	}
	if($arParams["TYPE"] == "NEW"){
		
		$arFilter['>=DATE_CREATE'] = date('d.m.Y H:i:s',strtotime($arResult["YEAR"].'-01-01 -1year'));
		$order = ['DATE_CREATE' => 'DESC'];
	}
	if($arParams["TYPE"] == "POPULAR"){
		$arFilter[">UF_HIT"] = 20;
		$order = ['UF_HIT' => 'DESC'];
	}
	
	if($arParams["TYPE"] == "LIST"){
		$arFilter["SECTION_ID"] = $arParams["SECTION_ID"];
		$order = ['UF_HIT' => 'DESC'];
	}
	
	$navPages = [
		"iNumPage" => 1,
		"nPageSize" => ($arParams["PAGE_ELEMENT_COUNT"] ? $arParams["PAGE_ELEMENT_COUNT"]: 40),
		"bShowAll" => false
	];
	
	$navPages["iNumPage"] = (!empty($arParams["PAGE"]) && $arParams["PAGE"] > 1 ? $arParams["PAGE"] : 1);
	
	foreach($arResult["ITEMS"] as $item){
		
		$check["SALE"] = $sects = [];
		
		if(in_array($item["ID"] , $arParams["IBLOCK_ID"])){
			$arFilter["IBLOCK_ID"] = $item["ID"];
						
			$rsSect = CIBlockSection::GetList($order, $arFilter, false, ["ID", "NAME", "DATE_CREATE", "DETAIL_PICTURE", "PICTURE", "IBLOCK_ID", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "UF_CATALOG_PRICE_1", "UF_82", "UF_91", "UF_92", "UF_HIT"], $navPages);
			
			while ($arSect = $rsSect->GetNext()){
				if(!empty($arSect["DETAIL_PICTURE"]) || !empty($arSect["PICTURE"]))
					$arSect["PICTURE"] = CFile::ResizeImageGet(($arSect["DETAIL_PICTURE"] ?? $arSect["PICTURE"]), ["width" => 438, "height" => 438], BX_RESIZE_IMAGE_EXACT,true,false,false,100)["src"];
				
				if(!empty($arSect["UF_82"]))
					$arSect["STIKER_HIT"] = "Y";
				
				if(!empty($arSect["IBLOCK_SECTION_ID"]) && !in_array($arSect["IBLOCK_SECTION_ID"], $sects))
					$sects[] = $arSect["IBLOCK_SECTION_ID"];
				
				$arResult["COLLECTIONS"][$arSect["IBLOCK_ID"]][$arSect["ID"]] = $arSect;
			}
			
			$arResult["NAV_STRING"] = $rsSect->GetPageNavString('', 'arrows', false);
			
			$rsSect = CIBlockSection::GetList([], ["IBLOCK_ID" => $item["ID"], "ID" => $sects], false, ["ID", "NAME"], ["nTopCount"=>$arParams["PAGE_ELEMENT_COUNT"]]);
			while ($arSect = $rsSect->GetNext()){
				$arResult["FABRIC"][$arSect["ID"]] = $arSect;
			}
		}
	}
}
