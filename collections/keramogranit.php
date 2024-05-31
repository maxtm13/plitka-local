<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
// $APPLICATION->SetPageProperty("keywords", "керамогранит плитка керамогранитная купить на пол в москве недорого магазин напольную цена каталог кафель дешево доставкой заказать интернет продажа стоимость от производителя недорогой сколько стоит стоимость");
//$APPLICATION->SetPageProperty("description", "");
//$APPLICATION->SetPageProperty("title", "Керамогранит Для Пола Купить По Лучшим Ценам В Москве За М2!");
// $APPLICATION->SetTitle("Керамогранит");
//$APPLICATION->AddChainItem('Керамогранит');
//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 28);
$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
$GLOBALS['arrFilter']["PROPERTY_45"] = 28;
?>
<? /* php if ($_SERVER['REQUEST_URI'] === '/collections/keramogranit') { ?>
    <p>Интернет-магазин брендовой керамики Plitkanadom предлагает большой выбор керамогранита с доставкой по Москве и по всей России. Вашему вниманию &mdash; более 50 тысяч вариантов популярного отделочного материала последнего поколения.</p>
<?
} */
if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}
	
$arSPagen = $APPLICATION->IncludeComponent(
	"omniweb:catalog.section.list",
	"section-list-catalog",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "N",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => array("",""),
		"SECTION_USER_FIELDS" => array("UF_HEADER", "UF_MORO_PHOTO", "UF_82", 'UF_91', 'UF_92', 'UF_ASSIGN', 'UF_ASSIGN_ONLY', 'UF_CATALOG_PRICE_1', 'UF_AVAILABILITY', 'UF_TOPTEXT'),
		"VIEW_MODE" => "TILE",
		"SHOW_PARENT_NAME" => "N",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_SECTION_NAME" => "N",
		"FILTER_NAME" => "arrFilter",
		"SECTION_COUNT" => "40",
		"PAGER_TEMPLATE" => "arrows",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Разделы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		'FILTER_SORT_PANEL' => 'Y',
	//	'RBS_SORT' => $rbs_sort,
		"COLLECII" => "Y",
		"SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
	)
);?>
<?if(!isset($_REQUEST['PAGEN_'.$arSPagen['NavNum']]) || $_REQUEST['PAGEN_'.$arSPagen['NavNum']] == 1):?>
<? /* php if ($_SERVER['REQUEST_URI'] === '/collections/keramogranit') { ?>
<div class="imgtim2">
    <h3>Преимущества материала</h3>
    <p>Среди особенностей стоит выделить:</p>
    <ul>
        <li>практически полное отсутствие способности поглощать влагу;</li>
        <li>высокая устойчивость к механическим нагрузкам;</li>
        <li>монолитная структура (минимальная истираемость);</li>
        <li>шероховатая поверхность ;</li>
        <li>глубина цвета (любого &mdash; от белого, серого и коричневого до яркого красного или зеленого) и точность рисунка благодаря разнообразным способам окраски.</li>
    </ul>
    <p>Плитка не боится ультрафиолета, химических средств, перепадов температур, тонких каблучков модных женских туфелек. Именно за такие прочностные и химико-физические качества материал получил свое название.</p>
    <p>Популярные формы:</p>
    <ul>
        <li>классический квадрат - от 5х5 до 60х60 см;</li>
        <li>прямоугольный вариант &mdash; модное решение последних лет;</li>
        <li>узкий прямоугольник;</li>
        <li>шестиугольник;</li>
        <li>ромб;</li>
        <li>треугольник.</li>
    </ul>
    <p>Керамогранит отличается минимальным водопоглощением и высокой прочностью, а также устойчивостью к разрушительным внешним факторам.</p>
    <p>Практика же поиска в случае с такой плиткой сводится к четырем вопросам:</p>
    <ul>
        <li>назначение;</li>
        <li>тип поверхности плиты;</li>
        <li>способ обработки краев;</li>
        <li>цвет;</li>
        <li>размер.</li>
    </ul>
    <p>Заказы принимаются онлайн (круглосуточно), по телефонам, указанным на сайте или email info@plitkanadom.ru. Звоните, пишите, оставляйте заявку, и мы подберем для вас лучшее решение по идеальной стоимости.</p>
    <img width="40%" alt="Шабл.jpg" src="/upload/medialibrary/076/SHabl.jpg" height="auto" title="Шабл.jpg" style="display: block;" padding-right="10px">
</div>
<?php } */ ?>
<?endif;?>
<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
