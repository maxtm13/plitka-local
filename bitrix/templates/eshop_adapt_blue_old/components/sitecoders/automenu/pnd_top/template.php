<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php if (!empty($arResult)) { ?>
	<ul class="pnd-vm-top">
		<?php $previousLevel = 0;
		foreach($arResult as $key => $arItem) { ?>
			<?php if (!empty($arItem['PARAMS']['class']) && $arItem['PARAMS']['class'] == 'separator') {
				if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
					echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
				}
				echo '</ul><ul class="sublevel level-'.$arItem["DEPTH_LEVEL"].'">';
				$previousLevel = $arItem["DEPTH_LEVEL"];
				continue;
			} ?>

			<?php if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) { ?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?php } ?>

			<?php if ($arItem["IS_PARENT"]) { ?>
				<?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
					<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a><span class="triangle"></span>
						<ul class="sublevel level-<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">
				<?php } else { ?>
					<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; ?><?if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ' country'; }?>"><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?><?if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ($arItem["PARAMS"]['ORDER'] % 2 == 0) ? ' country even' : ' country odd'; }?>"><?if (!empty($arItem["PARAMS"]['IMG']) && $arItem["DEPTH_LEVEL"] == 2) {?><span><img src="<?php echo $arItem["PARAMS"]['IMG']; ?>" width="43" height="24" /></span><?php } ?><?=$arItem["TEXT"]?></a>
						<ul class="sublevel level-<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">
				<?php } ?>
			<?php } else { ?>
				<?php if ($arItem["PERMISSION"] > "D") { ?>
					<?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
						<li>
							<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
							<?if ($arItem["SECTIONS_PARAMS"]) {?>
								<div class="root-item">
									<?$APPLICATION->IncludeComponent("sitecoders:automenu.unified", $arItem["SECTIONS_PARAMS"]["SECTIONS_TPL_NAME"], $arItem["SECTIONS_PARAMS"]);?>
								</div>
							<?}?>
						</li>
					<?php } else { ?>
						<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; ?><?if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ' country'; }?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?> item-selected<?endif?><?if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ($arItem["PARAMS"]['ORDER'] % 2 == 0) ? ' country even' : ' country odd'; }?>"><?=$arItem["TEXT"]?></a></li>
					<?php } ?>
				<?php } else { ?>
					<?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
						<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?php } else { ?>
						<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; ?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?php } ?>
				<?php }
			} ?>

			<?php $previousLevel = $arItem["DEPTH_LEVEL"];
		}
		
		if ($previousLevel > 1) {//close last item tags
			echo str_repeat("</ul></li>", ($previousLevel-1) );
		} ?>
	</ul>
<?php } ?>