<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$APPLICATION->IncludeComponent("sitecoders:automenu", "pnd_top_2018_ajax", Array(
    "ROOT_MENU_TYPE" => "catalog",	// Тип меню для первого уровня
    "MENU_CACHE_TYPE" => "A",	// Тип кеширования
    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
    "MAX_LEVEL" => "2",	// Уровень вложенности меню
    "CHILD_MENU_TYPE" => "left_new",	// Тип меню для остальных уровней
    "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
    "DELAY" => "N",	// Откладывать выполнение шаблона меню
    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
    //"curPageURL" => $_REQUEST['curPageURL'] //пар-р для задания класса активным пунктам, в стандартном варианте выбор активных пунктов не работает (возможно из-за подгрузки аяксом)
    'AJAX_MENU' => !empty($_REQUEST['ajax_menu']) ? 'Y' : '',
    'CUR_PAGE_URL' => !empty($_REQUEST['curPageURL']) ? $_REQUEST['curPageURL'] : ''
),
    false
);?>
