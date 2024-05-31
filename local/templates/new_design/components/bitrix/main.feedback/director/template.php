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

<p>Ваше мнение очень важно для нас. Пожалуйста, напишите свои отзывы о работе сотрудников, и работе сайта.</p>
<p>Сообщите пожалуйста об ошибке, найденной на нашем сайте. Мы постараемся ее исправить. Также вы можете описать что на сайте можно было бы сделать более удобным для вас!</p>
<? if(strlen($arResult["OK_MESSAGE"]) > 0): ?>
	<p class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></p>
<? endif; ?>
<div class="max-width">
	<div id="form-props__prod">
		<form action="<?= POST_FORM_ACTION_URI ?>" method="POST" id="formblock">
			<?= bitrix_sessid_post() ?>
			<div id="request__director" data-type="full" class="form-block">
				<div class="form__info-block">
					<div class="form__text active">
						<div class="form-input field-name">
							<strong>Ваше имя: <sub>*</sub></strong>
							<input type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" placeholder="" required>
						</div>
						<div class="form-input field-email">
							<strong>Email: <sub>*</sub></strong>
							<input type="email" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>" placeholder="" required>
						</div>
						<div class="form-input field-message">
							<strong>Сообщение: <sub>*</sub></strong>
							<textarea name="MESSAGE" required></textarea>
						</div>
						<? if($arParams["USE_CAPTCHA"] == "Y"): ?>
							<div class="form-input field-captcha">
								<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
								<strong><?= GetMessage("MFT_CAPTCHA_CODE") ?> <sub>*</sub></strong>
								<input type="text" name="captcha_word" maxlength="50" value="">
							</div>
						<? endif; ?>
					</div>
				</div>
			</div>
			<div class="form-input field-policy">
				<div class="is-checkbox">
					<input type="checkbox" name="policy" required> <span>Даю <a target="_blank" href="/policy/">согласие</a> на обработку моих персональных данных</span>
				</div>
			</div>
			<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
			<input type="submit" name="submit" value="<?= GetMessage("MFT_SUBMIT") ?>" class="request__btn">
			<?
				if(!empty($arResult["ERROR_MESSAGE"]))
				{
					foreach($arResult["ERROR_MESSAGE"] as $v)
						ShowError($v);
				}
			?>
		</form>
	</div>
</div>