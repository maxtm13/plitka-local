<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(!empty($_POST['ajax']) && !empty($_POST['id']) && is_numeric($_POST['id']) && CModule::IncludeModule('sale')){	
		if(!($arOrder = CSaleOrder::GetByID((int)$_POST['id'])))
			echo json_encode('oops');
		else
			echo json_encode('/personal/order/make/?reorder='.(int)$_POST['id']);		
	}else
		die();
}else
	die();