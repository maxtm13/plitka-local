<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]))
	return;
?>
<div class="bx_search">
	<? if(!empty($arResult["COLLECION"])):?>
	<div class="bx_search-subtilte">Бренды и коллекции:</div>
	<? foreach($arResult["COLLECION"] as $itremID=>$sectionID):
		$arItem = $arResult["SEARCH"][$itremID]; ?>
	<a href="<?=$arItem["URL"]?>" class="bx_item_block">
		<? if(!empty($arResult["SECTIONS_IMAGES"][$sectionID])):?>
		<span class="bx_img_element">
			<span class="bx_image" style="background-image: url('<?=$arResult["SECTIONS_IMAGES"][$sectionID];?>')"></span>
		</span>
		<? endif;?>
		<span class="bx_item_element"><?=str_replace($arItem["ITEM_ID"],'',$arItem["NAME"])?><? if(!empty($arResult["BRANDS"][$arResult["IN_BRAND"][$sectionID]])):?><span>(<?=$arResult["BRANDS"][$arResult["IN_BRAND"][$sectionID]];?>)</span><? endif; ?></span>
	</a>
	<? endforeach; ?>
	<? endif; ?>
	<? $itemsTitle = false; ?>
	<? foreach($arResult["CATEGORIES"] as $category_id => $arCategory):
		if($category_id != "all"):
			$itemsTitle = true;
		endif;
		endforeach; ?>
	<? if($itemsTitle == true):?>
	<div class="bx_search-subtilte">Товары:</div>
	<? endif; ?>
<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
	<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
		<?if($category_id === "all"):?>
			<div class="bx_item_element bx_search-all-link">
				<a href="<?=$arItem["URL"]?>"><?=$arItem["NAME"]?> &raquo;</a>
			</div>
		<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
			$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
			<a href="<?=$arItem["URL"]?>" class="bx_item_block">
				<? if(!empty($arElement["PICTURE"])):?>
				<span class="bx_img_element">
					<span class="bx_image" style="background-image: url('<?=$arElement["PICTURE"]; ?>')"></span>
				</span>
				<? endif; ?>
				<span class="bx_item_element">
					<?=str_replace($arItem["ITEM_ID"],'',$arItem["NAME"])?>
					<? foreach($arElement["PRICES"] as $code=>$arPrice){
						if ($arPrice["MIN_PRICE"] != "Y")
							continue;
						if($arPrice["CAN_ACCESS"]){
							if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<span class="bx_price">
									<?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
									<span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
								</span>
							<?else:?>
								<span class="bx_price"><?=$arPrice["PRINT_VALUE"]?></span>
							<?endif;
						}
						if ($arPrice["MIN_PRICE"] == "Y")
							break;
					}
					?>
				</span>
			</a>
		<?endif;?>
	<?endforeach;?>
<?endforeach;?>
</div>