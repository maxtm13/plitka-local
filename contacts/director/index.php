<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Письмо директору");
?><div class="is-form_page" id="form-root">
	<?
		$APPLICATION->IncludeComponent(
			"bitrix:main.feedback", 
			"director", 
			array(
				"COMPONENT_TEMPLATE" => "director",
				"USE_CAPTCHA" => "Y",
				"OK_TEXT" => "Спасибо, ваше сообщение принято.",
				"EMAIL_TO" => "info@plitkanadom.ru",
				"REQUIRED_FIELDS" => array(
					0 => "NAME",
					1 => "EMAIL",
					2 => "MESSAGE",
				),
				"EVENT_MESSAGE_ID" => array(
					0 => "7",
				)
			),
			false
		);
	?>
</div>

<? /* ?>
<div class="is-form_page" id="form-root">
	<p>Ваше мнение очень важно для нас. Пожалуйста, напишите свои отзывы о работе сотрудников, и работе сайта.</p>
	<p>Сообщите пожалуйста об ошибке, найденной на нашем сайте. Мы постараемся ее исправить. Также вы можете описать что на сайте можно было бы сделать более удобным для вас!</p>
	<div class="max-width">
		<div id="form-props__prod">
			<form id="formblock">
				<input type="hidden" name="unbot" value="" />
				<div id="request__director" data-type='full' class="form-block"></div>
				<div class="form-input field-policy">
					<div class="form-error">Заполните поле <img src="/image/new_design/attention.svg"></div>
					<div class="is-checkbox"><input type="checkbox" name="policy"> <span>Даю <a target="_blank" href="/policy/">согласие</a> на обработку моих персональных данных</span></div>
				</div>
				<div class="request__btn" onClick="toDirector('form-root', 'form-props__prod');">Отправить</div>
				<div class="form-error"></div>
			</form>
		</div>
	</div>
</div>
<script>

	if($('#request__director').length>0){

		$.ajax({
			url: '/ajax/add-form.php',
			type: 'POST',
			data: {
				unbot : '',
			},
			dataType: 'json',
			beforeSend: function () {
				$('body').addClass('wait');
			},
			success: function (data) {
				$('#GoUp').trigger('click');
				$('#request__director').html(data);
			}
		});
		$('body').removeClass('wait');
	}
	
	function toDirector(container, props){
		if(!$('body').hasClass('wait')){
			$.ajax({
				url: '/ajax/form_manage.php',
				type: 'POST',
				data: {
					unbot : $('#'+props).find('[name=unbot]').val(),
					name : $('#'+props).find('[name=name]').val(),
					email : $('#'+props).find('[name=email]').val(),
					message : $('#'+props).find('[name=message]').val(),
					policy : $('#'+props).find('[name=policy]').prop('checked')
				},
				dataType: 'json',
				beforeSend: function () {
					$('body').addClass('wait');
				},
				success: function (data) {

					if (data.error.name === true) {
						$('#'+props).find('.field-name').addClass('error');
					}
					if (data.error.email === true) {
						$('#'+props).find('.field-email').addClass('error');
					}
					if (data.error.message === true) {
						$('#'+props).find('.field-message').addClass('error');
					}
					if (data.error.policy === true) {
						$('#'+props).find('.field-policy').addClass('error');
					}
					if (data.success === true) {
						$('#'+container).addClass('success').html(data.text);
					}
					$('body').removeClass('wait');
				}
			});
		}
	}

</script>
<? */ ?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>