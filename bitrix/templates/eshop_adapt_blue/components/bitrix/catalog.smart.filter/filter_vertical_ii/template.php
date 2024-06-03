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

/*---bgn 2015-09-23---*/
/*$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);*/
CJSCore::Init(array("fx"));

if (file_exists($_SERVER["DOCUMENT_ROOT"].$this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css'))
	$APPLICATION->SetAdditionalCSS($this->GetFolder().'/themes/'.$arParams["TEMPLATE_THEME"].'/colors.css');
/*---end 2015-09-23---*/
?>

<?php /*---bgn 2015-07-08---*/
//ïîäãîòàâëèâàåì äàííûå äëÿ îáëàñòè Íàçíà÷åíèå
$obMenu = $APPLICATION->GetMenu('left', false, false, '/collections/'); //ïîëó÷àåì ëåâîå ìåíþ äëÿ ðàçäåëà collections
$arNames = array(); //íàçâàíèÿ ïëèòîê
$arLinks = array(); //àäðåñà ñòðàíèö ïëèòîê
foreach($obMenu->arMenu as $arMenuItem) {
	$name = trim($arMenuItem[0]);
	if (!empty($name)) {
		$arNames[] = $name;
		$arLinks[] = $arMenuItem[1];
	}
}
//ïîëó÷àåì ñïèñîê ñâ-â èíôîáëîêà îïèñàíèé äëÿ ôèëüòðà
switch($arParams['IBLOCK_ID']) {
	case 11: //ñàíòåõíèêà
		$ibID = 19;
		break;
	default: //ïëèòêà
		$ibID = FLTR_PROP_DESC_ID;
}
$rProp = CIBlockProperty::GetList(array('name'=>'asc'), array('IBLOCK_ID'=>$ibID, 'ACTIVE'=>'Y'));
$arDescIBProps = array();
while($arProp = $rProp->Fetch()) {
	$arDescIBProps[] = $arProp['CODE'];
}
//ïîëó÷àåì ñîîòâåòñòâèå id ñâ-âà ñòðàíû url ñòðàíèöå ðàçäåëà
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
/*---end 2015-07-08---*/ ?>

<div class="bx_filter_vertical bx_<?=$arParams["TEMPLATE_THEME"]?>">
	<div class="bx_filter_section m4">
		<img style="margin-left: -40px;position: absolute;" src="<?= SITE_TEMPLATE_PATH?>/images/filter-header-pribluda.png" alt="effect" />
		<div class="bx_filter_title"><span><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></span></div>
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?$isSecID = false;
			foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
				<?if ($arItem["CONTROL_NAME"] == 'sec_id') {
					$isSecID = true;
				}
			endforeach;
			if (!$isSecID) {?>
				<input type="hidden" name="sec_id" value="<?php echo $arParams['SECTION_ID']; ?>" />
			<?php }
			//prices
			foreach($arResult["ITEMS"] as $key=>$arItem)
			{
				$key = md5($key); //$arItem["ENCODED_ID"];
				if(isset($arItem["PRICE"])):
					if (/*$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0*/ !$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
						continue;

					$precision = 2;
					if (Bitrix\Main\Loader::includeModule("currency"))
					{
						$res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
						$precision = $res['DECIMALS'];
					}
					?>
					<?/*<div class="bx_filter_parameters_box active">*/?>
					<div class="bx_filter_container price" id="con-choosen">
						<?/*<span class="bx_filter_container_modef"></span>
						<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>*/?>
						<span class="bx_filter_container_title"><span class="bx_filter_container_modef"></span>Фильтр по цене</span>
						<?/*<div class="bx_filter_block">*/?>
						<div class="bx_filter_param_area">
							<?/*<div class="bx_filter_parameters_box_container">
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">*/?>
							<div class="bx_filter_param_area_block">
								<div class="bx_input_container">
									<input
										class="min-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										/>
								</div>
							</div>
								<?/*<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">*/?>
							<div class="bx_filter_param_area_block">
								<div class="bx_input_container">
									<input
										class="max-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										/>
								</div>
							</div>
							<div style="clear: both;"></div>

								<?/*<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
									<?
									$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
									$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
									$price1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
									$price2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
									$price3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
									$price4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
									$price5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
									?>
									<div class="bx_ui_slider_part p1"><span><?=$price1?></span></div>
									<div class="bx_ui_slider_part p2"><span><?=$price2?></span></div>
									<div class="bx_ui_slider_part p3"><span><?=$price3?></span></div>
									<div class="bx_ui_slider_part p4"><span><?=$price4?></span></div>
									<div class="bx_ui_slider_part p5"><span><?=$price5?></span></div>

									<div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
										<a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
										<a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
									</div>
								</div>
								<div style="opacity: 0;height: 1px;"></div>
							</div>*/?>
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
					<?
					/*$arJsParams = array(
						"leftSlider" => 'left_slider_'.$key,
						"rightSlider" => 'right_slider_'.$key,
						"tracker" => "drag_tracker_".$key,
						"trackerWrap" => "drag_track_".$key,
						"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
						"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
						"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
						"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
						"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
						"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
						"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
						"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
						"precision" => $precision,
						"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
						"colorAvailableActive" => 'colorAvailableActive_'.$key,
						"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
					);
					?>
					<script type="text/javascript">
						BX.ready(function(){
							window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
						});
					</script>*/?>
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
				<?endif;
			}

			//not prices
			foreach($arResult["ITEMS"] as $key=>$arItem) {
				if(
					empty($arItem["VALUES"])
					|| isset($arItem["PRICE"])
				)
					continue;

				if (
					$arItem["DISPLAY_TYPE"] == "A"
					&& (
						$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
					)
				)
					continue;
				?>
				<?/*<div class="bx_filter_parameters_box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>active<?endif?>">
					<span class="bx_filter_container_modef"></span>
					<div class="bx_filter_parameters_box_title" onclick="smartFilter.hideFilterProps(this)"><?=$arItem["NAME"]?></div>*/?>
				<div class="bx_filter_container">
					<?php if (in_array($arItem["DISPLAY_TYPE"], array('P','R'))) {
						$cls = 'dropdown';
					} else {
						$cls = '';
					} ?>
					<span class="bx_filter_container_title prop_<?php echo $arItem['ID']; ?> <?php echo $cls; ?>" onclick="hideFilterProps(this)"><span class="bx_filter_container_modef"></span><?=$arItem["NAME"]?></span>
					<?/*if ($arItem["FILTER_HINT"] <> ""):?>
						<div class="bx_filter_parameters_box_hint" id="item_title_hint_<?echo $arItem["ID"]?>"></div>
						<script type="text/javascript">
							new top.BX.CHint({
								parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
								show_timeout: 10,
								hide_timeout: 200,
								dx: 2,
								preventHide: true,
								min_width: 250,
								hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
							});
						</script>
					<?endif*/?>
					
					<div class="bx_filter_block <?php echo $cls; ?>">
						<?/*<div class="bx_filter_parameters_box_container">*/?>
						<?
						$arCur = current($arItem["VALUES"]);
						switch ($arItem["DISPLAY_TYPE"])
						{
							case "A"://NUMBERS_WITH_SLIDER
								?>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input
											class="min-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
											/>
									</div>
								</div>
								<div class="bx_filter_parameters_box_container_block">
									<div class="bx_filter_input_container">
										<input
											class="max-price"
											type="text"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											size="5"
											onkeyup="smartFilter.keyup(this)"
											/>
									</div>
								</div>
								<div style="clear: both;"></div>

								<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
									<?
									$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
									/*$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
									$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
									$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
									$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
									$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
									$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");*/
									?>
									<?/*<div class="bx_ui_slider_part p1"><span><?=$value1?></span></div>
									<div class="bx_ui_slider_part p2"><span><?=$value2?></span></div>
									<div class="bx_ui_slider_part p3"><span><?=$value3?></span></div>
									<div class="bx_ui_slider_part p4"><span><?=$value4?></span></div>
									<div class="bx_ui_slider_part p5"><span><?=$value5?></span></div>*/?>

									<div class="bx_ui_slider_pricebar_VD" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_VN" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
									<div class="bx_ui_slider_pricebar_V"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
									<div class="bx_ui_slider_range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
										<a class="bx_ui_slider_handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
										<a class="bx_ui_slider_handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
									</div>
								</div>
								<?
								$arJsParams = array(
									"leftSlider" => 'left_slider_'.$key,
									"rightSlider" => 'right_slider_'.$key,
									"tracker" => "drag_tracker_".$key,
									"trackerWrap" => "drag_track_".$key,
									"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
									"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
									"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
									"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
									"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
									"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
									"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
									"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
									"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
									"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
									"colorAvailableActive" => 'colorAvailableActive_'.$key,
									"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
								);
								?>
								<script type="text/javascript">
									BX.ready(function(){
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
								</script>
								<?
								break;
							case "B"://NUMBERS
								?>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
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
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container">
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
								<?
								break;
							case "G"://CHECKBOXES_WITH_PICTURES
								?>
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
								<input
									style="display: none"
									type="checkbox"
									name="<?=$ar["CONTROL_NAME"]?>"
									id="<?=$ar["CONTROL_ID"]?>"
									value="<?=$ar["HTML_VALUE"]?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									/>
								<?
								$class = "";
								if ($ar["CHECKED"])
									$class.= " active";
								if ($ar["DISABLED"])
									$class.= " disabled";
								?>
								<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label dib<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
															<span class="bx_filter_param_btn bx_color_sl">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
															</span>
								</label>
							<?endforeach?>
								<?
								break;
							case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
								?>
								<?foreach ($arItem["VALUES"] as $val => $ar):?>
								<input
									style="display: none"
									type="checkbox"
									name="<?=$ar["CONTROL_NAME"]?>"
									id="<?=$ar["CONTROL_ID"]?>"
									value="<?=$ar["HTML_VALUE"]?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									/>
								<?
								$class = "";
								if ($ar["CHECKED"])
									$class.= " active";
								if ($ar["DISABLED"])
									$class.= " disabled";
								?>
								<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'active');">
															<span class="bx_filter_param_btn bx_color_sl">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
															</span>
															<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
																if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																	?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
																endif;?></span>
								</label>
							<?endforeach?>
								<?
								break;
							case "P"://DROPDOWN
								$checkedItemExist = false;
								?>
								<div class="bx_filter">
									<div class="bx_filter_select_container">
										<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="bx_filter_select_text" data-role="currentOption">
												<?
												foreach ($arItem["VALUES"] as $val => $ar)
												{
													if ($ar["CHECKED"])
													{
														echo $ar["VALUE"];
														$checkedItemExist = true;
													}
												}
												if (!$checkedItemExist)
												{
													echo GetMessage("CT_BCSF_FILTER_ALL");
												}
												?>
											</div>
											<div class="bx_filter_select_arrow"></div>
											<input
												style="display: none"
												type="radio"
												name="<?=$arCur["CONTROL_NAME_ALT"]?>"
												id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
												value=""
												/>
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="radio"
													name="<?=$ar["CONTROL_NAME_ALT"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<? echo $ar["HTML_VALUE_ALT"] ?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
											<?endforeach?>
											<div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none;">
												<ul>
													<li>
														<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
															<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
														</label>
													</li>
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
														?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
														</li>
													<?endforeach?>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<?
								break;
							case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
								?>
								<div class="bx_filter">
									<div class="bx_filter_select_container">
										<div class="bx_filter_select_block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="bx_filter_select_text" data-role="currentOption">
												<?
												$checkedItemExist = false;
												foreach ($arItem["VALUES"] as $val => $ar):
													if ($ar["CHECKED"])
													{
														?>
														<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
														<span class="bx_filter_param_text">
																				<?=$ar["VALUE"]?>
																			</span>
														<?
														$checkedItemExist = true;
													}
												endforeach;
												if (!$checkedItemExist)
												{
													?><span class="bx_filter_btn_color_icon all"></span> <?
													echo GetMessage("CT_BCSF_FILTER_ALL");
												}
												?>
											</div>
											<div class="bx_filter_select_arrow"></div>
											<input
												style="display: none"
												type="radio"
												name="<?=$arCur["CONTROL_NAME_ALT"]?>"
												id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
												value=""
												/>
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="radio"
													name="<?=$ar["CONTROL_NAME_ALT"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<?=$ar["HTML_VALUE_ALT"]?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
											<?endforeach?>
											<div class="bx_filter_select_popup" data-role="dropdownContent" style="display: none">
												<ul>
													<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
														<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx_filter_param_label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
															<span class="bx_filter_btn_color_icon all"></span>
															<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
														</label>
													</li>
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
														?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx_filter_btn_color_icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="bx_filter_param_text">
																					<?=$ar["VALUE"]?>
																				</span>
															</label>
														</li>
													<?endforeach?>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<?
								break;
							case "K"://RADIO_BUTTONS
								?>
								<label class="bx_filter_param_label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
														<span class="bx_filter_input_checkbox">
															<input
																type="radio"
																value=""
																name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
																id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
																onclick="smartFilter.click(this)"
																/>
															<span class="bx_filter_param_text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
														</span>
								</label>
								<?foreach($arItem["VALUES"] as $val => $ar):?>
								<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label" for="<? echo $ar["CONTROL_ID"] ?>">
															<span class="bx_filter_input_checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
																<input
																	type="radio"
																	value="<? echo $ar["HTML_VALUE_ALT"] ?>"
																	name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
																	id="<? echo $ar["CONTROL_ID"] ?>"
																	<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
																	onclick="smartFilter.click(this)"
																	/>
																<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
																	if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																		?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
																	endif;?></span>
															</span>
								</label>
							<?endforeach;?>
								<?
								break;
							case "U"://CALENDAR
								?>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
										<?$APPLICATION->IncludeComponent(
											'bitrix:main.calendar',
											'',
											array(
												'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
												'SHOW_INPUT' => 'Y',
												'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
												'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
												'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
												'SHOW_TIME' => 'N',
												'HIDE_TIMEBAR' => 'Y',
											),
											null,
											array('HIDE_ICONS' => 'Y')
										);?>
									</div></div>
								<div class="bx_filter_parameters_box_container_block"><div class="bx_filter_input_container bx_filter_calendar_container">
										<?$APPLICATION->IncludeComponent(
											'bitrix:main.calendar',
											'',
											array(
												'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
												'SHOW_INPUT' => 'Y',
												'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
												'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
												'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
												'SHOW_TIME' => 'N',
												'HIDE_TIMEBAR' => 'Y',
											),
											null,
											array('HIDE_ICONS' => 'Y')
										);?>
									</div></div>
								<?
								break;
							default://CHECKBOXES
								foreach($arItem["VALUES"] as $val => $ar):?>
									<?/*<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx_filter_param_label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
											<span class="bx_filter_input_checkbox">
												<input
													type="checkbox"
													value="<? echo $ar["HTML_VALUE"] ?>"
													name="<? echo $ar["CONTROL_NAME"] ?>"
													id="<? echo $ar["CONTROL_ID"] ?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													onclick="smartFilter.click(this)"
													/>
												<span class="bx_filter_param_text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?></span>
											</span>
									</label>*/?>
									<span class="<?echo $ar["DISABLED"] ? 'disabled': ''?>">
										<input
											type="checkbox"
											value="<? echo $ar["HTML_VALUE"] ?>"
											name="<? echo $ar["CONTROL_NAME"] ?>"
											id="<? echo $ar["CONTROL_ID"] ?>"
											<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											onclick="smartFilter.click(this)"
											/>
										<label for="<?echo $ar["CONTROL_ID"]?>">
											<?php $itm_key = array_search($ar["VALUE"], $arNames);
											$filter_link = '';
											if ($itm_key !== FALSE) {
												//ýòî ïàð-ð ñ íàçâàíèÿìè ïëèòîê, äåëàåì ññûëêó íà ñòðàíèöó ñîîòâ. ïëèòêè
												$filter_link = $arLinks[$itm_key];
											} else {
												if (in_array('FLTR_'.$arItem['ID'], $arDescIBProps)) {
													//ïàð-ð ñî ñòðàíèöåé îïèñàíèÿ èç èíôîáëîêà ñòðàíèö äëÿ ôèëüòðà
													$arDescFilter = array(
														'IBLOCK_ID'=>$ibID,
														'ACTIVE'=>'Y',
														'PROPERTY_FLTR_'.$arItem['ID'].'_VALUE'=>'['.$val.'] '.$ar['VALUE']
													);
													$rEl = CIBlockElement::GetList(array(), $arDescFilter, false, false, array('ID', 'DETAIL_PAGE_URL'));
													if ($arEl = $rEl->GetNext()) {
														$filter_link = $arEl['DETAIL_PAGE_URL'];
													}
												} else if ($arItem['ID'] == 48) {
													//âûâîäèì ñïèñîê ñòðàí
													if (!empty($arCountrySection[$val])) {
														$filter_link = $arCountrySection[$val];
													}
												}
											}
											if (!empty($filter_link)) { ?>
												<a href="<?php echo $filter_link; ?>">
											<?php }
											echo $ar["VALUE"];
											if (!empty($filter_link)) { ?>
												</a>
											<?php } ?>
										</label>
									</span>
								<?endforeach;
						} //switch ?>
						<?/*</div>
						<div class="clb"></div>*/?>
					</div>
				</div>
			<? } ?>
			
			<div style="clear: both;"></div>
			
			<?/*<div class="bx_filter_button_box active">
				<div class="bx_filter_block">
					<div class="bx_filter_parameters_box_container">
						<input
							class="bx_filter_search_button"
							type="submit"
							id="set_filter"
							name="set_filter"
							value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
							/>
						<input
							class="bx_filter_search_reset"
							type="submit"
							id="del_filter"
							name="del_filter"
							value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
							/>
						<div class="bx_filter_popup_result <?=$arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
							<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
							<span class="arrow"></span>
							<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
						</div>
					</div>
				</div>
			</div>*/?>
			<div class="bx_filter_control_section">
				<span class="icon"></span><input class="bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
				<input class="bx_filter_search_button" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />

				<div class="bx_filter_popup_result right" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) { echo 'style="display:none;"'; } else {echo 'style="display: inline-block;"';} ?> >
					<?echo '<span>'.GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>')).'</span>';?>
					<span class="arrow"></span>
					<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				</div>
			</div>
		</form>
		<div style="clear: both;"></div>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
	/*---bgn 2015-09-23---*/
	jQuery(document).ready(function(){
		//jQuery(".bx_filter_container_title").click();
		jQuery('.bx_filter_vertical input[type="checkbox"]:checked').closest('.bx_filter_container').children('.bx_filter_container_title').click();
		jQuery('.bx_filter_vertical .bx_filter_block input.min-price').each(function() {
			$val = parseFloat(jQuery(this).val());
			if ($val > 0) {
				jQuery(this).closest('.bx_filter_container').children('.bx_filter_container_title').click();
			}
		});
		jQuery('.bx_filter_vertical .bx_filter_container:not(.active) .bx_filter_block input.max-price').each(function() {
			$val = parseFloat(jQuery(this).val());
			if ($val > 0) {
				jQuery(this).closest('.bx_filter_container').children('.bx_filter_container_title').click();
			}
		});
	});
	/*---end 2015-09-23---*/
</script>