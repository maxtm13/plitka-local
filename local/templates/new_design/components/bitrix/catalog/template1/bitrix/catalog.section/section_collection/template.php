<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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


use Bitrix\Catalog\MeasureTable;

$this->setFrameMode(true);

$APPLICATION->AddHeadScript("local\templates\new_design\components\bitrix\catalog\template1\bitrix\catalog.section\.default\script.js");

$textT = PAGE_TOP_TEXT;
if(!empty($textT) && $textT != "PAGE_TOP_TEXT" && empty($arParams["PAGEN"])){
    echo $textT;
}
$checkdate = $arParams["YEAR"];
?>
<?$APPLICATION->IncludeComponent(
    "abricos:antisovetnik",
    "",
    array(),
    false,
    array(
        "ACTIVE_COMPONENT" => "N"
    )
);

use Bitrix\Main\Loader;
Loader::includeModule("sale");
$delaydBasketItems = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
        "DELAY" => "Y"
    ),
    array()
);
?>

<script>
    function add2wish(p_id, pp_id, p, name, dpu, th) {
        $.ajax({
            type: "POST",
            url: "/local/ajax/wishlist.php",
            data: "p_id=" + p_id + "&pp_id=" + pp_id + "&p=" + p + "&name=" + name + "&dpu=" + dpu,
            success: function (html) {
                $(th).addClass('in_wishlist');
                $('#wishcount').html(html);


                console.log('Сердечко:');
                $('.wishbtn img').attr('src', 'https://plita.iteesweb.ru/bitrix/templates/eshop_adapt_blue/images/favorite_full.png');
                $('.wishbtn').attr('onclick', 'javascript:void(0)');
                $count = parseInt($.trim($('.wishbtn').text()));
                $count++;
                console.log('count=', $count);
                $('.wishbtn .count').html($count);

                $('.header_inner_container_auth span.favorite-icon .count').html($count);
            }
        });
    }

</script>

<div class="header-page-block">
    <div class="header-page-block__left">
        <?if($arResult["IMG_SLIDER"]) {?>
            <div class="section-img-slider">
                <div class="section-img-slider__big">
                    <? foreach ($arResult["IMG_SLIDER"] as $photo) {
                        if((int)$photo['SIZES']['width'] > (int)$photo['SIZES']['height']){
                            $imgstyle = "po-shirine";
                        }
                        if((int)$photo['SIZES']['width'] == (int)$photo['SIZES']['height']){
                            $imgstyle = "kvadrat";
                        }
                        if((int)$photo['SIZES']['width'] < (int)$photo['SIZES']['height']){
                            $imgstyle = "po-visote";
                        }
                        ?>
                        <a data-fancybox="gallery" href="<?=$photo["ORIGIN"]?>" class="main">
                            <img class="<?=$imgstyle;?>" src="<?=$photo["MIN"]?>" alt="<?= $arResult['NAME'] ?>">
                        </a>
                    <?}?>
                </div>
                <?if(count($arResult["IMG_SLIDER_MIN"]) > 1) {?>
                    <div class="section-img-slider__min">
                        <? foreach ($arResult["IMG_SLIDER_MIN"] as $photo) { ?>
                            <div class='section-img-slider__min-item'>
                                <img src="<?=$photo?>" alt="">
                            </div>
                        <?}?>
                    </div>
                <?}?>
            </div>
        <?}?>

        <? if($arResult["USE_DELIVERY"] == "Y"){ ?>
            <a href="/promotions/aktsiya-na-proizvoditeley-delacora-altacera-kerama-marazzi-uralkeramika-alma-ceramica-italon-laparet/"><img src="/image/banner_2.jpg" class="promotions-img" /></a>
        <? } ?>
        <? if($arResult["USE_DELIVERY_V2"] == "Y"){ ?>
            <a href="/promotions/aktsiya-na-proizvoditeley-delacora-new-trend-coliseum-gres-altacera-uralkeramika-alma-ceramica-lapar/"><img src="/image/akzii_v4.jpg" class="promotions-img" /></a>
        <? } ?>
    </div>
    <div class="header-page-block__right">
        
            <div class="price-info">

<?		
$sectionId = $arResult['ID']; // ID нужного вам раздела
$minPrice = NULL;
$ignoreIDs = array();

