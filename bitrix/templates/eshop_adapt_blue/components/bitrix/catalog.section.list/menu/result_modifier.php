<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arResult["ITEMS"] = [];

foreach($arResult["SECTIONS"] as $sect){
	if($sect["DEPTH_LEVEL"] == 1)
		$arResult["DEPTH_1"][] = $sect;
	
	if($sect["DEPTH_LEVEL"] == 2)
		$arResult["DEPTH_2"][$sect["IBLOCK_SECTION_ID"]][] = $sect;
	
	if($sect["DEPTH_LEVEL"] == 3)
		$arResult["DEPTH_3"][$sect["IBLOCK_SECTION_ID"]][] = $sect;
}
// $arRwulst["CUR_DIR"] = explode("/",$arParams["CUR_DIR"]);
$res = CIBlockElement::GetList(["SORT"=>"ASC"], ["IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y", "!PROPERTY_LINK"=>false], false, [], ["ID","NAME","CODE","IBLOCK_SECTION_ID", "IBLOCK_ID", "PROPERTY_LINK", "PROPERTY_COLUMN"]);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	if($arFields["PROPERTY_LINK_VALUE"])
		$arResult["ITEMS"][$arFields["IBLOCK_SECTION_ID"]][] = [
			"NAME" => $arFields["NAME"],
			"URL" => $arFields["PROPERTY_LINK_VALUE"]
		];
}
unset ($arResult["SECTIONS"]);

