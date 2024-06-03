<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$resultPagenName = 'PAGEN_'.$arResult['NAV_RESULT']->NavNum;
if (!empty($_GET[$resultPagenName])) {
    $getParamPagen = $arResult['NAV_RESULT']->NavPageNomer;
    if ($getParamPagen > 1) {
        $pagen = 'Страница ' . $getParamPagen . '. ';
        //заголовок браузера
        $page_prop = $pagen . $APPLICATION->GetProperty('title');
        $APPLICATION->SetPageProperty('title', $page_prop);
        //описание
        $page_prop = $pagen . $APPLICATION->GetProperty('description');
        $APPLICATION->SetPageProperty('description', $page_prop);

    }
}