while(true) {
	$arFilter = ['IBLOCK_ID' => $arResult['IBLOCK_ID'], 'SECTION_ID'=> $sectionId, '!ID' => $ignoreIDs, 'ACTIVE' => 'Y'];
	$arSelect = ['ID', 'IBLOCK_ID', 'NAME', 'CATALOG_GROUP_1']; // CATALOG_GROUP_1 - это базовая цена
	
	$res = CIBlockElement::GetList(['CATALOG_PRICE_1' => 'ASC'], $arFilter, false, ['nTopCount' => 1], $arSelect);
	if($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();

		if ($arFields['CATALOG_MEASURE'] == 6) {
			$minPrice = $arFields['CATALOG_PRICE_1'];
			$minPrice = round($minPrice); // Округление до ближайшего целого числа
			// Или, если вам нужно округлить до двух десятичных знаков:
			// $minPrice = round($minPrice, 2);
			break;
		}
		else {
			$ignoreIDs[] = $arFields['ID'];
		}
	} else {
        break;
    }
}
?>
                <?$cur = CCurrency::GetBaseCurrency();?>
                <?$cost = CCurrencyLang::CurrencyFormat($arResult['UF_CATALOG_PRICE_1'], $cur, false); ?>
                <?=GetMessage('CT_PRICE_TITLE')?> <span><?=$minPrice?></span>
                <?=GetMessage('CT_PRICE_MEASURE')?>
                <?//$arResult["ITEMS"][0]["CATALOG_MEASURE_NAME"]?>
            </div>

        <a class="btn_product" href="#products_tab"><?=GetMessage('BTN_PRODUCT')?></a>

        <div class="item_info_section">
            <?if($arResult["PARENT_SECTION"]) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_MANUFACTURER')?></span>
                    <a class="side-right" href="<?=$arResult["PARENT_SECTION"]["SECTION_PAGE_URL"]?>"><?=$arResult["PARENT_SECTION"]["NAME"]?></a>
                    <div class="clear"></div>
                </div>
            <?}?>
            <div class="new-row">
                <span class="side-left"><?=GetMessage('PROP_TITLE_COLLECTION')?></span>
                <span class="side-right"><?=$arResult["NAME"]?></span>
                <div class="clear"></div>
            </div>
            <?if($arResult["ITEMS"][0]["PROPERTIES"]["COUNTRY"]["VALUE"]) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('CT_COUNTRY_TITLE')?></span>
                    <span class="side-right">
                    <?=$arResult["ITEMS"][0]["PROPERTIES"]["COUNTRY"]["VALUE"]?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>
            <?if($arResult['PROPERTY_USE']) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_USE')?></span>
                    <span class="side-right">
                    <?=implode(", ", $arResult['PROPERTY_USE'])?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>
            <?if($arResult['PROPERTY_SIZE']) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_SIZE')?></span>
                    <span class="side-right">
                    <?=implode(", ", $arResult['PROPERTY_SIZE'])?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>
            <?if($arResult['PROPERTY_COLOR']) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_COLOR')?></span>
                    <span class="side-right">
                    <?=implode(", ", $arResult['PROPERTY_COLOR'])?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>
            <?if($arResult['PROPERTY_RISUNOK']) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_RISUNOK')?></span>
                    <span class="side-right">
                    <?=implode(", ", $arResult['PROPERTY_RISUNOK'])?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>
            <?if($arResult['PROPERTY_SURFACE']) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_SURFACE')?></span>
                    <span class="side-right">
                    <?=implode(", ", $arResult['PROPERTY_SURFACE'])?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>
            <?if($arResult['PROPERTY_PROP_STYLE']) {?>
                <div class="new-row">
                    <span class="side-left"><?=GetMessage('PROP_TITLE_PROP_STYLE')?></span>
                    <span class="side-right">
                    <?=implode(", ", $arResult['PROPERTY_PROP_STYLE'])?>
                </span>
                    <div class="clear"></div>
                </div>
            <?}?>

            <div class="new-row bold">
                <span class="side-left"><?=GetMessage('CT_DELIVE_M')?></span>
                <a target="_blank" class="side-right" href="/dostavka/#delive_m">
                    <?=GetMessage('CT_DELIVE_M_PRICE')?>
                </a>
                <div class="clear"></div>
            </div>
            <div class="new-row bold">
                <span class="side-left"><?=GetMessage('CT_DELIVE_R')?></span>
                <a target="_blank" class="side-right" href="/dostavka/#delive_r">
                    <?=GetMessage('CT_DELIVE_R_PRICE')?>
                </a>
                <div class="clear"></div>
            </div>
            <div class="new-row bold">
                <span class="side-left"><?=GetMessage('CT_DELIVE_S')?></span>
                <a target="_blank" class="side-right" href="/dostavka/#delive_s">
                    <?=GetMessage('CT_DELIVE_S_PRICE')?>
                </a>
                <div class="clear"></div>
            </div>
            <div class="new-row bold">
                <span class="side-left"><?=GetMessage('CT_DELIVE_PRICE')?></span>
                <a target="_blank" class="side-right" style="max-width: calc(100% - 195px);" href='/oplata/'>
                    <?=GetMessage('CT_DELIVE_PRICE_PRICE')?>
                </a>
                <div class="clear"></div>
            </div>
        </div>

        <? if($arResult["USE_DELIVERY"] == "Y"){ ?>
            <a href="/promotions/aktsiya-na-proizvoditeley-delacora-altacera-kerama-marazzi-uralkeramika-alma-ceramica-italon-laparet/"><img src="/image/banner_2.jpg" class="promotions-img" /></a>
        <? } ?>
        <? if($arResult["USE_DELIVERY_V2"] == "Y"){ ?>
            <a href="/promotions/aktsiya-na-proizvoditeley-delacora-new-trend-coliseum-gres-altacera-uralkeramika-alma-ceramica-lapar/"><img src="/image/akzii_v4.jpg" class="promotions-img" /></a>
        <? } ?>
    </div>
