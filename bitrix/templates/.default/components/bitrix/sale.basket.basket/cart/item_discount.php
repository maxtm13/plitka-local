<?define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);

use Bitrix\Main\Loader;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!check_bitrix_sessid() || $_SERVER["REQUEST_METHOD"] != "POST") return;

if (!Loader::includeModule('iblock')) return;

CUtil::JSPostUnescape();

$arRes = array();
//получаем информацию о товаре
$rEl = CIBlockElement::GetByID($_REQUEST['PRODUCT_ID']);
$arEl = $rEl->GetNext();
//получаем скидку в %
$rE = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arEl['IBLOCK_ID'], 'ID'=>$arEl['ID']), false, false, array('IBLOCK_ID', 'ID', 'PROPERTY_DISCOUNT_PERCENT'));
$arE = $rE->GetNext();
if (!empty($arE['PROPERTY_DISCOUNT_PERCENT_VALUE'])) { //есть скидка
	$percent = abs($arE['PROPERTY_DISCOUNT_PERCENT_VALUE']); //берём абсолютное значение
} else {
	$percent = 0;
}
$arRes['DISCOUNT_PERCENT'] = $percent;
if ($percent > 0) {
	$oldPrice = round($_REQUEST['PRICE'] * 100 / (100 - $percent)); //считаем полную цену
	$economy = $oldPrice - $arItem['PRICE']; //считаем экономию
	//запомним значения для товара
	$arItem['OLD_PRICE_FORMATED'] = CurrencyFormat($oldPrice, $_REQUEST['CURRENCY']);
	//подменяем поля с учётом нашей скидки
	if (floatval($arResult["DISCOUNT_PRICE_ALL"]) > 0) {
		$arResult["DISCOUNT_PRICE_ALL"] += $economy * $arItem['QUANTITY'];
	} else {
		$arResult["DISCOUNT_PRICE_ALL"] = $economy * $arItem['QUANTITY'];
	}
	$arResult["DISCOUNT_PRICE_ALL_FORMATED"] = CurrencyFormat($arResult["DISCOUNT_PRICE_ALL"], 'RUB');
	$withoutDiscount = $arResult['allSum'] + $arResult["DISCOUNT_PRICE_ALL"];
	$arResult['PRICE_WITHOUT_DISCOUNT'] = CurrencyFormat($withoutDiscount, 'RUB');
}		

header('Content-Type: application/json; charset='.LANG_CHARSET);
echo \Bitrix\Main\Web\Json::encode($arRes);
die();
?>
