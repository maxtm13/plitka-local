<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

    <div class="tab-panel">
    <div class="left-tab">

        <div class="button-up">
            <div class="button-one" onclick="window.location.href=' https://www.plitkanadom.ru/3d-design/';"></div>
            <div class="button-two"  onclick="window.location.href=' https://www.plitkanadom.ru/3d-design-online/';"></div>
        </div>
        <div class="property">
            <div class="item_info_section" itemprop="description">
                <?
                if (!empty($arResult['DISPLAY_PROPERTIES']))
                {
                    ?>
                    <div class="is-goods_title">Характеристики:</div>
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
                                <!--<div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('MANUFACTURER') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][1]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>
                        <div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('COLLECTION') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][2]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][2]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
                            <? elseif ($arParams['IBLOCK_ID'] == 9 && $arOneProp['CODE'] == "MANUFACTURE") : ?>
                                <!--<div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('MANUFACTURER') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][1]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
                            <? elseif ($arParams['IBLOCK_ID'] == 9 && $arOneProp['CODE'] == "KOLLEKTSIA") : ?>
                                <!-- <div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('COLLECTION') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][2]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][2]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
                            <? elseif ($arParams['IBLOCK_ID'] == 11 && $arOneProp['CODE'] == "MANUFACTURER") : ?>
                                <!--    <div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('MANUFACTURER') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][1]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
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
    </div>
        <div class = "frame_2">
            <div class="new-row-even">
                <div class = "frame_24">
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
                                <? echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?>
                                <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price5"); ?>
				<span class="new-ci" id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><?
                    if (!in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))){ //проверка наличия товара
                        echo "/{$arResult['CATALOG_MEASURE_NAME']} "; // выводит ед .изм
                    } ?></span>
				</span>
                            <span class="item_old_price" id="<? echo $arItemIDs['OLD_PRICE']; ?>" style="display: <? echo ($boolDiscountShow ? '' : 'none'); ?>" id="pricePerUnit"><? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("price3"); ?><? echo ($boolDiscountShow ? /*$arResult['MIN_PRICE']['PRINT_VALUE']*/ $oldPrice : ''); ?><? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("price3"); ?></span>
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
                            <span class="tim_old_pice" id="pricePerUnit"><? echo round($arResult['PROPERTIES']['OLD_PRICE']['VALUE']);?><? echo GetMessage('OLD_PRICE_MESS_CUR');?></span>
                        <? } ?>
                        <meta itemprop="priceCurrency" content="<? echo $arResult['MIN_PRICE']['CURRENCY']; ?>" />
                    </div>
                    <div class="frame_22"><div class="frame_21">
                            <?
                            // Преобразуем $arItemIDs['PRICE'] в число. Если это уже число, преобразование не изменит его.
                            $priceString = $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE'];
                            // Удаляем все, кроме цифр
                            $numbersOnly = preg_replace('/\D/', '', $priceString);
                            // Преобразуем очищенную строку в число
                            $price = intval($numbersOnly);
                            // Теперь безопасно выполняем деление
                            $rass = $price/3;
                            $rass = round($rass);
                            ?>
                            <?=$rass;?> руб/м<sup>2</sup>
                        </div>
                        <div class="frame_23">
                            х 3 мес в рассрочку
                        </div>
                    </div>
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

                <div class="item_info_section_1">
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
                            <a <?if ($arResult['CATALOG_MEASURE_NAME'] == 'кв. м.'):?>class="active"<?endif?> href="javascript:void(0)" data-unit="m" id="calculatePric1"> кв. м.</a>
                            <?if ($arParams['IBLOCK_ID'] == CATALOG_ID) {?>
                                <a <?if ($arResult['CATALOG_MEASURE_NAME'] == 'шт.'):?>class="active"<?endif?> href="javascript:void(0)" data-unit="i" id="calculatePrice"> шт.</a>
                            <?}?>
                               <?if (!empty($dataPac) && $arParams['IBLOCK_ID'] == CATALOG_FLOOR_ID) { ?>
						<a <?if (in_array(strtolower($arResult['CATALOG_MEASURE_NAME']), array('упак.', 'упаковка'))):?>class="active"<?endif?> href="javascript:void(0)" data-unit="p">упак.</a>
					<?}?>
                            <div class="hidden">в упаковке <?php echo $arResult['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE']; ?> шт. = <?php echo (intval($arResult['DISPLAY_PROPERTIES']['SHTUK_V_UPAC']['VALUE'] * $sqr * 10000) / 10000).' '.$arResult['CATALOG_MEASURE_NAME']; ?></div>
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
					<a href="javascript:void(0);" class="buy-btn bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><?=$buyBtnMessage?></a>
		<?
        if ('Y' == $arParams['DISPLAY_COMPARE'])
        {
            ?>
            <a href="javascript:void(0)" class="bx_big bx_bt_button_type_2 bx_cart" style="margin-left: 10px"><? echo ('' != $arParams['MESS_BTN_COMPARE']
                    ? $arParams['MESS_BTN_COMPARE']
                    : GetMessage('CT_BCE_CATALOG_COMPARE')
                ); ?></a>
            <?
        }
        ?>
				</span>
                            <? if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>

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
                <div class="obrazec"  onclick="window.location.href=' https://www.plitkanadom.ru/3d-design/';">  </div>
                <div class="one-click"> Купить в 1 клик </div>
            </div>
        </div>
    </div>
   <!--<div class="one"> <img src="/local/templates/new_design/components/bitrix\catalog\template1\bitrix\catalog.element\.default\12.JPG"></div>
