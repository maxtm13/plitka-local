<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult["COLLECTIONS"])): ?>
<div class="popular-collect full rows<?=$arParams["ROWS"];?>">
	<? if($arParams["TYPE"] == "SHOW_ROOM"):?>
	<h3>Образцы керамической плитки и напольных покрытий, представленные в шоу-руме:</h3>
	<? endif;?>
	<? if($arParams["TYPE"] == "NEW"):?>
	<p>В данном разделе представлены новинки плитки, керамогранита и мозаики.</p>
	<? endif;?>
	<? if($arParams["TYPE"] == "POPULAR"):?>
	<p>В данном разделе представлены наиболее популярные коллекции плитки, керамогранита и мозаики.</p>
	<? endif;?>
<? foreach($arResult["ITEMS"] as $item): ?>
<? if(in_array($item["ID"] , $arParams["IBLOCK_ID"])):?>
	<div class="is-goods__list popular-collect__list">
	<? foreach($arResult["COLLECTIONS"][$item["ID"]] as $collect):		
		$date = FormatDate("Y", MakeTimeStamp($collect["DATE_CREATE"])); ?>
		<div class="popular-collect__item">
			<a href="<?=$collect["SECTION_PAGE_URL"];?>" id="<?=$collect["ID"];?>" title="<?=$collect["NAME"];?> <?=$arResult["FABRIC"][$collect["IBLOCK_SECTION_ID"]]["NAME"];?>">
				<div class="stikers">
				<? if($collect["UF_91"][0] == 5910):?>
				<div class="stiker isdeliverysale" title="<?=getMessage('DICOUNT_TITLE');?>"><?=getMessage('DICOUNT_TITLE_STICKER');?></div>
				<? endif; ?>
				<? if($collect["UF_91"][0] == 4989):?>
				<div class="stiker isdelivery" title="<?=getMessage('DICOUNT_TITLE2');?>"><?=getMessage('DICOUNT_TITLE2_STICKER');?></div>
				<? endif; ?>
				<? if($date >= ($arResult["YEAR"]-1)){?>
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
					<?=$collect["NAME"];?> <?=$arResult["FABRIC"][$collect["IBLOCK_SECTION_ID"]]["NAME"];?>
					<? if($collect["UF_CATALOG_PRICE_1"] >0 ):?>
					<span class="collct_price"><?=number_format($collect["UF_CATALOG_PRICE_1"], 0, '.', ' ' );?> <span>руб.</span></span>
					<? endif; ?>
				</span>
			</a>
		</div>
	<? endforeach;?>
	</div>
	<?=$arResult["NAV_STRING"];?>
<? endif; ?>
<? endforeach;?>
</div>
<? endif;