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

CJSCore::Init(array("fx"));

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css');
?>

<?/*<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery(".bx_filter_container_title").click();
	});
</script>*/?>

<?php /*---bgn 2015-07-08---*/
//подготавливаем данные для области Назначение
$obMenu = $APPLICATION->GetMenu('left', false, false, '/collections/'); //получаем левое меню для раздела collections
$arNames = array(); //названия плиток
$arLinks = array(); //адреса страниц плиток
foreach($obMenu->arMenu as $arMenuItem) {
	$name = trim($arMenuItem[0]);
	if (!empty($name)) {
		$arNames[] = $name;
		$arLinks[] = $arMenuItem[1];
	}
}
//получаем список св-в инфоблока описаний для фильтра
$rProp = CIBlockProperty::GetList(array('name'=>'asc'), array('IBLOCK_ID'=>FLTR_PROP_DESC_ID, 'ACTIVE'=>'Y'));
$arDescIBProps = array();
while($arProp = $rProp->Fetch()) {
	$arDescIBProps[] = $arProp['CODE'];
}
//получаем соответствие id св-ва страны url странице раздела
$arCountrySection = array();
$file_name = 'country_prop_id__sec_url.txt';
$file_path = $_SERVER['DOCUMENT_ROOT'].'/'.$file_name;
if (file_exists($file_path)) {
	$f = fopen($file_path, 'r');
	while($line = fgets($f)) {
		$line = explode(' ', $line);
		$arCountrySection[$line[0]] = $line[1];
	}
	fclose($f);
}
//проверим находимся ли на странице плитки по назначению
$isNazn = FALSE;
if (in_array($arResult["FORM_ACTION"], $arLinks)) {
	$isNazn = TRUE;
}
/*---end 2015-07-08---*/ ?>
<div class="bx_filter_vertical bx_<?=$arParams["TEMPLATE_THEME"]?>">
	<div class="bx_filter_section m4">
		<img style="margin-left: -40px;position: absolute;" src="<?= SITE_TEMPLATE_PATH?>/images/filter-header-pribluda.png" alt="effect" />
		<a name="fltr_params"></a>
		<div class="bx_filter_title">
			<?php if (!empty($arParams['SEARCH_EVERYWHERE'])) { ?>
				<a href="<?php echo $arParams['SEARCH_EVERYWHERE']; ?>#fltr_params">
			<?php } ?>
			<span><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></span>
			<?php if (!empty($arParams['SEARCH_EVERYWHERE'])) { ?>
				</a>
			<?php } ?>
		</div>
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?$isSecID = false;
			foreach($arResult["HIDDEN"] as $arItem):?>
				<input
					type="hidden"
					name="<?echo $arItem["CONTROL_NAME"]?>"
					id="<?echo $arItem["CONTROL_ID"]?>"
					value="<?echo $arItem["HTML_VALUE"]?>"
				/>
				<?if ($arItem["CONTROL_NAME"] == 'sec_id') {
					$isSecID = true;
				}
			endforeach;?>
			<?if (!$isSecID) {?>
				<input type="hidden" name="sec_id" value="<?php echo $arParams['SECTION_ID']; ?>" />
			<?php } ?>
			<?foreach($arResult["ITEMS"] as $key=>$arItem):
				$key = md5($key);
				?>
				<?if(isset($arItem["PRICE"])):?>
					<?
					if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
						continue;
					?>
					<div class="bx_filter_container price" id="con-choosen">
						<span class="bx_filter_container_title"><span class="bx_filter_container_modef"></span><?=$arItem["NAME"]?></span>
						<div class="bx_filter_param_area">
							<div class="bx_filter_param_area_block"><div class="bx_input_container">
									<input
										class="min-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
									/>
							</div></div>
							<div class="bx_filter_param_area_block"><div class="bx_input_container">
									<input
										class="max-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
									/>
							</div></div>
							<div style="clear: both;"></div>
						</div>
						<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
							<div class="bx_ui_slider_range" style="left: 0; right: 0%;"  id="drag_tracker_<?=$key?>"></div>
							<a class="bx_ui_slider_handle left"  href="javascript:void(0)" style="left:0;" id="left_slider_<?=$key?>"></a>
							<a class="bx_ui_slider_handle right" href="javascript:void(0)" style="right:0%;" id="right_slider_<?=$key?>"></a>
						</div>
						<div class="bx_filter_param_area">
							<div class="bx_filter_param_area_block" id="curMinPrice_<?=$key?>"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></div>
							<div class="bx_filter_param_area_block" id="curMaxPrice_<?=$key?>"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></div>
							<div style="clear: both;"></div>
						</div>
					</div>

					<script type="text/javascript">
						var DoubleTrackBar<?=$key?> = new cDoubleTrackBar('drag_track_<?=$key?>', 'drag_tracker_<?=$key?>', 'left_slider_<?=$key?>', 'right_slider_<?=$key?>', {
							OnUpdate: function(){
								BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").value = this.MinPos;
								BX("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").value = this.MaxPos;
							},
							Min: parseFloat(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>),
							Max: parseFloat(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>),
							MinInputId : BX('<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'),
							MaxInputId : BX('<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'),
							FingerOffset: 10,
							MinSpace: 1,
							RoundTo: 1, //0.01,
							Precision: 0, //2
						});
					</script>
				<?endif?>
			<?endforeach?>

			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?if($arItem["PROPERTY_TYPE"] == "N" ):?>
					<?
					if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
						continue;
					?>
					<div class="bx_filter_container price">
						<span class="bx_filter_container_title"><span class="bx_filter_container_modef"></span><?=$arItem["NAME"]?></span>
						<div class="bx_filter_param_area">
							<div class="bx_filter_param_area_block"><div class="bx_input_container">
								<input
									class="min-price"
									type="text"
									name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
									id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
									size="5"
									onkeyup="smartFilter.keyup(this)"
								/>
								</div></div>
							<div class="bx_filter_param_area_block"><div class="bx_input_container">
								<input
									class="max-price"
									type="text"
									name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
									id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
									size="5"
									onkeyup="smartFilter.keyup(this)"
								/>
							</div></div>
							<div style="clear: both;"></div>
						</div>
						<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
							<div class="bx_ui_slider_range" style="left: 0; right: 0%;"  id="drag_tracker_<?=$key?>"></div>
							<a class="bx_ui_slider_handle left"  href="javascript:void(0)" style="left:0;" id="left_slider_<?=$key?>"></a>
							<a class="bx_ui_slider_handle right" href="javascript:void(0)" style="right:0%;" id="right_slider_<?=$key?>"></a>
						</div>
						<div class="bx_filter_param_area">
							<div class="bx_filter_param_area_block" id="curMinPrice_<?=$key?>"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></div>
							<div class="bx_filter_param_area_block" id="curMaxPrice_<?=$key?>"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></div>
							<div style="clear: both;"></div>
						</div>
					</div>
					<script type="text/javascript">
						var DoubleTrackBar<?=$key?> = new cDoubleTrackBar('drag_track_<?=$key?>', 'drag_tracker_<?=$key?>', 'left_slider_<?=$key?>', 'right_slider_<?=$key?>', {
							OnUpdate: function(){
								BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").value = this.MinPos;
								BX("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").value = this.MaxPos;
							},
							Min: parseFloat(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>),
							Max: parseFloat(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>),
							MinInputId : BX('<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'),
							MaxInputId : BX('<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'),
							FingerOffset: 10,
							MinSpace: 1,
							RoundTo: 100
						});
					</script>
				<?elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"])):?>
				<div class="bx_filter_container">
					<span class="bx_filter_container_title" onclick="hideFilterProps(this)"><span class="bx_filter_container_modef"></span><?=$arItem["NAME"]?></span>
					<div class="bx_filter_block">
						<?foreach($arItem["VALUES"] as $val => $ar):?>
						<?php /*---bgn 2015-07-08---*/
						$itm_key = array_search($ar["VALUE"], $arNames);
						$filter_link = '';
						if ($itm_key !== FALSE) {
							//это пар-р с названиями плиток, делаем ссылку на страницу соотв. плитки
							$filter_link = $arLinks[$itm_key];
							//если на странице плитки по назначению и выводим только это значение
							if ($isNazn && /*!$ar['CHECKED']*/ $filter_link != $arResult['FORM_ACTION']) continue;
						} else {
							if (in_array('FLTR_'.$arItem['ID'], $arDescIBProps)) {
								//пар-р со страницей описания из инфоблока страниц для фильтра
								$arDescFilter = array(
									'IBLOCK_ID'=>FLTR_PROP_DESC_ID,
									'ACTIVE'=>'Y',
									'PROPERTY_FLTR_'.$arItem['ID'].'_VALUE'=>'['.$val.'] '.$ar['VALUE']
								);
								$rEl = CIBlockElement::GetList(array(), $arDescFilter, false, false, array('ID', 'DETAIL_PAGE_URL'));
								if ($arEl = $rEl->GetNext()) {
									$filter_link = $arEl['DETAIL_PAGE_URL'];
								}
							} else if ($arItem['ID'] == 48) {
								//выводим список стран
								if (!empty($arCountrySection[$val])) {
									$filter_link = $arCountrySection[$val];
								}
							}
						}
						if ($arParams['SECTION_ID'] > 0) {
							$filter_link = '';
						}
						/*---end 2015-07-08---*/ ?>
						<span class="<?echo $ar["DISABLED"] ? 'disabled': ''?>">
							<input
								type="checkbox"
								value="<?echo $ar["HTML_VALUE"]?>"
								name="<?echo $ar["CONTROL_NAME"]?>"
								id="<?echo $ar["CONTROL_ID"]?>"
								<?echo $ar["CHECKED"]? 'checked="checked"': ''?>
								onclick="<?php echo ($arItem['ID'] == 45 && $isNazn) ? 'this.checked=true' : 'smartFilter.click(this)'; ?>"
							/>
							<?/*---bgn 2015-07-08---
							<label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label>*/?>
							<label for="<?echo $ar["CONTROL_ID"]?>">
								<?php /*$itm_key = array_search($ar["VALUE"], $arNames);
								$filter_link = '';
								if ($itm_key !== FALSE) {
									//это пар-р с названиями плиток, делаем ссылку на страницу соотв. плитки
									$filter_link = $arLinks[$itm_key];
								} else {
									if (in_array('FLTR_'.$arItem['ID'], $arDescIBProps)) {
										//пар-р со страницей описания из инфоблока страниц для фильтра
										$arDescFilter = array(
											'IBLOCK_ID'=>FLTR_PROP_DESC_ID,
											'ACTIVE'=>'Y',
											'PROPERTY_FLTR_'.$arItem['ID'].'_VALUE'=>'['.$val.'] '.$ar['VALUE']
										);
										$rEl = CIBlockElement::GetList(array(), $arDescFilter, false, false, array('ID', 'DETAIL_PAGE_URL'));
										if ($arEl = $rEl->GetNext()) {
											$filter_link = $arEl['DETAIL_PAGE_URL'];
										}
									} else if ($arItem['ID'] == 48) {
										//выводим список стран
										if (!empty($arCountrySection[$val])) {
											$filter_link = $arCountrySection[$val];
										}
									}
								}
								if ($arParams['SECTION_ID'] > 0) {
									$filter_link = '';
								}*/
								if (!empty($filter_link)) { ?>
									<a href="<?php echo $filter_link; ?>">
								<?php }
								echo $ar["VALUE"];
								if (!empty($filter_link)) { ?>
									</a>
								<?php } ?>
							</label>
							<?/*---end 2015-07-08---*/?>
						</span>
						<?endforeach;?>
					</div>
				</div>
				<?endif;?>
			<?endforeach;?>
			<div style="clear: both;"></div>
			<div class="bx_filter_control_section">
				<span class="icon"></span><input class="bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
				<input class="bx_filter_search_button" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />
				<?php if (!empty($arParams['SEARCH_EVERYWHERE'])) { ?>
					<br /><a class="bx_filter_search_button_1" href="<?php echo $arParams['SEARCH_EVERYWHERE']; ?>#fltr_params"><?=GetMessage("PND_SEARCH_EVERYWHERE")?></a>
				<?php } ?>
				
				<?/* не показывается */?><div class="bx_filter_popup_result right" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
					<?echo '<span>'.GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>')).'</span>';?>
					<span class="arrow"></span>
					<a href="<?echo $arResult["FILTER_URL"]?>"  rel="nofollow"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				</div>
			</div>
		</form>
		<div style="clear: both;"></div>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
	jQuery(document).ready(function(){
		jQuery(".bx_filter_container_title").click();
	});
</script>