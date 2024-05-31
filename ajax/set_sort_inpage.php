<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && $_POST["inpage"] && $_POST["sort"]){

	$sort = '';
	$exsort = [];
		
	$exsort["issort"] = htmlspecialchars($_POST["sort"]);
	$exsort['inpage'] = (int)$_POST["inpage"];
	if($exsort['inpage'] == 20){
		$exsort['inpage'] = 40;
	}

	session_start();
	$result = $_SESSION["SORT_VS_COUNT"] = json_encode($exsort);

	echo json_encode($result);
	
}else
	die();