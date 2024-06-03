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
	
	if (($arResult['SECTION']['DEPTH_LEVEL'] == '1' || (empty($arResult['SECTION']) && $arSection['DEPTH_LEVEL'] == 3)) && $arSection['RELATIVE_DEPTH_LEVEL'] == '0') {
		$rSec = CIBlockSection::GetByID($arSection['IBLOCK_SECTION_ID']);
		$arSec = $rSec->GetNext();
		$arSection['PARENT_SECTION_INFO'] = $arSec;
	}
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