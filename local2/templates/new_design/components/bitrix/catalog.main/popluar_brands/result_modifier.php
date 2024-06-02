<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!empty($arResult["ITEMS"])){
	$arFilter = ["ACTIVE" => "Y", ">UF_HIT"=>0];
	foreach($arResult["ITEMS"] as $item){
		if(in_array($item["ID"] , $arParams["IBLOCK_ID"])){
			$arFilter["IBLOCK_ID"] = $item["ID"];
			if($item["ID"] == 11){
				$arFilter["DEPTH_LEVEL"] = 2;
			}else{
				$arFilter["DEPTH_LEVEL"] = 2;
			}
			
			$rsSect = CIBlockSection::GetList(['UF_HIT' => 'DESC'], $arFilter, false, ["ID", "NAME", "PICTURE", "IBLOCK_ID", "SECTION_PAGE_URL", "IBLOCK_SECTION_ID", "UF_HIT", "DEPTH_LEVEL"], ["nTopCount"=>20]);
			while ($arSect = $rsSect->GetNext()){
				if($arSect["ID"] != 30756 && $arSect["DEPTH_LEVEL"] ==2 && $arSect["IBLOCK_SECTION_ID"] != 37360){
					$arSect["LOGO"] = CFile::ResizeImageGet($arSect["PICTURE"], ["width" => 180, "height" => 180], BX_RESIZE_IMAGE_PROPORTIONAL,true,false,false,75)["src"];
					$arResult["BRANDS"][$arSect["IBLOCK_ID"]][] = $arSect;
				}
			}
		}
	}
}