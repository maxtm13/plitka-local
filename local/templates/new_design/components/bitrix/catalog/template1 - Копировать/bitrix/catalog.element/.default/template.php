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
$APPLICATION->IncludeComponent( "abricos:antisovetnik", "", array(), false);
$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = $arResult['NAME'];
$strAlt = $arResult['NAME'];
?>
<div class="bx_item_detail" id="<? echo $arItemIDs['ID']; ?>" itemscope itemtype="http://schema.org/Product">
<?
	/*
if ('Y' == $arParams['DISPLAY_NAME'])
{
?>
<? if (false) : // отключен H1 ?>
	<div class="bx_item_title">
		<h1 itemprop="name">
			<? echo (
				isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && '' != $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
				? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
				: $arResult["NAME"]
			); ?>
		</h1>
	</div>
<? endif; ?>
<?
}	*/
reset($arResult['MORE_PHOTO']);
$arFirstPhoto = current($arResult['MORE_PHOTO']);
?>
	<div class="bx_item_container">
		<div class="bx_lt">
		<? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("icon"); ?>
		<? if($arResult["HIDE_ICON"] != true):?>
			<? if($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 1):?>
			<div class="prop-icon">
				<div class="stickers">
					<span class="sticker_free_shipping_stock" title="<?=getMessage('DICOUNT_TITLE');?>"><?=getMessage('DICOUNT_STIKER_TITLE');?></span>
				</div>
			</div>
			<? endif; ?>
			<? if($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 2):?>
			<div class="prop-icon">
				<div class="stickers">
					<span class="sticker_free_shipping_stock" title="<?=getMessage('DICOUNT_TITLE2');?>"><?=getMessage('DICOUNT_TITLE2_STICKER');?></span>
				</div>
			</div>
			<? endif; ?>
		<? endif; ?>
		<? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("icon"); ?>
	<?
	if(!empty($arResult["DETAIL_PICTURE"])):
			$arResult["IMG"]["BIG"] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 1200, "height" => 1200), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, ["name" => "sharpen", "precision" => 0])["src"];
			if($arResult["DETAIL_PICTURE"]["WIDTH"] >= $arResult["DETAIL_PICTURE"]["HEIGHT"]){
				$arResult["IMG"]["MID"] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 457, "height" => 399), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, ["name" => "sharpen", "precision" => 0],85)["src"];
			}else{
				$arResult["IMG"]["MID"] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 399, "height" => 457), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, ["name" => "sharpen", "precision" => 0],85)["src"];
			}
			$arResult["IMG"]["MIN"] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array("width" => 90, "height" => 90), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, ["name" => "sharpen", "precision" => 0],85)["src"];
	else:
			$arResult["IMG"]["EMPTY"] = "/image/new_design/empty.jpg";
	endif;
	?>
	<div class="bx_item_slider" id="<? echo $arItemIDs['BIG_SLIDER_ID']; ?>">
		<div class="bx_bigimages" id="<? echo $arItemIDs['BIG_IMG_CONT_ID']; ?>">
			<div class="bx_bigimages_imgcontainer">
				<div class="vheight-none"></div>
				<? if(!empty($arResult["IMG"]["MID"])): ?>
				<a data-fancybox href="<?=$arResult["IMG"]["BIG"]; ?>"><img id="<? echo $arItemIDs['PICT']; ?>" src="<?=$arResult["IMG"]["MID"]; ?>" alt="<?=$arResult["NAME"]; ?>" title="<?=$arResult["NAME"]; ?>" itemprop="image" /></a>
				<? else: ?>
				<img id="<? echo $arItemIDs['PICT']; ?>" class="isfirst-click" src="<?=$arResult["IMG"]["EMPTY"]; ?>" alt="<?=$arResult["NAME"]; ?>" title="<?=$arResult["NAME"]; ?>" itemprop="image" />
				<? endif; ?>
				<?if($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 3):?>
				<span class="percent"><?echo '-'; echo $arResult ['PRICES']['BASE']['DISCOUNT_DIFF_PERCENT']; echo '%'; ?></span>
				<?endif;?>
				<?
				if(!empty($arResult['PROPERTIES']['DISCOUNT_PERCENT']['VALUE'])) {
				$percent = abs($arResult['PROPERTIES']['DISCOUNT_PERCENT']['VALUE']);
				if ($percent > 0) {?>
				<span class="percent">-<?=$percent?>%</span>
				<?}
				}
				?>
			</div>
		</div>
	<? if(!empty($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])): ?>
		<div class="min-photos__list">
			<div class="min-photos__img"><div class="vheight-none"></div><a class="isfirst-img" data-fancybox="gallery" href="<?=$arResult["IMG"]["BIG"];?>"><img src="<?=$arResult["IMG"]["MIN"];?>" alt="" /></a></div>
			<? foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $photo): ?>
				<? $isphoto["BIG"] = CFile::ResizeImageGet($photo, array("width" => 1200, "height" => 1200), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, ["name" => "sharpen", "precision" => 0])["src"];
					$isphoto["MIN"] = CFile::ResizeImageGet($photo, array("width" => 90, "height" => 90), BX_RESIZE_IMAGE_EXACT, true, false, ["name" => "sharpen", "precision" => 0])["src"];
				?>
				<div class="min-photos__img"><a data-fancybox="gallery" href="<?=$isphoto["BIG"];?>"><img src="<?=$isphoto["MIN"];?>" alt="" /></a></div>
			<? endforeach; ?>
		</div>
	<? endif; ?>
	</div>
	<? if ($arResult["ACTIVE"] == "N") {?>
		<div class="no-active">
			<img alt="Снято с производства" title="Снято с производства" src="<?=SITE_TEMPLATE_PATH?>/images/snyato.png">
		</div>
	<? } ?>
