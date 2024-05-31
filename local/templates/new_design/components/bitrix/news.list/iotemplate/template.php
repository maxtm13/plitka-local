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
?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<table border="1">
   <caption> Список разделов</caption>
   <tr>
    <th style="width:300px">Урл</th>
    <th style="width:200px">Title</th>
    <th style="width:200px">H1</th>
    <th style="width:200px">Description</th>
   </tr>




<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
      <tr><td><?echo "www.plitkanadom.ru".$arItem["DETAIL_PAGE_URL"];?></td><td><?echo $arItem["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"];?></td><td><?if(isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"])){echo $arItem["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"];}else{echo $arItem["NAME"];};?></td><td><?echo $arItem["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"];?></td></tr>
    
    
    <?//echo 123; ?>
<?endforeach;?>

</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
<?//print_r($arResult);?>
