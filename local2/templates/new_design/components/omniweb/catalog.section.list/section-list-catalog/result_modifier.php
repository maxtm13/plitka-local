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
        $rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap), "ACTIVE" => "Y"), false, $arSelect);
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
    if(!empty($arSection['UF_82']) AND is_string($arSection['~UF_82'])) {
        $arSection['UF_82'] = unserialize($arSection['~UF_82']);
    }


    /*---bgn 2020-02-03---*/
    /*if(!empty($arSection['UF_91']))
        $arSection['UF_91'] = unserialize($arSection['~UF_91']);*/
    if(!empty($arSection['~UF_91']) AND is_string($arSection['~UF_92'])) {
        if (is_array($arSection['~UF_91'])) {
            $arSection['UF_91'] = omniGetPropertyValueByListID($arSection['~UF_91']);
        } else {
            $arSection['UF_91'] = unserialize($arSection['~UF_91']);
        }
    }
    /*---bgn 2020-02-03---*/


    if(!empty($arSection['UF_92']) AND is_string($arSection['~UF_92'])) {
        $arSection['UF_92'] = unserialize($arSection['~UF_92']);
    }

    if (($arResult['SECTION']['DEPTH_LEVEL'] == '1' || (empty($arResult['SECTION']) && $arSection['DEPTH_LEVEL'] == 3)) && $arSection['RELATIVE_DEPTH_LEVEL'] == '0') {
        $rSec = CIBlockSection::GetByID($arSection['IBLOCK_SECTION_ID']);
        $arSec = $rSec->GetNext();
        $arSection['PARENT_SECTION_INFO'] = $arSec;
        //	$arResult["SECTIONS_TITLE"][$arSec["ID"]] = $arSec["NAME"];
    }
}
unset($arSection);

if(!empty($arResult['SECTION']['PATH'])) {
    //устанавливаем в хлебных крошках для разделов название раздела
    foreach($arResult['SECTION']['PATH']  as &$arPathSection) {
        $arPathSection['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] = $arPathSection['NAME'];
    }
    unset($arPathSection);
}

?>