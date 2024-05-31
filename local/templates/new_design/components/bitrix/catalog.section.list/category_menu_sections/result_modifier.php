<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach($arResult["SECTIONS"] as $key=>$sections){
	if($sections["DEPTH_LEVEL"] == '2'){
		if($sections["PICTURE"]){
			$sections["IMG"] = CFile::ResizeImageGet($sections["PICTURE"]["ID"], ["width" => 290, "height" => 290], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, ["name" => "sharpen", "precision" => 0], 80)["src"];
		}

		$arResult["DEPTH_2"][$sections["ID"]] = $sections;
	}
}
foreach($arResult["SECTIONS"] as $key=>$sections){
	if($sections["DEPTH_LEVEL"] == '3'){
		$arResult["DEPTH_2"][$sections["IBLOCK_SECTION_ID"]]["SUBS"][$sections["ID"]] = $sections;
	}
}

$res = CIBlockElement::GetList([], ["IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y"], false, [], ["ID","IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_LINK"]);
while ($ob = $res->GetNext())
{
	$ob["LINK"] = $ob["PROPERTY_LINK_VALUE"];
	if($ob["PREVIEW_PICTURE"]){
		$ob["IMG"] = CFile::ResizeImageGet($ob["PREVIEW_PICTURE"], ["width" => 290, "height" => 290], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, ["name" => "sharpen", "precision" => 0], 80)["src"];
	}
	$arResult["SUBS"][$ob["IBLOCK_SECTION_ID"]][] = $ob;
}

foreach($arResult["DEPTH_2"] as $k=>$depth2):
	if(!empty($depth2["SUBS"])):
		foreach($depth2["SUBS"] as $kk=>$subs):
			if(!empty($arResult["SUBS"][$subs["ID"]])):
				$arResult["DEPTH_2"][$k]["ITEMS"][$subs["ID"]] = $arResult["SUBS"][$subs["ID"]];
				unset($arResult["SUBS"][$subs["ID"]]);
			endif;
		endforeach;
	else:
		$arResult["DEPTH_2"][$k]["ITEMS"][$depth2["ID"]] = $arResult["SUBS"][$depth2["ID"]];
		unset($arResult["SUBS"][$subs["ID"]]);
	endif;
endforeach;