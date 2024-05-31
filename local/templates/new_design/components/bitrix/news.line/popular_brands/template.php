<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if (!empty($arResult["ITEMS"]) && !empty($arResult["BRANDS"])):?>
<div class="popular-brands">
	<h3><?=GetMessage("POPULAR_BRANDS_TITLE");?></h3>
	<div class="popular-brands__list">
	<? $i = 0; foreach($arResult["ITEMS"] as $item): $i++;
		$brand = $arResult["BRANDS"][$item["PROPERTY_FABRIC_VALUE"]];
		?>
		<? if($i == 1):?>
		<div class="popular-brands__item">
		<? endif; ?>
			<a href="<?=$brand["SECTION_PAGE_URL"];?>" title="<?=$brand["NAME"];?>">
				<img src="<?=$brand["LOGO"];?>" alt="<?=$brand["NAME"];?>" />
			</a>
		<? if($i == 2): $i = 0; ?>
		</div>
		<? endif; ?>
	<? endforeach;?>
		<? if($i == 1): ?>
		</div>
		<? endif; ?>
	</div>
	<div class="show-other"><a href="/brands/">Посмотреть все</a></div>
</div>
<? endif;