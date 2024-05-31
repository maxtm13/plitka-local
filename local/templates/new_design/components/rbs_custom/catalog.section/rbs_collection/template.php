<?php global $sotbitSeoMetaTopDesc;//для установки верхнего описания
global $sotbitSeoMetaBottomDesc;//для установки нижнего описания
echo $sotbitSeoMetaTopDesc;
?>
<?
/*---bgn 2017-02-07 Сортировка---*/
if (count($arResult['ITEMS'])) {
	$SRT_P = 'ASC';
	$SRT_D = 'ASC';
	$SRT_N = 'ASC';
	$SRT_PO = 'ASC';
	$sp = 'a';
	$sd = 'a';
	$sn = 'a';
	$spo = 'a';
	switch($_REQUEST['s']) {
		case 'pa':
			$SRT_P = 'DESC';
			$sp = 'd';
			break;
		case 'pd':
			$SRT_P = 'ASC';
			$sp = 'a';
			break;
		case 'da':
			$SRT_D = 'DESC';
			$sd = 'd';
			break;
		case 'dd':
			$SRT_D = 'ASC';
			$sd = 'a';
			break;
		case 'na':
			$SRT_N = 'DESC';
			$sn = 'd';
			break;
		case 'nd':
			$SRT_N = 'ASC';
			$sn = 'a';
			break;
		case 'poa':
			$SRT_PO = 'DESC';
			$spo = 'd';
			break;
		case 'pod':
			$SRT_PO = 'ASC';
			$spo = 'a';
			break;
	} ?>
	<? if (($arResult["IBLOCK_ID"] == 11) or ($arResult["IBLOCK_ID"] == 9)){ ?>
		<div class="sec-sort">
			<span class="sort-param">
				<?php echo GetMessage('SORTING'); ?>:
			</span>
			<? /*<span class="sort-param">
				<a href="<?php echo $APPLICATION->GetCurPageParam('', array('s')); ?>"><?php echo GetMessage('BY_DEFAULT'); ?></a>
			</span>*/ ?>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('pod', 'poa'))) { echo ' active'; } ?>">
				<a href="<?php if ($_REQUEST['s'] != 'pod') echo $APPLICATION->GetCurPageParam('s=po'.$spo, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_PO); ?>"><?php echo GetMessage('BY_POPULARITY'); ?></a>
				<? /*<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pod') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pod', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
				<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'poa') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=poa', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>*/ ?>
			</span>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && ($_REQUEST['s'] == 'pa')) { echo ' active'; } ?>">
				<a href="<?php if ($_REQUEST['s'] != 'pa') echo $APPLICATION->GetCurPageParam('s=p'.$sp, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_P); ?>"><?php echo GetMessage('BY_PRICE_CHEAP'); ?></a>
				<? /*<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
				<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pa') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pa', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>*/ ?>
			</span>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && ($_REQUEST['s'] == 'pd')) { echo ' active'; } ?>">
				<a href="<?php if ($_REQUEST['s'] != 'pd'){
					if ($sp='a') $sp='d';
					echo $APPLICATION->GetCurPageParam('s=p'.$sp, array('s')); }
				?>" title="<?php echo GetMessage('SORT_'.$SRT_P); ?>"><?php echo GetMessage('BY_PRICE_EXP'); ?></a>
				<? /*<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
				<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pa') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pa', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>*/ ?>
			</span>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('na', 'nd'))) { echo ' active'; } ?>">
				<a href="<?php if ($_REQUEST['s'] != 'na') echo $APPLICATION->GetCurPageParam('s=n'.$sn, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_N); ?>"><?php echo GetMessage('BY_NAME'); ?></a>
				<? /*<a class="ico-sort-abc-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'na') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=na', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>
				<a class="ico-sort-abc-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'nd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=nd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>*/ ?>
			</span>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('dd', 'da'))) { echo ' active'; } ?>">
				<a href="<?php if ($_REQUEST['s'] != 'da') echo $APPLICATION->GetCurPageParam('s=d'.$sd, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_D); ?>"><?php echo GetMessage('BY_DATE_NEW'); ?></a>
				<? /*<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'dd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=dd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
				<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'da') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=da', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>*/ ?>
			</span>
		</div>
	<? } ?>
<?php }
/*---end 2017-02-07---*/ ?>

<?php /*---bgn 2018-06-13---*/
if (!empty($arResult['GROUP_LINKS'])) {
	echo str_replace('OTHER', GetMessage('GROUP_OTHER_TITLE'), $arResult['GROUP_LINKS']);
}
/*---end 2018-06-13---*/ ?>
<img src="<? echo $arResult['PICTURE']['SRC']; ?>" alt="" tabindex="0" class="zoom-images <?=(empty($arResult['UF_MORO_PHOTO'])) ? "" : "equal-images"; ?>"/>
<?if(!empty($arResult['UF_MORO_PHOTO'])):
	$tabindex = 1;
	?>
	<?foreach($arResult['UF_MORO_PHOTO'] as $photo): ?>
		<img src="<?= $photo['src']?>" alt="" class="zoom-images equal-images" tabindex="<?= $tabindex++?>" />
	<?endforeach;?>	
