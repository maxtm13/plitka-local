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
$items = $category = $result = [];

$getCategories = $_SERVER['DOCUMENT_ROOT'].'/local/fids/json/json_iblock_4_categories_v2.json';

if(file_exists($getCategories)):
$category = file_get_contents($getCategories);
$category = json_decode($category, true);
endif;
?>
<? if(!empty($category)){ ?>
<categories>
	<category id="42628"><?=htmlspecialchars('Laparet');?></category>
</categories>
<offers>
<? foreach($category as $f=>$cats){?>
<? if($cats["p"] && $cats["d"] == 3 && $cats["s"] == 42628){?>
<offer id="<?=$f;?>" available="true">
<url>https://www.plitkanadom.ru<?=$cats["l"];?></url>
<price><?=$cats["p"];?></price>
<currencyId>RUB</currencyId>
<categoryId><?=$cats["s"];?></categoryId>
<picture>https://www.plitkanadom.ru<?=CFile::GetPath($cats["i"]);?></picture>
<name><?=htmlspecialchars($category[$cats["s"]]["n"]);?> <?=htmlspecialchars($cats["n"]);?></name>
<description></description>
<sales_notes>Минимальная сумма заказа 10 000 руб.</sales_notes>
<? if(!empty($colors)){ ?><param name="Цвет"><?=implode(";", $colors);?></param><? } ?>
</offer>
<?	} ?>
<? } ?>
</offers>
<? } ?>
</shop>
</yml_catalog>