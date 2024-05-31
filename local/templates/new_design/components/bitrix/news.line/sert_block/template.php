<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(!empty($arResult["ITEMS"])):
?>
<div class="is-serts">
	<<?=$arParams["IS_TITLE"];?>><? $APPLICATION->IncludeFile("/include/sertificates_title.php", []); ?></<?=$arParams["IS_TITLE"];?>>
	<div class="is-serts__text">
		<? $APPLICATION->IncludeFile("/include/sertificates.php", []); ?>
	</div>
	<div class="is-serts__img">
		<? foreach($arResult["ITEMS"] as $item):?>
			<? if($item["PICTURE"]["BIG"]):?>
			<a data-fancybox="sertif" href="<?=$item["PICTURE"]["BIG"];?>"><img src="<?=$item["PICTURE"]["MOB"];?>" alt="<?=$item["NAME"];?>" /></a>
			<? endif; ?>
		<? endforeach;?>
	</div>
</div>
<? endif; ?>