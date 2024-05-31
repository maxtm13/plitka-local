<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

if($_POST["ajax"] && $_POST["get"]){?>
	<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A9892987cdaf0c26ab9ab3046bb3366203eb03aa1ef34880f25deaa96352de76b&amp;source=constructor" width="100%" height="650" frameborder="0"></iframe>
<? }else
	die();
}else
	die();