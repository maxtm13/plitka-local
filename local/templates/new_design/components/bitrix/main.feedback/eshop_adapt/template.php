<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>










		<form action="<?=POST_FORM_ACTION_URI?>" method="POST" name="feed_form" id="feed_form">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>"></div>
		</form>









<div class="bx_mfeedback<?if($arParams["USE_CAPTCHA"] == "Y"):?> capcha<?endif;?>">
	<?if(!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach($arResult["ERROR_MESSAGE"] as $v)
			ShowError($v);
	}
	if(strlen($arResult["OK_MESSAGE"]) > 0)
	{
		?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
	}
	?>
		<div class="feed_head"><center><strong><?=GetMessage("MFT_FEED")?></strong></center></div>
		<div class="feed_desc"><?=GetMessage("MFT_NAME")?>:<?if(0 && empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></div>
		<div class="feed_input"><input form="feed_form" type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>"/></div>

		<div class="feed_desc"><?=GetMessage("MFT_EMAIL")?>:<?if(0 && empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></div>
		<div class="feed_input"><input form="feed_form" type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>"/></div>

		<div class="feed_desc"><?=GetMessage("MFT_PHONE")?>:<?if(0 && empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></div>
		<div class="feed_input"><input form="feed_form" type="text" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>"/></div>

		<div class="feed_desc"><?=GetMessage("MFT_MESSAGE")?>:<?if(0 && empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></div>
		<div class="feed_input"><textarea form="feed_form" name="MESSAGE" rows="5" cols="40"><?=$arResult["MESSAGE"]?></textarea></div>

		<div class="feed_call"><input form="feed_form" type="checkbox" name="user_call_me" value="<?=$arResult["AUTHOR_CALL_ME"]?>"/> <strong><?=GetMessage("MFT_CALL_ME")?></strong></div>

		
		
		<?if($arParams["USE_CAPTCHA"] == "Y"):?>
			<div class="feed_capcha">
			<strong><?=GetMessage("MFT_CAPTCHA")?></strong>
			<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="100%" alt="CAPTCHA"></div>
			<div class="feed_input">
			<strong><?=GetMessage("MFT_CAPTCHA_CODE")?></strong><br/>
<input form="feed_form" type="text" name="captcha_word" size="30" maxlength="50" value=""/><br/></div>
		<?endif;?>

		<div class="feed_submit"><input form="feed_form" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="feed_button"></div>
</div>