<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	if($_POST["inpage"] && $_POST["sort"] && $_POST["ajax"]){

		$result= [];	

		if (!empty($_POST["inpage"]))
		{
			$result["inpage"] = htmlspecialcharsbx($_POST["inpage"]);
		}
		if (!empty($_POST["sort"]))
		{
			$ex = explode("#",htmlspecialcharsbx($_POST["sort"]));
			$result["sort"]['type'] =  $ex[0];
			$result["sort"]['order'] =  $ex[1];
		}

		if(!empty($result)){
			session_start();
			$_SESSION['SORT_VS_COUNT'] =  serialize($result);
		}

		echo json_encode($_SESSION['SORT_VS_COUNT']);

	}else
		die();
}else
	die();