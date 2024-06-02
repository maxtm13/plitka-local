<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");

$style = (is_array($arResult["ORDER_PROP"]["RELATED"]) && count($arResult["ORDER_PROP"]["RELATED"])) ? "" : "display:none";
?>
<div class="bx_section" style="<?=$style?>">
	<h4><?=GetMessage("SOA_TEMPL_RELATED_PROPS")?></h4>
	<br />
	<div>
	<?
	foreach ($arResult["ORDER_PROP"]["RELATED"] as $arProperties)
	{
		if($arProperties["FIELD_ID"] == "ORDER_PROP_REORDER" && !empty($arParams["REORDER"])){
			$arProperties["VALUE"] = $arParams["REORDER"];
		}
		if ($arProperties["TYPE"] == "CHECKBOX")
		{
			?>
			<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">

			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r1x3 pt8">
				<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>

			<div style="clear: both;"></div>
			<?
		}
		elseif ($arProperties["TYPE"] == "TEXT")
		{
			?>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<input type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>">

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>
			<div style="clear: both;"></div><br/>
			<?
		}
		elseif ($arProperties["TYPE"] == "SELECT")
		{
			?>
			<br/>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
					<?
					foreach($arProperties["VARIANTS"] as $arVariants):
					?>
						<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
					<?
					endforeach;
					?>
				</select>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>
			<div style="clear: both;"></div>
			<?
		}
		elseif ($arProperties["TYPE"] == "MULTISELECT")
		{
			?>
			<br/>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
					<?
					foreach($arProperties["VARIANTS"] as $arVariants):
					?>
						<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
					<?
					endforeach;
					?>
				</select>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>
			<div style="clear: both;"></div>
			<?
		}
		elseif ($arProperties["TYPE"] == "TEXTAREA")
		{
			$rows = ($arProperties["SIZE2"] > 10) ? 4 : $arProperties["SIZE2"];
			?>
			<br/>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<textarea rows="<?=$rows?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>
			<div style="clear: both;"></div>
			<?
		}
		elseif ($arProperties["TYPE"] == "LOCATION")
		{
			$value = 0;
			if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
			{
				foreach ($arProperties["VARIANTS"] as $arVariant)
				{
					if ($arVariant["SELECTED"] == "Y")
					{
						$value = $arVariant["ID"];
						break;
					}
				}
			}
			?>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<?
				$GLOBALS["APPLICATION"]->IncludeComponent(
					"bitrix:sale.ajax.locations",
					'.default',
					array(
						"AJAX_CALL" => "N",
						"COUNTRY_INPUT_NAME" => "COUNTRY",
						"REGION_INPUT_NAME" => "REGION",
						"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
						"CITY_OUT_LOCATION" => "Y",
						"LOCATION_VALUE" => $value,
						"ORDER_PROPS_ID" => $arProperties["ID"],
						"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
						"SIZE1" => $arProperties["SIZE1"],
					),
					null,
					array('HIDE_ICONS' => 'Y')
				);
				?>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>
			<div style="clear: both;"></div>
			<?
		}
		elseif ($arProperties["TYPE"] == "RADIO")
		{
			?>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<?
				if (is_array($arProperties["VARIANTS"]))
				{
					foreach($arProperties["VARIANTS"] as $arVariants):
					?>
						<input
							type="radio"
							name="<?=$arProperties["FIELD_NAME"]?>"
							id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
							value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

						<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
					<?
					endforeach;
				}
				?>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>
			<div style="clear: both;"></div>
			<?
		}
		elseif ($arProperties["TYPE"] == "FILE")
		{
			?>
			<br/>
			<div class="bx_block r1x3 pt8">
				<?=$arProperties["NAME"]?>
				<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
					<span class="bx_sof_req">*</span>
				<?endif;?>
			</div>

			<div class="bx_block r3x1">
				<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>

				<?
				if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
				?>
				<div class="bx_description">
					<?=$arProperties["DESCRIPTION"]?>
				</div>
				<?
				endif;
				?>
			</div>

			<div style="clear: both;"></div><br/>
			<?
		}
	}
	?>
	</div>
	<? /* =PrintPropsForm($arResult["ORDER_PROP"]["RELATED"], $arParams["TEMPLATE_LOCATION"]) */?>
</div>