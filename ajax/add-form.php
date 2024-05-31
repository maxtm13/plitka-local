<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && empty($_POST["unbot"])){
	
	$result = '<div class="form__info-block">
	<div class="form__text active">
		<div class="form-input field-name">
			<strong>Ваше имя: <sub>*</sub></strong>
			<div class="form-error">Заполните поле <img src="/image/new_design/attention.svg"></div>
			<input type="text" name="name" value="" placeholder="" />
		</div>
		<div class="form-input field-email">
			<strong>Email: <sub>*</sub></strong>
			<div class="form-error">Заполните поле <img src="/image/new_design/attention.svg"></div>
			<input type="email" name="email" value="" placeholder="" />
		</div>
		<div class="form-input field-message">
			<strong>Сообщение: <sub>*</sub></strong>
			<div class="form-error">Заполните поле <img src="/image/new_design/attention.svg"></div>
			<textarea name="message"></textarea>
		</div>
	</div>
</div>';

echo json_encode($result);
	
}else
	die();