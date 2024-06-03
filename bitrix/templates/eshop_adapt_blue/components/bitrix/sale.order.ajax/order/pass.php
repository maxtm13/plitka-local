<?
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if($_POST['pass'] != '' && $USER->GetID() > 0 && check_bitrix_sessid()){
    $oUser = new CUser;
    $aFields = array(
        'PASSWORD' => $_POST['pass'],
        'CONFIRM_PASSWORD' => $_POST['pass']
    );
    if($oUser->Update($USER->GetID(), $aFields)){
		$GLOBALS["USER_FIELD_MANAGER"]->Update('USER', $USER->GetID(), ['UF_ORDER_PASS' => true]);
        echo json_encode(['TYPE' => 'OK']);
        return;
    }
}
echo json_encode(['TYPE' => 'ERROR']);