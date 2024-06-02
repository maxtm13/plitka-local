<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bPriceType = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column
?>
<div class="bx_ordercart">
	<h4><?=GetMessage("SALE_PRODUCTS_SUMMARY");?></h4>
	<div class="basket__items">
		<div class="basket__items-padding">
			<div class="basket-items-list-wrapper basket-items-list-wrapper-height-fixed">
				<div class="basket-items-list-container">
					<table class="basket-items-list-table unmobile">
						<tbody>
							<tr class="basket-items-list-item-container">
								<th class="basket-items-list-item-descriptions">
									<div class="basket-items-list-item-descriptions-inner">
										<div class="basket-item-block-image"></div>
										<div class="basket-item-block-info">товары
											<div class="basket-item-block-amount">количество</div>
										</div>
										<div class="basket-item-block-price allsumm">сумма</div>
									</div>
								</th>
							</tr>
						</tbody>
					</table>
					<table class="basket-items-list-table">
						<tbody>
						<? foreach ($arResult["GRID"]["ROWS"] as $k => $arData): 
							$iblock = $discount = '';
							$iblock = CIBlockElement::GetIBlockByID($arData["data"]["PRODUCT_ID"]);
							$db_props = CIBlockElement::GetProperty($iblock, $arData["data"]["PRODUCT_ID"], ["sort" => "asc"], ["CODE"=>"DISCOUNT"]);
							if($ar_props = $db_props->Fetch()){
								$discount = $ar_props["VALUE"];
							}
							?>
							<tr class="basket-items-list-item-container<?=(!empty($discount) ? " hasdiscount" : '');?>">
								<td class="basket-items-list-item-descriptions">
									<div class="basket-items-list-item-descriptions-inner">
										<div class="basket-item-block-image">
											<a href="<?=$arData["data"]["DETAIL_PAGE_URL"];?>" class="basket-item-image-link" style="background-image:url(<?=$arData["data"]["PREVIEW_PICTURE_SRC"];?>);"></a>
										</div>
										<div class="basket-item-block-info">
											<a href="<?=$arData["data"]["DETAIL_PAGE_URL"];?>" class="basket-item-info-name-link">
												<?=$arData["data"]["NAME"];?>
											</a>
										</div>
										<div class="basket-item-block-amount">
											<?=$arData["data"]["QUANTITY"]?> <?=$arData["data"]["MEASURE_NAME"]?>
										</div>
										<div class="basket-item-block-price allsumm">
											<div class="basket-item-price-current">
												<span class="basket-item-price-current-text">
													<?=$arData["data"]["SUM"]?>
												</span>
											</div>
										</div>
									</div>
								</td>
							</tr>
						<? endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div class="bx_section">
		<h4><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></h4>
		<div class="bx_block w100"><textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" style="max-width:100%;min-height:120px"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea></div>
		<input type="hidden" name="" value="">
		<div style="clear: both;"></div><br />
	</div>
	<div class="basket__total">
		<div class="basket__total-padding">
			<div class="basket-checkout-container">
				<div class="basket-checkout-block-total-title">Итого:</div>
				<div class="basket-checkout-block basket-checkout-block-total-price">
					<div class="basket-checkout-block-total-price-inner">
						<div class="basket-coupon-block-total-price-current" data-price="<?=$arResult["ORDER_TOTAL_PRICE"]?>"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></div>
						<? if($arResult["DISCOUNT_PRICE"]>0){?>
						<div class="basket-coupon-block-total-price-old">
							<span><?=$arResult["PRICE_WITHOUT_DISCOUNT"]?></span>
						</div>
						<div class="basket-coupon-block-total-price-difference">
							Скидка составила <span><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></span>
						</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		if($('.basket-items-list-table').find('.hasdiscount').length < 1){
			$('.paytype15').hide();
		}
	});
</script>
