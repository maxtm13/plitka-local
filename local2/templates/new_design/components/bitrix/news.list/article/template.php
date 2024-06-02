<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult["ITEMS"])):
?>
<section class="news <?=$arParams["TYPE"];?>">
	<div class="max-width">
		<div class="news__list">
			<? foreach($arResult["ITEMS"] as $item): ?>
			<div class="news__item">
				<a class="news__item-link" href="<?=$item["DETAIL_PAGE_URL"];?>">
					<? if(!empty($item["PICTURE"])):?>
					<img class="news__item-img" src="<?=$item["PICTURE"];?>" alt="<?=$item["NAME"];?>" />
					<? endif; ?>
					<strong class="news__item-name"><?=$item["NAME"];?></strong>
					<span class="news__item-read"><?=getMessage("NEWS_READ");?></span>
				</a>
			</div>
			<? endforeach; ?>
		</div>
		<?php if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<? endif;?>
	</div>
</section>
<? endif; ?>