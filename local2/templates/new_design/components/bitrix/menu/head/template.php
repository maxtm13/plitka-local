<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if(!empty($arResult)):
?>
<ul>
<? foreach($arResult as $itemIdex => $arItem):
	if(empty($arItem["SELECTED"])):
	?>
	<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<? else: ?>
	<li><span><?=$arItem["TEXT"]?></span></li>
	<? endif; ?>
<? endforeach;?>
</ul>
<? endif; ?>