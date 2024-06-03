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
		if ((($hour >= 20 && $minutes >= 45) || ($hour <= 8 && $minutes < 30)) && in_array($arParams['IBLOCK_ID'], array(CATALOG_ID, CATALOG_FLOOR_ID, CATALOG_SANTEH_ID))) {
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
	global $USER;
	if ($arParams['IBLOCK_ID'] == CATALOG_ID) {
		$arOther = array();
		$arTmp = array();
		$arTmpSort = array();
		foreach($arResult['ITEMS'] as $arItm) {
			if (!empty($arItm['PROPERTIES']['GROUP']['VALUE'])) {
				$arTmp[$arItm['PROPERTIES']['GROUP']['VALUE']][] = $arItm;
				if (!array_key_exists($arItm['PROPERTIES']['GROUP']['VALUE'], $arTmpSort)) {
					$arTmpSort[$arItm['PROPERTIES']['GROUP']['VALUE']] = $arItm['PROPERTIES']['GROUP']['VALUE_SORT'];
				}
			} else {
				$arOther[] = $arItm;
			}
		}
		if (count($arTmp)) { //есть группы товаров
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
				$grLinks[] = '<a href="'.$APPLICATION->GetCurUri().'#'.$grID.'">'.$grName.'</a>';
				foreach($arGrItems as $itm) {
					$itm['GROUP_INFO']['NAME'] = $grName;
					$itm['GROUP_INFO']['ID'] = $grID;
					$arResult['ITEMS'][] = $itm;
				}
			}
			$arResult['GROUP_LINKS'] = '<div class="groupLinks">'.implode('<br/>', $grLinks).'</div>';
		}
	}
	/*---end 2018-06-13---*/
	$arResult['SKU_PROPS'] = $arSKUPropList;
	$arResult['DEFAULT_PICTURE'] = $arEmptyPreview;
}

