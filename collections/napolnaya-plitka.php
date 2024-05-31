<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
	// $APPLICATION->SetPageProperty("keywords", "плитка для пола керамогранит керамическая напольная купить недорого москва кафель цветная современная наборная яркая каталог производитель");
	$APPLICATION->SetPageProperty("title", "Плитка (Напольная) Керамическая Купить По Лучшим Цена за М2 В Москве!");
	$APPLICATION->SetTitle("Плитка для пола");
	$APPLICATION->SetPageProperty("description", "Широкий выбор плитки кафельной и керамической для пола (в квартиру, дом) от производителя по лучшей стоимости за квадратный метр в каталоге интернет магазина plitkanadom");
//	$APPLICATION->AddChainItem('Плитка для пола');
	//$GLOBALS['arrFilter'] = array("DEPTH_LEVEL" => 3, "PROPERTY_45" => 26);
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 26;
	
if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

	$APPLICATION->IncludeComponent(
		 "omniweb:catalog.section.list",
		 "section-list-catalog",
		 Array(
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
			  "SECTION_FIELDS" => array("",""),
			  "SECTION_ID" => "",
			  "SECTION_URL" => "",
			  "SECTION_USER_FIELDS" => array("UF_HEADER","UF_MORO_PHOTO","UF_82",'UF_91','UF_92','UF_ASSIGN','UF_ASSIGN_ONLY','UF_CATALOG_PRICE_1','UF_AVAILABILITY','UF_TOPTEXT'),
			  "SHOW_PARENT_NAME" => "N",
			  "TOP_DEPTH" => "3",
			  "VIEW_MODE" => "TILE",
			//  'RBS_SORT' => $rbs_sort,
			  "COLLECII" => "Y",
				 "SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
			 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
			 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		 )
	);?> <?if((!isset($_REQUEST['PAGEN_1']) || $_REQUEST['PAGEN_1'] == 1) && $_SERVER['SCRIPT_URL'] === '/collections/napolnaya-plitka'):?>
<?/*
		 <div class="imgtim2">
			  <p>Интернет-магазин Plitkanadom предлагает огромный выбор напольной плитки для облицовки любых помещений по привлекательной цене за 1 м2. Здесь вы найдете красивую недорогую керамику для дома или квартиры, прочный износостойкий керамогранит для ресторанов, магазинов, гостиниц и других коммерческих помещений и многое другое.</p>
			  <h2>Ассортимент</h2>
			  <p>В ассортименте магазина представлены популярные виды.</p>
			  <ul>
					<li>Из белой, красной и голубой глины во всех ценовых категориях &mdash; от эконом-класса до премиального.</li>
					<li>Экструдированная и прессованный керамогранит (имеет единую структуру, как стекло, отличается повышенной твердостью и устойчивостью к истиранию.</li>
					<li>Глазурованная и неглазурованная керамика для устройства кафельного пола.</li>
			  </ul>
			  <h3>5 характеристик напольной керамической плитки</h3>
			  <ol>
					<li>Устойчивость к истиранию.</li>
					<li>Морозостойкость.</li>
					<li>Эффект анти скольжения.</li>
					<li>Влагопоглощение.</li>
					<li>Прочность.</li>
			  </ol>
			  <h3>Секреты удачного выбора</h3>
			  <p>Несколько советов в помощь начинающим &laquo;дизайнерам&raquo;:</p>
			  <ul>
					<li>мелкая керамоплитка прекрасно смотрится в небольших помещениях;</li>
					<li>большая &mdash; квадратная или прямоугольная &mdash; удобнее при проведении укладочных работ, она выглядит строже, но открывает горизонты для экспериментов со всевозможными вставками декора;</li>
					<li>очень интересно на полу смотрится матовая облицовка, стилизованная под дерево, ее можно выложить в форме паркета, добавив изюминку обстановке;</li>
					<li>&nbsp;под мрамор всегда выглядит благородно и намекает на дорогие интерьеры;</li>
					<li>в поисках эксклюзива обратите внимание на нестандартные фигурные варианты напольной плитки;</li>
			  </ul>
			  <p>Доставка осуществляется по Москве и Московской области в течение трех дней. Опытные консультанты помогут грамотно оформить заказ и организовать доставку. Большой опыт продаж гарантирует оперативную обработку заказа и доступные цены для наших покупателей.</p>
			  <img width="25%" alt="Screenshot_3.png" src="/upload/medialibrary/6df/Screenshot_3.png" height="auto" title="Screenshot_3.png" style="display: block;" padding-right="10px"><br>

		 </div>
		 */?>
	<?endif;?>
	<?/*endif;*/?>
	<?/******************************/?>
<? } ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
