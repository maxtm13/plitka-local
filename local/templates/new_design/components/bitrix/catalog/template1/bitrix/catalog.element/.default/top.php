<?
\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price");
if ($arResult['PROPERTIES']['NIGHT_PRICE']['VALUE'] == 1 && $arParams["NIGHT"] == 1) {

    $lcur = CCurrency::GetList(($by="name"), ($order1="asc"), LANGUAGE_ID);
    $arCurrency = array();
    while($lcur_res = $lcur->Fetch())
    {
        if(!empty($lcur_res['BASE']) && $lcur_res['BASE'] == 'Y') continue;

        $arCurrency[$lcur_res['CURRENCY']] = $lcur_res['AMOUNT'];
    }
    if (empty($arCurrency['RUB'])) {
        $arCurrency['RUB'] = 1;
    }
    if(!empty($arResult['PROPERTIES']['MARGIN']['VALUE'])){
        $arResult['PROPERTIES']['MARGIN']['VALUE'] = (float)str_replace(',', '.', $arResult['PROPERTIES']['MARGIN']['VALUE']);
        $margin = 1 + $arResult['PROPERTIES']['MARGIN']['VALUE']/100;
    } else {
        $margin = 1;
    }
    $nightPrice = round($arResult['CATALOG_PURCHASING_PRICE'] * $margin * $arCurrency[$arResult['CATALOG_PURCHASING_CURRENCY']]);
    $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] = CurrencyFormat($nightPrice, $arResult['MIN_PRICE']['CURRENCY']);
}
\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price");

$checkdate = date('Y',strtotime(date("Y").'-01-01 -1year'));

/*---bgn 2019-08-09---*/

$percent = (!empty($arResult['PROPERTIES']['DISCOUNT_PERCENT']['VALUE'])) ? abs($arResult['PROPERTIES']['DISCOUNT_PERCENT']['VALUE']) : 0;
$boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF'] || $percent > 0);


$oldPrice = '';
$econom = '';
if ($boolDiscountShow) {
    if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']) {
        $oldPrice = $arResult['MIN_PRICE']['PRINT_VALUE'];
        $econom = $arResult['MIN_PRICE']['PRINT_DISCOUNT_DIFF'];
    } else if ($percent > 0) {
        $oldPrice = round($arResult['MIN_PRICE']['VALUE'] * 100 / (100 - $percent));
        $econom = $oldPrice - $arResult['MIN_PRICE']['VALUE'];
        $oldPrice = CurrencyFormat($oldPrice, $arResult['MIN_PRICE']['CURRENCY']);
        $econom = CurrencyFormat($econom, $arResult['MIN_PRICE']['CURRENCY']);
    }
}
/*---end 2019-08-09---*/?>

<script>
    function add2wish(p_id, pp_id, p, name, dpu, th){
        $.ajax({
            type: "POST",
            url: "/local/ajax/wishlist.php",
            data: "p_id=" + p_id + "&pp_id=" + pp_id + "&p=" + p + "&name=" + name + "&dpu=" + dpu,
            success: function(html){
                $(th).addClass('in_wishlist');
                $('#wishcount').html(html);
                console.log('Сердечко:');
                $('.wishbtn img').attr('src','https://www.plitkanadom.ru/bitrix/templates/eshop_adapt_blue/images/favorite_full.png');
                $('.wishbtn').attr('onclick','javascript:void(0)');
                $count = parseInt($.trim($('.wishbtn').text()));
                $count++;
                console.log('count=', $count);
                $('.wishbtn .count').html($count);

                $('.header_inner_container_auth span.favorite-icon .count').html($count);
                //$('.wishbtn img').after($count);
                //$('.wishbtn').html($new_img + $count);
            }
        });
    }

