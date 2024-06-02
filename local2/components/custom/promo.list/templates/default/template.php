
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
?>
<?foreach($arResult["ITEMS"] as $arItem){?>



<div class="promo__list">
    <script data-skip-moving="true">
        function declOfNum(number, titles) {  
            cases = [2, 0, 1, 1, 1, 2];  
            return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
        }
    </script>
	<a href="<?= $arItem["DETAIL_PAGE_URL"]?>">
		<div class="promo__item">
			<div class="promo__pict">
				<img class="promo__img" src="<?= $arItem["PICTURE"]?>" alt="<?= $arItem["NAME"]?>" title="<?= $arItem["NAME"]?>" style="float:left">
			</div>
			<div class="promo__end">
				<img src="/local2/templates/new_design/components/bitrix/news/rbs_promotions/bitrix/news.list/.default/prom_cal.png" class="promo__cal" title="Изображение" alt="Изображение">
				<span>Осталось</span>
				<div class="promo__end-day">20</div>
				<span>
					<script data-skip-moving="true">
						document.write(declOfNum(20, ['день', 'дня', 'дней']));
					</script>дней
				</span>
			</div>
			<div class="promo__desc">
				<div class="promo__actto">Действует до 30 ноября</div>
				<div class="promo__title"><?= $arItem["NAME"]?></div>
			</div>
		</div>
	</a>
</div>
<? } ?>