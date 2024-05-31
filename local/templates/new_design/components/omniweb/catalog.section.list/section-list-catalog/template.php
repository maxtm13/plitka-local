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
$checkdate = $arParams["YEAR"];

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

//global $sotbitSeoMetaTopDesc;//для установки верхнего описания
//global $sotbitSeoMetaBottomDesc;//для установки нижнего описания
//global $sotbitSeoMetaH1; //для установки нижнего описания
// include "generation.php";
/*if($sotbitSeoMetaH1){?>
<h1><?=$sotbitSeoMetaH1;?></h1>
<?}*/
/*
if($sotbitSeoMetaTopDesc != 1):
	echo $sotbitSeoMetaTopDesc;
endif;
*/

$textT = PAGE_TOP_TEXT;
if(!empty($textT) && $textT != "PAGE_TOP_TEXT"){
	echo $textT;
}
?>
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
  <?/* if (!empty($arResult['SECTION']['~UF_TOPTEXT'])) : >
  <div class="section_toptext">
  <?
	if (isset($arResult['SECTION']['~UF_TOPTEXT'])){
		if (strpos($arResult['SECTION']['~UF_TOPTEXT'], "https") === false){
			$arResult['SECTION']['~UF_TOPTEXT'] = str_replace("http", "https", $arResult['SECTION']['~UF_TOPTEXT']);
		}
	}	
  >
    <? echo $arResult['SECTION']['~UF_TOPTEXT'];>
  </div>
  <? endif; */?>
  
  <?
}

    //выбрано в фильтре или нет
    $hasFilter = substr_count($APPLICATION->GetCurPageParam(), 'set_filter') > 0;

    //активные пар-ры фильтра
    if ($hasFilter) {
        global $arActiveFilterParams;?>
        <div class="activeFilterParams">
            <?foreach($arActiveFilterParams as $afParam) {
                $str = '';
                $link = 'javascript:void(0)';
                if (!empty($afParam['MIN']['VALUE']) || !empty($afParam['MAX']['VALUE'])) {
                    $tmp = array();
                    //$prmAdd = array();
                    $prmDel = array();
                    if (!empty($afParam['MIN']['VALUE'])) {
                        $tmp[] = GetMessage('FROM').' '.$afParam['MIN']['VALUE'];
                        //$prmAdd[] = $afParam['MIN']['CONTROL_ID'].'=';
                        $prmDel[] = $afParam['MIN']['CONTROL_ID'];
                    }
                    if (!empty($afParam['MAX']['VALUE'])) {
                        $tmp[] = GetMessage('TO').' '.$afParam['MAX']['VALUE'];
                        //$prmAdd[] = $afParam['MAX']['CONTROL_ID'].'=';
                        $prmDel[] = $afParam['MAX']['CONTROL_ID'];
                    }
                    $str = implode(' ', $tmp);
                    if (!empty($afParam['PRICE'])) {
                        $str .= ' руб.';
                    } else {
                        $str = $afParam['NAME'].': '.$str;
                    }
                    $link = $APPLICATION->GetCurPageParam('', $prmDel);
                } else {
                    $str = $afParam['NAME'];
                    $link = $APPLICATION->GetCurPageParam('', array($afParam['CONTROL_ID']));
                }
                if (count($arActiveFilterParams) == 1) {
                    $link = $APPLICATION->GetCurPage();
                }?>
                <a class="afParam" href="<?=$link?>"><?=$str?> <span>&#10006;</span></a>
            <?}?>
        </div>
    <?}

