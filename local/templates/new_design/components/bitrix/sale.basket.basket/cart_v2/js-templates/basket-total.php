<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="basket-checkout-container" data-entity="basket-checkout-aligner">
		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
			?>
			<div class="basket-coupon-section">
				<div class="basket-coupon-block-field">
					<div class="basket-coupon-block-field-description">
						<?=Loc::getMessage('SBB_COUPON_ENTER')?>:
					</div>
					<div class="form">
						<div class="form-group" style="position: relative;">
							<input type="text" class="form-control" id="" placeholder="" data-entity="basket-coupon-input">
							<span class="basket-coupon-block-coupon-btn"></span>
						</div>
					</div>
				</div>
			</div>
			<?
		}
		?>
		<div class="basket-checkout-block-total-title">Итого:</div>
		<div class="basket-checkout-block-total-description">
		<? /*
			{{#WEIGHT_FORMATED}}
				<?=Loc::getMessage('SBB_WEIGHT')?>: {{{WEIGHT_FORMATED}}}
				{{#SHOW_VAT}}<br>{{/SHOW_VAT}}
			{{/WEIGHT_FORMATED}}
		*/ ?>
			{{#SHOW_VAT}}
				<?=Loc::getMessage('SBB_VAT')?>: {{{VAT_SUM_FORMATED}}}
			{{/SHOW_VAT}}
		</div>
		<div class="basket-checkout-block basket-checkout-block-total-price">
				<div class="basket-checkout-block-total-price-inner">
					<div class="basket-coupon-block-total-price-current" data-entity="basket-total-price">
						{{{PRICE_FORMATED}}}
					</div>
					{{#DISCOUNT_PRICE_FORMATED}}
						<div class="basket-coupon-block-total-price-old">
							<span>{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}</span>
						</div>
						<div class="basket-coupon-block-total-price-difference">
							<?=Loc::getMessage('SBB_BASKET_ITEM_ECONOMY')?>
							<span>{{{DISCOUNT_PRICE_FORMATED}}}</span>
						</div>
					{{/DISCOUNT_PRICE_FORMATED}}
				</div>
			</div>
			<? /*
			<a href="/order/" class="buyit{{#DISABLE_CHECKOUT}} disabled{{/DISABLE_CHECKOUT}}" data-entity="basket-checkout-button">
				<span class="text"><?=Loc::getMessage('SBB_ORDER')?></span>
				<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M10.0401 3.6C10.0504 3.4904 10.0557 3.3792 10.0557 3.26667C10.0557 1.46253 8.69475 0 7.01584 0C5.33695 0 3.97594 1.46253 3.97594 3.26667C3.97594 3.3792 3.98123 3.4904 3.99157 3.6H1.838C1.05787 3.6 0.416246 4.24699 0.382723 5.06745L0.00137359 14.4008C-0.0342507 15.2727 0.627618 16 1.45665 16H12.5433C13.3724 16 14.0343 15.2727 13.9986 14.4008L13.6173 5.06745C13.5837 4.24699 12.9421 3.6 12.162 3.6H10.0401ZM9.01356 3.6H5.01814C4.99914 3.48081 4.98924 3.35831 4.98924 3.23333C4.98924 2.03671 5.89658 1.06667 7.01584 1.06667C8.1351 1.06667 9.04244 2.03671 9.04244 3.23333C9.04244 3.35831 9.03256 3.48081 9.01356 3.6ZM1.96722 4.66667C1.6632 4.66667 1.41269 4.91783 1.39791 5.23748L0.978444 14.3041C0.962598 14.6466 1.22207 14.9333 1.54775 14.9333H12.4542C12.7792 14.9333 13.0383 14.6478 13.0236 14.3061L12.6321 5.23942C12.6183 4.91897 12.3674 4.66667 12.0627 4.66667H1.96722ZM9.98963 6.38977C9.99146 6.37123 9.99241 6.35239 9.99241 6.33333C9.99241 6.03878 9.76556 5.8 9.48576 5.8C9.21439 5.8 8.99286 6.02459 8.97975 6.30684C8.75631 7.24373 7.96176 7.93653 7.01584 7.93653C6.06994 7.93653 5.2754 7.24373 5.05196 6.30685C5.03884 6.0246 4.8173 5.8 4.54592 5.8C4.2661 5.8 4.03927 6.03878 4.03927 6.33333C4.03927 6.34899 4.03991 6.36449 4.04116 6.37981L4.03504 6.38077C4.31341 7.8764 5.54217 9.0032 7.01584 9.0032C8.48627 9.0032 9.71293 7.88127 9.99482 6.39057L9.98963 6.38977Z" fill="white"/>
				</svg>
			</a>
			*/ ?>
		</div>

		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
		?>
			<div class="basket-coupon-alert-section">
				<div class="basket-coupon-alert-inner">
					{{#COUPON_LIST}}
					<div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
						</span>
						<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?=Loc::getMessage('SBB_DELETE')?>
						</span>
					</div>
					{{/COUPON_LIST}}
				</div>
			</div>
			<?
		}
		?>
	</div>
</script>