<?endif;?>
<br>
<br>
<br>
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
if (!empty($arResult['ITEMS']))
{
	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);

	CJSCore::Init(array("popup"));
	$arSkuTemplate = array();
	if (!empty($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as &$arProp)
		{
			ob_start();
			if ('TEXT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_size full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_size';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				?>
				<div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
					<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
					<div class="bx_size_scroller_container">
						<div class="bx_size">
							<ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;">
								<?
								foreach ($arProp['VALUES'] as $arOneValue)
								{
									?><li
										data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
										data-onevalue="<? echo $arOneValue['ID']; ?>"
										style="width: <? echo $strOneWidth; ?>;"
									><i></i><span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span></li><?
								}
								?>
							</ul>
						</div>
						<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
						<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					</div>
				</div>
			<?
			}
			elseif ('PICT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_scu full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_scu';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				?>
				<div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
					<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
					<div class="bx_scu_scroller_container">
						<div class="bx_scu">
							<ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;">
								<?
								foreach ($arProp['VALUES'] as $arOneValue)
								{
									?><li
										data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
										data-onevalue="<? echo $arOneValue['ID']; ?>"
										style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
										><i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
										<span class="cnt"><span class="cnt_item"
										style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
										title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
									></span></span></li><?
								}
								?>
							</ul>
						</div>
						<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
						<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					</div>
				</div>
			<?
			}
			$arSkuTemplate[$arProp['CODE']] = ob_get_contents();
			ob_end_clean();
		}
		unset($arProp);
	}

	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
	
	/*---bgn 2018-06-13---*/
	$curGroup = $arResult['ITEMS'][0]['GROUP_INFO']['NAME'];
	if (!empty($arResult['GROUP_ITEMS'])) { ?>
		<a name="<?php echo $arResult['ITEMS'][0]['GROUP_INFO']['ID']; ?>"></a>
		<div class="groupName"><?php echo $curGroup; ?></div>
	<?php }
	/*---end 2018-06-13---*/ ?>
	<div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>" itemscope itemtype="http://schema.org/ItemList">
		<?
		$w = 200; $h = 400;
		$now = time();
		$week_day = date('N', $now);
		$hour = intval(date('H', $now));
		$minutes = intval(date('i', $now));
		foreach ($arResult['ITEMS'] as $key => $arItem)
		{
			/*---bgn 2018-06-13---*/
			if (!empty($arResult['GROUP_ITEMS']) && $arItem['GROUP_INFO']['NAME'] != $curGroup) { ?>
					<div style="clear: both;"></div>
				</div>
				<a name="<?php echo $arItem['GROUP_INFO']['ID']; ?>"></a>
				<div class="groupName"><?php echo (($arItem['GROUP_INFO']['NAME'] == 'OTHER') ? GetMessage('GROUP_OTHER_TITLE') : $arItem['GROUP_INFO']['NAME']); ?></div>
				<div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>" itemscope itemtype="http://schema.org/ItemList">
				<?php $curGroup = $arItem['GROUP_INFO']['NAME'];
			}
			/*---end 2018-06-13---*/
		
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
			$strMainID = $this->GetEditAreaId($arItem['ID']);

			$arItemIDs = array(
				'ID' => $strMainID,
				'PICT' => $strMainID.'_pict',
				'SECOND_PICT' => $strMainID.'_secondpict',

				'QUANTITY' => $strMainID.'_quantity',
				'QUANTITY_DOWN' => $strMainID.'_quant_down',
				'QUANTITY_UP' => $strMainID.'_quant_up',
				'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
				'BUY_LINK' => $strMainID.'_buy_link',
			//	'SUBSCRIBE_LINK' => $strMainID.'_subscribe',

				'PRICE' => $strMainID.'_price',
				'DSC_PERC' => $strMainID.'_dsc_perc',
				'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',

				'PROP_DIV' => $strMainID.'_sku_tree',
				'PROP' => $strMainID.'_prop_',
				'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
				'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
			);

			$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

			$strTitle = (
				isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
				? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
				: $arItem['NAME']
			);
	
			$img = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>$w, 'height'=>$h), BX_RESIZE_IMAGE_PROPORTIONAL);
			
			//проверим ночная цена или нет
			if ($arItem['PROPERTIES']['NIGHT_PRICE']['VALUE'] == 1 && (($hour >= 20 && $minutes >= 45) || ($hour <= 8 && $minutes < 30))) {
				$nightPrice = true;
			} else {
				$nightPrice = false;
			}
			?>
			<div class="<? echo ($arItem['SECOND_PICT'] ? 'bx_catalog_item double' : 'bx_catalog_item'); ?>" itemscope itemtype="http://schema.org/Product" itemprop="itemListElement">
				<meta itemprop='category' content="<?php echo $arResult['NAME']; ?>" />
				<?php if (!empty($img['src'])) {
					if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
						$http = $_SERVER['HTTP_X_FORWARDED_PROTO'];
					} else {
						$http = !empty($_SERVER['HTTPS']) ? "https" : "http";
					} ?>
					<meta itemprop="image" content="<?php echo $http.'://'.SITE_SERVER_NAME.$img['src']; ?>" />
				<?php } ?>
				<div class="bx_catalog_item_container" id="<? echo $strMainID; ?>">
					<div class="prop-icon">
						<?//при ночной цене скидка не показывается
						   if($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 1 && !$nightPrice):?>
                            <span class="prop-ico-discount" title="<?= GetMessage("DICOUNT_TITLE")?>"></span>
                        <? // значение 2 при ночной цене скидка не показывается и отключает скидку показывает только бесплатная доставка
						elseif($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 2 && !$nightPrice):?>
                            <span class="prop-ico-discount3" title="<?= GetMessage("DICOUNT_TITLE2")?>"></span>
						<? // значение 3 выключает картинку скидки, но показывает процент %
						elseif($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 3 ):?>
                            <span class="prop-ico-discount-display-none" title="<?= GetMessage("DICOUNT_TITLE2")?>"></span>
                        <?endif;?>				
						<?if(!empty($arItem['PROPERTIES']['HITS']['VALUE'])):?>
							<span class="prop-ico-hit" title="<?= GetMessage("HIT_TITLE")?>"></span>
						<?endif;?>			
						<?if(!empty($arItem['PROPERTIES']['SAMPLE']['VALUE'])):?>
							<span class="prop-ico-sample" title="<?= GetMessage("SAMPLE_TITLE")?>"></span>
						<?endif;?>	
					</div>
					<!--Добавил альты-->
					<!--<a id="<? echo $arItemIDs['PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images" style="background-image: url(<? echo /*$arItem['PREVIEW_PICTURE']['SRC'];*/ $img['src']; ?>)" title="<? echo $strTitle; ?>">
						<?
						if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
						{
						?>
							<div
								id="<? echo $arItemIDs['DSC_PERC']; ?>"
								class="bx_stick_disc right bottom"
								style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
						<?
						}
						if ($arItem['LABEL'])
						{
						?>
								<div class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
						<?
						}
						?>
					</a>-->
