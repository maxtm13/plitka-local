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
<?
$templateFolder = $this->GetFolder();
?>
<script src="<?=$templateFolder?>/js/fotorama.js" type="text/javascript"></script>
<div class="fotorama" data-navposition="top" data-nav="thumbs" data-autoplay="true" data-width="100%"  style="width: 100%; height: auto;">

	
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
			<?
			//проверяем, есть ли у улемента изображение анонса
			if(is_array($arItem["PREVIEW_PICTURE"])) { 
			?>
				<a href="<? echo $arItem['PROPERTIES']['URL_SLIDER']['VALUE'];?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"  class="fotorama__img"  alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>

			<?
			}
			?>
		
	<?endforeach;?>
</div>

	<img src="https://s.fotorama.io/okonechnikov/2-lo.jpg" class="fotorama__img11" style="width: 95.9315px; height: 64px; left: -15.9657px; top: 0px;">