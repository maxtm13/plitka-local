<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult['SECTIONS'])):?>
<div class="brands__block">
	<h3><?=GetMessage("BRANDS_STARS_TITLE");?></h3>
<? /*	
<div class="brands__side"><h3><?=GetMessage("BRANDS_LIST_TITLE");?></h3></div>
*/ ?>
	<div class="Brands__list">
	<? foreach($arResult["SECTIONS"] as $sect):?>
		<div class="brand__item">
			<div class="brand__stars"><img src="/upload/iblock/files/<?=$sect["UF_STARS"];?>zvezd<?=$sect["UF_STARS"];?>.png" alt="" /></div>
			<div class="brands__side">
				<a href="<?=$sect["SECTION_PAGE_URL"];?>" class="brand__name">
					<img class="brand__flag" src="<?=$arResult["FLAGS"][$sect["IBLOCK_SECTION_ID"]]["SRC"];?>" alt="<?=$arResult["FLAGS"][$sect["IBLOCK_SECTION_ID"]]["NAME"];?>" />
					<strong><?=$sect["NAME"];?></strong>
				</a>
			</div>
		</div>
	<? endforeach;?>
	</div>
</div>
<? endif;