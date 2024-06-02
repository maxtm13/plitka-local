<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="is-collection__block">
	<? if($arResult["USE_DELIVERY"] == "Y"){ ?>
		<a href="/promotions/aktsiya-na-proizvoditeley-delacora-altacera-kerama-marazzi-uralkeramika-alma-ceramica-italon-laparet/"><img src="/image/banner_2.jpg" style="max-height: 170px;" /></a>
	<? } ?>
	<? if($arResult["USE_DELIVERY_V2"] == "Y"){ ?>
		<a href="/promotions/aktsiya-na-proizvoditeley-delacora-new-trend-coliseum-gres-altacera-uralkeramika-alma-ceramica-lapar/"><img src="/image/akzii_v4.jpg" style="max-height: 170px;" /></a>
	<? } ?>
	<? if(!empty($arResult["PHOTOS"])):?>
	<div class="is-collection__images">
		<? foreach($arResult["PHOTOS"] as $photo):?>
		<a href="<?=$photo["BIG"];?>" data-fancybox="gallery"><img src="<?=$photo["MIN"];?>" alt="<?=$arResult["NAME"];?>" /></a>
		<? endforeach; ?>
	</div>
	<? endif; ?>
</div>