<a  id="<? echo $arItemIDs['PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images">
	<img src="<?=$img['src']?>" alt="<?=$strTitle?>" class="catalog_item_img" />
	<?
	if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
	{
	?>
		<div
			id="<? echo $arItemIDs['DSC_PERC']; ?>"
			class="bx_stick_disc right bottom"
			style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
	<?
	}
	if ($arItem['LABEL'])
	{
	?>
			<div class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
	<?
	}
	?>
</a>
					<?
					if ($arItem['SECOND_PICT'])
					{
						$pic = !empty($arItem['PREVIEW_PICTURE_SECOND']) ? $arItem['PREVIEW_PICTURE_SECOND']['ID'] : $arItem['PREVIEW_PICTURE']['ID'];
						$img = CFile::ResizeImageGet($pic, array('width'=>$w, 'height'=>$h), BX_RESIZE_IMAGE_PROPORTIONAL);
						?>
						<a id="<? echo $arItemIDs['SECOND_PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images_double" style="background-image: url(<? /*echo (!empty($arItem['PREVIEW_PICTURE_SECOND']) ? $arItem['PREVIEW_PICTURE_SECOND']['SRC'] : $arItem['PREVIEW_PICTURE']['SRC']);*/ echo $img['src']; ?>)" title="<? echo $strTitle; ?>">
							<?
							if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
							{
							?>
								<div
									id="<? echo $arItemIDs['SECOND_DSC_PERC']; ?>"
									class="bx_stick_disc right bottom"
									style="display:<? echo (0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
							<?
							}
							if ($arItem['LABEL'])
							{
							?>
								<div class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
							<?
							}
							?>
						</a>
					<?
					}
					?>
					<div>
					<?//при ночной цене скидка не показывается
						   if($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 1 && !$nightPrice):?>
                            <div class="discount-call2"><!--noindex--><?php echo '<p class="action-text">Акция! Позвоните и узнайте скидку у менеджера! Гарантия минимальной цены!</p>'?><!--/noindex--></div>
                        <? // значение 2 при ночной цене скидка не показывается и отключает скидку
						elseif($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 2 && !$nightPrice):?>
                           <div class="discount-call2"><!--noindex--><?php echo '<p class="action-text">Акция! Беспатная доставка!</p>'?><!--/noindex--></div>
                        <?endif;?>				
					
					</div>
					<div class="bx_catalog_item_title" itemprop="name">
						<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $arItem['NAME']; ?>" itemprop="url"><? echo $arItem['NAME']; ?></a>
					</div>
					<meta itemprop="description" content="<? echo $arItem['NAME']; ?>" />
					<div class="bx_catalog_item_price" itemprop = "offers" itemscope itemtype = "http://schema.org/Offer">
						<? /*print_r($arItem['DISPLAY_PROPERTIES']);*/ ?>
						<meta itemprop = "price" content="<?php echo $arItem['MIN_PRICE']['DISCOUNT_VALUE']; ?>" />
						<meta itemprop="priceCurrency" content="<?php echo $arItem['MIN_PRICE']['CURRENCY']; ?>" />
						<div id="<? echo $arItemIDs['PRICE']; ?>" class="bx_price">
							<?php if (!empty($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID']) && in_array($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) {
								echo $arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['DISPLAY_VALUE'];
							} else {
								/*if (!empty($arItem["DISPLAY_PROPERTIES"]["RECOMMENDED_PRICE"]["VALUE"])) {
								  echo GetMessage("CALL_FOR_PRICE");
								}
								else*/ if (!empty($arItem['MIN_PRICE']))
								{
									if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
									{
										echo GetMessage(
											'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
											array(
												'#PRICE#' => $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'],
												'#MEASURE#' => GetMessage(
													'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
													array(
														'#VALUE#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_RATIO'],
														'#UNIT#' => $arItem['MIN_PRICE']['CATALOG_MEASURE_NAME']
													)
												)
											)
										);
									}
									else
									{
										echo $arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
									}
									if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE'])
									{
										?> <span><? echo $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span><?
									}
								}
							} ?><?
                                      if (!in_array($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))){ //проверка наличия 
                                      echo " / {$arItem['CATALOG_MEASURE_NAME']} "; // выводит ед .изм
                                    } ?>
							<? echo  $arItem['VALUE']; ?>
																				
						</div>
						
					</div>
					<?
					if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS']))
					{
					?>
						<div class="bx_catalog_item_controls">
							<?
							if ($arItem['CAN_BUY'] && !in_array($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649)))
							{
								if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
								{
								?>
									<?/*---bgn 2017-04-14---*/?>
									<?php $units_recalc = false;
									//2018-01-17 корректировка: получение размеров из SIZE_WIDTH и SIZE_LENGTH
									if ( ($arItem['CATALOG_MEASURE_NAME'] == 'кв. м.' || $arItem['CATALOG_MEASURE_NAME'] == 'шт.') && /*!empty($arItem['DISPLAY_PROPERTIES']['SIZE'])*/ !empty($arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['VALUE']) && $arParams['IBLOCK_ID'] == CATALOG_ID) {
										/*$itemSize = str_replace(array('х', ',', ','), array('x', '.', '.'), strtolower($arItem['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']));
										$itemSize = explode('x', $itemSize);*/
										$itemSize =array(
											0 => trim(str_replace(',', '.', $arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'])),
											1 => trim(str_replace(',', '.', $arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE']))
										);
										if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
											$units_recalc = true;
										}
										$activeUnit = $arItem['CATALOG_MEASURE_NAME'] == 'кв. м.' ? 'm' : 'i';
									} ?>
									<?/*---end 2017-04-14---*/?>
									<div class="bx_catalog_item_controls_blockone"><div style="display: inline-block;position: relative;">
										<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
										<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>"<?/*---bgn 2017-04-14---*/?> data-key="<?php echo $key; ?>"<?php if ($units_recalc) { ?> style="display: none;"<?php } ?><?/*---end 2017-04-14---*/?>>
										<?/*---bgn 2017-04-14---*/?>
										<?php if ($units_recalc) { ?>
											<input class="cm-input unit-quantity-<?php echo $key; ?>" data-key="<?php echo $key; ?>" type="text" value="<? echo (isset($arItem['OFFERS']) && !empty($arItem['OFFERS']) ? 1 : $arItem['CATALOG_MEASURE_RATIO']); ?>" data-dunit='<?=$activeUnit?>'>
										<?php } ?>
										<?/*---end 2017-04-14---*/?>
										<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
										<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"<?/*---bgn 2017-04-14---*/?><?php if ($units_recalc) { ?> class="hidden"<?php } ?><?/*---end 2017-04-14---*/?>><? echo $arItem['CATALOG_MEASURE_NAME']; ?></span>
									</div></div>
									<?/*---bgn 2017-04-14---*/?>
									<?php if ($units_recalc) {
										$itemSize[0] = floatval($itemSize[0]) / 100; //см. в м.
										$itemSize[1] = floatval($itemSize[1]) / 100; //см. в м.
										$sqr = $itemSize[0] * $itemSize[1]; //площадь ?>
										<div class="calc-measures-<?php echo $key; ?>" data-inpt="<? echo $arItemIDs['QUANTITY']; ?>" data-w="<?php echo $itemSize[0]; ?>" data-h="<?php echo $itemSize[1]; ?>" data-sqr="<?php echo $sqr; ?>" data-pac="<?php echo (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) ? $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['DISPLAY_VALUE'] : 0; ?>" data-key="<?php echo $key; ?>" data-dunit='<?=$activeUnit?>'>
											<a <?if ($activeUnit == 'm'):?>class="active"<?endif?> href="javascript:void(0)" data-unit="m">кв. м.</a>
											<a <?if ($activeUnit == 'i'):?>class="active"<?endif?> href="javascript:void(0)" data-unit="i">шт.</a>
											<?php /*if (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) { ?>
												<a href="javascript:void(0)" data-unit="p">упак.</a>
											<?php }*/ ?>
											<?/*<div class="hidden">в упаковке <?php echo $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE']; ?> шт. = <?php echo (intval($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * 10000) / 10000).' '.$arItem['CATALOG_MEASURE_NAME']; ?></div>*/?>
										</div><br/>
									<?php } ?>
									<?/*---end 2017-04-14---*/?>
								<?
								}
								?>
								<div class="bx_catalog_item_controls_blocktwo">
									<a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium" href="javascript:void(0)" rel="nofollow" onclick = "yaCounter24968570.reachGoal('click_kupit'); ga('send', 'pageview', '/click_kupit');"><?
									echo ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
									?></a>
								</div>
								<?
							}
							else
							{
							?>
								<!-- RBS_CUSTOM_START -->
									<?
										$itId = $arItem['ID']?:0;
										$SelFeedBack = '#rbs_feedback_'.$itId;
										$SelForm     = '#rbs_form_feedback_'.$itId;
										$idFeedBack  = 'rbs_feedback_'.$itId;
										$idForm      = 'rbs_form_feedback_'.$itId;
										$callPop     = 'pop'.$itId;
										$callPops    = $callPop.'.show();';
										$popName     = 'rbs-feedback-popup '.$itId;
									?>									
									<div class="rbs_list rbs-btn-feedback-available" onClick="<?=$callPops?>">Сообщить о поступлении</div>
									<script>
										var <?=$callPop?> = BX.PopupWindowManager.create('<?=$popName?>', null, {
											autoHide: false,
											offsetLeft: 0,
											offsetTop: 0,
											overlay : true,
											closeByEsc: true,
											titleBar: true,
											closeIcon: {top: '10px', right: '10px'},
											content: 
												'<div class="" id="">'+
													'Оставьте вашу почту для оповщенеия о поступлении товара' +
												'</div>'+
												'<div class="rbs-content-feedback-form" id="<?=$idFeedBack?>">'+
													'<form method="POST" id="<?=$idForm?>" align="center">'+
														'<input type="email" name="email" placeholder="example@email.ru" required>'+
														'<input type="hidden" name="num" value="'+<?=$itId?>+'">'+
														'<input type="submit" value="Отправить">'+
													'</form>'+
												'</div>',
											titleBar: 'Сообщить о поступлении товара'
										});
										
										
										$('<?=$SelForm?>').on('submit', function(e){
											
											$.ajax({
												url: "/include/rbs_ajax_feedback.php",
												dataType: "json",
												type: 'POST',
												method: 'POST',
												data: $(this).serialize(),
												success: function(data){
													if(data.TYPE == 'OK'){
														$('<?=$SelFeedBack?>').addClass('rbs-success-msg');
													} else {
														$('<?=$SelFeedBack?>').addClass('rbs-error-msg');
													}

													$('<?=$SelFeedBack?>').html(data.TEXT);
												},
												error: function(){
													$('<?=$SelFeedBack?>').addClass('rbs-error-msg');
													$('<?=$SelFeedBack?>').html('Упс! Возникла ошибка, попробуйте перезагрузить страницу и попробовать снова.');
												}
											});
											return false;
										});
									</script>
								<!-- RBS_CUSTOM_END -->
								<div class="bx_catalog_item_controls_blockone">
									<!--span class="bx_notavailable"><? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?></span-->
								</div>
							<?
							}
							?>
							<div style="clear: both;"></div>
						</div>
						<?
						if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']))
						{
						?>
							<div class="bx_catalog_item_articul">
							<? //2018-01-17 добавлено объединение SIZE_WIDTH и SIZE_LENGTH
							$hasSize = false;
							foreach ($arItem['DISPLAY_PROPERTIES'] as $pid => $arOneProp)
							{
								if (/*$pid == 'AVAILABILITY' || $pid == 'RECOMMENDED_PRICE'*/ in_array($pid, array('AVAILABILITY', 'RECOMMENDED_PRICE', 'NIGHT_PRICE', 'MARGIN', 'SIZE', 'SAMPLE'))) continue;
								if (in_array($pid, array('SIZE_WIDTH', 'SIZE_LENGTH'))) {
									if (!$hasSize) { ?>
										<br><div class="bx_catalog_item_articul_23"><? echo GetMessage('PROP_SIZE_NAME'); ?>:</div> <?
											switch ($pid) {
												case 'SIZE_WIDTH':
													echo $arOneProp['DISPLAY_VALUE'].'x'.$arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE'];
													break;
												case 'SIZE_LENGTH':
													echo $arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'].'x'.$arOneProp['DISPLAY_VALUE'];
													break;
											}
											$hasSize = true;
									}
								} else { ?>
									<br><div class="bx_catalog_item_articul_23"><? echo $arOneProp['NAME']; ?>:</div> <?
										echo (
											is_array($arOneProp['DISPLAY_VALUE'])
											? implode('<br>', $arOneProp['DISPLAY_VALUE'])
											: $arOneProp['DISPLAY_VALUE']
										);
								}
							}
							?>
							</div>
						<?
						}
						$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
						if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
						{
						?>
							<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
								<?
								if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
								{
									foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
									{
									?>
										<input
											type="hidden"
											name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
											value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
											>
										<?
										if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
											unset($arItem['PRODUCT_PROPERTIES'][$propID]);
									}
								}
								$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
								if (!$emptyProductProperties)
								{
								?>
									<table>
										<?
										foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
										{
										?>
											<tr>
												<td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
												<td>
													<?
													if(
														'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
														&& 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
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
												</td>
											</tr>
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
							'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
							'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
							'SHOW_ADD_BASKET_BTN' => false,
							'SHOW_BUY_BTN' => true,
							'SHOW_ABSENT' => true,
							'PRODUCT' => array(
								'ID' => $arItem['ID'],
								'NAME' => $arItem['~NAME'],
								'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
								'CAN_BUY' => $arItem["CAN_BUY"],
								'SUBSCRIPTION' => "N",
								'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
								'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
								'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
								'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
								'ADD_URL' => $arItem['~ADD_URL'],
							//	'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
							),
							'BASKET' => array(
								'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
								'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
								'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
								'EMPTY_PROPS' => $emptyProductProperties
							),
							'VISUAL' => array(
								'ID' => $arItemIDs['ID'],
								'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
								'QUANTITY_ID' => $arItemIDs['QUANTITY'],
								'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
								'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
								'PRICE_ID' => $arItemIDs['PRICE'],
								'BUY_ID' => $arItemIDs['BUY_LINK'],
								'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV']
							),
							'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
						);
						unset($emptyProductProperties);
						?>
						<script type="text/javascript">
							var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
						</script>
						<?
					}
					else
					{
						if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
						{
						?>
							<div class="bx_catalog_item_controls no_touch">
								<?
								if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
								{
								?>
									<?/*---bgn 2017-04-14---*/?>
									<?php $units_recalc = false;
									if ($arItem['CATALOG_MEASURE_NAME'] == 'кв. м.' && !empty($arItem['DISPLAY_PROPERTIES']['SIZE']) && $arParams['IBLOCK_ID'] == CATALOG_ID) {
										$itemSize = str_replace(array('х', ',', ','), array('x', '.', '.'), strtolower($arItem['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']));
										$itemSize = explode('x', $itemSize);
										if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
											$units_recalc = true;
										}
									} ?>
									<?/*---end 2017-04-14---*/?>
									<div class="bx_catalog_item_controls_blockone">
										<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
										<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>"<?/*---bgn 2017-04-14---*/?> data-key="<?php echo $key; ?>"<?php if ($units_recalc) { ?> style="display: none;"<?php } ?><?/*---end 2017-04-14---*/?>>
										<?/*---bgn 2017-04-14---*/?>
										<?php if ($units_recalc) { ?>
											<input class="cm-input unit-quantity-<?php echo $key; ?>" data-key="<?php echo $key; ?>" type="text" value="<? echo (isset($arItem['OFFERS']) && !empty($arItem['OFFERS']) ? 1 : $arItem['CATALOG_MEASURE_RATIO']); ?>">
										<?php } ?>
										<?/*---end 2017-04-14---*/?>
										<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
										<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"<?/*---bgn 2017-04-14---*/?><?php if ($units_recalc) { ?> class="hidden"<?php } ?><?/*---end 2017-04-14---*/?>></span>
									</div>
									<?/*---bgn 2017-04-14---*/?>
									<?php if ($units_recalc) {
										$itemSize[0] = floatval($itemSize[0]) / 100; //см. в м.
										$itemSize[1] = floatval($itemSize[1]) / 100; //см. в м.
										$sqr = $itemSize[0] * $itemSize[1]; //площадь ?>
										<div class="calc-measures-<?php echo $key; ?>" data-inpt="<? echo $arItemIDs['QUANTITY']; ?>" data-w="<?php echo $itemSize[0]; ?>" data-h="<?php echo $itemSize[1]; ?>" data-sqr="<?php echo $sqr; ?>" data-pac="<?php echo (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) ? $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['DISPLAY_VALUE'] : 0; ?>" data-key="<?php echo $key; ?>">
											<a class="active" href="javascript:void(0)" data-unit="m"><?php echo $arItem['CATALOG_MEASURE_NAME']; ?></a>
											<a href="javascript:void(0)" data-unit="i">шт.</a>
											<?php /*if (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) { ?>
												<a href="javascript:void(0)" data-unit="p">упак.</a>
											<?php }*/ ?>
											<?/*<div class="hidden">в упаковке <?php echo $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE']; ?> шт. = <?php echo (intval($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * 10000) / 10000).' '.$arItem['CATALOG_MEASURE_NAME']; ?></div>*/?>
										</div><br/>
									<?php } ?>
									<?/*---end 2017-04-14---*/?>
								<?
								}
								?>
								<div class="bx_catalog_item_controls_blocktwo">
									<a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium" href="javascript:void(0)" rel="nofollow"><?
									echo ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
									?></a>
								</div>
								<div style="clear: both;"></div>
							</div>
						<?
						}
						else
						{
						?>
							<div class="bx_catalog_item_controls no_touch">
								<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
								echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
								?></a>
							</div>
						<?
						}
						?>
						<div class="bx_catalog_item_controls touch">
							<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
							echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
							?></a>
						</div>
						<?
						$boolShowOfferProps = ('Y' == $arParams['PRODUCT_DISPLAY_MODE'] && $arItem['OFFERS_PROPS_DISPLAY']);
						$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
						if ($boolShowProductProps || $boolShowOfferProps)
						{
						?>
							<div class="bx_catalog_item_articul">
								<?
								if ($boolShowProductProps)
								{
									//2018-01-17 добавлено объединение SIZE_WIDTH и SIZE_LENGTH
									$hasSize = false;
									foreach ($arItem['DISPLAY_PROPERTIES'] as $pid => $arOneProp)
									{
										if (/*$pid == 'AVAILABILITY'*/ in_array($pid, array('AVAILABILITY', 'NIGHT_PRICE', 'MARGIN', 'SIZE', 'SAMPLE'))) continue;
										if (in_array($pid, array('SIZE_WIDTH', 'SIZE_LENGTH'))) {
											if (!$hasSize) { ?>
												<br><div class="bx_catalog_item_articul_23"><? echo GetMessage('PROP_SIZE_NAME'); ?>:</div> <?
													switch ($pid) {
														case 'SIZE_WIDTH':
															echo $arOneProp['DISPLAY_VALUE'].'x'.$arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE'];
															break;
														case 'SIZE_LENGTH':
															echo $arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'].'x'.$arOneProp['DISPLAY_VALUE'];
															break;
													}
													$hasSize = true;
											}
										} else { ?>
											<br><div class="bx_catalog_item_articul_23"><? echo $arOneProp['NAME']; ?>:</div> <?
											echo (
												is_array($arOneProp['DISPLAY_VALUE'])
												? implode(' / ', $arOneProp['DISPLAY_VALUE'])
												: $arOneProp['DISPLAY_VALUE']
											);
										}
									}
								}
								if ($boolShowOfferProps)
								{
								?>
									<span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
								<?
								}
								?>
							</div>
						<?
						}
						if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
						{
							if (!empty($arItem['OFFERS_PROP']))
							{
								$arSkuProps = array();
								?>
								<div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>">
									<?
									foreach ($arSkuTemplate as $code => $strTemplate)
									{
										if (!isset($arItem['OFFERS_PROP'][$code]))
											continue;
										echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
									}
									foreach ($arResult['SKU_PROPS'] as $arOneProp)
									{
										if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
											continue;
										$arSkuProps[] = array(
											'ID' => $arOneProp['ID'],
											'SHOW_MODE' => $arOneProp['SHOW_MODE'],
											'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
										);
									}
									foreach ($arItem['JS_OFFERS'] as &$arOneJs)
									{
										if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
											$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
									}
									unset($arOneJs);
									?>
								</div>
								<?
								if ($arItem['OFFERS_PROPS_DISPLAY'])
								{
									foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
									{
										$strProps = '';
										if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
										{
											foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
											{
												$strProps .= '<br>'.$arOneProp['NAME'].' <strong>'.(
													is_array($arOneProp['VALUE'])
													? implode(' / ', $arOneProp['VALUE'])
													: $arOneProp['VALUE']
												).'</strong>';
											}
										}
										$arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
									}
								}
								$arJSParams = array(
									'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
									'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
									'SHOW_ADD_BASKET_BTN' => false,
									'SHOW_BUY_BTN' => true,
									'SHOW_ABSENT' => true,
									'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
									'SECOND_PICT' => $arItem['SECOND_PICT'],
									'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
									'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
									'DEFAULT_PICTURE' => array(
										'PICTURE' => $arItem['PRODUCT_PREVIEW'],
										'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
									),
									'VISUAL' => array(
										'ID' => $arItemIDs['ID'],
										'PICT_ID' => $arItemIDs['PICT'],
										'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
										'QUANTITY_ID' => $arItemIDs['QUANTITY'],
										'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
										'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
										'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
										'PRICE_ID' => $arItemIDs['PRICE'],
										'TREE_ID' => $arItemIDs['PROP_DIV'],
										'TREE_ITEM_ID' => $arItemIDs['PROP'],
										'BUY_ID' => $arItemIDs['BUY_LINK'],
										'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
										'DSC_PERC' => $arItemIDs['DSC_PERC'],
										'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
										'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
									),
									'BASKET' => array(
										'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
										'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
										'SKU_PROPS' => $arItem['OFFERS_PROP_CODES']
									),
									'PRODUCT' => array(
										'ID' => $arItem['ID'],
										'NAME' => $arItem['~NAME']
									),
									'OFFERS' => $arItem['JS_OFFERS'],
									'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
									'TREE_PROPS' => $arSkuProps,
									'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
								);
								?>
								<script type="text/javascript">
									var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
								</script>
							<?
							}
						}
					}
					?>
				</div>
			</div>
		<?
		}
		?>
		<div style="clear: both;"></div>
	</div>



	<script type="text/javascript">
		BX.message({
			MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_BUY')); ?>',
			MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
			MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
			BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
			BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
			ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
			TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
			TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
			TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
			BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
			BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
			BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
			BTN_CONTINUE_SHOPPING: '<? echo GetMessageJS('CONTINUE_SHOPPING'); ?>'
		});
	</script>

	<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}



//if(true): 
//if(isset($_GET['test'])): 
echo '<div class="drugie">';
	
	//print_r($arResult['ID']);
	//echo "<hr>sdasd";
//if(true): 
/*echo '<pre style="display: none;">';
	echo $arResult['IBLOCK_SECTION_ID'];
echo '</pre>';*/
	global $arrFilter;
	$arrFilter=array("ID" => '31470');
	if(!empty($arResult['ITEMS'])):
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"section-list-catalog2",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
			"SECTION_CODE" => "",
			"COUNT_ELEMENTS" => "N",
			"TOP_DEPTH" => "3",
			"SECTION_FIELDS" => array("",""),
			"VIEW_MODE" => "TILE",
			"SHOW_PARENT_NAME" => 'Y',
			"SECTION_URL" => "",
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"HIDE_SECTION_NAME" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"USE_FILTER" => "Y",
			"FILTER_NAME" => "arrFilter",
			"CUR_ID" => $arResult['ID'],
			"SECTION_COUNT" => "1",
			"SECTION_USER_FIELDS" => array("UF_HEADER", "UF_MORO_PHOTO","UF_TOPTEXT"),
			"PAGER_TEMPLATE" => "arrows",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Разделы",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "Y",
			"COMPATIBLE_MODE" => "Y",
		),
		$component
	);
	endif; 
	//echo "<hr>";
	