</script>
<?
if (/*0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']*/ $boolDiscountShow){
    $full='width:100%';
    $align='text-align: left;margin-top: 1px;margin-left: 31px;';
} else {
    $align='text-align: center;margin-top: 1px;margin-left: 18px;';
}
if (!empty($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID']) && in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) { $full.=';float:none;'; }
?>
<meta itemprop="name" content="<?=$arResult['NAME'];?>">
<div class="bx_rt">
    <div class="new-row-even">
        <span id="cena" style="display: none;"><?if($arResult['MIN_PRICE']['VALUE']) { echo $arResult['MIN_PRICE']['VALUE']; } ?></span>
        <div class="item_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="<?=$full;?>">
            <? if (!empty($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID']) && in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) { ?>
                <span class="new-price" id="<? echo $arItemIDs['PRICE']; ?>"><? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price2"); ?><? echo $arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['DISPLAY_VALUE']; ?><? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price2"); ?></span>
            <? } else { ?>
                <?/*---bgn 2019-08-09---*/
                //$boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']);
                ?>
                <? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price4"); ?>
                <?/*---end 2019-08-09---*/
                $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']=str_replace('руб.', '<span class="new-ci">руб.</span>', $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']);
                ?>
                <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price4"); ?>
                <span class="new-price" id="<? echo $arItemIDs['PRICE']; ?>">
			        <? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price5"); ?>
                    <? if($arResult["PROPERTIES"]["Flag_RRC"]["VALUE"] == 1): ?>
                        <? $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] = $arResult["PROPERTIES"]["RECOMMENDED_PRICE"]["VALUE"]; ?>
                    <? endif; ?>
                    <? echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?>
                    <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price5"); ?>
				    <span class="new-ci" id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><?
                        if (!in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))){ //проверка наличия товара
                            echo "/{$arResult['CATALOG_MEASURE_NAME']} "; // выводит ед .изм
                        } ?>
                    </span>
				</span>
                <span class="item_old_price" id="<? echo $arItemIDs['OLD_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>"><? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price3"); ?><? echo ($boolDiscountShow ? /*$arResult['MIN_PRICE']['PRINT_VALUE']*/ $oldPrice : ''); ?><? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price3"); ?></span>
                <?/*---bgn 2019-08-09---*/?>
            <span class="item_economy_price<?=($boolDiscountShow ? '' : ' hide-it'); ?>" id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>">
                <? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price6"); ?>
                <? echo ($boolDiscountShow ? GetMessage('ECONOMY_INFO', array('#ECONOMY#' => /*$arResult['MIN_PRICE']['PRINT_DISCOUNT_DIFF']*/ $econom)) : ''); ?>
                <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price6"); ?>
                </span><?/*---end 2019-08-09---*/?>
            <? } ?>
            <span itemprop="price" class="dn">
			<? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price7"); ?>
            <? echo $arResult['MIN_PRICE']['VALUE']; ?>
            <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price7"); ?>
			</span>
            <? //Постоянная старая цена
            if (($arResult['PROPERTIES']['OLD_PRICE']['VALUE']) > ($arResult['MIN_PRICE']['VALUE']) && empty($arResult['PROPERTIES']['DISCOUNT_PERCENT']['VALUE'])) { ?>
                <span class="tim_old_pice"><? echo round($arResult['PROPERTIES']['OLD_PRICE']['VALUE']);?><? echo GetMessage('OLD_PRICE_MESS_CUR');?></span>
            <? } ?>
            <meta itemprop="priceCurrency" content="<? echo $arResult['MIN_PRICE']['CURRENCY']; ?>" />
        </div>
        <?if($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 3):?>
            <div class="item_current_price">
                <?echo 'Доступно по акционной цене: '; echo $arResult['PRODUCT']['QUANTITY']; ?><span class="measure_discount"><?echo $arResult['CATALOG_MEASURE_NAME']; ?></span>
            </div>
        <?endif;?>
        <?if($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 3):?>
            <div class="dopop">
                <?echo 'Большее количество плитки также можно купить, но по обычной цене (не по акционной)'; ?>
            </div>
        <?endif;?>
        <? /* Начало кнопки купить */ ?>

        <div class="item_info_section">
            <?
            if (!in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))){// скрываем кнопку купить если нет в наличии

            if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
            {
                $canBuy = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
            }
            else
            {
                $canBuy = $arResult['CAN_BUY'];
            }
            if ($canBuy)
            {
                $buyBtnMessage = ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCE_CATALOG_BUY'));
                $buyBtnClass = 'bx_big bx_bt_button bx_cart';
            }
            else
            {
                $buyBtnMessage = ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE'));
                $buyBtnClass = 'bx_big bx_bt_button_type_2 bx_cart';
            }
            if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
            {
                ?>
                <?/*---bgn 2017-04-14---*/?>
                <?php $units_recalc = false;
                //2018-01-17 корректировка: получение размеров из SIZE_WIDTH и SIZE_LENGTH
                if (($arResult['CATALOG_MEASURE_NAME'] == 'кв. м.' || $arResult['CATALOG_MEASURE_NAME'] == 'шт.') && /*!empty($arResult['DISPLAY_PROPERTIES']['SIZE'])*/ !empty($arResult['DISPLAY_PROPERTIES']['SIZE_WIDTH']['VALUE']) && !empty($arResult['DISPLAY_PROPERTIES']['SIZE_LENGTH']['VALUE']) && $arParams['IBLOCK_ID'] == CATALOG_ID) {
                    /*$itemSize = str_replace(array('х', ',', ','), array('x', '.', '.'), strtolower($arResult['DISPLAY_PROPERTIES']['SIZE']['DISPLAY_VALUE']));
                    $itemSize = explode('x', $itemSize);*/
                    $itemSize =array(
                        0 => trim(str_replace(',', '.', $arResult['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'])),
                        1 => trim(str_replace(',', '.', $arResult['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE']))
                    );
                    if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
                        $units_recalc = true;
                    }
                } else if (($arResult['CATALOG_MEASURE_NAME'] == 'кв. м.' || in_array(strtolower($arResult['CATALOG_MEASURE_NAME']), array('упак.','упаковка'))) && !empty($arResult['PROPERTIES']['SHTUK_V_UPAC']['VALUE']) && !empty($arResult['PROPERTIES']['WIDTH_MM']['VALUE']) && !empty($arResult['PROPERTIES']['LENGTH_MM']['VALUE']) && $arParams['IBLOCK_ID'] == CATALOG_FLOOR_ID) {
                    $itemSize =array(
                        0 => trim(str_replace(',', '.', $arResult['PROPERTIES']['WIDTH_MM']['VALUE'])),
                        1 => trim(str_replace(',', '.', $arResult['PROPERTIES']['LENGTH_MM']['VALUE']))
                    );
                    $itemSize[0] = floatval($itemSize[0]) / 1000; //мм. в м.
                    $itemSize[1] = floatval($itemSize[1]) / 1000; //мм. в м.
                    if (is_numeric($itemSize[0]) && is_numeric($itemSize[1])) {
                        $units_recalc = true;
                    }
                } ?>
                <?php if ($units_recalc) {
                if ($arParams['IBLOCK_ID'] == CATALOG_ID) {
                    $itemSize[0] = floatval($itemSize[0]) / 100; //см. в м.
                    $itemSize[1] = floatval($itemSize[1]) / 100; //см. в м.
                    $dataPac = (!empty($arResult['DISPLAY_PROPERTIES']['SHTUK_V_UPAC'])) ? $arResult['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['DISPLAY_VALUE'] : 0;
                } else {
                    $dataPac = (!empty($arResult['PROPERTIES']['SHTUK_V_UPAC'])) ? $arResult['PROPERTIES']['SHTUK_V_UPAC']['VALUE'] : 0;
                }
                $sqr = $itemSize[0] * $itemSize[1]; //площадь ?>
                <div class="calc-measures" data-inpt="<? echo $arItemIDs['QUANTITY']; ?>" data-w="<?php echo $itemSize[0]; ?>" data-h="<?php echo $itemSize[1]; ?>" data-sqr="<?php echo round($sqr * 10000) / 10000; ?>" data-pac="<?php echo $dataPac; ?>">
                    <a class="active" href="javascript:void(0)" data-unit="m"> кв. м.</a>
                    <?if ($arParams['IBLOCK_ID'] == CATALOG_ID) {?>
                        <a <?if ($arResult['CATALOG_MEASURE_NAME'] == 'шт.'):?>class="active"<?endif?> href="javascript:void(0)" data-unit="i"> шт.</a>
                    <?}
                    if (!empty($dataPac) && $arParams['IBLOCK_ID'] == CATALOG_FLOOR_ID) { ?>
                        <a <?if (in_array(strtolower($arResult['CATALOG_MEASURE_NAME']), array('упак.', 'упаковка'))):?>class="active"<?endif?> href="javascript:void(0)" data-unit="p">упак.</a>
                    <?}?>
                    <?/*<div class="hidden">в упаковке <?php echo $arResult['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE']; ?> шт. = <?php echo (intval($arResult['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * 10000) / 10000).' '.$arResult['CATALOG_MEASURE_NAME']; ?></div>*/?>
                </div>
            <?php } ?>
                <?/*---end 2017-04-14---*/?>
                <div class="item_buttons vam">
                    <div class="item_bu ons_counter_block">
                        <a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb new-minus" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</a><input id="<? echo $arItemIDs['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
                            ? 1
                            : $arResult['CATALOG_MEASURE_RATIO']
                        ); ?>"<?/*---bgn 2017-04-14---*/?><?php if ($units_recalc) { ?> style="display: none;"<?php } ?><?/*---end 2017-04-14---*/?>><?/*---bgn 2017-04-14---*/?><?php if ($units_recalc) { ?><input id="unit-quantity" type="text" class="tac transparent_input" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) ? 1 : $arResult['CATALOG_MEASURE_RATIO']); ?>"><?php } ?><?/*---end 2017-04-14---*/?><a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb new-plus" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</a>
                        <span id="testizm"><?=str_replace(" ", "", $arResult['CATALOG_MEASURE_NAME']);?></span>
                    </div>
                    <span class="item_buttons_counter_block">
					<a href="javascript:void(0);" class="buy-btn bx_cart addBasketBtn" id="<? echo $arItemIDs['BUY_LINK']; ?>"><?=$buyBtnMessage?></a>
		<?
        if ('Y' == $arParams['DISPLAY_COMPARE'])
        {
            ?>
                
            <?
        }
        ?>
				</span>
                    <? if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>
                        <div class="v_rassrochku">Доступно в рассрочку</div>
                    <? endif; ?>
                </div>
                <?
                if ('Y' == $arParams['SHOW_MAX_QUANTITY'])
                {
                    if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
                    {
                        ?>
                        <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>" style="display: none;"><? echo GetMessage('OSTATOK'); ?>: <span></span></p>
                        <?
                    }
                    else
                    {
                        if ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO'])
                        {
                            ?>
                            <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>"><? echo GetMessage('OSTATOK'); ?>: <span><? echo $arResult['CATALOG_QUANTITY']; ?></span></p>
                            <?
                        }
                    }
                }
            }
            else
            {
                ?>
                <div class="item_buttons vam">
				<span class="item_buttons_counter_block">
					<a href="javascript:void(0);" class="buy-btn bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo $buyBtnMessage; ?></a>
		<?
        if ('Y' == $arParams['DISPLAY_COMPARE'])
        {
            ?>
            <a id="<? echo $arItemIDs['COMPARE_LINK']; ?>" href="javascript:void(0)" class="bx_big bx_bt_button_type_2 bx_cart" style="margin-left: 10px"><? echo ('' != $arParams['MESS_BTN_COMPARE']
                    ? $arParams['MESS_BTN_COMPARE']
                    : GetMessage('CT_BCE_CATALOG_COMPARE')
                ); ?></a>
            <?
        }
        ?>
				</span>
                    <? if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>
                        <div class="v_rassrochku">Доступно в рассрочку</div>
                    <? endif; ?>
                </div>
                <?
            }
            ?>
        </div>
    <? /*RBS_CUSTOM_START*/

    } else {
    ?>
    <input class="rbs-btn-feedback-available" type="button" onClick="pop.show();" value="Сообщить о поступлении">
        <script>
            var pop = BX.PopupWindowManager.create('rbs-feedback-popup', null, {
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
                    '<div class="rbs-content-feedback-form" id="rbs_feedback">'+
                    '<form method="POST" id="rbs_form_feedback">'+
                    '<input type="email" name="email" placeholder="example@email.ru" required>'+
                    '<input type="hidden" name="num" value="'+<?=$arResult['ID']?:0?>+'">'+
                    '<input type="submit" value="Отправить">'+
                    '</form>'+
                    '</div>',
                titleBar: 'Сообщить о поступлении товара'
            });

            $('#rbs_form_feedback').on('submit', function(e){

                $.ajax({
                    url: "/include/rbs_ajax_feedback.php",
                    dataType: "json",
                    type: 'POST',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(data){
                        if(data.TYPE == 'OK'){
                            $('#rbs_feedback').addClass('rbs-success-msg');
                        } else {
                            $('#rbs_feedback').addClass('rbs-error-msg');
                        }

                        $('#rbs_feedback').html(data.TEXT);
                    },
                    error: function(){
                        $('#rbs_feedback').addClass('rbs-error-msg');
                        $('#rbs_feedback').html('Упс! Возникла ошибка, попробуйте перезагрузить страницу и попробовать снова.');
                    }
                });
                return false;
            });
        </script>
        <?}
        /*RBS_CUSTOM_END*/
        ?>

        <!-- Конец кнопки купить -->
    </div>
    <div class="product-code">Код товара: <strong><?=$arResult['ID'];?></strong></div>
    <div class="product-stars">
        <?
        //Общее количество отложенных товаров
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


        //Проверяем, есть ли текущий товар в отложенных.
        $isDelayed = false;
        if(\Bitrix\Main\Loader::includeModule("sale"))
        {
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
            while ($arItems = $dbBasketItems->Fetch())
            {
                //echo '<pre>';
                //print_r($arItems["PRODUCT_ID"]);
                //echo '</pre>';
                if($arResult["ID"]==$arItems["PRODUCT_ID"]){
                    $isDelayed = true;
                    break;
                }
            }
        }

        ?>
        <?
        global $USER;
        //var_dump($USER->IsAuthorized());
        if ($USER->IsAuthorized() && $arResult["ACTIVE"] == "Y"){?>
            <?if(!$isDelayed){?>
                <span class="favorite-icon wishbtn"
                      onclick="add2wish('<?=$arResult["ID"]?>','<?=$arResult["CATALOG_PRICE_ID_1"]?>','<?=$arResult["CATALOG_PRICE_1"]?>','<?=$arResult["NAME"]?>','<?=$arResult["DETAIL_PAGE_URL"]?>',this)">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/favorite.png" alt="Favorite-Whishlist"/>
						<div class="count"><?=$delaydBasketItems?></div>
					</span>
            <?}else{?>
                <span class="favorite-icon wishbtn in_wishlist">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/favorite_full.png" alt="Whishlist" />
						<div class="count"><?=$delaydBasketItems?></div>
					</span>
            <?}
        }
        ?>
        <?
        $useBrands = ('Y' == $arParams['BRAND_USE']);
        $useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
        if ($useBrands || $useVoteRating)
        {

            ?>


            <div class="new-vote bx_optionblock">
                <?
                if ($useVoteRating)
                {
                    ?><? /* $APPLICATION->IncludeComponent(
                "bitrix:iblock.vote",
                "stars1",
                array(
                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                    "ELEMENT_ID" => $arResult['ID'],
                    "ELEMENT_CODE" => "",
                    "MAX_VOTE" => "5",
                    "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
                    "SET_STATUS_404" => "N",
                    "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                    "CACHE_TIME" => $arParams['CACHE_TIME']
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            ); */ ?><?
                }
                if ($useBrands)
                {
                    ?><?$APPLICATION->IncludeComponent("bitrix:catalog.brandblock", ".default", array(
                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                    "ELEMENT_ID" => $arResult['ID'],
                    "ELEMENT_CODE" => "",
                    "PROP_CODE" => $arParams['BRAND_PROP_CODE'],
                    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                    "CACHE_TIME" => $arParams['CACHE_TIME'],
                    "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                    "WIDTH" => "",
                    "HEIGHT" => ""
                ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );?><?
                }
                ?>
            </div>
            <?
        }
        unset($useVoteRating);
        unset($useBrands);
        ?>

    </div>
    <div class="prop-icon2">
        <? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("icon2"); ?>
        <? if($arResult["HIDE_ICON"] != true):?>
            <?if($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 1):?>
                <div class="new-icon">
                    <img src="/bitrix/templates/eshop_adapt_blue/components/bitrix/catalog/template1/bitrix/catalog.element/.default/images/1.png" alt="Бесплатная
доставка">
                    <a href="/dostavka/" target="_blank"><span style="border-bottom: 2px dotted; color: #3e77aa;">Бесплатная<br>доставка</span></a>
                </div>
                <div class="new-icon">
                    <img src="/bitrix/templates/eshop_adapt_blue/components/bitrix/catalog/template1/bitrix/catalog.element/.default/images/2.png" alt="Возможны
скидки">
                    <span>Возможны<br>скидки</span>
                </div>
                <div class="new-icon">
                    <img src="/local2/templates/new_design/images/rassrochka_v4.png" alt="Доступно в рассрочку"/>
                    <span>Доступно<br>в рассрочку</span>
                </div>
            <? elseif($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 2):?>
                <a href="/promotions/aktsiya-na-proizvoditeley-delacora-altacera-kerama-marazzi-uralkeramika-alma-ceramica-italon-laparet/"><img src="/image/banner_2.jpg" class="banner-img" / ></a>
            <? elseif($arResult['PROPERTIES']['DISCOUNT']['VALUE'] == 4):?>
                <a href="/promotions/aktsiya-na-proizvoditeley-delacora-new-trend-coliseum-gres-altacera-uralkeramika-alma-ceramica-lapar/"><img class="banner-img" src="/image/akzii_v4.jpg" / ></a>
            <? endif;?>
        <? endif; ?>
        <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("icon2"); ?>
        <?if(!empty($arResult['PROPERTIES']['HITS']['VALUE'])):?>
            <span class="prop-ico-hit" title="<?= GetMessage("HIT_TITLE")?>"></span>
        <?endif;?>
        <?if(!empty($arResult['PROPERTIES']['SAMPLE']['VALUE'])):?>
            <div class="new-icon">
                <img src="/bitrix/templates/eshop_adapt_blue/components/bitrix/catalog/template1/bitrix/catalog.element/.default/images/3.png" alt="Есть образец">
                <span>Есть<br>образец</span>
            </div>
        <?endif;?>
        <?if(date('Y',strtotime($arResult['DATE_CREATE'])) >= $checkdate):?>
            <div class="stickers" style="
    position: absolute;
    top: -53px;
    right: 0;
    ">
                <span class="sticker_novinka_element">Новинка</span>
            </div>
        <?endif;?>
        <div style="clear: left;"></div>

    </div>

    <? if (!empty($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID']) && in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) { ?></div><?}?>
<div style="clear: left;"></div>
<div class="item_info_section" itemprop="description">
    <?
    if (!empty($arResult['DISPLAY_PROPERTIES']))
    {
        ?>
        <div class="is-goods__title">Характеристики:</div>
        <? $hasSize = false;
        foreach ($arResult['DISPLAY_PROPERTIES'] as $pcode => &$arOneProp){

            if (in_array($pcode, array('NIGHT_PRICE', 'MARGIN', 'SIZE', 'DISCOUNT_PERCENT'))) continue;
            if (in_array($pcode, array('SIZE_WIDTH', 'SIZE_LENGTH'))) {
                if (!$hasSize) { ?>
                    <div class="new-row">
                        <span class="side-left"><? echo GetMessage('PROP_SIZE_NAME'); ?></span>
                        <span class="side-right"><? switch ($pcode) {
                                case 'SIZE_WIDTH':
                                    echo $arOneProp['DISPLAY_VALUE'].'x'.$arResult['DISPLAY_PROPERTIES']['SIZE_LENGTH']['DISPLAY_VALUE'];
                                    break;
                                case 'SIZE_LENGTH':
                                    echo $arResult['DISPLAY_PROPERTIES']['SIZE_WIDTH']['DISPLAY_VALUE'].'x'.$arOneProp['DISPLAY_VALUE'];
                                    break;
                            }
                            $hasSize = true; ?>
						</span>
                        <div class="clear"></div>
                    </div>
                <? }
            } else { ?>
                <? if ($arParams['IBLOCK_ID'] == 4 && $arOneProp['CODE'] == "MANUFAC_FIL") : ?>
                    <div class="new-row">
                        <span class="side-left"><? echo GetMessage('MANUFACTURER') ?></span>
                        <a class="side-right" href="<? echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] ?>"><? echo $arResult['SECTION']['PATH'][1]['NAME'] ?></a>
                        <div class="clear"></div>
                    </div>
                    <div class="new-row">
                        <span class="side-left"><? echo GetMessage('COLLECTION') ?></span>
                        <a class="side-right" href="<? echo $arResult['SECTION']['PATH'][2]['SECTION_PAGE_URL'] ?>"><? echo $arResult['SECTION']['PATH'][2]['NAME'] ?></a>
                        <div class="clear"></div>
                    </div>
                <? elseif ($arParams['IBLOCK_ID'] == 9 && $arOneProp['CODE'] == "MANUFACTURE") : ?>
                    <div class="new-row">
                        <span class="side-left"><? echo GetMessage('MANUFACTURER') ?></span>
                        <a class="side-right" href="<? echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] ?>"><? echo $arResult['SECTION']['PATH'][1]['NAME'] ?></a>
                        <div class="clear"></div>
                    </div>
                <? elseif ($arParams['IBLOCK_ID'] == 9 && $arOneProp['CODE'] == "KOLLEKTSIA") : ?>
                    <div class="new-row">
                        <span class="side-left"><? echo GetMessage('COLLECTION') ?></span>
                        <a class="side-right" href="<? echo $arResult['SECTION']['PATH'][2]['SECTION_PAGE_URL'] ?>"><? echo $arResult['SECTION']['PATH'][2]['NAME'] ?></a>
                        <div class="clear"></div>
                    </div>
                <? elseif ($arParams['IBLOCK_ID'] == 11 && $arOneProp['CODE'] == "MANUFACTURER") : ?>
                    <div class="new-row">
                        <span class="side-left"><? echo GetMessage('MANUFACTURER') ?></span>
                        <a class="side-right" href="<? echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] ?>"><? echo $arResult['SECTION']['PATH'][1]['NAME'] ?></a>
                        <div class="clear"></div>
                    </div>
                <? else: ?>
                    <div class="new-row">
                        <span class="side-left"><? echo $arOneProp['NAME']; ?></span>
                        <span class="side-right"><?=(is_array($arOneProp['DISPLAY_VALUE']) ? implode(' / ', $arOneProp['DISPLAY_VALUE']) : $arOneProp['DISPLAY_VALUE']); ?></span>
                        <div class="clear"></div>
                    </div>
                <? endif; ?>
            <?  }
        }
        unset($arOneProp);
        ?>
    <? } ?>
</div>
</div>
<div style="clear: left;height: 15px;"></div>
<div class="bx_md" >
    <div class="prim">
        <div><img src="/upload/prim/1.png" alt="Вам не хватило? Можно дозаказать"> <span>Вам не хватило?<br>Можно дозаказать!</span></div>
        <div><img src="/upload/prim/2.png" alt="Без предоплаты!"> <span>Без предоплаты!</span></div>
        <div><img src="/upload/prim/3.png" alt="Мы всегда перезваниваем"> <span>Мы всегда<br>перезваниваем!</span></div>
        <div><img src="/upload/prim/4.png" alt="Огромный выбор. 400 000 товаров!"> <span>Огромный выбор<br>400 000 товаров!</span></div>
        <div><a href="/dostavka/" target="_blank"><img src="/upload/prim/9.png" alt="Быстрая Доставка по всей России!"><span style="text-decoration: Dotted underline;">Быстрая Доставка<br> по всей России!</span></a></div>
        <div><a href="/promotions/nashli-deshevle-my-snizim-tsenu/" target="_blank"><img src="/upload/prim/8.png" alt="Гарантия низкой цены!"><span style="text-decoration: Dotted underline;">Гарантия<br>низкой цены!</span></a></div>
        <div><a href="tel:+74957777121"><img src="/upload/prim/10.png" alt="Возможность получения скидки по телефону!"><span style="text-decoration: Dotted underline;">Возможность <br>получения скидки<br> по телефону!</span></a></div>
        <div><a href="/oplata/rassrochka/" target="_blank"><img src="/local2/templates/new_design/images/rassrochka_v4.png" alt="Доступно в рассрочку"><span style="text-decoration: Dotted underline;">Оплата <br>в рассрочку</span></a></div>
    </div>
</div>
