<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="vertical-multilevel-menu">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?if($previousLevel > 1):?>
			<?=str_repeat("</div></ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"] - 1));?>
		<?endif;?>
		</ul></li>
	<?endif?>
	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li <?= !empty($arItem['PARAMS']['CLASS']) ? 'class="' . $arItem['PARAMS']['CLASS'] . '"' : ''?>><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class="root-item">
		<?else:?>
			<li class="depth-<? echo $arItem["DEPTH_LEVEL"]; ?>"><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul><div class="sub-wrapper-<? echo $arItem["DEPTH_LEVEL"]; ?>">
		<?endif?>
	<?else:
		if ($arItem["PERMISSION"] > "D"):
			if ($arItem["DEPTH_LEVEL"] == 1):
				?><li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
                    <?if ($arItem["SECTIONS_PARAMS"]) {?>
                        <div class="root-item">
                            <?$APPLICATION->IncludeComponent("sitecoders:automenu.unified", $arItem["SECTIONS_PARAMS"]["SECTIONS_TPL_NAME"], $arItem["SECTIONS_PARAMS"]);?>
                        </div>
                    <?}?>
                </li>
			<?else:
				?><li class="depth-<? echo $arItem["DEPTH_LEVEL"]; ?>"><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?else:?>
			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="depth-<? echo $arItem["DEPTH_LEVEL"]; ?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel)://close last item tags?>
	<?if ($previousLevel > 1):?>
		<?=str_repeat("</div></ul></li>", ($previousLevel-1) );?>
	<?endif;?>
	<!-- </ul></li> -->
<?endif?>
</ul>
<p>Test</p>
<?endif?>