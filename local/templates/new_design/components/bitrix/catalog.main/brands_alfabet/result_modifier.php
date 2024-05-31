<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$mainDir = [
  4 => "collections",
  9 => "napolnye-pokrytiya",
  11 => "santekhnika"
];

$arFilter = ["ACTIVE" => "Y", "DEPTH_LEVEL"=>2];

foreach($arResult["ITEMS"] as $item){

	if(in_array($item["ID"] , $arParams["IBLOCK_ID"])){

		$arFilter["IBLOCK_ID"] = $item["ID"];


        $arFilter["!IBLOCK_SECTION_ID"] = ['37360', '37099', '50789', '30756', '48427'];
        $rsSection = \Bitrix\Iblock\SectionTable::getList([
            'filter' => $arFilter,
            'select'=>["ID", "IBLOCK_ID", "NAME", "CODE", 'SECTION_PAGE_URL_RAW' => 'IBLOCK.SECTION_PAGE_URL', 'PARENT_CODE'=>'PARENT_SECTION.CODE'],
            'order'=>['NAME' => 'ASC']
        ]);
        while($sect=$rsSection->fetch()){
            $sect['SECTION_PAGE_URL']=str_replace(['#SITE_DIR#','#SECTION_CODE_PATH#'], ['', $sect['PARENT_CODE'].'/'.$sect['CODE']], $sect['SECTION_PAGE_URL_RAW']);
            $letter = mb_substr($sect['NAME'], 0, 1);
            if($item["ID"] == 9 || $item["ID"] == 11){
                if(!in_array($sect['CODE'], $allbrands ?? [])){
                    $arResult["LETERS"][$letter][$sect['CODE']] = [
                        "NAME" => $sect['NAME'],
                        "URL" => "/".$mainDir[$item["ID"]]."/brand/".$sect['CODE']
                    ];
                    $allbrands[] = $sect['CODE'];
                }
            }else{
                $arResult["LETERS"][$letter][$sect['NAME']] = [
                    "NAME" => $sect['NAME'],
                    "URL" => $sect['SECTION_PAGE_URL']
                ];
            }

            if(!empty($arResult['LETERS'][$letter])) {
                sort($arResult['LETERS'][$letter]);
            }
        }
	}

    if(!empty($arResult['LETERS'])) {
        ksort($arResult['LETERS']);
    }
}