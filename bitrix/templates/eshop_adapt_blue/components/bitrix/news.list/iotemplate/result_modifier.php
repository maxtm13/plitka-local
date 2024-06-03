  <?$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
        $arResult["IBLOCK_ID"],
        $arResult["ID"]
    );
    $arResult["META"] = $ipropValues->getValues();?>