<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);

$arParams["COUNT_ELEMENTS"] = $arParams["COUNT_ELEMENTS"]!="N";

/*** begin 2014-11-13 ***/
if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}

// Подготовим фильтр
if(!empty($arrFilter)){
	foreach($arrFilter as $key => $val){
		if(mb_strpos($key, 'PROPERTY_') !== false){
			unset($arrFilter[$key]);
			$arrFilter[str_replace('PROPERTY', 'UF', $key)] = $val;
		} elseif(mb_strpos($key, 'CATALOG') !== false){
			unset($arrFilter[$key]);
			$arrFilter[str_replace('CATALOG', 'UF_CATALOG', $key)] = $val;
		}
	} // end foreach
}

$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]!="N";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]!=="N";

if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"])
{
	$arNavParams = array(
		"nPageSize" => $arParams["SECTION_COUNT"],
		"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
		"bShowAll" => $arParams["PAGER_SHOW_ALL"],
	);
	$arNavigation = CDBResult::GetNavParams($arNavParams);
	if($arNavigation["PAGEN"]==0 && $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]>0)
		$arParams["CACHE_TIME"] = $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"];
}
else
{
	$arNavParams = array(
		"nPageSize" => $arParams["SECTION_COUNT"],
		"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
	);
	$arNavigation = false;
}
/*** end 2014-11-13 ***/

$arResult["SECTIONS"]=array();