</div>
<div class="groups-tabs">
    <i class="anchor_link" id="products_tab"></i>
    <?
    if (is_array($arResult['GROUP_LINKS']) &&count($arResult['GROUP_LINKS']) > 1) {?>
        <div class="groups-tabs__tab">
            <div class="active all"><span>Все</span></div>
            <? foreach($arResult['GROUP_LINKS'] as $key=>$link) {?>
                <?if($link["name"] == 'OTHER') {
                    $link["name"] = GetMessage('GROUP_OTHER_TITLE');
                } ?>
                <div  data-id="<?=$link["id"]?>"><span><?=$link["name"]?></span></div>
            <?}?>
        </div>
    <?}?>
    <div class="groups-tabs__content" itemscope itemtype="http://schema.org/ItemList">
        <?$arParams['TEMPLATE_THEME'] = 'orange';
        if (!empty($arResult['ITEMS'])) {
            $templateData = array(
                'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
                'TEMPLATE_CLASS' => 'bx_' . $arParams['TEMPLATE_THEME']
            );

            CJSCore::Init(array("popup"));
            $arSkuTemplate = array();

            $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
            $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
            $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
            /*---bgn 2018-06-13---*/
            $curGroup = $arResult['ITEMS'][0]['GROUP_INFO']['NAME'];
        if (!empty($arResult['GROUP_ITEMS'])) { ?>
            <div data-id="<?php echo $arResult['ITEMS'][0]['GROUP_INFO']['ID'];?>" class="active">
                <i class="anchor_link" id="<?php echo $arResult['ITEMS'][0]['GROUP_INFO']['ID']; ?>"></i>
                <div class="groupName"><?= (($curGroup == 'OTHER') ? GetMessage('GROUP_OTHER_TITLE'): $curGroup); ?></div>
                <?php }
                /*---end 2018-06-13---*/ ?>
                <div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
                    <?
                    $w = 200;
                    $h = 400;
                    $now = time();
                    $week_day = date('N', $now);
                    $hour = intval(date('H', $now));
                    $minutes = intval(date('i', $now));
                    $ikey = 0;
                    foreach ($arResult['ITEMS'] as $key => $arItem)
                    {
                    /*---bgn 2018-06-13---*/
                    if (!empty($arResult['GROUP_ITEMS']) && $arItem['GROUP_INFO']['NAME'] != $curGroup) { ?>
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div data-id="<?php echo $arItem['GROUP_INFO']['ID'];?>" class="active">
                <i class="anchor_link" id="<?php echo $arItem['GROUP_INFO']['ID']; ?>"></i>

                <div class="groupName"><?php echo(($arItem['GROUP_INFO']['NAME'] == 'OTHER') ? GetMessage('GROUP_OTHER_TITLE') : $arItem['GROUP_INFO']['NAME']); ?></div>
                <div class="bx_catalog_list_home col<? echo $arParams['LINE_ELEMENT_COUNT']; ?> <? echo $templateData['TEMPLATE_CLASS']; ?>">
                    <?php $curGroup = $arItem['GROUP_INFO']['NAME'];
                    }
                    /*---end 2018-06-13---*/

                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                    $strMainID = $this->GetEditAreaId($arItem['ID']);

                    $arItemIDs = array(
                        'ID' => $strMainID,
                        'PICT' => $strMainID . '_pict',
                        'SECOND_PICT' => $strMainID . '_secondpict',

                        'QUANTITY' => $strMainID . '_quantity',
                        'QUANTITY_DOWN' => $strMainID . '_quant_down',
                        'QUANTITY_UP' => $strMainID . '_quant_up',
                        'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                        'BUY_LINK' => $strMainID . '_buy_link',
                        'SUBSCRIBE_LINK' => $strMainID . '_subscribe',

                        'PRICE' => $strMainID . '_price',
                        'DSC_PERC' => $strMainID . '_dsc_perc',
                        'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',

                        'PROP_DIV' => $strMainID . '_sku_tree',
                        'PROP' => $strMainID . '_prop_',
                        'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                        'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                    );

                    $strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                    $strTitle = (
                    isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
                        ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
                        : $arItem['NAME']
                    );

                    $img = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], ["width" => 252, "height" => 252], BX_RESIZE_IMAGE_PROPORTIONAL, true,false,[],80);

                    if($arItem['DETAIL_PICTURE']['WIDTH'] > $arItem['DETAIL_PICTURE']['HEGHT']){
                        $imgstyle = "po-shirine";
                    }
                    if($arItem['DETAIL_PICTURE']['WIDTH'] = $arItem['DETAIL_PICTURE']['HEGHT']){
                        $imgstyle = "kvadrat";
                    }
                    if($arItem['DETAIL_PICTURE']['WIDTH'] < $arItem['DETAIL_PICTURE']['HEGHT']){
                        $imgstyle = "po-visote";
                    }
                    //	$img = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => $w, 'height' => $h), BX_RESIZE_IMAGE_PROPORTIONAL);

                    //проверим ночная цена или нет
                    if ($arItem['PROPERTIES']['NIGHT_PRICE']['VALUE'] == 1 && ($hour == 20 && $minutes >= 30 || $hour > 20 || $hour == 8 && $minutes <= 30 || $hour < 8)) {
                        $nightPrice = true;
                    } else {
                        $nightPrice = false;
                    }
                    ?>
                    <div class="<? echo($arItem['SECOND_PICT'] ? 'bx_catalog_item double' : 'bx_catalog_item'); ?>" itemscope
                         itemtype="http://schema.org/Product" itemprop="itemListElement">
                        <meta itemprop='category' content="<?php echo $arResult['NAME']; ?>"/>
                        <meta itemprop='position' content="<?=$ikey++; ?>"/>
                        <?php if (!empty($img['src'])) {
                            if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
                                $http = $_SERVER['HTTP_X_FORWARDED_PROTO'];
                            } else {
                                $http = !empty($_SERVER['HTTPS']) ? "https" : "http";
                            } ?>
                            <meta itemprop="image" content="<?php echo $http . '://' . SITE_SERVER_NAME . $img['src']; ?>"/>
                        <?php } ?>
                        <div class="bx_catalog_item_container" id="<? echo $strMainID; ?>">
                            <div class="prop-icon">
                                <?//процент скидки
                                if (!empty($arItem['PROPERTIES']['DISCOUNT_PERCENT']['VALUE'])) { ?>
                                    <span class="percent">
                                        -<?= abs($arItem['PROPERTIES']['DISCOUNT_PERCENT']['VALUE']) ?>%
                                    </span>
                                    <?
                                }
                                //при ночной цене скидка не показывается
                                if ($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 1 && !$nightPrice):?>
                                    <div class="stickers">
                                    <span class="sticker_free_shipping_stock"
                                          title="<?= GetMessage("DICOUNT_TITLE") ?>"><?= GetMessage("DICOUNT_TITLE1_STICKER") ?></span>
                                    </div>
                                <? // значение 2 при ночной цене скидка не показывается и отключает скидку показывает только бесплатная доставка
                                elseif ($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 2 && !$nightPrice):?>
                                    <div class="stickers">
                                    <span class="sticker_free_shipping"
                                          title="<?= GetMessage("DICOUNT_TITLE2_TITLE") ?>"><?= GetMessage("DICOUNT_TITLE2_STICKER") ?></span>
                                    </div>
                                <? // значение 3 выключает картинку скидки, но показывает процент %
                                elseif ($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 3):?>
                                    <span class="prop-ico-discount-display-none" title="<?= GetMessage("DICOUNT_TITLE2") ?>"></span>
                                <?endif; ?>
                                <?
                                if (!empty($arItem['PROPERTIES']['HITS']['VALUE'])):?>
                                    <span class="prop-ico-hit" title="<?= GetMessage("HIT_TITLE") ?>"></span>
                                <?endif; ?>
                                <?
                                if (!empty($arItem['PROPERTIES']['SAMPLE']['VALUE'])):?>
                                    <span class="prop-ico-sample" title="<?= GetMessage("SAMPLE_TITLE") ?>"></span>
                                <?endif; ?>
                                <?
                                // if (!empty($arItem['PROPERTIES']['NEWSALE']['VALUE'])):
                                if(date('Y',strtotime($arItem["DATE_CREATE"])) >= $checkdate && $arSection['DEPTH_LEVEL'] == 2):?>
                                    <div class="stickers">
                                        <span class="sticker_novinka_element">Новинка</span>
                                    </div>
                                <?endif; ?>
                            </div>
                            <?/*Добавил альты*/
                            ?>
                            <?/*<a id="<? echo $arItemIDs['PICT']; ?>" href="<?=mb_strtolower($arItem['DETAIL_PAGE_URL'])?>" class="bx_catalog_item_images" style="background-image: url(<? echo $img['src']; ?>)" title="<? echo $strTitle; ?>">
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
                            </a>*/
                            ?>
                            <a id="<? echo $arItemIDs['PICT']; ?>" href="<?=mb_strtolower($arItem['DETAIL_PAGE_URL'])?>"
                               class="bx_catalog_item_images <?=$imgstyle;?>">
                                <span class="is-height"></span>
                                <? if(!empty($img['src'])):?>
                                    <img src="<?= $img['src'] ?>" class="catalog_item_img" alt="<?= $strTitle ?>" />
                                <? else: ?>
                                    <img src="/local2/image/new_design/empty.jpg" class="catalog_item_img" alt="<?= $strTitle ?>" />
                                <? endif; ?>

                                <?
                                if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
                                    ?>
                                    <div
                                            id="<? echo $arItemIDs['DSC_PERC']; ?>"
                                            class="bx_stick_disc right bottom"
                                            style="display:<? echo(0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">
                                        -<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%
                                    </div>
                                    <?
                                }
                                if ($arItem['LABEL']) {
                                    ?>
                                    <div class="bx_stick average left top"
                                         title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
                                    <?
                                }
                                ?>
                            </a>
                            <?
                            if ($arItem['SECOND_PICT']) {
                                $pic = !empty($arItem['PREVIEW_PICTURE_SECOND']) ? $arItem['PREVIEW_PICTURE_SECOND']['ID'] : $arItem['PREVIEW_PICTURE']['ID'];
                                $img = CFile::ResizeImageGet($pic, array('width' => $w, 'height' => $h), BX_RESIZE_IMAGE_PROPORTIONAL);
                                ?>
                                <a id="<? echo $arItemIDs['SECOND_PICT']; ?>" href="<?=mb_strtolower($arItem['DETAIL_PAGE_URL'])?>"
                                   class="bx_catalog_item_images_double"
                                   style="background-image: url(<? echo $img['src']; ?>)" title="<? echo $strTitle; ?>">
                                    <?
                                    if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
                                        ?>
                                        <div
                                                id="<? echo $arItemIDs['SECOND_DSC_PERC']; ?>"
                                                class="bx_stick_disc right bottom"
                                                style="display:<? echo(0 < $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">
                                            -<? echo $arItem['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%
                                        </div>
                                        <?
                                    }
                                    if ($arItem['LABEL']) {
                                        ?>
                                        <div class="bx_stick average left top"
                                             title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
                                        <?
                                    }
                                    ?>
                                </a>
                                <?
                            }
                            ?>
                            <?//при ночной цене скидка не показывается
                            if ($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 1 && !$nightPrice):?>
                                <div class="discount-call2"><!--noindex--><?php echo '<p class="action-text">Акция! Позвоните и узнайте скидку у менеджера! Гарантия минимальной цены!</p>' ?><!--/noindex--></div>
                            <? // значение 2 при ночной цене скидка не показывается и отключает скидку
                            elseif ($arItem['PROPERTIES']['DISCOUNT']['VALUE'] == 2 && !$nightPrice):?>
                                <div class="discount-call2"><!--noindex--><?php echo '<p class="action-text">Акция! Бесплатная доставка!</p>' ?><!--/noindex--></div>
                            <?endif; ?>
                            <div class="bx_catalog_item_title" itemprop="name">
                                <a href="<?=mb_strtolower($arItem['DETAIL_PAGE_URL'])?>" title="<? echo $arItem['NAME']; ?>"
                                   itemprop="url"><? echo $arItem['NAME']; ?></a>
                            </div>
                            <meta itemprop="description" content="<? echo $arItem['NAME']; ?>"/>
                            <?
                            echo "<div style='padding: 10px 0px;font-size: 11px;'>Код товара: {$arItem['ID']}</div>"; ?>
                            <div class="bx_catalog_item_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                <? /*print_r($arItem['DISPLAY_PROPERTIES']);*/ ?>
                                <meta itemprop="price" content="<?php echo $arItem['ITEM_PRICES'][0]['DISCOUNT']; ?>"/>
                                <meta itemprop="priceCurrency" content="<?php echo $arItem['ITEM_PRICES'][0]['CURRENCY']; ?>"/>
                                <? //Постоянная старая цена
                                if (($arItem['PROPERTIES']['OLD_PRICE']['VALUE']) > ($arItem['ITEM_PRICES'][0]['PRICE']) && (empty($arItem['PROPERTIES']['DISCOUNT_PERCENT']['VALUE']))) { ?>

                                    <div class="tim_old_pice"><? echo round($arItem['PROPERTIES']['OLD_PRICE']['VALUE']); ?><? echo GetMessage('OLD_PRICE_MESS_CUR'); ?></div>
                                <? }; ?>

                                <div id="<? echo $arItemIDs['PRICE']; ?>" class="bx_price">
                                    <?php if (!empty($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'])) {
                                        echo $arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['DISPLAY_VALUE'];
                                    } else {
                                        /*if (!empty($arItem["DISPLAY_PROPERTIES"]["RECOMMENDED_PRICE"]["VALUE"])) {
                                        echo GetMessage("CALL_FOR_PRICE");
                                        }
                                        else*/
                                        if (!empty($arItem['ITEM_PRICES'][0])) {
                                            if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS'])) {
                                                echo GetMessage(
                                                    'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
                                                    array(
                                                        '#PRICE#' => $arItem['ITEM_PRICES'][0]['PRINT_DISCOUNT'],
                                                        '#MEASURE#' => GetMessage(
                                                            'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
                                                            array(
                                                                '#VALUE#' => $arItem['ITEM_MEASURE_RATIO_SELECTED'],
                                                                '#UNIT#' => $arItem['ITEM_MEASURE']['TITLE']
                                                            )
                                                        )
                                                    )
                                                );
                                            } else {
                                                echo $arItem['ITEM_PRICES'][0]['PRINT_PRICE'];
                                            }
                                            /*---bgn 2019-08-09---*/
                                            /*if ('Y' == $arParams['SHOW_OLD_PRICE'] && $arItem['MIN_PRICE']['DISCOUNT_VALUE'] < $arItem['MIN_PRICE']['VALUE'])
                                            {
                                                ?> <span><? echo $arItem['MIN_PRICE']['PRINT_VALUE']; ?></span><?
                                            }*/
                                            /*---end 2019-08-09---*/
                                        }
                                    } ?>
                                    <?
                                    if (!in_array($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) { //проверка наличия
                                        echo " / {$arItem['ITEM_MEASURE']['TITLE']} "; // выводит ед .изм
                                    }
                                    /*---bgn 2019-08-09 доб. функционал вывода старой цены при заданом % скидки---*/
                                    if ('Y' == $arParams['SHOW_OLD_PRICE']) {
                                        if ($arItem['ITEM_PRICES'][0]['RATIO_DISCOUNT'] > 0) {
                                            $oldPrice = $arItem['ITEM_PRICES'][0]['PRINT_PRICE'];
                                        } else if (!empty($arItem['PROPERTIES']['DISCOUNT_PERCENT']['VALUE'])) {
                                            $percent = abs($arItem['PROPERTIES']['DISCOUNT_PERCENT']['VALUE']);
                                            if ($percent > 0) {
                                                $oldPrice = round($arItem['ITEM_PRICES'][0]['PRICE'] * 100 / (100 - $percent));
                                                $oldPrice = CurrencyFormat($oldPrice, $arItem['ITEM_PRICES'][0]['CURRENCY']);
                                            }
                                        } else {
                                            $oldPrice = '';
                                        }
                                        ?> <span><? echo $oldPrice; ?></span><?
                                    }
                                    /*---end 2019-08-09---*/
                                    ?>
                                    <? echo $arItem['VALUE']; ?>

                                </div>

                            </div>
                            <? $units_recalc = false;
                            if (($arItem['ITEM_MEASURE']["TITLE"] == 'кв. м.' || in_array(strtolower($arItem['ITEM_MEASURE']["TITLE"]), array('упак.', 'упаковка'))) && !empty($arItem['PROPERTIES']['SHTUK_V_UPAC']['VALUE']) && !empty($arItem['PROPERTIES']['WIDTH_MM']['VALUE']) && !empty($arItem['PROPERTIES']['LENGTH_MM']['VALUE']) && $arParams['IBLOCK_ID'] == CATALOG_FLOOR_ID) {
                                $itemSize = array(
                                    0 => trim(str_replace(',', '.', $arItem['PROPERTIES']['WIDTH_MM']['VALUE'])),
                                    1 => trim(str_replace(',', '.', $arItem['PROPERTIES']['LENGTH_MM']['VALUE']))
                                );
                                if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
                                    $units_recalc = true;
                                }
                                $activeUnit = $arItem['ITEM_MEASURE']["TITLE"] == 'кв. м.' ? 'm' : 'p';
                                $itemSize[0] = floatval($itemSize[0]) / 1000; //мм. в м.
                                $itemSize[1] = floatval($itemSize[1]) / 1000; //мм. в м.
                                $sqr = $itemSize[0] * $itemSize[1]; //площадь
                                $sqr = round($sqr * 10000) / 10000; //4 знака после запятой
                                //цена за упаковку
                                $pacPrice = round($arItem['PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * $arItem['ITEM_PRICES'][0]['DISCOUNT']);
                                if ($pacPrice) { ?>
                                    <div class="pacPrice"><?= CurrencyFormat($pacPrice, $arItem['ITEM_PRICES'][0]['CURRENCY']) ?> /
                                        упак.
                                    </div>
                                    <?
                                }
                            }
                            if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])) { ?>
                                <div class="bx_catalog_item_controls">
                                    <? if ($arItem['CAN_BUY'] && !in_array($arItem['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) {
                                    if ('Y' == $arParams['USE_PRODUCT_QUANTITY']) { ?>
                                        <?/*---bgn 2017-04-14---*/ ?>
                                        <?php
                                        //2018-01-17 корректировка: получение размеров из SIZE_WIDTH и SIZE_LENGTH
                                        if (($arItem['ITEM_MEASURE']["TITLE"] == 'кв. м.' || $arItem['ITEM_MEASURE']["TITLE"] == 'шт.') && /*!empty($arItem['DISPLAY_PROPERTIES']['SIZE'])*/
                                            !empty($arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['VALUE']) && $arParams['IBLOCK_ID'] == CATALOG_ID) {
                                            /*$itemSize = str_replace(array('х', ',', ','), array('x', '.', '.'), strtolower($arItem['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']));
                                            $itemSize = explode('x', $itemSize);*/
                                            $itemSize = array(
                                                0 => trim(str_replace(',', '.', $arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'])),
                                                1 => trim(str_replace(',', '.', $arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE']))
                                            );
                                            if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
                                                $units_recalc = true;
                                            }
                                            $activeUnit = $arItem['ITEM_MEASURE']["TITLE"] == 'кв. м.' ? 'm' : 'i';
                                        } ?>
                                        <?/*---end 2017-04-14---*/ ?>
                                        <div class="bx_catalog_item_controls_blockone">
                                            <div style="display: inline-block;position: relative;">
                                                <a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)"
                                                   class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
                                                <input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                       name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                                       value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>"<?/*---bgn 2017-04-14---*/ ?>
                                                       data-key="<?php echo $key; ?>"<?php if ($units_recalc) { ?> style="display: none;"<?php } ?><?/*---end 2017-04-14---*/ ?>>
                                                <?/*---bgn 2017-04-14---*/ ?>
                                                <?php if ($units_recalc) { ?>
                                                    <input class="cm-input unit-quantity-<?php echo $key; ?>"
                                                           data-key="<?php echo $key; ?>" type="text"
                                                           value="<? echo(isset($arItem['OFFERS']) && !empty($arItem['OFFERS']) ? 1 : $arItem['CATALOG_MEASURE_RATIO']); ?>"
                                                           data-dunit='<?= $activeUnit ?>'>
                                                <?php } ?>
                                                <?/*---end 2017-04-14---*/ ?>
                                                <a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"
                                                   class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
                                                <span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"<?/*---bgn 2017-04-14---*/ ?><?php if ($units_recalc) { ?> class="hidden"<?php } ?><?/*---end 2017-04-14---*/ ?>><? echo $arItem['ITEM_MEASURE']["TITLE"]; ?></span>
                                            </div>
                                        </div>
                                        <?/*---bgn 2017-04-14---*/ ?>
                                        <?php if ($units_recalc) {
                                        if ($arParams['IBLOCK_ID'] == CATALOG_ID) {
                                            $itemSize[0] = floatval($itemSize[0]) / 100; //см. в м.
                                            $itemSize[1] = floatval($itemSize[1]) / 100; //см. в м.
                                            $sqr = $itemSize[0] * $itemSize[1]; //площадь
                                            $sqr = round($sqr * 10000) / 10000;
                                            $dataPac = (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) ? $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['DISPLAY_VALUE'] : 0;
                                        } else {
                                            $dataPac = (!empty($arItem['PROPERTIES']['SHTUK_V_UPAC'])) ? $arItem['PROPERTIES']['SHTUK_V_UPAC']['VALUE'] : 0;
                                        } ?>
                                        <div class="calc-measures-<?php echo $key; ?>"
                                             data-inpt="<? echo $arItemIDs['QUANTITY']; ?>" data-w="<?php echo $itemSize[0]; ?>"
                                             data-h="<?php echo $itemSize[1]; ?>" data-sqr="<?php echo $sqr; ?>"
                                             data-pac="<?php echo $dataPac; ?>" data-key="<?php echo $key; ?>"
                                             data-dunit='<?= $activeUnit ?>'>
                                            <a <? if ($activeUnit == 'm'): ?>class="active"<? endif ?> href="javascript:void(0)"
                                               data-unit="m">кв. м.</a>
                                            <? if ($arParams['IBLOCK_ID'] == CATALOG_ID) { ?>
                                                <a <?
                                                   if ($activeUnit == 'i'): ?>class="active"<?
                                                endif ?> href="javascript:void(0)" data-unit="i">шт.</a>
                                                <?
                                            }
                                            if (!empty($dataPac) && $arParams['IBLOCK_ID'] == CATALOG_FLOOR_ID) { ?>
                                                <a <? if ($activeUnit == 'p'): ?>class="active"<? endif ?> href="javascript:void(0)"
                                                   data-unit="p">упак.</a>
                                            <? } ?>
                                            <? /*<div class="hidden">в упаковке <?php echo $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE']; ?> шт. = <?php echo (intval($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * 10000) / 10000).' '.$arItem['ITEM_MEASURE']["TITLE"]; ?></div>*/ ?>
                                        </div><br/>
                                    <?php } ?>
                                        <?/*---end 2017-04-14---*/ ?>
                                        <?
                                    }
                                        ?>

                                        <?
                                        //Проверяем, есть ли текущий товар в отложенных.


                                        $curItemId = intval(explode('_', $arItemIDs['ID'])[2]);
                                        $isDelayed = false;
                                        if (\Bitrix\Main\Loader::includeModule("sale")) {
                                            $dbBasketItems = CSaleBasket::GetList(
                                                array(
                                                    "NAME" => "ASC",
                                                    "ID" => "ASC"
                                                ),
                                                array(
                                                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                                                    "LID" => SITE_ID,
                                                    "ORDER_ID" => "NULL",
                                                    "DELAY" => "Y" //разкоментировать, и только отложенные товары будут получены
                                                ),
                                                false,
                                                false,
                                                array("ID", "DELAY", "PRODUCT_ID")
                                            );
                                            while ($arItems = $dbBasketItems->Fetch()) {
                                                //echo '<pre>';
                                                //var_dump($arItems["PRODUCT_ID"]);
                                                //echo '</pre>';
                                                if ($curItemId == $arItems["PRODUCT_ID"]) {
                                                    $isDelayed = true;
                                                    break;
                                                }
                                            }
                                        }
                                        ?>


                                        <div class="bx_catalog_item_controls_blocktwo test">


                                            <?
                                            if (false) {
                                                ?>
                                                <?
                                                if (!$isDelayed) {
                                                    ?>
                                                    <span class="favorite-icon wishbtn"
                                                          style="float:left; padding-top: 9px; margin-left: 15px;"
                                                          onclick="add2wish('<?= $curItemId ?>','<?= $arItem['PRICES']['BASE']['ID'] ?>','<?= $arItem['PRICES']['BASE']['VALUE'] ?>','<?= $arItem["NAME"] ?>','<?= $arItem["DETAIL_PAGE_URL"] ?>',this)">
                                                            <img src="/bitrix/templates/eshop_adapt_blue/images/favorite.png"
                                                                 style="max-width:32px;">
                                                            <div class="count"
                                                                 style="float: left;"><?= $delaydBasketItems ?></div>
                                                        </span>
                                                    <?
                                                } else {
                                                    ?>
                                                    <span class="favorite-icon wishbtn in_wishlist"
                                                          style="float:left; padding-top: 9px; margin-left: 15px;">
                                                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/favorite_full.png"
                                                                 style="max-width:2px; float: left;"/>
                                                            <div class="count"
                                                                 style="float: left;"><?= $delaydBasketItems ?></div>
                                                        </span>
                                                    <?
                                                } ?>
                                                <?
                                            } ?>

                                            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium addBasketBtn"
                                               href="javascript:void(0)" rel="nofollow"
                                               onclick="yaCounter24968570.reachGoal('click_kupit'); ga('send', 'pageview', '/click_kupit');"><?
                                                echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
                                                ?></a>

                                        </div>
                                    <?
                                    }
                                    else
                                    {
                                    ?>
                                        <!-- RBS_CUSTOM_START -->
                                        <?
                                        $itId = $arItem['ID'] ?: 0;
                                        $SelFeedBack = '#rbs_feedback_' . $itId;
                                        $SelForm = '#rbs_form_feedback_' . $itId;
                                        $idFeedBack = 'rbs_feedback_' . $itId;
                                        $idForm = 'rbs_form_feedback_' . $itId;
                                        $callPop = 'pop' . $itId;
                                        $callPops = $callPop . '.show();';
                                        $popName = 'rbs-feedback-popup ' . $itId;
                                        ?>
                                        <div class="rbs_list rbs-btn-feedback-available" onClick="<?= $callPops ?>">Сообщить о
                                            поступлении
                                        </div>
                                        <script>
                                            var <?=$callPop?> =
                                                BX.PopupWindowManager.create('<?=$popName?>', null, {
                                                    autoHide: false,
                                                    offsetLeft: 0,
                                                    offsetTop: 0,
                                                    overlay: true,
                                                    closeByEsc: true,
                                                    titleBar: true,
                                                    closeIcon: {top: '10px', right: '10px'},
                                                    content:
                                                        '<div class="" id="">' +
                                                        'Оставьте вашу почту для оповщенеия о поступлении товара' +
                                                        '</div>' +
                                                        '<div class="rbs-content-feedback-form" id="<?=$idFeedBack?>">' +
                                                        '<form method="POST" id="<?=$idForm?>" align="center">' +
                                                        '<input type="email" name="email" placeholder="example@email.ru" required>' +
                                                        '<input type="hidden" name="num" value="'+<?=$itId?>+'">'+
                                                        '<input type="submit" value="Отправить">' +
                                                        '</form>' +
                                                        '</div>',
                                                    titleBar: 'Сообщить о поступлении товара'
                                                });


                                            $('<?=$SelForm?>').on('submit', function (e) {

                                                $.ajax({
                                                    url: "/include/rbs_ajax_feedback.php",
                                                    dataType: "json",
                                                    type: 'POST',
                                                    method: 'POST',
                                                    data: $(this).serialize(),
                                                    success: function (data) {
                                                        if (data.TYPE == 'OK') {
                                                            $('<?=$SelFeedBack?>').addClass('rbs-success-msg');
                                                        } else {
                                                            $('<?=$SelFeedBack?>').addClass('rbs-error-msg');
                                                        }

                                                        $('<?=$SelFeedBack?>').html(data.TEXT);
                                                    },
                                                    error: function () {
                                                        $('<?=$SelFeedBack?>').addClass('rbs-error-msg');
                                                        $('<?=$SelFeedBack?>').html('Упс! Возникла ошибка, попробуйте перезагрузить страницу и попробовать снова.');
                                                    }
                                                });
                                                return false;
                                            });
                                        </script>
                                        <!-- RBS_CUSTOM_END -->
                                        <div class="bx_catalog_item_controls_blockone">
                                            <?/*<span class="bx_notavailable"><? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?></span>*/
                                            ?>
                                        </div>
                                    <?
                                    if ('Y' == $arParams['PRODUCT_SUBSCRIPTION'] && 'Y' == $arItem['CATALOG_SUBSCRIPTION'])
                                    {
                                    ?>
                                    <div class="bx_catalog_item_controls_blocktwo">
                                        <a
                                                id="<? echo $arItemIDs['SUBSCRIBE_LINK']; ?>"
                                                class="bx_bt_button_type_2 bx_medium"
                                                href="javascript:void(0)"><?
                                            echo('' != $arParams['MESS_BTN_SUBSCRIBE'] ? $arParams['MESS_BTN_SUBSCRIBE'] : GetMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE'));
                                            ?>
                                        </a>
                                    </div><?
                                    }
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
                                    foreach ($arItem['DISPLAY_PROPERTIES'] as $pid => $arOneProp) {
                                        if (/*$pid == 'AVAILABILITY' || $pid == 'RECOMMENDED_PRICE'*/
                                        in_array($pid, array('AVAILABILITY', 'RECOMMENDED_PRICE', 'NIGHT_PRICE', 'MARGIN', 'SIZE', 'SAMPLE', 'DISCOUNT_PERCENT'))) continue;
                                        if (in_array($pid, array('SIZE_WIDTH', 'SIZE_LENGTH'))) {
                                            if (!$hasSize) { ?>
                                                <br>
                                                <div class="bx_catalog_item_articul_23"><? echo GetMessage('PROP_SIZE_NAME'); ?>:
                                                </div> <?
                                                switch ($pid) {
                                                    case 'SIZE_WIDTH':
                                                        echo $arOneProp['DISPLAY_VALUE'] . 'x' . $arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE'];
                                                        break;
                                                    case 'SIZE_LENGTH':
                                                        echo $arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'] . 'x' . $arOneProp['DISPLAY_VALUE'];
                                                        break;
                                                }
                                                $hasSize = true;
                                            }
                                        } else { ?>
                                            <br>
                                            <div class="bx_catalog_item_articul_23"><? echo $arOneProp['NAME']; ?>:</div> <?
                                            echo(
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
                                    if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])) {
                                        foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
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
                                    if (!$emptyProductProperties) {
                                        ?>
                                        <table>
                                            <?
                                            foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                                ?>
                                                <tr>
                                                    <td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
                                                    <td>
                                                        <?
                                                        if (
                                                            'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                                            && 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
                                                        ) {
                                                            foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                ?><label><input
                                                                type="radio"
                                                                name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                                                value="<? echo $valueID; ?>"
                                                                <? echo($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
                                                                ><? echo $value; ?></label><br><?
                                                            }
                                                        } else {
                                                            ?><select
                                                            name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                            foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                ?>
                                                                <option
                                                                value="<? echo $valueID; ?>"
                                                                <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
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
                                    'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
                                    'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
                                    'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
                                    'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
                                    'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
                                    'ADD_URL' => $arItem['~ADD_URL'],
                                    'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL']
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
                                    var <? echo $strObName; ?> =
                                    new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
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
                                    if ('Y' == $arParams['USE_PRODUCT_QUANTITY']) {
                                        ?>
                                        <?/*---bgn 2017-04-14---*/
                                        ?>
                                        <?php $units_recalc = false;
                                        if ($arItem['ITEM_MEASURE']["TITLE"] == 'кв. м.' && !empty($arItem['DISPLAY_PROPERTIES']['SIZE']) && $arParams['IBLOCK_ID'] == CATALOG_ID) {
                                            $itemSize = str_replace(array('х', ',', ','), array('x', '.', '.'), strtolower($arItem['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']));
                                            $itemSize = explode('x', $itemSize);
                                            if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
                                                $units_recalc = true;
                                            }
                                        } ?>
                                        <?/*---end 2017-04-14---*/
                                        ?>
                                        <div class="bx_catalog_item_controls_blockone">
                                            <a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)"
                                               class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
                                            <input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                   name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>"
                                                   value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>"<?/*---bgn 2017-04-14---*/
                                            ?>
                                                   data-key="<?php echo $key; ?>"<?php if ($units_recalc) { ?> style="display: none;"<?php } ?><?/*---end 2017-04-14---*/
                                            ?>>
                                            <?/*---bgn 2017-04-14---*/
                                            ?>
                                            <?php if ($units_recalc) { ?>
                                                <input class="cm-input unit-quantity-<?php echo $key; ?>"
                                                       data-key="<?php echo $key; ?>" type="text"
                                                       value="<? echo(isset($arItem['OFFERS']) && !empty($arItem['OFFERS']) ? 1 : $arItem['CATALOG_MEASURE_RATIO']); ?>">
                                            <?php } ?>
                                            <?/*---end 2017-04-14---*/
                                            ?>
                                            <a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)"
                                               class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
                                            <span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"<?/*---bgn 2017-04-14---*/
                                            ?><?php if ($units_recalc) { ?> class="hidden"<?php } ?><?/*---end 2017-04-14---*/
                                            ?>></span>
                                        </div>
                                        <?/*---bgn 2017-04-14---*/
                                        ?>
                                        <?php if ($units_recalc) {
                                            $itemSize[0] = floatval($itemSize[0]) / 100; //см. в м.
                                            $itemSize[1] = floatval($itemSize[1]) / 100; //см. в м.
                                            $sqr = $itemSize[0] * $itemSize[1]; //площадь ?>
                                            <div class="calc-measures-<?php echo $key; ?>"
                                                 data-inpt="<? echo $arItemIDs['QUANTITY']; ?>" data-w="<?php echo $itemSize[0]; ?>"
                                                 data-h="<?php echo $itemSize[1]; ?>" data-sqr="<?php echo $sqr; ?>"
                                                 data-pac="<?php echo (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) ? $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['DISPLAY_VALUE'] : 0; ?>"
                                                 data-key="<?php echo $key; ?>">
                                                <a class="active" href="javascript:void(0)"
                                                   data-unit="m"><?php echo $arItem['ITEM_MEASURE']["TITLE"]; ?></a>
                                                <a href="javascript:void(0)" data-unit="i">шт.</a>
                                                <?php /*if (!empty($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) { ?>
                                                        <a href="javascript:void(0)" data-unit="p">упак.</a>
                                                    <?php }*/ ?>
                                                <? /*<div class="hidden">в упаковке <?php echo $arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE']; ?> шт. = <?php echo (intval($arItem['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * 10000) / 10000).' '.$arItem['ITEM_MEASURE']["TITLE"]; ?></div>*/ ?>
                                            </div><br/>
                                        <?php } ?>
                                        <?/*---end 2017-04-14---*/
                                        ?>
                                        <?
                                    }
                                    ?>
                                    <div class="bx_catalog_item_controls_blocktwo">
                                        <a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium"
                                           href="javascript:void(0)" rel="nofollow"><?
                                            echo('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
                                            ?></a>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <?
                            }
                            else {
                                ?>
                                <div class="bx_catalog_item_controls no_touch">
                                    <a class="bx_bt_button_type_2 bx_medium" href="<?=mb_strtolower($arItem['DETAIL_PAGE_URL'])?>"><?
                                        echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
                                        ?></a>
                                </div>
                            <?
                            }
                            ?>
                                <div class="bx_catalog_item_controls touch">
                                    <a class="bx_bt_button_type_2 bx_medium" href="<?=mb_strtolower($arItem['DETAIL_PAGE_URL'])?>"><?
                                        echo('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
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
                                    if ($boolShowProductProps) {
                                        //2018-01-17 добавлено объединение SIZE_WIDTH и SIZE_LENGTH
                                        $hasSize = false;
                                        foreach ($arItem['DISPLAY_PROPERTIES'] as $pid => $arOneProp) {
                                            if (/*$pid == 'AVAILABILITY'*/
                                            in_array($pid, array('AVAILABILITY', 'NIGHT_PRICE', 'MARGIN', 'SIZE', 'SAMPLE'))) continue;
                                            if (in_array($pid, array('SIZE_WIDTH', 'SIZE_LENGTH'))) {
                                                if (!$hasSize) { ?>
                                                    <br>
                                                    <div class="bx_catalog_item_articul_23"><? echo GetMessage('PROP_SIZE_NAME'); ?>
                                                        :
                                                    </div> <?
                                                    switch ($pid) {
                                                        case 'SIZE_WIDTH':
                                                            echo $arOneProp['DISPLAY_VALUE'] . 'x' . $arItem['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE'];
                                                            break;
                                                        case 'SIZE_LENGTH':
                                                            echo $arItem['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'] . 'x' . $arOneProp['DISPLAY_VALUE'];
                                                            break;
                                                    }
                                                    $hasSize = true;
                                                }
                                            } else { ?>
                                                <br>
                                                <div class="bx_catalog_item_articul_23"><? echo $arOneProp['NAME']; ?>:</div> <?
                                                echo(
                                                is_array($arOneProp['DISPLAY_VALUE'])
                                                    ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                                                    : $arOneProp['DISPLAY_VALUE']
                                                );
                                            }
                                        }
                                    }
                                    if ($boolShowOfferProps) {
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
                                    foreach ($arSkuTemplate as $code => $strTemplate) {
                                        if (!isset($arItem['OFFERS_PROP'][$code]))
                                            continue;
                                        echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
                                    }
                                    foreach ($arResult['SKU_PROPS'] as $arOneProp) {
                                        if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
                                            continue;
                                        $arSkuProps[] = array(
                                            'ID' => $arOneProp['ID'],
                                            'SHOW_MODE' => $arOneProp['SHOW_MODE'],
                                            'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
                                        );
                                    }
                                    foreach ($arItem['JS_OFFERS'] as &$arOneJs) {
                                        if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
                                            $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-' . $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] . '%';
                                    }
                                    unset($arOneJs);
                                    ?>
                                </div>
                            <?
                            if ($arItem['OFFERS_PROPS_DISPLAY']) {
                                foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer) {
                                    $strProps = '';
                                    if (!empty($arJSOffer['DISPLAY_PROPERTIES'])) {
                                        foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp) {
                                            $strProps .= '<br>' . $arOneProp['NAME'] . ' <strong>' . (
                                                is_array($arOneProp['VALUE'])
                                                    ? implode(' / ', $arOneProp['VALUE'])
                                                    : $arOneProp['VALUE']
                                                ) . '</strong>';
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
                                    var <? echo $strObName; ?> =
                                    new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
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
            </div>


            <script type="text/javascript">
                BX.message({
                    MESS_BTN_BUY: '<? echo('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_BUY')); ?>',
                    MESS_BTN_ADD_TO_BASKET: '<? echo('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
                    MESS_NOT_AVAILABLE: '<? echo('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
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
            if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
                ?><? echo $arResult["NAV_STRING"]; ?><?
            }
        }?>
    </div>

    <?$textD = PAGE_BOTTOM_TEXT;
    if(!empty($textD) && $textD != "PAGE_BOTTOM_TEXT" && empty($arResult["DESCRIPTION"]) && empty($arParams["PAGEN"])){
        echo str_replace(['<A HREF="/content/dostavka-plitki-i-keramogranita-po-moskve-i-rossii/">Доставка</A>', '<A HREF=" >', "/content/dostavka-plitki-i-keramogranita-po-moskve-i-rossii/"], ['<a href="/dostavka/">Доставка</a>', "", "/dostavka/"], $textD);
    }else if(!empty($arResult["DESCRIPTION"]) && empty($arParams["PAGEN"])){
        echo str_replace(['<A HREF="/content/dostavka-plitki-i-keramogranita-po-moskve-i-rossii/">Доставка</A>', '<A HREF=" >', "/content/dostavka-plitki-i-keramogranita-po-moskve-i-rossii/"], ['<a href="/dostavka/">Доставка</a>', "", "/dostavka/"], $arResult["DESCRIPTION"]);
    }
    ?>
