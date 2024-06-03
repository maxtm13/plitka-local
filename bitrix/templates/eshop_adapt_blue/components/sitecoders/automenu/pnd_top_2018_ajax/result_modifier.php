<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//print_r($arResult);
//распределяем пункты по уровням с сохранением ключей
$arTmp = array();
$arTmpParent = array();
$parentLvl = 0;
foreach($arResult as $key => $arItem) {
    $arTmpItem['TEXT'] = $arItem['TEXT'];
    $arTmpItem['LINK'] = $arItem['LINK'];
    $arTmpItem['CLASS'] = !empty($arItem['PARAMS']['class']) ? $arItem['PARAMS']['class'] : '';
    if (substr_count($arTmpItem['CLASS'], 'empty') > 0) {
        $arTmpItem['TEXT'] = '&nbsp;';
        $arTmpItem['LINK'] = 'javascript:void(0)';
    }
    $arTmpItem['IS_PARENT'] = $arItem['IS_PARENT'];

    if ($arItem['DEPTH_LEVEL'] <= $parentLvl) {
        array_pop($arTmpParent);
        $parentLvl--;
    }

    if ($arItem['DEPTH_LEVEL'] == 1) {
        $arTmpItem['SELECTED'] = $arItem['SELECTED'];
        $arTmp['level'.$arItem['DEPTH_LEVEL']]['key'.$key] = $arTmpItem;
    } else {
        $parentKey = array_slice($arTmpParent, -1);
        $arTmp['level'.$arItem['DEPTH_LEVEL']]['key'.$parentKey[0]]['key'.$key] = $arTmpItem;
    }

    if ($arItem['IS_PARENT']) {
        $arTmpParent[] = $key;
        $parentLvl++;
    }
}
//3 уровень разбиваем на отдельные колонки если есть пункты сепараторы
$arTmp2 = array();
foreach ($arTmp['level3'] as $pKey => $arItemsList) {
    $col = 0;
    foreach ($arItemsList as $key => $arItem) {
        if (!empty($arItem['CLASS']) && $arItem['CLASS'] == 'separator') {
            $col++;
            continue;
        }
        $arTmp2[$pKey]['col'.$col][$key] = $arItem;
    }
}

if ($arParams['AJAX_MENU'] == 'Y') {
    if (empty($arParams['CUR_PAGE_URL'])) {
        $arTmp = array(
            'level3' => $arTmp2
        );
    } else {
        $arTmp = array();
        $arTmpL1 = array();
        foreach($arResult as $arItem) {
            if ($arItem['LINK'] == $arParams['CUR_PAGE_URL'] || substr_count($arParams['CUR_PAGE_URL'], $arItem['LINK']) > 0) {
                if ($arItem['DEPTH_LEVEL'] == 1) {
                    $arTmpL1[] = $arItem['LINK'];
                } else if (!in_array($arItem['LINK'], $arTmpL1)) { //исключаем ссылки "Все категории"
                    $arTmp[] = $arItem['LINK'];
                }
            }
        }
    }
    print json_encode($arTmp);
    die();
} else {
    $arTmp['level3'] = $arTmp2;
    $arResult = $arTmp;
}
?>