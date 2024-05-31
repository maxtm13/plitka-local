<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
// $APPLICATION->SetPageProperty("keywords", "настенная керамическая плитка стеновую кафельная мелкая облицовочная кафель коллекции для стен белую в интернет магазине москве дешево недорого купить стоимость цена ");
// $APPLICATION->SetPageProperty("description", "Настенная облицовочная керамическая плитка в интернет-магазине «Плитка на дом». На сайте представлен огромный ассортимент самых популярных коллекций кафельной плитки. Низкие цены, быстрая доставка! Звоните!");
//$APPLICATION->SetPageProperty("title", "Настенная плитка — купить в интернет-магазине «Плитка на дом.ру»");
$APPLICATION->SetPageProperty("description", "Широкий выбор керамической облицовочной плитки для стен по привлекательной стоимости с гарантией от производителя в каталоге интернет магазина плитканадом");
$APPLICATION->SetPageProperty("title", "Купить (Настенную) Плитку В Москве По Лучшим Ценам!");
$APPLICATION->SetTitle("Настенная плитка");
// $APPLICATION->AddChainItem('Настенная плитка');
//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 23); // Настенная плитка
$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
$GLOBALS['arrFilter']["PROPERTY_45"] = 23;

if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

?><?php $APPLICATION->IncludeComponent(
    "omniweb:catalog.section.list",
    "section-list-catalog",
    [
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "360000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FILTER_NAME" => "arrFilter",
        "FILTER_SORT_PANEL" => "Y",
        "HIDE_SECTION_NAME" => "N",
        "IBLOCK_ID" => "4",
        "IBLOCK_TYPE" => "catalog",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "arrows",
        "PAGER_TITLE" => "Разделы",
        "SECTION_CODE" => "",
        "SECTION_COUNT" => "40",
        "SECTION_FIELDS" => ["", ""],
        "SECTION_ID" => "",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => [
            "UF_HEADER",
            "UF_MORO_PHOTO",
            "UF_82",
            'UF_91',
            'UF_92',
            'UF_ASSIGN',
            'UF_ASSIGN_ONLY',
            'UF_CATALOG_PRICE_1',
            'UF_AVAILABILITY',
            'UF_TOPTEXT'
        ],
        "SHOW_PARENT_NAME" => "N",
        "TOP_DEPTH" => "3",
        "VIEW_MODE" => "TILE",
        "COLLECII" => "Y",
			 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
    ]
); ?> <?php /* if (!isset($_REQUEST['PAGEN_1']) || $_REQUEST['PAGEN_1'] == 1): ?>
    <div class="imgtim2">
        <p>Компания Plitkanadom предлагает вниманию своих покупателей огромный ассортимент настенной плитки для облицовки ванной, гостиной или прихожей. Цветовая гамма, варианты облицовок поверхности и дизайн разнообразные, и могут удовлетворить даже самых требовательных покупателей.</p>
        <h2>Наш ассортимент:</h2>
        <ul>
            <li>широкий выбор типоразмеров &mdash; от 10*10 до 80*80 см;</li>
            <li>облицовочную разной формы (квадрат, прямоугольник, восьмиугольник, &laquo;рваный&raquo; камень);</li>
            <li>палитру цветов &mdash; от нескольких оттенков розового до насыщенного черного и мультиколор;</li>
            <li>модные виды лаппатированной (притертой) поверхности с эффектом анти скольжения, глазурованную классику, стильные матовые коллекции и т. д.</li>
        </ul>
        <h3>Виды покрытий</h3>
        <p>Настенная плитка выпускается с глянцевой, рельефной и матовой поверхностью. Глянец визуально расширит большое помещение. Матовая поверхность пользуется большим спросом последние годы, так как сейчас основной спрос на минимализм. Рельефная облицовка пойдет тем, кто любит эксперименты и нестандартные дизайнерские решения.</p>
        <h2>Как сделать заказ?</h2>
        <p>Купить товар в любом количестве от лучших производителей России и мира онлайн очень просто. Выбирайте коллекцию, которая идеально подойдет для вашей квартиры, и размещайте заказ по телефону (+7&ndash;495&ndash;77&ndash;77&ndash;121 или +7&ndash;800&ndash;755&ndash;755&ndash;7) или прямо на сайте.</p>
        <p>Обращайтесь, в компании Plitkanadom всегда готовы помочь сделать верный выбор. А при необходимости &mdash; и заказать дополнительно настенную плитку в количестве нескольких штук (не нужно формировать запасов, боясь просчитаться с нужным объемом материала).</p>
        <img width="15%" alt="image.jpg" src="/upload/medialibrary/83d/1934.jpg" height="auto" title="image.jpg" style="display: block;" padding-right="10px"><br>
    </div>
<? endif; */ ?>
<?php } ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>