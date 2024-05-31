<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
//	$APPLICATION->SetPageProperty("title", "Плитка Для Бассейна Купить По Лучшим Ценам За М2 В Москве!");
//	$APPLICATION->SetTitle("Плитка для бассейна");
	// $APPLICATION->SetPageProperty("keywords", "плитка в бассейн керамические купить напольная керамогранит чаши пола клинкерная вокруг цена москве уличного кафельная облицовочная стен дешево кафель");
//	$APPLICATION->SetPageProperty("description", "Широкий выбор керамической влагостойкой, морозостойкой плитки и кафеля для чаши бассейна (открытых и помещений) в каталоге интернет магазина plitkanadom");
//	$APPLICATION->AddChainItem('Плитка для бассейна');
	//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 1767);
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 1767;

if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}	

	$APPLICATION->IncludeComponent(
		 "omniweb:catalog.section.list",
		 "section-list-catalog",
		 [
			  "IBLOCK_TYPE" => "catalog",
			  "IBLOCK_ID" => "4",
			  "SECTION_ID" => "",
			  "SECTION_CODE" => "",
			  "COUNT_ELEMENTS" => "N",
			  "TOP_DEPTH" => "3",
			  "SECTION_FIELDS" => ["", ""],
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
		//	  'RBS_SORT' => $rbs_sort,
			  "COLLECII" => "Y",
			 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		 ]
	); ?> <? /* if (!isset($_REQUEST['PAGEN_1']) || $_REQUEST['PAGEN_1'] == 1): ?>
		 <div class="page-description">

			  <p>Облицовка чаши бассейна керамической плиткой – один из самых востребованных способов отделки. Процесс монтажа
					трудоемкий и должен выполняться профессионалами, но выбор качественного, красивого и прочного материала – за
					вами.</p>
			  <p>Компании-производители четко понимают, что кафель для бассейна, особенно открытого уличного, эксплуатируется
					в особых условиях. Потому разрабатывают отдельные коллекции, которые обладают рядом специфических
					характеристик.</p>
			  <p>Изделия должны быть исключительно устойчивыми к воздействию не только влаги (водопоглощение не должно
					превышать 6 %), но и микроорганизмов, а также химических реагентов. Если постройка выполнена под открытым
					небом, к числу внешних воздействий добавляются осадки, перепады температур и влажности, влияние
					ультрафиолета. Соответственно, отделочный материал должен быть устойчивым и к этим факторам.</p>
			  <p>Керамическая плитка для бассейнов должна иметь противоскользящие свойства, быть рельефной и шероховатой.</p>
			  <h2>Виды облицовочной плитки и керамогранита для чаши, стен, пола бассейнов</h2>
			  <p>В первую очередь материал для облицовки классифицируют по уровню скольжения. Соответствующая маркировка
					наносится на упаковку.</p>
			  <ul>
					<li><p>Класс A – применяется только в сухих помещениях (раздевалках, входных, комнатах отдыха).</p>
					</li>
					<li><p>Класс B – применяется в душевых, на участках вокруг чаши.</p>
					</li>
					<li><p>Класс C – наивысший показатель противоскольжения. Оптимальна для укладки на ступенях и спусках,
							  уходящих под воду.</p>
					</li>
			  </ul>
			  <p>Плитка для бассейна может быть выполнена из разных материалов:</p>
			  <ul>

					<li>Стеклянная мозаичная. Она изготавливается с применением оксидов, отлично сохраняет цвет, имеет богатую
						 палитру и гибкое основание, что дает широкие возможности для монтажа. Каждую деталь легко заменить в
						 случае необходимости. Плитка выдерживает перепады температур и циклы заморозки и оттаивания, что
						 актуально для открытых бассейнов.
					</li>
					<li>Керамическая клинкерная. Универсальна, производится по особой технологии: обжиг при высоких температурах
						 и нанесение проникающей по всей толщине глазури. Это обеспечивает защиту от влаги.
					</li>
					<li>Фарфоровая. Прочна и функциональна, поверхность напоминает стекло.</li>
			  </ul>
			  <p>Наш интернет-магазин предлагает купить плитку для бассейна в разных стилях по приемлемой цене за 1 кв. м. В
					каталоге представлен качественный кафель и керамогранит известных производителей из России, Италии, Франции,
					Польши и других стран.</p>
			  <p>Для заказа продукции позвоните нам или отправьте заявку на электронный адрес <a
							  href="mailto:info@plitkanadom.ru">info@plitkanadom.ru</a>.</p>

			  <iframe width="420" height="315" src="https://www.youtube.com/embed/62V8ldWfZso" frameborder="0"
						 allowfullscreen></iframe>
		 </div>
	<? endif; */ ?>
<? /*endif;*/ ?>
<? } ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>