<?
use \Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();

// Подключаем файл с описанием функций
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/dev.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/defines.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/handlers.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/agents.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/functions.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/work_with_prices_agent.php");
// Заголовок Last-Modified
/* include(__DIR__.'/include/last_modified.php'); удалён */

// redirects
include($_SERVER["DOCUMENT_ROOT"].'/.utlab/redirects.php');


//Проверка коллекции на доступность: если нет товаров - фильтр не допускает к показу
include($_SERVER["DOCUMENT_ROOT"].'/include/rbs_filter_availability.php');

if ($request->isAdminSection() == false) {
// remove double slashes	
	rds($_SERVER["REQUEST_URI"]);
}

// Товары, исключаемые из вывода в распродаже (массив ID)
global $arProductsExclude;
$arProductsExclude = array(191023, 210039, 456314, 456315, 293803, 456313, 454011, 454012, 456312, 191024, 402017, 293804, 444252);

/*если не установлен пар-р навигации, то для 3-х пагинаций устанавливаем его в 1,
это нужно для работы пагинации компонентов,
т.к. для первой страницы пар-р PAGEN убран в шаблоне навигации*/
/*
for($i = 1; $i <= 3; $i++) {
	if (empty($_REQUEST['PAGEN_'.$i])) {
		$GLOBALS['PAGEN_'.$i] = 1;
	}
}
*/

$aR301SkipCheck = [
    '/index/' => '/',
];

if (isset($aR301SkipCheck[$_SERVER['REQUEST_URI']])) {
    if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
        header('Location: ' . $aR301SkipCheck[$_SERVER['REQUEST_URI']], true, 301);
        exit;
    }
}

