<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && empty($_POST["unbot"])) {

	CModule::IncludeModule("iblock");

	unset($_POST["unbot"]);
	
	$result = [];
	
	$result["success"] = $error = false;
	
	foreach($_POST as $k=>$post){
		$result["error"][$k] = false;
	}

	if(!empty($_POST['name'])){
		$name = htmlspecialchars($_POST['name']);
	}else{
		$result["error"]["name"] = true;
		$error = true;
	}
	
	if($_POST['email'] && check_email($_POST['email'])){
		$email = htmlspecialchars($_POST['email']);
	}else{
		$result["error"]["email"] = true;
		$error = true;
	}
	
	if(empty($_POST['message'])){
		$result["error"]["message"] = true;
		$error = true;		
	}
	
	if($_POST['policy'] == "true"){
		$result["error"]["policy"] = false;
	}else{
		$result["error"]["policy"] = true;
		$error = true;
	}

	$arLoadProductArray = [];

	if($error != true){

		$result["success"] = true;

		$el = new CIBlockElement;

		$arLoadProductArray = [ 
			"MODIFIED_BY"    => 1,
			'IBLOCK_SECTION_ID' => false,
			"IBLOCK_ID" => 43,
			"NAME" => $name.' - '.$email,
			'ACTIVE' => 'Y',
			"PROPERTY_VALUES" => [
				"STATUS" => 15391,
				"NAME" => $name,
				"EMAIL" => $email,
				"MESSAGE" => ["VALUE" => ["TEXT" => $message, "TYPE" => "text"]],
			],
		];

		if($requestid = $el->Add($arLoadProductArray)) {

			$arEventFields = $arLoadProductArray["PROPERTY_VALUES"];

			$arEventFields["ID"] = $requestid;

			$arEventFields["LINK"] = '<a href="https://www.plitkanadom.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=43&type=request&lang=ru&ID='.$requestid.'&find_section_section=-1&WF=Y">перейти по ссылке</a>';

			CEvent::Send("TO_DIRECTOR", SITE_ID, $arEventFields);

			$result["text"] = file_get_contents($_SERVER['DOCUMENT_ROOT']."/include/form_success.php");

		}else{
			echo "Error: ".$el->LAST_ERROR;
		}
	}
	
	echo json_encode($result);
	
}else
	die();