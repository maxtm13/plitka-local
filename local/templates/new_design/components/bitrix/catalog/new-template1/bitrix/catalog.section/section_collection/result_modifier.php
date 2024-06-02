<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
$arDefaultParams = array(
	'TEMPLATE_THEME' => 'blue',
	'PRODUCT_DISPLAY_MODE' => 'N',
	'ADD_PICT_PROP' => '-',
	'LABEL_PROP' => '-',
	'OFFER_ADD_PICT_PROP' => '-',
	'OFFER_TREE_PROPS' => array('-'),
	'PRODUCT_SUBSCRIPTION' => 'N',
	'SHOW_DISCOUNT_PERCENT' => 'N',
	'SHOW_OLD_PRICE' => 'N',
	'MESS_BTN_BUY' => '',
	'MESS_BTN_ADD_TO_BASKET' => '',
	'MESS_BTN_SUBSCRIBE' => '',
	'MESS_BTN_DETAIL' => '',
	'MESS_NOT_AVAILABLE' => ''
);
$arParams = array_merge($arDefaultParams, $arParams);

if (!isset($arParams['LINE_ELEMENT_COUNT']))
	$arParams['LINE_ELEMENT_COUNT'] = 3;
$arParams['LINE_ELEMENT_COUNT'] = intval($arParams['LINE_ELEMENT_COUNT']);
if (2 > $arParams['LINE_ELEMENT_COUNT'] || 5 < $arParams['LINE_ELEMENT_COUNT'])
	$arParams['LINE_ELEMENT_COUNT'] = 3;

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME'])
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ('site' == $arParams['TEMPLATE_THEME'])
	{
		$arParams['TEMPLATE_THEME'] = COption::GetOptionString('main', 'wizard_eshop_adapt_theme_id', 'blue', SITE_ID);
	}
	if ('' != $arParams['TEMPLATE_THEME'])
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}
if ('' == $arParams['TEMPLATE_THEME'])
	$arParams['TEMPLATE_THEME'] = 'blue';

if ('Y' != $arParams['PRODUCT_DISPLAY_MODE'])
	$arParams['PRODUCT_DISPLAY_MODE'] = 'N';

$arParams['ADD_PICT_PROP'] = trim($arParams['ADD_PICT_PROP']);
if ('-' == $arParams['ADD_PICT_PROP'])
	$arParams['ADD_PICT_PROP'] = '';
$arParams['LABEL_PROP'] = trim($arParams['LABEL_PROP']);
if ('-' == $arParams['LABEL_PROP'])
	$arParams['LABEL_PROP'] = '';
$arParams['OFFER_ADD_PICT_PROP'] = trim($arParams['OFFER_ADD_PICT_PROP']);
if ('-' == $arParams['OFFER_ADD_PICT_PROP'])
	$arParams['OFFER_ADD_PICT_PROP'] = '';
if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
{
	if (!is_array($arParams['OFFER_TREE_PROPS']))
		$arParams['OFFER_TREE_PROPS'] = array($arParams['OFFER_TREE_PROPS']);
	foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
	{
		$value = (string)$value;
		if ('' == $value || '-' == $value)
			unset($arParams['OFFER_TREE_PROPS'][$key]);
	}
	if (empty($arParams['OFFER_TREE_PROPS']) && isset($arParams['OFFERS_CART_PROPERTIES']) && is_array($arParams['OFFERS_CART_PROPERTIES']))
	{
		$arParams['OFFER_TREE_PROPS'] = $arParams['OFFERS_CART_PROPERTIES'];
		foreach ($arParams['OFFER_TREE_PROPS'] as $key => $value)
		{
			$value = (string)$value;
			if ('' == $value || '-' == $value)
				unset($arParams['OFFER_TREE_PROPS'][$key]);
		}
	}
}
else
{
	$arParams['OFFER_TREE_PROPS'] = array();
}
if ('Y' != $arParams['PRODUCT_SUBSCRIPTION'])
	$arParams['PRODUCT_SUBSCRIPTION'] = 'N';
if ('Y' != $arParams['SHOW_DISCOUNT_PERCENT'])
	$arParams['SHOW_DISCOUNT_PERCENT'] = 'N';
if ('Y' != $arParams['SHOW_OLD_PRICE'])
	$arParams['SHOW_OLD_PRICE'] = 'N';

