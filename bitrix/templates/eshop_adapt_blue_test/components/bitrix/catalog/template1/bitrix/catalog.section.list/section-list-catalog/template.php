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


global $sotbitSeoMetaTopDesc;//для установки верхнего описания
global $sotbitSeoMetaBottomDesc;//для установки нижнего описания
global $sotbitSeoMetaH1; //для установки нижнего описания
if($sotbitSeoMetaH1){?>
<h1><?=$sotbitSeoMetaH1;?></h1>
<?}
echo $sotbitSeoMetaTopDesc; ?>
<?
if ($arParams["DISPLAY_TOP_PAGER"])
{
	?><? echo $arResult["NAV_STRING"]; ?><?
}
include $_SERVER['DOCUMENT_ROOT'] . '/bitrix/templates/eshop_adapt_blue/urlh1.php';
?>
<div class="<? echo $arCurView['CONT']; ?>"><?
if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'] && !in_array($APPLICATION->GetCurPAge(false), $urlH1))
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
	?>
	<? if (false) : // отключен H1 ?>
	<h1 class="<? echo $arCurView['TITLE']; ?>" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>"><?
		echo (
			/*isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
			? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
			: $arResult['SECTION']['NAME']*/
      isset($arResult['SECTION']['UF_HEADER']) && $arResult['SECTION']['UF_HEADER'] != ""
      ? $arResult['SECTION']['UF_HEADER']
      : $arResult['SECTION']['NAME']
    );
	?></h1>
	<? endif; ?>
  <? if (!empty($arResult['SECTION']['~UF_TOPTEXT'])) : ?>
  <div class="section_toptext">
    <? echo $arResult['SECTION']['~UF_TOPTEXT'];?>
  </div>
  <? endif; ?>
  
  <?

  if(!empty($arResult['SECTION']['~UF_TOP_TEXT'])) {?>
   <div class="section_toptext">
   <?	echo $arResult['SECTION']['~UF_TOP_TEXT'];?>
   </div>
  <?}

}

if (0 < $arResult["SECTIONS_COUNT"])
{

/*---bgn 2015-07-02 Сортировка---*/
if (($arResult['SECTION']['DEPTH_LEVEL'] > 0 || $arParams['FILTER_SORT_PANEL'] == 'Y') && $arParams['HIDE_SORT_PANEL'] != 'Y') {
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
	<div class="sec-sort">
		<span class="sort-param">
			<?php echo GetMessage('SORTING'); ?>:
		</span>
		<span class="sort-param">
			<a href="<?php echo $APPLICATION->GetCurPageParam('', array('s')); ?>"><?php echo GetMessage('BY_DEFAULT'); ?></a>
		</span>
		<?php if ($arResult['SECTION']['DEPTH_LEVEL'] > 1 || $arParams['FILTER_SORT_PANEL'] == 'Y') { ?>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('pd', 'pa'))) { echo ' active'; } ?>">
				<a href="<?php echo $APPLICATION->GetCurPageParam('s=p'.$sp, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_P); ?>"><?php echo GetMessage('BY_PRICE'); ?></a>
				<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
				<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pa') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pa', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>
			</span>
			<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('dd', 'da'))) { echo ' active'; } ?>">
				<a href="<?php echo $APPLICATION->GetCurPageParam('s=d'.$sd, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_D); ?>"><?php echo GetMessage('BY_DATE'); ?></a>
				<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'dd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=dd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
				<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'da') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=da', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>
			</span>
		<?php } ?>
		<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('na', 'nd'))) { echo ' active'; } ?>">
			<a href="<?php echo $APPLICATION->GetCurPageParam('s=n'.$sn, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_N); ?>"><?php echo GetMessage('BY_NAME'); ?></a>
			<a class="ico-sort-abc-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'na') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=na', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>
			<a class="ico-sort-abc-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'nd') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=nd', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
		</span>
		<span class="sort-param<?php if (isset($_REQUEST['s']) && in_array($_REQUEST['s'], array('pod', 'poa'))) { echo ' active'; } ?>">
			<a href="<?php echo $APPLICATION->GetCurPageParam('s=po'.$spo, array('s')); ?>" title="<?php echo GetMessage('SORT_'.$SRT_PO); ?>"><?php echo GetMessage('BY_POPULARITY'); ?></a>
			<a class="ico-sort-desc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'pod') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=pod', array('s')); ?>" title="<?php echo GetMessage('SORT_DESC'); ?>"></a>
			<a class="ico-sort-asc<?php if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'poa') { echo ' active'; } ?>" href="<?php echo $APPLICATION->GetCurPageParam('s=poa', array('s')); ?>" title="<?php echo GetMessage('SORT_ASC'); ?>"></a>
		</span>
	</div>
<?php }
$w = 240; $h = 480;
/*---end 2015-07-02---*/

/*---bgn 2016-07-06---*/
if ($arParams['IBLOCK_ID'] == CATALOG_ID && $arResult['SECTION']['DEPTH_LEVEL'] == 1 && count($arResult['SECTIONS']) > 24 && $arParams['NO_WRAPPER'] != 'Y') { ?>
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
				

				<a
					href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
					class="bx_catalog_tile_img"
					title="<? echo $arSection['PICTURE']['TITLE']; ?>"
					><span class="bx_catalog_item_images_img">
	<img src="<?=$img['src']?>" alt="<? echo $arResult['SECTION']['NAME']; ?> <? echo $arSection['NAME']; ?>" title="<? echo $arSection['PICTURE']['TITLE']; ?>" class="bx_catalog_item_images_img" ></span>
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
		<!--	<?if ($arSection['SECTION_CODE_PATH'] != $arSection['SECTION_PAGE_URL']):?>
							<span class="bx_catalog_tile_title_black">
				<a href="<? echo $arSection['SECTION_CODE_PATH']; ?>"><? echo $arResult['SECTION']['NAME']; ?></a>
				</span>
			<?endif;?>	-->
			
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
if ($arParams['IBLOCK_ID'] == CATALOG_ID && $arResult['SECTION']['DEPTH_LEVEL'] == 1 && count($arResult['SECTIONS']) > 24 && $arParams['NO_WRAPPER'] != 'Y') { ?>
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

<?php echo $sotbitSeoMetaBottomDesc; ?>