-->
</div>
<div class="tab">
<div class="tabs">
    <div class="tablinks " onclick="openTab(event, 'Tab1')"><h3>Характеристики</h3></div>
    <div class="tablinks" onclick="openTab(event, 'Tab2')"><h3>Отзывы</h3></div>
    <div class="tablinks" onclick="openTab(event, 'Tab3')"><h3>Вопросы и ответы</h3></div>
</div>
<div class="content-tab">
<div id="Tab1" class="tabcontent active">
<br>

    <?php if ($arResult['DETAIL_TEXT']): ?>
        <div class="product-description">
            <?= $arResult['DETAIL_TEXT']; ?>
        </div>
    <?php endif; ?>
    <br>
    <div class="item_info_section" itemprop="description">
        <?
        if (!empty($arResult['DISPLAY_PROPERTIES']))
        {
            ?>
            <div class="is-goods_title">Характеристики:</div>
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
                        <!--<div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('MANUFACTURER') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][1]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>
                        <div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('COLLECTION') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][2]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][2]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
                    <? elseif ($arParams['IBLOCK_ID'] == 9 && $arOneProp['CODE'] == "MANUFACTURE") : ?>
                        <!--<div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('MANUFACTURER') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][1]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
                    <? elseif ($arParams['IBLOCK_ID'] == 9 && $arOneProp['CODE'] == "KOLLEKTSIA") : ?>
                        <!-- <div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('COLLECTION') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][2]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][2]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
                    <? elseif ($arParams['IBLOCK_ID'] == 11 && $arOneProp['CODE'] == "MANUFACTURER") : ?>
                        <!--    <div class="new-row">
                            <span class="side-left"><?/* echo GetMessage('MANUFACTURER') */?></span>
                            <a class="side-right" href="<?/* echo $arResult['SECTION']['PATH'][1]['SECTION_PAGE_URL'] */?>"><?/* echo $arResult['SECTION']['PATH'][1]['NAME'] */?></a>
                            <div class="clear"></div>
                        </div>-->
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

<div id="Tab2" class="tabcontent">

    <p>Отзывы</p>
</div>

<div id="Tab3" class="tabcontent">

    <p>Вопросы и ответы</p>
