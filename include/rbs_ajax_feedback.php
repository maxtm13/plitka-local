<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;

$arMsg = [
	'TYPE' => 'ERROR',
	'TEXT' => 'Упс! Возникла ошибка, попробуйте перезагрузить страницу и попробовать снова.'
];


if(CModule::IncludeModule('iblock') && !empty($_POST['email']) && !empty($_POST['num'])){
	$el = new CIBlockElement;

	$PROP = array();
	$PROP[307] = $_POST['email'];
	$PROP[308] = $_POST['num'];

	$arLoadProductArray = Array(
		"MODIFIED_BY"    => $USER->GetID()?:1,
		"IBLOCK_SECTION_ID" => false,
		"IBLOCK_ID"      => 21,
		"PROPERTY_VALUES"=> $PROP,
		"NAME"           => $_POST['email'],
		"ACTIVE"         => "Y"
	);

	if($el->Add($arLoadProductArray)){
		$arMsg = [
			'TYPE' => 'OK',
			'TEXT' => 'При появлении товара вы будете проинформированы о поступлении по почте!'
		];
	}
}

echo json_encode($arMsg);