</div>
	<? include 'top.php'; ?>
	<div class="clear"></div>
	<div class="bx_md">
		<div class="item_info_section">
		<?
		if ('' != $arResult['DETAIL_TEXT'])
		{
		?>
			<div class="bx_item_description">
				<div class="bx_item_section_name_gray" style="border-bottom: 1px solid #f2f2f2;"><? echo GetMessage('FULL_DESCRIPTION'); ?></div>
		<?
			if ('html' == $arResult['DETAIL_TEXT_TYPE'])
			{
				echo $arResult['DETAIL_TEXT'];
			}
			else
			{
				?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?
			}
		?>
			</div>
		<?
		}
		?>
		<?if($arResult["IBLOCK_ID"] == 4 || $arResult["IBLOCK_ID"] == 11):?>
			<div class="bx_item_description">
				<?
				if($arResult['UF_TEXT_4_PRODUCT']){
					$aReplace=$arResult['PLACEHOLDER'];
					if($aReplace!==null && is_array($aReplace))
					foreach($aReplace as $search=>$replace){
						$arResult['UF_TEXT_4_PRODUCT'] = str_replace($search, $replace, $arResult['UF_TEXT_4_PRODUCT']);
					}
			//	echo htmlspecialchars_decode($arResult['UF_TEXT_4_PRODUCT']); текст из основного раздела
				} else {
				echo GetMessage("DETAIL_TEXT", $arResult['PLACEHOLDER']);
				}
				?>
			</div>
		<?endif;?>
		<?/*Floor*/;?>
		<? if($arResult["IBLOCK_ID"] == 9) {
			if($arResult['UF_TEXT_4_PRODUCT']){
				$aReplace=$arResult['PLACEHOLDER'];
				if($aReplace!==null && is_array($aReplace))
				foreach($aReplace as $search=>$replace){
					$arResult['UF_TEXT_4_PRODUCT'] = str_replace($search, $replace, $arResult['UF_TEXT_4_PRODUCT']);
				}
			echo htmlspecialchars_decode($arResult['UF_TEXT_4_PRODUCT']);
			} else {
			echo GetMessage("DETAIL_TEXT_FLOOR", $arResult['PLACEHOLDER']);
			}
		} ?>
		<?/*Floor */;?>

		</div>
	</div>
<? if(!empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])):?>
	<div class="bx_md">
		<div class="item_info_section">
			<iframe width="100%" height="400px" src="https://www.youtube.com/embed/<?=$arResult["PROPERTIES"]["VIDEO"]["VALUE"];?>" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
