<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php if (!empty($arResult)) { ?>
	<ul class="pnd-vm-top-2018">
		<?php $previousLevel = 0;
		foreach($arResult as $key => $arItem) { ?>
			<?php if (!empty($arItem['PARAMS']['class']) && $arItem['PARAMS']['class'] == 'separator') {
				if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
					echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
				}
				echo '</ul><ul class="sublevel level-'.$arItem["DEPTH_LEVEL"].'" data-level="'.$arItem["DEPTH_LEVEL"].'">';
				$previousLevel = $arItem["DEPTH_LEVEL"];
				continue;
			} ?>

			<?php if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) { ?>
				<?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?php } ?>

			<?php if (substr_count($arItem['PARAMS']['class'], 'empty') > 0) { ?>
				<li class="empty<?php if (substr_count($arItem['PARAMS']['class'], 'border') > 0) { echo ' border'; } ?>"><a href="javascript:void(0)">&nbsp;</a></li>
			<?php } else if ($arItem['PARAMS']['class'] == 'include') { ?>
				<div class="include-wrapper clear">
					<?php include($_SERVER['DOCUMENT_ROOT'].$arItem["LINK"]); ?>
					<div class="clear"></div>
				</div>
			<?php } else if ($arItem['PARAMS']['class'] == 'include1') { ?>
				<div class="include-wrapper-1">
					<?php include($_SERVER['DOCUMENT_ROOT'].$arItem["LINK"]); ?>
					<div class="clear"></div>
				</div>
			<?php } else if (substr_count($arItem['PARAMS']['class'], 'title') > 0) { ?>
				<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; ?> title<?php if ($arItem["SELECTED"] || (!empty($arParams['curPageURL']) && substr_count($arParams['curPageURL'], $arItem["LINK"]) > 0)) { echo ' item-selected'; } ?>">
					<?php if (!empty($arItem["LINK"])) { ?>
						<a href="javascript:void(0)">
					<?php } else { ?>
						<span>
					<?php }
					echo $arItem["TEXT"];
					if (!empty($arItem["LINK"])) { ?>
						</a>
					<?php } else { ?>
						</span>
					<?php } ?>
				</li>
			<?php } else if ($arItem["IS_PARENT"]) { ?>
				<?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
					<li<?php if (substr_count($arItem['PARAMS']['class'], 'border') > 0) { echo ' class="border"'; } ?>>
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"] || (!empty($arParams['curPageURL']) && substr_count($arParams['curPageURL'], $arItem["LINK"]) > 0)):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
						<div class="sublevels-wrapper" data-level="<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">
							<ul class="sublevel level-<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>" data-level="<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">
				<?php } else { ?>
					<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ' country'; } if (substr_count($arItem['PARAMS']['class'], 'border') > 0) { echo ' border'; } ?>">
						<a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"] || (!empty($arParams['curPageURL']) && substr_count($arParams['curPageURL'], $arItem["LINK"]) > 0)):?> item-selected<?endif?><?if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ($arItem["PARAMS"]['ORDER'] % 2 == 0) ? ' country even' : ' country odd'; }?>"><?if (!empty($arItem["PARAMS"]['IMG']) && $arItem["DEPTH_LEVEL"] == 2) {?><span><img src="<?php echo $arItem["PARAMS"]['IMG']; ?>" width="43" height="24" /></span><?php } ?><?=$arItem["TEXT"]?> <span>&rsaquo;</span></a>
						<div class="sublevels-wrapper" data-level="<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">
							<ul class="sublevel level-<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>" data-level="<?php echo $arItem["DEPTH_LEVEL"] + 1; ?>">
				<?php } ?>
			<?php } else { ?>
				<?php if ($arItem["PERMISSION"] > "D") { ?>
					<?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
						<li<?php if (substr_count($arItem['PARAMS']['class'], 'border') > 0) { echo ' class="border"'; } ?>>
							<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"] || (!empty($arParams['curPageURL']) && substr_count($arParams['curPageURL'], $arItem["LINK"]) > 0)):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
							<?if ($arItem["SECTIONS_PARAMS"]) {?>
								<div class="root-item">
									<?$APPLICATION->IncludeComponent("sitecoders:automenu.unified", $arItem["SECTIONS_PARAMS"]["SECTIONS_TPL_NAME"], $arItem["SECTIONS_PARAMS"]);?>
								</div>
							<?}?>
						</li>
					<?php } else { ?>
						<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ' country'; } if (substr_count($arItem['PARAMS']['class'], 'border') > 0) { echo ' border'; } ?>">
							<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"] || (!empty($arParams['curPageURL']) && substr_count($arParams['curPageURL'], $arItem["LINK"]) > 0)):?> item-selected<?endif?><?if (!empty($arItem["PARAMS"]['ORDER']) && $arItem["DEPTH_LEVEL"] == 2) { echo ($arItem["PARAMS"]['ORDER'] % 2 == 0) ? ' country even' : ' country odd'; }?>"><?=$arItem["TEXT"]?></a>
						</li>
					<?php } ?>
				<?php } else { ?>
					<?php if ($arItem["DEPTH_LEVEL"] == 1) { ?>
						<li><a href="" class="<?if ($arItem["SELECTED"] || (!empty($arParams['curPageURL']) && substr_count($arParams['curPageURL'], $arItem["LINK"]) > 0)):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?php } else { ?>
						<li class="depth-<?php echo $arItem["DEPTH_LEVEL"]; ?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?php } ?>
				<?php }
			} ?>

			<?php $previousLevel = $arItem["DEPTH_LEVEL"];
		}
		
		if ($previousLevel > 1) {//close last item tags
			echo str_repeat("</ul></div></li>", ($previousLevel-1) );
		} ?>
	</ul>
<?php } ?>