</div>
</div>
</div>
<div class="prim">
    <div><img src="/upload/prim/1.png" alt="Вам не хватило? Можно дозаказать"> <span>Вам не хватило?<br>Можно дозаказать!</span></div>
    <div><img src="/upload/prim/2.png" alt="Без предоплаты!"> <span>Без предоплаты!</span></div>
    <div><img src="/upload/prim/3.png" alt="Мы всегда перезваниваем"> <span>Мы всегда<br>перезваниваем!</span></div>
    <div><img src="/upload/prim/4.png" alt="Огромный выбор. 400 000 товаров!"> <span>Огромный выбор<br>400 000 товаров!</span></div>
    <div><a href="/dostavka/" target="_blank"><img src="/upload/prim/9.png" alt="Быстрая Доставка по всей России!"><span style="text-decoration: Dotted underline;">Быстрая Доставка<br> по всей России!</span></a></div>
    <div><a href="/promotions/nashli-deshevle-my-snizim-tsenu/" target="_blank"><img src="/upload/prim/8.png" alt="Гарантия низкой цены!"><span style="text-decoration: Dotted underline;">Гарантия<br>низкой цены!</span></a></div>
    <div><a href="tel:+74957777121"><img src="/upload/prim/10.png" alt="Возможность получения скидки по телефону!"><span style="text-decoration: Dotted underline;">Возможность <br>получения скидки<br> по телефону!</span></a></div>
    <div><a href="/oplata/rassrochka/" target="_blank"><img src="/local/templates/new_design/images/rassrochka_v4.png" alt="Доступно в рассрочку"><span style="text-decoration: Dotted underline;">Оплата <br>в рассрочку</span></a></div>
</div>
    <? if (!empty($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID']) && in_array($arResult['DISPLAY_PROPERTIES']['AVAILABILITY']['VALUE_ENUM_ID'], array(4914, 5044, 5649))) { ?></div><?}?>
<div style="clear: left;"></div>

<div style="clear: left;height: 15px;"></div>
<div class="bx_md" >

</div>
<script>
    function openTab(evt, tabName) {
        // Получение всех элементов с классом "tabcontent" и их скрытие
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Удаление класса "active" у всех элементов, чтобы подсветить только активную вкладку
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Показываем текущий таб и добавляем класс "active" к кнопке, которая открыла таб
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Добавляем обработчик события к загрузке документа, чтобы выбрать первую вкладку
    document.addEventListener("DOMContentLoaded", function() {
        // Эмулируем клик по первой вкладке
        if(document.getElementsByClassName("tablinks").length > 0) {
            document.getElementsByClassName("tablinks")[0].click();
        }
    });
</script>
<script>
    // Функция расчёта
    function calculatePrice() {
        // Предположим, что ваш расчёт основан на этих переменных
        var oldPrice = <? echo round($arResult['PROPERTIES']['OLD_PRICE']['VALUE']);?>;

        const quantity =   <?php echo json_encode($sqr); ?>; // Количество
        const one =Math.ceil( 1/quantity);

        // Проверка, чтобы избежать деления на ноль
        if (quantity > 0) {
            const pricePerUnit = oldPrice / one;

            // Обновление содержимого элемента с результатом
            document.getElementById('pricePerUnit').innerText = Math.ceil(pricePerUnit); // Округляем до двух знаков после запятой
        }
    }

    // Добавление обработчика события клика к ссылке
    document.getElementById('calculatePrice').addEventListener('click', calculatePrice);
</script>
<script>
    // Функция расчёта
    function calculatePrice1() {
        // Предположим, что ваш расчёт основан на этих переменных
        var oldPrice = <? echo round($arResult['PROPERTIES']['OLD_PRICE']['VALUE']);?>;


            document.getElementById('pricePerUnit').innerText = Math.ceil(oldPrice); // Округляем до двух знаков после запятой

    }

    // Добавление обработчика события клика к ссылке
    document.getElementById('calculatePric1').addEventListener('click', calculatePrice1);
</script>
