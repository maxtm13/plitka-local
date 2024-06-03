<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="pnd-tree-menu">
<ul class="level-1">
<?
$previousLevel = 0;
foreach($arResult as $arItem):
?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>
			<li class="<?if($arItem["SELECTED"]):?> selected<?endif?><?if($arItem["CHILD_SELECTED"] !== true):?> closed<?endif?>">
				<div class="folder"></div>
				<a href="<?/*=$arItem["LINK"]*/?>javascript:void(0)" onClick="OpenMenuNode(this)"><?=$arItem["TEXT"]?></a>
				<ul class="sublevel level-<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>
				<li class="<?if($arItem["SELECTED"]):?> selected<?endif?>">
					<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				</li>
		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
</div>
<?endif?>