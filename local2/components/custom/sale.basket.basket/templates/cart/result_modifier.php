<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*if (!empty($_REQUEST['tt'])) {
	print_r($arResult);
}*/
//получаем значение скидки в %
//if (!empty($_REQUEST['tt'])) {
CModule::IncludeModule('iblock');
foreach ($arResult["GRID"]["ROWS"] as &$arItem) {
	//получаем информацию о товаре
	$rEl = CIBlockElement::GetByID($arItem['PRODUCT_ID']);
	$arEl = $rEl->GetNext();
	//получаем скидку в %
	$rE = CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$arEl['IBLOCK_ID'], 'ID'=>$arEl['ID']), false, false, array('IBLOCK_ID', 'ID', 'PROPERTY_DISCOUNT_PERCENT'));
	$arE = $rE->GetNext();
	if (!empty($arE['PROPERTY_DISCOUNT_PERCENT_VALUE'])) { //есть скидка
		$percent = abs($arE['PROPERTY_DISCOUNT_PERCENT_VALUE']); //берём абсолютное значение
		if ($percent > 0) {
			$oldPrice = round($arItem['PRICE'] * 100 / (100 - $percent)); //считаем полную цену
			$economy = $oldPrice - $arItem['PRICE']; //считаем экономию
			//запомним значения для товара
			$arItem['OLD_PRICE_FORMATED'] = CurrencyFormat($oldPrice, $arItem['CURRENCY']);
			/*$arItem['DISCOUNT_ECONOMY'] = $economy;
			$arItem['DISCOUNT_PERCENT'] = $percent;*/
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
	}
}
unset($arItem);
//}
?>