//endif; 

echo '</div>';



//display section description only on page number 1
$getParamPagen = 0;
foreach($_GET as $getParamKey=>$getParamVal) {
	if (substr_count($getParamKey, 'PAGEN_') != 0) {
		$getParamPagen = $getParamVal;
	}
}


/*$arResult['NAV_RESULT']->NavPageNomer == 1*/
if ($getParamPagen < 2) { 
	if(!$arResult['DESCRIPTION'] && $arResult['IBLOCK_ID']==15 && $_SERVER['REQUEST_URI']!='/sukhie-stroitelnye-smesi/'){
		echo "<p>Современные строительные, а также отделочные и ремонтные работы невозможно представить без сухих смесей, которые в буквальном смысле являются базой. Традиционно в составе присутствуют нейтральные и абсолютно безопасные наполнители и специальные добавки для улучшения определенных свойств. Поэтому выбирать составы необходимо исходя из особенностей условий эксплуатации, таких как температурно-влажностной режим, наличие постоянных механических нагрузок, интенсивное воздействие солнечных лучей и других факторов.</p><p>{$arResult['NAME']} — качественный стабильный состав, который обеспечит быстрое выполнение необходимых операций за счет экономичности и легкости использования. Технология разведения проста, главное — соблюдать пропорции. Нанесение также не представляет большой сложности. При наличии определенного опыта все получается максимально оперативно без ущерба для качества. {$arResult['NAME']} — очень востребованная продукция. Причина кроется не только в прекрасных эксплуатационных качествах, но и в доступной цене.</p>";
	}
	else if (empty(trim($sotbitSeoMetaBottomDesc)) && empty($_GET)){
		echo $arResult['DESCRIPTION'];
	}

} else {
	print '<p>&nbsp;</p>';
}

