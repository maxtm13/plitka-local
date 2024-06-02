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
if(!empty($arResult["DEPTH_2"])):?>
<div class="sant-menu">
	<div class="sant-menu__list">
		<div class="sant-menu__main" data-depth="1">
		<? foreach($arResult["DEPTH_2"] as $k=>$depth2): ?>
			<? if(!empty($depth2["UF_LINK"])):?>
			<a class="sant-menu__block" href="<?=$depth2["UF_LINK"];?>">
			<? else: ?>
			<div class="sant-menu__block"<? if(!empty($depth2["ITEMS"])):?> onclick="showSub('<?=$depth2["ID"];?>')"<? endif; ?>>
			<? endif; ?>
			<div class="sant-menu__block-img">
				<div class="vheight"></div>
				<? if(!empty($depth2["IMG"])):?>
				<img src="<?=$depth2["IMG"];?>" alt="<?=$depth2["NAME"];?>" />
				<? endif;?>
			</div>
			<div class="sant-menu__block-name">
				<div class="vheight"></div>
				<strong><?=$depth2["NAME"];?></strong>
			</div>
			<? if(empty($depth2["UF_LINK"])):?>
			</div>
			<? else: ?>
			</a>
			<? endif; ?>
		<? endforeach; ?>
		</div>
		<? foreach($arResult["DEPTH_2"] as $depth2):
			if(!empty($depth2["ITEMS"]) && empty($depth2["UF_LINK"])):
		?>
			<div class="sant-menu__subs" data-sub="<?=$depth2["ID"];?>">
				<div class="sant-menu__back" onClick="backSub()">назад</div>
				<div class="sant-menu__title"><?=$depth2["NAME"];?></div>
				<?  foreach($depth2["ITEMS"] as $kk=>$subitem):	
					$i = 0;
					foreach($subitem as $item):
					$i++;
				?>
					<? if($i == 1 && $depth2["SUBS"][$kk]):?>
					<div class="sant-menu__title-sub"><?=$depth2["SUBS"][$kk]["NAME"];?></div>
					<? endif; ?>
					<a href="<?=$item["LINK"];?>" class="sant-menu__block">
						<div class="sant-menu__block-img">
							<div class="vheight"></div>
							<? if(!empty($item["IMG"])):?>
							<img src="<?=$item["IMG"];?>" alt="<?=$item["NAME"];?>" />
							<? endif;?>
						</div>
						<div class="sant-menu__block-name">
							<div class="vheight"></div>
							<strong><?=$item["NAME"];?></strong>
						</div>
					</a>
				
				<? endforeach; endforeach; ?>
			</div>
			<? endif; ?>
		<? endforeach; ?>
	</div>
</div>
<? if(!empty($arResult["SECTION"]["DESCRIPTION"])):?>
<div class="productdiv_desc">
	<?=$arResult["SECTION"]["~DESCRIPTION"];?>
</div>
<? endif; ?>
<? endif; ?>