<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="is-country__block">
<!--	<h3>Плитка на дом</h3> -->
	<div class="is-country__slogan"><? $APPLICATION->IncludeFile("/include/country_slogan.php", []); ?></div>
<? if(!empty($arResult["ITEMS"])):?>
	<div class="is-country__list">
		<? foreach($arResult["ITEMS"] as $item):?>
		<a href="<?=$item["PROPERTY_SECTION_URL_VALUE"]?>" class="is-country__item">
			<p class="is-country__name"><?=$item["NAME"];?></p>
			<p class="is-country__prev"><?=$item["PREVIEW_TEXT"];?></p>
		</a>
		<? endforeach;?>
	</div>
<? endif; ?>
	<div class="is-country__text"><? $APPLICATION->IncludeFile("/include/country_text.php", []); ?></div>
</div>