echo trim($sotbitSeoMetaBottomDesc); ?>
<? /* php if ('Y' == $component->__parent->arParams['DETAIL_USE_COMMENTS'] && $arResult['ID'] > 0) { ?>
	<?$APPLICATION->IncludeComponent(
		"omniweb:catalog.section_comments",
		"",
		array(
			"ELEMENT_ID" => $arResult['ID'],
			"ELEMENT_CODE" => "",
			"IBLOCK_ID" => $arParams['IBLOCK_ID'],
			"URL_TO_COMMENT" => "",
			"WIDTH" => "",
			"COMMENTS_COUNT" => "5",
			"BLOG_USE" => $component->__parent->arParams['DETAIL_BLOG_USE'],
		//	"FB_USE" => $component->__parent->arParams['DETAIL_FB_USE'],
		//	"FB_APP_ID" => $component->__parent->arParams['DETAIL_FB_APP_ID'],
		//	"VK_USE" => $component->__parent->arParams['DETAIL_VK_USE'],
		//	"VK_API_ID" => $component->__parent->arParams['DETAIL_VK_API_ID'],
			"FB_USE" => 'N',
			"VK_USE" => 'N',
			"CACHE_TYPE" => $arParams['CACHE_TYPE'],
			"CACHE_TIME" => $arParams['CACHE_TIME'],
			"BLOG_TITLE" => "", //'Комментарии',
			"BLOG_URL" => "catalog_section_comments",
			"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
			"EMAIL_NOTIFY" => "N",
			"AJAX_POST" => "Y",
			"SHOW_SPAM" => "Y",
			"SHOW_RATING" => "N",
			"FB_TITLE" => "",
			"FB_USER_ADMIN_ID" => "",
			"FB_COLORSCHEME" => "light",
			"FB_ORDER_BY" => "reverse_time",
			"VK_TITLE" => "",
		),
		$component->__parent,
		array("HIDE_ICONS" => "Y")
	);?>
<?php } */ ?>