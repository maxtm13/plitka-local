<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Currency;

if (!Loader::includeModule('iblock')) {
    return;
}

$catalogIncluded = Loader::includeModule('catalog');
$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$arIBlockType = CIBlockParameters::GetIBlockTypes();
$arIBlock = [];
$iblockFilter = (
!empty($arCurrentValues['IBLOCK_TYPE'])
    ? ['TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y']
    : ['ACTIVE' => 'Y']
);
$rsIBlock = CIBlock::GetList(['SORT' => 'ASC'], $iblockFilter);
while ($arr = $rsIBlock->Fetch()) {
    $arIBlock[$arr['ID']] = '[' . $arr['ID'] . '] ' . $arr['NAME'];
}
unset($arr, $rsIBlock, $iblockFilter);

$arPrice = [];
if ($catalogIncluded) {
    $arPrice = CCatalogIBlockParameters::getPriceTypesList();
}

$arProperty_UF = [];
$arSProperty_LNS = [];
if ($iblockExists) {
    $arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_" . $arCurrentValues["IBLOCK_ID"] . "_SECTION");
    foreach ($arUserFields as $FIELD_NAME => $arUserField) {
        $arProperty_UF[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"] ? $arUserField["LIST_COLUMN_LABEL"] : $FIELD_NAME;
        if ($arUserField["USER_TYPE"]["BASE_TYPE"] == "string") {
            $arSProperty_LNS[$FIELD_NAME] = $arProperty_UF[$FIELD_NAME];
        }
    }
    unset($arUserFields, $FIELD_NAME, $arUserField);
}

$arComponentParameters = [
    "GROUPS" => [
        "PRICES" => [
            "NAME" => GetMessage("CP_BCSF_PRICES"),
        ],
        "XML_EXPORT" => [
            "NAME" => GetMessage("CP_BCSF_GROUP_XML_EXPORT"),
        ],
    ],
    "PARAMETERS" => [
        "SEF_MODE" => [],
        "SEF_RULE" => [
            "VALUES" => [
                "SECTION_ID" => [
                    "TEXT" => GetMessage("CP_BCSF_SECTION_ID"),
                    "TEMPLATE" => "#SECTION_ID#",
                    "PARAMETER_LINK" => "SECTION_ID",
                    "PARAMETER_VALUE" => '={$_REQUEST["SECTION_ID"]}',
                ],
                "SECTION_CODE" => [
                    "TEXT" => GetMessage("CP_BCSF_SECTION_CODE"),
                    "TEMPLATE" => "#SECTION_CODE#",
                    "PARAMETER_LINK" => "SECTION_CODE",
                    "PARAMETER_VALUE" => '={$_REQUEST["SECTION_CODE"]}',
                ],
                "SECTION_CODE_PATH" => [
                    "TEXT" => GetMessage("CP_BCSF_SECTION_CODE_PATH"),
                    "TEMPLATE" => "#SECTION_CODE_PATH#",
                    "PARAMETER_LINK" => "SECTION_CODE_PATH",
                    "PARAMETER_VALUE" => '={$_REQUEST["SECTION_CODE_PATH"]}',
                ],
                "SMART_FILTER_PATH" => [
                    "TEXT" => GetMessage("CP_BCSF_SMART_FILTER_PATH"),
                    "TEMPLATE" => "#SMART_FILTER_PATH#",
                    "PARAMETER_LINK" => "SMART_FILTER_PATH",
                    "PARAMETER_VALUE" => '={$_REQUEST["SMART_FILTER_PATH"]}',
                ],
            ],
        ],
        "IBLOCK_TYPE" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("CP_BCSF_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ],
        "IBLOCK_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("CP_BCSF_IBLOCK_ID"),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
        ],
        "SECTION_ID" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("CP_BCSF_SECTION_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => '={$_REQUEST["SECTION_ID"]}',
        ],
        "SECTION_CODE" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("CP_BCSF_SECTION_CODE"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ],
        "PREFILTER_NAME" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("CP_BCSF_PREFILTER_NAME"),
            "TYPE" => "STRING",
            "DEFAULT" => "smartPreFilter",
        ],
        "FILTER_NAME" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("CP_BCSF_FILTER_NAME"),
            "TYPE" => "STRING",
            "DEFAULT" => "arrFilter",
        ],
        "PRICE_CODE" => [
            "PARENT" => "PRICES",
            "NAME" => GetMessage("CP_BCSF_PRICE_CODE"),
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => $arPrice,
        ],
        "CACHE_TIME" => [
            "DEFAULT" => 36000000,
        ],
        "CACHE_GROUPS" => [
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("CP_BCSF_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "SAVE_IN_SESSION" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("CP_BCSF_SAVE_IN_SESSION"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ],
        "PAGER_PARAMS_NAME" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("CP_BCSF_PAGER_PARAMS_NAME"),
            "TYPE" => "STRING",
            "DEFAULT" => "arrPager"
        ],
        "XML_EXPORT" => [
            "PARENT" => "XML_EXPORT",
            "NAME" => GetMessage("CP_BCSF_XML_EXPORT"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ],
        "SECTION_TITLE" => [
            "PARENT" => "XML_EXPORT",
            "NAME" => GetMessage("CP_BCSF_SECTION_TITLE"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "DEFAULT" => "-",
            "VALUES" => array_merge(
                [
                    "-" => " ",
                    "NAME" => GetMessage("IBLOCK_FIELD_NAME"),
                ], $arSProperty_LNS
            ),
        ],
        "SECTION_DESCRIPTION" => [
            "PARENT" => "XML_EXPORT",
            "NAME" => GetMessage("CP_BCSF_SECTION_DESCRIPTION"),
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "DEFAULT" => "-",
            "VALUES" => array_merge(
                [
                    "-" => " ",
                    "NAME" => GetMessage("IBLOCK_FIELD_NAME"),
                    "DESCRIPTION" => GetMessage("IBLOCK_FIELD_DESCRIPTION"),
                ], $arSProperty_LNS
            ),
        ],
    ],
];

if ($arCurrentValues["SEF_MODE"] == "Y") {
    $arComponentParameters["PARAMETERS"]["SECTION_CODE_PATH"] = [
        "NAME" => GetMessage("CP_BCSF_SECTION_CODE_PATH"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
    $arComponentParameters["PARAMETERS"]["SMART_FILTER_PATH"] = [
        "NAME" => GetMessage("CP_BCSF_SMART_FILTER_PATH"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
    ];
}

if ($catalogIncluded) {
    $arComponentParameters["PARAMETERS"]['HIDE_NOT_AVAILABLE'] = [
        'PARENT' => 'DATA_SOURCE',
        'NAME' => GetMessage('CP_BCSF_HIDE_NOT_AVAILABLE_EXT'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
    ];

    $arComponentParameters["PARAMETERS"]['CONVERT_CURRENCY'] = [
        'PARENT' => 'PRICES',
        'NAME' => GetMessage('CP_BCSF_CONVERT_CURRENCY'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
        'REFRESH' => 'Y',
    ];

    if (isset($arCurrentValues['CONVERT_CURRENCY']) && $arCurrentValues['CONVERT_CURRENCY'] == 'Y') {
        $arComponentParameters['PARAMETERS']['CURRENCY_ID'] = [
            'PARENT' => 'PRICES',
            'NAME' => GetMessage('CP_BCSF_CURRENCY_ID'),
            'TYPE' => 'LIST',
            'VALUES' => Currency\CurrencyManager::getCurrencyList(),
            'DEFAULT' => Currency\CurrencyManager::getBaseCurrency(),
            "ADDITIONAL_VALUES" => "Y",
        ];
    }
}

if (empty($arPrice)) {
    unset($arComponentParameters["PARAMETERS"]["PRICE_CODE"]);
}
