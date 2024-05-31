<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(!empty($arResult["ITEMS"])):
?>
<div class="is-banners">
	<div class="is-banners__slider" id="is-main__<?=$arParams["TYPE"];?>slider">
	<? foreach($arResult["ITEMS"] as $item):?>
		<? if($item["PICTURE"]):?>
		<div class="slider__item">
			<? if($item["LINK"]):?>
			<a href="<?=$item["LINK"];?>">
			<? endif; ?>
			<img src="<?=$item["PICTURE"]["DESCTOP"];?>" class="is-main__slide is-desctop" alt="<?=$item["NAME"];?>" />
			<img src="<?=$item["PICTURE"]["MOBILE"];?>" class="is-main__slide is-mobile" alt="<?=$item["NAME"];?>" />
			<? if($item["LINK"]):?>
			</a>
			<? endif; ?>
		</div>
		<? endif; ?>
		<? endforeach;?>
	</div>
</div>
<? endif; ?>