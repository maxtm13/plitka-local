<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult["BRANDS"])):?>
<div class="popular-brands" >
	<div class="popular-brands__list" id="brands-list">
	<? $i = 0; foreach($arResult["BRANDS"] as $brand): $i++; ?>
		<div class="popular-brands__item">
			<a href="<?=$brand["SECTION_PAGE_URL"];?>" title="<?=$brand["NAME"];?>">
				<span class="popular-brands__count"><span><?=$i;?></span></span>
				<? if(!empty($brand["LOGO"])):?>
				<img src="<?=$brand["LOGO"];?>" alt="<?=$brand["NAME"];?>" />
				<? else: ?>
				<span class="popular-brands__h"></span>
				<span class="popular-brands__name"><?=$brand["NAME"];?></span>
				<? endif; ?>
				<? if(!empty($arResult["FLAGS"][$brand["IBLOCK_SECTION_ID"]]["SRC"])):?>
				<div class="is-flag"><img src="<?=$arResult["FLAGS"][$brand["IBLOCK_SECTION_ID"]]["SRC"];?>" alt="<?=$arResult["FLAGS"][$brand["IBLOCK_SECTION_ID"]]["NAME"];?>" /></div>
				<? endif; ?>
			</a>
		</div>
	<? endforeach;?>
	</div>
</div>
<? endif; ?>
<div class="popular-brands__block-btn">
	<button type="button" id="loadMore" class="popular-brands__btn">Показать ещё...</button>
</div>
<script>
$(function () {
    x=50;
    $('#brands-list .popular-brands__item').slice(0, 50).show();
    $('#loadMore').on('click', function (e) {
        e.preventDefault();
        x = x+50;
        $('#brands-list .popular-brands__item').slice(0, x).slideDown();
        if (x><?=$arResult["BRANDS_COUNT"]?>){
            $('.popular-brands__btn').addClass("disable");	
        }
    });
});
</script>