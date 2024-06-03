<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}
	if ($boolPicture || $boolDescr)
	{
		foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arMap[$arSection['ID']] = $key;
		}
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
}

// Множественные свойства хранятся как сериализованный массив, получаем исходный массив значений свойства
foreach ($arResult['SECTIONS'] as $key => &$arSection){
	if(!empty($arSection['UF_82']))
		$arSection['UF_82'] = unserialize($arSection['~UF_82']);
		
	if(!empty($arSection['UF_91']))
		$arSection['UF_91'] = unserialize($arSection['~UF_91']);

	if(!empty($arSection['UF_92']))
		$arSection['UF_92'] = unserialize($arSection['~UF_92']);		
}
unset($arSection);

/*добавляем страницу к заголовку браузера и в описание,
добавляем canonical*/
$getParamPagen = 0;
$resultPagenName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
$pagenPrev = 0;
$pagenNext = 0;
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
	$http = $_SERVER['HTTP_X_FORWARDED_PROTO'];
} else {
	$http = !empty($_SERVER['HTTPS']) ? "https" : "http";
}
if ($arParams['IBLOCK_ID'] == CATALOG_ID && $arResult['SECTION']['ID'] == 32365) { //Все коллекции в Керама мараци
	$sec_page_url = str_replace('/'.$arResult['SECTION']['CODE'], '', $arResult['SECTION']['SECTION_PAGE_URL']);
	$canonical = $http.'://'.SITE_SERVER_NAME.$sec_page_url;
} else {
	$canonical = $http.'://'.SITE_SERVER_NAME.$APPLICATION->GetCurPage();
}
//canonical
$APPLICATION->AddHeadString('<link rel="canonical" href="'.$canonical.'" />', true);
if (!empty($_GET[$resultPagenName])) {
	$getParamPagen = $arResult['NAV_RESULT']->NavPageNomer;
	$pagenPrev = $arResult['NAV_RESULT']->NavPageNomer - 1;
	$pagenNext = $arResult['NAV_RESULT']->NavPageNomer + 1;
}
if ($getParamPagen > 1) {
	$pagen = 'Страница '.$getParamPagen.'. ';
	//заголовок браузера
	$page_prop = $pagen.$APPLICATION->GetProperty('title');
	$APPLICATION->SetPageProperty('title', $page_prop);
	//описание
	$page_prop = $pagen.$APPLICATION->GetProperty('description');
	$APPLICATION->SetPageProperty('description', $page_prop);
	if ($getParamPagen == 2) {
		$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'" />', true);
	} else {
		$APPLICATION->AddHeadString('<link rel="prev" href="'.$canonical.'?'.$resultPagenName.'='.$pagenPrev.'" />', true);
	}
	if ($getParamPagen < $arResult['NAV_RESULT']->NavPageCount) { //если тек. страница меньше кол-ва страниц
		$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$resultPagenName.'='.$pagenNext.'" />', true);
	}
} else {
	if ($arResult['NAV_RESULT']->NavPageCount > 1) {
		$APPLICATION->AddHeadString('<link rel="next" href="'.$canonical.'?'.$resultPagenName.'=2" />', true);
	}
}
?>