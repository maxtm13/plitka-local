<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult['ITEMS'])):?>
    <div class="sort-brands">
        <div class="sort-brands__wrap">
            <div class="sort-brands__alphabet">
                <div class="sort-brands__title"><?=GetMessage("ALFABET_TITLE");?></div>
                <ul class="sort-brands__list">
                    <?php foreach($arResult['ITEMS'] as $k => $brandList):?>
                        <li class="sort-brands__item">
                            <span class="sort-brands__link"><?= $k ?></span>
                            <ul class="sort-brands__sublist">
                                <?php foreach ($arResult['ITEMS'][$k] as $item): ?>
                                    <li class="sort-brands__subitem">
                                        <a href="<?=$item['URL']; ?>" rel="nofollow"><?=$item['NAME'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
<? endif;