/*************************************************************************
			Work with cache
*************************************************************************/
if($this->StartResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $arNavigation, $arrFilter)))
{
	if(!\Bitrix\Main\Loader::includeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}
	$arFilter = array(
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CNT_ACTIVE" => "Y",
	);

	$arSelect = array();
	if(array_key_exists("SECTION_FIELDS", $arParams) && !empty($arParams["SECTION_FIELDS"]) && is_array($arParams["SECTION_FIELDS"]))
	{
		foreach($arParams["SECTION_FIELDS"] as &$field)
		{
			if (!empty($field) && is_string($field))
				$arSelect[] = $field;
		}
		if (isset($field))
			unset($field);
	}

	if(!empty($arSelect))
	{
		$arSelect[] = "ID";
		$arSelect[] = "NAME";
		$arSelect[] = "LEFT_MARGIN";
		$arSelect[] = "RIGHT_MARGIN";
		$arSelect[] = "DEPTH_LEVEL";
		$arSelect[] = "IBLOCK_ID";
		$arSelect[] = "IBLOCK_SECTION_ID";
		$arSelect[] = "LIST_PAGE_URL";
		$arSelect[] = "SECTION_PAGE_URL";
	}
	$boolPicture = empty($arSelect) || in_array('PICTURE', $arSelect);

	if(isset($arParams['SECTION_USER_FIELDS']) && !empty($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"]))
	{
		foreach($arParams["SECTION_USER_FIELDS"] as &$field)
		{
			if(is_string($field) && preg_match("/^UF_/", $field))
				$arSelect[] = $field;
		}
		if (isset($field))
			unset($field);
	}

	$intSectionDepth = 0;

 	$arFilter = array_merge($arFilter, $arrFilter);
	
	$arSec =array(); //коллекции товаров
	if (CModule::IncludeModule('sale')) {
		//получаем заказы за 3 последних месяца
		$arTmp = array();
		$rOrders = CSaleOrder::GetList(array('ID'=>'ASC'), array('DATE_FROM'=>date('d.m.Y H:i:s', strtotime('-3 month')), 'DATE_TO'=>date('d.m.Y H:i:s')), false, false, array('ID'));
		while($arOrder = $rOrders->GetNext()) {
			$arTmp[] = $arOrder['ID'];
		}
		//получаем товары заказов
		$rProds = CSaleBasket::GetList(array('ID'=>'ASC'), array('ORDER_ID'=>$arTmp), false, false, array('ID', 'PRODUCT_ID'));
		$arTmp = array();
		while($arProd = $rProds->GetNext()) {
			$arTmp[] = $arProd['PRODUCT_ID'];
		}
		//получаем разделы товаров заказа
		$resSec = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ID' => $arTmp), false, false, array("IBLOCK_SECTION_ID"));
		while($arS = $resSec->GetNext()){
			if (!empty($arSec[$arS['IBLOCK_SECTION_ID']])) {
				$arSec[$arS['IBLOCK_SECTION_ID']] += 1;
			} else {
				$arSec[$arS['IBLOCK_SECTION_ID']] = 1;
			}
		}
		arsort($arSec);
		$arSec = array_slice($arSec, 0, $arParams['SECTION_COUNT'], TRUE);
		$arSec = array_keys($arSec);
		$arFilter['ID'] = $arSec;
	}
  
	//$intSectionDepth = !empty($arFilter['DEPTH_LEVEL']) ? $arFilter['DEPTH_LEVEL'] : $arResult["SECTION"]['DEPTH_LEVEL'];

	//EXECUTE
	$rsSections = CIBlockSection::GetList(array(), $arFilter, $arParams["COUNT_ELEMENTS"], $arSelect, $arNavParams);
	$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
	while($arSection = $rsSections->GetNext())
	{
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection["IBLOCK_ID"], $arSection["ID"]);
		$arSection["IPROPERTY_VALUES"] = $ipropValues->getValues();

		if ($boolPicture)
		{
			$mxPicture = false;
			$arSection["PICTURE"] = intval($arSection["PICTURE"]);
			if (0 < $arSection["PICTURE"])
				$mxPicture = CFile::GetFileArray($arSection["PICTURE"]);
			$arSection["PICTURE"] = $mxPicture;
			if ($arSection["PICTURE"])
			{
				$arSection["PICTURE"]["ALT"] = $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"];
				if ($arSection["PICTURE"]["ALT"] == "")
					$arSection["PICTURE"]["ALT"] = $arSection["NAME"];
				$arSection["PICTURE"]["TITLE"] = $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"];
				if ($arSection["PICTURE"]["TITLE"] == "")
					$arSection["PICTURE"]["TITLE"] = $arSection["NAME"];
			}
		}
		$arSection['RELATIVE_DEPTH_LEVEL'] = $arSection['DEPTH_LEVEL'] - $intSectionDepth;

		$arButtons = CIBlock::GetPanelButtons(
			$arSection["IBLOCK_ID"],
			0,
			$arSection["ID"],
			array("SESSID"=>false, "CATALOG"=>true)
		);
		$arSection["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
		$arSection["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];
		
		$k = array_search($arSection['ID'], $arSec);
		$arResult["SECTIONS"][$k]=$arSection;
	}
	
	$arResult["NAV_STRING"] = $rsSections->GetPageNavStringEx($navComponentObject, $arParams["PAGER_TITLE"], $arParams["PAGER_TEMPLATE"], $arParams["PAGER_SHOW_ALWAYS"]);
	$arResult["NAV_CACHED_DATA"] = $navComponentObject->GetTemplateCachedData();
	$arResult["NAV_RESULT"] = $rsSections;
	$arResult["SECTIONS_COUNT"] = count($arResult["SECTIONS"]);

	$this->SetResultCacheKeys(array(
		"SECTIONS_COUNT",
		/*"SECTION",*/
	));

	$this->IncludeComponentTemplate();
}

if($arResult["SECTIONS_COUNT"] > 0)
{
	if(
		$USER->IsAuthorized()
		&& $APPLICATION->GetShowIncludeAreas()
		&& \Bitrix\Main\Loader::includeModule("iblock")
	)
	{
		$UrlDeleteSectionButton = "";

		if(empty($UrlDeleteSectionButton))
		{
			$url_template = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "LIST_PAGE_URL");
			$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
			$arIBlock["IBLOCK_CODE"] = $arIBlock["CODE"];
			$UrlDeleteSectionButton = CIBlock::ReplaceDetailURL($url_template, $arIBlock, true, false);
		}

		$arReturnUrl = array(
			"add_section" => (
				'' != $arParams["SECTION_URL"]?
				$arParams["SECTION_URL"]:
				CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")
			),
			"add_element" => (
				'' != $arParams["SECTION_URL"]?
				$arParams["SECTION_URL"]:
				CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")
			),
			"delete_section" => $UrlDeleteSectionButton,
		);
		$arButtons = CIBlock::GetPanelButtons(
			$arParams["IBLOCK_ID"],
			0,
			$arResult["SECTION"]["ID"],
			array("RETURN_URL" =>  $arReturnUrl, "CATALOG"=>true)
		);

		$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
	}
}
?>