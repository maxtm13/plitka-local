<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if($arResult['UF_HEADER']){
	$APPLICATION->SetTitle($arResult['UF_HEADER']);
}

if(!empty($arResult["DETAIL_PICTURE"]) || !empty($arResult["PICTURE"])){
	$photo = ($arResult["DETAIL_PICTURE"]["ID"] ?? $arResult["PICTURE"]["ID"]);
	$arResult["PHOTOS"][] = [
		"MIN" => CFile::ResizeImageGet(
		$photo,
		array("width" => 170, "height" => 170),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true)["src"],
		"BIG" => CFile::ResizeImageGet(
		$photo,
		array("width" => 1280, "height" => 1280),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true)["src"]
	];
}

if(!empty($arResult['UF_MORO_PHOTO']) && is_array($arResult['UF_MORO_PHOTO'])){
	foreach($arResult['UF_MORO_PHOTO'] as &$photo){
		$arResult["PHOTOS"][] = [
			"MIN" => CFile::ResizeImageGet(
            $photo,
            array("width" => 170, "height" => 170),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true)["src"],
			"BIG" => CFile::ResizeImageGet(
            $photo,
            array("width" => 1280, "height" => 1280),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true)["src"]
		];
	}
}
unset($photo);

// оптимизировать получениеданных без перебора (или сразу за счёт импорта)
foreach($arResult['ITEMS'] as $arItm) {
	if($arItm["PROPERTIES"]["DISCOUNT"]["VALUE"] == 2){
		$arResult["USE_DELIVERY"] = "Y";
	}
	if($arItm["PROPERTIES"]["DISCOUNT"]["VALUE"] == 4){
		$arResult["USE_DELIVERY_V2"] = "Y";
	}
}

unset($arResult["NAV_STRING"], $arResult["NAV_RESULT"], $arResult["NAV_CACHED_DATA"], $arResult["NAV_CACHED_DATA"]);
?>