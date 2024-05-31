<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult["ID"])): ?>
<div class="is_article" id="is-detail">
	<? if(!empty($arResult["PICTURE"]["BIG"])):?>
	<div class="is_article__img-big"><a href="<?=$arResult["PICTURE"]["BIG"];?>" data-fancybox="gallery"><img src="<?=$arResult["PICTURE"]["MIN"];?>" alt="<?=$arResult["NAME"];?>" /></a></div>
	<? endif; ?>
	<? if($arResult["DETAIL_TEXT"]):?>
	<div class="is_article__text">
		<div class="is_article__date"><?=$arResult["DISPLAY_ACTIVE_FROM"];?></div>
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
	<? endif; ?>
	<div class="clear"></div>
</div>
<? endif; ?>