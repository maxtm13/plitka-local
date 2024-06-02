<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_POST['ajax'] && $_POST["id"]){
	/*
CModule::IncludeModule("catalog");	
	Add2BasketByProductID(
		htmlspecialchars($_POST["id"]), 
		1, 
		[], 
		[]
	);
  	
	
	*/
echo json_encode('ok');
	
} else
	die();


