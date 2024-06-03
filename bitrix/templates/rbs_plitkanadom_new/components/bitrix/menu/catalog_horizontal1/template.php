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

if (empty($arResult["ALL_ITEMS"]))
	return;

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["MENU_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["MENU_THEME"].'/colors.css');

$menuBlockId = "catalog_menu_".$this->randString();
?>
<div class="bx_horizontal_menu_advaced bx_<?=$arParams["MENU_THEME"]?>" id="<?=$menuBlockId?>">
	<ul id="main-menu-plitka">
		<li id = "cermic-tile-master">
			<div id="menu-cermic-separator"></div>
			<div id="menu-cermic-tile"><a href="/katalog-keramicheskoy-plitki/">Керамическая плитка</a></div>
			<ul id="ul_<?=$menuBlockId?>" class="main_menu">
		
	<?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>     <!-- first level-->
		<?$existPictureDescColomn = ($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"] || $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]) ? true : false;?>
		<li class="ceramic-tile" onmouseover="BX.CatalogMenu.itemOver(this);" onmouseout="BX.CatalogMenu.itemOut(this)">
			<?if($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["class"] == "separator"):?>
				<div class="separator"></div>
			<?else:?>
				<a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>">
					<?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?>
				</a>
				<div class="li_separator"></div>
			<?endif;?>
		<?if (is_array($arColumns) && count($arColumns) > 0):?>
			<?/*<span class="bx_children_advanced_panel animate">
				<!--img src="<?//=$arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"]?>" alt=""-->
			</span>*/?>
			<div class="bx_children_container b<?=($existPictureDescColomn) ? count($arColumns)+1 : count($arColumns)?> animate">
				<ul>
					<?foreach($arColumns as $key=>$arRow):?>

					
					<?foreach($arRow as $itemIdLevel_2=>$arLevel_3):?>  <!-- second level-->
						<li class="parent manufacturer">
							<a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?></a>
							<?/*<span class="bx_children_advanced_panel animate">
								<!--img src="<?//=$arResult["ALL_ITEMS"][$itemIdLevel_2]["PARAMS"]["picture_src"]?>" alt=""-->
							</span>*/?>
						<?if (is_array($arLevel_3) && count($arLevel_3) > 0):?>
							<ul class="collection">
							<?foreach($arLevel_3 as $itemIdLevel_3):?>	<!-- third level-->
								<li>
									<a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></a>
									<span class="bx_children_advanced_panel animate">
										<!--img src="<?//=$arResult["ALL_ITEMS"][$itemIdLevel_3]["PARAMS"]["picture_src"]?>" alt=""-->
									</span>
								</li>
							<?endforeach;?>
							</ul>
						<?endif?>
						</li>
					<?endforeach;?>
					

				<?endforeach;?>
				</ul>
				<?if ($existPictureDescColomn):?>
				<div class="bx_children_block advanced">
					<div class="bx_children_advanced_panel">
						<span class="bx_children_advanced_panel animate">
							<a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"><span class="bx_section_picture"></span></a>
							<!--img src="<?//=$this->GetFolder()?>/images/spacer.png" alt="" style="border: none;"-->
						</span>
					</div>
				</div>
				<?endif?>
				<div style="clear: both;"></div>
			</div>
		<?endif?>
		</li>
	<?endforeach;?>
	</ul>
	</li>

	<div style="clear: both;"></div>
</div>