if(!empty($arResult['UF_MORO_PHOTO']) && is_array($arResult['UF_MORO_PHOTO'])){
	foreach($arResult['UF_MORO_PHOTO'] as &$photo){
		$photo = CFile::ResizeImageGet($photo, array('width' => 2500, 'height' => 2500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}
}
unset($photo);

/*добавляем страницу к заголовку браузера и в описание,
добавляем canonical*/
$getParamPagen = 0;
$getParamPagenName = '';
$resultPagenName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$pagenPrev = 0;
$pagenNext = 0;
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
	$http = $_SERVER['HTTP_X_FORWARDED_PROTO'];
} else {
	$http = !empty($_SERVER['HTTPS']) ? "https" : "http";
}
if ($arParams['IBLOCK_ID'] == CATALOG_ID && $arResult['ID'] == 32365) { //Все коллекции в Керама мараци
	$sec_page_url = str_replace('/'.$arResult['CODE'], '', $arResult['SECTION_PAGE_URL']);
	$canonical = $http.'://'.SITE_SERVER_NAME.$sec_page_url;
} else {
	$canonical = $http.'://'.SITE_SERVER_NAME.$APPLICATION->GetCurPage();
}
/*---bgn 2018-03-02---*/
if (IsModuleInstalled("sotbit.seometa") && CModule::IncludeModule('sotbit.seometa')) {
	//$curPage = urldecode($APPLICATION->GetCurPageParam('', array('clear_cache')));
	$context = Bitrix\Main\Context::getCurrent();
	$curPage = $context->getRequest()->getRequestUri();
	if ($curPage) {
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$curPageNew = Sotbit\Seometa\SeometaUrlTable::getByRealUrl($curPage);
		if (!empty($curPageNew['NEW_URL'])) {
			$curPageCanonical = $curPageNew['NEW_URL'];
			$canonical = $protocol.$_SERVER["SERVER_NAME"].$curPageCanonical;
			//подменим ссылки в пагинации
			if (!empty($arResult['NAV_STRING'])) {
				preg_match_all('/href="(.*)"/U', $arResult['NAV_STRING'], $matches, PREG_SET_ORDER);
				if (count($matches)) {
					/*if (substr_count($matches[$i][1], 'PAGEN_') > 0) {
						$tmp = explode('PAGEN_', $matches[$i][1]);
					} else if (substr_count($matches[$i][1], 'SHOWALL_') > 0) {
						$tmp = explode('SHOWALL_', $matches[$i][1]);
					}*/
					$tmp = '';
					foreach($matches as $key => $match) {
						$tmp = explode('&amp;', $match[1]);
						if (substr_count($tmp[count($tmp) - 1], 'PAGEN_') > 0 || substr_count($tmp[count($tmp) - 1], 'SHOWALL_') > 0) {
							unset($tmp[count($tmp) - 1]);
							$tmp = implode('&amp;', $tmp).'&amp;';
							break;
						}
					}
					if (substr_count($curPageCanonical, '?') == 0) {
						$arResult['NAV_STRING'] = str_replace($tmp, $curPageCanonical.'?', $arResult['NAV_STRING']);
					} else {
						$arResult['NAV_STRING'] = str_replace($tmp, $curPageCanonical.'&amp;', $arResult['NAV_STRING']);
					}
				}
			}
		}
	}
}
/*---end 2018-03-02---*/
//canonical
$nocanincal=array(
	'/collections/keramogranit?SHOWALL_1=1',
	'/collections/mozaika?SHOWALL_1=1',
	'/collections/?sec_id=0&set_filter=y&arrFilter_45_336913281=Y',
	'/collections/klinker?SHOWALL_1=1',
	'/napolnye-pokrytiya/laminat',
	'/napolnye-pokrytiya/laminat/classen',
	'/santekhnika/unitazy',
	'/santekhnika/vanny',
	'/napolnye-pokrytiya/massivnaya-doska',
	'/napolnye-pokrytiya/parketnaya-doska',
	'/santekhnika/kukhonnye-moyki',
	'/santekhnika/dushevye-kabiny',
	'/santekhnika/',
);
if (!in_array($_SERVER['REQUEST_URI'], $nocanincal)) {
$APPLICATION->AddHeadString('<link rel="canonical" href="'.strtolower($canonical).'" />', true);
}
foreach($_GET as $getParamKey=>$getParamVal) {
	if (substr_count($getParamKey, 'PAGEN_') != 0) {
		$getParamPagen = $getParamVal;
		$getParamPagenName = $getParamKey;
		$pagenPrev = $getParamVal - 1;
		$pagenNext = $getParamVal + 1;
	}
}
if ($getParamPagen > 1) {
	$pagen = 'Страница '.$getParamPagen.'. ';
	//заголовок браузера
	if (!empty($arResult[$arParams["BROWSER_TITLE"]])) {
		$arResult[$arParams["BROWSER_TITLE"]] = $pagen.$arResult[$arParams["BROWSER_TITLE"]];
	}
	if (!empty($arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"])) {
		$arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"] = $pagen.$arResult["IPROPERTY_VALUES"]["SECTION_META_TITLE"];
	}
	//описание
	if (!empty($arResult[$arParams["META_DESCRIPTION"]])) {
		$arResult[$arParams["META_DESCRIPTION"]] = $pagen.$arResult[$arParams["META_DESCRIPTION"]];
	}
	if (!empty($arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"])) {
		$arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"] = $pagen.$arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"];
	}
	if ($resultPagenName == $getParamPagenName) { //был переход по товарам
		if ($getParamPagen == 2) {
			$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'" />', true);
		} else {
			$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'?'.$getParamPagenName.'='.$pagenPrev.'" />', true);
		}
		if ($getParamPagen < $arResult['NAV_RESULT']->NavPageCount) { //если тек. страница меньше кол-ва страниц
			$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$getParamPagenName.'='.$pagenNext.'" />', true);
		}
	} else if (!empty($getParamPagenName) && $getParamPagenName == 'PAGEN_'.$arParams['PND_SEC_PAGEN']['NavNum']) { //был переход по разделам
		if ($getParamPagen == 2) {
			$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'" />', true);
		} else {
			$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'?'.$getParamPagenName.'='.$pagenPrev.'" />', true);
		}
		if ($getParamPagen < $arParams['PND_SEC_PAGEN']['NavPageCount']) { //если тек. страница меньше кол-ва страниц
			$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$getParamPagenName.'='.$pagenNext.'" />', true);
		}
	}
} else {
	if ($arResult['NAV_RESULT']->NavPageCount > 1) {
		$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$resultPagenName.'=2" />', true);
	} else if ($arParams['PND_SEC_PAGEN']['NavPageCount'] > 1) {
		$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?PAGEN_'.$arParams['PND_SEC_PAGEN']['NavNum'].'=2" />', true);
	}
}

if($arResult['UF_HEADER']){
	$APPLICATION->SetTitle($arResult['UF_HEADER']);
}
?>