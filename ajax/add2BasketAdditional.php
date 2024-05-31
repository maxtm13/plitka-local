<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	CModule::IncludeModule("catalog");

	if($_POST['ajax'] && $_POST["id"]){
		Add2BasketByProductID((int)$_POST["id"]);
		echo json_encode('yep');
	}else
		die();
}else
	die();