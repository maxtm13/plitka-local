<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<? if (!empty($arResult)) {
    $arTmp['level2'] = $arResult['level2'];
    $JSParams = array(
        'TPL_PATH' => $templateFolder
    ); ?>
    <ul class="pnd-vm-top-2018">
        <?foreach ($arResult['level1'] as $key => $arItem) { ?>
            <li<?if ($arItem['IS_PARENT']) { echo ' class="parent"'; } ?> data-key="<?= $key ?>" data-loadsublvl="2">
                <span class="pnd__arr"></span>
                <a href="<?= $arItem["LINK"] ?>" class="<? if ($arItem["SELECTED"]) { ?>root-item-selected<? } else { ?>root-item<? } ?>">
                    <?= $arItem["TEXT"] ?>
                </a>
            </li>
        <?}?>
    </ul>
    <script>
        BX.message({
            MSG_RETURN: '<?=GetMessage('PN_RETURN')?>'
        });
        $pndTopMenu = <?=CUtil::PhpToJSObject($arTmp)?>;
        $pndTopMenuParams = <?=CUtil::PhpToJSObject($JSParams)?>;
    </script>
<? } ?>