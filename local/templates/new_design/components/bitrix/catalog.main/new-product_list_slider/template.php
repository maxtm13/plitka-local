<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult["IDS"])): ?>
<div class="is-goods__slider<?= $arParams["MARGIN"] == "N" ? ' no-margin' : ''; ?>">
    <div class="is-goods__title">
        <? if (!empty($arParams["TITLE"])): ?>
            <?= $arParams["TITLE"]; ?><?= (!empty($arResult["SECTION_NAME"]) ? " " . $arResult["SECTION_NAME"] : ''); ?>
        <? else: ?>
            <? if ($arParams["TYPE"] == "COLLECTION"): ?>
                <?= getMessage("SLIDER_TITLE_" . $arParams["TYPE"] . "_" . $arParams["IBLOCK_ID"]); ?> <?= $arParams["IS_FILTER"]["PROPERTY_COLLECTION"]; ?><?= $arResult["SECTION_NAME"]; ?>
            <? else: ?>
                <?= getMessage("SLIDER_TITLE_" . $arParams["TYPE"]); ?>
            <? endif; ?>
        <? endif; ?>
    </div>
    <div class="goods__slider  swiper">
        <div class="is-goods__list  swiper-wrapper">
            <? // pre($arResult); ?>
            <? foreach ($arResult["IDS"] as $isid):
                $pr = $dp = '';
                $sale = 0;
                $item = $arResult["GOODS"][$isid];
                if ($item['PICTURE']['width'] > $item['PICTURE']['height']) {
                    $imgstyle = "po-shirine";
                }
                if ($item['PICTURE']['width'] = $item['PICTURE']['height']) {
                    $imgstyle = "kvadrat";
                }
                if ($item['PICTURE']['width'] < $item['PICTURE']['height']) {
                    $imgstyle = "po-visote";
                }

                if ($item["NIGHT_PRICE"] == 1 && $arParams["NIGHT"] == 1) {
                    $pr = getNightPrice($item["MARGIN"], $item["CATALOG_PURCHASING_PRICE"], $item["CATALOG_PURCHASING_CURRENCY"]);
                } else {
                    $pr = $arResult["PRICES"][$item["ID"]]["PRICE"];
                    $dp = $arResult["PRICES"][$item["ID"]]["DISCOUNT_PRICE"];
                    if (!empty($item["OLD_PRICE"]) && $pr == $dp) {
                        $pr = $item["OLD_PRICE"];
                    }
                    if ($pr > $dp && $arResult["PRICES"][$item["ID"]]["DISCOUNT_PRICE"] < $arResult["PRICES"][$item["ID"]]["PRICE"]) {
                        $sale = round((1 - $dp / $pr) * 100, 1);
                    }
                }
                ?>
                <div class="is-goods__block swiper-slide <?= $imgstyle; ?>">
                    <div class="is-goods__block-card">
                        <div class="card__inner">
                            <a href="<?= $item["DETAIL_PAGE_URL"]; ?>">
                                <span class="is-height"></span>
                                <? if ($sale > 0): ?>
                                    <span class="stiker skidka">-<?= $sale; ?>%</span>
                                <? endif; ?>
                                <? if ($item['IS_NEW'] == true): ?>
                                    <div class="stiker isnew">Новинка</div>
                                <? endif; ?>
                                <? if ($item['DISCOUNT'] == 1): ?>
                                    <? if ($item["NIGHT_PRICE"] == 1 && $arParams["NIGHT"] == 1): ?>
                                        <div class="stiker isdeliverysale<? if ($item['IS_NEW'] == true): ?> have-new<? endif; ?>"
                                             title="<?= getMessage('DICOUNT_TITLE_LIFT'); ?>"><?= getMessage('DICOUNT_TITLE_STICKER'); ?></div>
                                    <? else: ?>
                                        <div class="stiker isdeliverysale<? if ($item['IS_NEW'] == true): ?> have-new<? endif; ?>"
                                             title="<?= getMessage('DICOUNT_TITLE'); ?>"><?= getMessage('DICOUNT_TITLE_STICKER'); ?></div>
                                    <? endif; ?>
                                <? endif; ?>
                                <? if ($item['DISCOUNT'] == 2): ?>
                                    <? if ($item["NIGHT_PRICE"] == 1 && $arParams["NIGHT"] == 1): ?>
                                        <div class="stiker isdelivery"
                                             title="<?= getMessage('DICOUNT_TITLE2_LIFT'); ?>"><?= getMessage('DICOUNT_TITLE2_STICKER'); ?></div>
                                    <? else: ?>
                                        <div class="stiker isdelivery"
                                             title="<?= getMessage('DICOUNT_TITLE2'); ?>"><?= getMessage('DICOUNT_TITLE2_STICKER'); ?></div>
                                    <? endif; ?>
                                <? endif; ?>
                                <? if (!empty($item["PICTURE"])): ?>
                                    <img class="is-img" src="<?= $item["PICTURE"]["src"]; ?>"
                                         alt="<?= $item["NAME"]; ?>"/>
                                <? else: ?>
                                    <img class="is-img" src="/image/new_design/empty.jpg" alt="<?= $item["NAME"]; ?>"/>
                                <? endif; ?>
                                <strong class="is-goods__name"><?= $item["NAME"]; ?></strong>
                                <p class="goods__id">Артикул <?= $item['PROPS']['BAU_CODE']; ?></p>
                                <span class="is-goods__price"><? if ($dp > 0 && $pr > $dp) { ?><span
                                            class="is-goods__price-old"><?= number_format($pr, 0, '', ' '); ?>
                                        руб.</span><? } ?><?= number_format(($dp > 0 ? $dp : $pr), 0, '', ' '); ?> <span
                                            class="is-quanty__type">руб.<?= (!empty($item["UNITS_TMP"]) ? '/' . $item["UNITS_TMP"] : ''); ?></span></span>
                            </a>
                            <div class="is-goods__basket" data-id="<?= $item["ID"]; ?>"></div>
                        </div>
                        <div class="addon__section">
                            <?php if  (!$freeDelivery)  ?> <img class="addon-pict" src="/image/icons/Frame%204.svg" alt="free delivery" > <?php endif;?>
                            <?php if  (!$sale)  ?><img class="addon-pict" src="/image/icons/Frame%205.svg" alt="sale" > <?php endif;?>
                            <?php if  (!$gift)  ?> <img class="addon-pict" src="/image/icons/Frame%206.svg" alt="gift" > <?php endif;?>
                            <?php if  (!$hit)  ?> <img class="addon-pict" src="/image/icons/Frame%207.svg" alt="hit"> <?php endif;?>

                        </div>

                    </div>

                </div>
            <? endforeach; ?>
        </div>

        <!--	</div>-->
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <?= $arResult["PAGINATION"]; ?>
    <? endif; ?>

    <script>
        $(document).ready(function () {

            const swiper = new Swiper('.goods__slider', {
                slidesPerView: 4,
                spaceBetween: 28,

                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
            const $slider = $('.is-goods__slider');
            $('.prop-icon2').after($slider);
        })
    </script>
