<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["ITEMS"])){
	$arFilter = [];
	$arFilter = ["ACTIVE" => "Y", ">UF_CATALOG_PRICE_1" => 0, "DEPTH_LEVEL"=>3];
	
	if($arParams["TYPE"] == "NEW"){
		$arFilter['>=DATE_CREATE'] = date('d.m.Y H:i:s',strtotime($arParams["YEAR"].'-01-01 -1year'));
		$order = ['DATE_CREATE' => 'DESC'];
	}
	if($arParams["TYPE"] == "IS_POPULAR"){
		$arFilter["!UF_HIT"] = false;
		$order = ['UF_HIT' => 'DESC'];
	}
	
	foreach($arResult["ITEMS"] as $item){
		
		$check["SALE"] = $sects = [];
		
		if(in_array($item["ID"] , $arParams["IBLOCK_ID"])){
			$arFilter["IBLOCK_ID"] = $item["ID"];
						
			$rsSect = CIBlockSection::GetList($order, $arFilter, false, ["ID", "NAME", "DATE_CREATE", "DETAIL_PICTURE", "PICTURE", "IBLOCK_ID", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "UF_CATALOG_PRICE_1", "UF_82", "UF_91", "UF_92", "UF_HIT"], ["nTopCount"=>$arParams["PAGE_ELEMENT_COUNT"]]);
			while ($arSect = $rsSect->GetNext()){
				if(!empty($arSect["DETAIL_PICTURE"]) || !empty($arSect["PICTURE"]))
					$arSect["PICTURE"] = CFile::ResizeImageGet(($arSect["DETAIL_PICTURE"] ?? $arSect["PICTURE"]), ["width" => 290, "height" => 290], BX_RESIZE_IMAGE_EXACT,true,false,false,75)["src"];
				
				if(!empty($arSect["UF_82"]))
					$arSect["STIKER_HIT"] = "Y";
				
				if(!empty($arSect["IBLOCK_SECTION_ID"]) && !in_array($arSect["IBLOCK_SECTION_ID"], $sects))
					$sects[] = $arSect["IBLOCK_SECTION_ID"];
				
				$arResult["COLLECTIONS"][$arSect["IBLOCK_ID"]][$arSect["ID"]] = $arSect;

			}

			$rsSect = CIBlockSection::GetList([], ["ACTIVE" => "Y", "IBLOCK_ID" => $item["ID"], "ID" => $sects], false, ["ID", "NAME"], ["nTopCount"=>$arParams["PAGE_ELEMENT_COUNT"]]);
			while ($arSect = $rsSect->GetNext()){
				$arResult["FABRIC"][$arSect["ID"]] = $arSect;
			}
		}
	}
}
