<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult["COLLECTIONS"])):
?>
<? foreach($arResult["ITEMS"] as $item): ?>
<? if(in_array($item["ID"] , $arParams["IBLOCK_ID"])):?>
<div class="popular-collect">
	<h3><?=$arParams["TITLE"];?></h3>
	<div id="is-slider__<?=$arParams["TYPE"];?>_<?=$item["ID"];?>" class="is-goods__list popular-collect__list">
	<? foreach($arResult["COLLECTIONS"][$item["ID"]] as $collect):
		$date = FormatDate("Y", MakeTimeStamp($collect["DATE_CREATE"])); ?>
		<div class="popular-collect__item">
			<a href="<?=$collect["SECTION_PAGE_URL"];?>" id="<?=$collect["ID"];?>" title="<?=$collect["NAME"];?>">
				<div class="stikers">
				<? if($collect["UF_91"][0] == 5910):?>
				<div class="stiker isdeliverysale" title="<?=getMessage('DICOUNT_TITLE');?>"><?=getMessage('DICOUNT_TITLE_STICKER');?></div>
				<? endif; ?>
				<? if($collect["UF_91"][0] == 4989):?>
				<div class="stiker isdelivery" title="<?=getMessage('DICOUNT_TITLE2');?>"><?=getMessage('DICOUNT_TITLE2_STICKER');?></div>
				<? endif; ?>
				<? if($date >= (date("Y")-1)){?>
					<div class="stiker isnew" title="<?=getMessage('NEW_STIKER');?>"><?=getMessage('NEW_STIKER');?></div>
				<? } ?>
				</div>
				<? if(!empty($collect["UF_82"][0])):?>
					<div class="stiker__hit" title="<?=getMessage('HIT_STIKER');?>"></div>
				<? endif; ?>
				<? if(!empty($collect["PICTURE"])):?>
				<img src="<?=$collect["PICTURE"];?>" alt="<?=$collect["NAME"];?>" />
				<? else: ?>
				<img src="/image/new_design/empty.jpg" alt="<?=$collect["NAME"];?>" />
				<? endif; ?>
				<span class="popular-collect__name">
					<? if(!empty($collect["UF_92"][0])):?>
					<div class="stiker__showroom" title="<?=getMessage('SHOW_STIKER');?>"><?=getMessage('SHOW_STIKER');?></div>
					<? endif; ?>
					<?=$arResult["FABRIC"][$collect["IBLOCK_SECTION_ID"]]["NAME"];?> <?=$collect["NAME"];?>
					<? if($collect["UF_CATALOG_PRICE_1"] >0 ):?>
					<span class="collct_price"><?=number_format($collect["UF_CATALOG_PRICE_1"], 0, '.', ' ' );?> <span>руб.</span></span>
					<? endif; ?>
				</span>
			</a>
		</div>
	<? endforeach;?>
	</div>
	<? if(count($arResult["COLLECTIONS"][$item["ID"]]) > 1):?>
	<script>
	$('#is-slider__<?=$arParams["TYPE"];?>_<?=$item["ID"];?>').slick({
		arrows : true,
		dots: false,
		infinite: true,
		speed: 500,
		slidesToShow: 1,
		variableWidth: true
	});
	</script>
	<? endif; ?>
	<? if(!empty($arParams["LINK"])):?>
	<div class="show-other"><a href="<?=$arParams["LINK"];?>">Посмотреть все</a></div>
	<? endif; ?>
</div>
<? endif; ?>
<? endforeach;?>
<? endif;