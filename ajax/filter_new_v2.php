<?php require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
if(is_array($_POST) && $_POST["ajax"] == "Y"){
	CModule::IncludeModule("iblock");
	$url = ''; $links = $checkUrl = [];
	
	$exdir = htmlspecialchars($_POST["dir"]);
	$exback =  htmlspecialchars($_POST["back"]);
	$sec_id =  htmlspecialchars($_POST["sec_id"]);
	
	if(strlen($exdir) > strlen($exback)){
		$dir = $exback;
		$back = $exdir;
	}else{
		$dir = $exdir;
		$back = $exback;
	}
	
	unset($_POST["dir"], $_POST["back"], $_POST["sec_id"], $_POST["ajax"]);
	$just = false;
	
	$checkUrl[0] = $dir;
	
	if(!empty($back) && $dir != $back){
		$checkUrl[1] = $back;
	}
	
	$i = '0';
	foreach($_POST as $k=>$post){
		if(strpos($k, "arrFilter") !== false && !empty($post)){ 
			$i++;
			if($i == 1 && !empty($sec_id)){
				$checkUrl[0] = $checkUrl[0]."?sec_id=".$sec_id;
			}
			$checkUrl[0] = $checkUrl[0].($i == 1 && empty($sec_id) ? "?" : '&').$k."=".$post;
			if(!empty($checkUrl[1])){
				$checkUrl[1] = $checkUrl[1].($i == 1 ? "?" : '&').$k."=".$post;
			}
		}
	}
	
	if($i > 0){
		$checkUrl[0] = $checkUrl[0]."&set_filter=Y";
		if(!empty($checkUrl[1])){
			$checkUrl[1] = $checkUrl[1]."&set_filter=Y";
		}
	}
		
	$result["check"] = $checkUrl;
	
	if(count($checkUrl)>0){
		$res = CIBlockElement::GetList(["ID"=>"ASC"], ["IBLOCK_ID"=>33, "PROPERTY_NEW_REAL_1"=>$checkUrl, "ACTIVE"=>"Y"], false, [], ["ID","PROPERTY_NEW"])->GetNext()[ "PROPERTY_NEW_VALUE"];
		if(!empty($res)){
			$result['link'] = $res;
		}else{
			$res = CIBlockElement::GetList(["ID"=>"ASC"], ["IBLOCK_ID"=>33, "PROPERTY_NEW_REAL_2"=>$checkUrl, "ACTIVE"=>"Y"], false, [], ["ID","PROPERTY_NEW"])->GetNext()[ "PROPERTY_NEW_VALUE"];
			if(!empty($res)){
				$result['link'] = $res;
			}else{
				$result['link'] = ($checkUrl[1] ?? $checkUrl[0]);
			}
		}
	}else{
		$result['link'] = ($checkUrl[1] ?? $checkUrl[0]);
	}
	echo json_encode($result);
	}else
		die();
}else
	die();