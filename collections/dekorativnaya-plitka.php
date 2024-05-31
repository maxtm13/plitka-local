<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$exDir = explode("/",$_SERVER['REQUEST_URI']);

if(count($exDir)>3){
	define("ERROR_404", "Y");
	\Bitrix\Iblock\Component\Tools::process404('Страница Не найдена', true, true, true, false);
}else{
	$APPLICATION->SetPageProperty("title", "Декоративная плитка – купить в интернет-магазине | Напольная и настенная декоративная кафельная плитка по низкой цене");
	// $APPLICATION->SetPageProperty("keywords", "купить декоративную плитку для стен внутренняя напольная кафельная пола мелкая маленькая");
	$APPLICATION->SetPageProperty("description", "В нашем интернет магазине представлен широкий ассортимент декоративной плитки по доступным ценам. Заказать плитку можно по телефону +7 (495) 777-71-21.");
//	$APPLICATION->SetTitle("Декоративная плитка");
//	$APPLICATION->AddChainItem('Декоративная плитка');
	$GLOBALS['arrFilter']['DEPTH_LEVEL'] = 3;
	$GLOBALS['arrFilter']["PROPERTY_45"] = 5231;
	?><?
	
if($_SESSION["SORT_VS_COUNT"]){
	$sess = unserialize($_SESSION["SORT_VS_COUNT"]);
}

		$APPLICATION->IncludeComponent(
		"omniweb:catalog.section.list",
		"section-list-catalog",
		Array(
			"ADD_SECTIONS_CHAIN" => "N",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "36000000",
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
		//	'RBS_SORT' => $rbs_sort,
			"COLLECII" => "Y",
			"SORT_BY" => ($sess["sort"]["type"] ? $sess["sort"]["type"] : "UF_HIT"),
				 "SORT_ORDER" => ($sess["sort"]["order"] ? $sess["sort"]["order"] : "DESC"),
				 "IN_PAGE" => ($sess["inpage"] ? $sess["inpage"] : "40"),
			 "PAGE" => ($_SERVER["REDIRECT_URL"] ?? $_SERVER["REQUEST_URI"]),
			  	"PAGEN" => ($_REQUEST['PAGEN_2'] ? $_REQUEST['PAGEN_2'] : $_REQUEST['PAGEN_1']),
			  "YEAR" => date('Y',strtotime(date("Y").'-01-01 -1year')),
		)
	);?> <? /* if(!isset($_REQUEST['PAGEN_1']) || $_REQUEST['PAGEN_1'] == 1):?>
	<div class="imgtim">
	<p>Декоративная плитка – материал для внутренней и внешней отделки стен дома или квартиры. В ассортименте нашего магазина представлены два основных вида этого облицовочного материала: керамическая и керамогранитная плитка. Эти разновидности облицовочного кафеля не слишком отличаются по стоимости и характеристикам.</p>
	<p>Декоративный камень довольно часто применяется в отделке помещений. Его популярность обусловлена многочисленными достоинствами:</p>
	<ul>
	<li>прочность – выдерживает солидные механические нагрузки;</li>
	<li>практичность – не впитывает загрязнения, легко очищается;</li>
	<li>гигиеничность – устойчив к образованию налета и грибка;</li>
	<li>малый вес и простота монтажа.</li>
	</ul>
	<p>Это декоративное покрытие выпускается в широкой цветовой гамме. Доступна имитация различных  материалов: камня, кирпича, дерева, текстиля. Кафельная поверхность может быть ровной или выпуклой. Облицовочный материал изготавливается из смеси глиняных растворов с добавкой кварцевого песка и других компонентов.</p>
	<p>Интернет-магазин «Плитка на дом» реализует широкий перечень продукции российских и зарубежных производителей.</p>
	<h2>Декоративная кафельная плитка в интерьере</h2>
	<p>Напольная и настенная облицовочная плитка – довольно частое явление в современных интерьерах. Она позволяет сделать помещение выразительнее, отлично сочетается с обстановкой, в которой есть камин. С помощью этого внутреннего отделочного материала часто оформляют арку, дверные и оконные проемы. Материал будет уместен в качестве облицовки стен в интерьере в стиле лофт. Так как покрытие не боится влаги и повышенных температур, подходит оно и для устройства кухонного фартука.</p>

	 <img width="200" alt="a_e174c266.jpg" src="/upload/medialibrary/0c2/a_e174c266.jpg" height="151" title="a_e174c266.jpg"><br>
		<p>
	 <br>
		</p>
	 <span style="font-size: 14pt;"> </span>
	</div>
	 <span style="font-size: 14pt;"> </span>
<?endif; */?>
<? } ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>