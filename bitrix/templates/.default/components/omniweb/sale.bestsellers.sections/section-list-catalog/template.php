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
$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array( 
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

if ($arParams["DISPLAY_TOP_PAGER"])
{
	?><? echo $arResult["NAV_STRING"]; ?><?
}
?>
<div class="<? echo $arCurView['CONT']; ?>">
	<?if ($arParams['HIDE_TITLE'] != 'Y') {?>
		<div class="listTitle"><?php echo GetMessage('PN_BESTSELLERS_TITLE'); ?>:</div>
	<?}
	if (0 < $arResult["SECTIONS_COUNT"])
	{
	$w = 240; $h = 480;

	/*---bgn 2016-07-06---*/
	if ($arParams['IBLOCK_ID'] == CATALOG_ID && count($arResult['SECTIONS']) > 24 && $arParams['NO_WRAPPER'] != 'Y') { ?>
		<div class="sections-list-wrapper">
	<?php }
	/*---end 2016-07-06---*/ ?>
	<ul class="<? echo $arCurView['LIST']; ?>">
	<? 
		switch ($arParams['VIEW_MODE'])
		{
			case 'LINE':
				foreach ($arResult['SECTIONS'] as &$arSection)
				{
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

					if (false === $arSection['PICTURE'])
						$arSection['PICTURE'] = array(
							'SRC' => $arCurView['EMPTY_IMG'],
							'ALT' => (
								'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
								? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
								: $arSection["NAME"]
							),
							'TITLE' => (
								'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
								? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
								: $arSection["NAME"]
							)
						);
					?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					<a
						href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
						class="bx_catalog_line_img"
						style="background-image: url(<? echo $arSection['PICTURE']['SRC']; ?>);"
						title="<? echo $arSection['PICTURE']['TITLE']; ?>"
					></a>
					<span class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
					if ($arParams["COUNT_ELEMENTS"])
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
					?></span><?
					if ('' != $arSection['DESCRIPTION'])
					{
						?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
					}
					?><div style="clear: both;"></div>
					</li><?
				}
				unset($arSection);
				break;
			case 'TEXT':
				foreach ($arResult['SECTIONS'] as &$arSection)
				{
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

					?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><span class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
					if ($arParams["COUNT_ELEMENTS"])
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
					?></span></li><?
				}
				unset($arSection);
				break;
			case 'TILE':
				foreach ($arResult['SECTIONS'] as &$arSection)
				{
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

					if (false === $arSection['PICTURE'])
						$arSection['PICTURE'] = array(
							'SRC' => $arCurView['EMPTY_IMG'],
							'ALT' => (
								'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
								? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
								: $arSection["NAME"]
							),
							'TITLE' => (
								'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
								? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
								: $arSection["NAME"]
							)
						);
					$img = CFile::ResizeImageGet($arSection['PICTURE'], array('width'=>$w, 'height'=>$h), BX_RESIZE_IMAGE_PROPORTIONAL);
						?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="lvl<? echo $arSection["DEPTH_LEVEL"]; ?>">
						<div class="prop-icon">
							<?if(!empty($arSection['UF_91']) || !empty($arSection['~UF_91'])):?>
								<span class="prop-ico-discount" title="<?= GetMessage("DICOUNT_TITLE")?>"></span>
							<?endif;?>
							<?if(!empty($arSection['UF_82']) || !empty($arSection['~UF_82'])):?>
								<span class="prop-ico-hit" title="<?= GetMessage("HIT_TITLE")?>"></span>
							<?endif;?>			
							<?if(!empty($arSection['UF_92']) || !empty($arSection['~UF_92'])):?>
								<span class="prop-ico-sample" title="<?= GetMessage("SAMPLE_TITLE")?>"></span>
							<?endif;?>			
						</div>				
					
					<!--<a
						href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
						class="bx_catalog_tile_img"
						style="background-image:url(<? echo /*$arSection['PICTURE']['SRC'];*/ $img['src']; ?>);"
						title="<? echo $arSection['PICTURE']['TITLE']; ?>"
						>
						<? if(!empty($arSection['UF_AVAILABILITY']) && $arSection['UF_AVAILABILITY'] == GetMessage('NO_AVALABILITY')){?>
							<div class="sec-price"><?=GetMessage('NO_AVALABILITY')?></div>
						<?} elseif (!empty($arSection['UF_CATALOG_PRICE_1'])) {
							$cur = CCurrency::GetBaseCurrency();
							$cost = CCurrencyLang::CurrencyFormat($arSection['UF_CATALOG_PRICE_1'], $cur, true); ?>
							<div class="sec-price"><?= GetMessage("FROM")?> <?php echo $cost; ?></div>
						<?php } ?>
					</a>-->
					
					<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="bx_catalog_tile_img" title="<? echo $arSection['PICTURE']['TITLE']; ?>">
						<span class="bx_catalog_item_images_img" style="background: url(<?=$img['src']?>) no-repeat center center; background-size: cover;">
						<?/*<img src="<?=$img['src']?>" alt="<? echo $arResult['SECTION']['NAME']; ?> <? echo $arSection['NAME']; ?>" title="<? echo $arSection['PICTURE']['TITLE']; ?>" class="bx_catalog_item_images_img" >*/?></span>
						<? if(!empty($arSection['UF_AVAILABILITY']) && $arSection['UF_AVAILABILITY'] == GetMessage('NO_AVALABILITY')){?>
							<div class="sec-price"><?=GetMessage('NO_AVALABILITY')?></div>
						<?} elseif (!empty($arSection['UF_CATALOG_PRICE_1'])) {
							$cur = CCurrency::GetBaseCurrency();
							$cost = CCurrencyLang::CurrencyFormat($arSection['UF_CATALOG_PRICE_1'], $cur, true); ?>
							<div class="sec-price"><?= GetMessage("FROM")?> <?php echo $cost; ?></div>
						<?php } ?>
						</a>
					
					
					<?
					if ('Y' != $arParams['HIDE_SECTION_NAME'])
					{
						?><span class="bx_catalog_tile_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
						if ($arParams["COUNT_ELEMENTS"])
						{
							?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
						}
					?></span>
				<?/*if ($arSection['SECTION_CODE_PATH'] != $arSection['SECTION_PAGE_URL']):?>
								<span class="bx_catalog_tile_title_black">
					<a href="<? echo $arSection['SECTION_CODE_PATH']; ?>"><? echo $arResult['SECTION']['NAME']; ?></a>
					</span>
				<?endif;*/?>
				
				 <?if (($arResult['SECTION']['DEPTH_LEVEL'] == '1' || (empty($arResult['SECTION']) && $arSection['DEPTH_LEVEL'] == 3)) && $arSection['RELATIVE_DEPTH_LEVEL'] == '0' && !empty($arSection['PARENT_SECTION_INFO'])):?>

				   <span class="bx_catalog_tile_title_black">
					<?/*<a href="<? echo strrchr ($arSection['SECTION_PAGE_URL'],'.',true); ?>"><? echo $arResult['SECTION']['NAME']; ?></a>*/?>
					<a href="<?php echo $arSection['PARENT_SECTION_INFO']['SECTION_PAGE_URL']; ?>"><? echo $arSection['PARENT_SECTION_INFO']['NAME']; ?></a>
				   </span>
				<?endif;?> 
				<!--<? echo $arSection['RELATIVE_DEPTH_LEVEL']; ?>-->
				<? echo $arFields["IBLOCK_ID"];?>
					<?
					}
					?></li><?
				}
				unset($arSection);
				break;
			case 'LIST':
				$intCurrentDepth = 1;
				$boolFirst = true;
				foreach ($arResult['SECTIONS'] as &$arSection)
				{
					$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
					$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

					if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						if (0 < $intCurrentDepth)
							echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
					}
					elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
					{
						if (!$boolFirst)
							echo '</li>';
					}
					else
					{
						while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
						{
							echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
							$intCurrentDepth--;
						}
						echo str_repeat("\t", $intCurrentDepth-1),'</li>';
					}

					echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
					?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><span class="bx_sitemap_li_title"><a href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
					if ($arParams["COUNT_ELEMENTS"])
					{
						?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
					}
					?></a></span><?

					$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
					$boolFirst = false;
				}
				unset($arSection);
				while ($intCurrentDepth > 1)
				{
					echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
					$intCurrentDepth--;
				}
				if ($intCurrentDepth > 0)
				{
					echo '</li>',"\n";
				}
				break;
		}
	?>
	</ul>
	<?
		echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
	}
	?>

	<?php /*---bgn 2016-07-06---*/
	if ($arParams['IBLOCK_ID'] == CATALOG_ID && count($arResult['SECTIONS']) > 24 && $arParams['NO_WRAPPER'] != 'Y') { ?>
		</div> <!--.sections-list-wrapper-->
	<?php }
	/*---end 2016-07-06---*/ ?>

	<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
	?>
</div>
