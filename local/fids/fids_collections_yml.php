<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? header("Content-Type: text/xml;");?>
<? echo "<"."?xml version=\"1.0\"?".">"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="<?=date("Y-m-d H:i");?>">
<shop>
<name>Интернет-магазин плитки</name>
<company>Интернет-магазин плитки</company>
<url>https://www.plitkanadom.ru</url>
<platform>1C-Bitrix</platform>
<currencies>
<currency id="RUB" rate="1" />
</currencies>
<?
$countryID = htmlspecialchars($request->getQuery("id"));

$arFilter = ["UF_IBLOCK_ID" => 4];
$collection = \Collections::getCollectionsHL($arFilter);

function array_unique_key($array, $key) { 
	$tmp = $key_array = array(); 
	$i = 0; 
	foreach($array as $val) { 
		if (!in_array($val[$key], $key_array)) { 
			$key_array[$i] = $val[$key]; 
			$tmp[$i] = $val; 
		} 
		$i++; 
	} 
	return $tmp; 
}

$factory = array_unique_key($collection, 'UF_FACTORY_ID');

?>
<? if(!empty($factory)){ ?>
<categories>
<? foreach($factory as $item) {?>
<? if(($countryID)?$countryID == $item['UF_COUNTRY_ID']:true){?>
<category id="<?=$item['UF_FACTORY_ID'];?>"><?=htmlspecialchars($item['UF_FACTORY_NAME']);?></category>
<? } ?>
<? } ?>
</categories>
<offers>
<? foreach($collection as $item){?>
<? if(($countryID)?$countryID == $item['UF_COUNTRY_ID']:true){?>
<offer id="<?=$item['ID']?>" available="true">
<url>https://www.plitkanadom.ru<?=$item['PAGE_URL']?></url>
<price><?=$item['UF_CATALOG_PRICE_1']?></price>
<currencyId>RUB</currencyId>
<categoryId><?=$item['UF_FACTORY_ID'];?></categoryId>
<picture>https://www.plitkanadom.ru<?=$item['UF_SRC_PICTURE']?></picture>
<name><?=htmlspecialchars($item['UF_FULL_NAME']);?></name>
<description></description>
<sales_notes>Минимальная сумма заказа 10 000 руб.</sales_notes>
</offer>
<? } ?>
<? } ?>
</offers>
<? } ?>
</shop>
</yml_catalog>