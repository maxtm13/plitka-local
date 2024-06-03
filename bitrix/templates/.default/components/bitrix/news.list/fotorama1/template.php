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
<div class="fotorama" data-autoplay="true" data-width="100%" data-ratio="900/320" style="width: 100%; height: auto;">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<?
			//проверяем, есть ли у улемента изображение анонса
			if(is_array($arItem["PREVIEW_PICTURE"])) { 
			?>
				<a href="<? echo $arItem['PROPERTIES']['URL_SLIDER']['VALUE'];?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"  data-fit="contain" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
				<div class="slider_url"><a href="<? echo $arItem['PROPERTIES']['URL_SLIDER']['VALUE'];?>"><div class="slider_url_text">Подробнее</div></a></div>
			<?
			}
			?>
		</div>
	<?endforeach;?>
</div>