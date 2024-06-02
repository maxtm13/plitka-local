<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
?>
<?php if (!empty($arResult['ITEMS'])) { ?>
    <!--Верстка алфавита -->
    <? $exDir = [];
    $exDir = explode('/',$APPLICATION->GetCurDir());
    ?>
    <div class="sort-brands">
        <div class="sort-brands__wrap">
            <div class="sort-brands__alphabet">
                <div class="sort-brands__title">Производители:</div>
                <ul class="sort-brands__list">
                    <?php foreach ($arResult['ITEMS'] as $letter => $brandList) {
                        if (empty($brandList)) {
                            continue;
                        } ?>
                        <li class="sort-brands__item">
                            <span class="sort-brands__link"><?= $letter ?></span>
                            <ul class="sort-brands__sublist">
                                <?php foreach ($brandList as $item) { ?>
                                    <li class="sort-brands__subitem">
                                        <a href="<?=($exDir[1]=="santekhnika" ? str_replace("//", "/", $APPLICATION->GetCurPage()."/".$item['CODE']) : $item['URL']); ?>" rel="nofollow"><?= $item['NAME'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    <!--Верстка алфавита (конец)-->
<?php } ?>