<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentDescription = [
    "NAME" => GetMessage("CD_BCSF_NAME"),
    "DESCRIPTION" => GetMessage("CD_BCSF_DESCRIPTION"),
    "ICON" => "/images/iblock_filter.gif",
    "CACHE_PATH" => "Y",
    "SORT" => 70,
    "PATH" => [
        "ID" => "content",
        "CHILD" => [
            "ID" => "catalog",
            "NAME" => GetMessage("CD_BCSF_CATALOG"),
            "SORT" => 30,
        ],
    ],
];
?>
