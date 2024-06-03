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
<?
	$picPath = $templateFolder.'/prom_cal.png';
?>
<div class="rbs-news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<? if (/* MakeTimeStamp(Date("d.m.Y H:i:s")) > (MakeTimeStamp($arItem["DATE_ACTIVE_TO"]))*/ true){ ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<script data-skip-moving=true>
			function declOfNum(number, titles) {  
				cases = [2, 0, 1, 1, 1, 2];  
				return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];  
			}
		</script>
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<div class="news-item">
				<div class="pict">
					<img
								class="preview_picture"
								border="0"
								src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
								alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
								title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
								style="float:left"
					/>
				</div>
				<div class="space"></div>
				<div class="Ost">
					<div class="top_cal"></div>
					<img
						src="<? echo $picPath; ?>"
						class="cal-list"
					/>
					<div class="Ost1">
						Осталось
					</div>
					<div class="Ost2">
						<?
							$interval = 0;
							echo $interval;
						?>
					</div>
					<div class="Ost1">
						<script data-skip-moving=true>
							document.write(declOfNum(<? echo ($interval); ?>, ['день', 'дня', 'дней']));
						</script>
					</div>
				</div>
				<div class="NewsDesc">
					<div class="ActTo">
						Действовала до <? echo FormatDate("d F", MakeTimeStamp($arItem["DATE_ACTIVE_TO"])); ?>
					</div>
					<div class="NewsName">
						<? echo $arItem["NAME"]; ?>
					</div>
				</div>
			</div>
		</a>
	<? } ?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
