<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); 
if (CModule::IncludeModule("iblock")):
	//global $USER; if($USER->IsAdmin()){echo '<pre>'; print_r($arResult); echo '</pre>';};
    $elementID = $arResult['ID'];
    $iblockId = $arResult['IBLOCK_ID'];
    
    $arrayLinksEl = array();
	$arrayLinksCol = array();
    $linkedArray = CIBlockElement::GetList(
        Array("ID" => "ASC"),
        Array("IBLOCK_ID" => $iblockId, "ID" => $elementID, "ACTIVE" => "Y"),
        false,
        false,
        Array(
            'ID',
            'PROPERTY_PROMOGOODS',
			'PROPERTY_PROMOSECTIONS_1',
			'PROPERTY_PROMOSECTIONS_2',
			'PROPERTY_PROMOSECTIONS_3',
			'PROPERTY_S_COLLECTIONS',
			'PROPERTY_S_PROVIDERS'
        )
    );
	$arIBlockIDEl = array();
	$PROP_S_COL = array();
	$PROP_S_PRO = array();
    while ($ar_fields = $linkedArray->GetNext()) {
        $LincedIsEmptyEl = $ar_fields['PROPERTY_PROMOGOODS_VALUE'];
        $arrayLinksEl[] = $ar_fields['PROPERTY_PROMOGOODS_VALUE'];
		
		$LincedIsEmptyCol1 = $ar_fields['PROPERTY_PROMOSECTIONS_1_VALUE'];
		$LincedIsEmptyCol2 = $ar_fields['PROPERTY_PROMOSECTIONS_2_VALUE'];
		$LincedIsEmptyCol3 = $ar_fields['PROPERTY_PROMOSECTIONS_3_VALUE'];
		
		$PROP_S_COL[] = $ar_fields['PROPERTY_S_COLLECTIONS_VALUE'];
		$PROP_S_PRO[] = $ar_fields['PROPERTY_S_PROVIDERS_VALUE'];
		
		if (!in_array($ar_fields['PROPERTY_PROMOSECTIONS_1_VALUE'], $arrayLinksCol["I1"] ?? []))
			$arrayLinksCol["I1"][] = $ar_fields['PROPERTY_PROMOSECTIONS_1_VALUE'];
		if (!in_array($ar_fields['PROPERTY_PROMOSECTIONS_2_VALUE'], $arrayLinksCol["I2"] ?? []))
			$arrayLinksCol["I2"][] = $ar_fields['PROPERTY_PROMOSECTIONS_2_VALUE'];
		if (!in_array($ar_fields['PROPERTY_PROMOSECTIONS_3_VALUE'], $arrayLinksCol["I3"] ?? []))
			$arrayLinksCol["I3"][] = $ar_fields['PROPERTY_PROMOSECTIONS_3_VALUE'];
		
		$elById = CIBlockElement::GetByID($ar_fields['PROPERTY_PROMOGOODS_VALUE']);
		if ($F = $elById->GetNext()) {
			// if (!in_array($F['IBLOCK_ID'], $arIBlockIDEl && $F['ACTIVE'] == "Y"))
			$arIBlockIDEl[] = $F['IBLOCK_ID'];
		}
    }	
	$arResult["AR_IBLOCK_ID_EL"] = $arIBlockIDEl;
	$arResult["IS_LINCED_EMPTY_EL"] = $LincedIsEmptyEl;
	$arResult["IS_LINCED_EMPTY_COL1"] = $LincedIsEmptyCol1;
	$arResult["IS_LINCED_EMPTY_COL2"] = $LincedIsEmptyCol2;
	$arResult["IS_LINCED_EMPTY_COL3"] = $LincedIsEmptyCol3;
	$arResult["AR_LINKS_EL"] = $arrayLinksEl;
	$arResult["AR_LINKS_COL"] = $arrayLinksCol;
	$arResult["PROP_S_COL"] = $PROP_S_COL;
	$arResult["PROP_S_PRO"] = $PROP_S_PRO;
endif;