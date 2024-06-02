<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if (!empty($arResult["BRANDS"])):
$link = [
	"4" => '/brands/',
	"9" => '/brands-napolnye-pokrytiya/',
	"11" => '/brands-santekhnika/',
];
?>
<? foreach($arResult["ITEMS"] as $item): ?>
<? if(in_array($item["ID"], $arParams["IBLOCK_ID"])):?>
<div class="popular-brands">
	<h3><?=GetMessage("POPULAR_BRANDS_TITLE_".$item["ID"]);?></h3>
	<div class="popular-brands__list">
	<? foreach($arResult["BRANDS"][$item["ID"]] as $brand): ?>
		<div class="popular-brands__item">
			<a href="<?=$brand["SECTION_PAGE_URL"];?>" title="<?=$brand["NAME"];?>">
				<? if(!empty($brand["LOGO"])):?>
				<img src="<?=$brand["LOGO"];?>" alt="<?=$brand["NAME"];?>" />
				<? else: ?>
				<span class="popular-brands__h"></span>
				<span class="popular-brands__name"><?=$brand["NAME"];?></span>
				<? endif; ?>
			</a>
		</div>
	<? endforeach;?>
	</div>
	<div class="show-other"><a href="<?=$link[$item["ID"]];?>">Посмотреть все</a></div>
</div>
<? endif; ?>
<? endforeach;?>
<? endif;