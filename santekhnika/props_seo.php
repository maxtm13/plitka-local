<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
 
CModule::IncludeModule("iblock");

global $USER;
if (!$USER->IsAdmin()) die("Вы не администратор!");




/*$arFields = Array(
	"NAME" => "Цвет",
	"ACTIVE" => "Y",
	"SORT" => "100",
	"CODE" => "COLOR_LIST",
	"PROPERTY_TYPE" => "L",
	"IBLOCK_ID" => 11
);

$arSelect = Array("ID", "PROPERTY_COLOR");
$arFilter = Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y", "SECTION_ID"=>"32643");
$res = CIBlockElement::GetList(Array(), $arFilter, Array("PROPERTY_COLOR"), Array("nPageSize"=>999999), $arSelect);
$k = 0;
while($ob = $res->GetNextElement())
{
	$k++;
	$arProps = $ob->GetFields();
	
	if ($arProps["PROPERTY_COLOR_VALUE"])
	{
		$arFields["VALUES"][] = array(
			"VALUE" => $arProps["PROPERTY_COLOR_VALUE"],
			"DEF"	=> "N",
			"SORT"	=> $k,
		);
	}

}*/

/*
echo "<pre>";
print_r($arFields);
echo "</pre>";*/

/*$ibp = new CIBlockProperty;
$PropID = $ibp->Add($arFields);*/

/*$arSelect = Array("ID", "PROPERTY_COLOR", "PROPERTY_COLOR_LIST");
$arFilter = Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y", "SECTION_ID"=>"32643");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5000), $arSelect);
while($ob = $res->GetNextElement())
{
	$arFields = $ob->GetFields();
	$arRes[] = $arFields;
}

$arColor = array(
	"Бежевый" => "7393",
	"Белый" => "7394",
	"Голубой" => "7395",
	"Зеленый" => "7396",
	"Коричневый" => "7397",
	"Красный" => "7398",
	"Розовый" => "7399",
	"Синий" => "7400",
	"Черный" => "7401",
);


foreach ($arRes as $arItem) {
	CIBlockElement::SetPropertyValuesEx($arItem["ID"], false, array("COLOR_LIST" => $arColor[$arItem["PROPERTY_COLOR_VALUE"]]));
}*/

/*	echo "<pre>";
	print_r($arRes);
	echo "</pre>";*/



