<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	if($_POST["ajax"] = "Y" && !empty($_POST["measure"]) && !empty($_POST["val"]) && !empty($_POST["sqr"])){

		$result = [];
		$result["measure"] = htmlspecialchars($_POST["measure"]);
		$val = htmlspecialchars($_POST["val"]);
		$sqr = number_format(htmlspecialchars($_POST["sqr"]), 4, '.', '');

		if(!empty($result["measure"])){
			if($result["measure"] == 'упак.'){
				if(number_format($val, 4, '.', '') < number_format($sqr, 4, '.', '')){
					$result["value"] = '1';
				}else{
					$result["value"] = ceil(($val/$sqr));
				}
			}elseif($result["measure"] == 'шт.'){
				$result["value"] = ceil(($val/$sqr));
			}else{
				$result["value"] = number_format(($sqr*$val), 4, '.', '');
			}
		}

		echo json_encode($result);
	
	}else
		die();
}else
	die();