<? endif;?>
<? /*
	<div class="bx_lb">
		<div class="tab-section-container">
		<?
		if ('Y' == $arParams['USE_COMMENTS'])
		{
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.comments",
			"",
			array(
				"ELEMENT_ID" => $arResult['ID'],
				"ELEMENT_CODE" => "",
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"URL_TO_COMMENT" => "",
				"WIDTH" => "",
				"COMMENTS_COUNT" => "5",
				"BLOG_USE" => $arParams['BLOG_USE'],
				"FB_USE" => $arParams['FB_USE'],
				"FB_APP_ID" => $arParams['FB_APP_ID'],
				"VK_USE" => $arParams['VK_USE'],
				"VK_API_ID" => $arParams['VK_API_ID'],
				"CACHE_TYPE" => $arParams['CACHE_TYPE'],
				"CACHE_TIME" => $arParams['CACHE_TIME'],
				"BLOG_TITLE" => "",
				"BLOG_URL" => "",
				"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
				"EMAIL_NOTIFY" => "N",
				"AJAX_POST" => "Y",
				"SHOW_SPAM" => "Y",
				"SHOW_RATING" => "N",
				"FB_TITLE" => "",
				"FB_USER_ADMIN_ID" => "",
				"FB_APP_ID" => $arParams['FB_APP_ID'],
				"FB_COLORSCHEME" => "light",
				"FB_ORDER_BY" => "reverse_time",
				"VK_TITLE" => "",
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);?>
		<?
		}
		?>
		</div>
	</div>
	<div style="clear: both;"></div>
*/ ?>
</div>
</div>
<?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
	foreach ($arResult['JS_OFFERS'] as &$arOneJS)
	{
		if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
		{
			$arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'] = GetMessage('ECONOMY_INFO', array('#ECONOMY#' => $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF']));
			$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
		}
		$strProps = '';
		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($arOneJS['DISPLAY_PROPERTIES']))
			{
				foreach ($arOneJS['DISPLAY_PROPERTIES'] as $pcode => $arOneProp)
				{
					if (in_array($pcode, array('NIGHT_PRICE', 'MARGIN'))) continue;
					$strProps .= '<dt>'.$arOneProp['NAME'].'</dt><dd>'.(
						is_array($arOneProp['VALUE'])
						? implode(' / ', $arOneProp['VALUE'])
						: $arOneProp['VALUE']
					).'</dd>';
				}
			}
		}
		$arOneJS['DISPLAY_PROPERTIES'] = $strProps;
	}
	if (isset($arOneJS))
		unset($arOneJS);
	$arJSParams = array(
		'CONFIG' => array(
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'NAME' => $arResult['~NAME']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $arSkuProps
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
	{
?>
	<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
	<?
		if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
		{
			foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
			{
	?>
	<input
		type="hidden"
		name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
		value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
	>
	<?
				if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
					unset($arResult['PRODUCT_PROPERTIES'][$propID]);
			}
		}
		$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
		if (!$emptyProductProperties)
		{
	?>
	<table>
	<?
			foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo)
			{
	?>
	<tr><td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
	<td>
	<?
				if(
					'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
					&& 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
				)
				{
					foreach($propInfo['VALUES'] as $valueID => $value)
					{
						?><label><input
							type="radio"
							name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
							value="<? echo $valueID; ?>"
							<? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
						><? echo $value; ?></label><br><?
					}
				}
				else
				{
					?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
					foreach($propInfo['VALUES'] as $valueID => $value)
					{
						?><option
							value="<? echo $valueID; ?>"
							<? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
						><? echo $value; ?></option><?
					}
					?></select><?
				}
	?>
	</td></tr>
	<?
			}
	?>
	</table>
	<?
		}
	?>
	</div>
<?
	}
	$arJSParams = array(
		'CONFIG' => array(
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
		),
		'VISUAL' => array(
			'ID' => $arItemIDs['ID'],
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'PICT' => $arFirstPhoto,
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => false,
			'PRICE' => $arResult['MIN_PRICE'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
			'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
			'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
			'BUY_URL' => $arResult['~BUY_URL'],
		),
		'BASKET' => array(
			'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL']
		)
	);
	unset($emptyProductProperties);
}
?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
BX.message({
	MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCE_CATALOG_BUY')); ?>',
	MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCE_CATALOG_ADD')); ?>',
	MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE')); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
    TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
    BTN_CONTINUE_SHOPPING: '<? echo GetMessageJS('CONTINUE_SHOPPING'); ?>',
    BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>'
});
</script>