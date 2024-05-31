<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Страница не найдена");
$APPLICATION->SetTitle("Страница не найдена ");
?> 
<div class="error__404">404</div>
<div class="error__text">
	Возможно, эта страница была удалена либо допущена ошибка в адресе
	<h2 class="error__subtitle">Рекомендуем выбрать из категорий:</h2>
	<ul class="error__list">
		<li class="error__item">
			<a href="/collections/"><img alt="Керамическая плитка" src="/image/new_design/keramika_for_error.jpg" />Керамическая плитка</a>
		</li>
		<li class="error__item">
			<a href="/napolnye-pokrytiya/"><img alt="Напольное покрытие" src="/image/new_design/napol_for_error.jpg" />Напольное покрытие</a>
		</li>
		<li class="error__item">
			<a href="/santekhnika/"><img alt="Сантехника" src="/image/new_design/sant_for_error.jpg" />Сантехника</a>
		</li>
	</ul>
	Вы можете <a class="error__link" href="/">перейти на главную страницу сайта</a>
</div>
<style>div.sidebar{display: none;}.center-side.halfblock{width:100%;padding-left: 0;}</style>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
