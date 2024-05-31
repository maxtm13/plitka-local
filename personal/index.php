<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?> 
<div class="bx_page">
	<p>В личном кабинете Вы можете проверить текущее состояние корзины, ход выполнения Ваших заказов, просмотреть или изменить личную информацию, а также подписаться на новости и другие информационные рассылки. </p>
	<div class="personal_div_row">
		<div class="personal_div_span6">
			<h2>Личная информация</h2>
			<a href="profile/">Изменить регистрационные данные</a>
		</div>

		<div class="personal_div_span6">
			<h2>Заказы</h2>
			<a href="order/">Ознакомиться с состоянием заказов</a><br/>
			<a href="cart/">Посмотреть содержимое корзины</a><br/>
			<a href="order/">Посмотреть историю заказов</a><br/>
		</div>

		<div class="personal_div_span6">
			<h2>Подписка</h2>
			<a href="subscribe/">Изменить подписку</a>
		</div>
	</div>

</div>

<div class="row sale-personal-section-row-flex">
									<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/personal/order/">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-calculator"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									Текущие заказы								</h2>
							</a>
						</div>
					</div>
										<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/personal/profile/">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-user-secret"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									Личные данные								</h2>
							</a>
						</div>
					</div>
										<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/personal/profile/">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-lock"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									Сменить пароль								</h2>
							</a>
						</div>
					</div>
										<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/personal/order/">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-list-alt"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									История заказов								</h2>
							</a>
						</div>
					</div>
										<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/personal/cart">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-shopping-cart"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									Корзина								</h2>
							</a>
						</div>
					</div>
										<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/personal/subscribe/">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-envelope"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									Подписки								</h2>
							</a>
						</div>
					</div>
										<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-yellow">
							<a class="sale-personal-section-index-block-link" href="/contacts/">
								<span class="sale-personal-section-index-block-ico">
									<i class="fa fa-info-circle"></i>								</span>
								<h2 class="sale-personal-section-index-block-name">
									Контакты								</h2>
							</a>
						</div>
					</div>
								</div>
								
<style>
.sale-personal-section-index-block.bx-theme-yellow {
    background: url(/bitrix/components/bitrix/sale.personal.section/templates/.default/images/wt_yellow.png) center top;
}

span.sale-personal-section-index-block-ico {
    font-size: 64px;
}
.col-lg-4.col-md-6.col-sm-12.col-xs-12 {
    width: 28.333333%;
    display: inline-block;
}
h2.sale-personal-section-index-block-name {
    color: #fff;
}

a.sale-personal-section-index-block-link {
    text-decoration: none;
    display: block;
    padding: 25px 15px;
    color: #fff;
}
.sale-personal-section-index-block {
    opacity: .8;
    padding: 0;
    margin: 15px 0;
    text-align: center;
    text-transform: uppercase;
    -webkit-transition: all .3s;
    -moz-transition: all .3s;
    -ms-transition: all .3s;
    -o-transition: all .3s;
    transition: all .3s;
    color: #fd1b1b;
    background-size: cover;
    border-radius: 3px;
    height: 87%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: space-around;
}

@media screen and (max-width: 800px) {
.col-lg-4.col-md-6.col-sm-12.col-xs-12 {
    width: 28.333333%;
	display: contents;
}
}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
