<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? header("Content-Type: text/xml");?>
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
<categories>
<?
$items = $prices = $category = $result = [];

$getItems = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_items.json';

if(file_exists($getItems)):
$items = file_get_contents($getItems);
$items = json_decode($items, true);
endif;

$getPrices = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_price.json';

if(file_exists($getPrices)):
$prices = file_get_contents($getPrices);
$prices = json_decode($prices, true);
endif;

$getCategories = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_categories.json';

if(file_exists($getCategories)):
$category = file_get_contents($getCategories);
$category = json_decode($category, true);
endif;

$getPaths = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_path.json';

if(file_exists($getPaths)):
$path = file_get_contents($getPaths);
$path = json_decode($path, true);
endif;
?>
<? if(!empty($items) && $prices && $category){ ?>
<? foreach($category as $s=>$cats){?>
<? if(!$cats["p"]){?>
<category id="<?=$s;?>"><?=htmlspecialchars($cats["n"]);?></category>
<? } ?>
<? } ?>
<? foreach($category as $s=>$cats){?>
<? if($cats["p"]){?>
<category id="<?=$s;?>" parentId="<?=$cats["p"];?>"><?=htmlspecialchars($cats["n"]);?></category>
<?	} ?>
<? } ?>
</categories>
<offers>
<? foreach($items as $k=>$item){?>
<offer id="<?=$k;?>" available="true">
<url>https://www.plitkanadom.ru<?=$item["u"];?></url>
<price><?=$prices[$k];?></price>
<currencyId>RUB</currencyId>
<categoryId><?=$item["s"];?></categoryId>
<picture>https://www.plitkanadom.ru<?=$path[$k];?></picture>
<name><?=htmlspecialchars($item["n"]);?></name>
<description><?=htmlspecialchars($item["d"]);?></description>
<sales_notes>Минимальная сумма заказа 10 000 руб.</sales_notes>
<param name="Цвет"><?=htmlspecialchars($item["c"]);?></param>
<param name="Размер"><?=htmlspecialchars($item["w"]);?></param>
</offer>
<? } ?>
</offers>
<? } ?>
</shop>
</yml_catalog>