if (0 < $arResult["SECTIONS_COUNT"])
{
/*---bgn 2015-07-02 Сортировка---*/
if (($arResult['SECTION']['DEPTH_LEVEL'] > 0 || $arParams['FILTER_SORT_PANEL'] == 'Y') && $arParams['HIDE_SORT_PANEL'] != 'Y') {
	$SRT_P = 'ASC';
	$SRT_D = 'ASC';
	$SRT_N = 'ASC';
	$SRT_PO = 'ASC';
	$sp = 'a';
	$sd = 'd';
	$sn = 'a';
	$spo = 'd';
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
		<span class="sort-param sort-param-type">
			<?php echo GetMessage('SORTING'); ?>:
		</span>
		
		<!--
<img class="sort-picture" src="/upload/sort/sort_picture.png" alt="sort_picture" title="sort_picture"/>
-->
		<select data-type="sort" class="select_sort js-select">
			<option<?=($arParams['SORT_BY'] == "UF_HIT") ? ' selected' : ''; ?> value="UF_HIT#DESC"><?php echo GetMessage('BY_POPULARITY'); ?></option>
			<option<?=($arParams['SORT_BY'] == "UF_CATALOG_PRICE_1" && $arParams['SORT_ORDER'] == 'ASC') ? ' selected' : '';?> value="UF_CATALOG_PRICE_1#ASC"><?php echo GetMessage('BY_PRICE_CHEAP'); ?></option>
			<option<?=($arParams['SORT_BY'] == "UF_CATALOG_PRICE_1" && $arParams['SORT_ORDER'] == 'DESC') ? ' selected' : '';?> value="UF_CATALOG_PRICE_1#DESC"><?php echo GetMessage('BY_PRICE_EXP'); ?></option>
			<option<?=($arParams['SORT_BY'] == "NAME" && $arParams['SORT_ORDER'] == 'ASC') ? ' selected' : '';?> value="NAME#ASC"><?php echo GetMessage('BY_NAME'); ?></option>
			<option<?=($arParams['SORT_BY'] == "ID" && $arParams['SORT_ORDER'] == 'DESC') ? ' selected' : '';?> value="ID#DESC"><?php echo GetMessage('BY_DATE'); ?></option>
		</select>
		<span class="sort-param sort-param-count">
			<?php echo GetMessage('SORTING_PAGE_COUNT'); ?>:
		</span>
		<select data-type="inpage" class="select_page_count js-select">
			<option <?=($arParams['IN_PAGE'] == 40) ? 'selected' : '';?>>40</option>
			<option <?=($arParams['IN_PAGE'] == 80) ? 'selected' : '';?>>80</option>
		</select>
	</div>
<?php }
$w = '320px' /*240*/; $h = '240px' /*480*/;
/*---end 2015-07-02---*/

/*---bgn 2016-07-06---*/
if ($arParams['IBLOCK_ID'] == CATALOG_ID && $arResult['SECTION']['DEPTH_LEVEL'] == 1 && count($arResult['SECTIONS']) > 24 && $arParams['NO_WRAPPER'] != 'Y') { ?>
	<div class="sections-list-wrapper">
<?php }
	$arParams['VIEW_MODE'] = 'TILE';
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
			/*if ($USER->GetID() == 729 && !empty($arParams['ARR'])) {
				print_r($arResult['SECTIONS']);
			}*/
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
					$img = CFile::ResizeImageGet(
						($arSection['DETAIL_PICTURE'] ?? $arSection['PICTURE']),
						array("width" => ($arParams["IMG_SIZE_W"] ?? 247), "height" => ($arParams["IMG_SIZE_H"] ?? 186)),
						BX_RESIZE_IMAGE_EXACT,
						true,
						false,
						[
						  "name" => "sharpen", 
						  "precision" => 0
						],85);
					?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="lvl<? echo $arSection["DEPTH_LEVEL"]; ?>">

					<?if (!empty($arSection['UF_CATALOG_PRICE_1'])) {
						$cur_s = CCurrency::GetBaseCurrency();
						$cost_s = intval(str_replace(" ", "", CCurrencyLang::CurrencyFormat($arSection['UF_CATALOG_PRICE_1'], $cur_s, true)), 10);?>
					<script type="application/ld+json">
					{
					"@context": "https://schema.org",
						"@type": "Product",
						"description": "",
						"name": "<?= $arSection['NAME']?>",
						"url": "https://www.plitkanadom.ru<? echo $arSection['SECTION_PAGE_URL']; ?>",
						"image": "https://www.plitkanadom.ru<?=$img['src']?>",
						"offers": {
							"@type": "Offer",
							"availability": "http://schema.org/InStock",
							"price": "<?=$cost_s?>",
							"priceCurrency": "RUB"
						}
					}
					</script>
					<?}?>
					<div class="prop-icon dd">
						<?if(!empty($arSection['UF_91']) || !empty($arSection['~UF_91'])):
                            /*---bgn 2020-02-03---*/
                            if (in_array(2, $arSection['UF_91'])) {
                                $sfx = 2;
                            } else {
                                $sfx = '';
                            }
                            /*---end 2020-02-03---*/?>
							<div class="stickers">
						        <span class="sticker_free_shipping_stock" title="<?= GetMessage("DICOUNT_TITLE".$sfx)?>"><?= GetMessage("DICOUNT_TITLE".$sfx."_STICKER")?></span>
							</div>
						<?endif;?>
						<?if(!empty($arSection['UF_82']) || !empty($arSection['~UF_82'])):?>
							<span class="prop-ico-hit" title="<?= GetMessage("HIT_TITLE")?>"></span>
						<?endif;?>			
						<?if(!empty($arSection['UF_92']) || !empty($arSection['~UF_92'])):?>
							<span class="prop-ico-sample" title="<?= GetMessage("SAMPLE_TITLE")?>"></span>
						<?endif;?>
						<?
						$checkNew = (($arParams["IBLOCK_ID"] == 4 || $arParams["IBLOCK_ID"] == 9) && $arSection['DEPTH_LEVEL'] == 3 || ($arParams["IBLOCK_ID"] == 11 || $arParams["IBLOCK_ID"] == 15) && $arSection['DEPTH_LEVEL'] == 2 ? "Y" : '');
						if(date('Y',strtotime($arSection['DATE_CREATE'])) >= $checkdate && $checkNew == "Y"):?>
						<div class="stickers">
						<span class="sticker_novinka_element" title="<?= GetMessage("NEW_TITLE")?>"><?= GetMessage("NEW_TITLE")?></span>
						</div>
						<?endif;?>			
					</div>				
					<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="bx_catalog_tile_img section_type" title="<? echo $arSection['NAME']; ?>">
						<img class="catalog_item_img" src="<?=$img['src']?>" alt="<? echo $arSection['NAME']; ?>" />
						<? if ($arParams['HIDE_SEC_PRICE'] !== 'Y') {
							if(!empty($arSection['UF_AVAILABILITY']) && $arSection['UF_AVAILABILITY'] == GetMessage('NO_AVALABILITY')){?>
								<div class="sec-price"><?=GetMessage('NO_AVALABILITY')?></div>
							<?} elseif (!empty($arSection['UF_CATALOG_PRICE_1'])) {?>
								<div class="sec-price-order"><?= GetMessage("PRICE_ORDER")?></div>
								<?$cur = CCurrency::GetBaseCurrency();
								$cost = CCurrencyLang::CurrencyFormat($arSection['UF_CATALOG_PRICE_1'], $cur, true); ?>
								<div class="sec-price"><?= GetMessage("FROM")?> <?php echo $cost; ?></div>
							<?php }
						} ?>
					</a>
				
				
				<?
				if ('Y' != $arParams['HIDE_SECTION_NAME'])
				{
					?><a class="bx_catalog_tile_title" href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><?= $arSection['NAME']." - ";?> <?=($arParams["IBLOCK_ID"]==4 && $arResult["SECTION"]["DEPTH_LEVEL"]=="2" ? $arResult["SECTION"]["NAME"] : '');?><?=($arSection['RELATIVE_DEPTH_LEVEL'] == '0' && !empty($arSection['PARENT_SECTION_INFO']) ? $arSection['PARENT_SECTION_INFO']['NAME']: '');?></a><?
					if ($arParams["COUNT_ELEMENTS"])
					{
						?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
					}
				?>
			
			
			 <? /* if (($arResult['SECTION']['DEPTH_LEVEL'] == '1' || (empty($arResult['SECTION']) && $arSection['DEPTH_LEVEL'] == 3)) && $arSection['RELATIVE_DEPTH_LEVEL'] == '0' && !empty($arSection['PARENT_SECTION_INFO'])):?>
				
				<a class="bx_catalog_tile_title_black" href="<?php echo $arSection['PARENT_SECTION_INFO']['SECTION_PAGE_URL']; ?>"><? echo $arSection['PARENT_SECTION_INFO']['NAME']; ?></a>
			<?endif; */?> 
			<? //echo $arSection['RELATIVE_DEPTH_LEVEL']; ?>
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
	?><?= $arResult["NAV_STRING"]; ?><?
}
?>
</div>
<? // $sotbitSeoMetaBottomDesc;
$textD = "";
if (defined('SEO_BOTTOM_TEXT')) {
	$textD = SEO_BOTTOM_TEXT;
} else if(defined('PAGE_BOTTOM_TEXT')) {
	$textD = PAGE_BOTTOM_TEXT;
}
if(!empty($textD) && $textD != "PAGE_BOTTOM_TEXT" && empty($arResult["SECTION"]["DESCRIPTION"]) && empty($_REQUEST["PAGEN_1"])){
	echo $textD;
}elseif(!empty($arResult["SECTION"]["DESCRIPTION"]) && empty($_REQUEST["PAGEN_1"])){
//	echo $arResult["SECTION"]["DESCRIPTION"];
}
?>
