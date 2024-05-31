<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<br><br><br><br><br><br>
<?$APPLICATION->SetPageProperty("title", "Наши клиенты");
$APPLICATION->SetPageProperty("description", "О компании «Плитка на дом». Большой опыт работы в сфере продаж плитки, керамогранита, мозаики, напольных покрытий и сантехники. Открыты для сотрудничества с производителями.");
$APPLICATION->SetTitle("Наши клиенты");
?>
    <br><br><br><br><br><br>
<?$APPLICATION->IncludeComponent("custom:clients.list","default",[
    'SORT' => ['sort' => 'asc', 'id' => 'desc'],
    'FILTER' => ['IBLOCK_ID' => 23, 'ACTIVE' => 'Y'],
    'GROUP_BY' => false,
    'SHOW_NAV' => 'Y',
    "SHOW_TITLE" => "N",
    'NAV_PARAMS' => ['nPageSize' => 24],
    'SELECT' => [
        'ID', 
        'NAME', 
        'PREVIEW_PICTURE',
        'PREVIEW_TEXT',
        'PROPERTY_URL_NEWS_CLIENTS',
    ],
]);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>