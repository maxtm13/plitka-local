<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(!empty($arResult["ITEMS"])):
?>
<section class="main-banner">
	<div class="slider" id="big-silder">
	<? foreach($arResult["ITEMS"] as $item):?>
		<? if($item["PICTURE"]):?>
		<div class="slider__item">
			<? if($item["LINK"]):?>
			<a href="<?=$item["LINK"];?>">
			<? endif; ?>
			<div class="max-width">
				<? if($item["PREVIEW_TEXT"] || $item["DETAIL_TEXT"] || $item["PROPERTY_TEXT_BUTTON_VALUE"]):?>
				<div class="slider__item-info">
					<? if($item["PREVIEW_TEXT"]):?>
					<div class="slider__item-title"<? if($item["PROPERTY_COLOR_TITLE_VALUE"]):?> style="color:<?=$item["PROPERTY_COLOR_TITLE_VALUE"];?>"<? endif; ?>><?=$item["PREVIEW_TEXT"];?></div>
					<? endif; ?>
					<? if($item["DETAIL_TEXT"]):?>
					<div class="slider__item-text"<? if($item["PROPERTY_COLOR_TEXT_VALUE"]):?> style="color:<?=$item["PROPERTY_COLOR_TEXT_VALUE"];?>"<? endif; ?>><?=$item["DETAIL_TEXT"];?></div>
					<? endif; ?>
					<? if($item["LINK"] && $item["PROPERTY_TEXT_BUTTON_VALUE"]):?>
					<span class="slider__item-button"<? if($item["PROPERTY_COLOR_BUTTON_VALUE"] || $item["PROPERTY_COLOR_BUTTON_TEXT_VALUE"]):?> style="<? if($item["PROPERTY_COLOR_BUTTON_VALUE"]):?>background-color: <?=$item["PROPERTY_COLOR_BUTTON_VALUE"];?>;<? endif; ?><? if($item["PROPERTY_COLOR_BUTTON_TEXT_VALUE"]):?>color: <?=$item["PROPERTY_COLOR_BUTTON_TEXT_VALUE"];?><? endif; ?>"<? endif; ?>><?=$item["PROPERTY_TEXT_BUTTON_VALUE"];?></span>
					<? endif; ?>
				</div>
				<? endif; ?>
			</div>
			<img src="<?=$item["PICTURE"];?>" alt="<?=$item["NAME"];?>" />
			<? if($item["LINK"]):?>
			</a>
			<? endif; ?>
		</div>
		<? endif; ?>
		<? endforeach;?>
	</div>
</section>
<? endif; ?>