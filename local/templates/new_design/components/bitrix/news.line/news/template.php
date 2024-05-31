<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(!empty($arResult["ITEMS"])): ?>
<div class="is-news">
	<div class="is-news__title"><?=getMessage("NEWS_TITLE");?></div>
	<div class="is-news__list">
		<? foreach($arResult["ITEMS"] as $item):?>
		<div class="is-news__block">
			<a href="<?=$item["DETAIL_PAGE_URL"];?>">
				<? if(!empty($item["PICTURE"])):?>
				<div class="is-news__img">
					<img src="<?=$item["PICTURE"];?>" alt="<?=$item["NAME"];?>" />
				</div>
				<? endif; ?>
				<div class="is-news__info">
					<div class="is-news__name"><?=$item["NAME"];?></div>
					<div class="is-news__date"><?=$item["DISPLAY_ACTIVE_FROM"];?></div>
					<div class="is-news__text"><?=$item["PREVIEW_TEXT"];?></div>
				</div>
				<div class="clear"></div>
			</a>
		</div>
		<? endforeach;?>
		<div class="clear"></div>
	</div>
	<div class="show-other"><a href="/news/"><?=getMessage("ALL_NEWS");?></a></div>
</div>
<? endif; ?>