$arParams['MESS_BTN_BUY'] = trim($arParams['MESS_BTN_BUY']);
$arParams['MESS_BTN_ADD_TO_BASKET'] = trim($arParams['MESS_BTN_ADD_TO_BASKET']);
$arParams['MESS_BTN_SUBSCRIBE'] = trim($arParams['MESS_BTN_SUBSCRIBE']);
$arParams['MESS_BTN_DETAIL'] = trim($arParams['MESS_BTN_DETAIL']);
$arParams['MESS_NOT_AVAILABLE'] = trim($arParams['MESS_NOT_AVAILABLE']);

if (!empty($arResult['ITEMS']))
{
	$arEmptyPreview = false;
	$strEmptyPreview = $this->GetFolder().'/images/no_photo.png';
	if (file_exists($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview))
	{
		$arSizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$strEmptyPreview);
		if (!empty($arSizes))
		{
			$arEmptyPreview = array(
				'SRC' => $strEmptyPreview,
				'WIDTH' => intval($arSizes[0]),
				'HEIGHT' => intval($arSizes[1])
			);
		}
		unset($arSizes);
	}
	unset($strEmptyPreview);

	$arSKUPropList = array();
	$arSKUPropIDs = array();
	$arSKUPropKeys = array();
	$boolSKU = false;
	$strBaseCurrency = '';
	$boolConvert = isset($arResult['CONVERT_CURRENCY']['CURRENCY_ID']);

	if ($arResult['MODULES']['catalog'])
	{
		if (!$boolConvert)
			$strBaseCurrency = CCurrency::GetBaseCurrency();

		$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
		$boolSKU = !empty($arSKU) && is_array($arSKU);
		if ($boolSKU && !empty($arParams['OFFER_TREE_PROPS']) && 'Y' == $arParams['PRODUCT_DISPLAY_MODE'])
		{
			$arSKUPropList = CIBlockPriceTools::getTreeProperties(
				$arSKU,
				$arParams['OFFER_TREE_PROPS'],
				array(
					'PICT' => $arEmptyPreview,
					'NAME' => '-'
				)
			);

			$arNeedValues = array();
			CIBlockPriceTools::getTreePropertyValues($arSKUPropList, $arNeedValues);
			$arSKUPropIDs = array_keys($arSKUPropList);
			if (empty($arSKUPropIDs))
				$arParams['PRODUCT_DISPLAY_MODE'] = 'N';
			else
				$arSKUPropKeys = array_fill_keys($arSKUPropIDs, false);
		}
	}

	$arNewItemsList = array();
	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		$arItem['CHECK_QUANTITY'] = false;
		if (!isset($arItem['CATALOG_MEASURE_RATIO']))
			$arItem['CATALOG_MEASURE_RATIO'] = 1;
		if (!isset($arItem['CATALOG_QUANTITY']))
			$arItem['CATALOG_QUANTITY'] = 0;
		$arItem['CATALOG_QUANTITY'] = (
			0 < $arItem['CATALOG_QUANTITY'] && is_float($arItem['CATALOG_MEASURE_RATIO'])
			? floatval($arItem['CATALOG_QUANTITY'])
			: intval($arItem['CATALOG_QUANTITY'])
		);
		$arItem['CATALOG'] = false;
		if (!isset($arItem['CATALOG_SUBSCRIPTION']) || 'Y' != $arItem['CATALOG_SUBSCRIPTION'])
			$arItem['CATALOG_SUBSCRIPTION'] = 'N';

		CIBlockPriceTools::getLabel($arItem, $arParams['LABEL_PROP']);

		$productPictures = CIBlockPriceTools::getDoublePicturesForItem($arItem, $arParams['ADD_PICT_PROP']);
		if (empty($productPictures['PICT']))
			$productPictures['PICT'] = $arEmptyPreview;
		if (empty($productPictures['SECOND_PICT']))
			$productPictures['SECOND_PICT'] = $productPictures['PICT'];

		$arItem['PREVIEW_PICTURE'] = $productPictures['PICT'];
		$arItem['PREVIEW_PICTURE_SECOND'] = $productPictures['SECOND_PICT'];
		$arItem['SECOND_PICT'] = true;
		$arItem['PRODUCT_PREVIEW'] = $productPictures['PICT'];
		$arItem['PRODUCT_PREVIEW_SECOND'] = $productPictures['SECOND_PICT'];

		if ($arResult['MODULES']['catalog'])
		{
			$arItem['CATALOG'] = true;
			if (!isset($arItem['CATALOG_TYPE']))
				$arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_PRODUCT;
			if (
				(CCatalogProduct::TYPE_PRODUCT == $arItem['CATALOG_TYPE'] || CCatalogProduct::TYPE_SKU == $arItem['CATALOG_TYPE'])
				&& !empty($arItem['OFFERS'])
			)
			{
				$arItem['CATALOG_TYPE'] = CCatalogProduct::TYPE_SKU;
			}
			switch ($arItem['CATALOG_TYPE'])
			{
				case CCatalogProduct::TYPE_SET:
					$arItem['OFFERS'] = array();
					$arItem['CATALOG_MEASURE_RATIO'] = 1;
					$arItem['CATALOG_QUANTITY'] = 0;
					$arItem['CHECK_QUANTITY'] = false;
					break;
				case CCatalogProduct::TYPE_SKU:
					break;
				case CCatalogProduct::TYPE_PRODUCT:
				default:
					$arItem['CHECK_QUANTITY'] = ('Y' == $arItem['CATALOG_QUANTITY_TRACE'] && 'N' == $arItem['CATALOG_CAN_BUY_ZERO']);
					break;
			}
		}
		else
		{
			$arItem['CATALOG_TYPE'] = 0;
			$arItem['OFFERS'] = array();
		}

		if ($arItem['CATALOG'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
		{
			if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
			{
				$arMatrixFields = $arSKUPropKeys;
				$arMatrix = array();

				$arNewOffers = array();
				$boolSKUDisplayProperties = false;
				$arItem['OFFERS_PROP'] = false;

				$arDouble = array();
				foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
				{
					$arOffer['ID'] = intval($arOffer['ID']);
					if (isset($arDouble[$arOffer['ID']]))
						continue;
					$arRow = array();
					foreach ($arSKUPropIDs as $propkey => $strOneCode)
					{
						$arCell = array(
							'VALUE' => 0,
							'SORT' => PHP_INT_MAX,
							'NA' => true
						);
						if (isset($arOffer['DISPLAY_PROPERTIES'][$strOneCode]))
						{
							$arMatrixFields[$strOneCode] = true;
							$arCell['NA'] = false;
							if ('directory' == $arSKUPropList[$strOneCode]['USER_TYPE'])
							{
								$intValue = $arSKUPropList[$strOneCode]['XML_MAP'][$arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']];
								$arCell['VALUE'] = $intValue;
							}
							elseif ('L' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
							{
								$arCell['VALUE'] = intval($arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE_ENUM_ID']);
							}
							elseif ('E' == $arSKUPropList[$strOneCode]['PROPERTY_TYPE'])
							{
								$arCell['VALUE'] = intval($arOffer['DISPLAY_PROPERTIES'][$strOneCode]['VALUE']);
							}
							$arCell['SORT'] = $arSKUPropList[$strOneCode]['VALUES'][$arCell['VALUE']]['SORT'];
						}
						$arRow[$strOneCode] = $arCell;
					}
					$arMatrix[$keyOffer] = $arRow;

					CIBlockPriceTools::clearProperties($arOffer['DISPLAY_PROPERTIES'], $arParams['OFFER_TREE_PROPS']);

					CIBlockPriceTools::setRatioMinPrice($arOffer);

					$offerPictures = CIBlockPriceTools::getDoublePicturesForItem($arOffer, $arParams['OFFER_ADD_PICT_PROP']);
					$arOffer['OWNER_PICT'] = empty($offerPictures['PICT']);
					$arOffer['PREVIEW_PICTURE'] = false;
					$arOffer['PREVIEW_PICTURE_SECOND'] = false;
					$arOffer['SECOND_PICT'] = true;
					if (!$arOffer['OWNER_PICT'])
					{
						if (empty($offerPictures['SECOND_PICT']))
							$offerPictures['SECOND_PICT'] = $offerPictures['PICT'];
						$arOffer['PREVIEW_PICTURE'] = $offerPictures['PICT'];
						$arOffer['PREVIEW_PICTURE_SECOND'] = $offerPictures['SECOND_PICT'];
					}
					if ('' != $arParams['OFFER_ADD_PICT_PROP'] && isset($arOffer['DISPLAY_PROPERTIES'][$arParams['OFFER_ADD_PICT_PROP']]))
						unset($arOffer['DISPLAY_PROPERTIES'][$arParams['OFFER_ADD_PICT_PROP']]);

					$arDouble[$arOffer['ID']] = true;
					$arNewOffers[$keyOffer] = $arOffer;
				}
				$arItem['OFFERS'] = $arNewOffers;

				$arUsedFields = array();
				$arSortFields = array();

				foreach ($arSKUPropIDs as $propkey => $strOneCode)
				{
					$boolExist = $arMatrixFields[$strOneCode];
					foreach ($arMatrix as $keyOffer => $arRow)
					{
						if ($boolExist)
						{
							if (!isset($arItem['OFFERS'][$keyOffer]['TREE']))
								$arItem['OFFERS'][$keyOffer]['TREE'] = array();
							$arItem['OFFERS'][$keyOffer]['TREE']['PROP_'.$arSKUPropList[$strOneCode]['ID']] = $arMatrix[$keyOffer][$strOneCode]['VALUE'];
							$arItem['OFFERS'][$keyOffer]['SKU_SORT_'.$strOneCode] = $arMatrix[$keyOffer][$strOneCode]['SORT'];
							$arUsedFields[$strOneCode] = true;
							$arSortFields['SKU_SORT_'.$strOneCode] = SORT_NUMERIC;
						}
						else
						{
							unset($arMatrix[$keyOffer][$strOneCode]);
						}
					}
				}
				$arItem['OFFERS_PROP'] = $arUsedFields;
				$arItem['OFFERS_PROP_CODES'] = (!empty($arUsedFields) ? base64_encode(serialize(array_keys($arUsedFields))) : '');

				\Bitrix\Main\Type\Collection::sortByColumn($arItem['OFFERS'], $arSortFields);

				$arMatrix = array();
				$intSelected = -1;
				$arItem['MIN_PRICE'] = false;
				foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
				{
					if (empty($arItem['MIN_PRICE']) && $arOffer['CAN_BUY'])
					{
						$intSelected = $keyOffer;
						$arItem['MIN_PRICE'] = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
					}
					$arSKUProps = false;
					if (!empty($arOffer['DISPLAY_PROPERTIES']))
					{
						$boolSKUDisplayProperties = true;
						$arSKUProps = array();
						foreach ($arOffer['DISPLAY_PROPERTIES'] as &$arOneProp)
						{
							if ('F' == $arOneProp['PROPERTY_TYPE'])
								continue;
							$arSKUProps[] = array(
								'NAME' => $arOneProp['NAME'],
								'VALUE' => $arOneProp['DISPLAY_VALUE']
							);
						}
						unset($arOneProp);
					}

					$arOneRow = array(
						'ID' => $arOffer['ID'],
						'NAME' => $arOffer['~NAME'],
						'TREE' => $arOffer['TREE'],
						'DISPLAY_PROPERTIES' => $arSKUProps,
						'PRICE' => (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']),
						'SECOND_PICT' => $arOffer['SECOND_PICT'],
						'OWNER_PICT' => $arOffer['OWNER_PICT'],
						'PREVIEW_PICTURE' => $arOffer['PREVIEW_PICTURE'],
						'PREVIEW_PICTURE_SECOND' => $arOffer['PREVIEW_PICTURE_SECOND'],
						'CHECK_QUANTITY' => $arOffer['CHECK_QUANTITY'],
						'MAX_QUANTITY' => $arOffer['CATALOG_QUANTITY'],
						'STEP_QUANTITY' => $arOffer['CATALOG_MEASURE_RATIO'],
						'QUANTITY_FLOAT' => is_double($arOffer['CATALOG_MEASURE_RATIO']),
						'MEASURE' => $arOffer['~CATALOG_MEASURE_NAME'],
						'CAN_BUY' => $arOffer['CAN_BUY'],
						'BUY_URL' => $arOffer['~BUY_URL'],
						'ADD_URL' => $arOffer['~ADD_URL'],
					);
					$arMatrix[$keyOffer] = $arOneRow;
				}
				if (-1 == $intSelected)
					$intSelected = 0;
				if (!$arMatrix[$intSelected]['OWNER_PICT'])
				{
					$arItem['PREVIEW_PICTURE'] = $arMatrix[$intSelected]['PREVIEW_PICTURE'];
					$arItem['PREVIEW_PICTURE_SECOND'] = $arMatrix[$intSelected]['PREVIEW_PICTURE_SECOND'];
				}
				$arItem['JS_OFFERS'] = $arMatrix;
				$arItem['OFFERS_SELECTED'] = $intSelected;
				$arItem['OFFERS_PROPS_DISPLAY'] = $boolSKUDisplayProperties;
			}
			else
			{
				$arItem['MIN_PRICE'] = CIBlockPriceTools::getMinPriceFromOffers(
					$arItem['OFFERS'],
					$boolConvert ? $arResult['CONVERT_CURRENCY']['CURRENCY_ID'] : $strBaseCurrency
				);
			}
		}

		if ($arResult['MODULES']['catalog'] && $arItem['CATALOG'] && CCatalogProduct::TYPE_PRODUCT == $arItem['CATALOG_TYPE'])
		{
			CIBlockPriceTools::setRatioMinPrice($arItem, true);
		}

		if (!empty($arItem['DISPLAY_PROPERTIES']))
		{
			foreach ($arItem['DISPLAY_PROPERTIES'] as $propKey => $arDispProp)
			{
				if ('F' == $arDispProp['PROPERTY_TYPE'])
					unset($arItem['DISPLAY_PROPERTIES'][$propKey]);
			}
		}
		$arItem['LAST_ELEMENT'] = 'N';
		/*---bgn 2017-06-02---*/
		$now = time();
		$week_day = date('N', $now);
		$hour = intval(date('H', $now));
		$minutes = intval(date('i', $now));
		// Выключаем выходные дни "ночные цены"
		/*if (in_array($week_day, array(6,7)) || (!in_array($week_day, array(6,7)) && (($hour >= 20 && $minutes >= 45) || ($hour <= 8 && $minutes < 30)))) {*/
		if (($hour == 20 && $minutes >= 30 || $hour > 20 || $hour == 8 && $minutes <= 30 || $hour < 8) && in_array($arParams['IBLOCK_ID'], array(CATALOG_ID, CATALOG_FLOOR_ID, CATALOG_SANTEH_ID))) {
			if (!empty($arItem['DISPLAY_PROPERTIES']['NIGHT_PRICE']['DISPLAY_VALUE']) == 1) {
				// Получим список валют с курсом
				$lcur = CCurrency::GetList(($by="name"), ($order1="asc"), LANGUAGE_ID);
				$arCurrency = array();
				while($lcur_res = $lcur->Fetch())
				{
					if(!empty($lcur_res['BASE']) && $lcur_res['BASE'] == 'Y') continue;

					$arCurrency[$lcur_res['CURRENCY']] = $lcur_res['AMOUNT'];
				}
				if (empty($arCurrency['RUB'])) {
					$arCurrency['RUB'] = 1;
				}
				if(!empty($arItem['PROPERTIES']['MARGIN']['VALUE'])){
					$arItem['PROPERTIES']['MARGIN']['VALUE'] = (float)str_replace(',', '.', $arItem['PROPERTIES']['MARGIN']['VALUE']);
					$margin = 1 + $arItem['PROPERTIES']['MARGIN']['VALUE']/100;
				} else {
					$margin = 1;
				}
				$nightPrice = round($arItem['CATALOG_PURCHASING_PRICE'] * $margin * $arCurrency[$arItem['CATALOG_PURCHASING_CURRENCY']]);
				$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] = CurrencyFormat($nightPrice, $arItem['MIN_PRICE']['CURRENCY']);
			}
		}
		/*---end 2017-06-02---*/
		$arNewItemsList[$key] = $arItem;
	}
	$arNewItemsList[$key]['LAST_ELEMENT'] = 'Y';
	$arResult['ITEMS'] = $arNewItemsList;
	/*---bgn 2018-06-13---*/
	//группируем товары
	if ($arParams['IBLOCK_ID'] == CATALOG_ID) {
		$arOther = array();
		$arTmp = array();
		$arTmpSort = array();
		$arResult['GROUP_LINKS'] = [];
		foreach($arResult['ITEMS'] as $arItm) {
			if (!empty($arItm['PROPERTIES']['GROUP']['VALUE'])) {
				$arTmp[$arItm['PROPERTIES']['GROUP']['VALUE']][] = $arItm;
				if (!array_key_exists($arItm['PROPERTIES']['GROUP']['VALUE'], $arTmpSort)) {
					$arTmpSort[$arItm['PROPERTIES']['GROUP']['VALUE']] = $arItm['PROPERTIES']['GROUP']['VALUE_SORT'];
				}
			} else {
				$arOther[] = $arItm;
			}


			if($arItm["PROPERTIES"]["DISCOUNT"]["VALUE"] == 2){
				$arResult["USE_DELIVERY"] = "Y";
			}
			if($arItm["PROPERTIES"]["DISCOUNT"]["VALUE"] == 4){
				$arResult["USE_DELIVERY_V2"] = "Y";
			}
		}
		if (count($arTmp) || count($arOther)) { //есть группы товаров
			if (count($arOther)) {
				$arTmp['OTHER'] = $arOther;
				$arTmpSort['OTHER'] = 1000000;
			}
			asort($arTmpSort);
			$grLinks = array();
			$arResult['GROUP_ITEMS'] = 'Y';
			$arResult['ITEMS'] = array();
			foreach($arTmpSort as $grName => $val) {
				$arGrItems = $arTmp[$grName];
				$grID = ($grName == 'OTHER') ? 'gr00' : 'gr'.$arGrItems[0]['PROPERTIES']['GROUP']['VALUE_ENUM_ID'];
				$grLinks[] = ["id"=>$grID, "name"=>$grName];
				foreach($arGrItems as $itm) {
					$itm['GROUP_INFO']['NAME'] = $grName;
					$itm['GROUP_INFO']['ID'] = $grID;
					$arResult['ITEMS'][] = $itm;
				}
			}
			if($grLinks) {
				$arResult['GROUP_LINKS'] = $grLinks;
			}
		}
	}
	/*---end 2018-06-13---*/
	$arResult['SKU_PROPS'] = $arSKUPropList;
	$arResult['DEFAULT_PICTURE'] = $arEmptyPreview;
}

$src = '';
if (!empty($arResult['DETAIL_PICTURE']['SRC'])) {
	$src = $arResult['DETAIL_PICTURE'];
} else if (!empty($arResult['PICTURE']['SRC'])) {
	$src = $arResult['PICTURE'];
}

$arResult["IMG_SLIDER"] = [];
$arResult["IMG_SLIDER_MIN"] = [];
if(!empty($src)) {
	$img = CFile::ResizeImageGet($src, array('width' => 1500, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$img2 = CFile::ResizeImageGet($src, array('width' => 688, 'height' => 516), BX_RESIZE_IMAGE_EXACT, true);
	$arResult["IMG_SLIDER"][] = ['ORIGIN' => $img["src"], 'MIN' => $img2["src"], 'SIZES' => $img];
	$img = CFile::ResizeImageGet($src, array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_EXACT, true);
	$arResult["IMG_SLIDER_MIN"][0] = $img["src"];
}

if(!empty($arResult['UF_MORO_PHOTO']) && is_array($arResult['UF_MORO_PHOTO'])){
	foreach($arResult['UF_MORO_PHOTO'] as &$photo){
		$img = CFile::ResizeImageGet($photo, array('width' => 1500, 'height' => 1500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$img2 = CFile::ResizeImageGet($photo, array('width' => 688, 'height' => 516), BX_RESIZE_IMAGE_EXACT, true);
		$img_min = CFile::ResizeImageGet($photo, array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_EXACT, true);

		$arResult["IMG_SLIDER"][] = ['ORIGIN' => $img["src"], 'MIN' => $img2["src"], 'SIZES' => $img];
		$arResult["IMG_SLIDER_MIN"][] = $img_min["src"];
	}
}
unset($photo);

if($arResult['UF_HEADER']){
	$APPLICATION->SetTitle($arResult['UF_HEADER']);
}
/*
if ($arParams['INCLUDE_SUBSECTIONS'] == 'Y') {
    //получим правильные адреса для товаров напольных покрытий и сантехники, т.к. по умолчанию адрес строится относительно текущего раздела
    foreach ($arResult['ITEMS'] as &$arItem) {
        $rEl = CIBlockElement::GetByID($arItem['ID']);
        $arEl = $rEl->GetNext();
        $arItem['DETAIL_PAGE_URL'] = $arEl['DETAIL_PAGE_URL'];
    }
    unset($arItem);
}
*/
if (in_array($arParams['IBLOCK_ID'], array(CATALOG_FLOOR_ID, CATALOG_SANTEH_ID))) {
    //устанавливаем в хлебных крошках для разделов название раздела
    foreach($arResult['PATH'] as &$arPathSection) {
        $arPathSection['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] = $arPathSection['NAME'];
    }
    unset($arPathSection);
}

$navChain = CIBlockSection::GetNavChain(
	$arResult["IBLOCK_ID"],
	$arResult["ID"],
	['NAME', 'IBLOCK_SECTION_ID', 'CODE', 'ID', 'SECTION_PAGE_URL']
);
$arResult["PARENT_SECTION"] = [];
$arParent = [];
while ($arNav=$navChain->GetNext()) {
	$arParent[] = $arNav;
}
if(count($arParent) > 1) {
	$arResult["PARENT_SECTION"] = $arParent[count($arParent) - 2];
}

$arFilterArticle = [];
$dbItems = CIBlockElement::GetList(
	[],
	[
		'IBLOCK_ID' => $arResult["IBLOCK_ID"],
		'ACTIVE' => 'Y',
		'SECTION_ID' => $arResult["ID"],
		'!PROPERTY_AVAILABILITY' => 4914
	],
	[
		'PROPERTY_USE',
		'PROPERTY_SIZE_WIDTH',
		'PROPERTY_SIZE_LENGTH',
		'PROPERTY_COLOR',
		'PROPERTY_RISUNOK',
		'PROPERTY_SURFACE',
		'PROPERTY_PROP_STYLE'
	]
);

$arResult['PROPERTY_USE'] = [];
$arResult['PROPERTY_SIZE'];
$arResult['PROPERTY_COLOR'] = [];
$arResult['PROPERTY_RISUNOK'] = [];
$arResult['PROPERTY_SURFACE'] = [];
$arResult['PROPERTY_PROP_STYLE'] = [];

while($ar_Item = $dbItems->GetNext(true, false)) {

	if($ar_Item["PROPERTY_USE_VALUE"] && !in_array($ar_Item["PROPERTY_USE_VALUE"], $arResult['PROPERTY_USE'])) {
		$arResult['PROPERTY_USE'][] = $ar_Item["PROPERTY_USE_VALUE"];
	}
	if($ar_Item["PROPERTY_COLOR_VALUE"] && !in_array($ar_Item["PROPERTY_COLOR_VALUE"], $arResult['PROPERTY_COLOR'])) {
		$arResult['PROPERTY_COLOR'][] = $ar_Item["PROPERTY_COLOR_VALUE"];
	}
	if($ar_Item["PROPERTY_RISUNOK_VALUE"] && !in_array($ar_Item["PROPERTY_RISUNOK_VALUE"], $arResult['PROPERTY_RISUNOK'])) {
		$arResult['PROPERTY_RISUNOK'][] = $ar_Item["PROPERTY_RISUNOK_VALUE"];
	}
	if($ar_Item["PROPERTY_SURFACE_VALUE"] && !in_array($ar_Item["PROPERTY_SURFACE_VALUE"], $arResult['PROPERTY_SURFACE'])) {
		$arResult['PROPERTY_SURFACE'][] = $ar_Item["PROPERTY_SURFACE_VALUE"];
	}
	if($ar_Item["PROPERTY_PROP_STYLE_VALUE"] && !in_array($ar_Item["PROPERTY_PROP_STYLE_VALUE"], $arResult['PROPERTY_PROP_STYLE'])) {
		$arResult['PROPERTY_PROP_STYLE'][] = $ar_Item["PROPERTY_PROP_STYLE_VALUE"];
	}
	if($ar_Item["PROPERTY_SIZE_WIDTH_VALUE"] || $ar_Item["PROPERTY_SIZE_LENGTH_VALUE"]) {
		$size = $ar_Item["PROPERTY_SIZE_WIDTH_VALUE"]."x".$ar_Item["PROPERTY_SIZE_LENGTH_VALUE"];
		if(is_array($arResult['PROPERTY_SIZE']) && !in_array($size, $arResult['PROPERTY_SIZE'])) {
			$arResult['PROPERTY_SIZE'][] = $size;
		}
	}
}

sort($arResult['PROPERTY_USE']);
if(is_array($arResult['PROPERTY_SIZE'])) { sort($arResult['PROPERTY_SIZE']); }
sort($arResult['PROPERTY_COLOR']);
sort($arResult['PROPERTY_RISUNOK']);
sort($arResult['PROPERTY_SURFACE']);
sort($arResult['PROPERTY_PROP_STYLE']);

?>